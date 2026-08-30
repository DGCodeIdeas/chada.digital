# Redesign(3).md — Homepage Sections A: Hero, Stats, Goal Cards, Free-Review CTA, Checklist, Opt-in, Founder, Testimonials

> **Series:** Redesign(1)–(10) · **This doc:** #3 of 10 (V4 structural; #10 is the V5 visual pivot)
> **V5 note:** The class strings in this doc's Blade code are written in Tailwind (V4). After Phase 10 (`docs/Redesign(10).md`) lands, they migrate to Bootstrap 5 + Material Web Components + custom utility classes per the 24-row migration map in Redesign(10).md §8. **The structural HTML, gating logic, and `data_get()` patterns stay identical under V5** — only class strings change.
> **Builds:** `pages/home.blade.php` (new include order), `partials/hero` (dual CTA + gated proof line), `partials/stats-bar` (NEW), `partials/goal-picker` (Pricing block upgrade), `partials/audit-cta` (renamed from assessment-cta), `partials/working-together` (NEW), `partials/services-checklist` (12-item upgrade), `partials/webinar-optin` (NEW, disabled by default), `partials/founder-bio` (minor), `partials/testimonials` (standards band)
> **Depends on:** Redesign(2).md (data layer — `App\Support\Lorem`, config keys, and CaseStudyService gates must exist first)
> **Scope note:** This doc covers homepage sections 1–9 of the target architecture (Redesign(1).md §2.1). Sections 10–15 are built by Redesign(4), (5), and (7).

```
CONSTRAINTS (repeat in your session — from Redesign(1).md §3):
1.  NEVER touch public/demos/.
2.  mix() not @vite(). 3. bun not npm. 4. ZERO new dependencies
    (App\Support\Lorem is pure PHP — allowed).
5.  Preserve route names. 6. Keep contact honeypot. 7. PHP 8.2 constructor
    promotion. 8. Blade components for reusable markup. 9. Follow the Chada
    style charter. 10. Placeholder prose is GENERATED ($real ?? Lorem::…).
11. ORIGINALITY: never copy third-party text/names/prices/metrics; never
    fetch or quote the reference site; these docs are the only reference.
12. Escape apostrophes in single-quoted PHP strings.
13. bun run dev clean after every change; bun run prod before phase done.
14. NEVER invent real-sounding content — prices/metrics/names wait for David.
```

**How to read the code in this doc:** every prose slot uses the **slot fallback rule** — `{{ $real ?? \App\Support\Lorem::…('slot.key') }}`. When David's real copy lands (config or service), the same expression renders it with zero view changes. Every chrome string (CTA labels, eyebrows, badges) is Chada-original — do not substitute wording you have seen on another agency site.

---

## TASK 1 — Update `resources/views/pages/home.blade.php`

**Action:** Full file replacement. This becomes the final V4 order. Sections 10–15 (demo-lab, workflow-system, case-studies, stats repeat, martech) get their includes added by later docs — this doc adds sections 1–9 and leaves documented insertion comments.

```blade
@extends('layouts.app')

@section('content')
    @include('partials.hero')               {{-- 1. hero (upgraded, dual CTA) --}}
    @include('partials.stats-bar', ['variant' => 'home_top'])  {{-- 2. NEW — guarded while stats are null --}}
    @include('partials.trust-bar')          {{-- 3. guarded until logos exist --}}
    @include('partials.goal-picker')        {{-- 4. upgraded — Pricing block --}}
    @include('partials.audit-cta')          {{-- 5. renamed + reframed (was assessment-cta) --}}
    @include('partials.working-together')   {{-- 6. NEW — transition band --}}
    @include('partials.services-checklist') {{-- 7. upgraded — 12-item checklist --}}
    @include('partials.webinar-optin')      {{-- 8. NEW — renders nothing while disabled --}}
    @include('partials.founder-bio')        {{-- 9. kept --}}
    {{-- Redesign(7) inserts: @include('partials.demo-lab') and Redesign(4) inserts: @include('partials.workflow-system') here --}}
    {{-- Redesign(5) inserts: @include('partials.case-studies') and @include('partials.stats-bar', ['variant' => 'home_bottom']) here --}}
    @include('partials.testimonials')       {{-- 14. upgraded — standards band above --}}
    {{-- Redesign(7) inserts: @include('partials.martech') here --}}
    @include('partials.exclusivity-cta')    {{-- 16. kept --}}
    @include('partials.contact')            {{-- 17. untouched --}}
@endsection
```

**Note:** Blade `{{-- --}}` comments do not render. The comments document where later docs insert their lines — an agent executing doc 4/5/7 replaces the comment with the real include. Do not leave the comment AND add the include; replace.

---

## TASK 2 — Upgrade `resources/views/partials/hero.blade.php`

**Change:** add the secondary CTA, read labels from config, and gate the proof line. The headline and subhead become lorem slots. Layout, eyebrow, and highlighted-last-word pattern stay as-is (style charter §5.2 rule 3).

```blade
@php
    $hero = config('placeholders.hero');
    $headline = \App\Support\Lorem::title('hero.headline', 6);
    $words = explode(' ', $headline);
    $last = array_pop($words);
@endphp
<section class="relative overflow-hidden bg-muted/30 px-6 pb-20 pt-12 md:pt-20" id="hero">
    <div class="relative mx-auto max-w-3xl text-center">
        <div class="flex flex-col items-center">
            <span class="mb-5 inline-block text-xs font-semibold uppercase tracking-[0.3em] text-primary">Based in Lagos &middot; Serving the World</span>
            <h1 class="font-display text-4xl font-bold leading-[1.1] tracking-tight md:text-5xl">
                {{ implode(' ', $words) }}<br/><span class="text-primary">{{ $last }}</span>
            </h1>
            <p class="mt-6 max-w-xl text-base leading-relaxed text-muted-foreground md:text-lg">{{ \App\Support\Lorem::paragraph('hero.subhead', 2, 12) }}</p>
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <a class="group inline-flex items-center gap-2 rounded-full bg-primary px-7 py-3.5 text-xs font-semibold uppercase tracking-widest text-primary-foreground transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30" href="{{ url('/#contact') }}">
                    {{ $hero['primary_cta'] ?? 'Start a Project' }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4 transition-transform group-hover:translate-x-1"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
                <a class="group inline-flex items-center gap-2 rounded-full border border-border bg-card px-7 py-3.5 text-xs font-semibold uppercase tracking-widest text-foreground transition-all hover:border-primary/40 hover:text-primary" href="{{ route('work') }}">
                    {{ $hero['secondary_cta'] ?? 'Explore Our Work' }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4 transition-transform group-hover:translate-y-1"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg>
                </a>
            </div>
            @if(! empty($hero['proof_line']))
                <p class="mt-10 text-sm font-medium uppercase tracking-widest text-muted-foreground">{{ $hero['proof_line'] }}</p>
            @endif
        </div>
    </div>
</section>
```

**Two decisions encoded here:**
1. **Proof line is now gated.** The pre-V4 hero hardcoded a "trusted by N" style line. Unverified social claims are constraint-14 content — it renders nothing until David sets `placeholders.hero.proof_line` with a number he can stand behind.
2. **Secondary CTA targets `/work`**, not an in-page anchor — it converts the "browse" intent into the results archive, which is a real page from this doc series onward (relabeled by Redesign(5)).

---

## TASK 3 — Create `resources/views/partials/stats-bar.blade.php` (NEW)

**Pattern:** a slim, full-width band of 4 big numbers. **Guard rule:** renders nothing while every `value` in the variant is null (same philosophy as the trust bar — no empty shells, no fake numbers).

```blade
@php
    $variant = $variant ?? 'home_top';
    $stats = config("placeholders.stats.{$variant}", []);
    $ready = collect($stats)->filter(fn ($s) => ! empty($s['value']))->values();
@endphp
@if($ready->isNotEmpty())
    <section class="border-y border-border/60 bg-card/60 px-6 py-10" aria-label="Results">
        <div class="mx-auto grid max-w-7xl grid-cols-2 gap-8 md:grid-cols-4">
            @foreach($ready as $stat)
                <div class="text-center">
                    <p class="font-display text-3xl font-bold tracking-tight text-foreground md:text-4xl">{{ $stat['value'] }}</p>
                    <p class="mt-2 text-xs font-medium uppercase tracking-widest text-muted-foreground">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </section>
@endif
```

**Usage:** `@include('partials.stats-bar', ['variant' => 'home_top'])` and later `['variant' => 'home_bottom']`. Both variants are null today → the section renders nothing. The moment David fills `home_top`, it appears — no further code change. **Labels travel with values:** the suggested labels in config are placeholders for David to overwrite; a stat with a value but a `PENDING`-prefixed label must not ship (grep gate 1 in Redesign(9) catches it).

---

## TASK 4 — Upgrade `resources/views/partials/goal-picker.blade.php` (Pricing block)

**Pattern:** each offer card shows a tier badge, an outcome-framed title, a description, then a **price block** — label, amount, period — then the CTA. Titles and descriptions are lorem slots keyed by card index. With `price_ngn` null the card shows "Contact for pricing" — the visual structure is present, the number waits for David.

```blade
@php
    $offers = config('placeholders.offers');
@endphp

<section class="px-6 py-20 md:py-28" id="goals">
    <div class="mx-auto max-w-7xl">
        <div class="mb-14 text-center">
            <x-section-badge>Services</x-section-badge>
            <x-section-heading class="mt-4">Pick your <span class="text-primary">starting point.</span></x-section-heading>
            <p class="mt-4 mx-auto max-w-2xl text-base text-muted-foreground">{{ \App\Support\Lorem::sentence('goal-picker.sub', 14) }}</p>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($offers as $i => $offer)
                <div class="group flex flex-col rounded-2xl border border-border bg-card p-8 transition-all duration-300 hover:-translate-y-1 hover:border-primary/40">
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">{{ $offer['badge'] ?? sprintf('OPTION %02d', $loop->iteration) }}</span>
                    <h3 class="mt-4 font-display text-lg font-bold tracking-tight">{{ $offer['title'] ?? \App\Support\Lorem::title("offers.{$i}.title", 4) }}</h3>
                    <p class="mt-3 text-sm leading-relaxed text-muted-foreground">{{ $offer['description'] ?? \App\Support\Lorem::paragraph("offers.{$i}.description", 2, 9) }}</p>

                    {{-- Pricing block — structure now, numbers when David sets them --}}
                    <div class="mt-6 rounded-xl border border-border/60 bg-background/60 px-4 py-3">
                        <span class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Pricing</span>
                        @if(! empty($offer['price_ngn']))
                            <p class="mt-1 font-display text-2xl font-bold tracking-tight text-primary">
                                &#8358;{{ number_format((float) $offer['price_ngn']) }}{{ $offer['price_period'] ?? '' }}
                            </p>
                            @if(! empty($offer['price_usd']))
                                <p class="text-xs text-muted-foreground">${{ number_format((float) $offer['price_usd'], 0) }}{{ $offer['price_period'] ?? '' }}</p>
                            @endif
                        @else
                            <p class="mt-1 text-sm font-semibold text-foreground">Contact for pricing</p>
                        @endif
                    </div>

                    <div class="mt-auto pt-6">
                        <x-button-outline href="{{ url('/#contact') }}">{{ $offer['cta_label'] ?? 'Get Started' }}</x-button-outline>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
```

**Notes:**
- The block label is **"Pricing"** — a plain functional label from Chada's chrome vocabulary (§4 kind A). Do not rename it to a marketing-flavored label borrowed from anywhere.
- Badge fallback uses `$loop->iteration` — loop-safe, no `$index` variable needed.
- When David defines the real six offers, he fills `title`/`description` per card in config; the `??` fallbacks go dormant. **Never** pre-fill those keys with invented service copy.

---

## TASK 5 — Rename `assessment-cta.blade.php` → `audit-cta.blade.php` and reframe

**Action:**
1. `git mv resources/views/partials/assessment-cta.blade.php resources/views/partials/audit-cta.blade.php`
2. Replace contents with the free-review framing. Headline and body are lorem slots; the CTA label is chrome.

```blade
@php
    $audit = config('placeholders.audit');
@endphp

<section class="px-6 py-16 md:py-20" id="audit">
    <div class="mx-auto max-w-3xl text-center rounded-2xl border border-primary/20 bg-primary/5 px-8 py-12">
        <x-section-badge>Free Review</x-section-badge>
        <x-section-heading class="mt-4">{{ $audit['headline'] ?? \App\Support\Lorem::sentence('audit.headline', 11) }}</x-section-heading>
        <p class="mt-4 text-base text-muted-foreground">{{ $audit['body'] ?? \App\Support\Lorem::paragraph('audit.body', 2, 12) }}</p>
        <div class="mt-8">
            <x-button-primary href="{{ url('/#contact') }}">{{ $audit['cta_label'] ?? 'Request a Free Review' }}</x-button-primary>
        </div>
    </div>
</section>
```

3. Confirm `home.blade.php` (Task 1) references `partials.audit-cta` — it does.
4. Grep for stale references: `grep -rn "assessment-cta" resources/ routes/ app/` → expect zero hits.

**Content note:** when David writes the real free-review offer, it lands as `placeholders.audit.headline` / `body`. The lorem that renders today is intentionally generic filler — resist the urge to "improve" it by writing something that sounds like a real agency's pitch. That instinct is exactly what constraint 11 exists to block.

---

## TASK 6 — Create `resources/views/partials/working-together.blade.php` (NEW)

**Pattern:** a small transition band between the free-review CTA and the checklist. Both lines are lorem slots.

```blade
<section class="px-6 py-12 md:py-16" id="working-together">
    <div class="mx-auto max-w-4xl text-center">
        <h2 class="font-display text-2xl font-bold uppercase tracking-wide md:text-3xl">{{ \App\Support\Lorem::title('working-together.headline', 6) }}</h2>
        <p class="mt-3 text-sm font-medium uppercase tracking-widest text-muted-foreground">{{ \App\Support\Lorem::sentence('working-together.subhead', 8) }}</p>
    </div>
</section>
```

---

## TASK 7 — Upgrade `resources/views/partials/services-checklist.blade.php` (12-item pattern)

**Pattern:** one intro paragraph, then a flat 12-item checklist (two columns on desktop, check icons per item), with "See Services" + "Get In Touch" CTAs. This replaces the current 4-card grid. The 12 items are REAL Chada capabilities from `placeholders.checklist.items` (Redesign(2)) — the one section allowed real content. The intro paragraph is a lorem slot pending approved copy.

```blade
@php
    $checklist = config('placeholders.checklist');
@endphp

<section class="px-6 py-20 md:py-28" id="services-checklist">
    <div class="mx-auto max-w-7xl">
        <div class="mb-12 max-w-3xl">
            <x-section-badge>What We Do</x-section-badge>
            <x-section-heading class="mt-4">Everything we <span class="text-primary">bring to the table.</span></x-section-heading>
            <p class="mt-4 text-base leading-relaxed text-muted-foreground">{{ $checklist['intro'] ?? \App\Support\Lorem::paragraph('checklist.intro', 2, 12) }}</p>
        </div>
        <div class="grid gap-3 sm:grid-cols-2">
            @foreach($checklist['items'] as $item)
                <div class="flex items-center gap-3 rounded-xl border border-border bg-card px-5 py-4">
                    <span class="inline-flex size-6 shrink-0 items-center justify-center rounded-full bg-primary/15 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="size-3.5"><path d="M20 6 9 17l-5-5"/></svg>
                    </span>
                    <span class="text-sm font-medium text-foreground">{{ $item }}</span>
                </div>
            @endforeach
        </div>
        <div class="mt-10 flex flex-wrap gap-4">
            <x-button-primary href="{{ url('/services') }}">See Services</x-button-primary>
            <x-button-outline href="{{ url('/#contact') }}">Get In Touch</x-button-outline>
        </div>
    </div>
</section>
```

**⚠️ Dependency:** the "See Services" button links to `/services`, which Redesign(6) creates. If doc 6 is not merged yet, link to `url('/#goals')` temporarily and swap when the route lands — do not ship a 404 link.

---

## TASK 8 — Create `resources/views/partials/webinar-optin.blade.php` (NEW, disabled by default)

**Pattern:** gated-content opt-in with a six-field form. Chada has no replay/masterclass asset, so `placeholders.webinar.enabled` is `false` → the partial renders **nothing** today. The markup ships ready: when David flips the flag and provides copy, the form posts through the existing honeypot-protected `/api/contact` pipeline with a `form_type` marker.

```blade
@php
    $webinar = config('placeholders.webinar');
@endphp

@if(! empty($webinar['enabled']))
    <section class="px-6 py-20 md:py-28" id="webinar">
        <div class="mx-auto max-w-5xl overflow-hidden rounded-2xl border border-border bg-card">
            <div class="grid md:grid-cols-2">
                <div class="p-10 md:p-12">
                    <x-section-badge>{{ $webinar['subhead'] ?? \App\Support\Lorem::title('webinar.subhead', 3) }}</x-section-badge>
                    <x-section-heading class="mt-4">{{ $webinar['headline'] ?? \App\Support\Lorem::title('webinar.headline', 6) }}</x-section-heading>
                    <p class="mt-4 text-sm leading-relaxed text-muted-foreground">{{ \App\Support\Lorem::paragraph('webinar.body', 2, 10) }}</p>
                </div>
                <div class="border-t border-border bg-background/40 p-10 md:border-l md:border-t-0 md:p-12">
                    <form action="{{ route('contact.submit') }}" method="POST" class="chada-form space-y-4" data-form-type="webinar">
                        @csrf
                        <input type="hidden" name="form_type" value="webinar" />
                        {{-- Honeypot — required by constraint 6; copy the exact field name from partials/contact-form.blade.php --}}
                        <input type="text" name="website" value="" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true" />
                        <div class="grid gap-4 sm:grid-cols-2">
                            <input type="text" name="first_name" placeholder="First Name" required class="w-full rounded-xl border border-border bg-card px-4 py-3 text-sm" />
                            <input type="text" name="last_name" placeholder="Last Name" required class="w-full rounded-xl border border-border bg-card px-4 py-3 text-sm" />
                        </div>
                        <input type="email" name="email" placeholder="Email Address" required class="w-full rounded-xl border border-border bg-card px-4 py-3 text-sm" />
                        <input type="tel" name="phone" placeholder="Phone Number" class="w-full rounded-xl border border-border bg-card px-4 py-3 text-sm" />
                        <div class="grid gap-4 sm:grid-cols-2">
                            <input type="text" name="company" placeholder="Company" class="w-full rounded-xl border border-border bg-card px-4 py-3 text-sm" />
                            <input type="text" name="job_title" placeholder="Job Title" class="w-full rounded-xl border border-border bg-card px-4 py-3 text-sm" />
                        </div>
                        <button type="submit" class="w-full rounded-full bg-primary px-6 py-3.5 text-xs font-semibold uppercase tracking-widest text-primary-foreground transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30">
                            {{ $webinar['cta_label'] ?? 'Get the Replay' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endif
```

**Two implementation notes:**
1. **Honeypot field name:** open `resources/views/partials/contact-form.blade.php` first and copy the EXACT honeypot input it uses (name, class, wrapper). Do not invent a second honeypot convention — `ContactController` validates a specific field. If the existing form's honeypot is named differently (e.g. `company_website`), use that name here.
2. **Form submission JS:** the existing `initChadaContactForm()` binds to a specific selector. Either (a) give this form the same selector/class the module expects, or (b) accept standard POST + redirect for v1. Check `resources/js/modules/contact-form.js` and match its binding. Do not write new AJAX code if the existing module can be reused by selector.

---

## TASK 9 — Minor update to `resources/views/partials/founder-bio.blade.php`

**Change:** swap the hardcoded lorem paragraph for generated slots and add the CTA. The heading stays a fixed functional label (chrome) — the *name* is a lorem slot until `founder.real` flips.

Replace the `<x-section-heading>` line with:

```blade
<x-section-badge>About</x-section-badge>
<x-section-heading class="mt-4">Meet <span class="text-primary">the founder.</span></x-section-heading>
```

Swap the hardcoded intro paragraph for:

```blade
{{ $founder['bio'] ?? \App\Support\Lorem::paragraph('founder.bio', 2, 12) }}
```

Render the name and title as slots wherever the current file shows them:

```blade
{{ $founder['name'] ?? \App\Support\Lorem::name('founder') }}
{{ $founder['title'] ?? \App\Support\Lorem::title('founder.role', 3) }}
```

Render the credibility bullets as three generated slots (or real bullets when they land):

```blade
<ul>
    @foreach(range(0, 2) as $i)
        <li>{{ $founder['bio_points'][$i] ?? \App\Support\Lorem::sentence("founder.point.{$i}", 10) }}</li>
    @endforeach
</ul>
```

And after the `</ul>` closing the bio points:

```blade
<div class="mt-8">
    <x-button-primary href="{{ url('/#contact') }}">{{ $founder['cta_label'] ?? 'Start a Conversation' }}</x-button-primary>
</div>
```

**Note:** keep the existing silhouette placeholder photo + `founder.photo` path behavior. The whole section renders generated placeholder content until `placeholders.founder.real` is `true` — at that point David supplies `name`, `title`, `bio`, `bio_points`, and the real photo (and Redesign(8) activates the JSON-LD Person node).

---

## TASK 10 — Upgrade `resources/views/partials/testimonials.blade.php` (standards band)

**Pattern:** above the quote cards sits an optional standards/principles band (config-gated — do not invent principles). Quote cards render real entries from `placeholders.testimonials` when David supplies them with permission; while that array is empty, exactly three cards render generated lorem quotes with generated attribution.

```blade
@php
    $testimonials = config('placeholders.testimonials');
    $manifesto = config('placeholders.manifesto');
    $real = collect($testimonials)->filter(fn ($t) => ! empty($t['quote']))->values();
    $cards = $real->isNotEmpty() ? $real : collect(range(0, 2));
@endphp

<section class="px-6 py-20 md:py-28" id="testimonials">
    <div class="mx-auto max-w-7xl">
        <div class="mb-14 text-center">
            <x-section-badge>Testimonials</x-section-badge>
            <x-section-heading class="mt-4">What clients <span class="text-primary">say.</span></x-section-heading>
        </div>

        @if(! empty($manifesto['enabled']) && ! empty($manifesto['items']))
            <div class="mb-12 rounded-2xl border border-border bg-card/60 px-8 py-8 text-center">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">{{ $manifesto['label'] ?? 'Our Standards' }}</p>
                <p class="mt-3 font-display text-xl font-bold tracking-tight md:text-2xl">
                    {{ implode(' &middot; ', $manifesto['items']) }}
                </p>
            </div>
        @endif

        {{-- Static grid v1 — no carousel library present in resources/js/modules/.
             A carousel can be added later as an enhancement if desired. --}}
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($cards as $i => $card)
                @php
                    $quote = $card['quote'] ?? \App\Support\Lorem::paragraph("testimonials.{$i}.quote", 2, 14);
                    $name = $card['name'] ?? \App\Support\Lorem::name("testimonials.{$i}");
                    $role = $card['role'] ?? \App\Support\Lorem::title("testimonials.{$i}.role", 3) . ', ' . \App\Support\Lorem::title("testimonials.{$i}.org", 2) . ' Ltd.';
                @endphp
                <div class="rounded-2xl border border-border bg-card p-8">
                    <p class="text-sm leading-relaxed text-muted-foreground">{{ $quote }}</p>
                    <div class="mt-6 border-t border-border/40 pt-6">
                        <p class="font-display text-sm font-bold">{{ $name }}</p>
                        <p class="mt-1 text-xs text-muted-foreground">{{ $role }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
```

**Why the `real` check matters:** lorem quote cards are obviously fake to any human reviewer, which is the point — they hold the layout until real quotes arrive WITH permission (Q5). If a quote ever ships without documented permission, that is a content incident of the same class as PR #5. The lorem cards make silence the default.

---

## Verification (run all)

```bash
# 1. No stale references to the renamed partial
grep -rn "assessment-cta" resources/ app/ routes/ && echo "FAIL: stale reference" || echo "PASS"

# 2. All included partials exist (every @include target must resolve)
for p in hero stats-bar trust-bar goal-picker audit-cta working-together services-checklist webinar-optin founder-bio testimonials exclusivity-cta contact; do
  test -f "resources/views/partials/${p}.blade.php" && echo "PASS ${p}" || echo "FAIL ${p} missing"
done

# 3. Config keys referenced by the new partials all exist
php artisan tinker --execute="
foreach (['lorem_seed','hero','stats.home_top','offers','audit','checklist','webinar','testimonials','manifesto','founder'] as \$k) {
    echo \$k . ': ' . (config('placeholders.' . \$k) !== null ? 'OK' : 'MISSING') . PHP_EOL;
}"

# 4. Lorem generator determinism (same request, same output)
php artisan tinker --execute="
use App\Support\Lorem;
echo (Lorem::sentence('verify.hero', 10) === Lorem::sentence('verify.hero', 10)) ? 'PASS deterministic' : 'FAIL';"

# 5. Assets still build
bun run dev

# 6. Homepage renders (dev server up) — expect: NO stats bar (guarded), NO
#    webinar section (disabled), NO standards band (disabled), NO proof line
#    (gated), goal cards showing "Contact for pricing", and lorem prose in
#    hero/goal/audit/checklist/founder/testimonials slots.
# 7. Originality spot-check (constraint 11) — none of these may appear in
#    the rendered HTML:
curl -s http://127.0.0.1:8000/ | grep -icE "book now|learn more|investment" || echo "PASS: no borrowed CTA vocabulary"
```

## Definition of done (this doc)

- [ ] `home.blade.php` shows the 11 live includes in the correct order with the documented insertion comments for docs 4/5/7
- [ ] Hero renders dual CTA ("Start a Project" → `#contact`, "Explore Our Work" → `/work`); proof line absent while null; headline/subhead are generated lorem
- [ ] stats-bar exists and renders nothing (guarded) — verified by viewing source: no `aria-label="Results"` section
- [ ] Goal cards show the Pricing block with "Contact for pricing" fallback; titles/descriptions are generated lorem; badges are Chada tier chrome
- [ ] `assessment-cta` renamed to `audit-cta`; grep clean
- [ ] working-together band renders with generated copy
- [ ] services-checklist renders the 12 real capability items with See Services / Get In Touch CTAs (no 404 link)
- [ ] webinar-optin file exists; renders nothing while disabled
- [ ] founder-bio shows "Meet the founder." + generated slots + CTA
- [ ] testimonials renders 3 lorem cards; standards band absent while disabled
- [ ] Zero hand-written marketing prose added anywhere (grep the diff: prose slots all route through `Lorem::…`)
- [ ] `bun run dev` clean; committed on `feat/v4-r3` as `feat(v4-r3): homepage sections A — hero dual CTA, stats bar, pricing blocks, free-review CTA, checklist, optin, founder, testimonials`
- [ ] Verification step 7 passes (no borrowed CTA vocabulary in the DOM)

*End of Redesign(3).md — proceed to Redesign(4).md.*
