> **⚠️ ARCHITECTURE CHANGE (Aug 30, 2026):** The active build spec has moved to `MULTIPAGE_REBUILD.md`. The site is now being rebuilt as a **multi-page application** using **Bootstrap 5 + Material Design 3** (replacing the single-page anchor architecture and Tailwind CSS). This document remains valid as reference material but should not be used as the primary build guide.
>
> **Active spec:** `MULTIPAGE_REBUILD.md` · **Related:** `MIGRATION.md` (technical migration) · `Open_Decision.md` · `TODO-Placeholders.md`

# Open_Decision.md — Chada Digital Redesign (V2: WAB Digital Replicate)

> For the whole team — technical and non-technical. Supersedes
> `archive/Open_Decision_V1_LIGHT_THEME_ARCHIVED.md`. Read `REDESIGN_IMPLEMENTATION.md` first — this
> doc is the list of things that need real answers before that spec can be
> built.

## How to use this doc

Most of what's below isn't a design or engineering question — it's content
and business positioning that only the Founder/team can answer. Several
sections in `REDESIGN_IMPLEMENTATION.md` are fully blocked until their corresponding
question here is answered, not just "better with an answer." Those are
marked **BLOCKING**.

---

## Q0 — Ground rule: full structural replication, zero literal content, our own visual system (RESOLVED Aug 27, 2026)

**Decided by:** Tech Lead (not the Founder's call to make alone, but a standing
engineering/legal-risk constraint that applies regardless of who answers
Q1–Q8 below, and needs to bind every future agent session, not just one).

**The decision, plainly:** Chada replicates wabdigital.com's *structure* —
every section type, layout pattern, and feature (stats bar, tiered pricing
cards, workflow/pipeline diagrams, case-study grid, MarTech logo wall,
services/pricing page, revenue-systems demo tabs, everything in the V3 spec)
— completely. It does **not** replicate WAB's *specific expression* of any
of that: no real WAB client names, no real WAB numbers, no real WAB
testimonial text, no real WAB workflow narratives (even genericized/reworded
versions that clearly echo a specific real WAB case), and no WAB visual
branding (colors, exact card styling, logo, imagery). Chada's existing
design tokens (`tailwind.config.js` — `#f4f2ee` background, `#2563eb`
primary, Inter/Outfit fonts) are the visual system for the replica,
full stop — not WAB's.

**Why:** structural/functional patterns (the idea of a stats bar, a tiered
pricing layout, a workflow diagram) are standard, widely-used marketing-site
conventions and not something any one agency owns. Copying specific creative
expression — exact figures, exact client stories, exact visual design — is
where real copyright exposure lives. This split lets the redesign be a
genuine structural replicate without that risk.

**What this means for implementation, concretely:**
- `config/placeholders.php` remains the *only* home for placeholder content,
  and its scope now covers every new V3 section, not just the original V2
  six (hero, offers, testimonials, founder, exclusivity, chat) — stats-bar
  numbers, workflow/pipeline step labels, MarTech category names, manifesto
  copy, services/pricing tiers all go through it as genuine lorem ipsum too.
- The existing `docs/Redesign(9).md` §1 Gate 2 check (grep the shipped DOM for
  WAB's actual real numbers/phrases, expect zero hits) is correct and should
  stay in place — it's the automated enforcement of this decision.
- Beyond that gate: illustrative examples **inside the planning docs
  themselves** (e.g. the "Yam Pounder" / `Meta Video Ads → ManyChat API →
  HubSpot CRM Assignment → WhatsApp Alert` example in the docs/Redesign(1).md–
  docs/Redesign(9).md series) should be genericized before those docs are used to drive further
  agent sessions — not because they'd ship (the gate blocks that), but so
  nothing WAB-specific propagates as a template for an agent to imitate even
  in spec form.
- Visual/CSS: no new agent session should reference WAB's actual colors,
  gradients, or layout specifics as a target — only Chada's existing tokens
  and component patterns.

---

## Q1 — Hero headline and value proposition

**Plain language:** WAB's homepage opens with one confident sentence about
what they do for clients. Chada needs its own equivalent — this is a
positioning statement, not a design choice, so it shouldn't be written by
whoever's building the page.

**BLOCKING** for §3.1. Needs: one sentence, in the Founder's own words if
possible, about the core outcome Chada delivers.

---

## Q2 — Client logos for the trust bar

**Plain language:** Same open item carried over from V1 — do we have
permission to show real client logos, and which ones?

**Status:** Still unresolved (was also open in V1). Not blocking anything
else — the trust bar already renders nothing until this is answered.

---

## Q3 — The six tiered offers

**Plain language:** WAB's whole homepage is structured around six clickable
options, each answering "what do you want us to do for you?" — from
"teach me to do it myself" up to full-service. Chada needs its own six
(or however many makes sense), and they need to reflect real things Chada
actually sells, not invented-for-the-mockup copy.

**BLOCKING** for §3.3, and arguably the most structurally important
decision in this whole document, since it's the section WAB's entire funnel
is built around. Needs: a working session with the Founder to define the
tiers, likely 3-6 of them, each with a name, a one-line description, and a
CTA destination (does it link to a contact form, a specific package page,
a calendar booking link?).

---

## Q4 — Lead-qualification quiz: how real does it need to be?

**Plain language:** WAB has a short "are you ready to scale?" quiz-style
section before asking visitors to talk to sales. We can build this as a full
interactive quiz with scoring, or as a much simpler static section with one
button. The two options are very different amounts of engineering work.

**BLOCKING** for §3.4 scope/estimate, not for starting other work.

- **Option A — Full interactive quiz.** Multi-step, scored, probably routes
  to different outcomes/CTAs based on answers. Real build (custom
  component or a form tool integration).
- **Option B — Static section + external tool.** A short "signs you're
  ready" section linking out to a Typeform/Tally/similar embedded form.
  Much faster to ship.
- **Option C — Skip for v1.** Just the CTA, no quiz framing at all, revisit
  later.

`REDESIGN_IMPLEMENTATION.md` recommends starting with B and treating A as a later
enhancement, but that's a recommendation, not a decision made here.

---

## Q5 — Testimonials: do we have any?

**Plain language:** WAB has a dedicated "what clients say" section. Does
Chada have real client testimonials (written or video) we're allowed to
publish? If not, this section can't ship in this redesign pass, full stop —
there's no responsible placeholder version of a testimonial the way there
was for the old case-study system (a fake testimonial attributed to no one
is just as much a fabricated claim as a fake metric attributed to a real
client would have been).

**BLOCKING** for §3.5 — if the answer is "not yet," this section should be
cut from the v1 build rather than shipped empty or faked, and revisited once
testimonials exist.

---

## Q6 — Founder bio content

**Plain language:** WAB's homepage includes a personal, first-person bio
block for their founder — photo, background, credentials. If Chada is doing
the same, we need the real content: a headshot and a short bio in the
Founder's own words or approved by them directly.

**BLOCKING** for §3.7. Flagging explicitly: unlike a placeholder case-study
metric, a fabricated credential in a bio about a real, named person isn't a
content gap that can be papered over with a "placeholder" label — it
shouldn't be invented at any fidelity. Cut the section if the content isn't
ready.

---

## Q7 — Exclusivity framing: do we actually want this?

**Plain language:** WAB's closing CTA explicitly says they don't accept
every applicant — it's a deliberate scarcity/selectivity tone. Does Chada
want to position itself that way, or does that not fit how the team wants
to come across?

**Not blocking** — can default to a more standard CTA if this doesn't get
a clear yes.

---

## Q8 — Chat widget: what tool, and who's "on" it?

**Plain language:** WAB's chat widget is personalized with their founder's
name, like you're messaging them directly. We need to decide what tool
runs this (a WhatsApp Business click-to-chat link is simplest; a full
chat-widget product like Intercom/Crisp/Tawk is closer to what WAB actually
has but adds a new vendor/cost) and whose name/persona it should use.

**Not blocking** other sections, but needs an answer before §3.9 is built.

---

## Q9 — What happens to the existing case-study system?

**Plain language:** Real engineering work already went into a portfolio/case-study
system (`/work`, individual case study pages, several components) built for
the previous direction. WAB's actual site doesn't have anything like this on
its homepage. Three options, laid out in `REDESIGN_IMPLEMENTATION.md` §5:

- **A. Remove it entirely** — cleanest match to a literal replicate, discards
  the work.
- **B. Keep it as a secondary, non-homepage page** — Chada shows real
  portfolio work even though WAB doesn't; reachable from footer/nav, not
  part of the main funnel.
- **C. Freeze it, unrouted** — leave the code in place but disconnected, in
  case direction shifts again.

**BLOCKING** for §6 (the file change map) — engineering shouldn't start
touching `/work`/`CaseStudyService` until this is picked, in either
direction.

---

---

## Q10 — Visual system pivot: Tailwind → Bootstrap 5 + Material Web Components (RESOLVED Aug 30, 2026)

**Decided by:** Tech Lead (architectural/engineering call) + Founder (the underlying motivation: site must not look obviously AI-generated).

**The decision, plainly:** Tailwind CSS v3 is replaced entirely by a layered CSS stack — **Bootstrap 5.3 (foundation) → Material Web Components (component overrides) → custom SCSS utilities (Chada-specific)**. Loading order is binding. The Chada primary palette (`#f4f2ee` background, `#2563eb` primary) is preserved and mapped to M3 CSS custom properties; M3's surface/elevation/shape/motion tokens are adopted. Typography drops Outfit in favor of Inter (single-font, varied weights) + Material Symbols for icons. See `MULTIPAGE_REBUILD.md` and `_chada-custom.scss` for implementation.

**Why:** Tailwind's utility-class aesthetic reads as "generic SaaS template" and the Founder judged that as a strong "AI-generated" tell. Bootstrap+M3 layered carefully produces a more editorial, handcrafted feel while staying on a well-tested, accessible foundation.

**Status:** Resolved. Implemented in `feat/multipage-bootstrap-rebuild` (PR #16). See `_md3-tokens.scss`, `_md3-bootstrap-bridge.scss`, `_chada-custom.scss`.

---

## Q11 — Design Partner band replaces trust strip (RESOLVED Aug 30, 2026)

**Decided by:** Founder (framing + copy direction) + Tech Lead (wording).

**The decision, plainly:** The V2 "trust strip" — a client-logo row gated to render nothing while logos are empty — is replaced entirely. The new `design-partner-band` partial always renders, with copy:

> **No customer logos yet — we won't fake them.**
> Become a design partner.

This is Chada-original copy. The band is honest about the early-stage status, frames the absence as a confident offer rather than a missing feature, and reads as authored rather than template-default.

**Implementation:**
- **NEW file:** `resources/views/partials/design-partner-band.blade.php`
- **UPDATED:** `resources/views/pages/home.blade.php` — `@include('partials.design-partner-band')` after the Stats section; removed the hardcoded "Trusted by 50+ brands" line from the hero
- **DELETED:** `resources/views/partials/trust-bar.blade.php`

See `MULTIPAGE_REBUILD.md` §12 for full spec.

**Future state:** When real client logos exist (with explicit per-logo sign-off from the Founder, per the originality rules), the band can be repurposed into a logo row — but only by explicit decision, not silently.

**Status:** Resolved. Implemented in this PR.

---

## Q12 — Multi-page architecture replaces single-page-with-anchors (RESOLVED Aug 30, 2026)

**Decided by:** Founder (directive: "Instead of anchors, multi page.") + Tech Lead (route map + build execution).

**The decision, plainly:** The V4 single-homepage-with-section-anchors model is replaced by a multi-page architecture. Each major section becomes its own route. The homepage becomes a focused conversion hub that funnels to dedicated pages (`/case-studies`, `/services`, `/about`, `/contact`, `/demos`, `/preview/{slug}`), rather than a 16+ section scroll.

**Why:** A single long page with `#section-id` anchors is another "AI-template" tell. Real editorial and product sites use a proper route hierarchy. Multi-page also improves Lighthouse (smaller per-page payloads), SEO (each page has its own meta/title/schema), and analytics (per-page conversion tracking).

**Proposed route map** (see `MULTIPAGE_REBUILD.md` §2.1 for full table):

| Route | What lives here |
|---|---|
| `/` | Home: hero, stats, design-partner-band, process, featured case studies, services teaser, CTA |
| `/case-studies` | Filterable grid + detail pages with workflow diagrams |
| `/services` | Services & exact pricing (strategies, builds, retainers, add-ons) |
| `/about` | Testimonials, MarTech grid, founder bio, exclusivity CTA |
| `/contact` | Contact form + details |
| `/demos` | Tabbed iframe viewer for all 6 demos |
| `/preview/{slug}` | Individual demo chrome (preserved from V2) |
| `/sitemap.xml` | Dynamic XML sitemap |

**Status:** Resolved (Founder directive). Implemented in this PR.

---

## Q13 — Build restart: revert to pre-Redesign(2) execution state (RESOLVED Aug 30, 2026)

**Decided by:** Tech Lead ("I'm in fifth phase, So I'll revert back to just before the execution of the first phase").

**The decision, plainly:** The Tech Lead will revert `main` back to the state just before Phase 2 (R2 data layer) executed — discarding the R2/R3/R5 code but keeping the V4 doc series. This gives a clean slate to re-execute the build with:
1. The V5 visual system (Bootstrap + M3 + custom — per Q10)
2. The multi-page architecture (per Q12)
3. The no-borders fusion principle (per `MULTIPAGE_REBUILD.md` §11)
4. The Design Partner band (per Q11)

**Revert target:** commit `2f8669d` (PR #10 merge, Aug 29 07:24 UTC) — last commit before R2/R3 code landed.

**What's retained:**
- V4 doc series (`docs/Redesign(1-9).md`)
- Cross-reference pass (PR #10)
- All root docs (`Implementation_redesign.md`, `Open_Decision.md`, `REDESIGN_IMPLEMENTATION.md`, `TODO-Placeholders.md`, `README.md`)
- Archive docs (frozen historical record)

**What's discarded:**
- R2 data layer code (`App\Support\Lorem.php`, `CaseStudyService` v2, `config/placeholders.php` v4)
- R3 homepage partials (`stats-bar`, `audit-cta`, `working-together`, `webinar-optin`, modified `hero`, `goal-picker`, `founder-bio`, `testimonials`, `services-checklist`)
- R5 case study work (already reverted via PR #13)

**Note on `MULTIPAGE_REBUILD.md` §1 revert target:** The doc's §1 mentions an earlier revert target (`f4c3d2a`), but the actual execution path is to land PR #16 on top of current main (`6db7f42`) and let the rebuild naturally supersede the V2/R2/R3 code. The Tech Lead may or may not force-push main to `2f8669d` separately; either way, PR #16 represents the post-revert target state.

**Status:** Resolved. PR #16 is the implementation of this decision.

---

## Q14 — Cart system: what does it actually let someone buy?

**Plain language:** "Add a cart" means genuinely different things for a
services business like this, and they lead to different builds. Right now
every pricing tier's button says "Get Started" and just goes to the contact
form — there's no checkout anywhere. Four options, not yet decided:

- **(A) Fixed-price self-serve products only.** A new, separate catalog —
  think templates, funnel packs, a paid guide — sold at a real fixed price,
  completely separate from the custom-quote service tiers on `/services`.
  Cleanest e-commerce pattern, lowest business risk, but doesn't touch how
  the existing tiers are sold.
- **(B) Deposit checkout for the existing service tiers.** Someone picks a
  tier (e.g. "Business Website"), pays a percentage upfront online, the rest
  is invoiced after scoping. Not really a multi-item "cart" — more a
  single-tier "start and pay deposit" flow.
- **(C) Both A and B together.**
  A separate product catalog, plus deposit checkout on the service tiers.
- **(D) Full multi-item cart across everything**, including the range-priced
  tiers, charged at their listed starting price.

**Technical detail:** (A) needs a `Product` catalog model + `Cart`/`Order`
— a standard, well-understood pattern. (B) needs a deposit-percentage rule
per tier and an invoicing step for the remainder — a different, less
standard pattern, and doesn't cleanly apply to tiers priced as a *range*
rather than a fixed number (see the flag below). (C) is both, running in
parallel. (D) is the largest scope and carries a real pricing-integrity
risk explained next.

**Flagging one thing plainly, not just as a technical footnote:** most
tiers are priced as a *range* (e.g. "Business Website: ₦300,000 –
₦450,000") specifically because final price depends on a scoping call.
Option (D) — instant checkout at "the listed starting price" — means
someone could self-checkout a ₦300,000-tier project that, after a real
scoping conversation, should have been priced at ₦450,000. That's not a
bug to catch later; it's a pricing decision with real margin consequences,
worth the Founder's explicit sign-off before it's built, not just the
Tech Lead's.

**Status:** Open. `Cart_Implementation.md` builds the foundation that works
under any of the four answers, with each option as a separately gated
follow-on phase — so nothing built while this is undecided goes to waste
regardless of which way it resolves.

---

## Q15 — Payment gateway

**Plain language:** Which payment processor actually takes the money.

- **Paystack** — matches the site's Naira pricing, the standard default for
  Nigerian businesses, was already the assumed choice in earlier (fabricated,
  now-removed) case-study content.
- **Flutterwave** — comparable Nigerian gateway, broader multi-currency/
  cross-border support if that ever becomes relevant.
- **Not decided yet.**

**Technical detail:** `Cart_Implementation.md` builds a `PaymentGateway`
interface so this choice isn't load-bearing on the rest of the system —
Paystack is implemented first as the reference driver (matches Q14's
₦-pricing context and is the more commonly expected default), but nothing
elsewhere hard-depends on it. Adding Flutterwave later is a second driver
class, not a rearchitecture.

**Status:** Open. Building against Paystack as the reference implementation
in the meantime; swappable, not locked in.

---

## Sign-off

| # | Decision | Answer | Decided by | Date |
|---|---|---|---|---|
| 0 | Full structural replication, zero literal content, our own visual system | Resolved | Tech Lead | Aug 27, 2026 |
| 1 | Hero headline / value prop | | | |
| 2 | Client logos | Resolved via Q11 (Design Partner band) | Founder + Tech Lead | Aug 30, 2026 |
| 3 | Six tiered offers | | | |
| 4 | Quiz fidelity (A/B/C) | | | |
| 5 | Testimonials available? | | | |
| 6 | Founder bio content | | | |
| 7 | Exclusivity framing | | | |
| 8 | Chat widget tool + persona | | | |
| 9 | Case-study system fate (A/B/C) | | | |
| 10 | Visual system pivot: Tailwind → Bootstrap 5 + Material Web Components | Resolved | Tech Lead + Founder | Aug 30, 2026 |
| 11 | Design Partner band replaces trust strip | Resolved | Founder + Tech Lead | Aug 30, 2026 |
| 12 | Multi-page architecture replaces single-page-with-anchors | Resolved | Founder + Tech Lead | Aug 30, 2026 |
| 13 | Build restart — revert main to pre-Phase-2 state (`2f8669d`) | Resolved | Tech Lead | Aug 30, 2026 |
| 14 | Cart system scope (A/B/C/D) | | | |
| 15 | Payment gateway (Paystack/Flutterwave/other) | | | |
