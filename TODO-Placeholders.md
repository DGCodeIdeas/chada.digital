> **⚠️ STACK CHANGE (Aug 30, 2026):** This content checklist remains the source of truth for what real content David must supply before launch. The technical implementation has moved to `MIGRATION.md` (Bootstrap 5 + Material Design 3). All Tailwind class references below are historical — the content requirements (names, metrics, pricing, workflows) are unchanged.
>
> **Related docs:** `MIGRATION.md` (active build spec) · `Open_Decision.md` (decision log) · `Implementation_redesign.md` (deprecated) · `REDESIGN_IMPLEMENTATION.md` (deprecated)

# TODO-Placeholders.md — Content Needed Before Launch (V4)

> **Supersedes** the V2-scope version of this file (offers/hero/testimonials/
> founder/exclusivity/chat only — 6 rows). The V4 architecture
> (`Implementation_redesign.md`) roughly triples what's actually needed:
> stats bars, 6 case studies with verified workflows, a services/pricing
> page, and a webinar opt-in are all new. Old rows are preserved below,
> not lost — this is a fuller list, not a different one.
>
> Every row corresponds to a named gate in `MIGRATION.md` §5 (content requirements) — formerly `Implementation_redesign.md` §2.
> Nothing here is filled by inventing a plausible-sounding answer — every
> gate stays closed (rendering nothing, or a fallback like "Contact for
> pricing") until the actual answer lands. **This file's job is to get
> checked off, not filed.**
>
> **Related docs:** the config gates themselves are built in
> `MIGRATION.md` §5 (data layer) — formerly `docs/Redesign(2).md` and enforced at launch by
> `MIGRATION.md` §8 (launch checklist) — formerly `docs/Redesign(9).md`; the decisions
> behind each row live in `Open_Decision.md`; the agent-session orientation
> is `Implementation_redesign.md`, and the full spec of record is
> `REDESIGN_IMPLEMENTATION.md` (both at the repo root).
>
> Two different owners sign off on different rows: most are **Founder**
> content calls; a few workflow-specific ones are **Tech Lead** verification
> calls (marked below) — don't wait on the Founder for those.

---

## How to fill this in

Reply with the content (or point at a doc/photo/number) for any row and it
gets dropped into the matching config gate directly — you don't need to
touch code. Rows are grouped by what they block, roughly in priority order.

---

## 1. Highest priority — the offers (blocks the whole homepage funnel)

| ✅ | Gate | What's needed | Owner | Related |
|---|---|---|---|---|
| ☐ | `offers` (×6) — titles/descriptions | The six real tiered offers, each framed as "I want Chada Digital to ___" | Founder | Open_Decision.md Q3 |
| ☐ | `offers.*.price_ngn` (×6) | A real ₦ price (or "Contact for pricing" is fine as the permanent answer for any tier — that's a legitimate final state, not just a placeholder) | Founder | Open_Decision.md Q3 |

## 2. Hero

| ✅ | Gate | What's needed | Owner | Related |
|---|---|---|---|---|
| ☐ | `hero.headline` / `hero.subhead` | One sentence value prop + 1-2 supporting sentences, in outcome terms | Founder | Open_Decision.md Q1 |
| ☐ | `hero.proof_line` | A verified trust claim ("Trusted by X+ brands") — only if it's actually true and verifiable; leave gated (absent) otherwise | Founder | New in V4 |

## 3. Case studies — 6 entries (Q9 is resolved: this section ships once content exists)

Each of the 6 real demos (`apexflow`, `elysian`, `hirebase`, `noir`,
`sterling-vale`, `timber-mill`) needs its own row filled before it appears
anywhere on the site — cards, `/work`, `/case-study/{slug}`, and System
Blueprints are all driven by the same 6 entries.

| ✅ | Gate | What's needed | Owner | Related |
|---|---|---|---|---|
| ☐ | `case_studies.*.published` (×6) | Client name, real metric, narrative (challenge/solution/results) — a case study only appears once this whole set is filled AND flipped to published | Founder | Was frozen (Q9); now active |
| ☐ | `case_studies.*.workflow.verified` (×6) | The actual automation/delivery steps for that project, verified as accurate | **Tech Lead** (not Founder — this is a technical accuracy check, not a content call) | New in V4 |
| ☐ | `workflow_speed_claim` | A real, measured claim about delivery/turnaround speed, if you want one shown at all | Founder | New in V4 |

## 4. Stats bars — 3 instances (2 on home, 1 on /services)

| ✅ | Gate | What's needed | Owner | Related |
|---|---|---|---|---|
| ☐ | `stats.home_top` (4 numbers) | 4 verified numbers for the band under the hero | Founder | New in V4 |
| ☐ | `stats.home_bottom` (4 numbers) | 4 verified numbers for the band near the case studies | Founder | New in V4 |
| ☐ | `stats.services` (5 numbers) | 5 verified numbers for the `/services` page band | Founder | New in V4 |

Numbers don't have to match across the three — but every number shown must
be one Chada can stand behind if asked. Leave a bar entirely absent (all
values null) rather than fill it with a rough estimate.

## 5. Testimonials

| ✅ | Gate | What's needed | Owner | Related |
|---|---|---|---|---|
| ☐ | `testimonials` (×3-4) | Real client quotes + name + company — **only with permission to publish.** If that doesn't exist yet, this section stays as generated lorem, not fake quotes | Founder / whoever holds the client relationship | Open_Decision.md Q5 |
| ☐ | `manifesto.enabled` | Whether Chada wants a public "standards/principles" band at all, and if so, the actual text | Founder | New in V4 — this is a tone decision, not just content |

## 6. Founder bio

| ✅ | Gate | What's needed | Owner | Related |
|---|---|---|---|---|
| ☐ | `founder.real` (+ name/title/bio_points) | Real name, title, 3-4 bio bullets in the Founder's own words or approved by them | Founder | Open_Decision.md Q6 |
| ☐ | `founder.photo` | A real headshot, replacing the silhouette placeholder | Founder | Open_Decision.md Q6 — also closes known bug (`Implementation_redesign.md` §4.1) |

## 7. Webinar / gated-content opt-in (entirely new section — off by default)

| ✅ | Gate | What's needed | Owner | Related |
|---|---|---|---|---|
| ☐ | `webinar.enabled` | Does a real lead-magnet asset (recorded masterclass, guide, template) actually exist? This section has nothing to gate content *toward* until one does — it's not just copy-blocked, it's asset-blocked | Founder | New in V4 |

## 8. Exclusivity CTA

| ✅ | Gate | What's needed | Owner | Related |
|---|---|---|---|---|
| ☐ | `exclusivity.headline` / `.body` | Copy — **first confirm the "we're selective" tone is wanted at all**, don't just fill in copy for it | Founder | Open_Decision.md Q7 |

## 9. Chat widget

Tool is decided in V4 — it's WhatsApp specifically (`chat.whatsapp_number`
is the actual gate). What's still open is the number and the persona.

| ✅ | Gate | What's needed | Owner | Related |
|---|---|---|---|---|
| ☐ | `chat.whatsapp_number` | A real WhatsApp Business number to receive chats | Founder | Open_Decision.md Q8 |
| ☐ | `chat.persona_name` / `.greeting` | Whose name the widget uses and what it opens with | Founder | Open_Decision.md Q8 |

## 10. `/services` page pricing tiers

Tier *names* are already decided (Chada chrome, not content-blocked):
Advisory Sessions / Full Builds / Ongoing Care. What's needed is what's
actually inside each tier.

| ✅ | Gate | What's needed | Owner | Related |
|---|---|---|---|---|
| ☐ | `PricingService` — 4 advisory + 6 full-build + 5 ongoing-care entries | Real descriptions and prices (or "Contact for pricing") for all 15 line items | Founder | New in V4 |
| ☐ | `/services` add-ons | Any add-on line items beyond the three tiers | Founder | New in V4 |

---

## Related, but not a config content item

These block a section too, but they're decisions/assets, not copy to hand over:

| ✅ | Item | What's needed | Related |
|---|---|---|---|
| ☐ | Trust bar logos | Real client logos + permission to display (renders nothing until then — unchanged since V2) | Open_Decision.md Q2 |
| ☐ | Webinar asset itself | Not just "enable the section" — an actual recorded masterclass/guide needs to exist first | §7 above |

---

## Explicitly NOT on this list

`services-checklist.blade.php` (the 12-item capabilities list) uses **real**
Chada content already, pulled from the existing services data — it was
deliberately excluded from the placeholder system since that content already
exists and doesn't need sign-off. If it looks wrong, that's a content edit
request, not a row to add here.

`/work` filter categories and the Demo Lab's 6 tabs are structural, driven
directly by the 6 real `PreviewService` demos — nothing to fill in beyond
§3's case-study content, since both features read from the same data.

---

## V4 additions (Redesign(2).md — lorem generator + gates)

| ✅ | Config key / location | What's needed | Owner | Related |
|---|---|---|---|---|
| ☐ | `CaseStudyService` → 6 × `metric` + `metrics` | One verified headline number per demo client (e.g. lead growth, conversion lift). **Each entry stays `published => false` until its metric lands.** | Founder + Tech Lead | Replaces the old "placeholder" entries |
| ☐ | `CaseStudyService` → 6 × `challenge` / `solution` / `results` | One-paragraph narratives per case study | Founder | — |
| ☐ | `CaseStudyService` → 6 × `workflow.verified` | Tech Lead confirms every workflow step/tool reflects what was actually built, then flips to `true` | Tech Lead | Feeds System Blueprints |
| ☐ | `placeholders.offers.*.price_ngn` / `price_usd` / `price_period` | Real price per offer tier (₦ + $ + period). Views show "Contact for pricing" until set | Founder | Open_Decision.md Q3 |
| ☐ | `placeholders.stats.home_top` (×4) + `home_bottom` (×4) | Verified numbers + labels. Section hidden until a variant is fully populated | Founder | — |
| ☐ | `placeholders.hero.proof_line` | Verified trust line (or leave null — renders nothing). **Note: partials/hero.blade.php currently hardcodes "Trusted by 50+ brands" (D12); R3 gates and removes it.** | Founder | Was hardcoded pre-V4; now gated |
| ☐ | `placeholders.webinar.enabled` | Stays `false` until a real replay/masterclass asset exists | Founder | Open_Decision.md Q4 family |
| ☐ | `placeholders.testimonials` (array) | Real quotes WITH client permission — each entry replaces a lorem card | Founder | Open_Decision.md Q5 |
| ☐ | `placeholders.manifesto.enabled` + `items` | David-approved standards/principles | Founder | Do not invent promises |
| ☐ | `placeholders.founder.real` + bio/photo/name | Real founder content (Q6). Flipping `real` also activates the JSON-LD Person node | Founder | Open_Decision.md Q6 |
| ☐ | `placeholders.martech.tools` + `subintro` | Confirm the tool list matches what Chada genuinely supports; approve intro line | Tech Lead | — |
| ☐ | `placeholders.chat.whatsapp_number` | E.164 WhatsApp number + persona decision (Q8). Widget stays no-op until set | Founder | Open_Decision.md Q8 |
| ☐ | `placeholders.workflow_speed_claim` | A MEASURED Chada system-speed claim, approved by David | Founder + Tech Lead | Never a borrowed figure |
| ☐ | `placeholders.lorem_seed` | Rotation log: record each rotation date/reason here | Tech Lead | Dynamic lorem control |

### Reconciliations — keys removed or relocated in this phase

| Old V2 key | Status | R3 action |
|---|---|---|
| `hero.headline` / `hero.subhead` | Removed — now Lorem slots in R3's hero rewrite | R3 task: delete `$hero['headline']` / `$hero['subhead']` reads from hero.blade.php |
| `offers.*.title` / `offers.*.description` / `offers.*.cta_label` | Removed — Lorem slots in R3's goal-picker upgrade | R3 task: goal-picker uses `?? Lorem::title/paragraph(..., $i)` |
| `founder.name` / `founder.title` / `founder.bio_points` | Removed — Lorem slots in R3's founder-bio upgrade | R3 task: replace $founder['name'] reads with Lorem calls |
| `assessment.headline` / `assessment.body` | Removed — section renamed `audit` in R3 | R3 task: git mv assessment-cta → audit-cta, update config reads |
| `exclusivity.headline` / `exclusivity.body` | Removed — Lorem slots in R3's exclusivity rewrite | R3 task: replace $exclusivity reads with Lorem calls |
| `chat.persona_name` / `chat.greeting` | Removed — replaced by whatsapp_number / whatsapp_prefill | R3 task: upgrade chat-widget.blade.php for V4 chat keys |
| `testimonials` (×3 legacy entries) | Removed — array now empty; R3 view renders Lorem cards | R3 task: empty-array branch in testimonials.blade.php |
