# TODO-Placeholders.md — Content Needed Before Launch

> Companion to `config/placeholders.php` (created per `REDESIGN_IMPLEMENTATION_PROMPT.md`
> Phase 1). Every item below is currently lorem ipsum on the live build. **This file's
> job is to get checked off, not filed.** Once a row is done, update the config key
> directly and check it here — don't let this list and the actual file drift apart.
>
> For the reasoning behind *why* each item is still a placeholder, see the matching
> `Open_Decision.md` question. This doc is the "what to send me" list; that one's the
> "why we haven't decided yet" list.

---

## How to fill this in

You don't need to touch code. For each row, reply with the content (or point at a doc/
photo) and it gets dropped into `config/placeholders.php` directly. Rows are roughly
ordered by how much they block everything else — **Offers (below) first**, since the
whole homepage structure is built around it.

---

## Content checklist

| ✅ | Config key | What's needed | Owner | Related |
|---|---|---|---|---|
| ☐ | `placeholders.offers` (×6) | The six real tiered offers — each needs a title framed as "I want Chada Digital to ___," a 1-2 sentence description, and where the button should go (contact form? a specific page? a booking link?) | Founder | Open_Decision.md Q3 — **highest priority**, the homepage structure is built around this |
| ☐ | `placeholders.hero.headline` | One sentence: the core value proposition, in outcome terms (what does a client get, not what Chada does) | Founder | Open_Decision.md Q1 |
| ☐ | `placeholders.hero.subhead` | 1-2 supporting sentences under the headline | Founder | Open_Decision.md Q1 |
| ☐ | `placeholders.testimonials` (×3-4) | Real client quotes + name + company — **only if we have permission to publish them.** If not, this section gets cut, not shipped with fake ones. | Founder / whoever holds client relationships | Open_Decision.md Q5 — confirm existence before content |
| ☐ | `placeholders.founder.name` / `.title` | Real name and title | Founder | Open_Decision.md Q6 |
| ☐ | `placeholders.founder.bio_points` | 3-4 short bio bullets (background, credentials, recognition — mirrors the style in Redesign.md §1.7) | Founder, in their own words or approved by them directly | Open_Decision.md Q6 |
| ☐ | `placeholders.founder.photo` | A real headshot, replacing the silhouette placeholder graphic | Founder | Open_Decision.md Q6 |
| ☐ | `placeholders.exclusivity.headline` / `.body` | Closing CTA copy — **first confirm we actually want the "we're selective" tone at all**, don't just fill in copy for it | Founder | Open_Decision.md Q7 (yes/no on the tone, before the copy) |
| ☐ | `placeholders.assessment.*` | Only needed if the quiz section stays static long-term (current build) — if Q4 upgrades this to a real interactive quiz instead, this row becomes moot | Founder / Tech Lead | Open_Decision.md Q4 |
| ☐ | `placeholders.chat.persona_name` / `.greeting` | Whose name the chat widget uses and what it opens with — **blocked on the tool decision below, fill this in together** | Founder | Open_Decision.md Q8 |

---

## Related, but not a `config/placeholders.php` content item

These block a real (not placeholder) build of their section too, but they're decisions/
assets, not copy to paste into a config file:

| ✅ | Item | What's needed | Related |
|---|---|---|---|
| ☐ | Trust bar logos | Real client logos + permission to display them (section currently renders nothing) | Open_Decision.md Q2 |
| ☐ | Chat widget tool | Pick one: WhatsApp click-to-chat, a chat-widget product (Intercom/Crisp/Tawk/etc.), or something else — current build is a dead-click placeholder until this is picked | Open_Decision.md Q8 |
| ☐ | Case-study system fate | Keep `/work` as a secondary portfolio page, remove it entirely, or leave it frozen (current default) | Open_Decision.md Q9 |

---

## Explicitly NOT on this list

`services-checklist.blade.php` uses **real** Chada service content already (pulled from
the existing `services.blade.php` array) — it was deliberately excluded from the
placeholder system since that content already exists. If it looks wrong, that's a
content edit, not a placeholder to fill in.