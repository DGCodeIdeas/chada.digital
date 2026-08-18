# REDESIGN_IMPLEMENTATION_PROMPT.md — Agent-Ready Build Instructions

> **Source of truth:** `Redesign.md` + `Open_Decision.md` (both on `main`, PR #4, team-approved)
> **Format:** Mirrors this repo's existing `IMPLEMENTATION_PROMPT.md` convention — phase-numbered, file-by-file, constraints repeated in every block so an agent starting a fresh session never loses them.
> **Target:** Paste directly into Cline / Jules / Kilo / Zoo Code.

---

## ⚠️ Read before running anything

**The example data in `Redesign.md` §6.6 (`healthtracka`, "$343,000 Generated") is WAB Digital's own client and claimed result, cited in `Redesign.md` §1 as an example of what WAB's site does — it is not Chada Digital's data.** Do not use it as seed content for the new `CaseStudyService`. Every prompt block below uses clearly-labeled placeholder case studies instead (`case-study-a`, `case-study-b`, etc., with "Placeholder — pending Ops" in every metric field). This matches `Redesign.md`'s own risk mitigation ("use placeholder data; content can be swapped later") and `Open_Decision.md` Q2/Q7, which are still open. **Do not let an agent "fill in" real-looking client names or numbers on its own — flag it back to David instead.**

---

## 🚨 Constraints — repeat in every agent session

- **Never touch `public/demos/`** — 6 demo projects, read-only, unrelated to this redesign
- Use `mix()` in Blade, never `@vite()`
- Use `bun`, never `npm`
- Keep existing jQuery modules (`resources/js/modules/*`) as-is; new interactivity (filters, tabs) may use Alpine.js or vanilla JS — per `Open_Decision.md` ADR-003
- PHP 8.2 constructor promotion for new services/controllers (`public function __construct(protected X $x)`)
- New reusable pieces use Blade's `<x-component-name>` syntax
- `CaseStudyService` follows the exact same pattern as the existing `app/Services/PreviewService.php` — hardcoded array, no DB migration
- Run `bun run dev` after every asset-affecting change to confirm the build doesn't break; run `bun run prod` before considering a phase done

---

## Phase 1 — Foundation (tokens, data layer, routing)

```text
You are implementing Phase 1 of the Chada Digital redesign at DGCodeIdeas/chada.digital,
per Redesign.md and Open_Decision.md on main (already team-approved — do not re-litigate
the direction, only ask if something here is genuinely ambiguous).

CONSTRAINTS (see top of REDESIGN_IMPLEMENTATION_PROMPT.md — repeat these to yourself):
- Never touch public/demos/
- mix() not @vite(), bun not npm
- Keep existing jQuery modules; new interactivity may use Alpine.js or vanilla JS
- PHP 8.2 constructor promotion

TASK 1 — Update tailwind.config.js
Replace the color block with (Redesign.md §5.1):
  background: '#fafafa'      (was #0e1b2e)
  foreground: '#171717'      (was #f8fafc)
  card.DEFAULT: '#ffffff'    card.foreground: '#171717'
  primary.DEFAULT: '#2563eb' (was #3b82f6)   primary.foreground: '#ffffff'
  muted.DEFAULT: '#f5f5f5'   muted.foreground: '#525252'
  border: '#e5e5e5'
  accent: '#0a0a0a'
Keep fontFamily and borderRadius blocks as-is (display: Outfit, sans: Inter,
accent: Playfair Display — reduce Outfit/Playfair usage in markup later, don't
remove the tokens).

TASK 2 — Create app/Services/CaseStudyService.php
Same shape as app/Services/PreviewService.php (all(), exists(), get(), collection()),
plus byCategory(string $category): array for /work filtering.
Seed with 3 PLACEHOLDER entries only (not 6-8 yet — real content isn't ready):
  'case-study-a' => [
      'client' => 'Placeholder Client A',
      'industry' => 'Placeholder Industry',
      'metric' => 'Placeholder — pending Ops (see Open_Decision.md Q2)',
      'metric_label' => 'Result Pending',
      'tags' => ['Placeholder'],
      'excerpt' => 'Placeholder excerpt — do not publish live.',
      'thumbnail' => '/assets/images/case-study-placeholder.jpg',
      'workflow' => [['step' => 'Placeholder Step', 'tool' => 'Placeholder Tool']],
      'challenge' => 'Placeholder.', 'solution' => 'Placeholder.', 'results' => 'Placeholder.',
      'tools' => ['Placeholder'],
  ],
(repeat pattern for case-study-b, case-study-c). DO NOT use "Healthtracka" or any
real client name/number — see the warning at the top of this file.

TASK 3 — Create app/Http/Controllers/CaseStudyController.php
  public function index(): View   // GET /work
  public function show(string $slug): View  // GET /case-study/{slug}
  Inject CaseStudyService via constructor promotion. 404 (abort(404)) if slug doesn't exist.

TASK 4 — Update routes/web.php
Current file:
  Route::get('/', [PageController::class, 'home'])->name('home');
  Route::get('/showcase', [PageController::class, 'showcase'])->name('showcase');
  Route::redirect('/showcase.html', '/showcase', 301);
  Route::get('/preview/{slug}', [PreviewController::class, 'show'])->name('preview.show');
  Route::get('/preview/{slug}/{subpage}', [PreviewController::class, 'subpage'])
      ->where('subpage', '.*')->name('preview.subpage');
  Route::post('/api/contact', [ContactController::class, 'submit'])->name('contact.submit');
  Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');

Change to:
  Route::get('/', [PageController::class, 'home'])->name('home');
  Route::get('/work', [CaseStudyController::class, 'index'])->name('work');
  Route::get('/case-study/{slug}', [CaseStudyController::class, 'show'])->name('case-study.show');
  Route::redirect('/showcase', '/work', 301);
  Route::redirect('/showcase.html', '/work', 301);
  Route::get('/preview/{slug}', [PreviewController::class, 'show'])->name('preview.show');
  Route::get('/preview/{slug}/{subpage}', [PreviewController::class, 'subpage'])
      ->where('subpage', '.*')->name('preview.subpage');
  Route::post('/api/contact', [ContactController::class, 'submit'])->name('contact.submit');
  Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');
Add the `CaseStudyController` use import. Keep PageController::showcase() method in place
but unused/deprecated for now rather than deleting — safer to remove in a follow-up cleanup PR.

TASK 5 — Update app/Http/Controllers/PageController.php::sitemap()
Inject CaseStudyService alongside PreviewService. Add /work and each /case-study/{slug}
to the $urls array (changefreq monthly, priority 0.8 — mirror the existing preview loop).

TASK 6 — Update resources/views/layouts/app.blade.php
Remove any dark-theme-specific assumptions in inline styles (there are none in the current
file beyond bg-background text-foreground on <body>, which will resolve to the new light
tokens automatically via Tailwind — no structural change needed here, just verify).

VERIFY: bun run dev completes with no Tailwind/PostCSS errors. php artisan route:list
shows /work and /case-study/{slug}. Do not proceed to Phase 2 until this builds clean.
```

---

## Phase 2 — Home page sections

```text
Phase 2 of the Chada Digital redesign — Redesign.md §6.1-6.5, 6.9-6.11.
Same constraints as Phase 1 (repeat them). Phase 1 must be complete and building clean
before starting this.

TASK 1 — resources/views/partials/header.blade.php (§6.1)
Current: dark sticky header, h-20, backdrop-blur-xl, links: Home/About Us/Services/
Our Work/Products/Contact.
New: light theme via updated tokens (should mostly resolve automatically from Phase 1's
tailwind.config.js change — verify bg-background/85 backdrop-blur-xl still reads correctly
on white). Reduce height h-20 → h-16. Update border to border-neutral-200. Update nav links
to: Work | Services | Process | Products | Contact (point "Work" at route('work'), not
route('home').'#portfolio'). Keep the mobile hamburger pattern and existing JS hook IDs
(#nav-toggle, #nav-icon, #mobile-menu) — resources/js/modules/mobile-nav.js depends on them.

TASK 2 — resources/views/partials/hero.blade.php (§6.2) — MAJOR CHANGE
Current: two-line headline "Digital Solutions That Scale Businesses", dual CTA pills,
gradient glow blobs.
New: remove the glow-blob divs entirely. Left-aligned, single primary CTA only (drop the
second "View Our Work" CTA — redundant with new nav). Headline direction from spec:
"We Build Funnels That Convert Visitors Into Revenue" — confirm this exact copy with
David before committing; treat it as a strong draft, not locked, since it's a positioning
claim, not a design token. Add a below-fold social proof strip: "Trusted by X+ brands" —
use a generic count, no fabricated client logos yet (Open_Decision.md Q1 is still open).
Typography: text-5xl md:text-7xl font-bold tracking-tight.

TASK 3 — Create resources/views/partials/trust-bar.blade.php (§6.3) — NEW
Grayscale placeholder logo strip OR skip rendering entirely if no logos exist yet
(Open_Decision.md Decision 8 status: "Decided PENDING client logo availability").
Implement the component so it's ready to receive logos, but guard it behind a check
(e.g. only render if a logos array is non-empty) so it doesn't ship broken image tags.

TASK 4 — Create resources/views/partials/process.blade.php (§6.4) — NEW
4-column desktop / vertical timeline mobile: Discover → Design → Build → Scale,
per the copy in Redesign.md §6.4. Icons: reuse the existing lucide-style inline SVG
pattern already used in services.blade.php/products.blade.php for visual consistency.

TASK 5 — resources/views/partials/services.blade.php (§6.5)
Current: 4 hardcoded cards (Web Development, Brand Identity, Automation, Digital Strategy),
each a full copy-pasted block.
New: refactor into a loop over a PHP array (this also resolves the technical debt noted
in the original Redesign.md audit — don't reintroduce copy-pasted markup). Reframe per
spec: Web Development / Funnel & Automation / Paid Advertising / Brand & Strategy, each
with a "tech stack" micro-list line at the bottom (see §6.5 for exact copy). Light card
styling: border only, no dark bg.

TASK 6 — resources/views/partials/products.blade.php (§6.9) — minor
Light theme restyle only. Add a small "Product" badge per card. Do not add pricing
copy yet — Open_Decision.md Q4 ("should products show pricing?") is unresolved.

TASK 7 — resources/views/partials/contact.blade.php + contact-form.blade.php (§6.10)
Visual restyle only — light bg-neutral-50 form fields, rounded-xl. Do not touch the
AJAX submission logic, honeypot field, or toast success handling.

TASK 8 — resources/views/partials/footer.blade.php (§6.11)
Simplify from 4 columns to 2 rows per spec. Drop "Products" from footer links (already
in nav). Add social icon placeholders (link hrefs can be "#" until real profiles are
confirmed).

VERIFY: bun run dev clean build. Manually check header/hero/services/products/contact/
footer render correctly at sm/lg breakpoints. Confirm mobile-nav.js and contact-form.js
still fire correctly (no ID mismatches from markup changes).
```

---

## Phase 3 — Case study system

```text
Phase 3 of the Chada Digital redesign — Redesign.md §6.6-6.8, 6.12, §7.
Same constraints as Phase 1/2. Phase 2 must be building clean first.

TASK 1 — Create app/View/Components (or resources/views/components/) for:
  x-case-study-card    (components/case-study-card.blade.php)
  x-metric-badge       (components/metric-badge.blade.php)
  x-workflow-diagram   (components/workflow-diagram.blade.php)
  x-tech-stack         (components/tech-stack.blade.php)
  x-section-header     (components/section-header.blade.php — reusable label+headline+subhead,
                         since this pattern repeats across every section)
workflow-diagram: pure CSS/Tailwind flexbox + SVG arrow connectors, no charting library
(Open_Decision.md ADR-002). Horizontal scroll on mobile (overflow-x-auto).

TASK 2 — Replace resources/views/partials/portfolio.blade.php with
resources/views/partials/case-studies.blade.php (§6.6)
Loop over CaseStudyService->collection() (the 3 placeholder entries from Phase 1).
2-column grid desktop, 1-column mobile. Each card: thumbnail, client name, metric badge,
tags, excerpt, "View Case Study →" linking to route('case-study.show', $slug).
Update resources/views/pages/home.blade.php to @include this instead of partials.portfolio.

TASK 3 — Create resources/views/pages/case-study.blade.php (§6.7)
New detail page: hero image, metrics bar (x-metric-badge x3), Challenge/Solution
narrative, x-workflow-diagram fed from the case study's 'workflow' array, x-tech-stack
icon grid, Results bullets, closing CTA. Wire to CaseStudyController@show.

TASK 4 — Rename resources/views/pages/showcase.blade.php → work.blade.php (§6.12)
Filterable grid (All | Web Development | Funnels | Ads | Branding) using
CaseStudyService->byCategory(). Cards use x-case-study-card, link to /case-study/{slug}.
Confirm existing showcase.js filter logic can be adapted rather than rewritten from
scratch — check resources/js/modules/ for a showcase/filter module before writing new JS.

TASK 5 — Update sitemap output
Confirm every /case-study/{slug} from Phase 1's sitemap() change actually appears in
/sitemap.xml once real routes exist. Spot-check with php artisan route:list + a manual
GET to /sitemap.xml.

VERIFY: /work loads and filters correctly. Each /case-study/{slug} renders without
missing-array-key errors. /preview/{slug} iframe viewer still works unmodified —
case studies should LINK to it as "Live Demo," never embed or replace it
(Open_Decision.md Decision 5).
```

---

## Phase 4 — Polish, QA, sign-off

```text
Phase 4 — final pass before this goes to David for review. Same constraints as prior
phases.

CHECKLIST (Redesign.md §11 Acceptance Criteria):
[ ] No #0e1b2e (old dark navy) remains anywhere — grep for it across resources/views
[ ] Text passes WCAG AA contrast on the new light background (spot-check with a
    contrast checker on body text, muted text, and button text)
[ ] Typography: Inter as primary body font confirmed in rendered output; Outfit
    reserved for headings only
[ ] workflow-diagram renders usably on mobile (horizontal scroll, not clipped)
[ ] /showcase redirects (301) to /work — curl -I to confirm status code
[ ] /work filtering works for all categories
[ ] Contact form still submits successfully — styling changed, logic didn't
[ ] Mobile nav works on every page, not just home
[ ] All 5 /preview/{slug} demos still load unmodified
[ ] sitemap.xml includes /work and every /case-study/{slug}
[ ] bun run prod completes; check public/css/app.css bundle size hasn't grown >20%
    vs. the pre-redesign build
[ ] og-image.jpg and meta descriptions updated to match new positioning (coordinate
    exact copy with David — don't invent final marketing copy unsupervised)

DO NOT mark this phase complete or open a PR to main until:
- Every placeholder case study is still clearly labeled as a placeholder (grep for
  "Placeholder — pending Ops" to confirm none were silently replaced with invented
  real-sounding client data)
- David has reviewed hero copy and any other new marketing claims

Open a PR from feat/redesign-wabdigital → main. Do not merge directly.
```

---

## Still blocked regardless of implementation progress

These are Ops/Business Dev/Design deliverables, not engineering tasks — implementation can proceed with placeholders, but the site shouldn't go live with them unresolved (`Open_Decision.md` §8):

1. Real case study content (3-8 actual clients, real or approved-as-representative metrics)
2. Client logo permissions, if the trust bar ships
3. A dark-text logo variant for the new light header
4. Whether Products shows pricing
5. Which case studies get featured on `/work`

Flag these back to David rather than an agent inventing plausible-looking answers for any of them.
