# Redesign.md — Chada Digital Website Redesign

> **Author:** DGCodeIdeas
> **Project:** chada.digital redesign  
> **Reference:** https://wabdigital.com/ (minimalist + case-study-driven aesthetic)  
> **Stack:** Custom Laravel 12 + Blade + Tailwind CSS v3 + Laravel Mix + jQuery  
> **Repo:** `DGCodeIdeas/chada.digital`  
> **Branch:** Create `feat/redesign-wabdigital` from `main`  
> **Date:** August 2026  
> **Status:** Task Brief — Ready for Development

---

## 1. Executive Summary

Redesign the Chada Digital website from a dark-themed, service-card portfolio into a **light, minimalist, case-study-driven agency site** inspired by WAB Digital. The new design prioritizes:

- **Process transparency** — visual backend workflow diagrams
- **Results credibility** — hard metrics per client ($343K generated, 1,200% increase, etc.)
- **Narrative depth** — each project tells a conversion story, not just shows a screenshot
- **Minimalist aesthetics** — generous whitespace, restrained color palette, sharp typography
- **Trust signals** — client logos, specific outcomes, tool-stack transparency

The existing Laravel 12 architecture, routing, and demo iframe system remain intact. This is a **front-end and content restructuring**, not a framework migration.

---

## 2. Current State Analysis

### 2.1 Visual Identity (Current)
| Element | Current Value |
|---------|---------------|
| Background | `#0e1b2e` (dark navy) |
| Card BG | `#0b1526` |
| Primary | `#3b82f6` (blue-500) |
| Muted | `#1e293b` / `#94a3b8` |
| Border | `rgba(148, 163, 184, 0.1)` |
| Fonts | Outfit (display), Inter (body), Playfair Display (accent) |
| Mood | Dark-mode SaaS / tech studio |

### 2.2 Page Structure (Current)
```
Home (/)          → Hero → About (audience segments) → Services (4 cards)
                    → Portfolio (3 featured) → Products (4 tools) → Contact
Showcase (/showcase) → Filterable grid of 6 projects
Preview (/preview/{slug}) → Iframe viewer for demo projects
Sitemap (/sitemap.xml) → Dynamic XML
```

### 2.3 Tech Stack (Unchanged)
- Laravel 12, PHP 8.2
- Blade templating (layouts, partials, components)
- Tailwind CSS v3 + custom SCSS via PostCSS
- jQuery ES6 modules + Alpine.js (available, currently unused)
- Laravel Mix (webpack) — run via **Bun**
- SQLite (dev) / MySQL 8.0 RDS (prod)
- nginx + PHP 8.2-FPM on AWS EC2 t3.small

### 2.4 Assets to Preserve
- `public/demos/` — **READ-ONLY**, all 6 demo projects untouched
- `public/assets/images/project-*.jpg` — existing thumbnails
- Contact form endpoint (`POST /api/contact`) — logic stays, styling changes
- SEO meta system — structure stays, content updates
- Sitemap generation — stays

---

## 3. Target State (WAB Digital-Inspired)

### 3.1 Visual Identity (New)
| Element | New Value | Rationale |
|---------|-----------|-----------|
| Background | `#ffffff` or `#fafafa` | Clean, minimalist, agency-standard |
| Surface/Card | `#ffffff` with subtle shadow or `#f5f5f5` | Depth without darkness |
| Primary | `#111111` or `#0a0a0a` | Near-black for authority; accent with brand color |
| Accent | `#2563eb` (blue-600) or `#3b82f6` | Keep blue lineage but use sparingly |
| Text Primary | `#171717` (neutral-900) | High contrast, editorial feel |
| Text Secondary | `#525252` (neutral-600) | Muted without being ghostly |
| Border | `#e5e5e5` (neutral-200) | Visible but subtle |
| Fonts | **Inter** (primary), **Outfit** (headings — reduce usage) | WAB uses clean sans-serif throughout |
| Mood | Light, editorial, confident, data-driven |

### 3.2 New Page Structure
```
Home (/)
  ├── Navigation (sticky, minimal)
  ├── Hero (value prop + social proof strip)
  ├── Trust Bar (client logos / "Trusted by" — NEW)
  ├── Process / Methodology (how we work — NEW)
  ├── Services (restructured: 4 services → process-oriented)
  ├── Case Studies (replaces Portfolio — MAJOR CHANGE)
  │   └── Each case study shows: client, metric, workflow diagram, tools
  ├── Products & Solutions (repositioned — minor change)
  ├── CTA Banner ("Start a Project" — NEW)
  └── Footer (simplified)

Case Study Detail (/case-study/{slug}) — NEW PAGE
  ├── Client intro + metric highlight
  ├── Challenge → Solution → Results narrative
  ├── Backend Workflow Diagram (visual pipeline)
  ├── Tech stack / tools used
  └── Related case studies

Showcase (/showcase) — RENAMED to /work
  → Grid of case studies with filter by industry/service

About (/about) — NEW PAGE (optional Phase 2)
  → Team, philosophy, process

All existing routes preserved with 301 redirects where paths change.
```

---

## 4. Scope & Boundaries

### IN SCOPE
- [ ] New Tailwind config (colors, fonts, spacing scale)
- [ ] Redesign all Blade partials and pages
- [ ] New case study data layer (JSON/DB/Service class)
- [ ] Backend workflow diagram component (CSS/SVG-based)
- [ ] New route: `/case-study/{slug}`
- [ ] Rename `/showcase` → `/work` with 301 redirect
- [ ] New hero section with social proof
- [ ] Trust bar component (client logos)
- [ ] Process/methodology section
- [ ] Results-driven case study cards
- [ ] Updated contact section
- [ ] Mobile responsiveness for all new sections
- [ ] SEO meta updates for all new pages
- [ ] OG image updates

### OUT OF SCOPE
- [ ] Do NOT touch `public/demos/` — iframe demos remain as-is
- [ ] Do NOT change contact form backend logic (only styling)
- [ ] Do NOT migrate from Laravel Mix to Vite
- [ ] Do NOT change hosting infrastructure
- [ ] Do NOT add CMS/backend admin panel
- [ ] Do NOT change database from SQLite/MySQL
- [ ] Do NOT add user authentication

---

## 5. Design System Changes

### 5.1 tailwind.config.js
```javascript
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        background: '#fafafa',      // was #0e1b2e
        foreground: '#171717',      // was #f8fafc
        card: {
          DEFAULT: '#ffffff',
          foreground: '#171717',
        },
        primary: {
          DEFAULT: '#2563eb',       // was #3b82f6
          foreground: '#ffffff',
        },
        muted: {
          DEFAULT: '#f5f5f5',       // was #1e293b
          foreground: '#525252',    // was #94a3b8
        },
        border: '#e5e5e5',          // was rgba(148,163,184,0.1)
        accent: '#0a0a0a',
      },
      fontFamily: {
        display: ['Outfit', 'sans-serif'],  // reduce usage
        sans: ['Inter', 'sans-serif'],      // primary
        accent: ['Playfair Display', 'serif'], // optional, reduce
      },
      borderRadius: {
        '2xl': '1rem',
      },
    },
  },
  plugins: [],
};
```

### 5.2 Global Styles (app.scss or inline)
- Remove all dark-mode assumptions
- Add `.workflow-arrow` component for pipeline diagrams
- Add `.case-study-card` hover states
- Add `.trust-logo` grayscale → color on hover

### 5.3 Spacing Philosophy
- WAB Digital uses **generous vertical padding** (py-24 to py-32)
- Reduce section count but increase depth per section
- Max-width stays `max-w-7xl` (1280px)

---

## 6. Section-by-Section Redesign Plan

### 6.1 Navigation (`partials/header.blade.php`)
**Current:** Dark sticky header, logo left, links center, CTA right, mobile hamburger  
**New:** Light sticky header, transparent → white on scroll, simplified links

```
Links: Work | Services | Process | Products | Contact
CTA: "Start a Project" (outlined, not filled — more minimalist)
Mobile: Same hamburger pattern, light theme
```

**Changes:**
- Remove backdrop-blur intensity
- Border-bottom: `border-neutral-200`
- Logo: keep `chada-logo-horizontal.png` (may need light variant)
- Height: reduce from `h-20` to `h-16` for sleekness

---

### 6.2 Hero (`partials/hero.blade.php`) — MAJOR CHANGE
**Current:** Dark gradient blobs, "Digital Solutions That Scale Businesses", two CTAs  
**New:** Clean, left-aligned, metric-driven

```
[Label] Digital Marketing & Automation Agency — Lagos, Nigeria
[Headline] We Build Funnels That Convert Visitors Into Revenue.
[Subhead] High-performance websites, automated sales systems, and 
          data-driven campaigns for ambitious brands across Africa.
[CTA] Start a Project →
[Social Proof Strip] "Trusted by 50+ brands" + 5 client logos (grayscale)
```

**Design Notes:**
- No gradient blobs — use subtle geometric accent or nothing
- Large typography: `text-5xl md:text-7xl font-bold tracking-tight`
- Single primary CTA (remove secondary "View Our Work" — redundant with nav)
- Social proof strip immediately below fold

---

### 6.3 Trust Bar — NEW SECTION
**File:** `partials/trust-bar.blade.php`  
**Purpose:** Immediate credibility

```
Trusted by teams at:
[Client Logo 1] [Client Logo 2] [Client Logo 3] [Client Logo 4] [Client Logo 5]
```

**Implementation:**
- Grayscale logos, opacity-50, hover:opacity-100 transition
- Horizontal scroll on mobile
- Logos stored in `public/assets/images/clients/`

**Data:** Hardcoded array in Blade or new `ClientLogoService`

---

### 6.4 Process / Methodology — NEW SECTION
**File:** `partials/process.blade.php`  
**Purpose:** Explain HOW Chada works (WAB's key differentiator)

```
[Label] Our Process
[Headline] From First Click to Final Conversion

Step 1: Discover        Step 2: Design         Step 3: Build         Step 4: Scale
Audit & Strategy        Funnel Architecture      Development          Ads & Automation
```

**Design:**
- 4-column grid on desktop, vertical timeline on mobile
- Each step: number (01, 02, 03, 04), title, description, icon
- Connected by subtle line or arrow
- Background: `bg-muted` or white with top/bottom borders

---

### 6.5 Services (`partials/services.blade.php`) — RESTRUCTURED
**Current:** 4 cards (Web Dev, Brand Identity, Automation, Digital Strategy)  
**New:** Same 4 services, but reframed as **outcome-driven** with mini workflow hints

```
[Label] What We Do
[Headline] Services Engineered for Growth

Card 1: Web Development
       "High-converting websites and web apps built for speed, SEO, 
        and conversion."
       → Laravel, React, WordPress, Shopify

Card 2: Funnel & Automation
       "Smart workflows and AI integrations that save time and 
        close deals while you sleep."
       → ManyChat, HubSpot, Zapier, Make

Card 3: Paid Advertising
       "Meta, Google, and LinkedIn campaigns that deliver measurable 
        ROI, not just impressions."
       → Meta Ads, Google Ads, LinkedIn Ads

Card 4: Brand & Strategy
       "Strategic branding and data-driven roadmaps that align your 
        digital presence with revenue goals."
       → Figma, Brand Strategy, CRO
```

**Changes:**
- Light cards with subtle border (not dark cards)
- Add "Tech stack" micro-list at bottom of each card
- Reduce icon size, increase whitespace

---

### 6.6 Case Studies (`partials/case-studies.blade.php`) — REPLACES PORTFOLIO
**Current:** 3 project cards linking to iframe previews  
**New:** Results-first case study cards with metrics

```
[Label] Case Studies
[Headline] Real Results for Real Businesses

┌─────────────────────────────────────────────────────────────┐
│ [Thumbnail]                                                  │
│                                                              │
│ 🏢 Client: Healthtracka                                      │
│ 💰 Result: $343,000 Generated                                │
│ 🏷️ Tags: WooCommerce, Paystack, Custom Forms                │
│                                                              │
│ "Rebuilt the patient diagnostic funnel with a high-converting │
│  Premium Sales Page & custom WooCommerce checkout..."        │
│                                                              │
│ [View Case Study →]                                          │
└─────────────────────────────────────────────────────────────┘
```

**Data Structure (new `CaseStudyService`):**
```php
[
    'healthtracka' => [
        'client' => 'Healthtracka',
        'industry' => 'Healthcare / Diagnostics',
        'metric' => '$343,000 Generated',
        'metric_label' => 'Revenue Generated',
        'tags' => ['WooCommerce', 'Paystack', 'Custom Forms'],
        'excerpt' => 'Rebuilt the patient diagnostic funnel...',
        'thumbnail' => '/assets/images/case-study-healthtracka.jpg',
        'workflow' => [
            ['step' => 'Paid Ads & SEO', 'tool' => 'Meta/Google Ads'],
            ['step' => 'Premium Health Sales Page', 'tool' => 'Custom Landing Page'],
            ['step' => 'Custom WooCommerce Form', 'tool' => 'Date/Time/HMO Fields'],
            ['step' => 'Paystack Payment Webhook', 'tool' => 'Paystack'],
            ['step' => 'Phlebotomist Dispatch API', 'tool' => 'Custom API'],
        ],
        'challenge' => '...',
        'solution' => '...',
        'results' => '...',
        'tools' => ['WordPress', 'WooCommerce', 'Paystack', 'Meta Ads'],
    ],
    // ... 6-8 case studies total
]
```

**Design:**
- 2-column grid on desktop (larger cards), single column on mobile
- Each card: thumbnail, client name (bold), metric (highlighted), tags, excerpt
- Hover: subtle lift (`hover:-translate-y-1`) + shadow
- "View Case Study" links to `/case-study/{slug}`

---

### 6.7 Case Study Detail Page (`pages/case-study.blade.php`) — NEW
**Route:** `GET /case-study/{slug}` → `CaseStudyController@show`  
**Purpose:** Deep-dive narrative per project

```
[Label] Case Study
[Headline] Healthtracka — $343,000 Generated
[Subhead] Healthcare diagnostics funnel rebuild

[Hero Image / Screenshot]

┌─────────────────────────────────────────────────────────────┐
│ METRICS BAR                                                 │
│ 💰 $343K Revenue  │  🎯 1,200% ROAS  │  ⏱️ 90 Days        │
└─────────────────────────────────────────────────────────────┘

The Challenge
[2-3 paragraphs]

The Solution
[2-3 paragraphs + screenshot]

Backend Workflow
[Visual pipeline diagram — see Section 7]

Tools & Integrations
[Icon grid: WordPress, WooCommerce, Paystack, Meta Ads, etc.]

Results
[Bullet points with specific numbers]

[CTA: Start a Similar Project →]
```

---

### 6.8 Backend Workflow Diagram — NEW COMPONENT
**File:** `components/workflow-diagram.blade.php`  
**Purpose:** Visualize the automation pipeline (WAB's signature feature)

```
Paid Ads & SEO          Custom Sales Page       Paystack Webhook        CRM Sync
     ↓                       ↓                       ↓                    ↓
┌─────────┐            ┌─────────┐            ┌─────────┐           ┌─────────┐
│ Meta    │ ────────→  │ Landing │ ────────→  │ Payment │ ──────→ │ HubSpot │
│ Google  │            │ Page    │            │ Confirm │           │ WhatsApp│
└─────────┘            └─────────┘            └─────────┘           └─────────┘
     │                       │                       │                    │
   Traffic               Conversion              Revenue              Follow-up
```

**Implementation:**
- Pure CSS/Tailwind — no external libraries
- Horizontal scroll on mobile
- Each node: rounded box, tool name, arrow connector
- Optional: animated arrow flow (CSS keyframes)
- Data passed as array from CaseStudyService

---

### 6.9 Products & Solutions (`partials/products.blade.php`) — MINOR CHANGE
**Current:** 4 dark cards (QuoteGen, BookingFlow, ChatDesk, InsightDash)  
**New:** Same products, light theme, add "starting at" pricing if available

**Changes:**
- Light cards with border
- Add small "Product" badge
- Reduce visual weight — these are secondary to case studies

---

### 6.10 Contact (`partials/contact.blade.php`) — RESTYLED
**Current:** Dark two-column grid with form + contact info  
**New:** Light, centered or left-aligned, simplified

```
[Label] Contact
[Headline] Let's Build Something That Scales.
[Subhead] Tell us about your project. We respond within 24 hours.

[Form: Name | Email | Message | Submit]

Or email directly: info@chadadigital.com
Phone: +234 912 297 4778
Location: Lagos, Nigeria
```

**Changes:**
- Remove heavy card backgrounds
- Form fields: light gray background (`bg-neutral-50`), rounded-xl
- Success state: keep current logic, update styling
- Honeypot: keep (`bot-field`)

---

### 6.11 Footer (`partials/footer.blade.php`) — SIMPLIFIED
**Current:** 4-column grid with logo, explore, services, connect  
**New:** Minimal 2-row footer

```
[Row 1] Logo + Tagline          [Links: Work | Services | Process | Contact]
[Row 2] © 2026 Chada Digital. All rights reserved.    [LinkedIn] [Twitter/X] [Instagram]
```

**Changes:**
- Reduce from 4 columns to 2
- Remove "Products" from footer links (keep in nav)
- Add social icons
- Smaller font size, more whitespace above

---

### 6.12 Showcase Page (`pages/showcase.blade.php`) — RENAMED TO /work
**Current:** `/showcase` with filterable grid of 6 iframe previews  
**New:** `/work` with filterable grid of case studies

**Changes:**
- Route redirect: `/showcase` → `/work` (301)
- Filter categories: All | Web Development | Funnels | Ads | Branding
- Cards use case study data (not just preview thumbnails)
- Each card links to `/case-study/{slug}`
- Keep iframe preview as "Live Demo" link within case study detail

---

## 7. New Components to Build

| Component | File | Description |
|-----------|------|-------------|
| `x-workflow-diagram` | `components/workflow-diagram.blade.php` | CSS pipeline visualization |
| `x-case-study-card` | `components/case-study-card.blade.php` | Results-first project card |
| `x-metric-badge` | `components/metric-badge.blade.php` | Large number + label |
| `x-trust-bar` | `partials/trust-bar.blade.php` | Client logo strip |
| `x-process-step` | `components/process-step.blade.php` | Numbered process item |
| `x-tech-stack` | `components/tech-stack.blade.php` | Tool icon grid |
| `x-section-header` | `components/section-header.blade.php` | Reusable label + headline + subhead |

---

## 8. Data Layer Changes

### 8.1 New Service: `CaseStudyService`
**File:** `app/Services/CaseStudyService.php`  
**Pattern:** Same as `PreviewService` — hardcoded array, no DB needed for now

**Methods:**
- `all(): array` — all case studies
- `get(string $slug): ?array` — single case study
- `exists(string $slug): bool`
- `byCategory(string $category): array` — filter for /work page
- `collection(): Collection`

### 8.2 New Controller: `CaseStudyController`
**File:** `app/Http/Controllers/CaseStudyController.php`

```php
class CaseStudyController extends Controller
{
    public function __construct(protected CaseStudyService $service) {}

    public function index(): View  // /work
    public function show(string $slug): View  // /case-study/{slug}
}
```

### 8.3 Route Updates (`routes/web.php`)
```php
// New
Route::get('/work', [CaseStudyController::class, 'index'])->name('work');
Route::get('/case-study/{slug}', [CaseStudyController::class, 'show'])->name('case-study.show');

// Redirects
Route::redirect('/showcase', '/work', 301);
Route::redirect('/showcase.html', '/work', 301);

// Keep existing
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/preview/{slug}', [PreviewController::class, 'show'])->name('preview.show');
Route::get('/preview/{slug}/{subpage}', [PreviewController::class, 'subpage'])->name('preview.subpage');
Route::post('/api/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');
```

### 8.4 Sitemap Updates
Add `/work` and all `/case-study/{slug}` URLs to sitemap generation in `PageController::sitemap()`.

---

## 9. File Change Map

| File | Action | Notes |
|------|--------|-------|
| `tailwind.config.js` | **Modify** | New color palette, font weights |
| `resources/views/layouts/app.blade.php` | **Modify** | Remove dark assumptions, update meta |
| `resources/views/pages/home.blade.php` | **Modify** | Reorder sections, add new partials |
| `resources/views/pages/showcase.blade.php` | **Modify** | Rename logic, use case study data |
| `resources/views/pages/case-study.blade.php` | **Create** | New detail page |
| `resources/views/pages/work.blade.php` | **Create** | Renamed showcase page |
| `resources/views/partials/hero.blade.php` | **Modify** | Complete rewrite |
| `resources/views/partials/about.blade.php` | **Modify** | Convert to process/methodology |
| `resources/views/partials/services.blade.php` | **Modify** | Light theme, add tool stacks |
| `resources/views/partials/portfolio.blade.php` | **Modify** | Convert to case-study cards |
| `resources/views/partials/products.blade.php` | **Modify** | Light theme |
| `resources/views/partials/contact.blade.php` | **Modify** | Light theme, simplified |
| `resources/views/partials/contact-form.blade.php` | **Modify** | Light form styling |
| `resources/views/partials/header.blade.php` | **Modify** | Light nav, reduced height |
| `resources/views/partials/footer.blade.php` | **Modify** | Simplified 2-row layout |
| `resources/views/partials/trust-bar.blade.php` | **Create** | Client logo strip |
| `resources/views/partials/process.blade.php` | **Create** | 4-step methodology |
| `resources/views/components/*.blade.php` | **Create/Modify** | New reusable components |
| `app/Services/CaseStudyService.php` | **Create** | Case study data layer |
| `app/Http/Controllers/CaseStudyController.php` | **Create** | New controller |
| `app/Http/Controllers/PageController.php` | **Modify** | Sitemap updates |
| `routes/web.php` | **Modify** | New routes + redirects |
| `resources/js/app.js` | **Modify** | Keep existing init, add any new JS |
| `resources/js/modules/*` | **Keep** | Mobile nav, contact form, etc. |
| `public/demos/` | **DO NOT TOUCH** | Read-only |
| `public/assets/images/` | **Add** | New case study thumbnails, client logos |

---

## 10. Asset Requirements

### 10.1 Images Needed
| Asset | Dimensions | Source |
|-------|-----------|--------|
| Case study thumbnails (6-8) | 1200×800 | Create from demo screenshots or request from client |
| Client logos (5-8) | 200×60, SVG preferred | Request from client |
| Hero background (optional) | 1920×1080 | Subtle abstract or solid color |
| OG image (new) | 1200×630 | Update with new branding |
| Process icons (4) | 48×48 | Lucide icons or custom SVG |

### 10.2 Logo Variant
The current `chada-logo-horizontal.png` may not work on light backgrounds. **Decision needed:**
- Option A: Create `chada-logo-dark.png` (dark text version)
- Option B: Use SVG logo with `currentColor` fill

---

## 11. Acceptance Criteria

### 11.1 Visual
- [ ] No dark navy (`#0e1b2e`) remains anywhere on the site
- [ ] All text passes WCAG AA contrast on light backgrounds
- [ ] Typography uses Inter as primary, Outfit for headlines only
- [ ] Workflow diagrams render correctly on mobile (horizontal scroll)
- [ ] Case study cards display metric prominently
- [ ] Trust bar logos are grayscale, color on hover

### 11.2 Functional
- [ ] `/showcase` 301 redirects to `/work`
- [ ] `/work` displays all case studies with category filtering
- [ ] `/case-study/{slug}` renders full case study with workflow diagram
- [ ] Contact form submits successfully (styling only changed)
- [ ] Mobile navigation works on all new pages
- [ ] All existing iframe previews (`/preview/{slug}`) remain functional
- [ ] Sitemap includes `/work` and all `/case-study/*` URLs

### 11.3 Performance
- [ ] Lighthouse score ≥ 90 on mobile
- [ ] No render-blocking resources added
- [ ] Images lazy-loaded
- [ ] CSS bundle size does not increase > 20%

### 11.4 SEO
- [ ] Meta titles/descriptions updated for all pages
- [ ] Canonical URLs correct
- [ ] OG images updated
- [ ] Structured data (JSON-LD) updated for case studies

---

## 12. Risk Register

| Risk | Impact | Mitigation |
|------|--------|------------|
| Logo doesn't work on light bg | High | Create dark variant before development |
| Case study content not ready | High | Use placeholder data; content can be swapped later |
| Client logos not available | Medium | Use generic industry icons or text names |
| Workflow diagrams too complex | Medium | Start with static CSS; enhance with JS later |
| Build pipeline breaks | High | Test `bun run prod` after every Tailwind change |
| Demo iframes styled incorrectly | Low | Demos are independent; only wrapper changes |

---

## 13. Implementation Phases

### Phase 1: Foundation (Day 1-2)
- [ ] Update `tailwind.config.js` with new design tokens
- [ ] Create `CaseStudyService` with placeholder data
- [ ] Create `CaseStudyController` and routes
- [ ] Update `app.blade.php` layout for light theme
- [ ] Update header and footer for light theme

### Phase 2: Home Page (Day 3-4)
- [ ] Build new hero section
- [ ] Build trust bar
- [ ] Build process/methodology section
- [ ] Restyle services section
- [ ] Build case studies section (home page grid)
- [ ] Restyle products section
- [ ] Restyle contact section

### Phase 3: Case Study Pages (Day 5-6)
- [ ] Build `/work` page (renamed showcase)
- [ ] Build `/case-study/{slug}` detail page
- [ ] Build workflow diagram component
- [ ] Build metric badge component
- [ ] Add filtering to `/work`

### Phase 4: Polish (Day 7)
- [ ] Mobile responsiveness audit
- [ ] SEO meta updates
- [ ] OG image updates
- [ ] Sitemap updates
- [ ] Lighthouse audit
- [ ] Cross-browser testing
- [ ] Content review with stakeholders

---

## 14. Notes for Developers

1. **Use `mix()` not `@vite()`** — asset pipeline is Laravel Mix
2. **Use `bun` not `npm`** — `bun run dev`, `bun run prod`
3. **Never touch `public/demos/`** — iframe demos are read-only
4. **Follow existing naming** — `partials/` for sections, `components/` for reusable, `pages/` for full pages
5. **Keep jQuery patterns** — existing modules use jQuery; new JS can use vanilla or jQuery
6. **Alpine.js is available** — use for lightweight interactivity (filters, tabs, mobile menu)
7. **Constructor promotion** — use PHP 8.2 `public function __construct(protected Service $service)`
8. **Blade components** — use `<x-component-name>` syntax for new reusable pieces

---

## 15. Open Questions (for stakeholders)

1. **Client logos:** Do we have permission to display client logos? Which ones?
2. **Case study metrics:** Are the WAB-style metrics hypothetical or do we have real numbers?
3. **Pricing:** Should products show "starting at" pricing?
4. **New logo variant:** Do we need a dark-text logo for light backgrounds?
5. **Blog:** WAB doesn't have a blog; do we want one?
6. **Testimonials:** Do we have client quotes for case studies?

---

*End of Redesign.md*
