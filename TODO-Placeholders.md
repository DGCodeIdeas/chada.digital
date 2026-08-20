# TODO — Placeholders (pre-launch, require David approval)

These are the live placeholder values that must be replaced or explicitly approved by David
before the redesign is published. Do **not** open a PR to `main` / go live until every item
below is resolved. No code changes were made to these during Phase 4 QA.

---

## 1. Case study content — `app/Services/CaseStudyService.php`

Three placeholder entries (`case-study-a`, `case-study-b`, `case-study-c`). Every field is
placeholder copy; none reflects real client data.

For **each** of the 3 entries, replace:

| Field | Current placeholder |
|-------|---------------------|
| `client` | `Placeholder Client A/B/C` |
| `industry` | `Placeholder Industry` |
| `category` | `Web Development` / `Funnels` / `Ads` (keep or correct) |
| `metric` | `Placeholder — pending Ops (see Open_Decision.md Q2)` |
| `metric_label` | `Result Pending` |
| `metrics[].value` | `Pending` (×3) |
| `metrics[].label` | `Result Pending` (×3) |
| `tags` | `['Placeholder']` |
| `excerpt` | `Placeholder excerpt — do not publish live.` |
| `thumbnail` | `/assets/images/case-study-placeholder.jpg` |
| `workflow[].step` | `Placeholder Step` |
| `workflow[].tool` | `Placeholder Tool` |
| `challenge` | `Placeholder.` |
| `solution` | `Placeholder.` |
| `results` | `Placeholder.` |
| `tools` | `['Placeholder']` |

**Gate anchor:** `grep "Placeholder — pending Ops"` must stay true (all 3 entries) until
David supplies real copy — then the strings may be removed. See `Open_Decision.md` Q2.

---

## 2. Meta description — `resources/views/...` (home)

Current value (placeholder positioning line, not David-approved final copy):

> We engineer high-performance websites, command-attention brands, and intelligent
> automation for ambitious teams across Nigeria and beyond.

Action: David to approve or supply final meta description wording.

---

## 3. Open Graph image — `public/og-image.jpg`

File exists (1536×1024 JPEG) and is referenced via
`<meta property="og:image" content="https://www.chadadigital.com/og-image.jpg">`, but its
visual/content has **not** been reviewed or approved by David.

Action: David to review the image and confirm it matches the new positioning, or supply a
replacement.

---

## 4. Live preview demo count — `public/demos/`

`public/demos/` contains **6** demos: `apexflow`, `elysian`, `hirebase`, `noir`,
`sterling-vale`, `timber-mill`. The Phase 4 checklist referenced "5" previews.

Action: David to confirm the intended number of live previews (5 or 6) and whether any
should be hidden before launch. All 6 currently return HTTP 200 via `/preview/{slug}`.

---

## Status summary

| # | Item | Owner | Status |
|---|------|-------|--------|
| 1 | Case study placeholder copy (3 entries) | David | BLOCKED |
| 2 | Meta description wording | David | BLOCKED |
| 3 | og-image.jpg visual approval | David | BLOCKED |
| 4 | Preview demo count (6 vs 5) | David | BLOCKED |

**All four are gates** — launch is blocked until resolved.
