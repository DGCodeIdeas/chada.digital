# Redesign(6).md — The /services Page (Tiered Pricing Page)

> **Series:** Redesign(1)–(10) · **This doc:** #6 of 10 (V4 structural; #10 is the V5 visual pivot)
> **V5 note:** The class strings in this doc's Blade code are written in Tailwind (V4). After Phase 10 (`docs/Redesign(10).md`) lands, they migrate to Bootstrap 5 + Material Web Components + custom utility classes per the 24-row migration map in Redesign(10).md §8 (row 16 covers `/services` page pricing tiers). **The structural HTML, gating logic, and tier definitions stay identical under V5** — only class strings change.
> **Builds:** `app/Services/PricingService.php` (NEW), `app/Http/Controllers/PageController.php` (+`services()` method), `routes/web.php` (+`/services` route), `resources/views/pages/services.blade.php` (NEW), `resources/views/components/service-card.blade.php` (NEW), `resources/views/components/stats-badge.blade.php` (NEW)
> **Depends on:** Redesign(2).md (config gates + Lorem); Redesign(5).md (sitemap already handles `services` route defensively)

```
CONSTRAINTS (repeat in your session — from Redesign(1).md §3):
1.  NEVER touch public/demos/.
2.  mix() not @vite(). 3. bun not npm. 4. ZERO new dependencies.
5.  Preserve route names. 6. Keep contact honeypot. 7. PHP 8.2 constructor
    promotion. 8. Blade components for reusable markup. 9. Follow the Chada
    style charter. 10. Placeholder prose is GENERATED ($real ?? Lorem::…).
11. ORIGINALITY: never copy third-party text/names/prices/metrics; never
    fetch or quote the reference site; these docs are the only reference.
    Service names, tier names, and prices are Chada's OWN — lorem or null
    until David defines them.
12. Escape apostrophes in single-quoted PHP strings.
13. bun run dev clean after every change; bun run prod before phase done.
14. NEVER invent real-sounding content — every price is null until David
    sets it. Cards render "Contact for pricing" while null.
```

---

## 0. The tiered pricing page pattern (abstract)

The page renders, top to bottom:

1. **Page header** — eyebrow + title + supporting line.
2. **Stats band** (gated) — up to 5 numbers, hidden while all null.
3. **Free-review band** — one line + button routing to the homepage `#audit` anchor.
4. **Tier 1: Advisory Sessions** — 4 one-time, low-commitment offer cards.
5. **Tier 2: Full Builds** — 6 one-time, high-commitment offer cards, on a muted band.
6. **Tier 3: Ongoing Care** — 5 recurring offer cards.
7. **Add-ons band** — compact pill list + dual closing CTAs.

**Card anatomy:**

```
┌──────────────────────────────────────────┐
│ [Tier badge — small pill]                │
│ [Title — bold, lorem until David]        │
│ [Description — 2–3 sentences, lorem]     │
│ WHO IT'S FOR: [one sentence, lorem]      │
│ [Price — large, bold, primary, gated]    │
│ [GET STARTED button]                     │
└──────────────────────────────────────────┘
```

**Chada adaptation (the honest build):** structure is complete and shippable today; **every price is `null`** until David sets a real one (constraint 14 — another agency's price list is their business data, and copying it would be both fabrication and infringement). Titles, descriptions, and audience lines are lorem slots (kind B) keyed per card. Tier names are Chada chrome (kind A): **Advisory Sessions / Full Builds / Ongoing Care** — plain English, ours. The tier *counts* (4 / 6 / 5) follow the pattern's card cadence; they are layout structure, not content.

---

## TASK 1 — Create `app/Services/PricingService.php` (NEW)

**Design note:** the service returns structure + gates + stable slot keys. It deliberately contains **no titles, no descriptions, no price figures** — those are lorem slots in the view until David fills them (slot fallback rule). Real titles land here as `title`/`description`/`best_for` keys per card; the `?? Lorem` fallbacks go dormant.

```php
<?php

namespace App\Services;

/**
 * PricingService — data source for the /services page.
 *
 * CONTENT GATES:
 *  - price_ngn / price_usd / price_period are null until David sets real
 *    prices. The service-card component renders "Contact for pricing".
 *  - Titles, descriptions, and best_for are LOREM SLOTS in the view
 *    (keyed services.{group}.{key}.title etc.) until David defines
 *    Chada's real service catalog (Open_Decision Q3). Do not pre-fill
 *    them with invented service copy.
 *  - stats(): returns null values until David supplies verified numbers —
 *    the services page stats band renders nothing while ALL are null.
 */
class PricingService
{
    /**
     * 5-number stats band (gated). Suggested slot labels only —
     * replace them when real numbers land.
     */
    public function stats(): array
    {
        return [
            ['value' => null, 'label' => 'PENDING DAVID — Clients Served'],
            ['value' => null, 'label' => 'PENDING DAVID — Case Studies'],
            ['value' => null, 'label' => 'PENDING DAVID — Systems Shipped'],
            ['value' => null, 'label' => 'PENDING DAVID — Support Response'],
            ['value' => null, 'label' => 'PENDING DAVID — Referral Rate'],
        ];
    }

    /**
     * Tier 1: Advisory Sessions — one-time, low-commitment (4 cards).
     */
    public function strategies(): array
    {
        return $this->tier('strategy', 4, null);
    }

    /**
     * Tier 2: Full Builds — one-time, high-commitment (6 cards).
     */
    public function builds(): array
    {
        return $this->tier('build', 6, null);
    }

    /**
     * Tier 3: Ongoing Care — recurring (5 cards).
     */
    public function retainers(): array
    {
        return $this->tier('care', 5, '/month');
    }

    /**
     * Add-on band items — pills; titles are lorem slots until David
     * defines the real add-on list.
     */
    public function addons(): array
    {
        return [
            ['key' => 'addons.0'],
            ['key' => 'addons.1'],
            ['key' => 'addons.2'],
            ['key' => 'addons.3'],
        ];
    }

    /**
     * Builds one tier's cards. Each card carries: a stable slot key (for
     * lorem generation AND later real-content lookup), the tier badge,
     * and null price gates. Nothing else — by design.
     */
    private function tier(string $group, int $count, ?string $period): array
    {
        $badges = [
            'strategy' => 'Advisory',
            'build' => 'Full Build',
            'care' => 'Ongoing Care',
        ];

        $out = [];
        for ($i = 0; $i < $count; $i++) {
            $out[] = [
                'key' => "{$group}.{$i}",
                'badge' => $badges[$group],
                'title' => null,        // PENDING DAVID — real service name (Q3)
                'description' => null,  // PENDING DAVID — real description
                'best_for' => null,     // PENDING DAVID — real audience line
                'price_ngn' => null,
                'price_usd' => null,
                'price_period' => $period,
            ];
        }

        return $out;
    }
}
```

**Verify:** `php -l app/Services/PricingService.php`

**Why a `tier()` helper instead of 15 hand-written arrays:** fewer places to hand-write prose means fewer places for invented or borrowed copy to sneak in. Every prose field is `null` here and generated in the view — the service is pure structure + gates. When David defines the catalog, he fills `title`/`description`/`best_for` per card (TODO row below) and the same keys drive the view.

---

## TASK 2 — Route + controller method

**`routes/web.php`** — add after the `home` route:

```php
Route::get('/services', [PageController::class, 'services'])->name('services');
```

**`app/Http/Controllers/PageController.php`** — inject `PricingService` and add the method:

```php
use App\Services\PricingService;

class PageController extends Controller
{
    public function __construct(
        protected PreviewService $previewService,
        protected CaseStudyService $caseStudyService,
        protected PricingService $pricingService
    ) {}

    // …existing home() and sitemap() stay exactly as they are…

    public function services(): View
    {
        return view('pages.services', [
            'stats' => $this->pricingService->stats(),
            'strategies' => $this->pricingService->strategies(),
            'builds' => $this->pricingService->builds(),
            'retainers' => $this->pricingService->retainers(),
            'addons' => $this->pricingService->addons(),
            'meta' => [
                'title' => 'Services — Chada Digital',
                'description' => 'Advisory sessions, full builds, and ongoing care — ways to work with Chada Digital.',
                'canonical' => route('services'),
                'ogImage' => asset('og-image.jpg'),
            ],
        ]);
    }
}
```

**Note:** the sitemap from Redesign(5) already contains `Route::has('services')` guarding — with the route now registered, `/services` automatically appears in `/sitemap.xml`. No sitemap edit needed here.

---

## TASK 3 — Create `resources/views/components/stats-badge.blade.php` (NEW)

```blade
@props(['value' => null, 'label' => ''])

<div class="text-center">
    <p class="font-display text-3xl font-bold tracking-tight text-foreground md:text-4xl">{{ $value }}</p>
    <p class="mt-2 text-xs font-medium uppercase tracking-widest text-muted-foreground">{{ $label }}</p>
</div>
```

---

## TASK 4 — Create `resources/views/components/service-card.blade.php` (NEW)

The tiered card anatomy (badge → title → description → audience line → price → button) with lorem slots and null-price fallback:

```blade
@props([
    'service' => [],
])

@php
    $service = $service ?: [];
    $key = $service['key'] ?? 'unknown';
    $hasPrice = ! empty($service['price_ngn']) || ! empty($service['price_usd']);
@endphp

<div class="flex flex-col rounded-2xl border border-border bg-card p-8 transition-all duration-300 hover:-translate-y-1 hover:border-primary/40">
    @if(! empty($service['badge']))
        <span class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">{{ $service['badge'] }}</span>
    @endif

    <h3 class="mt-4 font-display text-lg font-bold tracking-tight">{{ $service['title'] ?? \App\Support\Lorem::title("services.{$key}.title", 3) }}</h3>

    @if(! empty($service['description']))
        <p class="mt-3 text-sm leading-relaxed text-muted-foreground">{{ $service['description'] }}</p>
    @else
        <p class="mt-3 text-sm leading-relaxed text-muted-foreground">{{ \App\Support\Lorem::paragraph("services.{$key}.description", 2, 9) }}</p>
    @endif

    <p class="mt-4 text-xs leading-relaxed text-muted-foreground">
        <span class="font-semibold uppercase tracking-widest text-foreground">Who it is for:</span>
        {{ $service['best_for'] ?? \App\Support\Lorem::sentence("services.{$key}.best_for", 8) }}
    </p>

    <div class="mt-6">
        @if($hasPrice)
            @if(! empty($service['price_ngn']))
                <p class="font-display text-2xl font-bold tracking-tight text-primary">
                    &#8358;{{ number_format((float) $service['price_ngn']) }}{{ $service['price_period'] ?? '' }}
                </p>
            @endif
            @if(! empty($service['price_usd']))
                <p class="text-xs text-muted-foreground">
                    @if(! empty($service['price_ngn']))From @endif
                    ${{ number_format((float) $service['price_usd'], 0) }}{{ $service['price_period'] ?? '' }}
                </p>
            @endif
        @else
            <p class="text-sm font-semibold text-foreground">Contact for pricing</p>
        @endif
    </div>

    <div class="mt-auto pt-6">
        <x-button-primary href="{{ url('/#contact') }}">Get Started</x-button-primary>
    </div>
</div>
```

**Two label decisions:** the audience line label is **"Who it is for:"** (apostrophe-free, Chada chrome) and the CTA is **"Get Started"** — consistent with the goal cards in Redesign(3). Do not swap either for phrasing seen elsewhere.

---

## TASK 5 — Create `resources/views/pages/services.blade.php` (NEW)

```blade
@extends('layouts.app')

@section('content')
    @php
        $stats = collect($stats ?? [])->filter(fn ($s) => ! empty($s['value']))->values();
    @endphp

    <section class="px-6 pt-20 md:pt-28">
        <div class="mx-auto max-w-4xl text-center">
            <x-section-header
                label="Services"
                title="Ways to work with us."
                subtitle="Advisory sessions, full builds, and ongoing care — from one-time strategy to long-term partnership."
                center
            />
        </div>
    </section>

    @if($stats->isNotEmpty())
        <section class="px-6 py-12">
            <div class="mx-auto grid max-w-6xl grid-cols-2 gap-8 rounded-2xl border border-border bg-card px-8 py-10 md:grid-cols-5">
                @foreach($stats as $stat)
                    <x-stats-badge :value="$stat['value']" :label="$stat['label']" />
                @endforeach
            </div>
        </section>
    @endif

    {{-- Free-review band — mirrors the homepage free-review CTA --}}
    <section class="px-6 pb-6">
        <div class="mx-auto max-w-4xl text-center">
            <p class="text-base text-muted-foreground">Undecided? Start with a free review.</p>
            <div class="mt-4">
                <x-button-outline href="{{ url('/#audit') }}">Request a Free Review</x-button-outline>
            </div>
        </div>
    </section>

    {{-- Tier 1: Advisory Sessions --}}
    <section class="px-6 py-16" id="advisory">
        <div class="mx-auto max-w-7xl">
            <x-section-header label="Tier 1" title="Advisory Sessions" subtitle="One-time working sessions that produce a plan you can act on." />
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($strategies as $service)
                    <x-service-card :service="$service" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- Tier 2: Full Builds --}}
    <section class="border-y border-border/60 bg-muted/30 px-6 py-16" id="builds">
        <div class="mx-auto max-w-7xl">
            <x-section-header label="Tier 2" title="Full Builds" subtitle="We design, build, and ship the system for you." />
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($builds as $service)
                    <x-service-card :service="$service" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- Tier 3: Ongoing Care --}}
    <section class="px-6 py-16" id="care">
        <div class="mx-auto max-w-7xl">
            <x-section-header label="Tier 3" title="Ongoing Care" subtitle="Continuous management, optimization, and partnership." />
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($retainers as $service)
                    <x-service-card :service="$service" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- Add-ons + closing CTAs --}}
    <section class="border-t border-border/60 px-6 py-16">
        <div class="mx-auto max-w-4xl text-center">
            <x-section-badge>Add-Ons</x-section-badge>
            <ul class="mx-auto mt-6 flex max-w-2xl flex-wrap items-center justify-center gap-3">
                @foreach($addons as $addon)
                    <li class="rounded-full border border-border bg-card px-4 py-2 text-xs font-medium text-muted-foreground">
                        {{ $addon['title'] ?? \App\Support\Lorem::title("services.{$addon['key']}.title", 3) }}
                    </li>
                @endforeach
            </ul>
            <div class="mt-10 flex flex-wrap justify-center gap-4">
                <x-button-primary href="{{ url('/#contact') }}">Start a Project</x-button-primary>
                <x-button-outline href="{{ url('/#audit') }}">Request a Free Review</x-button-outline>
            </div>
        </div>
    </section>
@endsection
```

**Anchor ids on this page:** `#advisory`, `#builds`, `#care` — these are the targets the footer Services column links to (Redesign(8)).

---

## TASK 6 — Append TODO-Placeholders rows

Append to `TODO-Placeholders.md` (repo root):

> **Reconciliation note (2026-08-28):** the upstream rewrite of `TODO-Placeholders.md` (commit `ed76bea`) already tracks the `/services` pricing rows in its §10 (`PricingService` 15 line items + add-ons). Diff this block against the current file and append only what is genuinely missing — if §10 already covers it, treat this task as a no-op and say so in the PR body.

```markdown
## V4 /services page (Redesign(6).md)

| ✅ | Item | What's needed | Owner |
|---|---|---|---|
| ☐ | `PricingService` → all `price_ngn` / `price_usd` / `price_period` | Real price for each of the 15 service slots. Cards show "Contact for pricing" until set | Founder |
| ☐ | `PricingService` → `title` / `description` / `best_for` per card | Real service catalog definitions (Q3 scope). Until then cards render generated lorem titles | Founder |
| ☐ | `PricingService` → `stats()` | 5 verified numbers for the page-top stats band | Founder |
| ☐ | `PricingService` → `addons()` | Real add-on list (titles land as `title` keys) | Founder |
```

---

## Verification (run all)

```bash
php -l app/Services/PricingService.php
php -l app/Http/Controllers/PageController.php
php artisan route:list | grep services    # expect: GET /services ... services

curl -s -o /dev/null -w "%{http_code} /services\n" http://127.0.0.1:8000/services   # 200
curl -s http://127.0.0.1:8000/services | grep -c "Contact for pricing"               # 15 (all cards)
curl -s http://127.0.0.1:8000/services | grep -c "PENDING DAVID"                     # 0 (stats hidden, values filtered)
curl -s http://127.0.0.1:8000/sitemap.xml | grep -c "/services"                      # 1

# Lorem titles render (spot-check a generated title on the page)
curl -s http://127.0.0.1:8000/services | grep -oE "<h3[^>]*>[A-Z][a-z]+ [a-z]+ [a-z]+</h3>" | head -3

# Nav link from Redesign(3) checklist now resolves:
curl -s -o /dev/null -w "%{http_code} /services via See Services\n" http://127.0.0.1:8000/services

# Originality check (constraint 11) — borrowed service-catalog vocabulary must NOT appear:
curl -s http://127.0.0.1:8000/services | grep -icE "book now|best for:|strategy session|done-for-you" || echo "PASS: no borrowed catalog vocabulary"

bun run dev
```

## Definition of done (this doc)

- [ ] `/services` route registered (name: `services`), controller method added with promoted constructor injection
- [ ] Page renders: header → stats band (hidden while null) → free-review band → Advisory Sessions (4 cards) → Full Builds (6 cards, muted band) → Ongoing Care (5 cards) → add-ons + dual CTAs
- [ ] All 15 cards show generated lorem titles/descriptions/audience lines and "Contact for pricing" (no invented numbers anywhere in the DOM)
- [ ] `/services` appears in the sitemap automatically via the Redesign(5) guard
- [ ] TODO rows appended; `bun run dev` clean
- [ ] Originality grep passes (no borrowed catalog vocabulary in the DOM)
- [ ] Committed on `feat/v4-r6` as `feat(v4-r6): /services page — PricingService, tiered cards, lorem catalog slots`

*End of Redesign(6).md — proceed to Redesign(7).md.*
