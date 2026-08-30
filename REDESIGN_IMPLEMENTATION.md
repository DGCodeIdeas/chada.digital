# REDESIGN_IMPLEMENTATION.md — Pattern Replication, Original Expression (v3, CLARIFIED)

> **Mandate (two layers, both binding):** The Founder directed that Chada Digital's site adopt the conversion architecture of a leading competitor. The Tech Lead's V4 directive governs the execution: **patterns are replicated; expression is not.** All marketing content ships as dynamic Lorem Ipsum; all styling follows Chada's own established design language; no third-party sentence, name, price, metric, image, or distinctive section title may appear in the DOM or the repo.
> **Stack:** Laravel 12 + Blade + **Bootstrap 5.3 + Material Web Components (@material/web) + Material Symbols + Inter** · Laravel Mix · Bun (never npm) · PHP 8.2+ — *V5 supersedes the V4 Tailwind stack; see `docs/Redesign(10).md` for the migration spec*
> **Repo:** `DGCodeIdeas/chada.digital` · default branch `main` (HEAD audited: `8ed949d`, 2026-08-27)
> **This version:** v3 — CLARIFIED. It supersedes (a) the v1 spec of the same name on PR #6 (closed; branch deleted) and (b) the V3 doc series produced 2026-08-27. It corrects v1's deletions, resolves every ambiguity v1 left open, folds in the Tech Lead's originality directive, and binds the build to the nine agent-ready documents `docs/Redesign(1).md` … `docs/Redesign(9).md` (V4).
> **Status:** Build-ready. Blocked only on real content (client names, metrics, workflow steps, pricing) — never on structure.
> **Companion docs:** `Implementation_redesign.md` (repo root) is the condensed per-session orientation file coding agents start from — it restates the constraints, the content model, and the phase map, then hands off to the matching `docs/Redesign(n).md`. This doc remains the spec of record (decision history, acceptance criteria, sign-off tables). Content gates are tracked in `TODO-Placeholders.md`; open decisions in `Open_Decision.md`. If any companion disagrees with this doc, this doc wins.

---

## 0. What "clarified" means here

### 0.1 History in one paragraph

The v1 spec (PR #6) was built from a partial audit and proposed a build that would have **deleted already-correct sections**. The v2 clarification (2026-08-27) was produced from a complete live audit cross-referenced against a direct read of every relevant file on `main`, and correctly resolved the architecture as the **union** of V2 and PR #6 plus one section nobody had spec'd (tabbed interactive demos). But v2's doc series quoted the audited site's copy verbatim throughout — as reference material. The Tech Lead (V4) has now ruled that out: **the DMCA exposure of carrying and following verbatim third-party copy is unacceptable.** This v3 keeps every structural decision from v2 and replaces every quoted string with generated Lorem Ipsum, null gates, or Chada-original chrome labels.

### 0.2 v1 → v2 structural corrections (C-series — all still binding)

| # | v1 (PR #6) said | v2 corrected to | Why |
|---|---|---|---|
| C1 | DELETE `goal-picker.blade.php` | **KEEP + UPGRADE** — the homepage IS six tiered offer cards with a price block. The V2 skeleton was directionally right; it was missing the price block | Pattern audit, section 4 |
| C2 | DELETE `assessment-cta.blade.php` | **KEEP + RENAME + UPGRADE** to `audit-cta` — the free-consult CTA sits between offers and checklist | Pattern audit, section 5 |
| C3 | DELETE `services-checklist.blade.php` | **KEEP + UPGRADE** to a 12-item two-column checklist | Pattern audit, section 7 |
| C4 | DELETE `founder-bio.blade.php` | **KEEP** — the founder block is a core section | Pattern audit, section 9 |
| C5 | DELETE `exclusivity-cta.blade.php` | **KEEP** — the selective-availability closing CTA is a core section | Pattern audit, section 16 |
| C6 | "9 horizontal pipeline diagrams" — data source unspecified | **Specified**: one pipeline per case study, driven by `CaseStudyService::verifiedWorkflows()`, Tech-Lead-verified before render | PR #5 incident lesson |
| C7 | "Populate `CaseStudyService` with 9+ real case studies" — risk of inventing metrics | **6 structured entries** (one per real demo) + published/verified gates; metrics stay null until David verifies each. "6 real beats 9 faked" | PR #5 was reverted precisely because fabricated metrics shipped |
| C8 | Did not mention the tabbed interactive demos section at all | **NEW SECTION spec'd** — Chada replicates the pattern with 6 tabs embedding the real `public/demos/` via iframes | Pattern audit, section 10 |
| C9 | Testimonials: "replace with real quotes or hide" | **Kept as config-driven skeleton** + optional standards band above | Pattern audit, section 14 |
| C10 | Home sequence: hero → workflow → case studies → stats → trust → testimonials → founder → martech → manifesto → contact | **Corrected full order** (17 sections, §1 below) — stats bar directly under hero, trust bar before goal cards, checklist after the free-consult CTA, opt-in, founder before the demo lab | Pattern audit, full sequence |
| C11 | "Build `partials/stats-bar` (5 big numbers)" | **4 numbers per bar** (homepage renders 4, twice); the 5-number band belongs to `/services` | Pattern audit |
| C12 | Sitemap, JSON-LD, NDPA, performance budget: absent or one line | **Full gates** in docs/Redesign(5).md, (8), (9) | — |

### 0.3 v2 → v3 originality directives (D-series — the Tech Lead's ruling, all binding)

| # | v2 (V3 doc series) did | v3 (this doc + V4 series) does instead |
|---|---|---|
| D1 | Mandate worded as "complete replication… Not inspiration. A replicate." | **Pattern replication, original expression.** Structure and conversion mechanics are replicated; every string, name, number, and visual treatment is Chada's own or generated |
| D2 | Quoted the reference site's copy verbatim inside the docs (headlines, prices, pipelines, client names, founder references) | **All quotes purged.** The doc set is self-contained; §1 describes every section as an abstract pattern with no third-party text |
| D3 | Agent protocol: "when confused, prefer the live site — the live site wins" | **Agents never fetch the reference site.** These documents are the only build reference; uncertainty is raised to the Tech Lead |
| D4 | Static lorem strings hand-written in `config/placeholders.php` | **Dynamic Lorem Ipsum generator** (`App\Support\Lorem`, pure PHP): seeded, request-memoized, digit-free word bank; rotating `placeholders.lorem_seed` regenerates all placeholder prose site-wide |
| D5 | Signature sections carried the reference site's verbatim section titles | **Chada's own titles**: "System Blueprints" (eyebrow "Under the Hood"), Demo Lab ("Proof of Build" / "See the systems in action.") — the purged titles survive only as detection patterns in R9's grep blocklist |
| D6 | Case card component named `x-wab-case-card`, emoji client marker, borrowed CTA line and heading | **`x-result-card`**: SVG briefcase icon, client name, "Read the case study" CTA, "Built, shipped, measured." heading |
| D7 | PricingService pre-filled with another agency's service names | **Pure structure + gates**: titles/descriptions are lorem slots keyed per card; tier names are Chada chrome (Advisory Sessions / Full Builds / Ongoing Care) |
| D8 | Borrowed CTA vocabulary ("Book Now", "Learn More", "Investment" label, "Request Free Audit") | **Chada chrome**: "Start a Project", "Explore Our Work", "Get Started", "Pricing" label, "Request a Free Review" |
| D9 | Offerings/prices/metrics from the reference site quoted as "evidence" in the doc tables | **Abstracted away.** No third-party figure appears anywhere except inside docs/Redesign(9).md's grep blocklist (detection patterns, not content) |
| D10 | Emoji icons on tabs and cards | **SVG line icons only** (style charter rule; QA gate 10) |
| D11 | Founder JSON-LD gated on a string comparison against lorem text | **`founder.real` boolean flag** — robust gate; same flag activates the Person node |
| D12 | "Trusted by 50+ brands" hardcoded in the hero (unverified claim) | **Gated** `placeholders.hero.proof_line` (null → hidden) |

**One-line summary of the clarification:** *v1 tried to replace the V2 skeleton with half the architecture; v2 proved both halves belong on one page — but quoted the wrong source while doing it; v3 keeps v2's structure, deletes every borrowed string, and replaces the content system with dynamic Lorem Ipsum + gates + Chada chrome so there is nothing left to infringe.*

---

## 1. The target architecture (pattern table — the single source of truth)

Eighteen patterns, in order. This table is the definitive scope. Descriptions are structural — see docs/Redesign(1).md §1 for the full anatomy of each.

| # | Pattern | Chada V4 build | Doc |
|---|---|---|---|
| 1 | Hero — eyebrow + outcome H1 + subtext + dual CTA | `hero` upgraded (dual CTA, lorem copy, gated proof line) | R3 |
| 2 | Stats band — 4 big numbers | `stats-bar` NEW, variant `home_top`, content-gated | R3 |
| 3 | Client logo strip | `trust-bar` kept (guarded — already correct) | — |
| 4 | Six tiered offer cards — badge, title, description, **price block**, CTA | `goal-picker` upgraded with Pricing block (null → "Contact for pricing") | R3 |
| 5 | Free consult CTA | `assessment-cta` → **renamed `audit-cta`**, free-review framing, lorem copy | R3 |
| 6 | Transition band | `working-together` NEW (lorem copy) | R3 |
| 7 | Agency paragraph + 12-item activities checklist + dual CTA | `services-checklist` upgraded to 12 real capability items | R3 |
| 8 | Gated-content opt-in (6-field form) | `webinar-optin` NEW, **disabled until real asset** | R3 |
| 9 | Founder bio — photo, bullets, CTA | `founder-bio` kept + lorem slots + `real` flag | R3 |
| 10 | Tabbed interactive demos — tabs + embedded live systems | `demo-lab` NEW — 6 tabs embedding real `public/demos/` iframes + honest live-demo chrome | R7 |
| 11 | Pipeline diagrams — steps + tools + arrows, badge, optional speed line | `workflow-system` NEW — "System Blueprints"; pipelines from verified case studies; speed claim config-gated | R4 |
| 12 | Results grid — text-led cards (client + metric + description + link) | `case-studies` included on home + `x-result-card` NEW; gated by `published` | R5 |
| 13 | Stats band (repeat, 4 numbers) | `stats-bar` variant `home_bottom` | R5 |
| 14 | Standards band + testimonial cards | `testimonials` kept + config-gated standards band; lorem cards until real quotes | R3 |
| 15 | Integrations grid — filter pills + tool cards with readiness badges | `martech` NEW — jQuery filter, real stack tools, honest "READY" badges | R7 |
| 16 | Selective-availability closing CTA | `exclusivity-cta` kept (lorem copy) | — |
| 17 | Footer — 4-zone multi-column | `footer` upgraded (no dead links, Chada tier anchors) | R8 |
| 18 | Persistent chat widget | `chat-widget` config-gated WhatsApp wiring; lorem persona until Q8 | R8 |

Secondary pages: `/services` (tiered pricing page — **R6**), `/work` (filterable grid — **R5**), `/case-study/{slug}` (detail pages — **R5**), sitemap + nav relink (**R5/R8**). Deferred with reasons: calculator, blog, webinar, training, shop pages (R9 §8).

---

## 2. Non-negotiable constraints

```
1.  NEVER touch public/demos/.
2.  mix() not @vite(). 3. bun not npm. 4. ZERO new dependencies
    (App\Support\Lorem is pure PHP — allowed).
5.  Preserve route names (home, work, case-study.show, preview.show,
    preview.subpage, contact.submit, sitemap — plus new: services).
6.  Keep the contact form's honeypot + AJAX validation exactly as-is.
7.  PHP 8.2 constructor promotion for new services/controllers.
8.  Blade components (<x-…>) for reusable markup.
9.  Follow the Chada style charter (docs/Redesign(1).md §5): rounded-2xl cards,
    eyebrow labels, Outfit/Inter, one text-primary highlighted word,
    SVG icons only — no emoji.
10. Placeholder prose is GENERATED: $real ?? \App\Support\Lorem::…(key).
    config/placeholders.php holds seeds, gates, and chrome labels only.
    Real, stable content lives in service classes.
11. ORIGINALITY (DMCA rule): never copy third-party text, names, prices,
    metrics, imagery, or distinctive section titles; never fetch or quote
    the reference site; these docs are the only build reference; the repo
    (docs included) stays free of third-party copy.
12. Escape apostrophes in single-quoted PHP strings — php -l every touched
    file (the Aug 20 PR #5 500 was an unescaped apostrophe).
13. bun run dev clean after every change; bun run prod before phase done.
14. NEVER invent real-sounding content: no fake client names, metrics,
    testimonials, or prices. The Lorem word bank has no digits. Factual
    claims wait for David.
```

---

## 3. The content model (how structure ships before facts — and before copy)

Every string in the build is one of exactly three kinds (full definition: docs/Redesign(1).md §4):

| Kind | Lives where | Renders as | Replaced by |
|---|---|---|---|
| **A. Chada chrome** | config / inline in views | Fixed short UI labels ("Start a Project", "Under the Hood", "READY") | A content decision — never silently |
| **B. Generated lorem** | `App\Support\Lorem` calls keyed by slot | Deterministic lorem per request; rotating `lorem_seed` regenerates site-wide | Real copy lands in config/service; the `??` fallback goes dormant |
| **C. Gated facts** | null/false gates | Nothing (or a labeled fallback: "Contact for pricing") | David (or the Tech Lead for workflows) flips the gate |

**Gate inventory (every one, with its mechanism):**

| Gate | Mechanism | Effect while gated | Lights up when |
|---|---|---|---|
| Offer prices | `placeholders.offers.*.price_ngn` = null | Pricing block shows "Contact for pricing" | David sets prices |
| Stats bars | all `value` = null in a variant | Section renders nothing | David supplies verified numbers |
| Case studies | `published => false` | Entry renders nowhere; `/case-study/{slug}` 404s | David verifies metric + narrative |
| Workflow pipelines | `workflow.verified => false` | No pipeline in System Blueprints | Tech Lead verifies every step/tool |
| Speed claim | `placeholders.workflow_speed_claim` = null | Line absent | David approves a measured claim |
| Opt-in section | `placeholders.webinar.enabled` = false | Section absent | Real replay/masterclass asset exists |
| Standards band | `placeholders.manifesto.enabled` = false | Band absent | David approves principles |
| Chat widget | `placeholders.chat.whatsapp_number` = null | Documented no-op | Q8 answered with real number |
| Trust bar | `$clientLogos = []` | Section absent (pre-existing behavior) | Client logo permissions |
| Hero proof line | `placeholders.hero.proof_line` = null | Line absent | Verified trust claim |
| Founder JSON-LD | `placeholders.founder.real` = false | No Person node | Real founder content (Q6) |
| Testimonial quotes | `placeholders.testimonials` = [] | Three generated lorem cards | Real quotes WITH permission (Q5) |

This model is the institutional memory of two incidents at once: PR #5 (fabricated metrics — prevented by kind C) and the V3 DMCA exposure (copied prose — prevented by kinds A and B, which leave no slot where copied text could live unnoticed).

---

## 4. Phases (mapped to the Redesign docs)

Each phase = one merge unit. Phases 2–4 can parallelize after Phase 1. Suggested branches: `feat/v4-r{n}` per doc.

| Phase | Docs | Scope | Exit criteria |
|---|---|---|---|
| **0. Ratify** | — | Founder + Tech Lead read §0–§3 of THIS doc; confirm the C-series keep-decisions, the D-series originality directives, and the 18-pattern target; close Open_Decision Q9 (resolved: keep + populate + relink) | Sign-off row below; PR #6 updated or closed in favor of this doc |
| **1. Data layer** | R2 | `App\Support\Lorem` (generator), `CaseStudyService` v2 (gates + 6 structured entries), `placeholders.php` v4 (seed + gates + chrome), TODO rows | R2 definition-of-done; determinism + rotation smoke tests pass; homepage visually unchanged |
| **2. Homepage A** | R3 | Hero, stats-bar, goal-picker Pricing block, audit-cta rename, working-together, 12-item checklist, webinar-optin (off), founder slots, testimonials+standards (off) | R3 verification block passes |
| **3. Signature systems** (parallel) | R4 ∥ R5 ∥ R6 | R4: System Blueprints + diagram upgrade. R5: result cards + /work + detail gating + sitemap + relink. R6: /services page | Each doc's verification block passes |
| **4. Demos + integrations** | R7 | demo-lab (6 demo tabs), martech grid + JS | R7 verification passes; `public/demos/` untouched |
| **5. Chrome + SEO** | R8 | Header/footer final, chat wiring, JSON-LD, meta | R8 verification passes |
| **6. Gate + launch** | R9 | All grep gates (1–12), functional matrix (F1–F13), Lighthouse (baseline + V4), originality review, NDPA review, deploy runbook, maintenance-lock release | R9 launch-gate checklist; human sign-off |

**Estimated effort (single dev, content-independent):** Phase 1: 0.5d · Phase 2: 1d · Phase 3: 1.5–2d · Phase 4: 1d · Phase 5: 0.5–1d · Phase 6: 0.5d → **5–6 dev-days to structure-complete.** Content-complete timing is David-bound, not dev-bound.

---

## 5. File change map (consolidated, all docs)

**CREATE (13):**
```
app/Support/Lorem.php                               (R2 — dynamic lorem generator)
resources/views/partials/stats-bar.blade.php        (R3)
resources/views/partials/audit-cta.blade.php        (R3 — via git mv from assessment-cta)
resources/views/partials/working-together.blade.php (R3)
resources/views/partials/webinar-optin.blade.php    (R3, renders nothing while disabled)
resources/views/partials/workflow-system.blade.php  (R4 — System Blueprints)
resources/views/partials/demo-lab.blade.php         (R7 — tabbed interactive demos)
resources/views/partials/martech.blade.php          (R7)
resources/views/components/result-card.blade.php    (R5)
resources/views/components/service-card.blade.php   (R6)
resources/views/components/stats-badge.blade.php    (R6)
resources/views/pages/services.blade.php            (R6)
app/Services/PricingService.php                     (R6)
```

**MODIFY (14):**
```
app/Services/CaseStudyService.php                   (R2 — full replacement, gates)
config/placeholders.php                             (R2 — full replacement: seed + gates + chrome)
resources/views/pages/home.blade.php                (R3/R4/R5/R7 — final 17-section order)
resources/views/partials/hero.blade.php             (R3 — dual CTA, gated proof line)
resources/views/partials/goal-picker.blade.php      (R3 — Pricing block)
resources/views/partials/services-checklist.blade.php (R3 — 12 items)
resources/views/partials/founder-bio.blade.php      (R3 — lorem slots + CTA)
resources/views/partials/testimonials.blade.php     (R3 — standards band)
resources/views/components/workflow-diagram.blade.php (R4 — label/compact props)
resources/views/pages/work.blade.php                (R5 — dynamic filters)
resources/views/pages/case-study.blade.php          (R5 — field gating)
resources/views/partials/header.blade.php           (R5/R8 — nav final)
resources/views/partials/footer.blade.php           (R5/R8 — multi-column)
resources/views/partials/chat-widget.blade.php      (R8 — gated WhatsApp)
resources/views/partials/structured-data.blade.php  (R8 — gated Person/WebPage)
resources/views/partials/meta.blade.php             (R8 — via controllers)
app/Http/Controllers/PageController.php             (R5/R6/R8 — services() + sitemap + meta)
routes/web.php                                      (R5/R6 — services route + Q9 comment)
resources/js/app.js                                 (R7 — demo tabs + martech filter)
TODO-Placeholders.md                                (R2/R6 — new gate rows)
```

**DELETE: nothing.** (The headline correction over v1 — no V2 skeleton file is deleted. `process`, `about`, `services`, `products` partials simply remain unrouted.)

**TOUCHED NEVER:** `public/demos/**`, `app/Http/Controllers/ContactController.php`, `resources/js/modules/contact-form.js`, `resources/js/modules/mobile-nav.js`, `resources/sass/_tokens.scss` (V5 token source — see `docs/Redesign(10).md` §2), `webpack.mix.js`, `composer.json`, `package.json`, migrations, the deploy workflow, `scripts/maintenance-lock.sh`. *(V4's `tailwind.config.js` was deleted in Phase 10 — see `docs/Redesign(10).md` §7.3.)*

---

## 6. Acceptance criteria (the build is complete when…)

**Structural (agent-verifiable):**
1. Homepage renders the 17-section order of §1 (gated sections may be absent, never present-but-empty)
2. Goal cards show the Pricing block (or "Contact for pricing")
3. `/services` renders: header → stats (gated) → free-review band → 4 advisory cards → 6 full-build cards → 5 ongoing-care cards → add-ons + CTAs
4. `/work` renders dynamic filter pills; filtering works with existing jQuery
5. `/case-study/{slug}` renders populated sections only; PENDING fields print nothing, ever
6. Demo Lab renders 6 tabs switching between real demo iframes; all `/preview/{slug}` targets 200
7. System Blueprints renders one pipeline per verified case study, with the Connected End-to-End badge; speed line only when configured
8. MarTech grid filters client-side; empty state works
9. Chat widget: no-op while number null; wa.me link when set
10. Header/footer/mobile nav link Work + Services; zero dead links
11. Sitemap: home, /work, /services, published case studies, 6 previews; `/showcase` 301s
12. All docs/Redesign(9).md §1 grep gates pass (1–12); Lighthouse ≥ 90 mobile (recorded with baseline)
13. `public/demos/` untouched; zero new dependencies; route names preserved; honeypot intact; all `php -l` clean

**Originality (the DMCA program — agent-verifiable gates + human review):**
14. Zero third-party strings in the rendered DOM (gate 2 blocklist) and zero third-party references in the repo outside the sanctioned blocklist/prohibition lines (gate 9)
15. Zero emoji in views; SVG iconography only (gate 10)
16. Zero hand-written marketing prose in the data layer (gate 12) — all placeholder prose is generated
17. The §4.2 side-by-side originality review (docs/Redesign(9).md) executed and documented — every section title, headline, and CTA differs from the reference; visual gestalt is Chada's own
18. The V3 doc series and any third-party-copy-bearing file never enter the repo

**Content (human-gated, tracked in TODO-Placeholders.md):**
19. Zero Lorem Ipsum in the rendered DOM **at content-complete** — every unchecked TODO row is either checked or consciously descoped in writing
20. Every published metric, price, testimonial, bio claim, and workflow step carries David's or the Tech Lead's verification
21. Open_Decision Q1–Q8 answered in the sign-off table below

---

## 7. Risk register (updated)

| Risk | L×I | Mitigation |
|---|---|---|
| **DMCA / copyright complaint (substantial similarity to the reference site)** | Med × Critical | **The entire V4 originality model**: D-series directives; generated lorem (no copied prose can exist); Chada style charter; renamed signature sections; gates 2/9/10; §4.2 side-by-side review; no reference-site fetching by agents. Structural patterns are functional and unprotectable; expression is provably ours |
| Agent invents content despite constraints | Med × Critical | The §3 gating model makes fabrication structurally impossible (null gates + PENDING-prefix guards in views + R9 gates 1–2; the Lorem bank cannot emit digits) |
| Agent fetches/copies from the reference site mid-build | Low × Critical | Constraint 11 + agent protocol rule 8 (docs are the only reference; uncertainty escalates to the Tech Lead); R9 gate 9 sweeps the repo |
| Unescaped apostrophe 500 (repeat of PR #5 hotfix) | Low × High | Constraint 12 + `php -l` sweep in R9 gate 8; generated lorem contains no apostrophes |
| Iframes hurt Lighthouse | Med × Med | `loading="lazy"`, only-first-panel-visible, budget ≤ 1.5 MB parent, measured in R9 §3 |
| David cannot supply enough case studies | High × Med | 6 structured entries now; grid renders whatever is published. No count pressure |
| Prices never arrive | Med × Med | "Contact for pricing" fallback is a permanent, shippable state |
| Direction reverses AGAIN (4th time) | Med × High | Zero deletions; every V2 file survives; rollback = git revert (R9 §6). Phase 0 ratification covers both the C-series and the D-series, so the originality model is co-signed |
| Maintenance lock mishandled at launch | Low × High | Lock is intentional and script-managed (`maintenance-lock.sh on|off`); release is the final human gate in R9 §6 |
| Placeholder lorem ships to production unnoticed | Med × Low | Lorem is instantly recognizable by design; gate 1 keeps PENDING/Placeholder markers out of the DOM; content-complete checklist requires every TODO row closed or descoped in writing |

---

## 8. Open decisions — final state

| # | Decision (Open_Decision.md V2) | V4 status |
|---|---|---|
| Q1 | Hero headline/value prop | **Open — content only.** Structure final (R3). Blocks: nothing |
| Q2 | Client logos | **Open — content only.** Trust bar already guarded |
| Q3 | Six tiered offers + prices | **Open — content only.** Card structure + Pricing block final (R3); `PricingService` tiers final (R6). Highest-value content to obtain first |
| Q4 | Quiz/assessment fidelity | **Resolved for v1:** static free-review CTA. Interactive quiz = future enhancement |
| Q5 | Testimonials exist? | **Open — content only.** Lorem cards ship; real quotes replace them with permission |
| Q6 | Founder bio + photo | **Open — content only.** Lorem slots + `real` flag + gated JSON-LD Person node ship |
| Q7 | Exclusivity tone | **Open — content only.** Structure ships |
| Q8 | Chat tool + persona + number | **Open — content only.** Widget code ships gated; setting the number activates it |
| Q9 | Case-study system fate | **RESOLVED: Keep + Populate + Relink** (C-series corrections; R5 executes) |

**Sign-off:**

| # | Decision | Answer | Decided by | Date |
|---|---|---|---|---|
| 0 | Ratify this v3 spec (replaces PR #6 v1 and the V3 doc series; C1–C5 keep-decisions + D1–D12 originality directives) | | Founder + Tech Lead | |
| 9 | Case-study fate: keep + populate + relink | ☐ resolved by this doc | Tech Lead | |
| D | Originality model (dynamic lorem + Chada chrome + gates + style charter) | ☐ resolved by this doc | Tech Lead | |
| 1–8 | Content decisions per TODO-Placeholders.md | | Founder | |

---

## 9. How to use this document with the docs/Redesign(1–9) series

- **Humans:** read this doc + `docs/Redesign(1).md`. You never need to open R2–R9 unless reviewing a specific PR.
- **Agent orientation:** every coding-agent session should start from `Implementation_redesign.md` (repo root) — the condensed orientation file that restates the constraints, content model, current repo state, and phase map, then points at the matching `docs/Redesign(n).md`. Keep it in sync with this spec whenever phases or gates change.
- **VSCode agents:** execute `docs/Redesign(n).md` one per session, in phase order (§4). Each doc restates the constraints, quotes current file state, contains complete code, and ends with verification commands and a definition of done. Agents should never need to read this orchestration doc mid-build — each build doc is self-contained.
- **PR hygiene:** one PR per doc (or per phase). PR body links the doc. Do not merge your own PRs. Do not mark a PR "ready to launch" while any TODO-Placeholders row it depends on is unchecked (this rule is inherited from the V2 process and kept verbatim).
- **Document hygiene (new in v4):** the V3 doc series is superseded — it must not be committed to the repo. These files (this doc + `Implementation_redesign.md` + `docs/Redesign(1)–(9)` + `TODO-Placeholders.md`, V4) are the complete, self-contained build reference. If any doc seems to require fetching an external site to execute, that is a defect in the doc — escalate instead.

*End of REDESIGN_IMPLEMENTATION.md (v3, Clarified). Prepared from a direct read of DGCodeIdeas/chada.digital @ 8ed949d (2026-08-27) and the prior spec history (V1 archived, V2 main, PR #6 v1, V3 doc series) — every file quoted in the series was read from the repository; every third-party quote that history contained has been purged and replaced by the originality model documented above.*
