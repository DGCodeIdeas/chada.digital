# Implementation_redesign.md — Master Build Reference for Kilo

> **Purpose:** the one file Kilo loads at the start of every session on this
> redesign. It carries the constraints, the content-safety model, the current
> verified repo state, and the full phase map. For the detailed code-level
> spec of whichever phase you're executing, pair this file with the matching
> `docs/Redesign(N).md` (V4 series) — this file won't repeat their full code, only
> orient you and give Phase 1 as a ready-to-run task block.
>
> **Spec of record:** `REDESIGN_IMPLEMENTATION.md` (repo root). This file is the
> orientation layer; that file is the full clarified spec — decision history
> (C1–C12 structural corrections, D1–D12 originality directives), the
> 18-pattern table, acceptance criteria, risk register, and sign-off tables.
> The nine build docs live in `docs/Redesign(1).md` … `docs/Redesign(9).md`;
> content gates are tracked in `TODO-Placeholders.md` and open decisions in
> `Open_Decision.md`. If this file and the spec of record ever disagree, the
> spec of record wins — fix this file.
> **Supersedes:** any earlier "V3" doc series, PR #6 (`feat/wab-complete-replication-spec`
> v1, closed), and the standalone `REDESIGN_IMPLEMENTATION_PROMPT.md` from the V2-only
> build (archived as `archive/IMPLEMENTATION_PROMPT_ARCHIVED.md`). Do not open,
> reference, or resurrect the old V3 doc series — it
> carried third-party verbatim copy from the reference site and was
> deliberately purged. If you ever see it in the repo, delete it and flag it.
> **Repo:** `DGCodeIdeas/chada.digital` · branch off `main` · HEAD audited `8ed949d` (2026-08-27)
> **Ratified by:** Tech Lead (Q9 — case-study fate: keep+populate+relink; the
> originality/content model below). **Still needs Founder sign-off** on the
> spec as a whole (row 0 of the sign-off table) before Phase 2 onward ships
> to production — Phase 1 (data layer) is safe to start regardless, since it
> changes nothing visible.

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
2.  mix() not @vite(). 3. bun not npm. 4. ZERO new dependencies
    (App\Support\Lorem is pure PHP — allowed).
5.  Preserve route names: home, work, case-study.show, preview.show,
    preview.subpage, contact.submit, sitemap — plus new: services.
6.  Keep the contact form's honeypot + AJAX validation exactly as-is.
7.  PHP 8.2 constructor promotion for new services/controllers.
8.  Blade components (<x-…>) for reusable markup.
9.  Chada style charter: rounded-2xl cards, eyebrow labels
    (text-xs uppercase tracking-[0.3em]), Outfit (display) / Inter (body),
    one text-primary highlighted word per heading, SVG line icons only —
    NEVER emoji.
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

### 4.1 Two known live bugs — fix these explicitly, they're not called out elsewhere

1. **Dead nav anchors.** `header.blade.php` currently links to `/#services`,
   `/#process`, `/#products` — none of these IDs exist on the page anymore
   (sections were restructured in V2). Fix when R8 rebuilds the header —
   point nav at real current sections (`#goals`, `#services-checklist`, etc.)
   or drop the dead links entirely.
2. **Broken founder image.** `founder-bio.blade.php` references
   `/assets/images/founder-placeholder.jpg`, which was never created —
   renders as a broken image icon. Fix when R3 touches founder-bio: either
   create a real placeholder graphic (silhouette/initials, not a stock photo
   of a real person) or gate the `<img>` tag itself behind `founder.real`
   the same way the bio text is gated.

---

## 5. Phase map

| Phase | Docs | Scope | Exit criteria |
|---|---|---|---|
| **0. Ratify** | — | Founder + Tech Lead confirm the keep-decisions and 18-pattern target; close Q9 | Sign-off row; PR #6 closed in favor of this build |
| **1. Data layer** | R2 | `App\Support\Lorem`, `CaseStudyService` v2, `config/placeholders.php` v4, TODO rows | Determinism + rotation smoke tests pass; homepage visually unchanged |
| **2. Homepage A** | R3 | Hero, stats-bar, goal-picker price block, audit-cta, working-together, 12-item checklist, webinar-optin (off), founder slots + bug fix, testimonials+standards (off) | R3 verification passes |
| **3. Signature systems** (parallel) | R4 ∥ R5 ∥ R6 | R4: System Blueprints. R5: result cards + /work + case-study detail + sitemap + relink. R6: /services page | Each doc's verification passes |
| **4. Demos + integrations** | R7 | demo-lab (6 tabs), martech grid + JS filter | `public/demos/` untouched |
| **5. Chrome + SEO** | R8 | Header/footer final + nav bug fix, chat wiring, JSON-LD, meta | R8 verification passes |
| **6. Gate + launch** | R9 | All grep gates, functional matrix, Lighthouse, originality review, NDPA, deploy runbook, maintenance-lock release | Human sign-off |

**Branch per doc:** `git checkout main && git pull && git checkout -b feat/v4-r{n}`. Never work directly on `main`. One PR per doc. Do not merge your own PRs.

---

## 6. Phase 1 — ready to execute now (Data layer)

```text
You are Kilo, executing Phase 1 (docs/Redesign(2).md — Data layer) of the Chada
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
```

---

## 7. Phases 2–6 — execute with the matching docs/Redesign(N).md

This file gives you orientation and constraints; it does not repeat the full
task-by-task code for R3–R9. For each subsequent phase:

1. Confirm Phase 1's PR is merged and `main` is current.
2. Branch: `feat/v4-r{n}`.
3. Open **both** this file and the matching `docs/Redesign(N).md` for that phase.
4. Re-read §1 (constraints) and §2 (content model) here before starting —
   they apply identically to every phase.
5. Execute `docs/Redesign(N).md` top to bottom; it quotes exact current file
   state for anything it modifies. If what it quotes doesn't match what's
   actually in the file, stop and reconcile — don't guess which is current.
6. Run that doc's own verification block, plus a fresh `bun run dev`.
7. For Phase 5 (R8) specifically: confirm both bugs in §4.1 above are fixed
   as part of the header/founder-bio work, not just the R8 spec's own scope.
8. Commit per task, open one PR per doc, don't merge your own.

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
`tailwind.config.js`, `webpack.mix.js`, `composer.json`, `package.json`,
migrations, `.github/workflows/deploy.yml`, `scripts/maintenance-lock.sh`.

---

## 9. Launch gates (Phase 6 / R9 — summary, full commands live in docs/Redesign(9).md)

- **Gate 1:** zero `PENDING`/`Placeholder` markers in rendered HTML on any page
- **Gate 2 (DMCA gate):** grep rendered DOM for a blocklist of reference-site-specific strings (real client names, real stats, real section titles) — expect zero hits
- **Gate 9 (repo-wide DMCA sweep):** grep the entire repo — code, views, docs, comments — for any reference to the reference site's name or founder, expect zero hits outside this file's and docs/Redesign(9).md's own sanctioned blocklist definitions
- **Gate 10:** zero emoji in `resources/views/` — SVG icons only
- Full functional test matrix, Lighthouse ≥ 90 mobile, sitemap validity, 404/503 page checks — see `docs/Redesign(9).md` for exact commands

**Do not mark this ready to launch** while any `TODO-Placeholders.md` row it
depends on is unchecked, and don't release `scripts/maintenance-lock.sh` until
gates 1, 2, and 9 all pass clean.

---

## 10. Open items unaffected by this build

Q1 (hero copy), Q2 (client logos), Q3 (six offers + real prices), Q5
(testimonials), Q6 (founder bio + photo), Q7 (exclusivity tone), Q8 (chat
tool/persona/number) are all still open — this series ships the structure
those decisions will eventually populate, not the decisions themselves. See
`TODO-Placeholders.md` for what to send David, `Open_Decision.md` for why
each one is still open, and `REDESIGN_IMPLEMENTATION.md` §8 for the full
open-decisions table with V4 statuses.
