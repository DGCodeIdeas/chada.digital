# Redesign(1).md — Master Directive: Pattern Replication, Original Expression (V4)

> **Series:** Redesign(1)–Redesign(9) — agent-ready build documents for the Chada Digital V4 redesign
> **Mandate (two layers, both binding):** The Founder directed that Chada's site adopt the **conversion architecture** of a leading competitor — every section type, every funnel mechanism, every interaction pattern. The Tech Lead's V4 directive governs **how**: replicate the patterns, never the expression. **All marketing content ships as dynamic Lorem Ipsum. All styling follows Chada's own established design language.** No third-party sentence, name, price, metric, image, or distinctive section title may appear anywhere — not in the DOM, not in the repo, not in these documents.
> **Stack:** Laravel 12 + Blade + Tailwind CSS v3 + Laravel Mix + jQuery/vanilla JS · Bun (never npm) · PHP 8.2+
> **Repo:** `DGCodeIdeas/chada.digital` · default branch `main` (HEAD audited: `8ed949d`, 2026-08-27)
> **This document:** The master brief. Read it first. It resolves the spec conflicts, fixes the target architecture, defines the content model and the style charter, and tells you which document to execute in which order. It contains no build tasks itself.

---

## 0. Why this series exists (read this before anything else)

Three prior specs currently disagree with each other, and an agent that follows any one of them blindly will build the wrong thing. A fourth revision layer (V4) now sits on top and changes the *content rules* for everything below it:

| Spec | Where | What it says | Status under V4 |
|---|---|---|---|
| `Redesign.md` (V2) | `archive/Redesign_ARCHIVED.md` | Goal-picker funnel site; no case studies/workflows on homepage | Superseded in part — its skeleton sections are kept and upgraded, but its section list was incomplete |
| `REDESIGN_IMPLEMENTATION.md` v1 (PR #6, closed; branch deleted) | PR #6 diff / git history | Workflow system + case studies; proposes **deleting** goal-picker, assessment-cta, services-checklist, founder-bio, exclusivity-cta | Superseded — the five deletions were wrong; both halves of the architecture belong on one page. The live v3 of this file sits at the repo root |
| `Redesign(1)–(9)` V3 doc series | produced 2026-08-27, **not committed** | Union of V2 + PR #6 + extra sections; quoted the reference site's copy verbatim inside the docs as build reference | **Superseded by this V4 series.** The V3 docs' *structure* survives; their *quoted third-party content* is purged. Never commit the V3 docs to the repo — they contain third-party copy |
| `Redesign_V1_LIGHT_THEME_ARCHIVED.md` | `archive/Redesign_V1_LIGHT_THEME_ARCHIVED.md` | Light theme + case-study system | Superseded |

**Resolution (authoritative):** the target architecture in §1 is the **union** of V2 and PR #6, plus one section neither prior spec captured (tabbed interactive system demos). Where any other document disagrees with this series, **this series wins**.

**The V4 originality directive (why V3 was revised):** V3 carried verbatim text scraped from the reference site — headlines, prices, client names, workflow pipelines, founder references — as its build reference. Committing or shipping any of that is copyright exposure (DMCA) the Tech Lead is not willing to carry. V4 keeps every structural decision from V3 and replaces every quoted string with either (a) generated Lorem Ipsum, (b) a null gate, or (c) Chada-original chrome labels. **Patterns are not copyrightable; expression is. V4 keeps the first and refuses the second.**

**Rule for agents:** Do not delete the V2 skeleton sections (goal-picker, assessment-cta, services-checklist, founder-bio, exclusivity-cta, testimonials). They map 1:1 onto reference-site sections. Upgrade them per Redesign(3) instead.

---

## 1. Pattern reference — the architecture being replicated (abstract, no third-party text)

What follows is the structural anatomy of the page we are building, described **functionally**. It is deliberately free of any third-party wording: an agent needs the pattern (what the section does, what elements it contains, what it gates on), never the reference site's exact strings. Every row is already reflected in the target architecture of §2 — nothing here needs to be fetched, checked, or "completed" from anywhere.

| # | Pattern (structural) | What it contains | Conversion purpose | Chada status today |
|---|---|---|---|---|
| 1 | **Hero** | Eyebrow tag + outcome-promise H1 + one supporting line + dual CTA (primary = start conversation, secondary = browse work) | Orient + first conversion | Partial — hero exists, centered, single CTA |
| 2 | **Stats band** | 4 large numbers with labels, full-width, directly under hero | Instant credibility | Missing (V1 had one; removed in V2) |
| 3 | **Trust strip** | Client logo row behind a data gate | Borrowed credibility | Exists, guarded (renders nothing while logos array empty) — correct behavior |
| 4 | **Tiered offer cards** | 6 cards: tier badge + outcome-framed title + short description + **price block** (label, amount, period) + CTA | Self-qualification + price anchoring | Exists as `goal-picker` but **without the price block** — the single biggest structural gap |
| 5 | **Free consult CTA** | Framed single-card offer of a free short review, one CTA | Catch visitors not ready to buy | Exists as `assessment-cta` (static) — needs reframe |
| 6 | **Transition band** | One-line bridge announcing the engagement models below | Pace change | Missing (small section) |
| 7 | **Capability checklist** | Intro paragraph + 12-item two-column checklist + dual CTA | Breadth proof | Exists as `services-checklist` but shows 4 service cards, not the flat checklist |
| 8 | **Gated-content opt-in** | Replay/masterclass form (name, email, phone, company, role) | List building | Missing — Chada has no asset yet, so it ships **disabled behind a flag** |
| 9 | **Founder block** | Photo + personal headline + credibility bullets + CTA | Human trust | Exists, placeholder photo |
| 10 | **Interactive demo lab** | Tab bar (one tab per demo) + embedded live demo in an iframe + an honest "this is live" chrome | Proof-by-demo — the differentiator | Missing — but Chada already owns 6 real interactive demos in `public/demos/` that fill it with genuine interactivity |
| 11 | **System blueprints** | Per-project horizontal pipelines (4–5 steps + tool labels, arrow-connected), a synchronization badge, optional closing speed line | Proof that the agency builds *systems*, not pages | Missing on homepage (`x-workflow-diagram` component exists, used only on case-study detail pages) |
| 12 | **Results grid** | Text-led cards — client, one big verified metric, one-line description, link to detail — **no thumbnails on the homepage** | Results proof | Partial — `partials/case-studies` exists but is not included on home; card variant differs |
| 13 | **Stats band (repeat)** | Same band pattern near page bottom | Re-anchor before closing CTAs | Missing |
| 14 | **Social proof** | Optional principles/standards band above quote cards | Accountability framing | Partial — testimonials exist (3 cards), no standards band |
| 15 | **Integrations grid** | Filter pills (category taxonomy) + tool cards with an **honest** readiness badge | "Works with my stack" reassurance | Missing (V1 had one; removed in V2) |
| 16 | **Selective-availability closing CTA** | A "we choose our clients" band + CTA | Scarcity + self-selection | Exists |
| 17 | **Footer** | 4-zone layout: about + contact / services links / explore links / social + legal bar | Navigation + trust | Exists but single-row nav; needs multi-column upgrade |
| 18 | **Persistent chat widget** | Floating click-to-chat button + persona popover, config-gated | Reduce friction to zero | Exists but is a deliberate **NO-OP** (Open_Decision Q8) |

**Secondary-page patterns:** a tiered pricing page (`/services`), a filterable results archive (`/work`), result detail pages (`/case-study/{slug}`), sitemap, plus reference-site pages Chada has no equivalent content for (`/calculator`, `/blog`, `/webinar`, `/training`, `/shop` — deferred, §2.2).

**⚠️ The one rule that summarizes this table:** if a pattern from the reference site seems to require a specific third-party string — a headline, a price, a client name, a badge label, a section title — it does not. The pattern works with generated placeholder content and Chada's own labels. If it feels like it doesn't, stop and ask the Tech Lead (constraint 11).

---

## 2. Target architecture (the committed decision)

### 2.1 Chada homepage section order

```
1.  partials.hero                  (UPGRADE — dual CTA; copy = generated lorem)
2.  partials.stats-bar             (NEW — 4 numbers, variant "home_top", gated)
3.  partials.trust-bar             (KEEP — guarded until logos arrive)
4.  partials.goal-picker           (UPGRADE — add Pricing block, gated amounts)
5.  partials.audit-cta             (RENAME from assessment-cta — free-review framing)
6.  partials.working-together      (NEW — transition band, generated copy)
7.  partials.services-checklist    (UPGRADE — 12-item two-column checklist)
8.  partials.webinar-optin         (NEW — disabled by default, generated copy)
9.  partials.founder-bio           (KEEP — generated copy until real bio lands)
10. partials.demo-lab              (NEW — tabs + existing demo iframes + honest live chrome)
11. partials.workflow-system       (NEW — "System Blueprints", gated pipelines)
12. partials.case-studies          (INCLUDE on home — text-led result cards)
13. partials.stats-bar             (REPEAT — variant "home_bottom", gated)
14. partials.testimonials          (UPGRADE — standards band above quotes, gated)
15. partials.martech               (NEW — filterable tool grid, honest badges)
16. partials.exclusivity-cta       (KEEP — generated copy)
17. partials.contact               (KEEP — untouched, honeypot intact)
```

Note the two renames versus any earlier material you may have seen: the tabbed demos section is **`demo-lab`** (not "revenue-systems"), and the pipeline section's display title is **"System Blueprints"** (not any third party's section title). Section ids stay lowercase-hyphenated and stable — they are anchor targets.

### 2.2 Secondary pages

| Route | Status | Spec |
|---|---|---|
| `/services` | NEW | Redesign(6) — tiered pricing page with `PricingService` |
| `/work` | UPGRADE | Redesign(5) — filterable grid, categories aligned to Chada's real work |
| `/case-study/{slug}` | UPGRADE | Redesign(5) — populate with real case studies + workflows |
| `/showcase` → 301 → `/work` | KEEP | Already in `routes/web.php` |
| `/preview/{slug}` (+subpages) | KEEP | Demo viewer, untouched |
| `/sitemap.xml` | UPGRADE | Redesign(5) — add `/services`, `/work`, all case-study slugs |
| `/calculator`, `/blog`, `/webinar`, `/training`, `/shop` | DEFER | No Chada-equivalent content exists. Do not build. |

### 2.3 What happens to the V2 skeleton (final answer to Open_Decision Q9 and the PR #6 deletions)

| V2 file | Verdict | Why |
|---|---|---|
| `partials/goal-picker.blade.php` | **KEEP + UPGRADE** | Pattern #4 — the core of the funnel. Add the Pricing block |
| `partials/assessment-cta.blade.php` | **KEEP + RENAME + UPGRADE** | Pattern #5 (free consult CTA). Rename file to `audit-cta.blade.php` |
| `partials/services-checklist.blade.php` | **KEEP + UPGRADE** | Pattern #7 (12-item capability checklist) |
| `partials/founder-bio.blade.php` | **KEEP** | Pattern #9 |
| `partials/exclusivity-cta.blade.php` | **KEEP** | Pattern #16 |
| `partials/testimonials.blade.php` | **KEEP + UPGRADE** | Pattern #14 (add standards band) |
| `partials/process`, `partials/about`, `partials/services`, `partials/products` | **STAY UNROUTED** | Not part of the target homepage. Keep files on disk (reversible), do not include on home. `services.blade.php`'s real service array is reused by the checklist upgrade and the `/services` page |
| `CaseStudyService` + `CaseStudyController` + `/work` + `/case-study/{slug}` + 4 components | **KEEP + POPULATE + RELINK** | Patterns #10–#12 run on this infrastructure. Reverse the Q9 "freeze": re-add Work link to nav, re-add routes to sitemap |

---

## 3. Non-negotiable constraints (repeat verbatim in every agent session)

```
CONSTRAINTS (Chada Digital V4 — pattern build):
1.  NEVER modify, delete, or add anything inside public/demos/ — read-only.
2.  Asset pipeline is Laravel Mix: use mix('...') in Blade, NEVER @vite().
3.  Package manager is Bun: bun run dev / bun run prod. NEVER npm or yarn.
4.  ZERO new Composer or npm dependencies. Blade + Tailwind + jQuery/vanilla
    JS only. (App\Support\Lorem is pure PHP with no dependencies — allowed.)
5.  Preserve every existing route name: home, work, case-study.show,
    preview.show, preview.subpage, contact.submit, sitemap.
6.  Keep the contact form's honeypot field and AJAX validation exactly as-is.
7.  New services/controllers use PHP 8.2 constructor property promotion.
8.  New reusable markup uses Blade components (<x-component-name>).
9.  Follow the Chada style charter (§5): rounded-2xl border border-border
    bg-card cards; text-xs uppercase tracking-[0.3em] text-primary eyebrow
    labels; font-display (Outfit) headings with one text-primary highlighted
    word; Inter body text; SVG line icons only — no emoji in views.
10. Placeholder prose is GENERATED, never hand-written: every prose slot
    renders $real ?? \App\Support\Lorem::…(key). config/placeholders.php
    holds only seeds, gates, and short Chada chrome labels. Real, stable
    content lives in service classes (PreviewService / CaseStudyService
    pattern). Never hardcode placeholder text in a Blade file.
11. ORIGINALITY (DMCA rule): never copy a third-party site's text, client
    names, prices, metrics, imagery, or distinctive section titles. Never
    fetch, scrape, or quote wabdigital.com or any competitor site — these
    documents are the only build reference. If a pattern seems to require
    a specific third-party string, it does not — stop and ask the Tech
    Lead. The repo (docs included) must stay free of third-party copy.
12. PHP string safety: escape apostrophes inside single-quoted strings
    (couldn\'t). An unescaped apostrophe took production down with a 500
    on Aug 20 (PR #5 incident, commit 0a9f6a4 hotfix). Run php -l on every
    touched PHP file before committing.
13. bun run dev must compile clean after every file change; bun run prod
    before a phase is called done.
14. Do not invent real-sounding content: no fake client names, no fake
    metrics, no fake testimonials, no fake prices. The Lorem word bank
    contains no digits by design, so generated text can never produce a
    number. Factual claims wait for David (see TODO-Placeholders.md).
```

---

## 4. The content model (three kinds of strings — memorize this)

Every string in the build is exactly one of three kinds. If you are about to write a string and cannot say which kind it is, stop and re-read this section.

| Kind | Where it lives | Examples | Rule |
|---|---|---|---|
| **A. Chada chrome** | `config/placeholders.php` or inline in views | Button labels ("Start a Project", "Get Started"), nav items, eyebrows ("Services", "Under the Hood"), form field placeholders, badge texts ("READY"), tier names | Must be short, functional, and Chada-original. Never borrowed from a third-party site's wording. Apostrophe-free where possible (constraint 12) |
| **B. Generated lorem** | `\App\Support\Lorem::…()` calls in views, keyed by slot | Headlines, subheads, body paragraphs, offer titles/descriptions, testimonial quotes, founder bio, exclusivity copy | Always `{{ $real ?? Lorem::…('slot.key') }}` so real content replaces lorem **in place** when it lands. Rotating `placeholders.lorem_seed` regenerates all of it site-wide |
| **C. Gated facts** | `null` / `false` values in config or services | Prices, stats, metrics, client logos, WhatsApp number, speed claim, webinar asset, founder real-name flag | Render nothing (or a labeled fallback like "Contact for pricing") while null. Only David (or the Tech Lead for workflows) can flip a gate |

**Why this model exists:** it is the structural answer to two different incidents. The PR #5 incident (fabricated metrics shipped and reverted) is prevented by kind C — facts are gates, not strings. The DMCA risk the Tech Lead flagged in V4 is prevented by kinds A and B — there is simply no slot in the system where copied third-party prose could live without standing out immediately.

**The slot fallback rule (applies everywhere in docs 3–8):** a prose slot that is empty today renders generated lorem; the same slot with a real value renders the real value. Concretely:

```blade
{{ $offer['title'] ?? \App\Support\Lorem::title('offers.1.title') }}
```

David sets `title` in config (or a service) later — the view never changes. The TODO-Placeholders row for that slot gets checked, and the lorem call remains as a dead fallback until the row is closed.

---

## 5. The Chada style charter ("our own unique style")

The visual identity below is already established on `main` and is Chada's own. V4 mandates: **keep it, extend it, and never drift toward any other site's look.** Structural patterns are replicated; the visual gestalt is not.

### 5.1 Design tokens (already correct — do not touch)

| Token | Value | Usage |
|---|---|---|
| `background` | `#f4f2ee` | Page background |
| `foreground` | `#171717` | Primary text |
| `card` | `#fbfaf8` | Card surfaces |
| `primary` | `#2563eb` | CTAs, links, badges, accents |
| `muted` | `#f5f5f5` / `#525252` | Secondary bg / secondary text |
| `border` | `#e5e5e5` | Card borders, dividers |
| Fonts | Outfit (display) · Inter (body) · Playfair Display (accent) | Weights loaded: 400–800 / 400–600 / 500–800 |

### 5.2 Composition rules (the Chada signature)

1. **Cards:** `rounded-2xl border border-border bg-card` — soft corners, hairline borders, warm off-white surfaces. Hover lifts (`hover:-translate-y-1 hover:border-primary/40`), never color inversions.
2. **Eyebrow labels:** `text-xs font-semibold uppercase tracking-[0.3em] text-primary` above every section heading.
3. **Headings:** `font-display` (Outfit), tracking-tight, with **exactly one** `text-primary` highlighted word or phrase. Sentence case (not all-caps) except the System Blueprints display title, which is uppercase by design.
4. **Body:** Inter, `text-muted-foreground`, generous leading (`leading-relaxed`).
5. **Iconography:** inline SVG line icons (stroke 1.75–2.5) only. **Emoji are forbidden in views** — they are someone else's visual fingerprint and they read as copied pattern-matching. This is enforced by QA gate 10 in Redesign(9).
6. **Bands:** alternating rhythm — card-colored sections separated by `bg-muted/30` + `border-y border-border/60` bands (used by demo-lab and System Blueprints).
7. **Pills/badges:** `rounded-full` with tint fills (`bg-primary/10`, `bg-emerald-500/10`), never solid blocks.
8. **Motion:** subtle only — `transition-all duration-300`, small translates. No attention-grabbing animation.

### 5.3 Voice rules for chrome labels (kind A)

- CTAs are verb-first and concrete: "Start a Project", "Get Started", "Explore Our Work", "Read the case study", "Request a Free Review", "Open full screen".
- Section titles are plain-English and Chada-branded: "System Blueprints", "Try the systems we build.", "Ways to work with us.", "Built, shipped, measured."
- **Never** reuse a distinctive section title, badge text, or CTA phrase seen on another agency site. When in doubt, write it plainer.

### 5.4 What "unique style while replicated" means in practice

| Replicated (structure — allowed) | Not replicated (expression — forbidden) |
|---|---|
| Section sequence and count | Section titles / headlines of the reference site |
| Card anatomy (badge → title → description → price → CTA) | Card copy, price figures, badge vocabulary of the reference site |
| Tabbed iframe demo pattern | Tab labels, chrome microcopy, emoji tab icons |
| Horizontal pipeline diagrams with arrows | Specific pipeline contents, step wording, badge text, speed figures |
| Filterable integrations grid | Tool claims Chada cannot honestly make ("Verified Integration" unless true) |
| 4-number stats band | Any specific number Chada has not verified |
| Text-led result cards | Reference-site client names, metrics, CTA link phrasing |

---

## 6. Document map & execution order

Each document is a self-contained work order sized for one agent session. Execute in order; later docs depend on earlier ones.

| Doc | Title | Builds | Depends on |
|---|---|---|---|
| **Redesign(1).md** | Master directive (this file) | Nothing — context only | — |
| **Redesign(2).md** | Data layer | `app/Support/Lorem.php` (NEW generator), `CaseStudyService` (6 gated entries + workflow drafts + verifiedWorkflows()), `config/placeholders.php` v4 (gates + chrome + seeds), TODO rows | (1) |
| **Redesign(3).md** | Homepage sections A (1–9) | `home.blade.php`, `hero`, `stats-bar`, `goal-picker` upgrade, `audit-cta`, `working-together`, `services-checklist` upgrade, `webinar-optin`, `founder-bio`, `testimonials` + standards band | (2) |
| **Redesign(4).md** | System Blueprints (section 11) | `partials/workflow-system.blade.php`, `x-workflow-diagram` upgrade | (2) |
| **Redesign(5).md** | Case studies (sections 12–13) + routes | `x-result-card`, `case-studies` on home, `/work` filters, case-study detail pages, sitemap, nav relink | (2) |
| **Redesign(6).md** | Services page | `PricingService`, `/services` route + page, `x-service-card`, `x-stats-badge` | (2) |
| **Redesign(7).md** | Demo Lab + MarTech (sections 10, 15) | `partials/demo-lab.blade.php` (iframe tabs), `partials/martech.blade.php` (filter grid), JS filter module | (2), (5) |
| **Redesign(8).md** | Global chrome | `header`, `footer`, `chat-widget` wiring, `meta`/OG, JSON-LD extensions | (5), (6) |
| **Redesign(9).md** | QA, compliance, deploy | Nothing — verification & launch gates (incl. originality gates) | all |

**Parallel tracks possible:** (4) ∥ (5) ∥ (6) after (2); (7) after (5); (8) after (5)+(6); (9) last.

**The clarified master spec** lives in `REDESIGN_IMPLEMENTATION.md` (v3, Clarified, repo root) — it records every ambiguity and its resolution, the V3→V4 originality changelog, and orchestrates these nine docs into phases with acceptance criteria. Its condensed per-session companion — `Implementation_redesign.md` (repo root) — is the orientation file an agent reads at the start of every session before opening the phase doc.

**Where everything lives:** the nine series docs sit in `docs/`. At the repo root sit `REDESIGN_IMPLEMENTATION.md` (spec of record), `Implementation_redesign.md` (agent orientation), `TODO-Placeholders.md` (content-gate tracker), `Open_Decision.md` (open decisions Q0–Q9), and `README.md`. Superseded specs live in `archive/`. All code paths quoted in this series are repo-root-relative (e.g. `config/placeholders.php`, `resources/views/partials/hero.blade.php`).

---

## 7. Current repo state (audit @ `8ed949d`, 2026-08-27)

### 7.1 What is on `main` right now

- **Homepage** (`pages/home.blade.php`): hero → trust-bar → goal-picker → assessment-cta → testimonials → services-checklist → founder-bio → exclusivity-cta → contact. All Lorem Ipsum via `config/placeholders.php`. No stats bar, no workflow system, no case studies, no martech, no demo lab.
- **Case-study system:** frozen per Open_Decision Q9 default — routes still registered (`/work`, `/case-study/{slug}`), files intact, but **no nav links** and **no sitemap entries**. `CaseStudyService` holds 3 placeholder entries (`case-study-a/b/c`) with every field "Placeholder". Comment in `routes/web.php` guards against deletion.
- **Components on disk:** `x-case-study-card` (thumbnail cards), `x-workflow-diagram` (arrow pipelines — the gem we reuse), `x-metric-badge`, `x-section-header`, `x-section-badge`, `x-section-heading`, `x-tech-stack`, `x-button-primary`, `x-button-outline`, `x-splash-logo`.
- **Chat widget:** deliberate NO-OP placeholder (Open_Decision Q8 unresolved — tool + persona + number not chosen).
- **Unrouted but present:** `partials/process`, `partials/about`, `partials/services` (real 4-service array with tool stacks — reuse this data), `partials/products` (4 fictional products — keep unrouted, do not delete).
- **Infra:** GitHub Actions deploys `main` → EC2 (`/opt/dstack-panel/projects/chada.digital`) — assets built on CI with Bun, rsync with `--delete`, then `post-deploy-dstack.sh`. `scripts/maintenance-lock.sh on|off` holds/releases a deliberate maintenance lock (site is currently locked, showing the branded 503). PR #6 closed (its five deletions reversed by this series; its branch deleted). Branch `feat/redesign-frontend` exists (stale, no docs).
- **PreviewService:** 6 demos — `apexflow` (SaaS/AI), `elysian` (Hotel & Spa booking), `hirebase` (recruitment/job board), `noir` (e-commerce fashion), `sterling-vale` (construction corporate), `timber-mill` (artisan furniture). All interactive, all in `public/demos/`.

### 7.2 Key files an agent must read before editing (all quoted in the series)

```
routes/web.php                                  # 23 lines — route map
app/Http/Controllers/PageController.php         # home() + sitemap()
app/Http/Controllers/CaseStudyController.php    # index() + show()
app/Services/CaseStudyService.php               # 3 placeholder entries
app/Services/PreviewService.php                 # 6 demo entries
config/placeholders.php                         # all placeholder content
resources/views/pages/home.blade.php            # 13 lines of includes
resources/views/layouts/app.blade.php           # layout shell
resources/views/partials/*                      # 22 partials
resources/views/components/*                    # 11 components
resources/js/app.js                             # jQuery init + showcase filters
tailwind.config.js                              # light theme tokens
```

---

## 8. Agent protocol (how to execute this series)

1. **One doc per session.** Open the doc, restate the constraints block (§3) to yourself, execute top to bottom.
2. **Branch per doc.** `git checkout main && git pull && git checkout -b feat/v4-r{n}` where `{n}` is the doc number. Never work directly on `main`.
3. **Read before write.** Every task quotes the current file state where it matters. If the file on disk differs from what the doc quotes, STOP and reconcile — the repo may have moved.
4. **Verify after every task.** Each doc ends with verification commands. Run them. `php -l` on touched PHP files, `bun run dev` on touched assets, and the page-specific checks.
5. **Never fake content, never copy content.** Where a doc says a slot is lorem or gated, ship exactly that. Never invent a realistic-sounding metric, name, price, or testimonial (constraint 14) and never paste text from any external site (constraint 11). Both mistakes have precedent: PR #5 shipped fabricated metrics and had to be reverted; V3 quoted third-party copy and had to be purged.
6. **Commit per task** with conventional messages: `feat(v4-r4): build system blueprints partial`, `fix(v4-r3): add pricing block to goal cards`.
7. **Open a PR per doc** (or one PR per phase if the team prefers — see REDESIGN_IMPLEMENTATION.md §Phases). Do not merge your own PRs.
8. **These documents are the only reference. Never fetch the reference site.** Do not open, scrape, screenshot, or quote wabdigital.com or any competitor site during the build — not to "check" a pattern, not to "verify" copy. If these docs leave you uncertain, that uncertainty is a bug in the docs: raise it to the Tech Lead instead of resolving it against an external site. If you find the V3 doc series or any file in the repo containing third-party site copy, do not follow it — flag it for removal.
9. **Sanity-check every string you write** against §4 (content model): is it chrome (short + Chada-original), generated lorem, or a gated fact? If it is none of these — or if it reads like marketing prose you just made up that *sounds real* — delete it and use a lorem slot.

---

## 9. Glossary (for humans reading along)

| Term | Meaning |
|---|---|
| V1 | First redesign spec (archived): light theme + case-study system |
| V2 | Second spec + current skeleton on `main`: goal-picker funnel, Lorem Ipsum |
| V3 | Third spec: complete pattern replication — sound structure, but carried third-party verbatim quotes; **superseded, never commit** |
| V4 | This series: V3's structure with the originality model — dynamic Lorem Ipsum, Chada style charter, DMCA gates |
| Q1–Q9 | Open decisions in `Open_Decision.md` (V2). Statuses: Q9 is resolved by this series (relink + populate); Q1–Q8 remain content/persona decisions for David |
| Freeze (Q9 default) | The interim state where case-study routes existed but were unlinked. V4 reverses this |
| Lorem | `App\Support\Lorem` — the seeded placeholder-text generator (Redesign(2)) |
| Slot fallback rule | `{{ $real ?? Lorem::…(key) }}` — real content replaces lorem in place |
| Chrome | Short functional UI strings (buttons, eyebrows, badges) — the only hand-written strings allowed |
| Gated fact | A null/false-guarded value (price, stat, metric) that renders nothing until a human sets it |
| Demo Lab | The tabbed interactive-demo homepage section (`partials/demo-lab`) |
| System Blueprints | The pipeline-diagram homepage section (`partials/workflow-system`) — Chada's own name for the pattern |
| Result card | Text-led case study card (`x-result-card`): client + metric + excerpt + link |
| Pricing block | The price display on offer cards: label "Pricing" + ₦ amount + $ equivalent + period, with "Contact for pricing" fallback |
| Maintenance lock | `scripts/maintenance-lock.sh on` — holds the branded 503 across deploys until released |
| Demo | Self-contained interactive site in `public/demos/{slug}/`, served via `/preview/{slug}` |

---

## 10. Definition of done for the whole series

The build is complete when every item in `REDESIGN_IMPLEMENTATION.md` §Acceptance Criteria passes — summarized: homepage renders sections 1–17 of §2.1 in order; `/services` renders the tiered pricing page; `/work` and `/case-study/{slug}` are populated, linked, and sitemapped; System Blueprints renders one pipeline per verified case study with the Connected End-to-End badge; the Demo Lab renders 6 tabs switching between real demo iframes; the chat widget either opens a real WhatsApp thread or remains a documented no-op pending Q8; zero hand-written placeholder prose (everything is chrome, generated lorem, or gated); **zero third-party strings in the rendered DOM or the repo (Redesign(9) gates 2, 9, 10)**; Lighthouse ≥ 90 mobile; `public/demos/` untouched; zero new dependencies.

*End of Redesign(1).md — proceed to Redesign(2).md.*
