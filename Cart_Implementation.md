# Cart_Implementation.md — Cart & Checkout System

> **Depends on:** `Open_Decision.md` Q14 (cart scope) and Q15 (payment gateway) —
> both open as of this writing. **Phase 1 (below) is buildable now regardless
> of either answer** — it's the foundation every Q14 option needs. Phase 2 is
> split into gated sub-phases, one per Q14 option, so nothing built while
> undecided goes to waste no matter which way it resolves.
> **Repo:** `DGCodeIdeas/chada.digital` — building on a genuinely blank slate:
> no cart/order/payment tables, models, or gateway config exist yet; only
> default Laravel scaffolding (`User`, cache, jobs migrations).

---

## 0. Constraints

```
1.  Never touch public/demos/.
2.  No third-party payment SDK package. Paystack's API is a handful of plain
    REST endpoints — build directly against it with Laravel's Http facade.
    Fewer dependencies, fully auditable, no vendor lock-in on a
    money-handling code path.
3.  Every money amount is an integer in kobo (Naira's smallest unit), never
    a float. Floating-point Naira amounts are a real bug class (rounding
    errors compound at scale) — this is not a style preference.
4.  Payment status is confirmed SERVER-SIDE ONLY, via Paystack's
    /transaction/verify endpoint or a signature-verified webhook. The
    browser redirect back from Paystack is never sufficient on its own to
    mark an order paid — a user can close the tab, the network can drop,
    or the redirect can be forged. Treat the redirect as "check now",
    not "it's paid."
5.  Webhook signature verification is mandatory. Paystack signs webhook
    payloads with HMAC SHA512 of the secret key — reject anything that
    doesn't verify, no exceptions.
6.  Every Order gets a unique, unguessable reference (ULID/UUID) — never a
    sequential ID — used in all gateway communication and callback URLs.
7.  Never log full card numbers, CVVs, or gateway secret keys. Paystack's
    hosted checkout means card data never touches this app's servers at
    all if integrated correctly — keep it that way (no custom card form).
8.  No fabricated content: every price, product name, and example in this
    doc is illustrative and gated, not real content to ship as-is — same
    principle as everywhere else in this project (see Open_Decision.md Q9's
    history for why this matters).
9.  PHP 8.2 constructor promotion for new services/controllers, matching
    the rest of the codebase.
```

---

## 1. Phase 1 — Foundation (buildable now, independent of Q14/Q15)

### 1.1 Migrations

```
create_carts_table
  id, token (string, unique — cookie-based guest identifier, not a user FK;
  no auth system exists on this site and none should be required to buy),
  timestamps

create_cart_items_table
  id, cart_id (FK), description, unit_amount_kobo (unsigned bigint),
  quantity (unsigned int, default 1), source_type (string: 'product'|
  'tier_deposit'), source_reference (nullable string — e.g. a product slug
  or PricingService tier slug), timestamps

create_orders_table
  id, reference (string, unique, ULID), customer_name, customer_email,
  customer_phone (nullable), status (string enum: pending|paid|failed|
  abandoned — default pending), currency (string, default 'NGN'),
  subtotal_kobo (unsigned bigint), total_kobo (unsigned bigint),
  gateway (string), gateway_reference (nullable string),
  paid_at (nullable timestamp), notes (nullable text), timestamps

create_order_items_table
  id, order_id (FK), description, unit_amount_kobo, quantity,
  line_total_kobo, source_type, source_reference, timestamps
```

Deliberately no `products` table in Phase 1 — that only exists if Q14
resolves to (A) or (C). `order_items`/`cart_items` are generic (a
description + an amount), so they don't care whether the line item came
from a future product catalog or a service-tier deposit. That's what makes
this foundation Q14-agnostic.

### 1.2 Models

`App\Models\Cart`, `CartItem`, `Order`, `OrderItem` — standard Eloquent.
`Order::createFromCart(Cart $cart, array $customer): Order` — snapshots
cart items into order items (never reference live cart state after
checkout; prices at time of purchase must be frozen, not recalculated
later if a price changes).

### 1.3 Payment gateway abstraction

```php
// app/Services/Payments/PaymentGatewayContract.php
interface PaymentGatewayContract
{
    /** Returns ['authorization_url' => string, 'reference' => string] */
    public function initialize(Order $order): array;

    /** Returns ['status' => 'success'|'failed', 'amount_kobo' => int, 'reference' => string] */
    public function verify(string $reference): array;
}
```

```php
// app/Services/Payments/PaystackGateway.php — reference implementation
// (Q15 default; swappable, nothing else in the app depends on Paystack
// specifically — only on the contract above)
class PaystackGateway implements PaymentGatewayContract
{
    public function __construct(protected string $secretKey) {}

    public function initialize(Order $order): array
    {
        $response = Http::withToken($this->secretKey)
            ->post('https://api.paystack.co/transaction/initialize', [
                'email' => $order->customer_email,
                'amount' => $order->total_kobo, // Paystack expects kobo natively
                'reference' => $order->reference,
                'callback_url' => route('checkout.callback'),
            ]);
        // ... handle non-200, throw a clear exception rather than
        // silently returning a broken checkout link
    }

    public function verify(string $reference): array
    {
        $response = Http::withToken($this->secretKey)
            ->get("https://api.paystack.co/transaction/verify/{$reference}");
        // ... map Paystack's response shape to the contract's return shape
    }
}
```

`config/payments.php`:
```php
return [
    'default' => env('PAYMENT_GATEWAY', 'paystack'),
    'paystack' => [
        'secret_key' => env('PAYSTACK_SECRET_KEY'), // null until Founder provides
        'public_key' => env('PAYSTACK_PUBLIC_KEY'),
    ],
];
```

**If `PAYSTACK_SECRET_KEY` is null:** `CheckoutController` must fail
loudly and clearly at the point of initiating payment (a friendly "checkout
is temporarily unavailable" page + a logged error), never silently proceed
or fake a success — this is a gate, same principle as every content gate
elsewhere in this project, just for a credential instead of a copy string.

### 1.4 Controllers & routes

```
CartController      GET  /cart              → view cart
                     POST /cart/add          → add item (product OR tier-deposit)
                     POST /cart/remove       → remove item
CheckoutController   GET  /checkout          → collect customer_name/email/phone
                     POST /checkout          → create Order from Cart,
                                                call gateway->initialize(),
                                                redirect to authorization_url
                     GET  /checkout/callback → user's browser lands here after
                                                paying; call gateway->verify(),
                                                update Order, show result page
                                                (NEVER trust query params alone)
PaymentWebhookController
                     POST /webhooks/paystack → signature-verified async
                                                confirmation; update Order
                                                idempotently (a webhook can
                                                arrive before, after, or
                                                instead of the callback —
                                                design for both to fire)
```

Cart identity: a signed cookie (`cart_token`), not the Laravel session —
survives the redirect to Paystack's hosted page and back more reliably than
session state does across an external domain round-trip.

### 1.5 What Phase 1 explicitly does not build

No product catalog, no deposit logic on service tiers, no multi-item
cart-across-everything. Those are Phase 2, gated by Q14. Phase 1 alone
isn't customer-facing yet — it's the plumbing.

---

## 2. Phase 2 — gated by Q14

### 2.1 If Q14 = (A) or (C): fixed-price product catalog

- `products` migration: id, slug, name, description, price_kobo, image_path,
  active (bool), timestamps
- `Product` model, `ProductController@index` (`/shop`), `@show`
- **Content gate, same as everywhere else in this project:** zero products
  ship until the Founder provides real names/prices/descriptions. Seed the
  table empty, not with placeholder items — an empty shop page ("New
  products coming soon") is honest; a shop full of Lorem-ipsum products
  for sale is not, even gated, because a catalog page implies "these are
  real, buyable things" in a way a hero headline placeholder doesn't.
- "Add to Cart" button on each product → `CartController@add` with
  `source_type = 'product'`.

### 2.2 If Q14 = (B) or (C): deposit checkout on existing service tiers

- Add `deposit_percentage` (nullable int) to each tier in
  `PricingService::all()`. Only tiers where this is set show a "Start &
  Pay Deposit" button instead of "Get Started" — every other tier keeps
  routing to `/contact` exactly as it does today. This is additive, not a
  replacement of the existing lead-gen flow.
- Deposit amount requires a real fixed kobo value, not the display range
  string — add `price_kobo` (the tier's actual starting price as an
  integer) alongside the existing `price`/`price_range` display strings.
  **Founder needs to confirm which exact number "starting price" means**
  for each range-priced tier before this can be wired — that's part of
  Q14 itself, not a separate ask.
- `CartController@add` with `source_type = 'tier_deposit'`,
  `source_reference` = tier slug, amount = `price_kobo * deposit_percentage / 100`.
- **Remainder invoicing is out of scope for this app.** Whatever happens
  to the other 50-70% of the project cost is a manual/offline process
  (bank transfer, a separate invoice tool) unless the Founder later wants
  that automated too — not guessed at here, that's its own decision.

### 2.3 If Q14 = (D): full multi-item cart, including range-priced tiers at listed starting price

- **Requires the Founder's explicit sign-off specifically** (see
  Open_Decision.md Q14's pricing-integrity flag) — not something the Tech
  Lead should greenlight alone, since it changes what the business
  actually collects for custom-scoped work.
- If approved: same `price_kobo` field as 2.2, but every tier gets one
  (not just deposit-eligible ones), and checkout charges the full amount,
  not a percentage.
- **Recommend, don't assume:** even if (D) is chosen, consider whether
  range-priced tiers should still route to `/contact` for a scoping call
  first, with *only* the fixed-price tiers (if any exist) going straight
  to cart. That's a real design option worth raising with the Founder
  explicitly rather than silently building the riskier version because
  it was technically what was picked.

---

## 3. Verification / QA

```
[ ] Payment flow tested end-to-end against Paystack TEST mode keys before
    any real (live) key is ever put in .env
[ ] Webhook signature check: send a request with a deliberately wrong
    signature, confirm it's rejected (400), not silently accepted
[ ] Confirm an Order can NEVER reach status=paid from the /checkout/callback
    route alone without a successful gateway->verify() call
[ ] Confirm double-webhook delivery (Paystack retries) doesn't double-count
    a payment — updates must be idempotent on reference
[ ] grep the codebase for any float/decimal Naira arithmetic — should be
    zero; everything is integer kobo until final display formatting
[ ] Empty product catalog (if Q14 = A/C) renders an honest "coming soon"
    state, not a Lorem-ipsum-filled shop page
[ ] PAYSTACK_SECRET_KEY unset → checkout fails with a clear user-facing
    message + logged error, never a silent false-success
```

---

## 4. What this doc deliberately does not do

- Does not build all four Q14 options speculatively — that's wasted effort
  on at least three of them. Phase 1 is the only thing built before Q14
  resolves.
- Does not fabricate product names, prices, or a payment gateway choice to
  "make progress" — Open_Decision.md Q14/Q15 stay open until the Founder
  actually answers them.
- Does not touch `PricingService`'s existing display copy (the `price`/
  `price_range` strings) — Phase 2.2 only *adds* a numeric field alongside
  what's already there.
