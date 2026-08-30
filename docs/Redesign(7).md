# Redesign(7).md — Demo Lab (Interactive Demo Tabs) + MarTech Integrations Grid

> **Series:** Redesign(1)–(10) · **This doc:** #7 of 10 (V4 structural; #10 is the V5 visual pivot)
> **V5 note:** The class strings in this doc's Blade code are written in Tailwind (V4). After Phase 10 (`docs/Redesign(10).md`) lands, they migrate to Bootstrap 5 + Material Web Components + custom utility classes per the 24-row migration map in Redesign(10).md §8 (row 17 covers `demo-lab` with `<md-tabs>`, row 18 covers `martech-grid`). **The structural HTML, gating logic, demo tab behavior, and MarTech filter behavior stay identical under V5** — only class strings change.
> **Builds:** `resources/views/partials/demo-lab.blade.php` (NEW), `resources/views/partials/martech.blade.php` (NEW), `resources/js/app.js` (+ tab + filter modules), one-line insert into `pages/home.blade.php`
> **Depends on:** Redesign(2).md (config), Redesign(5).md (home include positions)
> **Why this matters:** this is the section no prior spec captured — a tabbed block of **fully interactive system demos**. **Chada already owns six real interactive demos** in `public/demos/` — this doc turns them into the pattern with zero new build for the demo content itself, and with honest Chada-original chrome (no borrowed microcopy, no emoji tabs, no faked API-status badges).

```
CONSTRAINTS (repeat in your session — from Redesign(1).md §3):
1.  NEVER touch public/demos/.
2.  mix() not @vite(). 3. bun not npm. 4. ZERO new dependencies.
5.  Preserve route names. 6. Keep contact honeypot. 7. PHP 8.2 constructor
    promotion. 8. Blade components for reusable markup. 9. Follow the Chada
    style charter. 10. Placeholder prose is GENERATED ($real ?? Lorem::…).
11. ORIGINALITY: never copy third-party text/names/prices/metrics; never
    fetch or quote the reference site; these docs are the only reference.
12. Escape apostrophes in single-quoted PHP strings.
13. bun run dev clean after every change; bun run prod before phase done.
14. NEVER invent real-sounding content — demos render only real Chada demo
    projects; martech tools limited to the approved services stack.
```

---

## 0. The demo-lab pattern (abstract)

The section renders:

```
[eyebrow]                    — "Proof of Build"
SEE THE SYSTEMS IN ACTION.   — display heading (H2)
[supporting sentence]        — Chada-original, fixed
[tab bar]                    — one text tab per demo (role=tablist)
[panel per tab]              — chrome bar + embedded iframe + footer row
```

Each **tab** is plain text — the demo's own title (from `PreviewService`), no icons, no emoji (style charter §5.2 rule 5).

Each **panel** contains:
- a **chrome bar**: emerald live-pulse dot + the demo's title and description (from `PreviewService`) + an emerald chip reading **"Live demo"** — honest: it describes what the panel is, it does not fake an API status or a third-party product's presence,
- the **real demo embedded** via `<iframe src="{{ route('preview.show', $slug) }}">`, lazy-loaded,
- a **footer row**: a hint line + "Open full screen" link to the same route in a new tab.

**Chada's advantage (the honest version of this pattern):** instead of building mock funnels, we embed the **real** demo sites — Sterling & Vale's inquiry funnel, ELYSIAN's booking flow, NOIR's storefront, ApexFlow's onboarding, HIREBASE's job board, TimberMill's catalog. The demos are the proof; the tab UI is the pattern. This section ships **today** with real interactive content and zero fabricated claims.

**⚠️ Originality note (constraint 11):** an earlier internal draft quoted another site's intro copy, tab labels, and chat-chrome microcopy for this section. That draft is dead. Everything in this doc — "Proof of Build", "See the systems in action.", "Live demo", "Open full screen", text-only tabs — is Chada's own expression of the pattern. Build exactly this.

---

## TASK 1 — Create `resources/views/partials/demo-lab.blade.php` (NEW)

```blade
@php
    $demos = app(\App\Services\PreviewService::class)->all();
@endphp

<section class="border-y border-border/60 bg-muted/30 px-6 py-20 md:py-28" id="demo-lab">
    <div class="mx-auto max-w-7xl">
        <div class="mb-12 max-w-3xl">
            <span class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">Proof of Build</span>
            <h2 class="mt-4 font-display text-3xl font-bold tracking-tight md:text-5xl">See the systems <span class="text-primary">in action.</span></h2>
            <p class="mt-4 text-base leading-relaxed text-muted-foreground">
                Every tab below is a real, working demo we designed and built — click through it like a visitor would.
            </p>
        </div>

        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-muted-foreground">Choose a system</p>

        {{-- Tab bar: plain text tabs, no icons (style charter) --}}
        <div class="mt-4 flex flex-wrap gap-2" role="tablist" aria-label="System demos">
            @foreach($demos as $slug => $demo)
                <button
                    type="button"
                    class="demo-tab inline-flex items-center rounded-full border px-5 py-2.5 text-sm font-medium transition-all duration-300 {{ $loop->first ? 'border-primary/40 bg-primary/10 text-primary' : 'border-border bg-card/50 text-foreground hover:bg-primary/10 hover:text-primary' }}"
                    data-demo="{{ $slug }}"
                    role="tab"
                    aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                >
                    {{ $demo['title'] }}
                </button>
            @endforeach
        </div>

        {{-- Panels: honest live-demo chrome + iframe per demo --}}
        <div class="mt-8">
            @foreach($demos as $slug => $demo)
                <div
                    class="demo-panel rounded-2xl border border-border bg-card p-4 md:p-6 {{ $loop->first ? '' : 'hidden' }}"
                    data-demo-panel="{{ $slug }}"
                    role="tabpanel"
                >
                    {{-- Chrome bar: live-pulse dot + demo identity + honest chip --}}
                    <div class="mb-4 flex flex-wrap items-center justify-between gap-3 rounded-xl border border-border/60 bg-background/60 px-4 py-3">
                        <div class="flex items-center gap-3">
                            <span class="relative inline-flex size-2.5">
                                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-60"></span>
                                <span class="relative inline-flex size-2.5 rounded-full bg-emerald-500"></span>
                            </span>
                            <span class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">{{ $demo['title'] }} System</span>
                            <span class="hidden text-xs text-muted-foreground sm:inline">{{ $demo['description'] }}</span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="size-3" aria-hidden="true"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                            Live demo
                        </span>
                    </div>

                    {{-- The real demo, embedded --}}
                    <div class="overflow-hidden rounded-xl border border-border bg-background">
                        <iframe
                            src="{{ route('preview.show', $slug) }}"
                            title="{{ $demo['title'] }} — interactive demo"
                            loading="lazy"
                            class="h-[560px] w-full"
                        ></iframe>
                    </div>

                    <div class="mt-4 flex flex-wrap items-center justify-between gap-3">
                        <p class="text-xs text-muted-foreground">Fully interactive — explore it like a visitor would.</p>
                        <a href="{{ route('preview.show', $slug) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:underline">
                            Open full screen
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3.5"><path d="M7 7h10v10"/><path d="M7 17 17 7"/></svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
```

**Chrome honesty rule (constraint 14 adjacent):** the chip says "Live demo" with a bolt icon because that is literally true — the panel embeds a live, interactive Chada build. It must never display a third-party product name, an "API Active" style status, or any integration claim that is not real. If David later wants a specific integration badge, it lands per-demo with evidence.

---

## TASK 2 — Tab-switching JS (jQuery, inside `resources/js/app.js`)

Add to `resources/js/app.js` (inside the existing `$(() => { ... })` DOM-ready block, after `initShowcaseFilters();`):

```js
// Demo Lab tabs (Redesign(7).md — tabbed interactive demos pattern)
initDemoTabs();

/**
 * Toggles demo-lab panels. Tab buttons carry data-demo="{slug}";
 * panels carry data-demo-panel="{slug}". First panel is visible by default.
 */
function initDemoTabs() {
    const $tabs = $('.demo-tab');
    const $panels = $('.demo-panel');
    if (!$tabs.length || !$panels.length) return;

    const activeClasses = ['border-primary/40', 'bg-primary/10', 'text-primary'];
    const idleClasses = ['border-border', 'bg-card/50', 'text-foreground'];

    $tabs.on('click', function () {
        const $tab = $(this);
        const demo = $tab.data('demo');

        $tabs.each(function () {
            const $t = $(this);
            $t.removeClass(activeClasses).addClass(idleClasses);
            $t.attr('aria-selected', 'false');
        });
        $tab.removeClass(idleClasses).addClass(activeClasses);
        $tab.attr('aria-selected', 'true');

        $panels.addClass('hidden');
        $panels.filter(`[data-demo-panel="${demo}"]`).removeClass('hidden');
    });
}
```

**Note:** `initDemoTabs` is declared after use inside the ready block — hoisting handles it (function declaration). If your linter complains, move the function above the ready block next to `initShowcaseFilters`.

---

## TASK 3 — Create `resources/views/partials/martech.blade.php` (NEW)

**Pattern:** intro copy, a filter pill row, then tool cards — each with an uppercase category label, tool name, and an **honest** readiness badge. Filtering is client-side. Chada's tool list comes from `placeholders.martech.tools` (Redesign(2)) — real, approved stack items only. The sub-intro is a lorem slot (`subintro` is null) until David approves a real line.

```blade
@php
    $martech = config('placeholders.martech');
    $categories = $martech['categories'] ?? [];
    $tools = $martech['tools'] ?? [];
@endphp

<section class="px-6 py-20 md:py-28" id="martech">
    <div class="mx-auto max-w-7xl">
        <div class="mb-12 max-w-3xl">
            <span class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">Integrations</span>
            <h2 class="mt-4 font-display text-3xl font-bold tracking-tight md:text-5xl">
                We plug into the <span class="text-primary">stack you already run.</span>
            </h2>
            <p class="mt-4 text-base leading-relaxed text-muted-foreground">{{ $martech['subintro'] ?? \App\Support\Lorem::paragraph('martech.subintro', 2, 11) }}</p>
        </div>

        @if(! empty($categories))
            <p class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Filter by:</p>
            <div class="mt-3 flex flex-wrap gap-2">
                @foreach($categories as $index => $category)
                    <button
                        type="button"
                        class="martech-filter-btn inline-flex items-center rounded-full border px-5 py-2.5 text-sm font-medium transition-all duration-300 {{ $index === 0 ? 'border-primary/40 bg-primary/10 text-primary' : 'border-border bg-card/50 text-foreground hover:bg-primary/10 hover:text-primary' }}"
                        data-category="{{ $category === 'All Tools' ? 'all' : $category }}"
                    >
                        {{ $category }}
                    </button>
                @endforeach
            </div>
        @endif

        <div class="martech-grid mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($tools as $tool)
                <div
                    class="martech-card flex items-center justify-between gap-4 rounded-2xl border border-border bg-card p-6 transition-all duration-300 hover:border-primary/40"
                    data-category="{{ $tool['category'] }}"
                >
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">{{ $tool['category'] }}</p>
                        <p class="mt-1.5 font-display text-base font-bold tracking-tight">{{ $tool['name'] }}</p>
                    </div>
                    <span class="inline-flex shrink-0 items-center gap-1.5 rounded-full bg-emerald-500/10 px-3 py-1.5 text-xs font-semibold text-emerald-600">
                        <span class="inline-flex size-1.5 rounded-full bg-emerald-500"></span>
                        READY
                    </span>
                </div>
            @endforeach
        </div>

        <p class="martech-empty hidden mt-8 text-center text-sm text-muted-foreground">
            Nothing in this category yet.
        </p>
    </div>
</section>
```

---

## TASK 4 — MarTech filter JS (append to `resources/js/app.js`)

```js
// MarTech category filter (Redesign(7).md — filterable integrations grid)
initMartechFilters();

/**
 * Filters .martech-card elements by data-category. "all" shows everything.
 */
function initMartechFilters() {
    const $buttons = $('.martech-filter-btn');
    const $cards = $('.martech-card');
    const $empty = $('.martech-empty');
    if (!$buttons.length || !$cards.length) return;

    $buttons.on('click', function () {
        const $btn = $(this);
        const category = $btn.data('category');

        $buttons.removeClass('border-primary/40 bg-primary/10 text-primary')
            .addClass('border-border bg-card/50 text-foreground');
        $btn.removeClass('border-border bg-card/50 text-foreground')
            .addClass('border-primary/40 bg-primary/10 text-primary');

        let visible = 0;
        $cards.each(function () {
            const $card = $(this);
            const show = category === 'all' || $card.data('category') === category;
            $card.toggle(show);
            if (show) visible++;
        });
        $empty.toggleClass('hidden', visible > 0);
    });
}
```

---

## TASK 5 — Insert includes into `pages/home.blade.php`

Replace the remaining insertion comment left by Redesign(4):

```blade
{{-- Redesign(7) inserts: @include('partials.demo-lab') above this line --}}
```

with:

```blade
@include('partials.demo-lab')             {{-- 10. NEW — tabbed interactive system demos --}}
```

and after `@include('partials.testimonials')` add:

```blade
@include('partials.martech')              {{-- 15. NEW — filterable integrations grid --}}
```

Final homepage include order after this doc (verify against Redesign(1).md §2.1):
`hero → stats-bar(top) → trust-bar → goal-picker → audit-cta → working-together → services-checklist → webinar-optin → founder-bio → demo-lab → workflow-system → case-studies → stats-bar(bottom) → testimonials → martech → exclusivity-cta → contact`

---

## Design spec details

| Element | Spec |
|---|---|
| Demo lab background | `bg-muted/30` + `border-y` — same band treatment as workflow-system (they sit adjacent; both muted, separated by their own borders) |
| Tab (active) | `rounded-full border-primary/40 bg-primary/10 text-primary` — plain text, no icons |
| Tab (idle) | `rounded-full border-border bg-card/50 text-foreground` + primary hover |
| Chrome bar | Slim bar: live-pulse dot (emerald), demo title + description, emerald "Live demo" chip with bolt icon — honest by design, never fakes an API status |
| Iframe | `h-[560px] w-full`, `loading="lazy"`, titled for a11y |
| MarTech card | Category label (xs uppercase muted) + tool name (display bold) + emerald "● READY" pill |
| Empty filter state | "Nothing in this category yet." — Chada's own empty-state line |

**Badge honesty note (constraint 14):** the badge reads "READY" — deliberately not a certification claim ("Verified Integration" implies third-party verification Chada does not hold). If David is actually certified on any of these platforms, that card's badge may be upgraded **individually**, with the certificate referenced in the TODO row.

---

## Verification (run all)

```bash
# 1. Files exist
test -f resources/views/partials/demo-lab.blade.php && echo PASS-demo-lab
test -f resources/views/partials/martech.blade.php && echo PASS-martech

# 2. Build + render
bun run dev
curl -s http://127.0.0.1:8000/ | grep -c "demo-tab"            # 6 tabs
curl -s http://127.0.0.1:8000/ | grep -c "data-demo-panel"     # 6 panels
curl -s http://127.0.0.1:8000/ | grep -c "martech-card"        # 9 cards
curl -s http://127.0.0.1:8000/ | grep -c "iframe"              # 6 (lazy demo iframes)

# 3. Every iframe src resolves
curl -s http://127.0.0.1:8000/ | grep -o 'src="[^"]*preview[^"]*"' | sort -u
for s in sterling-vale apexflow elysian hirebase noir timber-mill; do
  curl -s -o /dev/null -w "%{http_code} /preview/$s\n" http://127.0.0.1:8000/preview/$s
done  # all 200

# 4. Originality checks (constraint 11) — none of these may appear in the
#    rendered HTML:
curl -s http://127.0.0.1:8000/ | grep -icE "revenue systems|manyChat|instagram direct message|choose an industry" || echo "PASS: no borrowed section copy"

# 5. Emoji-free views (style charter §5.2 rule 5)
grep -rnP "[\x{1F300}-\x{1FAFF}\x{2600}-\x{27BF}]" resources/views/partials/demo-lab.blade.php resources/views/partials/martech.blade.php && echo "FAIL: emoji found" || echo "PASS: SVG icons only"

# 6. Manual QA: click each tab (panel swaps, aria-selected toggles),
#    click each martech filter (cards filter, empty state shows for a
#    category with zero tools — test by temporarily removing matches),
#    iframe scrolls/interacts on mobile width.
```

## Definition of done (this doc)

- [ ] Demo Lab section renders 6 real demo tabs + panels; first tab active; tabs switch via jQuery; honest chrome bar present; iframes lazy-loaded and all `/preview/{slug}` targets return 200
- [ ] MarTech grid renders 9 real stack cards with category filter pills; filter works client-side; empty state toggles
- [ ] Homepage final include order verified against Redesign(1).md §2.1 — all 17 sections accounted for
- [ ] `public/demos/` untouched (`git status public/demos/` → clean)
- [ ] No fabricated claims in the DOM: grep for "Verified Integration" → 0; "READY" badges only
- [ ] Originality greps (verification steps 4–5) pass — no borrowed section copy, no emoji
- [ ] `bun run dev` clean; committed on `feat/v4-r7` as `feat(v4-r7): demo lab tabs + martech filter grid`
- [ ] The partial is named `demo-lab` (not any third-party-derived name); section id is `demo-lab`

*End of Redesign(7).md — proceed to Redesign(8).md.*
