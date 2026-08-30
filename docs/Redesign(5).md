# Redesign(5).md — Case Studies: Homepage Results Grid, /work Filters, Detail Pages, Sitemap & Nav Relink

> **Series:** Redesign(1)–(10) · **This doc:** #5 of 10 (V4 structural; #10 is the V5 visual pivot)
> **V5 note:** The class strings in this doc's Blade code are written in Tailwind (V4). After Phase 10 (`docs/Redesign(10).md`) lands, they migrate to Bootstrap 5 + Material Web Components + custom utility classes per the 24-row migration map in Redesign(10).md §8 (row 14 covers `x-result-card`). **The structural HTML, gating logic, and `/work` filter behavior stay identical under V5** — only class strings change.
> **Builds:** `components/result-card.blade.php` (NEW), `partials/case-studies.blade.php` (rewrite), `pages/work.blade.php` (dynamic filters), `pages/case-study.blade.php` (field-safe upgrade), `app/Http/Controllers/PageController.php` (sitemap), `partials/header.blade.php` + `partials/footer.blade.php` (Work link relink)
> **Depends on:** Redesign(2).md (published/verified gates + `categories()`)

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
14. NEVER invent real-sounding content — cards render only published
    studies with verified metrics.
```

---

## 0. The result-card pattern (what we are building)

Homepage result cards are **text-led** — no thumbnails, no images, no tags row:

```
[CLIENT NAME]            — small uppercase eyebrow with a briefcase SVG icon
[one big verified metric]— display type, primary color (only when verified)
[one-line description]   — muted body text
[link to detail page]    — "Read the case study →"
```

Three text lines + one CTA link. The existing `x-case-study-card` (thumbnail grid card) stays for `/work`; the homepage gets the new, simpler `x-result-card` because the two pages genuinely differ (dense homepage grid vs. richer archive page).

**Originality notes for this section (constraint 11 — this is the section where the prior V3 draft most obviously copied):**
- The component is named **`x-result-card`**. Nothing in Chada's codebase carries a third party's name.
- The client line uses an **inline SVG briefcase icon** — not an emoji, not any other site's glyph (style charter §5.2 rule 5).
- The CTA link reads **"Read the case study"** — plain, Chada-voiced. Not a borrowed persuasion line.
- The section heading reads **"Built, shipped, measured."** — Chada's own three-beat line.
- Cards render ONLY published studies with verified metrics. Empty grid = hidden section. There is no lorem fallback here because a lorem *result* would be a fake result — this section is all-gate, no filler (content model §4, kind C).

---

## TASK 1 — Create `resources/views/components/result-card.blade.php` (NEW)

```blade
@props([
    'study' => [],
    'slug' => '',
])

@php
    $study = $study ?: [];
    $client = $study['client'] ?? 'Untitled';
    $metric = $study['metric'] ?? null;
    $excerpt = $study['excerpt'] ?? null;
@endphp

<div class="flex flex-col rounded-2xl border border-border bg-card p-8 transition-all duration-300 hover:border-primary/40">
    <p class="flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.3em] text-muted-foreground">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3.5 text-primary" aria-hidden="true"><path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/><rect width="20" height="14" x="2" y="6" rx="2"/></svg>
        {{ $client }}
    </p>

    @if($metric)
        <p class="mt-4 font-display text-3xl font-bold tracking-tight text-primary">{{ $metric }}</p>
        @if(! empty($study['metric_label']))
            <p class="mt-1 text-xs font-medium uppercase tracking-widest text-muted-foreground">{{ $study['metric_label'] }}</p>
        @endif
    @endif

    @if($excerpt)
        <p class="mt-4 text-sm leading-relaxed text-muted-foreground">{{ $excerpt }}</p>
    @endif

    <a href="{{ route('case-study.show', $slug) }}" class="group mt-auto inline-flex items-center gap-1.5 pt-6 text-sm font-semibold text-primary">
        Read the case study
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4 transition-transform group-hover:translate-x-1"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
    </a>
</div>
```

**Design decision — the icon:** a small stroke-weight briefcase line icon in `text-primary`, preceding the client name. It marks the row as a client attribution without borrowing anyone's visual fingerprint. If the team later prefers a different Chada glyph, swap the SVG in this one component — but never an emoji.

---

## TASK 2 — Rewrite `resources/views/partials/case-studies.blade.php` (homepage grid)

**Current behavior:** thumbnail cards via `x-case-study-card`, guarded by `$studies->isNotEmpty()`, fallback "Case studies coming soon."

**New behavior:** text-led `x-result-card`s, 3-up grid; guarded by the published collection; **renders nothing at all when empty** (an empty section with a "coming soon" line is a stub, not a pattern — the section simply does not exist until there is content).

```blade
@php
    $studies = $studies ?? app(\App\Services\CaseStudyService::class)->collection();
@endphp

@if($studies->isNotEmpty())
    <section class="px-6 py-20 md:py-28" id="case-studies">
        <div class="mx-auto max-w-7xl">
            <div class="mb-12">
                <x-section-header
                    label="Case Studies"
                    title="Built, shipped, measured."
                    subtitle="Verified results from systems we designed, built, and shipped."
                />
            </div>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($studies as $slug => $study)
                    <x-result-card :study="$study" :slug="$slug" />
                @endforeach
            </div>
        </div>
    </section>
@endif
```

**Heading note:** "Built, shipped, measured." and the subtitle are Chada-original chrome. The subtitle is deliberately *not* a lorem slot: it describes the gating policy (verified results only) rather than making a claim. If David later prefers a different line, it is a one-line content change — flag in the PR.

---

## TASK 3 — Insert includes into `pages/home.blade.php`

Replace the comment line:

```blade
{{-- Redesign(5) inserts: @include('partials.case-studies') and @include('partials.stats-bar', ['variant' => 'home_bottom']) here --}}
```

with:

```blade
@include('partials.case-studies')                     {{-- 12. results grid (renders when studies are published) --}}
@include('partials.stats-bar', ['variant' => 'home_bottom'])  {{-- 13. stats repeat (guarded) --}}
```

**Placement:** both go AFTER `@include('partials.demo-lab')` / `workflow-system` block and BEFORE `@include('partials.testimonials')`. After this doc the order in the file is: …founder-bio → demo-lab (commented until doc 7) → workflow-system → **case-studies** → **stats-bar(bottom)** → testimonials…

---

## TASK 4 — Upgrade `resources/views/pages/work.blade.php` (dynamic filter pills)

**Current state:** hardcoded five filter buttons (All / Web Development / Funnels / Ads / Branding) + grid of `x-case-study-card`. Two problems: (a) the buttons are hardcoded while categories now live in the service; (b) `Funnels`/`Ads`/`Branding` don't match the V4 category vocabulary (`Funnel Design`, `Paid Ads`, `Web Development`, `SEO`, `Marketing Automation`).

**Replace the filter-bar section** (keep page shell, hero header, and grid section):

```blade
@section('content')
    <section class="px-6 py-16 md:py-24">
        <div class="mx-auto max-w-4xl text-center">
            <x-section-header
                label="Our Work"
                title="Built, shipped, measured."
                subtitle="A selection of systems we have designed, built, and shipped."
                center
            />
        </div>
    </section>

    @php
        $categories = app(\App\Services\CaseStudyService::class)->categories();
    @endphp

    @if(! empty($categories))
        <section class="px-6 pb-8">
            <div class="mx-auto max-w-7xl">
                <div class="showcase-filter-bar flex flex-wrap items-center justify-center gap-3">
                    <button
                        type="button"
                        class="filter-btn inline-flex items-center rounded-full border border-primary/40 bg-primary/10 px-5 py-2.5 text-sm font-medium text-primary transition-all duration-300 hover:bg-primary/10 hover:text-primary"
                        data-category="all"
                    >
                        All
                    </button>
                    @foreach($categories as $category)
                        <button
                            type="button"
                            class="filter-btn inline-flex items-center rounded-full border border-border bg-card/50 px-5 py-2.5 text-sm font-medium text-foreground transition-all duration-300 hover:bg-primary/10 hover:text-primary"
                            data-category="{{ $category }}"
                        >
                            {{ $category }}
                        </button>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="px-6 pb-20">
            <div class="mx-auto max-w-7xl">
                <div class="showcase-filter-grid grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($studies as $slug => $study)
                        <x-case-study-card :study="$study" :slug="$slug" />
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <section class="px-6 pb-24">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-muted-foreground">Case studies are being prepared. Check back soon.</p>
            </div>
        </section>
    @endif
@endsection
```

**JS note:** the filter logic already exists — `initShowcaseFilters()` in `resources/js/app.js` binds to `.showcase-filter-bar` / `.filter-btn` / `.showcase-filter-grid` / `[data-category]`. The markup above keeps all four hooks, so **zero JS changes**. The `x-case-study-card` already renders `data-category` — confirm it still does after any edits.

---

## TASK 5 — Field-safe upgrade to `resources/views/pages/case-study.blade.php`

The detail page already renders header, hero image, metrics bar, challenge/solution, workflow, tech stack, results, and CTAs. After Redesign(2) the data is gated, so make every section **disappear gracefully** when its content is missing (PENDING values must never print). Apply these targeted changes:

1. **Metrics bar** — filter out null values:

```blade
@php
    $metrics = collect($study['metrics'] ?? [])
        ->filter(fn ($m) => ! empty($m['value']))
        ->values()
        ->whenEmpty(fn ($c) => $c->push(['value' => $study['metric'] ?? null, 'label' => $study['metric_label'] ?? '']))
        ->filter(fn ($m) => ! empty($m['value']));
@endphp
@if($metrics->isNotEmpty())
    {{-- …existing metrics bar markup, loop over $metrics… --}}
@endif
```

2. **Challenge/Solution/Results** — wrap each in a null guard:

```blade
@if(! empty($study['challenge']) && ! str_starts_with($study['challenge'], 'PENDING'))
    {{-- …challenge block… --}}
@endif
```

Repeat the same guard for `solution` and `results`. The `PENDING` prefix check is a belt-and-braces rule: even if someone flips `published => true` early, PENDING-marked narratives still refuse to print.

3. **Thumbnail fallback** — already handled (`file_exists` + initials fallback). Keep.

4. **Preview link** — the "View Live Demo" button currently uses `$slug` against `preview.show`. After Redesign(2), demos are referenced by `preview_slug` (same value today, but explicit is better):

```blade
@if(! empty($study['preview_slug']))
    <a href="{{ route('preview.show', $study['preview_slug']) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-full border border-primary/40 px-6 py-3 text-xs font-semibold uppercase tracking-widest text-primary transition-all duration-300 hover:bg-primary/10">
        View Live Demo
        {{-- …existing svg… --}}
    </a>
@endif
```

5. **Workflow section** — Redesign(4) already patched the steps expression. Also gate the whole section:

```blade
@if(! empty($study['workflow']['steps']))
    {{-- …workflow section… --}}
@endif
```

---

## TASK 6 — Sitemap: add /work, /services, and case-study slugs

**File:** `app/Http/Controllers/PageController.php` — replace the `sitemap()` method (this also reverses the Q9 freeze at the sitemap level):

```php
public function sitemap(): Response
{
    $urls = [
        ['loc' => route('home'), 'changefreq' => 'weekly', 'priority' => '1.0'],
        ['loc' => route('work'), 'changefreq' => 'monthly', 'priority' => '0.9'],
    ];

    // /services ships in Redesign(6) — include it once the route exists.
    // To keep this doc independently mergeable, add it defensively:
    if (\Illuminate\Support\Facades\Route::has('services')) {
        $urls[] = ['loc' => route('services'), 'changefreq' => 'monthly', 'priority' => '0.9'];
    }

    foreach ($this->caseStudyService->collection() as $slug => $study) {
        $urls[] = [
            'loc' => route('case-study.show', $slug),
            'changefreq' => 'monthly',
            'priority' => '0.8',
        ];
    }

    foreach ($this->previewService->all() as $slug => $preview) {
        $urls[] = [
            'loc' => route('preview.show', $slug),
            'changefreq' => 'monthly',
            'priority' => '0.8',
        ];
    }

    $xml = view('sitemap', ['urls' => $urls])->render();

    return response($xml, 200, ['Content-Type' => 'application/xml']);
}
```

**Also update the route comment** in `routes/web.php` — the Q9 freeze is over. Replace:

```php
// Not linked from nav/homepage as of Aug 20 2026 — kept live per
// Open_Decision.md Q9 pending a final decision. Do not delete without
// confirming with David.
```

with:

```php
// V4: case studies are a core homepage section.
// Relinked per Redesign(5).md — Q9 resolved: KEEP + POPULATE.
```

---

## TASK 7 — Relink "Work" in nav + footer

**`resources/views/partials/header.blade.php`:** add Work as the second nav item (desktop and mobile menus), pointing at the `/work` route:

```blade
<nav class="hidden items-center gap-7 lg:flex">
    <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="{{ route('work') }}">Work</a>
    <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="{{ url('/#services-checklist') }}">Services</a>
    <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="{{ url('/#founder') }}">About</a>
    <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="{{ url('/#contact') }}">Contact</a>
</nav>
```

Mirror the same four links in the mobile menu inside `#mobile-menu`. **Note:** the old links pointed at `/#services`, `/#process`, `/#products` — sections that no longer render. The new anchors target sections that exist in the V4 homepage (`#services-checklist`, `#founder`). "Process" and "Products" links are removed — their sections stay unrouted. Redesign(8) does the full header/footer overhaul; this task only fixes dead links and adds Work.

**`resources/views/partials/footer.blade.php`:** add Work to the footer nav (one line):

```blade
<a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="{{ route('work') }}">Work</a>
```

---

## Verification (run all)

```bash
# 1. Components/partials exist
test -f resources/views/components/result-card.blade.php && echo PASS-card
grep -q "partials.case-studies" resources/views/pages/home.blade.php && echo PASS-home-include

# 2. No third-party-named component survived anywhere
grep -rn "wab-case-card" resources/ app/ && echo "FAIL: stale component name" || echo "PASS: no stale names"

# 3. Sitemap correctness (empty until studies publish — but /work must appear)
php artisan serve & sleep 2 && curl -s http://127.0.0.1:8000/sitemap.xml | grep -o "<loc>[^<]*</loc>"
# expect: home + /work only (no case-study URLs until published; /services after doc 6)

# 4. Route smoke tests
curl -s -o /dev/null -w "%{http_code} /\n" http://127.0.0.1:8000/
curl -s -o /dev/null -w "%{http_code} /work\n" http://127.0.0.1:8000/work
curl -s -o /dev/null -w "%{http_code} /case-study/noir (expect 404 until published)\n" http://127.0.0.1:8000/case-study/noir
curl -s -o /dev/null -w "%{http_code} /showcase (expect 301)\n" http://127.0.0.1:8000/showcase
curl -s -o /dev/null -w "%{http_code} /preview/noir (expect 200)\n" http://127.0.0.1:8000/preview/noir

# 5. Publish smoke test (scratch only — do NOT commit): flip noir to
#    published => true with a metric, reload / → expect result cards under
#    case studies, /work shows filter pills (All + Funnel Design),
#    /case-study/noir renders with gated sections. Revert.

# 6. PENDING text never prints
curl -s http://127.0.0.1:8000/ | grep -c "PENDING DAVID" # expect 0
curl -s http://127.0.0.1:8000/ | grep -c "Placeholder"   # expect 0

# 7. Emoji-free views (style charter §5.2 rule 5)
grep -rnP "[\x{1F300}-\x{1FAFF}\x{2600}-\x{27BF}]" resources/views/components/result-card.blade.php && echo "FAIL: emoji found" || echo "PASS: SVG icons only"

# 8. Assets + PHP
bun run dev
php -l app/Http/Controllers/PageController.php
```

## Definition of done (this doc)

- [ ] `x-result-card` exists and matches the text-led pattern (SVG icon + client, metric, excerpt, "Read the case study" link)
- [ ] Homepage includes case-studies + stats-bar(bottom); both render nothing while content is gated
- [ ] `/work` renders dynamic filter pills from `categories()`; existing jQuery filter still works; empty-state message shows while nothing is published
- [ ] Detail page: all narrative sections null/PENDING-guarded; preview link uses `preview_slug`
- [ ] Sitemap includes `/work` (+ `/services` when route exists) and published case-study slugs; routes comment updated (Q9 closed)
- [ ] Header (desktop + mobile) and footer link to Work; no dead `#process`/`#products` anchors remain
- [ ] Scratch publish test passed then reverted; grep proves zero PENDING/Placeholder text in rendered HTML
- [ ] `bun run dev` clean; committed on `feat/v4-r5` as `feat(v4-r5): results grid on home + /work filters + detail gating + sitemap/nav relink`

*End of Redesign(5).md — proceed to Redesign(6).md.*
