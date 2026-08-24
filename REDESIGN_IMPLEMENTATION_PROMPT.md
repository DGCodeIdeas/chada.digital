# REDESIGN_IMPLEMENTATION_PROMPT.md — V2 (WAB Replicate) Agent-Ready Build Instructions

> **Source of truth:** `Redesign.md` + `Open_Decision.md` on `main` (V2 — WAB Digital
> replicate, per Founder direction, Aug 20 2026)
> **Supersedes:** the previous `REDESIGN_IMPLEMENTATION_PROMPT.md` (built for the
> archived V1 light-theme + case-study direction — do not follow that one, I've deleted it)
> **Content approach:** Founder has approved **lorem ipsum placeholder content**
> for every section still blocked on real copy (Open_Decision.md Q1, Q3, Q5, Q6,
> Q7). This unblocks the build. Placeholder content is **centralized and
> data-driven**, not hardcoded per-file, so swapping in real content later means
> editing one file, not hunting through Blade partials.
> **Target:** Paste directly into Cline / Jules / Kilo / Zoo Code.

---

## Why a config file instead of the existing inline-array pattern

`services.blade.php` (already on `main`) uses `@php $services = [...] @endphp`
inline at the top of the partial — fine for real, stable content. Placeholder
content is different: it's *temporary by definition* and needs to be findable
and replaceable in one place, without a dev having to remember which of six new
partials has which fake paragraph in it. So this build introduces
**`config/placeholders.php`** as the single source for every lorem-ipsum value,
and every new section reads from `config('placeholders.xxx')` rather than
defining its own array. Real, stable content (like the services checklist in
Phase 3, Task 2) still follows the existing inline-array convention — the config
file is specifically for content that's known to be fake and swapped out later.

---

## 🚨 Constraints — repeat in every agent session

- Never touch `public/demos/`
- `mix()` not `@vite()`, `bun` not `npm`
- Keep existing jQuery modules as-is; new interactivity may use Alpine.js or vanilla JS
- PHP 8.2 constructor promotion for new services/controllers
- New reusable pieces use Blade's `<x-component-name>` syntax
- Match the visual language already established in `services.blade.php` /
  `trust-bar.blade.php` (card style, spacing scale, `text-xs uppercase
  tracking-[0.3em]` eyebrow labels, `font-display` headings with a
  `text-primary` highlighted word) — this build is new sections in an existing
  system, not a fresh visual direction
- Run `bun run dev` after every asset-affecting change; `bun run prod` before
  considering a phase done

---

## Phase 1 — Foundation: placeholder config + homepage restructure

```text
You are implementing Phase 1 of the Chada Digital V2 redesign (WAB Digital
replicate) at DGCodeIdeas/chada.digital, per Redesign.md and Open_Decision.md
on main. The Founder has approved lorem ipsum placeholder content for every
section blocked on real copy — do not leave these sections unbuilt, and do not
invent realistic-sounding fake content (real client names, real-sounding
testimonials, real-sounding bio credentials) instead of actual lorem ipsum.
Use genuine "Lorem ipsum dolor sit amet..." style filler text.

CONSTRAINTS: see top of REDESIGN_IMPLEMENTATION_PROMPT.md.

TASK 1 — Create config/placeholders.php
A single array, one top-of-file comment block making clear this is temporary:

  <?php
  // TEMPORARY PLACEHOLDER CONTENT — approved by Founder, Aug 20 2026.
  // Every value here is lorem ipsum, not real copy. Replace section-by-section
  // as real content becomes available (see Open_Decision.md Q1, Q3, Q5, Q6, Q7)
  // — do not remove this file until every key below has been replaced.
  return [
      'hero' => [
          'headline' => 'Lorem Ipsum Dolor Sit Amet Consectetur',
          'subhead' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
              sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
      ],
      'offers' => [
          // 6 entries, each: title (framed "I want Chada Digital to..."),
          // description (1-2 sentences lorem ipsum), cta_label.
          // Structure mirrors Redesign.md §3.3 — six tiers spanning self-serve
          // to full-service. Use placeholder titles too, e.g. "Lorem Ipsum
          // Dolor Sit" — do not invent real-sounding Chada service names,
          // that's exactly the content Open_Decision.md Q3 is still open on.
      ],
      'testimonials' => [
          // 3-4 entries: quote (lorem ipsum), name => 'Lorem Ipsum',
          // role => 'Lorem Ipsum, Dolor Sit Inc.' — never a real-sounding
          // company or person name.
      ],
      'founder' => [
          'name' => 'Lorem Ipsum',
          'title' => 'Lorem Ipsum, Dolor Sit Amet',
          'bio_points' => [ /* 3-4 short lorem ipsum bullet fragments */ ],
          'photo' => '/assets/images/founder-placeholder.jpg',
      ],
      'exclusivity' => [
          'headline' => 'Lorem Ipsum Dolor Sit Amet',
          'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
      ],
      'chat' => [
          'persona_name' => 'Lorem',
          'greeting' => 'Lorem ipsum dolor sit amet — how can I help?',
      ],
  ];

TASK 2 — Case-study system: freeze, unroute (Open_Decision.md Q9 default)
No formal Q9 answer yet — implementing the lowest-risk, fully-reversible option
per Redesign.md §5 option C, NOT deleting anything:
  - Remove the case-studies @include from resources/views/pages/home.blade.php
  - Remove any "Work"/"Our Work" link from partials/header.blade.php nav and
    the mobile menu
  - Remove /work and /case-study/{slug} entries from the sitemap() method in
    PageController (routes stay registered and reachable by direct URL — do
    NOT delete routes/web.php entries, CaseStudyService, CaseStudyController,
    or the 4 related Blade components)
  - Leave a comment in routes/web.php above those two routes: "// Not linked
    from nav/homepage as of Aug 20 2026 — kept live per Open_Decision.md Q9
    pending a final decision. Do not delete without confirming with David."

TASK 3 — Reorder resources/views/pages/home.blade.php
New order per Redesign.md §3:
  hero -> trust-bar -> goal-picker -> assessment-cta -> testimonials ->
  services-checklist -> founder-bio -> exclusivity-cta -> contact
(goal-picker, assessment-cta, testimonials, services-checklist, founder-bio,
exclusivity-cta are all built in Phase 2/3 below — for now just @include them
even though the files don't exist yet; you'll create them next.)
Remove @include('partials.process') and @include('partials.about') from this
list — Redesign.md §2.1 flags both as not matching the replicate structure.
Do not delete process.blade.php or about.blade.php files themselves yet, just
stop including them (same reversibility principle as Task 2).

VERIFY: bun run dev builds clean. config/placeholders.php returns a valid
array (php artisan tinker -> config('placeholders.hero') as a quick check).
Homepage will render broken @include errors until Phase 2 creates the new
partials — that's expected, continue to Phase 2 in the same session if
possible.
```

---

## Phase 2 — New sections (all config-driven placeholder content)

```text
Phase 2 — build the 6 new sections. Same constraints as Phase 1. Phase 1 must
be complete first (config/placeholders.php must exist).

TASK 1 — resources/views/partials/goal-picker.blade.php (Redesign.md §3.3)
Read $offers = config('placeholders.offers') (6 entries). Render as a grid of
cards, each: eyebrow-style small label, title, description, a CTA button
(reuse <x-button-primary> or <x-button-outline> if those components already
fit — check resources/views/components/ first). Follow the visual pattern
already in services.blade.php (rounded-2xl border border-border bg-card,
hover lift) for consistency — this is a new section, not a new visual style.
Section id="goals" for nav/anchor linking later if needed.

TASK 2 — resources/views/partials/assessment-cta.blade.php (Redesign.md §3.4)
Lowest-cost version per Redesign.md's recommendation (Open_Decision.md Q4
still formally open — build the cheap version, not a scored interactive
quiz): a single section, headline + short body from a NEW config key you add
(config('placeholders.assessment') — add this to placeholders.php, it was
missed in the Phase 1 task list above) + one CTA button linking to #contact.
No interactivity, no scoring logic. Flag in a code comment that Q4 could
upgrade this later.

TASK 3 — resources/views/partials/testimonials.blade.php (Redesign.md §3.5)
Read config('placeholders.testimonials'). Simple card row/carousel — check
if a carousel pattern already exists anywhere in resources/js/modules/ before
writing new JS; if not, a static grid (no carousel) is an acceptable v1,
note this as a possible enhancement rather than building a new JS carousel
from scratch unprompted.

TASK 4 — resources/views/partials/founder-bio.blade.php (Redesign.md §3.7)
Read config('placeholders.founder'). Photo + name + title + bio bullet list,
matching WAB's actual layout (Redesign.md §1.7): photo one side, first-person-
style intro + credibility bullets the other. Use a neutral placeholder image
path (config already specifies /assets/images/founder-placeholder.jpg) — do
NOT use a real stock photo of an actual person; use a plain silhouette/
initials placeholder graphic instead, since a real photo of a real (different)
person in a "founder bio" slot is a much worse placeholder than lorem ipsum
text is.

TASK 5 — resources/views/partials/exclusivity-cta.blade.php (Redesign.md §3.8)
Read config('placeholders.exclusivity'). Simple centered closing-CTA section,
similar structural weight to the existing contact section intro.

TASK 6 — Update resources/views/pages/home.blade.php includes
Confirm all 6 @include lines from Phase 1 Task 3 now resolve to real files.

VERIFY: bun run dev clean build. Homepage renders top to bottom with no
missing-include errors. Every new section visibly shows lorem ipsum text —
confirm nothing invented real-sounding copy instead.
```

---

## Phase 3 — Hero rewrite, services checklist, chat widget placeholder

```text
Phase 3. Same constraints. Phase 2 must be complete and building clean first.

TASK 1 — resources/views/partials/hero.blade.php
Replace the current headline/subhead with config('placeholders.hero').
headline/subhead. Keep existing layout/CTA structure otherwise — this is a
copy swap, not a new hero design (the current hero was already built during
V1 and its layout doesn't need to change for the replicate direction).

TASK 2 — resources/views/partials/services-checklist.blade.php (Redesign.md §3.6)
This is the ONE new section that does NOT use placeholder content — Redesign.md
flags it as the lowest-content-risk section since real Chada service
descriptions already exist. Pull the real items already used in the existing
$services array in services.blade.php (Web Development, Funnel & Automation,
Paid Advertising, Brand & Strategy) plus the tools/stack lines, and present
them as a flat checklist (icon + label per line, per WAB's actual list-style
layout in Redesign.md §1.6) rather than the 4-card grid services.blade.php
already uses elsewhere. Do NOT create a second config key for this — reuse
the real array already in services.blade.php (extract it to a shared location
if needed to avoid duplicating it in two files, e.g. a small
app/Services/ServiceOfferings.php following the existing PreviewService
pattern, OR simply duplicate the 4 real entries directly — either is fine,
your call, just don't invent NEW fake service names here).

TASK 3 — resources/views/partials/chat-widget.blade.php (Redesign.md §3.9)
Open_Decision.md Q8 (which tool, whose persona) is NOT resolved by the
lorem-ipsum decision — do not integrate a real chat SaaS product (Intercom/
Crisp/Tawk) or a real WhatsApp Business number here. Build the lowest-cost
placeholder: a simple fixed-position circular button (bottom-right, matches
WAB's widget position) using config('placeholders.chat').persona_name and
.greeting in a small popover/tooltip on hover or click — but the button's
actual click target should be a no-op or scroll-to-contact, NOT a real
WhatsApp deep link or embedded chat script. Comment clearly: "// Placeholder
only — Open_Decision.md Q8 (tool + persona) not yet decided. Do not wire to
a real WhatsApp number or chat SaaS product without that decision."
Include this via layouts/app.blade.php (site-wide), not just the homepage.

VERIFY: bun run dev clean build. Hero shows placeholder headline. Services
checklist shows REAL Chada service names (this is the one section that
should NOT say "Lorem Ipsum"). Chat widget renders but doesn't link anywhere
real yet.
```

---

## Phase 4 — Polish, QA, sign-off

```text
Phase 4 — final pass. Same constraints.

CHECKLIST:
[ ] grep -r "Lorem ipsum" resources/views/ — confirm it appears in exactly
    the sections expected (hero, goal-picker, assessment-cta, testimonials,
    founder-bio, exclusivity-cta) and NOWHERE else — especially not in
    services-checklist.blade.php, header, footer, or contact
[ ] grep -r "config('placeholders" resources/views/ — cross-check against
    config/placeholders.php keys, confirm nothing references a key that
    doesn't exist
[ ] /work and /case-study/{slug} still load correctly by direct URL (frozen,
    not deleted — verify Task 2 in Phase 1 didn't break them, only unlink them)
[ ] No "Work" link anywhere in header/mobile nav/footer
[ ] /sitemap.xml no longer lists /work or /case-study/* entries
[ ] Chat widget button doesn't fire any real network request or external link
[ ] Founder bio uses a placeholder graphic, not a real photo of anyone
[ ] Mobile responsive check on all 6 new sections
[ ] bun run prod completes clean
[ ] Contact form (existing, untouched) still submits successfully

DO NOT merge to a point where this looks launch-ready without flagging to
David that config/placeholders.php still has unreplaced content — the whole
point of centralizing it was to make that check fast, not to make it easy to
forget. Open a PR, don't push a "ready to launch" framing in the PR
description while placeholder content remains.
```

---

## Still open regardless of this build (unchanged from Open_Decision.md)

Lorem ipsum unblocks the *build*, not the underlying decisions:

1. Real hero headline / value prop (Q1)
2. The actual six tiered offers (Q3) — this is the highest-value real content
   to get first, since it's structurally the core of the WAB-replicate approach
3. Whether real testimonials exist at all (Q5)
4. Real founder bio + photo (Q6)
5. Exclusivity framing — do we actually want this tone (Q7)
6. Quiz fidelity — is the static version (built here) the final answer, or does
   Q4 need a real interactive quiz later
7. Chat tool + persona (Q8) — nothing here is wired to a real number/vendor
8. Case-study system's actual fate (Q9) — Phase 1 implements the reversible
   "freeze" default, not a final decision