# Redesign.md — Chada Digital Website Redesign (V2: WAB Digital Replicate)

> **Author:** DGCodeIdeas (Tech Lead)
> **Project:** chada.digital redesign
> **Reference:** https://wabdigital.com/ — direct structural replicate, per Founder direction (Aug 20, 2026)
> **Supersedes:** `Redesign_V1_LIGHT_THEME_ARCHIVED.md` (light theme + case-study system, team-approved Aug 15, partially built)
> **Stack:** Laravel 12 + Blade + Tailwind CSS v3 + Laravel Mix + jQuery/vanilla JS
> **Status:** Draft — grounded in a direct read of wabdigital.com and the current repo (Aug 20, 2026). Blocked on Open_Decision.md before build starts.

---

## 0. What changed, and why this version exists

The team previously agreed on a spec (V1, archived) that used wabdigital.com as a
*style* reference — minimalist, light theme, a case-study system loosely inspired
by WAB's polish. That spec was partially built: Phases 1-3 landed on `main`
(light color tokens, a `CaseStudyService`/`CaseStudyController`, `/work` and
`/case-study/{slug}` routes, four new Blade components, a data-driven services
section, a trust bar, a process section).

The Founder has now reviewed that prototype and asked for something different:
**a direct replicate of wabdigital.com's actual structure**, not a loosely-inspired
minimalist take. This is a materially different brief. Read §1 before assuming
anything from V1 carries over — most of the homepage structure doesn't.

---

## 1. What wabdigital.com actually is (read directly, Aug 20, 2026)

This is a lead-generation funnel for a marketing/growth agency, not a portfolio
site. In order, top to bottom:

1. **Hero** — a single bold value-proposition headline about systematically
   growing sales, short subtext, primary CTA.
2. **Trust bar** — "Trusted by fast-growing companies like:" + logo row.
3. **"Pick Your [X] Goal" — six tiered offer cards.** Each framed as
   "I want [Agency] to do X for me" (or "I want to do X myself, with training").
   These aren't generic service descriptions — they're framed as customer
   self-selection: the visitor picks the outcome they want, not a service
   category. On WAB this spans a self-serve training product through to
   full-service (funnel packs, website/funnel rebuild, paid ads management,
   SEO retainer).
4. **A lead-qualification quiz/assessment CTA** — "Is your business ready to
   scale?" framing, inviting the visitor into a short qualifying flow before
   they talk to sales.
5. **Testimonials** — "Check out what clients say," a dedicated social-proof
   section.
6. **A services/activities checklist** — a longer, more granular list of the
   actual deliverables/disciplines involved (strategy, CRM onboarding, copy,
   SEO, email sequencing, paid media, retargeting, automation, analytics,
   video), presented as a flat list rather than cards — this is the "what's
   actually included" detail beneath the six tiered offers above.
7. **Founder bio block** — first-person introduction, headshot, credibility
   bullets (experience, background, recognition).
8. **Exclusivity-framed closing CTA** — explicitly states not everyone who
   applies is accepted; positions the agency as selective, not desperate for
   volume.
9. **Persistent chat widget**, personalized as the founder by name.

**What it is not:** there is no visible portfolio/case-study grid with
metrics or workflow diagrams on the homepage itself. That was the core
assumption V1 was built around, and it doesn't hold up against the actual
site — flagging this explicitly since real engineering time was already spent
on that assumption.

---

## 2. Current repo state (as of Aug 20, 2026)

### 2.1 What's live on `main` right now (from V1's partial build)

| Piece | File(s) | WAB-replicate relevance |
|---|---|---|
| Light color tokens | `tailwind.config.js` | **Keep.** Token choice is independent of homepage structure. |
| Dark-text logo variant | `public/chada-logo-horizontal-dark.png` | **Keep.** Same reason. |
| Data-driven services loop | `partials/services.blade.php` | **Rework**, not discard — the *pattern* (array-driven, no copy-paste) is right; the *framing* needs to change from generic service cards to WAB's "I want you to X" tiered-goal framing (§3.3). |
| Trust bar (guarded, empty) | `partials/trust-bar.blade.php` | **Keep as-is.** Matches WAB's actual "Trusted by..." section directly — this one aged well. |
| `CaseStudyService` / `CaseStudyController` | `app/Services/`, `app/Http/Controllers/` | **Likely dead code under this direction** — see §7. Don't delete yet; flagged as an open decision, not a unilateral call. |
| `/work`, `/case-study/{slug}` routes + pages | `routes/web.php`, `pages/work.blade.php`, `pages/case-study.blade.php` | Same — likely dead code, not deleted yet. |
| 4 new Blade components (`case-study-card`, `metric-badge`, `workflow-diagram`, `tech-stack`) | `resources/views/components/` | Same. |
| Process section (Discover→Design→Build→Scale) | `partials/process.blade.php` | **Likely dead** — WAB's actual homepage has no 4-step process section. Could possibly be repurposed as visual filler elsewhere, but not part of the replicate structure. |
| Maintenance page + standalone CSS | `errors/503.blade.php`, `public/css/maintenance.css` | **Keep, unaffected.** This is infra-level, unrelated to homepage direction. |
| Contact form, honeypot, AJAX submit | `partials/contact.blade.php` + `contact-form.blade.php` | **Keep.** Every version of this redesign needs a contact/lead-capture path regardless of homepage structure. |

### 2.2 Current homepage composition (`pages/home.blade.php`)

```
hero → trust-bar → process → about → services → case-studies → products → contact
```

None of this order matches WAB's actual flow (§1). A literal replicate reorders
significantly — see §3.

---

## 3. Proposed section-by-section replicate

New homepage order, mapped directly to §1:

### 3.1 Hero
Single bold headline stating Chada's core value proposition in outcome terms
(WAB: "Your Online Business Should Be Systematically Making More Sales").
**Needs real copy from the Founder** — this is a positioning statement, not a
design decision; don't let an implementer invent it. See Open_Decision.md Q1.

### 3.2 Trust bar
Already built (`partials/trust-bar.blade.php`), already correctly guarded to
render nothing until real client logos exist. No engineering work needed here
— purely a content-availability question (Open_Decision.md Q2, carried over
from V1 where it was also unresolved).

### 3.3 "Pick Your [X] Goal" — six tiered offer cards
This replaces the current generic `services.blade.php` cards. Needs:
- Six real Chada offers, each framed as "I want [Chada] to do X for me" —
  this requires the Founder/team to actually define six tiers spanning
  self-serve through full-service, mirroring WAB's spread (training →
  strategy session → funnel/asset packs → full website/funnel build → paid
  ads management → SEO retainer). **Do not invent six offers and ship them**
  — this is a business/pricing decision, not a copywriting exercise an agent
  should make unsupervised. See Open_Decision.md Q3.
- Technically: keep the array-driven `@foreach` pattern already established
  in `services.blade.php` — just change the data shape (title framed as "I
  want...", description, and now importantly: what happens when the card is
  clicked — WAB's cards do not show visible prices, they lead to a CTA).

### 3.4 Lead-qualification quiz/assessment
Nothing like this exists in the repo today — this is genuinely new scope, not
a rework. Options range widely in build cost: a real branching questionnaire
with scoring, vs. a single content section with one CTA button linking to a
Typeform/external tool, vs. a simple static "signs you're ready" checklist
with no interactivity. **This decision changes the estimate significantly —
see Open_Decision.md Q4.** Recommend starting with the lowest-cost version
(static section + CTA) and treating a real interactive quiz as a v2 enhancement,
but that's a recommendation, not a decision made on the team's behalf.

### 3.5 Testimonials
Also genuinely new — nothing currently in the repo displays testimonials.
Blocked entirely on content: **real client testimonials don't appear to
exist yet in any form I have access to.** See Open_Decision.md Q5 — this
likely blocks this section regardless of how fast engineering moves.

### 3.6 Services/activities checklist
Lower-risk section — a flat, longer list of disciplines/deliverables. Can
likely reuse Chada's existing service copy (from the current `services`
section and `products.blade.php`) restructured as a checklist rather than
cards. Lowest-content-risk section in this whole spec.

### 3.7 Founder bio block
New section. Needs the Founder's real bio content (background, credentials,
a short first-person framing) and a headshot. **Do not use placeholder
biographical claims** — unlike a case-study metric, a fabricated credential
in a founder bio is a direct, personal factual claim about a named real
person. See Open_Decision.md Q6.

### 3.8 Exclusivity-framed closing CTA
Lower-risk, mostly copywriting — but the "we only accept applicants who
qualify" framing is a real positioning choice (does Chada actually want to
present itself as selective?), not just a stylistic flourish. Flagging so
it's a deliberate choice. See Open_Decision.md Q7.

### 3.9 Persistent chat widget
New scope. WAB's is personalized to their founder by name inside a chat
tool (looks like a live-chat/chatbot product, not a bare WhatsApp deep-link).
Needs a tool decision (WhatsApp Business API, a chat-widget SaaS product, or
a simpler WhatsApp click-to-chat button) before this is buildable. See
Open_Decision.md Q8.

---

## 4. Non-negotiable constraints (unchanged from V1)

- Never touch `public/demos/`
- `mix()` not `@vite()`, `bun` not `npm`
- Keep jQuery modules where they already exist; new interactivity may use
  Alpine.js or vanilla JS
- PHP 8.2 constructor promotion for new services/controllers
- Preserve route names, sitemap generation, and `meta.blade.php` /
  `structured-data.blade.php` SEO mechanics
- Keep the contact form's honeypot and validation intact

---

## 5. What this means for the existing case-study system

This is the single biggest open question in this whole document, not a
formality — see Open_Decision.md Q9. Three real options, not a recommendation
made here:

- **A. Remove it.** `/work`, `/case-study/{slug}`, `CaseStudyService`,
  `CaseStudyController`, and the four related Blade components come out
  entirely. Cleanest match to a literal WAB replicate, but throws away real
  Phase 3 engineering work.
- **B. Keep it as a secondary page**, not part of the homepage funnel. `/work`
  stays reachable (e.g. from the footer or services checklist) as a
  traditional portfolio, even though WAB's own site doesn't have one. Chada
  showing real client work may still be a legitimate asset even if it's not
  how WAB does it.
- **C. Freeze it, don't route to it.** Leave the code in the repo unused
  (routes commented out or removed, views left in place) in case the
  direction reverses again. Lowest engineering cost right now, but leaves
  dead code sitting in the codebase indefinitely.

---

## 6. File change map (delta from current `main`, pending Open_Decision.md)

```
resources/views/pages/home.blade.php          # reorder per §3
resources/views/partials/hero.blade.php       # new copy (Founder-provided)
resources/views/partials/trust-bar.blade.php  # unchanged
resources/views/partials/services.blade.php   # reframe to tiered "I want X" cards
resources/views/partials/process.blade.php    # likely removed from homepage — see §2.1
resources/views/partials/about.blade.php      # likely replaced/merged into founder bio (§3.7)
resources/views/partials/case-studies.blade.php  # fate tied to §5 decision
NEW: resources/views/partials/goal-picker.blade.php     (§3.3)
NEW: resources/views/partials/assessment-cta.blade.php  (§3.4)
NEW: resources/views/partials/testimonials.blade.php    (§3.5, blocked on content)
NEW: resources/views/partials/services-checklist.blade.php (§3.6)
NEW: resources/views/partials/founder-bio.blade.php      (§3.7, blocked on content)
NEW: resources/views/partials/exclusivity-cta.blade.php  (§3.8)
NEW: chat widget integration — scope depends on Open_Decision.md Q8
routes/web.php                                # /work, /case-study/{slug} — fate tied to §5
```

---

## 7. Note on process

This is the second direction reversal on this redesign since Aug 15 (meeting
consensus → team-approved V1 → Founder-requested V2), with real implementation
work landed against the version now being replaced. Not a criticism of either
decision — just flagging that a quick Founder sign-off on this V2 direction
before another implementation cycle starts would be worth the five minutes,
given the pattern so far.
