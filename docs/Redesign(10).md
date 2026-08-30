# Redesign(10).md — Visual System Migration: Tailwind → Bootstrap + Material Web Components (V5)

> **Series:** Redesign(1)–Redesign(10) — agent-ready build documents for the Chada Digital redesign
> **This is V5.** It supersedes the Tailwind-specific portions of Redesign(1)–Redesign(9) and adds a new Phase 10 to the build order.
> **Mandate (founder directive, ratified Aug 30, 2026):** The site must not look obviously AI-generated. Tailwind's utility-class aesthetic reads as "generic SaaS template" — Bootstrap 5 + Material Web Components + custom SCSS, layered in that strict order, is the chosen replacement.
> **Stack:** Laravel 12 + Blade + **Bootstrap 5.3 + Bootstrap Icons + Material Web Components (@material/web) + Material Symbols + Inter** · Laravel Mix · Bun (never npm) · PHP 8.2+
> **Repo:** `DGCodeIdeas/chada.digital` · default branch `main`
> **This document:** The Phase 10 migration spec. Agents execute it after Phase 9 ships, OR as a parallel visual-only branch that other phases can rebase onto once it lands. It contains everything an agent needs to swap the entire CSS engine without changing any visible layout, content, or behavior.

---

## 0. Why this series exists — the V5 layer

V4 (Redesign 1–9) was authored against **Tailwind CSS v3 + Laravel Mix** as the CSS engine. The structural and content model in V4 is correct and stays. What changes in V5 is the engine itself, plus two design-principle deviations the Founder added alongside the engine swap:

1. **No borders.** Every section, card, and panel currently uses `border`, `border-border`, `border-t`, `border-border/40` to draw visible separators. Under V5, **borders are removed entirely** and sections fuse seamlessly into the page. Separation between content areas is achieved through elevation (M3 shadow tokens), background tint shifts, and whitespace — never through visible strokes. The only exceptions are interactive focus rings (accessibility, non-negotiable) and form inputs (where a visible boundary is a usability requirement).

2. **The trust-strip deviation.** The V4 spec had a "trust strip" section showing client logos, gated so it renders nothing while logos are empty. The Founder's new framing replaces this concept entirely with a **Design Partner offer**: instead of faking logos, the empty state becomes the message — *"No customer logos yet, we won't fake them. Become a design partner."* This is honest, on-brand, and reads as confident rather than template-default. Implementation: the trust-strip partial is repurposed as a `design-partner` band that always renders (no gate), with that copy as the visible content. When real logos do exist (future state), the band becomes a logo row again — but only with explicit Founder sign-off per logo.

### 0.1 What changes vs. what stays

| Aspect | V4 (Tailwind) | V5 (Bootstrap + M3) |
|---|---|---|
| CSS engine | Tailwind v3 utility classes | Bootstrap 5.3 component classes + custom SCSS utilities |
| Design tokens | `tailwind.config.js` (JS object) | `resources/sass/_tokens.scss` (SCSS variables → M3 CSS custom properties) |
| Component layer | Tailwind utilities + a few `<x-…>` Blade components | Bootstrap component classes for known patterns (`.btn`, `.card`, `.nav`, `.accordion`) + Material Web Components for M3-native patterns (`<md-filled-button>`, `<md-menu>`, `<md-tabs>`) |
| Icons | Inline SVG per partial | Material Symbols variable font (one icon set, weight-adjustable) |
| Typography | Inter (body) + Outfit (display) | **Inter (body) + Inter (display, tighter weight)** — single font, varied weights; Outfit is dropped. M3 typography scale (Display/Headline/Title/Body/Label) applied via Bootstrap's `$font-size-*` Sass map. |
| Color palette | `#f4f2ee` background, `#2563eb` primary (Tailwind tokens) | **Same palette, mapped to M3 CSS custom properties:** `--md-sys-color-primary: #2563eb`, `--md-sys-color-surface: #f4f2ee`. Surfaces (elevation, shape, motion) adopt M3 defaults. |
| Borders | Used throughout | **Removed.** See §5. |
| Trust strip | Gated client logos | **Design Partner band** — always renders. See §6. |
| Loading order | N/A (Tailwind compiles to one CSS file) | **Bootstrap first → Material Web Components → custom SCSS.** See §1. |

### 0.2 What does NOT change

- All Blade partials' structural HTML (the section composition, gating logic, `@if` guards, `data_get()` patterns) stays identical.
- All content model rules from V4 §2 (kind A/B/C strings, Lorem generator, gated facts) stay identical.
- All originality rules from V4 (constraint 11 — no third-party text/names/prices/metrics) stay identical.
- All route names, controller signatures, and `mix()` asset loading stay identical.
- The 18-pattern homepage architecture from V4 §1 stays identical.

**This is a visual-system pivot, not a structural pivot.** Agents executing Phase 10 must not alter any Blade partial's gating, content calls, or section order. They only swap the class strings inside the markup and update the asset pipeline.

---

## 1. Loading order and layering strategy

The CSS load order is **non-negotiable** and is enforced by `webpack.mix.js`:

```scss
// resources/sass/app.scss — the single entry point compiled by Mix
// Order is binding: each layer may only OVERRIDE what the previous layer established.

// 1. Bootstrap (foundation: reboot, grid, utilities, component base)
@import "~bootstrap/scss/bootstrap";

// 2. Material Web Components (component-level overrides — ripple, elevation, motion)
@import "@material/web/styles/defaults";
@use "@material/web/button/filled-button" as *;
@use "@material/web/button/outlined-button" as *;
@use "@material/web/menu/menu" as *;
@use "@material/web/tabs/tabs" as *;
// ...etc — only the M3 components actually used on the site

// 3. M3 design tokens mapped to Chada values (color, elevation, shape, motion)
@import "tokens";

// 4. Custom utilities + Chada-specific component classes (final layer, highest specificity)
@import "utilities";
@import "components";
```

**Why this order:**

- Bootstrap provides the grid system, reboot (CSS reset), and base component classes. It loads first because everything else needs the grid to exist before it can position against it.
- Material Web Components provide the Material-flavored component styling (ripple, elevation, motion). They load second so they can override Bootstrap's component defaults where the two disagree (button shape, card elevation, menu animation).
- M3 design tokens (color, elevation, shape, motion) load third so they're available as CSS custom properties to everything below.
- Custom utilities and Chada component classes load last so they win any specificity ties.

**What this means in practice:**
- A `<button class="btn btn-primary">` is styled by Bootstrap, then M3 overrides its elevation/ripple behavior, then Chada's `.btn-primary` customizations (specifically: `text-transform: none`, the M3 ripple, the Inter font weight) apply on top.
- A `<md-filled-button>` (Material Web Component) gets the M3 elevation/ripple natively, and Chada's `--md-sys-color-primary` token (set in `_tokens.scss`) makes it #2563eb.
- A custom utility like `.u-section-fused` (no border, no top margin, smooth color transition to neighbor) overrides anything Bootstrap or M3 set for borders.

### 1.1 Asset pipeline changes (webpack.mix.js)

```js
// webpack.mix.js — updated for V5
const mix = require('laravel-mix');

mix.sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/admin.scss', 'public/css')  // if present
   .js('resources/js/app.js', 'public/js')
   .js('resources/js/material-web.js', 'public/js')  // M3 component loader
   .version();

// Material Symbols loaded via CDN <link> in the layout (variable font, subset per page)
// Inter loaded via @fontsource/inter (npm/Bun) — compiled into the CSS
```

### 1.2 JavaScript entry point — material-web.js

```js
// resources/js/material-web.js — registers M3 custom elements
import '@material/web/all.js';

// Optional: configure ripple globally
import { styles as typescaleStyles } from '@material/typography/md-typescale-styles.js';
```

---

## 2. Design tokens — Chada primary, M3 surfaces

The token file moves from JS (`tailwind.config.js`) to SCSS (`resources/sass/_tokens.scss`). The values themselves are preserved — only the format and the additional M3 surface/elevation/shape tokens change.

```scss
// resources/sass/_tokens.scss — Chada primary + M3 surfaces

// === Chada primary palette (unchanged from V4) ===
$chada-bg:           #f4f2ee;
$chada-primary:      #2563eb;
$chada-primary-dark: #1d4ed8;
$chada-primary-light:##dbeafe;
$chada-card:         #ffffff;
$chada-muted-fg:     #6b7280;
$chada-border:       #e5e7eb;  // kept as token but UNUSED by default per §5 no-borders rule

// === M3 surface tokens (adopted from Material Design 3 defaults) ===
$md-sys-color-surface:          #fef7ff;  // M3 default surface tint (very pale)
$md-sys-color-surface-container:        #f3edf7;
$md-sys-color-surface-container-high:   #ede8f0;
$md-sys-color-surface-container-highest: #e7e0eb;
$md-sys-color-on-surface:                #1d1b20;
$md-sys-color-on-surface-variant:        #49454f;

// === M3 elevation (box-shadow) — adopted from M3 spec ===
$md-sys-elevation-1: 0 1px 2px 0 rgba(0, 0, 0, 0.03), 0 1px 6px 0 rgba(0, 0, 0, 0.02);
$md-sys-elevation-2: 0 1px 2px 0 rgba(0, 0, 0, 0.05), 0 2px 6px 0 rgba(0, 0, 0, 0.03);
$md-sys-elevation-3: 0 4px 8px 0 rgba(0, 0, 0, 0.06), 0 1px 3px 0 rgba(0, 0, 0, 0.04);

// === M3 shape scale (corner radii — used for cards, modals, buttons) ===
$md-sys-shape-corner-xs: 4px;
$md-sys-shape-corner-sm: 8px;
$md-sys-shape-corner-md: 12px;  // default for cards
$md-sys-shape-corner-lg: 16px;
$md-sys-shape-corner-xl: 28px;

// === M3 motion (transitions — adopted from M3 spec) ===
$md-sys-motion-easing-emphasized: cubic-bezier(0.2, 0.0, 0, 1.0);
$md-sys-motion-duration-short: 150ms;
$md-sys-motion-duration-medium: 250ms;
$md-sys-motion-duration-long: 400ms;

// === Expose as CSS custom properties for M3 components and utility classes ===
:root {
  --md-sys-color-primary: #{$chada-primary};
  --md-sys-color-on-primary: #ffffff;
  --md-sys-color-surface: #{$md-sys-color-surface};
  --md-sys-color-surface-container: #{$md-sys-color-surface-container};
  --md-sys-color-surface-container-high: #{$md-sys-color-surface-container-high};
  --md-sys-color-surface-container-highest: #{$md-sys-color-surface-container-highest};
  --md-sys-color-on-surface: #{$md-sys-color-on-surface};
  --md-sys-color-on-surface-variant: #{$md-sys-color-on-surface-variant};
  --md-sys-elevation-1: #{$md-sys-elevation-1};
  --md-sys-elevation-2: #{$md-sys-elevation-2};
  --md-sys-elevation-3: #{$md-sys-elevation-3};
  --md-sys-shape-corner-md: #{$md-sys-shape-corner-md};
  --md-sys-shape-corner-lg: #{$md-sys-shape-corner-lg};
}
```

### 2.1 Bootstrap Sass variable overrides (in `resources/sass/_bootstrap-overrides.scss`)

```scss
// resources/sass/_bootstrap-overrides.scss
// Bootstrap's $variable-defaults are overridden here BEFORE Bootstrap is imported.

$primary:   #2563eb;
$secondary: #6b7280;
$body-bg:   #f4f2ee;
$body-color: #1d1b20;
$card-bg:   #ffffff;
$border-radius:    0.75rem;  // 12px — M3 shape-md
$border-radius-sm: 0.5rem;
$border-radius-lg: 1rem;
$font-family-sans-serif: "Inter", -apple-system, "Segoe UI", Roboto, sans-serif;
$font-family-base: $font-family-sans-serif;

// REMOVE Bootstrap's default border behavior on cards — see §5
$card-border-width: 0;
$card-border-color: transparent;

// Buttons: no uppercase, no shadow by default (M3 ripple handles elevation)
$btn-box-shadow: null;
$btn-text-transform: none;
$btn-font-weight: 600;

// Forms: no harsh borders
$input-border-color: transparent;
$input-bg: var(--md-sys-color-surface-container);
$input-focus-border-color: $primary;
```

---

## 3. Typography migration — Inter + Material Symbols

V4 used **Inter (body) + Outfit (display)**. V5 drops Outfit and uses **Inter for both**, with weight and tracking variation to differentiate display from body. This makes the type system single-font (faster load, smaller CSS, more consistent feel) and aligns with M3's typography scale philosophy.

### 3.1 Font loading

```scss
// resources/sass/app.scss (continued from §1)
@import "@fontsource/inter/scss/mixins";  // loaded via Bun
@include fontFace("Inter", 400, normal);  // body
@include fontFace("Inter", 500, normal);  // labels, small text
@include fontFace("Inter", 600, normal);  // subheadings
@include fontFace("Inter", 700, normal);  // display headings
@include fontFace("Inter", 800, normal);  // hero
```

```blade
{{-- resources/views/layouts/app.blade.php — <head> section --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet">
```

### 3.2 M3 typography scale mapping

| M3 type role | Bootstrap class | Inter weight | Size | Use on Chada |
|---|---|---|---|---|
| Display Large | `.display-1` | 800 | 4.5rem | Hero H1 |
| Display Medium | `.display-2` | 800 | 3.5rem | Section dividers |
| Display Small | `.display-3` | 700 | 3rem | Major section H2 |
| Headline Large | `.h1` | 700 | 2.5rem | Subsection H2 |
| Headline Medium | `.h2` | 700 | 2rem | Card H3 |
| Headline Small | `.h3` | 600 | 1.5rem | Card H4 |
| Title Large | `.h4` | 600 | 1.25rem | Card titles |
| Title Medium | `.h5` | 500 | 1rem | Subtitles |
| Body Large | `.lead` | 400 | 1.125rem | Hero supporting line |
| Body Medium | (default) | 400 | 1rem | Default body |
| Body Small | `.small` | 400 | 0.875rem | Muted text |
| Label Large | `.btn` | 600 | 0.875rem | Button labels, eyebrows |

### 3.3 Material Symbols usage

Every inline SVG icon in V4 partials is replaced with a Material Symbol span:

```blade
{{-- V4 (Tailwind, inline SVG) --}}
<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="size-3">
  <path d="M20 6 9 17l-5-5"/>
</svg>

{{-- V5 (Material Symbols) --}}
<span class="material-symbols-outlined" aria-hidden="true">check</span>
```

Common icon swaps (see Material Symbols catalog for full names):
- check / checkmark → `check`
- arrow-right → `arrow_forward`
- play → `play_arrow`
- close / x → `close`
- menu (hamburger) → `menu`
- chevron-down → `expand_more`
- chevron-right → `chevron_right`
- sparkles (eyebrow icon) → `auto_awesome`
- bolt (speed icon) → `bolt`
- link / chain → `link`

### 3.4 Outfit removal

`@fontsource/outfit` is removed from `package.json`. Any `font-family: "Outfit"` references in views become `font-family: "Inter"` (the M3 typography scale handles the visual hierarchy via weight, not family).

---

## 4. Class migration — Bootstrap components + custom utility classes

The migration strategy is **hybrid**:
- For known component patterns (buttons, cards, nav, alerts, badges, accordions, tabs, forms), use **Bootstrap's component classes**. Predictable, well-tested, accessible.
- For layout/spacing that Bootstrap doesn't cover (the V4 spacing scale, custom eyebrow labels, the fused-section pattern), write **custom utility classes** in `resources/sass/_utilities.scss`.

### 4.1 Mapping table — Tailwind utility → Bootstrap component + custom utility

| Tailwind utility (V4) | Bootstrap + custom (V5) | Notes |
|---|---|---|
| `bg-card` | `.card` or `.bg-body-tertiary` | Use `.card` when wrapped in card markup; `.bg-body-tertiary` for tinted backgrounds |
| `bg-background` | (default — `$body-bg`) | Set globally via `_bootstrap-overrides.scss` |
| `text-muted-foreground` | `.text-body-secondary` | Bootstrap 5.3 token |
| `text-primary` | `.text-primary` | Identical in both |
| `text-foreground` | (default body color) | Set via `$body-color` |
| `border border-border` | **REMOVED** | Per §5 no-borders rule |
| `border-t border-border/40` | **REMOVED** | Use `.u-section-fused` instead (see §5.1) |
| `rounded-2xl` | `.rounded-3` (1rem) or `.rounded-4` (1.5rem) | Match M3 shape-md/lg |
| `flex` | `.d-flex` | Bootstrap utility |
| `grid` | `.d-grid` or `.row`/`.col-*` | Use Bootstrap grid for layout grids |
| `gap-12` | `.gap-4` (1.5rem) or custom `.u-gap-lg` | Bootstrap's gap scale is 0-5; for larger gaps add custom utilities |
| `space-y-3` | Wrap in `.d-flex.flex-column.gap-3` | Tailwind's space-y pattern → Bootstrap flex-column + gap |
| `px-6 py-20` | `.px-5.py-5` or custom `.u-section-pad` | V5 uses one consistent section padding utility |
| `text-xs uppercase tracking-[0.3em]` | `.eyebrow` (custom class) | Defined in `_utilities.scss` — see §4.2 |
| `size-5` | `.fs-5` or `.icon-sm` (custom) | Material Symbols sizing |
| `hover:bg-primary/10` | `.hover-bg-primary-soft` (custom) | Bootstrap doesn't have hover-bg-* utilities for arbitrary colors |
| `<x-button-primary href="...">` | `<x-button-primary href="...">` | Blade component stays — its internal class string changes from Tailwind to Bootstrap |

### 4.2 Custom utility classes (`resources/sass/_utilities.scss`)

```scss
// resources/sass/_utilities.scss

// Eyebrow label (small uppercase tracked text above section headings)
.eyebrow {
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.3em;
  color: var(--md-sys-color-primary);
}

// Section padding (consistent across all homepage sections)
.u-section-pad {
  padding: 5rem 1.5rem;
  @include media-breakpoint-up(md) { padding: 7rem 1.5rem; }
}

// Fused section — no border, smooth color transition (§5)
.u-section-fused {
  border: 0 !important;
  box-shadow: none;
  background: transparent;
  position: relative;
  &::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent, var(--md-sys-color-surface-container) 30%);
    z-index: -1;
  }
}

// Material Symbols sizing
.material-symbols-outlined {
  font-size: 1.25rem;
  line-height: 1;
  vertical-align: middle;
  &.icon-sm { font-size: 0.875rem; }
  &.icon-lg { font-size: 1.5rem; }
  &.icon-xl { font-size: 2rem; }
}

// Hover bg utility for arbitrary Chada colors
.hover-bg-primary-soft {
  &:hover, &:focus {
    background: rgba(37, 99, 235, 0.08);
  }
}
```

### 4.3 Component class strategy (`resources/sass/_components.scss`)

Custom component classes for Chada-specific patterns not covered by Bootstrap or M3:

```scss
// resources/sass/_components.scss

// Tiered offer card — V4's "goal-picker" pattern
.goal-card {
  @extend .card;
  border: 0;  // §5 no-borders
  background: var(--md-sys-color-surface-container);
  border-radius: var(--md-sys-shape-corner-md);
  box-shadow: var(--md-sys-elevation-1);
  transition: box-shadow $md-sys-motion-duration-medium $md-sys-motion-easing-emphasized,
              transform $md-sys-motion-duration-medium $md-sys-motion-easing-emphasized;
  &:hover { box-shadow: var(--md-sys-elevation-2); transform: translateY(-2px); }
}

// Workflow pipeline step (V4's x-workflow-diagram)
.workflow-step {
  @extend .d-flex, .align-items-center, .gap-2;
  padding: 1rem;
  background: var(--md-sys-color-surface-container-high);
  border-radius: var(--md-sys-shape-corner-sm);
}

// Design Partner band (replaces V4's trust-strip — see §6)
.design-partner-band {
  @extend .text-center, .py-5;
  background: linear-gradient(to right, var(--md-sys-color-surface-container), var(--md-sys-color-surface-container-high), var(--md-sys-color-surface-container));
  color: var(--md-sys-color-on-surface-variant);
}
```

---

## 5. The no-borders fusion principle

**Rule:** Under V5, the site has no visible borders. Sections fuse seamlessly into the page. The only allowed visible boundaries are:
1. Form input focus rings (accessibility — required)
2. Element focus rings on interactive elements (accessibility — required)
3. The M3 elevation shadows (these are shadows, not borders)
4. Optional: a 1px hairline at the very top of the global header (single exception, optional)

**Why:** The Founder's directive was that the site shouldn't look AI-generated. Hard borders around every card and section are a strong "template" tell — they read as default Tailwind/Radix output. Removing them forces the design to rely on elevation, color shifts, and whitespace for hierarchy — which is exactly what high-end editorial and product sites do.

### 5.1 How sections separate without borders

| Separation technique | When to use | Implementation |
|---|---|---|
| Background tint shift | Adjacent sections with different content density | `background: var(--md-sys-color-surface-container)` on the denser section |
| Elevation shadow | Cards that need to "lift" off the page | `box-shadow: var(--md-sys-elevation-1)` — never `border` |
| Whitespace gap | Two sections of the same density | `margin-top: 4rem` — extra padding, no visual rule |
| Gradient blend | Smoothest transition (use sparingly) | The `.u-section-fused::before` linear-gradient (see §4.2) |

### 5.2 Files affected by the no-borders rule

Every Blade partial currently using `border`, `border-*`, `divide-*` Tailwind classes is updated. The grep audit in §9 catches any missed instances. Specifically:
- `resources/views/partials/header.blade.php` — remove `border-b border-border`
- `resources/views/partials/footer.blade.php` — remove `border-t border-border`
- `resources/views/partials/goal-picker.blade.php` — remove `border border-border` from each card
- `resources/views/partials/founder-bio.blade.php` — remove `border border-border` from the photo container
- `resources/views/partials/services-checklist.blade.php` — remove `divide-y divide-border`
- `resources/views/components/x-section-badge.blade.php` — remove `border border-primary/20`

(See §8 for the complete per-partial migration map.)

---

## 6. The Design Partner deviation (replaces trust strip)

V4's "trust strip" was a client-logo row gated to render nothing while logos were empty. The Founder's new framing replaces that concept entirely.

### 6.1 The new copy

The Design Partner band always renders. The visible copy is:

> **No customer logos yet — we won't fake them.**
> Become a design partner.

(Chada-original copy, not paraphrased from anywhere. Tech Lead signs off on the wording; Founder signs off on the framing.)

### 6.2 Implementation

```blade
{{-- resources/views/partials/design-partner-band.blade.php --}}
<section class="design-partner-band u-section-fused">
  <div class="container">
    <p class="eyebrow mb-3">Early Access</p>
    <h2 class="display-6 mb-4">No customer logos yet — we won't fake them.</h2>
    <p class="lead mb-0">Become a <a href="{{ route('contact.submit') }}#partner" class="text-primary text-decoration-none">design partner</a>.</p>
  </div>
</section>
```

The band replaces the trust-strip include in `pages/home.blade.php`. It always renders (no gate). When real client logos exist (future state), the band can be repurposed — but only after explicit Founder sign-off per logo, per the originality rules.

### 6.3 The old trust-strip partial

`resources/views/partials/trust-strip.blade.php` (V4) is **deleted** in Phase 10. The homepage include that referenced it (`@include('partials.trust-strip')`) is updated to `@include('partials.design-partner-band')`.

### 6.4 Q11 in Open_Decision.md

A new open decision row Q11 is added to `Open_Decision.md` tracking the Design Partner offer (see Open_Decision.md updates in this phase). Status: ratified Aug 30, 2026.

---

## 7. File changes — the migration footprint

### 7.1 New files created

| File | Purpose |
|---|---|
| `resources/sass/_tokens.scss` | M3 design tokens mapped to Chada values (replaces `tailwind.config.js`'s color/theme section) |
| `resources/sass/_bootstrap-overrides.scss` | Bootstrap Sass variable overrides (`$primary`, `$body-bg`, etc.) |
| `resources/sass/_utilities.scss` | Custom utility classes (`.eyebrow`, `.u-section-pad`, `.u-section-fused`, etc.) |
| `resources/sass/_components.scss` | Chada-specific component classes (`.goal-card`, `.workflow-step`, `.design-partner-band`) |
| `resources/js/material-web.js` | M3 component loader — registers `<md-*>` custom elements |
| `resources/views/partials/design-partner-band.blade.php` | Replaces `trust-strip.blade.php` (§6) |
| `docs/Redesign(10).md` | This document |

### 7.2 Modified files

| File | What changes |
|---|---|
| `package.json` | Remove `tailwindcss`, `autoprefixer`, `postcss`. Add `bootstrap@^5.3`, `bootstrap-icons@^1.11`, `@material/web@^2.0`, `@fontsource/inter@^5.0`. Remove `@fontsource/outfit`. |
| `webpack.mix.js` | Remove `.postCss('resources/css/app.css', 'public/css', [require('tailwindcss'), require('autoprefixer')])`. Add `.sass('resources/sass/app.scss', 'public/css')` and `.js('resources/js/material-web.js', 'public/js')`. |
| `resources/sass/app.scss` | Replace `@tailwind base; @tailwind components; @tailwind utilities;` with the layered imports from §1.1 |
| `resources/views/layouts/app.blade.php` | Add Material Symbols `<link>` to `<head>`. Remove Tailwind-specific meta tags. |
| `resources/views/pages/home.blade.php` | Swap `@include('partials.trust-strip')` → `@include('partials.design-partner-band')`. Update class strings on container elements. |
| `resources/views/partials/*.blade.php` (all 14 partials) | Update Tailwind utility class strings → Bootstrap component classes + custom utilities. See §8. |
| `resources/views/components/*.blade.php` (all `<x-…>` components) | Same — update internal class strings. |
| `app/Services/CaseStudyService.php` | Replace `'Tailwind CSS'` strings in `'tools'` arrays with `'Bootstrap 5'` and `'Material Web'`. See Redesign(2).md updates. |
| `README.md` | Update tech stack table, file tree, dev setup. |
| `REDESIGN_IMPLEMENTATION.md` | Update stack header. Update §5 TOUCHED-NEVER list (`tailwind.config.js` → `resources/sass/_tokens.scss`). |
| `Implementation_redesign.md` | Update §1 constraint #4 (dependencies), constraint #9 (style charter). Update §5 phase map (add Phase 10 row). Add §7 Phase 10 kickoff block. Update file map. |
| `Open_Decision.md` | Update Q0 (design tokens mention). Add Q10 (visual system pivot ratified) and Q11 (Design Partner deviation ratified). |
| `TODO-Placeholders.md` | Add rows for new content gates (Design Partner copy sign-off, M3 component selection sign-off). |

### 7.3 Deleted files

| File | Why |
|---|---|
| `tailwind.config.js` | Replaced by `resources/sass/_tokens.scss` + `_bootstrap-overrides.scss`. **Phase 10 deletes this file.** |
| `postcss.config.js` (if present) | Tailwind's PostCSS pipeline is removed. Bootstrap compiles via Sass directly. |
| `resources/views/partials/trust-strip.blade.php` | Replaced by `design-partner-band.blade.php` (§6). |
| `resources/views/welcome.blade.php` (the Laravel default) | Currently mentions Tailwind. Replace with Bootstrap-based welcome OR delete (it's not used in production). |

---

## 8. Per-partial migration map

For each Blade partial, the V4 → V5 changes. The agent executing Phase 10 works through this list in order — each row is one commit, each commit is independently reviewable.

| # | Partial | V4 (Tailwind) | V5 (Bootstrap + M3 + custom) | Key changes |
|---|---|---|---|---|
| 1 | `layouts/app.blade.php` | `<link rel="stylesheet" href="{{ mix('css/app.css') }}">` + Tailwind directives | Same link + Material Symbols `<link>` in `<head>`. Remove `class="font-sans antialiased"` from `<body>` (Bootstrap handles this). |
| 2 | `partials/header.blade.php` | `border-b border-border` on header; `flex items-center justify-between` for nav | Remove border. Use `.navbar.navbar-expand-lg` (Bootstrap component). Add `<md-icon-button>` for mobile toggle. |
| 3 | `partials/footer.blade.php` | `border-t border-border/40`, `grid grid-cols-2` | Remove border. Use Bootstrap `.row`/`.col-md-*` grid. Add `.u-section-fused` if footer abuts another section. |
| 4 | `partials/hero.blade.php` | `text-center`, `mx-auto max-w-3xl`, dual CTA with `<x-button-primary>` | Use `.text-center`, `.container`, `.col-lg-8.mx-auto`. Update `<x-button-primary>` internal classes. |
| 5 | `partials/stats-bar.blade.php` (R3) | `grid grid-cols-2 md:grid-cols-4`, `border-t border-border` | Bootstrap `.row.row-cols-2.row-cols-md-4`. Remove border. Add `.u-section-fused` to integrate with hero above. |
| 6 | `partials/goal-picker.blade.php` (R3) | Per-card `border border-border rounded-2xl p-6` | Use `.goal-card` custom class (no border, M3 elevation). Bootstrap grid for the 6-card layout. |
| 7 | `partials/audit-cta.blade.php` (R3) | Single card with `border border-border` | `.card` + `.u-section-fused`. Remove border. |
| 8 | `partials/working-together.blade.php` (R3) | `grid grid-cols-3 gap-8`, item cards | Bootstrap `.row.row-cols-1.row-cols-md-3.g-4`. Cards use `.card` minus border. |
| 9 | `partials/services-checklist.blade.php` (R3) | `divide-y divide-border`, 2-column grid | Remove divide. Use Bootstrap `.row.row-cols-1.row-cols-md-2.g-3`. Items use `.d-flex.gap-3`. |
| 10 | `partials/webinar-optin.blade.php` (R3) | `border border-border rounded-2xl`, form inputs | `.card` no border. Form inputs use Bootstrap `.form-control`. Toggle via `<md-switch>`. |
| 11 | `partials/founder-bio.blade.php` (R3) | `grid grid-cols-2`, photo container `border border-border rounded-2xl` | Bootstrap `.row.align-items-center`. Photo container: `.ratio.ratio-1x1` + `.rounded-3`, no border. Keep the `@if(! empty(data_get($founder, 'real')))` guard from R3 Task 0. |
| 12 | `partials/testimonials.blade.php` (R3) | Quote cards `border border-border` | `.card` no border. Carousel option via Bootstrap `.carousel` if multiple testimonials. |
| 13 | `partials/workflow-system.blade.php` (R4) | Pipeline steps with connectors | Use `.workflow-step` custom class. Connectors via CSS `::after` pseudo-element, not borders. |
| 14 | `partials/x-result-card.blade.php` (R5) | Card with `border border-border rounded-2xl` | `.card` no border, M3 elevation. Image uses `.ratio.ratio-16x9`. |
| 15 | `partials/design-partner-band.blade.php` (NEW) | N/A | New file — see §6.2. |
| 16 | `partials/services-checklist.blade.php` (R6) | Pricing tiers, multiple cards | `.card-deck` or Bootstrap 5.3's grid of cards. Tier badges use `.badge.rounded-pill`. |
| 17 | `partials/demo-lab.blade.php` (R7) | Tab interface | Use `<md-tabs>` (M3 native). Each tab panel embeds `public/demos/` iframe. |
| 18 | `partials/martech-grid.blade.php` (R7) | Filterable grid | Bootstrap `.row` grid + filter chips via `<md-chips>` or custom `.btn.btn-sm.btn-outline-secondary`. |
| 19 | `partials/chat-widget.blade.php` (R8) | Floating button + popover | `<md-fab>` (floating action button). Popover via Bootstrap `.popover` or `<md-menu>`. |
| 20 | `components/x-button-primary.blade.php` | `<a class="inline-flex items-center ... bg-primary text-white rounded-2xl px-6 py-3">` | `<a class="btn btn-primary btn-lg rounded-3 px-4 py-2">`. Or use `<md-filled-button>` for native M3. |
| 21 | `components/x-button-outline.blade.php` | Outline button Tailwind classes | `.btn.btn-outline-primary.btn-lg.rounded-3` |
| 22 | `components/x-section-heading.blade.php` | H2 with Tailwind text utilities | `.h2` or `.display-6` per context. Highlighted word uses `<span class="text-primary">` (unchanged). |
| 23 | `components/x-section-badge.blade.php` | Small badge with `border border-primary/20` | `.badge.rounded-pill.bg-primary-soft` (custom) — no border. |
| 24 | `components/x-workflow-diagram.blade.php` (R4) | SVG-based pipeline | Material Symbols for step icons. `.workflow-step` custom class. |

---

## 9. Verification gates

Phase 10 ships only when all of these pass:

### 9.1 Grep gates (run from repo root)

```bash
# Gate 1: NO Tailwind utility classes in any Blade file
grep -rE '\b(bg-card|text-muted-foreground|border-border|rounded-2xl|space-y-|divide-y|divide-border|tracking-\[|leading-\[|size-\d|flex-shrink-0)\b' resources/views/
# Expected: ZERO hits.

# Gate 2: NO Tailwind config references anywhere except archive/
grep -ri 'tailwind' --include='*.md' --include='*.php' --include='*.blade.php' --include='*.js' --include='*.json' --include='*.scss' . | grep -v 'archive/' | grep -v 'node_modules/' | grep -v 'vendor/'
# Expected: ZERO hits outside archive/.

# Gate 3: NO `@tailwind` directives in any .scss file
grep -r '@tailwind' resources/sass/
# Expected: ZERO hits.

# Gate 4: Material Symbols loaded in layout
grep -F 'Material+Symbols' resources/views/layouts/app.blade.php
# Expected: 1 hit (the <link> tag).

# Gate 5: Bootstrap imported first, M3 second, custom last
head -10 resources/sass/app.scss | grep -E '^(//|@import|@use)'
# Expected order: bootstrap → @material/web → tokens → utilities → components.

# Gate 6: Design Partner band exists and is included in homepage
test -f resources/views/partials/design-partner-band.blade.php && \
  grep -F "partials.design-partner-band" resources/views/pages/home.blade.php
# Expected: both succeed.

# Gate 7: trust-strip.blade.php is deleted
test ! -f resources/views/partials/trust-strip.blade.php
# Expected: succeeds (file does not exist).

# Gate 8: tailwind.config.js is deleted
test ! -f tailwind.config.js
# Expected: succeeds.

# Gate 9: All borders removed from partials (no `border` class string except in comments)
grep -rE '\bclass="[^"]*\b(border|border-[a-z]+)\b' resources/views/ | grep -v '{{--' | grep -v '{{-- '
# Expected: ZERO hits (allow commented-out lines).

# Gate 10: Originality (DMCA) — same as V4 Gate 2 in Redesign(9).md
# Run Redesign(9).md §1 Gate 2 grep on shipped DOM — expect zero hits.
```

### 9.2 Visual gates (manual — Tech Lead sign-off)

1. Homepage renders without visual regression vs. V4 (same layout, same spacing, same colors) — only borders removed and component styling refined.
2. No card or section has a visible 1px border (exception: form inputs only).
3. Material Symbols render correctly (check Network tab — single font file, ~80KB).
4. M3 ripple effect works on `<md-filled-button>` and `<md-icon-button>`.
5. The Design Partner band renders correctly on the homepage.
6. Mobile nav opens correctly via `<md-icon-button>`.
7. Lighthouse Performance score ≥ 90 on desktop, ≥ 75 on mobile (Bootstrap+M3 should be lighter than Tailwind's compiled CSS for this site).

### 9.3 Functional gates

1. All routes from V4 still resolve (Phase 10 changes no routes).
2. All Blade `@if` gates still work (Phase 10 changes no gating logic).
3. `bun run dev` and `bun run prod` both succeed without errors.
4. `php artisan tinker` still works — Phase 10 changes no PHP.

---

## 10. Tasks — agent execution order

```text
You are Kilo, executing Phase 10 (docs/Redesign(10).md — Visual System Migration)
of the Chada Digital V5 redesign at DGCodeIdeas/chada.digital. Read
Implementation_redesign.md §1 and §2 first — all constraints apply with one
exception noted below.

Branch: git checkout -b feat/v5-visual-pivot

TASK 1 — Asset pipeline swap
- Edit package.json: remove tailwindcss, autoprefixer, postcss,
  @fontsource/outfit. Add bootstrap@^5.3, bootstrap-icons@^1.11,
  @material/web@^2.0, @fontsource/inter@^5.0.
- Edit webpack.mix.js: remove .postCss(...). Add .sass(...) for
  resources/sass/app.scss and .js(...) for resources/js/material-web.js.
- Run bun install.
- Run bun run dev — expect failure (sass files don't exist yet).
  That's correct; the next tasks create them.

TASK 2 — Token + SCSS foundation
- Create resources/sass/_tokens.scss per §2 of this doc.
- Create resources/sass/_bootstrap-overrides.scss per §2.1.
- Create resources/sass/_utilities.scss per §4.2.
- Create resources/sass/_components.scss per §4.3.
- Rewrite resources/sass/app.scss per §1.1 — the layered import order.
- Run bun run dev — expect success, expect a large app.css file.
  Verify with `wc -l public/css/app.css` — should be 5,000-15,000 lines
  (Bootstrap is verbose; that's correct).

TASK 3 — JavaScript M3 loader
- Create resources/js/material-web.js per §1.2.
- Update resources/views/layouts/app.blade.php: add Material Symbols
  <link> to <head>; add <script src="{{ mix('js/material-web.js') }}"
  defer></script> at the bottom of <body>.
- Add @fontsource/inter weights per §3.1.

TASK 4 — Update all Blade partials and components per §8
- Work through rows 1-24 of the §8 migration map in order.
- Each row = one commit, each commit independently reviewable.
- After every commit, run: bun run dev && php artisan serve
- Visually load http://127.0.0.1:8000/ — confirm no regression vs. V4.
- Run the grep gates from §9.1 after every 3-4 partials to catch drift early.

TASK 5 — Design Partner band
- Create resources/views/partials/design-partner-band.blade.php per §6.2.
- Update resources/views/pages/home.blade.php: replace
  @include('partials.trust-strip') with @include('partials.design-partner-band').
- Delete resources/views/partials/trust-strip.blade.php.
- Verify the band renders on the homepage.

TASK 6 — Update CaseStudyService and config strings
- Update app/Services/CaseStudyService.php: replace 'Tailwind CSS' in
  every 'tools' array with 'Bootstrap 5', 'Material Web' (or both).
- Update config/placeholders.php if any chrome label references Tailwind.

TASK 7 — Update root docs (per this PR's actual file edits)
- README.md: tech stack table, file tree, dev commands per §7.2.
- REDESIGN_IMPLEMENTATION.md: stack header, TOUCHED-NEVER list per §7.2.
- Implementation_redesign.md: §1 constraints, §5 phase map (add Phase 10),
  §7 Phase 10 kickoff, file map per §7.2.
- Open_Decision.md: Q0 update + new Q10/Q11 per §7.2.
- TODO-Placeholders.md: add new gate rows per §7.2.

TASK 8 — Cleanup
- Delete tailwind.config.js.
- Delete postcss.config.js (if present).
- Delete resources/views/welcome.blade.php (if unused) OR convert to Bootstrap.
- Run bun run prod — must succeed.
- Run all 10 grep gates from §9.1 — all must pass.

VERIFY: run all gates in §9.1 (10 grep gates) and §9.2 (7 visual gates).
Both the Tech Lead and Founder must sign off — this is a system-wide
visual pivot, not a routine merge.

Commit as: feat(v5): visual system migration — Tailwind to Bootstrap 5.3 +
Material Web Components + Material Symbols + Inter. No-borders fusion.
Design Partner band replaces trust strip.

Open a PR. Do not merge yourself.

IMPORTANT: This phase changes the visual appearance of every page.
Coordinating merge with any open R-phases (R4 PR #11, R5 future retry)
requires care — if R4/R5 are still open, they should rebase onto this
branch BEFORE Phase 10 merges, OR Phase 10 should rebase onto them after
they merge. Decide with the Tech Lead before opening the PR.
```

---

## 11. Phase 10 dependencies and coordination

### 11.1 What Phase 10 depends on

- **Phase 2 (data layer) merged** — Phase 10 doesn't add new content, but it does edit `CaseStudyService.php` and `config/placeholders.php`, which depend on the R2 shape.
- **Phase 3 (homepage A) merged** — Phase 10 edits every R3-introduced partial. R3 must be on main first.
- **Phases 4–9 not strictly required** — Phase 10 can land before R4/R5/R6/R7/R8/R9. But if any of those are still open PRs at the time Phase 10 lands, they will need rebase.

### 11.2 What depends on Phase 10

- **Nothing retroactively.** Every future phase (if any) should branch off Phase 10's merge commit, not main's pre-Phase-10 state, to inherit the new CSS engine.

### 11.3 Coordination with currently-open PRs

As of this doc's authoring (2026-08-30):
- **PR #11 (feat/v4-r4 — System Blueprints)** is OPEN, head `bb2d266`.
- **R5 was reverted** (PR #13) — will need to be redone after R4 merges.

**Recommended order:**
1. Merge PR #11 (R4) first — closes the System Blueprints gap.
2. Re-attempt R5 (re-branch from main post-R4 merge).
3. THEN start Phase 10 — branches off the post-R4/R5 main, so it inherits both.

**Alternative (faster):** Phase 10 can run in parallel with R4 merge — but the agent must accept that R4's `workflow-system.blade.php` partial will need re-editing after Phase 10 lands (the Tailwind classes R4 uses will need migration). This is fine — Phase 10's §8 row 13 covers it.

---

## 12. Sign-off

| # | Decision | Answer | Decided by | Date |
|---|---|---|---|---|
| 10.0 | Replace Tailwind entirely with Bootstrap 5.3 + Material Web Components + custom SCSS | Resolved | Tech Lead | Aug 30, 2026 |
| 10.1 | Loading order: Bootstrap → M3 → custom (binding) | Resolved | Tech Lead | Aug 30, 2026 |
| 10.2 | M3 implementation: Material Web Components (@material/web) | Resolved | Tech Lead | Aug 30, 2026 |
| 10.3 | Design tokens: Chada primary palette + M3 surface/elevation/shape/motion | Resolved | Tech Lead | Aug 30, 2026 |
| 10.4 | Typography: Inter (body + display, varied weights) + Material Symbols | Resolved | Tech Lead | Aug 30, 2026 |
| 10.5 | Class migration: Bootstrap components + custom utility classes (hybrid) | Resolved | Tech Lead | Aug 30, 2026 |
| 10.6 | No-borders fusion principle — borders removed site-wide | Resolved | Founder | Aug 30, 2026 |
| 10.7 | Design Partner band replaces trust strip | Resolved | Founder | Aug 30, 2026 |
| 10.8 | Design Partner band copy ("No customer logos yet, we won't fake them. Become a design partner.") | Resolved | Founder + Tech Lead | Aug 30, 2026 |
| 10.9 | Phase 10 executes after R4 merge; R5 retries after R4 | Resolved | Tech Lead | Aug 30, 2026 |
| 10.10 | Multi-page architecture replaces single-page-with-anchors (see §13) | Resolved | Founder | Aug 30, 2026 |
| 10.11 | Build restarts from pre-Phase-2 state — R2/R3 code reverted, V4 docs retained | Resolved | Tech Lead | Aug 30, 2026 |

---

## 13. Multi-page architecture (replaces single-page anchor model)

**Founder directive (Aug 30, 2026):** The V4 single-homepage-with-section-anchors model is replaced by a **multi-page architecture**. Each major section becomes its own route. The homepage becomes a focused front door that funnels to dedicated pages, rather than a 17-section scroll.

**Why:** A single long page with `#section-id` anchors is another "AI-template" tell. Real editorial and product sites use a proper route hierarchy — visitors navigate to /services, /work, /about, /contact as distinct destinations. This also improves Lighthouse (smaller per-page payloads), SEO (each page has its own meta/title/schema), and analytics (per-page conversion tracking).

### 13.1 Proposed route map

| Route | What lives here | Source partials (V4) |
|---|---|---|
| `/` | **Home (focused front door):** Hero, Stats band (top), Design Partner band, Goal-picker (6 offers with price blocks), Audit-CTA (free review), Working-together overview, bottom Stats band, final CTA to /contact | `hero`, `stats-bar` (top), `design-partner-band`, `goal-picker`, `audit-cta`, `working-together`, `stats-bar` (bottom), `exclusivity-cta` (repositioned as final CTA) |
| `/services` | **Services & pricing:** Services checklist (12-item), Pricing tiers (4 advisory + 6 full-build + 5 ongoing-care), Stats band (services), Add-ons, CTAs | `services-checklist`, `stats-badge` (services), `service-card` ×15, pricing tiers |
| `/work` | **Case studies grid:** Filterable grid of all 6 case study cards, link to detail pages | `x-result-card`, `case-studies` grid, filter UI |
| `/case-studies/{slug}` | **Case study detail:** Challenge/Solution/Results narrative, per-study System Blueprint pipeline, metrics, CTA | `pages/case-study.blade.php`, `x-workflow-diagram` (per-study) |
| `/blueprints` | **System Blueprints overview** (optional — if not all blueprints live on case-study detail pages): All verified pipelines in one view | `workflow-system`, `x-workflow-diagram` |
| `/demos` | **Demo Lab:** 6-tab interactive demo panels (real `public/demos/`), MarTech integrations grid | `demo-lab`, `martech` |
| `/about` | **About + Founder:** Founder bio (gated), testimonials (gated), standards band, working-together (full version) | `founder-bio`, `testimonials`, `manifesto`, `working-together` (full) |
| `/contact` | **Contact:** Contact form (honeypot + AJAX), exclusivity CTA, chat widget wiring | `contact-form`, `exclusivity-cta`, `chat-widget` |
| `/webinar` | **Webinar opt-in** (only if webinar.enabled is true — else unrouted): Lead-magnet capture form | `webinar-optin` |

### 13.2 What stays on the homepage (focused front door)

The homepage becomes a **8-section focused funnel**, not a 17-section scroll:

1. Hero (dual CTA → /services, /work)
2. Stats band (top — 4 numbers)
3. Design Partner band
4. Goal-picker (6 tiered offer cards with price blocks → /services or /contact)
5. Audit-CTA (free review → /contact)
6. Working-together (3-card overview → /about or /services)
7. Stats band (bottom — 4 different numbers, optional)
8. Final CTA (exclusivity-tone → /contact)

**Removed from homepage** (moved to dedicated pages):
- Services checklist → `/services`
- System Blueprints → `/case-studies/{slug}` (per-study) or `/blueprints`
- Demo Lab → `/demos`
- MarTech grid → `/demos`
- Founder bio → `/about`
- Testimonials → `/about`
- Webinar opt-in → `/webinar` (only if enabled)
- Contact form → `/contact`
- Chat widget → global (in layout, not a homepage section)

### 13.3 What this changes in the build

**Routes (`routes/web.php`):**
```php
// Existing — keep
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/work', [PageController::class, 'work'])->name('work');
Route::get('/case-studies/{slug}', [PageController::class, 'caseStudy'])->name('case-study.show');
Route::get('/preview/{slug}', [PreviewController::class, 'show'])->name('preview.show');
Route::post('/api/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');

// Existing — keep (Phase 6 / R6)
Route::get('/services', [PageController::class, 'services'])->name('services');

// NEW — multi-page pivot (Phase 10 or new Phase 11)
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/demos', [PageController::class, 'demos'])->name('demos');
Route::get('/blueprints', [PageController::class, 'blueprints'])->name('blueprints');
Route::get('/webinar', [PageController::class, 'webinar'])->name('webinar');
```

**Controllers (`app/Http/Controllers/PageController.php`):**
- Add `about()`, `contact()`, `demos()`, `blueprints()`, `webinar()` methods
- Each method returns its own Blade view with the relevant partials included
- `home()` method simplified — only includes the 8 homepage sections

**Blade views (`resources/views/pages/`):**
- `home.blade.php` — simplified (8 sections only)
- `services.blade.php` — exists from R6
- `work.blade.php` — exists from R5
- `case-study.blade.php` — exists from R5
- `about.blade.php` — NEW
- `contact.blade.php` — NEW
- `demos.blade.php` — NEW
- `blueprints.blade.php` — NEW
- `webinar.blade.php` — NEW (conditional)

**Nav (`partials/header.blade.php`):**
- Nav links: Home, Services, Work, About, Demos, Contact
- Mobile nav: same links via `<md-icon-button>` toggle
- No more `/#section-id` anchors in nav

### 13.4 Implications for the existing phase docs (R3–R9)

The V4 phase docs (Redesign 3–9) were written assuming a single homepage. Under the multi-page pivot:

- **R3 (Homepage A):** Stays mostly intact — its 8 sections (hero, stats-bar, goal-picker, audit-cta, working-together, founder-bio, testimonials, webinar-optin) split across `/`, `/about`, and `/webinar`. The Blade partials themselves are reusable as page includes.
- **R4 (System Blueprints):** Moves from homepage section to `/case-studies/{slug}` (per-study) or `/blueprints` (overview).
- **R5 (Case studies):** Already multi-page (`/work`, `/case-studies/{slug}`) — minimal change.
- **R6 (/services):** Already multi-page — no change.
- **R7 (Demo Lab + MarTech):** Moves from homepage section to `/demos`.
- **R8 (Global chrome):** Nav links change from `/#section-id` to dedicated routes.
- **R9 (QA):** Launch gates add per-route checks (each page must load, each route must resolve, sitemap must include all routes).

**No phase doc is invalidated** — the partials they build are still needed. What changes is *where* each partial is included (which page). The agent executing the build reads the multi-page route map above and wires partials to pages accordingly.

### 13.5 Build restart plan (Aug 30, 2026)

The Tech Lead has decided to **revert main back to just before Phase 2 (R2) merged**, keeping the V4 doc series but discarding the R2/R3 code. This gives a clean slate to re-execute the build with:

1. The V5 visual system (Bootstrap + M3 + custom — see §1–§12)
2. The multi-page architecture (see §13.1–§13.4)
3. The no-borders fusion principle (see §5)
4. The Design Partner band (see §6)

**Revert target:** commit `2f8669d` (PR #10 merge, Aug 29 07:24 UTC) — last commit before R2/R3 code landed. This retains:
- The V4 doc series (`docs/Redesign(1-9).md`)
- The cross-reference pass (PR #10)
- All root docs (`Implementation_redesign.md`, `Open_Decision.md`, etc.)

It discards:
- R2 data layer code (`app/Support/Lorem.php`, `CaseStudyService` v2, `config/placeholders.php` v4)
- R3 homepage partials (`stats-bar`, `audit-cta`, `working-together`, `webinar-optin`, modified `hero`, `goal-picker`, `founder-bio`, `testimonials`, `services-checklist`)

**PR #15 (V5 docs) implication:** PR #15 is on branch `feat/v5-visual-pivot`, based on `6db7f42` (current main). After the revert, PR #15 will need to be rebased onto the reverted main. Since PR #15 is docs-only (no code dependencies on R2/R3), the rebase should be clean — the only conflict will be on `README.md` (both the revert and PR #15 touch it, but in different ways).

**Recommended execution order after revert:**
1. Revert main to `2f8669d`
2. Rebase PR #15 (`feat/v5-visual-pivot`) onto the reverted main
3. Merge PR #15 (V5 docs land on reverted main)
4. Re-execute Phase 2 (R2 data layer) — code is already written in PR #8/#9 history, can be cherry-picked or re-built
5. Re-execute Phase 3 (R3) — but now with multi-page wiring per §13.4
6. Continue through R4–R9 with multi-page architecture
