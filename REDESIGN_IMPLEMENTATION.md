# REDESIGN_IMPLEMENTATION.md — WAB Digital Complete Replication

> **Mandate:** Founder has directed a complete structural and functional replication of https://wabdigital.com/, not merely inspiration or "WAB-style." Every section, every pattern, every conversion mechanism on WAB's live site must have a Chada equivalent.
> **Stack:** Laravel 12 + Blade + Tailwind CSS v3 + Laravel Mix + jQuery/vanilla JS
> **Repo:** `DGCodeIdeas/chada.digital`
> **Status:** Build-ready. Blocked only on real content (client names, metrics, workflow steps, pricing).
> **Supersedes:** All previous redesign specs (V1 light theme, V2 placeholder skeleton).

---

## 1. WAB Digital Live Audit (2026-08-27)

This is the source of truth. Every claim below was verified against the live site.

### 1.1 Homepage (/) — Section Sequence

| # | Section | WAB Content | Chada Equivalent |
|---|---------|-------------|------------------|
| 1 | **Hero** | H1: "Digital Marketing Agency In Lagos Nigeria \| Website, SEO, Ads" + value proposition paragraph + primary CTA | `partials/hero.blade.php` |
| 2 | **Backend Workflow System** | THE signature feature. Heading: "SYSTEM BACKEND WORKFLOW" with "🗃 Auto-Synchronized" badge. **9 horizontal pipeline diagrams**, each showing 4–5 steps with arrow connectors. Below all 9: "⚙️ Our system coordinates these steps in under 1.4 seconds." | `partials/workflow-system.blade.php` — NEW |
| 3 | **Case Study Grid** | 9 cards on homepage. Each: "🏢 Client: [Name]" + [Metric] + [1-sentence description]. No images. Pure text cards. | `partials/case-studies.blade.php` — MUST be included in home |
| 4 | **(Below fold — not captured)** | Likely: testimonials, founder bio, CTA bands, footer | TBD by further audit |

### 1.2 Services Page (/services/) — Section Sequence

| # | Section | WAB Content |
|---|---------|-------------|
| 1 | **Stats Bar** | 5 big numbers: 200+ Clients served, 16+ Case studies, 40,000+ Leads generated, ₦200M+ Client revenue, 1,200% Highest sales increase |
| 2 | **CTA Band** | "Not sure where to start? Take the free funnel audit." |
| 3 | **Strategy Sessions** | 4 cards: Marketing Strategy Session (₦140,000), SEO Audit + Strategy (₦70,000), Website Audit + Strategy (₦70,000), SEO VIP Day (₦350,000). Each: category badge, title, description, "BEST FOR" audience, price |
| 4 | **Done-For-You Builds** | 4 cards: Done-For-You Sales Funnel (₦1,050,000), Website That Converts (₦1,050,000), CRM Setup + Onboarding (₦210,000), Email System Setup (₦500,000), Paid Ads Setup (₦350,000), Landing Page Creation (₦350,000) |
| 5 | **Monthly Retainers** | 4 cards: Monthly Marketing Retainer (From $500/month), Monthly SEO Management (₦700,000/month), Monthly Google Ads (₦650,000/month), Monthly Facebook + Instagram Ads (₦650,000/month), Monthly Marketing Consulting (₦1,500,000/month). Each: tier badge, title, description, "BEST FOR", price |
| 6 | **Add-On Services** | Supporting services band + "Take the free funnel audit" CTA + "Book a strategy call" CTA |

### 1.3 Case Studies Page (/case-studies/)

| Feature | WAB Implementation |
|---------|-------------------|
| Heading | "Results that actually happened." + subtitle |
| Stats | 16+ Case Studies, ₦200M+ Client Revenue, 40,000+ Leads Generated |
| Filter | Category pills: All, Funnel Design, SEO, Marketing Automation, Paid Ads |
| Grid | 16+ cards. Each: category tag, industry tag, metric (big number), title, timeframe, "Read story →" link |
| Detail pages | Individual case study pages with full narrative |

### 1.4 Other WAB Pages

| Page | Purpose |
|------|---------|
| /calculator/ | Sales Goal Calculator — interactive tool |
| /webinar/ | Webinar registration/listing |
| /training/ | Training courses listing |
| /shop/ | Digital products shop |
| /blog/ | Blog posts |
| /contact/ | Contact form + details |
| /terms/ | Terms of Service |

### 1.5 Global Elements

| Element | WAB Implementation | Chada Equivalent |
|---------|-------------------|------------------|
| **Persistent WhatsApp Chat** | Floating button, bottom-right, opens WhatsApp | `partials/chat-widget.blade.php` — currently a NO-OP placeholder |
| **Navigation** | Logo left, links center, CTA right | Already built |
| **Footer** | Multi-column with links, socials, newsletter | Already built |
| **SEO Meta** | Dynamic per-page | Already built |

---

## 2. What Chada Already Has (Reusable)

| Asset | Status | Notes |
|-------|--------|-------|
| Light theme (`#f4f2ee` bg) | ✅ | Tailwind config done |
| `x-workflow-diagram` component | ✅ | Renders horizontal pipeline with arrows. Needs styling refinement to match WAB's exact look |
| `CaseStudyService` + `CaseStudyController` | ✅ | Architecture correct. Content is placeholder only |
| `/work` + `/case-study/{slug}` routes | ✅ | Working |
| `/showcase` → `/work` 301 | ✅ | Preserved |
| `x-case-study-card` component | ✅ | Renders thumbnail, client, metric, tags. WAB cards are text-only, no images |
| `x-section-header` component | ✅ | Reusable label/title/subtitle |
| `x-section-badge` + `x-section-heading` | ✅ | Used in V2 partials |
| `x-button-primary` + `x-button-outline` | ✅ | CTA buttons |
| Contact form | ✅ | Functional, honeypot protected |
| Chat widget partial | ⚠️ | Exists but is a NO-OP. Does not open WhatsApp or any chat |
| 503 maintenance page | ✅ | Branded, working |

---

## 3. What Must Be Built or Rebuilt

### 3.1 CRITICAL — Homepage Case Studies

**Problem:** `home.blade.php` does NOT include `@include('partials.case-studies')`. The case study section exists as a partial but is only rendered on `/work`, not the homepage.

**WAB Behavior:** 9 case study cards appear directly on the homepage, below the workflow system.

**Fix:** Add `@include('partials.case-studies')` to `home.blade.php` immediately after the workflow system section.

```blade
{{-- resources/views/pages/home.blade.php --}}
@extends('layouts.app')

@section('content')
    @include('partials.hero')
    @include('partials.workflow-system')  {{-- NEW: WAB signature feature --}}
    @include('partials.case-studies')      {{-- CRITICAL FIX: was missing from home --}}
    @include('partials.stats-bar')         {{-- NEW: 5 big numbers --}}
    @include('partials.trust-bar')         {{-- guarded until logos exist --}}
    @include('partials.testimonials')      {{-- NEW: client quotes --}}
    @include('partials.founder')           {{-- NEW: founder bio --}}
    @include('partials.martech')           {{-- NEW: tool stack grid --}}
    @include('partials.manifesto')         {{-- NEW: accountability principles --}}
    @include('partials.contact')
@endsection
```

### 3.2 CRITICAL — Backend Workflow System (WAB's Signature Feature)

**WAB Behavior:** A full-width section titled "SYSTEM BACKEND WORKFLOW" with a "🗃 Auto-Synchronized" badge. Below: 9 horizontal pipeline diagrams, each showing 4–5 steps connected by arrows. A system speed claim: "⚙️ Our system coordinates these steps in under 1.4 seconds."

**Chada Gap:** No equivalent section exists. The `x-workflow-diagram` component exists but is only used on individual case study detail pages.

**Build:** `resources/views/partials/workflow-system.blade.php`

**Data Structure:** Add to `CaseStudyService::all()` — each case study gets a `workflow` array:

```php
'workflow' => [
    ['step' => 'Meta Video Ads', 'tool' => 'Paid Ads'],
    ['step' => 'ManyChat API', 'tool' => 'Automation'],
    ['step' => 'HubSpot CRM', 'tool' => 'CRM'],
    ['step' => 'WhatsApp Alert', 'tool' => 'Dispatch'],
],
```

**Visual Spec:**
- Section background: `bg-muted/40` or `bg-card`
- Heading: "SYSTEM BACKEND WORKFLOW" in `font-display`, uppercase, tracked
- Badge: "🗃 Auto-Synchronized" — small pill, `bg-primary/10 text-primary`
- Each pipeline: horizontal flex, scrollable on mobile
- Step boxes: `rounded-lg border border-border bg-background px-4 py-3 min-w-[140px]`
- Arrows: `→` or chevron SVG between steps
- Speed claim: centered, `text-sm text-muted-foreground`, with ⚙️ icon

### 3.3 CRITICAL — Services Page (/services)

**WAB Behavior:** A dedicated `/services` page with 3 tiers (Strategy, Done-For-You, Retainers) + add-ons, each with exact pricing in Naira.

**Chada Gap:** No `/services` route exists. Services are only shown as 4 cards on the homepage.

**Build:**
1. `routes/web.php`: `Route::get('/services', [PageController::class, 'services'])->name('services');`
2. `app/Http/Controllers/PageController.php`: Add `services()` method
3. `resources/views/pages/services.blade.php`: Full page
4. `config/services.php` or `app/Services/PricingService.php`: All service data

**Data Structure:**

```php
// app/Services/PricingService.php
class PricingService
{
    public function stats(): array { /* 5 big numbers */ }
    public function strategies(): array { /* 4 strategy cards */ }
    public function builds(): array { /* 6 build cards */ }
    public function retainers(): array { /* 5 retainer cards */ }
    public function addons(): array { /* add-on list */ }
}
```

**Card Structure (exact WAB pattern):**
```
[Category Badge: "Strategy" / "Done For You" / "Monthly retainer" / "Premium retainer"]
[Title]
[Description]
[BEST FOR: audience text]
[Price: "₦140,000" / "From $500/month"]
```

### 3.4 CRITICAL — Stats Bar

**WAB Behavior:** 5 big numbers on the services page: 200+ Clients served, 16+ Case studies, 40,000+ Leads generated, ₦200M+ Client revenue, 1,200% Highest sales increase.

**Chada Gap:** No stats bar exists. V1 had one but it was removed in V2.

**Build:** `resources/views/partials/stats-bar.blade.php`

**Placement:** Services page (primary) + optionally homepage below workflow system.

### 3.5 CRITICAL — Functional WhatsApp Chat Widget

**WAB Behavior:** Persistent floating button, bottom-right. Opens WhatsApp web/app with pre-filled message.

**Chada Gap:** `partials/chat-widget.blade.php` is a NO-OP. The code comment says: "This button is a no-op: it does not open any external link or chat script."

**Fix:** Wire to a real WhatsApp number. Replace NO-OP with actual `https://wa.me/234...` link.

```blade
<a href="https://wa.me/2349122974778?text=Hi%20Chada%20Digital,%20I%20saw%20your%20website%20and..."
   target="_blank" rel="noopener"
   class="fixed bottom-6 right-6 z-50 ...">
   {{-- WhatsApp icon + "Chat with us" label --}}
</a>
```

**Decision needed:** Which WhatsApp number? Business or personal? Pre-fill message text?

### 3.6 HIGH — Case Studies Detail Pages

**WAB Behavior:** Individual case study pages at `/case-studies/[slug]/` with full narrative: problem → solution → results → workflow diagram.

**Chada Gap:** `/case-study/{slug}` exists but content is placeholder. Need real narratives.

**Fix:** Populate `CaseStudyService::all()` with 9+ real case studies (see §5 for content mapping).

### 3.7 HIGH — Filterable Case Studies Grid

**WAB Behavior:** `/case-studies/` has category filter pills (All, Funnel Design, SEO, Marketing Automation, Paid Ads). Clicking a pill filters the grid via JS.

**Chada Gap:** `/work` has a filterable grid but uses different categories and may not have working JS.

**Fix:** Ensure `work.blade.php` filter buttons actually filter via JS. Map categories to Chada's work: Web Development, Funnels, Ads, Branding.

### 3.8 HIGH — Testimonials Section

**WAB Behavior:** Client quotes with attribution. At least one visible on homepage (from search: "I recommend Wab digital to everyone who needs a digital marketing agency to work with. They deliver 100%" — Tosin Omotosho, Lead Counsel, Charis Legal).

**Chada Gap:** `partials/testimonials.blade.php` exists but content is Lorem Ipsum.

**Fix:** Replace with real testimonials or hide until real ones are available.

### 3.9 MEDIUM — Founder Section

**WAB Behavior:** "Hi, I'm Caroline Wabara" — real photo, real bio, real credentials.

**Chada Gap:** `partials/founder-bio.blade.php` exists but uses placeholder silhouette and "Chada Digital Team" instead of a real name.

**Fix:** Needs real founder name, bio, photo.

### 3.10 MEDIUM — MarTech Integrations Grid

**WAB Behavior:** Grid of tool logos/names showing tech stack credibility.

**Chada Gap:** Removed in V2. Not present.

**Fix:** Re-add `partials/martech.blade.php` to homepage.

### 3.11 MEDIUM — Manifesto / Principles Band

**WAB Behavior:** Short accountability statements.

**Chada Gap:** Removed in V2.

**Fix:** Re-add `partials/manifesto.blade.php`.

### 3.12 MEDIUM — Calculator Tool (/calculator)

**WAB Behavior:** Interactive Sales Goal Calculator.

**Chada Gap:** No equivalent.

**Decision:** Build now or defer? This is a conversion tool, not just content.

### 3.13 LOW — Additional Pages

| WAB Page | Chada Status | Decision |
|----------|-------------|----------|
| /webinar/ | ❌ Missing | Defer — no webinar program yet |
| /training/ | ❌ Missing | Defer — no training program yet |
| /shop/ | ❌ Missing | Defer — no digital products yet |
| /blog/ | ❌ Missing | Defer — blog can be added later |

---

## 4. File-by-File Build Map

### NEW Files to Create

| File | Purpose | Section |
|------|---------|---------|
| `resources/views/partials/workflow-system.blade.php` | 9 backend pipeline diagrams | Homepage |
| `resources/views/partials/stats-bar.blade.php` | 5 big numbers | Services page + Homepage |
| `resources/views/pages/services.blade.php` | Full services page | `/services` |
| `app/Services/PricingService.php` | All pricing data | Services page |
| `resources/views/components/service-card.blade.php` | Reusable pricing card | Services page |
| `resources/views/components/stats-badge.blade.php` | Big number + label | Stats bar |

### MODIFY Files

| File | Changes |
|------|---------|
| `resources/views/pages/home.blade.php` | Add workflow-system, case-studies, stats-bar, testimonials, founder, martech, manifesto |
| `app/Http/Controllers/PageController.php` | Add `services()` method; pass `studies` to home view |
| `routes/web.php` | Add `/services` route |
| `app/Services/CaseStudyService.php` | Replace ALL placeholder content with 9+ real case studies |
| `config/placeholders.php` | Replace ALL lorem ipsum with real copy |
| `resources/views/partials/chat-widget.blade.php` | Replace NO-OP with real WhatsApp link |
| `resources/views/partials/case-studies.blade.php` | Ensure it renders on home; match WAB text-only card style |
| `resources/views/partials/testimonials.blade.php` | Replace Lorem Ipsum with real quotes |
| `resources/views/partials/founder-bio.blade.php` | Replace placeholder with real name/photo/bio |
| `resources/views/partials/hero.blade.php` | Replace Lorem Ipsum headline with real value prop |
| `resources/views/partials/header.blade.php` | Add "Services" link to nav |

### DELETE Files (No Longer Needed)

| File | Reason |
|------|--------|
| `resources/views/partials/goal-picker.blade.php` | Replaced by real services page |
| `resources/views/partials/assessment-cta.blade.php` | Static placeholder; not a real WAB feature |
| `resources/views/partials/services-checklist.blade.php` | Replaced by real services page |
| `resources/views/partials/exclusivity-cta.blade.php` | Not a WAB feature |

---

## 5. Content Requirements (What David Must Supply)

This is the complete list of real content needed. No placeholder text can ship to production.

### 5.1 Hero
- [ ] One-sentence headline (WAB: "Digital Marketing Agency In Lagos Nigeria | Website, SEO, Ads")
- [ ] One-paragraph value proposition

### 5.2 Case Studies (9 minimum, 16+ preferred)

Each case study needs:
- [ ] Client name (real company)
- [ ] Industry tag
- [ ] Category tag (Funnel Design / SEO / Web Development / Paid Ads / Marketing Automation)
- [ ] **One big metric** (e.g., "$343,000 Generated", "1,200% Sales Increase", "3,834 Qualified Leads")
- [ ] **One-sentence description** of what was done
- [ ] **4–5 step workflow** (the exact tools and steps — this is WAB's signature)
- [ ] Full narrative for detail page: Challenge → Solution → Results

**Map to Chada's existing demos:**

| Chada Demo | WAB-Style Metric | Category |
|------------|-----------------|----------|
| Sterling & Vale | "3× Lead Increase" | Web Development |
| ApexFlow | "68% Trial Conversion" | Funnel Design |
| ELYSIAN | "40% Direct Bookings" | Web Development |
| HIREBASE | "2,100+ Placements" | Web Development |
| NOIR | "1,200% Sales Increase" | Funnel Design |
| TimberMill | "5× Inquiry Volume" | Web Development |
| **[NEW]** | Need 3+ more to reach WAB's 9 | |

### 5.3 Services + Pricing

**Strategy Sessions:**
- [ ] Marketing Strategy Session — price (WAB: ₦140,000)
- [ ] SEO Audit + Strategy — price (WAB: ₦70,000)
- [ ] Website Audit + Strategy — price (WAB: ₦70,000)
- [ ] SEO VIP Day — price (WAB: ₦350,000)

**Done-For-You Builds:**
- [ ] Done-For-You Sales Funnel — price (WAB: ₦1,050,000)
- [ ] Website That Converts — price (WAB: ₦1,050,000)
- [ ] CRM Setup + Onboarding — price (WAB: ₦210,000)
- [ ] Email System Setup — price (WAB: ₦500,000)
- [ ] Paid Ads Setup — price (WAB: ₦350,000)
- [ ] Landing Page Creation — price (WAB: ₦350,000)

**Monthly Retainers:**
- [ ] Monthly Marketing Retainer — price (WAB: From $500/month)
- [ ] Monthly SEO Management — price (WAB: ₦700,000/month)
- [ ] Monthly Google Ads — price (WAB: ₦650,000/month)
- [ ] Monthly Facebook + Instagram Ads — price (WAB: ₦650,000/month)
- [ ] Monthly Marketing Consulting — price (WAB: ₦1,500,000/month)

### 5.4 Stats Bar
- [ ] Client count (WAB: 200+)
- [ ] Case study count (WAB: 16+)
- [ ] Leads generated (WAB: 40,000+)
- [ ] Revenue influenced (WAB: ₦200M+)
- [ ] Highest sales increase (WAB: 1,200%)

### 5.5 Testimonials (3 minimum)
- [ ] Real quote
- [ ] Real name
- [ ] Real title + company
- [ ] Written permission to use

### 5.6 Founder
- [ ] Full name
- [ ] Title (e.g., "Founder & Lead Engineer")
- [ ] Bio (2 paragraphs, ~100 words)
- [ ] High-res portrait photo (min 1200×1200px)
- [ ] Optional: handwritten signature

### 5.7 WhatsApp Chat
- [ ] Business WhatsApp number
- [ ] Pre-fill message text

---

## 6. Implementation Phases

### Phase 1 — Structural Fixes (1 day)
- [ ] Add `@include('partials.case-studies')` to `home.blade.php`
- [ ] Build `partials/workflow-system.blade.php`
- [ ] Build `partials/stats-bar.blade.php`
- [ ] Add `/services` route + controller method + page
- [ ] Build `PricingService` with all tiers
- [ ] Build `components/service-card.blade.php`
- [ ] Fix chat widget — replace NO-OP with real WhatsApp link
- [ ] Delete V2 placeholder partials (goal-picker, assessment-cta, services-checklist, exclusivity-cta)

### Phase 2 — Content Population (2–3 days)
- [ ] Populate `CaseStudyService` with 9+ real case studies
- [ ] Populate `PricingService` with real services + pricing
- [ ] Replace all `config/placeholders.php` content with real copy
- [ ] Add real testimonials to `partials/testimonials.blade.php`
- [ ] Add real founder content to `partials/founder-bio.blade.php`
- [ ] Add real hero headline to `partials/hero.blade.php`
- [ ] Add client logos to `partials/trust-bar.blade.php` (or hide until ready)

### Phase 3 — Polish + QA (1 day)
- [ ] Ensure `/work` filter buttons work via JS
- [ ] Ensure case study detail pages render workflow diagrams
- [ ] Mobile responsiveness check
- [ ] Lighthouse audit (target ≥ 90)
- [ ] Cross-browser test
- [ ] Verify contact form still works
- [ ] Verify all 6 demo previews still load
- [ ] Verify sitemap includes all new routes

### Phase 4 — Deploy (0.5 day)
- [ ] `php artisan up` (turn off maintenance mode)
- [ ] Smoke test production
- [ ] Monitor error logs for 24 hours

**Total: 4.5–5.5 days** (single developer, content-ready)

---

## 7. Design Notes

### 7.1 Color Palette (Keep Current Light Theme)

| Token | Value | Usage |
|-------|-------|-------|
| `background` | `#f4f2ee` | Page background |
| `foreground` | `#171717` | Primary text |
| `card` | `#fbfaf8` | Card surfaces |
| `primary` | `#2563eb` | CTAs, links, badges, accents |
| `muted` | `#f5f5f5` / `#525252` | Secondary backgrounds / secondary text |
| `border` | `#e5e5e5` | Card borders, dividers |

### 7.2 Typography

- **Display:** Outfit (headings, stats numbers, workflow labels)
- **Body:** Inter (paragraphs, descriptions)
- **Accent:** Playfair Display (optional — founder signature, quotes)

### 7.3 WAB Card Pattern (Exact Replication)

WAB service cards follow this exact structure:

```
┌─────────────────────────────────────────────┐
│ [Category Badge: small pill, muted bg]      │
│                                             │
│ [Title: bold, large]                        │
│                                             │
│ [Description: 2–3 sentences, muted text]    │
│                                             │
│ BEST FOR:                                   │
│ [Audience description, 1 sentence]          │
│                                             │
│ [Price: large, bold, primary color]         │
└─────────────────────────────────────────────┘
```

### 7.4 WAB Workflow Diagram Pattern (Exact Replication)

```
SYSTEM BACKEND WORKFLOW
🗃 Auto-Synchronized

┌─────────┐    ┌─────────┐    ┌─────────┐    ┌─────────┐
│ Step 1  │ →  │ Step 2  │ →  │ Step 3  │ →  │ Step 4  │
│ (tool)  │    │ (tool)  │    │ (tool)  │    │ (tool)  │
└─────────┘    └─────────┘    └─────────┘    └─────────┘

[Repeat for 9 pipelines]

⚙️ Our system coordinates these steps in under 1.4 seconds.
```

---

## 8. Acceptance Criteria

The redesign is complete when ALL of the following are true:

1. ✅ Homepage renders: Hero → Workflow System (9 pipelines) → Case Studies (9+ cards) → Stats → Testimonials → Founder → MarTech → Manifesto → Contact
2. ✅ `/services` page renders: Stats bar → Strategy Sessions (4 cards) → Done-For-You (6 cards) → Retainers (5 cards) → Add-ons → CTAs
3. ✅ `/case-studies` page has filterable grid of 9+ case studies with real metrics
4. ✅ Each `/case-study/{slug}` has: challenge → solution → results → workflow diagram
5. ✅ All case study cards on homepage are **text-only** (no thumbnails) — matching WAB's exact style
6. ✅ Workflow diagrams show 4–5 steps per pipeline with arrow connectors
7. ✅ Chat widget opens real WhatsApp conversation (not a no-op)
8. ✅ All content is real — zero Lorem Ipsum, zero "Placeholder", zero "Pending"
9. ✅ All existing routes still work (`/`, `/work`, `/preview/{slug}`, `/api/contact`, `/sitemap.xml`)
10. ✅ `public/demos/` untouched
11. ✅ Lighthouse ≥ 90 on mobile and desktop
12. ✅ No new Composer or npm dependencies

---

## 9. Risk Register

| Risk | Likelihood | Impact | Mitigation |
|------|------------|--------|------------|
| David cannot supply 9 case studies with metrics | High | Critical | Start with 6 (existing demos) + 3 aspirational. Build structure; populate later. |
| David cannot supply pricing | High | High | Use "Contact us for pricing" as fallback. Do not invent prices. |
| Real testimonials not available | Medium | Medium | Hide testimonials section until permission-cleared quotes arrive. |
| Founder photo not available | Medium | Low | Use monogram initials as fallback. Section still works. |
| Workflow steps inaccurate | Medium | High | Tech Lead must verify every tool mentioned was actually used. |
| WhatsApp number not business-ready | Low | Medium | Use personal number temporarily. Switch to business later. |

---

## 10. Notes for AI Coding Agents

When turning this spec into agent prompts, follow the existing repo convention from `REDESIGN_IMPLEMENTATION_PROMPT.md`:

1. **Restate non-negotiable constraints at the top of every prompt:**
   - Never modify `public/demos/`
   - Use `mix()`, never `@vite()`
   - Use `bun`, never `npm`
   - Preserve existing route names
   - Keep contact form honeypot

2. **One prompt per file.** Do not ask an agent to "build the entire services page." Break into: (a) PricingService, (b) service-card component, (c) services.blade.php page, (d) route + controller.

3. **Always provide the EXISTING file content** as context, not just a description. Agents need to see current code to avoid regressions.

4. **Test after every file.** Run `bun run dev` and check the page renders before moving to the next file.

---

*End of spec. This document was prepared from a live audit of wabdigital.com (homepage, /services/, /case-studies/) and a direct read of the DGCodeIdeas/chada.digital repository (all Blade partials, controllers, services, routes, config).*
