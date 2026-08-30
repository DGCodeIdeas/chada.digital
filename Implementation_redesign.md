# Implementation_redesign.md — Master Build Reference for Kilo

> **Purpose:** the one file Kilo loads at the start of every session on this
> redesign. It carries the constraints, the content-safety model, the current
> verified repo state, and the full phase map. For the detailed code-level
> spec of whichever phase you're executing, pair this file with the matching
> `docs/Redesign(N).md` (V4 series) — this file won't repeat their full code, only
> orient you and give every phase (2–9) as a ready-to-run session kickoff.
>
> **Spec of record:** `REDESIGN_IMPLEMENTATION.md` (repo root). This file is the
> orientation layer; that file is the full clarified spec — decision history
> (C1–C12 structural corrections, D1–D12 originality directives), the
> 18-pattern table, acceptance criteria, risk register, and sign-off tables.
> The ten build docs live in `docs/Redesign(1).md` … `docs/Redesign(10).md` (V4 structural + V5 visual pivot);
> content gates are tracked in `TODO-Placeholders.md` and open decisions in
> `Open_Decision.md`. If this file and the spec of record ever disagree, the
> spec of record wins — fix this file.
> **Supersedes:** any earlier "V3" doc series, PR #6 (`feat/wab-complete-replication-spec`
> v1, closed), and the standalone `REDESIGN_IMPLEMENTATION_PROMPT.md` from the V2-only
> build (archived as `archive/IMPLEMENTATION_PROMPT_ARCHIVED.md`). Do not open,
> reference, or resurrect the old V3 doc series — it
> carried third-party verbatim copy from the reference site and was
> deliberately purged. If you ever see it in the repo, delete it and flag it.
> **Repo:** `DGCodeIdeas/chada.digital` · branch off `main` · **HEAD audited `2f8669d`** (post-revert starting state, Aug 30, 2026 — main was force-reverted from `6db7f42` to discard R2/R3 code; V4 docs retained, V5 modifications applied per `docs/Redesign(10).md` and `Open_Decision.md` Q10–Q13)
> **Ratified by:** Tech Lead (Q9 — case-study fate: keep+populate+relink; the
> originality/content model below). **Still needs Founder sign-off** on the
> spec as a whole (row 0 of the sign-off table) before Phase 3 onward ships
> to production — Phase 2 (data layer) is safe to start regardless, since it
> changes nothing visible.
> **Phase numbering matches doc numbering:** Phase N executes `docs/Redesign(N).md`.
> There is no Phase 1 (Redesign(1).md is the master directive/architecture
> doc, not an execution phase — everyone should have already read it).
> **Phase 10 (V5)** is the visual system pivot — Tailwind to Bootstrap+M3+custom.
> Execute after Phases 2–9 are on main, OR as a parallel visual-only branch
> that other phases can rebase onto. See `docs/Redesign(10).md`.
> **Multi-page architecture (Aug 30, 2026):** The V4 single-homepage-with-anchors
> model is replaced by multi-page routes. See `docs/Redesign(10).md` §13 and
> `Open_Decision.md` Q12. The homepage becomes a focused 8-section front door;
> other sections move to `/services`, `/work`, `/case-studies/{slug}`, `/demos`,
> `/about`, `/contact`, optionally `/blueprints` and `/webinar`.
> **Build restart (Aug 30, 2026):** Main is being reverted to `2f8669d` (pre-Phase-2)
> — R2/R3 code discarded, V4 docs retained. See `Open_Decision.md` Q13. Re-execute
> Phases 2–9 with the V5 visual system + multi-page wiring.

---

## 0. The rule that governs everything else

**Patterns are replicated. Expression is not.** Every section type, layout,
and feature from the reference site gets built. No sentence, name, price,
metric, image, or distinctive section title from that site is copied,
paraphrased-to-be-recognizable, or used as a naming source. Chada's own
design tokens, own component names, own CTA vocabulary, own generated
placeholder text.

**Never fetch, screenshot, or quote the reference site during this build.**
These documents are the only reference. If something is ambiguous, that's a
defect in the docs — escalate to the Tech Lead, don't resolve it by checking
the live competitor site.

---

## 1. Non-negotiable constraints (repeat to yourself every session)

```
1.  NEVER touch public/demos/.
2.  mix() not @vite(). 3. bun not npm. 4. ZERO new Composer dependencies.
    Bootstrap 5.3 + Material Web + Material Symbols are allowed (Phase 10).
    App\Support\Lorem is pure PHP — always allowed.
5.  Preserve route names: home, work, case-study.show, preview.show,
    preview.subpage, contact.submit, sitemap — plus new: services.
6.  Keep the contact form's honeypot + AJAX validation exactly as-is.
7.  PHP 8.2 constructor promotion for new services/controllers.
8.  Blade components (<x-…>) for reusable markup.
9.  Chada style charter (V5): cards use M3 elevation (no borders — see
    Redesign(10).md §5), eyebrow labels via the `.eyebrow` custom utility
    class, Inter for body + display (Outfit dropped in V5), one text-primary
    highlighted word per heading, Material Symbols variable font for icons
    (inline SVGs replaced in Phase 10) — NEVER emoji.
10. Placeholder prose is GENERATED, never hand-typed: $real ?? \App\Support\Lorem::…(key).
    config/placeholders.php holds seeds, gates, and short chrome labels only.
11. ORIGINALITY (DMCA rule): never copy third-party text, names, prices,
    metrics, imagery, or distinctive section titles from the reference site,
    anywhere — not in views, not in comments, not in commit messages.
12. Escape apostrophes in single-quoted PHP strings. Run php -l on every
    touched PHP file before committing (the Aug 20 PR #5 500 was exactly
    this — an unescaped apostrophe took production down).
13. bun run dev clean after every change; bun run prod before a phase is
    called done.
14. NEVER invent real-sounding content: no fake client names, metrics,
    testimonials, or prices. The Lorem generator's word bank has no digits.
    Factual claims wait for David — see TODO-Placeholders.md.
```

---

## 2. The content model — how structure ships before facts, and before copy

Every string in this build is exactly one of three kinds. If you're about to
write a string that isn't clearly one of these three, stop — it's probably
invented content or borrowed language, neither of which is allowed.

| Kind | Lives where | Renders as | Replaced by |
|---|---|---|---|
| **A. Chada chrome** | config, or inline in views | Fixed short UI labels — "Start a Project", "Under the Hood", "READY", "Explore Our Work" | A deliberate content decision, never silently |
| **B. Generated lorem** | `App\Support\Lorem` calls, keyed by slot | Deterministic lorem per request; a rotating `placeholders.lorem_seed` regenerates every placeholder site-wide in one move | Real copy lands in config/service; the `??` fallback goes dormant on its own |
| **C. Gated facts** | null/false gate | Nothing, or a labeled fallback ("Contact for pricing") | A human (David, or the Tech Lead for verified workflow steps) flips the gate |

**Gate inventory:**

| Gate | Mechanism | While gated | Lights up when |
|---|---|---|---|
| Offer prices | `placeholders.offers.*.price_ngn` = null | "Contact for pricing" | David sets prices |
| Stats bars (×2 on home, ×1 on /services) | all `value` = null | Section renders nothing | David supplies verified numbers |
| Case studies | `published => false` | Entry invisible; `/case-study/{slug}` 404s | David verifies metric + narrative |
| Workflow pipelines | `workflow.verified => false` | No pipeline in System Blueprints | Tech Lead verifies every step/tool |
| Speed claim | `placeholders.workflow_speed_claim` = null | Line absent | David approves a measured claim |
| Webinar opt-in | `placeholders.webinar.enabled` = false | Section absent | Real replay/masterclass asset exists |
| Standards band | `placeholders.manifesto.enabled` = false | Band absent | David approves principles |
| Chat widget | `placeholders.chat.whatsapp_number` = null | Documented no-op | Q8 answered with a real number |
| Trust bar | `$clientLogos = []` | Section absent (pre-existing, unchanged) | Client logo permissions |
| Hero proof line | `placeholders.hero.proof_line` = null | Line absent | Verified trust claim |
| Founder JSON-LD | `placeholders.founder.real` = false | No Person node | Real founder content (Q6) |
| Testimonial quotes | `placeholders.testimonials` = [] | Three generated-lorem cards | Real quotes, WITH permission (Q5) |

This exists to make two separate incidents structurally impossible to repeat:
PR #5 (fabricated metrics shipped, had to be reverted — prevented by kind C)
and the V3 doc series (third-party copy carried through planning docs —
prevented by kinds A and B leaving no slot where copied text could hide).

---

## 3. Target architecture — 18 patterns, in homepage order

| # | Pattern | Builds as | Doc |
|---|---|---|---|
| 1 | Hero — eyebrow + outcome H1 + subtext + dual CTA | `hero` upgraded, gated proof line | R3 |
| 2 | Stats band — 4 numbers | `stats-bar` NEW, variant `home_top`, gated | R3 |
| 3 | Client logo strip | `trust-bar` — already correct, untouched | — |
| 4 | Six tiered offer cards + price block | `goal-picker` upgraded, "Contact for pricing" fallback | R3 |
| 5 | Free-review CTA | `assessment-cta` → renamed `audit-cta` | R3 |
| 6 | Transition band | `working-together` NEW | R3 |
| 7 | Agency paragraph + 12-item checklist + dual CTA | `services-checklist` upgraded (was 4 items) | R3 |
| 8 | Gated content opt-in (6-field form) | `webinar-optin` NEW, disabled until real asset | R3 |
| 9 | Founder bio | `founder-bio` kept, lorem slots + `real` flag | R3 |
| 10 | Tabbed interactive demos | `demo-lab` NEW — 6 tabs, real `public/demos/` iframes | R7 |
| 11 | Pipeline/workflow diagrams | `workflow-system` NEW ("System Blueprints") | R4 |
| 12 | Results grid | `case-studies` on home + `x-result-card` NEW, `published`-gated | R5 |
| 13 | Stats band (repeat) | `stats-bar` variant `home_bottom` | R5 |
| 14 | Standards band + testimonials | `testimonials` kept + gated standards band | R3 |
| 15 | Integrations grid | `martech` NEW — filter pills, real stack tools | R7 |
| 16 | Selective-availability closing CTA | `exclusivity-cta` kept | — |
| 17 | Footer | `footer` upgraded — no dead links | R8 |
| 18 | Persistent chat widget | `chat-widget` gated WhatsApp wiring | R8 |

Secondary pages: `/services` (tiered pricing — R6), `/work` (filterable grid —
R5), `/case-study/{slug}` (detail — R5), sitemap + nav relink (R5/R8).

---

## 4. Current verified repo state (do not assume — this was read, not guessed)

- **Homepage today:** `hero → trust-bar → goal-picker → assessment-cta →
  testimonials → services-checklist → founder-bio → exclusivity-cta →
  contact`. All content is V2-era static lorem via `config/placeholders.php`
  (6 offers, 3 testimonials) — this gets replaced by the generator in R2, not
  hand-edited further.
- **Case-study system:** frozen — `/work`, `/case-study/{slug}` routes
  registered but unlinked from nav/sitemap. `CaseStudyService` holds 3
  placeholder entries. R5 relinks and expands to 6.
- **Components already on disk:** `x-case-study-card`, `x-workflow-diagram`
  (reused/upgraded in R4), `x-metric-badge`, `x-section-header/badge/heading`,
  `x-tech-stack`, `x-button-primary/outline`, `x-splash-logo`.
- **Chat widget:** deliberate no-op placeholder (Q8 unresolved).
- **Unrouted but present, do not delete:** `partials/process`, `partials/about`,
  `partials/services` (real 4-service array — reusable data), `partials/products`.
- **Infra:** GitHub Actions → EC2 via rsync + `post-deploy-dstack.sh`.
  `scripts/maintenance-lock.sh on|off` holds/releases a deliberate
  maintenance lock — do not touch this script in this build.
- **PreviewService:** 6 real interactive demos (`apexflow`, `elysian`,
  `hirebase`, `noir`, `sterling-vale`, `timber-mill`) in `public/demos/` —
  these power the Demo Lab (R7) and are the untouchable ground truth.

### 4.1 Two known live bugs — verified against R3–R9's actual content, not assumed

1. **Dead nav anchors — fixed progressively, not in one doc.** `header.blade.php`
   currently links to `/#services`, `/#process`, `/#products` — none of
   these IDs exist anymore. **R5 Task 7** does the first fix (relinks Work,
   drops the `#process`/`#products` links, points Services/About at
   `#services-checklist`/`#founder`). **R8 Task 1** does the final version
   (adds the `/services` route link once it exists). Nothing to add here —
   both docs already handle it correctly.
2. **Broken founder image — NOT actually fixed by R3, despite what this
   file used to imply.** Re-read against R3 Task 9's real content: it says
   "keep the existing silhouette placeholder photo + `founder.photo` path
   behavior" — it assumes the placeholder file already works. It does not;
   `/assets/images/founder-placeholder.jpg` still doesn't exist anywhere in
   the repo. **This needs an explicit, separate task in Phase 3 — see §7
   below, Phase 3 Task 0.** Do not assume any other doc handles it; none do.

---

## 5. Phase map

Phase numbers match doc numbers exactly — Phase N runs `docs/Redesign(N).md`.

| Phase | Doc | Scope | Depends on | Status |
|---|---|---|---|---|
| **0. Ratify** | — | Founder + Tech Lead confirm the keep-decisions and 18-pattern target; close Q9 | — | Q9 + originality model resolved by Tech Lead; row 0 (full spec) still needs Founder |
| **2. Data layer** | R2 | `App\Support\Lorem`, `CaseStudyService` v2, `config/placeholders.php` v4, TODO rows | Phase 0 not required (invisible change) | **REVERTED Aug 30** — re-execute from scratch with V5. PR #8/#9 code can be cherry-picked as reference, but views must use Bootstrap+M3 (not Tailwind). |
| **3. Homepage A** | R3 | Hero, stats-bar, goal-picker price block, audit-cta, working-together, 12-item checklist, webinar-optin (off), founder slots, testimonials+standards (off) | Phase 2 re-merged | **REVERTED Aug 30** — re-execute with V5 + multi-page wiring (founder-bio → /about, webinar-optin → /webinar per `Redesign(10).md` §13.1) |
| **4. System Blueprints** | R4 | `workflow-system` pipeline pattern, `workflow-diagram` upgrade | Phase 2 | Not started — can run parallel to 3, 5, 6 |
| **5. Case studies + /work + sitemap + nav** | R5 | `x-result-card`, homepage results grid, dynamic `/work` filters, detail-page gating, sitemap, nav relink (fixes bug 1 first pass) | Phase 2 | **REVERTED Aug 30** — re-execute from scratch with V5. (Was reverted once via PR #13 due to R4 not being merged first; main is now at `2f8669d` so R4 PR #11 also needs to re-merge before R5 retries.) |
| **6. /services page** | R6 | `PricingService`, tiered pricing page, 15 gated cards | Phase 2; sitemap guard from Phase 5 (defensive `Route::has` check makes this independently mergeable) | Not started — can run parallel to 3, 4, 5 |
| **7. Demo Lab + MarTech** | R7 | 6-tab interactive demo panels (real `public/demos/`), filterable integrations grid | Phase 5 (home include positions) | Not started |
| **8. Global chrome + SEO** | R8 | Final header/footer, chat widget WhatsApp wiring, JSON-LD, meta — final nav fix (bug 1, second pass) | Phase 5, 6, 7 (routes + anchors must exist) | Not started |
| **9. QA + launch gates** | R9 | All grep gates (incl. originality gates 2/9/10/11), functional matrix, Lighthouse, NDPA, deploy runbook, maintenance-lock release | ALL previous phases merged | Not started |
| **10. Visual pivot (V5)** | R10 | Tailwind → Bootstrap 5.3 + Material Web Components + Material Symbols + Inter. No-borders fusion. Design Partner band replaces trust strip. See `docs/Redesign(10).md` | Phases 2–9 merged OR parallel visual-only branch | Not started — recommended AFTER R4 merges and R5 retries |

**Branch per doc:** `git checkout main && git pull && git checkout -b feat/v4-r{n}` (or `feat/v5-visual-pivot` for Phase 10). Never work directly on `main`. One PR per doc. Do not merge your own PRs. **Phases 3, 4, and 5 can run in parallel** (independent branches off the same Phase 2 base) — Phase 6 too, if its defensive sitemap guard is respected. Phases 7, 8, 9 are strictly sequential. **Phase 10** is best run after R4 merges (so its `workflow-system.blade.php` migration is included) — see `docs/Redesign(10).md` §11.

---

## 6. Phase 2 — Data layer (REVERTED Aug 30 — re-execute with V5)

```text
You are Kilo, executing Phase 2 (docs/Redesign(2).md — Data layer) of the Chada
Digital V4 redesign at DGCodeIdeas/chada.digital. Read Implementation_redesign.md
in full first — constraints (§1), content model (§2), current repo state (§4)
all apply. The full spec of record is REDESIGN_IMPLEMENTATION.md (repo root);
this phase changes nothing visible on the site; it only builds the
foundation the rest of the series depends on.

Branch: git checkout -b feat/v4-r2

TASK 1 — Create app/Support/Lorem.php
A pure-PHP, seeded, deterministic lorem generator (no package dependency —
constraint 4 requires this). Requirements:
  - Word bank contains no digits, ever (constraint 14 — prevents an agent or
    the generator itself from ever accidentally emitting something that
    reads like a real statistic).
  - Deterministic per request: the same slot key returns the same lorem
    text within a single request (so a card's title and description don't
    visibly change between renders of the same page load).
  - Seed is rotatable via config('placeholders.lorem_seed') — changing that
    one value regenerates every placeholder string site-wide, which is how
    "dynamic" is satisfied: this is a generator, not a static array.
  - Expose methods for common shapes: ::headline(), ::sentence(), ::paragraph(),
    ::words(int $count), keyed by a $slot identifier so the same slot is
    stable within a request.

TASK 2 — Rewrite app/Services/CaseStudyService.php (full replacement)
Per the gate inventory in Implementation_redesign.md §2: each entry needs a
`published` boolean gate (false by default — entries are invisible until
David verifies them) and a `workflow.verified` boolean gate (false by
default, separate from `published` — the Tech Lead verifies workflow steps
specifically). 6 structured entries, one per real PreviewService demo
(apexflow, elysian, hirebase, noir, sterling-vale, timber-mill) — do NOT
invent a 7th, 8th, or 9th entry not backed by a real demo. Every field that
isn't structural (client name, metric, narrative, workflow steps) is either
null (gated) or a Lorem:: call — never hand-typed placeholder prose per
constraint 10.

TASK 3 — Rewrite config/placeholders.php (full replacement)
Add: lorem_seed key, gate keys matching every row in §2's gate inventory
table, and short Chada-chrome labels (button text, eyebrows, badges) as
plain strings — those are the one category of hand-written string this file
is allowed to hold, per the content model's "kind A" definition.

TASK 4 — Add new rows to TODO-Placeholders.md
For every new gate this phase introduces (stats numbers, workflow
verification, webinar asset, standards band, hero proof line) that didn't
exist in the V2-era version of that file.

VERIFY:
- php -l on every touched file.
- php artisan tinker → call a few Lorem:: methods twice in the same process,
  confirm same slot returns same text (determinism); change lorem_seed,
  confirm it changes.
- bun run dev clean build.
- Load the live homepage locally — it should look IDENTICAL to before this
  phase. This phase is data-layer only; zero visual change is the correct
  outcome.

Commit as: feat(v4-r2): data layer — Lorem generator, CaseStudyService v2, placeholders v4
Open a PR. Do not merge it yourself.

⚠️ THIS PHASE WAS BUILT IN PR #8/#9 AND THEN REVERTED Aug 30, 2026.
Main is now at `2f8669d` (post-revert starting state) — the R2 code is gone.

Re-execute this block from scratch. The data-layer code from PR #8/#9 history
is still a valid reference (cherry-pick or copy the PHP shapes), BUT the
Blade views that consumed those config keys were also reverted, so the
re-execution is a clean rebuild — not a re-merge of an old PR.

V5 modifications that apply during this re-execution:
- Constraint 4 expanded (Bootstrap 5.3, Material Web Components, Material
  Symbols via Bun — NOT npm).
- Constraint 9 updated (no borders, Inter+Material Symbols, .eyebrow utility).
- The `'tools'` arrays in CaseStudyService should use 'Bootstrap 5' and
  'Material Web' (not 'Tailwind CSS') — see docs/Redesign(2).md.
- The Phase 2 agent task block above is still valid for the data-layer-only
  work (Lorem.php, CaseStudyService, config/placeholders.php, TODO rows).
  No V5 visual changes here — this phase is data-layer only.

Phase 2 must merge before Phase 3 (R3) starts — same dependency as V4.
```

---

## 7. Phases 3–10 — ready to execute

Each block below is a session kickoff, not a code substitute — every doc
(`docs/Redesign(N).md`) already contains complete, working Blade/PHP; retyping
it here would just be a second copy to go stale. What's below is what these
docs don't say by themselves: dependency order, the gotchas an agent working
from the doc in isolation would miss, and the parts of this specific repo's
history (bugs, prior incidents) that the doc author knew about but a fresh
session wouldn't.

**Phase 10** (V5 visual pivot) is at the end of this section — read it last.

**Every phase:** confirm its dependency phase(s) are merged and `main` is
current → `git checkout -b feat/v4-r{n}` → re-read §1 and §2 above → execute
`docs/Redesign(N).md` top to bottom, exactly as written → run that doc's own
verification block plus `bun run dev` → commit per task → open one PR, don't
merge it yourself.

---

### Phase 3 — Homepage A (docs/Redesign(3).md)

```text
You are Kilo, executing Phase 3 (docs/Redesign(3).md — Homepage Sections A)
of the Chada Digital V4 redesign. Read Implementation_redesign.md §1 and §2
first. Confirm Phase 2 (feat/v4-r2 / PR #8) is merged before starting — this
phase depends on App\Support\Lorem and the v4 config shape existing.

Branch: git checkout -b feat/v4-r3

Execute docs/Redesign(3).md TASK 1 through TASK 10 exactly as written.

BEFORE TASK 1, do this first (not in the R3 doc — a real gap found by
auditing this repo directly, see Implementation_redesign.md §4.1 bug 2):

TASK 0 — Fix the broken founder image
`founder-bio.blade.php` references `/assets/images/founder-placeholder.jpg`,
which does not exist in this repo (404). R3's own Task 9 assumes it already
works and does not create it. Pick one:
  (a) Create a real placeholder graphic (silhouette/initials — NOT a stock
      photo of a real person) at that path, or
  (b) Gate the <img> tag itself behind `founder.real`, same as the bio text,
      so nothing renders (not even a broken icon) until real content lands.
Either is acceptable — (b) is less work and consistent with how every other
founder field is already gated; note your choice in the PR body.

Watch for these while executing R3's tasks:
- TASK 1 (home.blade.php): Blade `{{-- --}}` comments marking later docs'
  insertion points don't render — when a LATER phase's doc tells you to
  replace one of these comments, replace it, don't leave the comment AND
  add the include (R3's own note, worth repeating: doubled sections are an
  easy mistake here).
- TASK 7 (services-checklist): the "See Services" button links to `/services`,
  which doesn't exist until Phase 6 merges. If Phase 6 isn't merged yet,
  link to `url('/#goals')` temporarily per R3's own instruction — do not
  ship a 404 link, and leave a one-line TODO comment to swap it back.
- TASK 8 (webinar-optin): before writing the form, open
  `resources/views/partials/contact-form.blade.php` and copy its EXACT
  honeypot field name/markup. Don't invent a second honeypot convention —
  ContactController validates one specific field name.
- TASK 9 (founder-bio): confirms Task 0 above — the section renders
  generated lorem until `placeholders.founder.real` flips to true.

VERIFY: run docs/Redesign(3).md's full verification block (7 steps) plus:
- Confirm the Task 0 fix — no broken image icon anywhere on the page.
- Confirm the hardcoded "Trusted by 50+ brands" line is GONE (replaced by
  the gated `hero.proof_line`, which renders nothing while null).

Commit as: feat(v4-r3): homepage sections A — hero dual CTA, stats bar,
pricing blocks, free-review CTA, checklist, optin, founder, testimonials,
[+ fix: founder placeholder image]
Open a PR. Do not merge it yourself. In the PR body, state explicitly
whether Task 0 used option (a) or (b).
```

---

### Phase 4 — System Blueprints (docs/Redesign(4).md)

```text
You are Kilo, executing Phase 4 (docs/Redesign(4).md — System Blueprints /
pipeline diagrams) of the Chada Digital V4 redesign. Read
Implementation_redesign.md §1 and §2 first. Depends on Phase 2 only
(CaseStudyService::verifiedWorkflows() must exist) — can run in parallel
with Phase 3, 5, and 6 on its own branch off the same Phase 2 base.

Branch: git checkout -b feat/v4-r4

Execute docs/Redesign(4).md TASK 1 through TASK 3 exactly as written.

Watch for these:
- TASK 1 upgrades the SHARED `x-workflow-diagram` component — the
  case-study detail page (`pages/case-study.blade.php`) already calls it.
  The doc's own Task 1 includes a backward-compatibility fix for the new
  `workflow.steps` data shape (Phase 2 changed `$study['workflow']` from a
  flat array to `['verified' => bool, 'steps' => [...]]`) — apply that fix
  IN THIS PHASE, don't wait for Phase 5. If you skip it, the detail page
  breaks the moment a study is scratch-published for testing.
- Naming is locked in the doc (do not improvise alternatives): eyebrow
  "Under the Hood", title "System Blueprints", badge "Connected
  End-to-End" with a link icon, speed-claim icon is a bolt (not a warning
  triangle).
- The section renders NOTHING today — every workflow's `verified` gate is
  false from Phase 2. That's correct. The doc's verification step 4 has
  you scratch-flip one workflow to `verified => true` to prove the gate
  works, then revert before committing — don't skip the revert.
- Originality: this section had a real problem in an earlier internal
  draft (verbatim third-party pipeline copy). The pattern in the doc is
  the complete, safe replacement — do not look anywhere else for
  "reference," including the reference site itself (constraint 11).

VERIFY: run docs/Redesign(4).md's full verification block (7 steps),
especially step 6 (originality grep) and the scratch-test-then-revert in
step 4.

Commit as: feat(v4-r4): system blueprints section — pipeline pattern with
verified gating
Open a PR. Do not merge it yourself.
```

---

### Phase 5 — Case studies, /work, detail pages, sitemap, nav (docs/Redesign(5).md)

```text
You are Kilo, executing Phase 5 (docs/Redesign(5).md — Results Grid, /work
Filters, Detail Pages, Sitemap & Nav Relink) of the Chada Digital V4
redesign. Read Implementation_redesign.md §1 and §2 first. Depends on Phase
2 only — can run in parallel with Phase 3, 4, and 6.

Branch: git checkout -b feat/v4-r5

Execute docs/Redesign(5).md TASK 1 through TASK 7 exactly as written.

Watch for these:
- TASK 1 creates `x-result-card` — a NEW, text-led component (client name +
  metric + excerpt + link, no thumbnail) for the HOMEPAGE grid. This is
  deliberately different from the EXISTING `x-case-study-card` (thumbnail
  grid card), which stays as-is for the `/work` archive page. Don't
  conflate the two or try to unify them — the doc explains why they
  differ (dense homepage grid vs. richer archive page) and this is
  intentional, not duplication to clean up.
- The homepage case-studies section has NO lorem fallback (unlike almost
  everything else in this build) — it renders nothing until real,
  published, verified-metric studies exist. Don't add a lorem fallback
  "to be consistent" with other sections; the doc is explicit that a lorem
  *result* would be a fake result, which is exactly what constraint 14
  exists to prevent.
- TASK 6 (sitemap) reverses the Q9 freeze — update the routes/web.php
  comment as instructed (the doc gives you the exact old/new text). This
  is a real, meaningful change: case studies go from "frozen, unrouted"
  to "core homepage section, in the sitemap."
- TASK 7 fixes bug 1 from Implementation_redesign.md §4.1 — FIRST PASS
  only (drops dead `#process`/`#products` anchors, relinks Work). Phase 8
  does the final version once `/services` exists. Don't be surprised the
  nav isn't "finished" after this phase — that's expected.

VERIFY: run docs/Redesign(5).md's full verification block (8 steps),
including the scratch-publish-test on one study (step 5) — publish, verify
result cards/filters/detail page all light up correctly, then REVERT before
committing. Step 6 checks that "PENDING DAVID" and "Placeholder" never leak
into rendered HTML — this is the load-bearing check for the whole gating
model, don't skip it.

Commit as: feat(v4-r5): results grid on home + /work filters + detail
gating + sitemap/nav relink
Open a PR. Do not merge it yourself.
```

---

### Phase 6 — /services page (docs/Redesign(6).md)

```text
You are Kilo, executing Phase 6 (docs/Redesign(6).md — Tiered Pricing Page)
of the Chada Digital V4 redesign. Read Implementation_redesign.md §1 and §2
first. Depends on Phase 2 only. Phase 5's sitemap change already has a
defensive `Route::has('services')` check specifically so this phase can
merge independently, in any order relative to Phase 5 — can run in
parallel with Phase 3, 4, and 5.

Branch: git checkout -b feat/v4-r6

Execute docs/Redesign(6).md TASK 1 through TASK 6 exactly as written.

Watch for these:
- TASK 1 (PricingService): notice the `tier()` private helper generates 15
  cards from 3 calls rather than 15 hand-written arrays. This is
  deliberate — fewer places to hand-type prose means fewer places
  invented or borrowed copy could sneak in. Every price/title/description
  is null; nothing in this service is content, only structure + gates.
  Do not "helpfully" fill in example service names or prices — that is
  exactly what Open_Decision.md Q3 is still open on.
- TASK 6 (TODO-Placeholders.md): READ THE RECONCILIATION NOTE in the doc
  before appending anything. The upstream rewrite (commit `ed76bea`)
  already added a `/services` pricing section (§10) covering these same
  rows. Diff against the current file first — if §10 already covers it,
  this task is a no-op; say so explicitly in the PR body rather than
  duplicating rows.
- Card copy: "Who it is for:" (no apostrophe) and "Get Started" are the
  locked label choices from the doc — matches the vocabulary already
  established in Phase 3's goal-picker cards. Don't introduce a third
  phrasing for the same concept.

VERIFY: run docs/Redesign(6).md's full verification block — confirm all 15
cards render "Contact for pricing" (grep count = 15), confirm zero
"PENDING DAVID" leaks into rendered HTML, confirm /services appears in the
sitemap automatically via Phase 5's guard.

Commit as: feat(v4-r6): /services page — PricingService, tiered cards,
lorem catalog slots
Open a PR. Do not merge it yourself.
```

---

### Phase 7 — Demo Lab + MarTech grid (docs/Redesign(7).md)

```text
You are Kilo, executing Phase 7 (docs/Redesign(7).md — Demo Lab + MarTech
Integrations Grid) of the Chada Digital V4 redesign. Read
Implementation_redesign.md §1 and §2 first. Depends on Phase 5 (needs the
home.blade.php include positions/insertion comments Phase 5 leaves behind)
— run this AFTER Phase 5 merges, not in parallel with it.

Branch: git checkout -b feat/v4-r7

Execute docs/Redesign(7).md TASK 1 through TASK 5 exactly as written.

Watch for these:
- This is the one section shipping with REAL content immediately, not
  gated lorem — Chada already owns 6 real interactive demos in
  `public/demos/` (untouchable — constraint 1). The tab/panel UI is the
  only new thing being built; the demo content itself needs zero new work.
- Chrome honesty rule (the doc calls this out explicitly, worth repeating):
  the "Live demo" chip is literally true, so it's fine — but never add a
  fake API-status badge, a third-party product name, or an "Auto-Synced"
  style claim to make a panel look more sophisticated. If a real
  integration badge is warranted later, it lands per-demo with evidence,
  not now.
- MarTech badges read "READY" — not "Verified Integration" (that phrase
  implies third-party certification Chada doesn't hold, and is also on
  the Gate 2 blocklist in Phase 9 — using it would fail the launch gate).
- TASK 5 has you replace TWO separate insertion comments in home.blade.php
  (one for demo-lab, positioned before workflow-system; one for martech,
  positioned after testimonials) — don't miss the second one.

VERIFY: run docs/Redesign(7).md's full verification block (6 steps) —
confirm 6 demo tabs, 6 panels, 9 martech cards, all 6 demo iframe targets
return 200, and `git status public/demos/` is clean (untouched).

Commit as: feat(v4-r7): demo lab tabs + martech filter grid
Open a PR. Do not merge it yourself.
```

---

### Phase 8 — Global chrome: header, footer, chat, SEO (docs/Redesign(8).md)

```text
You are Kilo, executing Phase 8 (docs/Redesign(8).md — Header, Footer, Chat
Widget Wiring, Meta/OG, JSON-LD) of the Chada Digital V4 redesign. Read
Implementation_redesign.md §1 and §2 first. Depends on Phase 5 (routes/
anchors), Phase 6 (/services route), and Phase 7 (#demo-lab anchor) — all
three must be merged first. This is sequential, not parallelizable with
anything.

Branch: git checkout -b feat/v4-r8

Execute docs/Redesign(8).md TASK 1 through TASK 5 exactly as written.

Watch for these:
- TASK 1 is the FINAL fix for bug 1 (Implementation_redesign.md §4.1) — nav
  becomes Work / Services / About / Contact, with Services now pointing at
  the real `/services` route from Phase 6. Do not touch the logo, the
  sticky/backdrop-blur wrapper, or the existing `nav-toggle` JS bindings —
  the doc is explicit about this.
- TASK 2 (footer): the doc enforces "no dead links" — Blog/Calculator/
  Webinar are NOT in the footer because those pages don't exist yet. If
  you're tempted to add them "for completeness," don't — a link to a 404
  is worse than no link, and it's explicitly listed as deferred scope in
  Phase 9 §8.
- TASK 3 (chat widget): read this carefully — while
  `placeholders.chat.whatsapp_number` is null, the button MUST stay a
  documented no-op (no `wa.me` link rendered at all). The doc's
  verification step 1 greps for `wa.me` on every page and fails if it's
  present while the number is null — this is a real gate, not a
  suggestion.
- TASK 4 (JSON-LD): the founder Person node is gated by the BOOLEAN
  `founder.real` flag, not by comparing the name string against lorem
  output — use the flag exactly as shown, string-comparison gating is
  fragile and the doc deliberately avoids it.

VERIFY: run docs/Redesign(8).md's full verification block (6 steps) —
including the scratch-test for chat wiring (set a real number you control,
confirm the WhatsApp link + prefill work, then revert) and the JSON-LD
validator check (paste the output into validator.schema.org).

Commit as: feat(v4-r8): global chrome — nav, footer, chat wiring, schema,
meta
Open a PR. Do not merge it yourself.
```

---

### Phase 9 — QA, performance, originality compliance, launch (docs/Redesign(9).md)

```text
You are Kilo (or the Tech Lead directly — this phase is largely verification,
not new code), executing Phase 9 (docs/Redesign(9).md — QA, Performance,
Originality Compliance, Deployment & Launch Gates) of the Chada Digital V4
redesign. This is the LAST phase — depends on Phases 2 through 8 ALL being
merged to main. Do not start this against a partially-merged main.

This phase builds nothing except an optional cookie-consent snippet (§5),
and only if analytics are actually being added — which this redesign does
not do. Its job is entirely to verify everything doc 2–8 built, then walk
the deploy.

Run every command in docs/Redesign(9).md §1 (12 grep gates) against a local
build first, then again against the deployed revision before release. Pay
special attention to the THREE gates that exist specifically because of
this project's history:
- GATE 2 (DMCA gate) — greps rendered pages for a blocklist of the
  reference site's actual real content (names, numbers, section titles).
  This is the automated enforcement of Open_Decision.md Q0 and the whole
  reason V3 got purged.
- GATE 9 (repo-wide sweep) — greps the ENTIRE repo, not just rendered
  pages, for any reference to the reference site's name — including code
  comments and docs. The only sanctioned exceptions are the gate
  definitions themselves in this doc and the prohibition statements in
  Redesign(1).md §3/§8.
- GATE 11 (Lorem integrity) — confirms the generator still emits no
  digits and is still deterministic. If either check fails, something
  regressed the generator itself — stop and fix before anything else.

Then run §2's full functional test matrix (F1–F13) and §3's Lighthouse
budget. §4.2's originality review is a Tech-Lead-only manual step — per the
doc's own standing rule, if a live comparison against the reference site is
genuinely needed for this review, the Tech Lead does it manually, in a
browser that touches no repo tooling, and records only pass/fail — never
quoted text. This is the one sanctioned, narrow exception to "never fetch
the reference site" (constraint 11 / §0 above), and it's scoped
deliberately tightly.

§6 is the actual deploy runbook — follow it exactly, including the
smoke-test-through-the-maintenance-bypass-URL step BEFORE releasing
`scripts/maintenance-lock.sh off`. Do not release the lock until gates 1,
2, and 9 all pass clean on the deployed revision, not just locally.

§7 splits sign-off into two independent checklists — "structure-complete"
(code-only, can happen under maintenance lock / soft launch) and
"content-complete" (David's gates, tracked in TODO-Placeholders.md). The
site can be structure-complete long before it's content-complete — that's
expected, not a blocker to merging this phase.

Commit (only if the optional consent snippet was built) as: chore(v4-r9):
QA gates, perf budget, originality program, NDPA review, deploy runbook
This is the launch PR — its body should record the full F1–F13 results,
the Lighthouse scores, and the §4.2 originality review sign-off. Do not
merge without a human (Tech Lead, or Tech Lead + Founder per row 0)
explicitly signing off — this is not a "does it build" merge, it's the
go-live decision.
```

---

## 8. File change map (whole series, for orientation)

**CREATE (13):** `app/Support/Lorem.php` · `partials/stats-bar.blade.php` ·
`partials/audit-cta.blade.php` (via `git mv` from `assessment-cta`) ·
`partials/working-together.blade.php` · `partials/webinar-optin.blade.php` ·
`partials/workflow-system.blade.php` · `partials/demo-lab.blade.php` ·
`partials/martech.blade.php` · `components/result-card.blade.php` ·
`components/service-card.blade.php` · `components/stats-badge.blade.php` ·
`pages/services.blade.php` · `app/Services/PricingService.php`

**MODIFY (14):** `CaseStudyService.php` · `config/placeholders.php` ·
`pages/home.blade.php` · `partials/hero.blade.php` · `partials/goal-picker.blade.php` ·
`partials/services-checklist.blade.php` · `partials/founder-bio.blade.php` ·
`partials/testimonials.blade.php` · `components/workflow-diagram.blade.php` ·
`pages/work.blade.php` · `pages/case-study.blade.php` · `partials/header.blade.php` ·
`partials/footer.blade.php` · `partials/chat-widget.blade.php` ·
`partials/structured-data.blade.php` · `partials/meta.blade.php` ·
`PageController.php` · `routes/web.php` · `resources/js/app.js` ·
`TODO-Placeholders.md`

**DELETE: nothing.** `process`, `about`, `services`, `products` partials stay
unrouted, not removed — this build has reversed direction three times
already; zero deletions means rollback is always just `git revert`.

**NEVER TOUCH:** `public/demos/**`, `ContactController.php`,
`resources/js/modules/contact-form.js`, `resources/js/modules/mobile-nav.js`,
`resources/sass/_tokens.scss` (V5 — see `docs/Redesign(10).md` §2),
`webpack.mix.js`, `composer.json`, `package.json`,
migrations, `.github/workflows/deploy.yml`, `scripts/maintenance-lock.sh`.
*(V4's `tailwind.config.js` was deleted in Phase 10 — see `docs/Redesign(10).md` §7.3.)*

---

## 9. Launch gates (Phase 9 / R9 — summary, full commands live in docs/Redesign(9).md)

- **Gate 1:** zero `PENDING`/`Placeholder` markers in rendered HTML on any page
- **Gate 2 (DMCA gate):** grep rendered DOM for a blocklist of reference-site-specific strings (real client names, real stats, real section titles) — expect zero hits
- **Gate 9 (repo-wide DMCA sweep):** grep the entire repo — code, views, docs, comments — for any reference to the reference site's name or founder, expect zero hits outside this file's and docs/Redesign(9).md's own sanctioned blocklist definitions
- **Gate 10:** zero emoji in `resources/views/` — SVG icons only
- Full functional test matrix, Lighthouse ≥ 90 mobile, sitemap validity, 404/503 page checks — see `docs/Redesign(9).md` for exact commands

**Do not mark this ready to launch** while any `TODO-Placeholders.md` row it
depends on is unchecked, and don't release `scripts/maintenance-lock.sh` until
gates 1, 2, and 9 all pass clean.

---

## 9.5 Phase 10 — Visual pivot (V5) — `docs/Redesign(10).md`

```text
You are Kilo, executing Phase 10 (docs/Redesign(10).md — Visual System Migration:
Tailwind → Bootstrap 5.3 + Material Web Components + Material Symbols + Inter)
of the Chada Digital V5 redesign at DGCodeIdeas/chada.digital. Read
Implementation_redesign.md §1 and §2 first — all V4 constraints apply with the
updates in §1 (constraint 4 expanded to allow Bootstrap/M3/Material Symbols;
constraint 9 updated for the no-borders rule).

Branch: git checkout -b feat/v5-visual-pivot

Execute docs/Redesign(10).md TASK 1 through TASK 8 exactly as written.

DEPENDENCY CHECK BEFORE STARTING:
- Phase 2 (R2 data layer) merged? YES (PR #8 / merged via PR #9)
- Phase 3 (R3 homepage A) merged? YES (PR #9, d0b4cd5)
- Phase 4 (R4 System Blueprints) merged? NO — PR #11 still open as of this audit.
  RECOMMENDED: merge PR #11 BEFORE starting Phase 10, so the workflow-system
  partial is migrated as part of this phase (§8 row 13). Otherwise Phase 10
  lands and R4's Tailwind classes need a separate follow-up commit.
- Phase 5 (R5) was reverted (PR #13). Should be re-attempted AFTER R4 merges.
  Does not block Phase 10 if R5 is still pending — Phase 10's migration covers
  the x-result-card partial (§8 row 14) regardless of whether R5 has shipped.

WHAT THIS PHASE CHANGES (high-level — see docs/Redesign(10).md for full spec):
- Tailwind CSS v3 → Bootstrap 5.3 + Material Web Components + Material Symbols + Inter
- Loading order: Bootstrap → M3 → custom SCSS (binding)
- All visible borders removed (form focus rings, M3 elevation shadows only)
- Trust strip partial → Design Partner band ("No customer logos yet — we won't fake them. Become a design partner.")
- Typography: Inter (single font, varied weights) + Material Symbols; Outfit dropped
- Design tokens move from tailwind.config.js (JS) → resources/sass/_tokens.scss (SCSS mapped to M3 CSS custom properties)

WHAT THIS PHASE DOES NOT CHANGE:
- All Blade partials' structural HTML, gating, content calls
- All routes, controller signatures, mix() asset loading
- The 18-pattern homepage architecture from V4 §1
- All originality/DMCA rules

VERIFY: run all 10 grep gates from docs/Redesign(10).md §9.1, plus the 7 visual
gates from §9.2. Both the Tech Lead and Founder must sign off — this is a
system-wide visual pivot, not a routine merge.

Commit as: feat(v5): visual system migration — Tailwind → Bootstrap 5.3 +
Material Web Components + Material Symbols + Inter. No-borders fusion.
Design Partner band replaces trust strip.

Open a PR. Do not merge yourself.
```

---

## 10. Open items unaffected by this build

Q1 (hero copy), Q2 (client logos), Q3 (six offers + real prices), Q5
(testimonials), Q6 (founder bio + photo), Q7 (exclusivity tone), Q8 (chat
tool/persona/number) are all still open — this series ships the structure
those decisions will eventually populate, not the decisions themselves. See
`TODO-Placeholders.md` for what to send David, `Open_Decision.md` for why
each one is still open, and `REDESIGN_IMPLEMENTATION.md` §8 for the full
open-decisions table with V4 statuses.
