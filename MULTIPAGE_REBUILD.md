# MULTIPAGE_REBUILD.md — Multi-Page Architecture + Bootstrap/MD3 Rebuild

> **Mandate:** Revert to pre-Redesign(2).md execution state. Rebuild the entire site as a **multi-page application** using **Bootstrap 5 + Material Design 3**, following the patterns defined in `docs/Redesign(1).md` (V4 master directive).
> **Why multi-page:** The single-page anchor architecture crammed 16+ patterns into one scroll. Multi-page gives each conversion intent its own URL, SEO surface, and focused experience.
> **Why Bootstrap/MD3:** Founder directive — avoid the "AI-generated Tailwind site" look.
> **Stack:** Laravel 12 + Blade + Bootstrap 5 + Material Design 3 + Laravel Mix + jQuery · Bun · PHP 8.2+
> **Repo:** `DGCodeIdeas/chada.digital`
> **Status:** Revert + rebuild spec. Read `docs/Redesign(1).md` first for pattern definitions.

---

## 1. Revert Strategy

### Current State (as of main branch HEAD)
The repo is at Redesign(5).md execution — case studies partially built, with Bootstrap/MD3 migration config in PR #14. The site is in maintenance mode (`artisan down`).

### Target Revert State
Go back to **commit `f4c3d2a`** ("feat: add contact form honeypot") — the last commit before the Redesign Update (`1182f97`). This gives us:
- The original dark-themed Laravel 12 site (functional, stable)
- All redesign docs intact (Redesign(1).md through Redesign(9).md)
- No redesign code changes (no light theme, no case study system, no new routes)

### Revert Command
```bash
git checkout main
git reset --hard 6d4e58543dd42d74522c25b405acb01995613834
# Then cherry-pick or manually re-apply ONLY the docs:
# - docs/Redesign(1).md through docs/Redesign(9).md
# - MIGRATION.md (this doc's predecessor)
# - Open_Decision.md
# - TODO-Placeholders.md
# - README.md (updated)
```

### What to Keep from Post-Revert Commits
| Commit | Keep? | Action |
|--------|-------|--------|
| `1182f97` "feat: redesign update" | ❌ Discard | All redesign code — will rebuild from scratch |
| `848df2f` "feat: redesign" | ❌ Discard | V2 redesign code |
| PR #5 case studies | ❌ Discard | Will rebuild with real content |
| `ed560e7` hotfix | ❌ Discard | Fixes for code we're discarding |
| PR #14 Bootstrap/MD3 config | ✅ Keep | `package.json`, `webpack.mix.js`, SCSS architecture |
| `MIGRATION.md` | ✅ Keep | Migration spec (update to multi-page) |
| `REDESIGN_IMPLEMENTATION.md` | ⚠️ Archive | Historical reference |
| `Implementation_redesign.md` | ⚠️ Archive | Historical reference |

---

## 2. Multi-Page Architecture

### 2.1 Page Map

| URL | Page | Patterns from Redesign(1).md | Purpose |
|-----|------|------------------------------|---------|
| `/` | **Home** | 1–9 (Hero, Stats, Trust, Tiers, Consult, Transition, Working Together, Services Checklist, Webinar) | Conversion hub — orient + qualify + convert |
| `/case-studies` | **Case Studies** | 10–13 (Results Grid, System Blueprints, Detail Pages, Related Results) | Proof — show real work with metrics |
| `/services` | **Services** | 6 (expanded: Strategy, Builds, Retainers, Add-ons) | Commerce — exact pricing + tier selection |
| `/about` | **About** | 14–16 (Testimonials, MarTech, Founder, Exclusivity) | Trust — humanize the agency |
| `/contact` | **Contact** | Existing contact form | Capture — direct inquiry |
| `/demos` | **Demo Lab** | 10 (iframe tabs for all 6 demos) | Experience — interactive previews |
| `/preview/{slug}` | **Preview** | Existing iframe viewer | Deep-dive — individual demo chrome |
| `/sitemap.xml` | **Sitemap** | Dynamically generated | SEO |

### 2.2 Navigation Structure

```
[Logo]          Home | Case Studies | Services | About | Contact          [CTA: Start a Project]
```

- **Desktop:** Horizontal nav, sticky, Bootstrap navbar
- **Mobile:** Hamburger collapse, Bootstrap navbar-toggler
- **Active state:** Bootstrap `.active` class on current page link
- **CTA:** "Start a Project" button (primary) → `/contact`

### 2.3 Footer (Global)

```
[Logo + tagline]          [Pages]          [Services]          [Connect]
                          Home             Strategy            info@chadadigital.com
                          Case Studies     Builds              +234 912 297 4778
                          Services         Retainers           Lagos, Nigeria
                          About            Add-ons             [LinkedIn] [Twitter] [Instagram]
                          Contact

© 2026 Chada Digital. All rights reserved.
```

---

## 3. Per-Page Build Spec

### 3.1 Home Page (`/`)

**Layout:** Full-width sections, stacked vertically, generous vertical padding (`py-7` = 5rem).

**Sections (in order):**

#### Section 1: Hero
- Eyebrow tag: "Digital Marketing & Automation Agency — Lagos, Nigeria"
- H1: "We Build Funnels That Convert Visitors Into Revenue"
- Subhead: "High-performance websites, automated sales systems, and data-driven campaigns for ambitious brands across Africa."
- Primary CTA: "Start a Project" → `/contact`
- Secondary CTA: "View Our Work" → `/case-studies`
- Social proof line: "Trusted by 50+ brands"

**Bootstrap classes:** `.container`, `.display-4`, `.btn`, `.btn-primary`, `.btn-outline-primary`

#### Section 2: Stats Band
- 4 large numbers in a row:
  - "50+" Projects Delivered
  - "6+" Industries Served
  - "3+" Years in Operation
  - "95%" Client Retention

**Bootstrap classes:** `.row`, `.col-md-3`, custom `.stat-badge`

#### Section 3: Trust Strip
- Client logo row (guarded — renders nothing until `$clientLogos` populated)
- Grayscale logos, opacity-50, hover:opacity-100

**Bootstrap classes:** `.d-flex`, `.justify-content-center`, `.gap-4`

#### Section 4: Tiered Offer Cards (Goal Picker)
- 6 cards in a 3-column grid (2 rows):
  - Tier badge ("Strategy", "Build", "Retainer", etc.)
  - Outcome-framed title ("I want you to build me a website that sells FOR me")
  - Short description
  - **Price block** (label, amount, period) — THE key gap from V2
  - CTA button

**Bootstrap classes:** `.row`, `.row-cols-1`, `.row-cols-md-3`, `.g-4`, `.card`, `.card-body`

#### Section 5: Free Consult CTA
- Single prominent card:
  - "Not sure where to start?"
  - "Book a free 30-minute strategy call. We'll audit your current setup and identify the highest-ROI next step."
  - CTA: "Book Free Call" → `/contact?type=strategy`

**Bootstrap classes:** `.card`, `.bg-primary`, `.text-white`

#### Section 6: Transition Band
- One-line bridge: "Choose how we work together"
- Separates tiers from detailed services

**Bootstrap classes:** `.text-center`, `.py-4`

#### Section 7: Working Together
- 4-step process: Discover → Design → Build → Scale
- Numbered, with icons and descriptions

**Bootstrap classes:** `.row`, `.col-md-3`, `.text-center`

#### Section 8: Services Checklist
- Expandable/accordion list of services with checkmarks
- "What you get with every engagement"

**Bootstrap classes:** `.accordion`, `.accordion-item`, `.accordion-button`

#### Section 9: Webinar Opt-in
- "Join 200+ founders learning growth strategies"
- Email capture form
- "Get notified about our next free webinar"

**Bootstrap classes:** `.input-group`, `.form-control`, `.btn`

---

### 3.2 Case Studies Page (`/case-studies`)

**Layout:** Filterable grid + detail pages.

#### Index Page (`/case-studies`)
- Heading: "Results That Actually Happened"
- Subhead: "Real projects. Real metrics. Real revenue."
- Stats bar: "16+ Case Studies · ₦200M+ Client Revenue · 40,000+ Leads Generated"
- Filter pills: All | Funnel Design | SEO | Web Development | Paid Ads | Marketing Automation
- Grid: 3 columns, cards with:
  - Category tag
  - Industry tag
  - **Big metric** (e.g., "3× Lead Increase")
  - Client name
  - 1-sentence description
  - "Read story →" link

**Bootstrap classes:** `.btn-group`, `.row`, `.row-cols-1`, `.row-cols-md-3`, `.card`

#### Detail Page (`/case-study/{slug}`)
- Hero: Client name + metric highlight
- Metrics bar: 3 key numbers
- Challenge → Solution → Results narrative
- **System Blueprint** (workflow diagram): 4–5 steps with tools
- Tech stack tags
- "Start a Similar Project" CTA
- Related case studies (2–3 cards)

**Bootstrap classes:** `.container`, `.row`, `.col-lg-8`, `.col-lg-4`, `.card`

---

### 3.3 Services Page (`/services`)

**Layout:** Tabbed or stacked sections with pricing cards.

#### Stats Bar (same as case studies)
- 5 numbers: Clients, Case Studies, Leads, Revenue, Highest Increase

#### Strategy Sessions
- 4 cards:
  - Marketing Strategy Session — ₦140,000
  - SEO Audit + Strategy — ₦70,000
  - Website Audit + Strategy — ₦70,000
  - SEO VIP Day — ₦350,000

#### Done-For-You Builds
- 6 cards:
  - Done-For-You Sales Funnel — ₦1,050,000
  - Website That Converts — ₦1,050,000
  - CRM Setup + Onboarding — ₦210,000
  - Email System Setup — ₦500,000
  - Paid Ads Setup — ₦350,000
  - Landing Page Creation — ₦350,000

#### Monthly Retainers
- 5 cards:
  - Monthly Marketing Retainer — From $500/month
  - Monthly SEO Management — ₦700,000/month
  - Monthly Google Ads — ₦650,000/month
  - Monthly Facebook + Instagram Ads — ₦650,000/month
  - Monthly Marketing Consulting — ₦1,500,000/month

#### Add-On Services
- Supporting services list
- "Take the free funnel audit" CTA
- "Book a strategy call" CTA

**Bootstrap classes:** `.nav-tabs`, `.tab-content`, `.row`, `.row-cols-1`, `.row-cols-md-2`, `.row-cols-lg-3`, `.card`, custom `.service-card`

---

### 3.4 About Page (`/about`)

**Layout:** Narrative scroll, personal and trust-building.

#### Testimonials
- 3–6 quote cards:
  - Star rating
  - Quote text
  - Name, title, company
  - Optional avatar

#### Standards Band
- "We Ship on Deadline · We Answer Within 24 Hours · We Measure Your Revenue"

#### MarTech Integrations Grid
- 8 categories, 3 tools each:
  - Payments: Paystack, Stripe, Flutterwave
  - Analytics: Google Analytics 4, Plausible, PostHog
  - CRM & Marketing: HubSpot, Brevo, Mailchimp
  - Advertising: Meta Ads, Google Ads, TikTok Ads
  - Automation: Zapier, Make, n8n
  - CMS & E-commerce: Laravel, WordPress, Shopify
  - SEO: Ahrefs, SEMrush, RankMath
  - Infrastructure: AWS, Cloudflare, Vercel

#### Founder Bio
- Portrait photo (left)
- Name, title
- 2-paragraph bio
- Signature
- Social links

#### Exclusivity CTA
- "We work with a limited number of clients each quarter"
- Scarcity messaging
- "Apply to work with us" → `/contact?type=application`

**Bootstrap classes:** `.row`, `.col-md-6`, `.card`, `.text-center`

---

### 3.5 Contact Page (`/contact`)

**Layout:** Two-column (form left, details right).

- Name, Email, Message form
- Honeypot spam protection
- Contact details: info@chadadigital.com, +234 912 297 4778, Lagos, Nigeria
- Map or location indicator

**Bootstrap classes:** `.row`, `.col-lg-7`, `.col-lg-5`, `.form-control`, `.btn`

---

### 3.6 Demo Lab Page (`/demos`)

**Layout:** Tabbed iframe viewer.

- Tabs: Sterling & Vale | ApexFlow | ELYSIAN | HIREBASE | NOIR | TimberMill
- Each tab loads the corresponding demo in an iframe
- "View Full Case Study" link per demo

**Bootstrap classes:** `.nav-tabs`, `.tab-content`, `.ratio`, `.ratio-4x3`

---

## 4. Global Components

### 4.1 Header/Navigation (`partials/header.blade.php`)
- Bootstrap navbar, sticky-top
- Logo left
- Links: Home, Case Studies, Services, About, Contact
- Active page highlight
- CTA button right
- Mobile: hamburger collapse

### 4.2 Footer (`partials/footer.blade.php`)
- 4-column Bootstrap grid
- Logo + tagline
- Page links
- Service links
- Contact info + social icons
- Copyright bar

### 4.3 Chat Widget (`partials/chat-widget.blade.php`)
- Fixed bottom-right
- WhatsApp button (real `wa.me` link)
- Bootstrap positioning + MD3 elevation

### 4.4 Meta/SEO (`partials/meta.blade.php`)
- Dynamic per-page title/description
- OG tags
- Twitter cards
- JSON-LD structured data

---

## 5. Data Layer

### 5.1 Services & Pricing

```php
// app/Services/PricingService.php
class PricingService
{
    public function strategies(): array;
    public function builds(): array;
    public function retainers(): array;
    public function addons(): array;
    public function stats(): array;
}
```

### 5.2 Case Studies

```php
// app/Services/CaseStudyService.php
class CaseStudyService
{
    public function all(): array;
    public function get(string $slug): ?array;
    public function byCategory(string $category): array;
    public function featured(int $limit = 3): array;
}
```

### 5.3 Testimonials

```php
// app/Services/TestimonialService.php
class TestimonialService
{
    public function all(): array;
}
```

### 5.4 MarTech

```php
// app/Services/MarTechService.php
class MarTechService
{
    public function categories(): array;
}
```

---

## 6. Routes

```php
// routes/web.php
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/case-studies', [CaseStudyController::class, 'index'])->name('case-studies.index');
Route::get('/case-study/{slug}', [CaseStudyController::class, 'show'])->name('case-study.show');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/demos', [PageController::class, 'demos'])->name('demos');
Route::get('/preview/{slug}', [PreviewController::class, 'show'])->name('preview.show');
Route::get('/preview/{slug}/{subpage}', [PreviewController::class, 'subpage'])->name('preview.subpage');
Route::post('/api/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');

// Redirects (preserve SEO)
Route::redirect('/showcase', '/case-studies', 301);
Route::redirect('/work', '/case-studies', 301);
```

---

## 7. Implementation Phases

### Phase 0 — Revert (0.5 day)
- [ ] `git reset --hard 6d4e58543dd42d74522c25b405acb01995613834`
- [ ] Cherry-pick docs: Redesign(1).md–(9).md, MIGRATION.md, Open_Decision.md, TODO-Placeholders.md
- [ ] Cherry-pick Bootstrap/MD3 config from PR #14
- [ ] Verify `bun run dev` builds cleanly
- [ ] Verify original dark site renders

### Phase 1 — Global Chrome (1 day)
- [ ] Build `layouts/app.blade.php` (Bootstrap scaffold)
- [ ] Build `partials/header.blade.php` (Bootstrap navbar)
- [ ] Build `partials/footer.blade.php` (Bootstrap grid)
- [ ] Build `partials/chat-widget.blade.php` (real WhatsApp link)
- [ ] Build `partials/meta.blade.php` (dynamic per-page)
- [ ] Update `routes/web.php` with all new routes
- [ ] Update `PageController` with new methods

### Phase 2 — Home Page (1.5 days)
- [ ] Build `pages/home.blade.php`
- [ ] Build `partials/hero.blade.php`
- [ ] Build `partials/stats-bar.blade.php`
- [ ] Build `partials/trust-bar.blade.php`
- [ ] Build `partials/goal-picker.blade.php` (with price blocks)
- [ ] Build `partials/assessment-cta.blade.php`
- [ ] Build `partials/working-together.blade.php`
- [ ] Build `partials/services-checklist.blade.php`
- [ ] Build `partials/webinar-optin.blade.php`

### Phase 3 — Case Studies (1.5 days)
- [ ] Build `CaseStudyService` with 9+ real studies
- [ ] Build `pages/case-studies.blade.php` (filterable grid)
- [ ] Build `pages/case-study.blade.php` (detail page)
- [ ] Build `partials/workflow-system.blade.php` (9 pipelines)
- [ ] Build `components/case-study-card.blade.php`
- [ ] Build `components/workflow-diagram.blade.php`
- [ ] Build JS filter module

### Phase 4 — Services Page (1 day)
- [ ] Build `PricingService`
- [ ] Build `pages/services.blade.php`
- [ ] Build `components/service-card.blade.php`
- [ ] Build tabbed sections (Strategy / Builds / Retainers)

### Phase 5 — About Page (0.5 day)
- [ ] Build `pages/about.blade.php`
- [ ] Build `TestimonialService`
- [ ] Build `MarTechService`
- [ ] Build `partials/testimonials.blade.php`
- [ ] Build `partials/martech.blade.php`
- [ ] Build `partials/founder-bio.blade.php`
- [ ] Build `partials/exclusivity-cta.blade.php`

### Phase 6 — Contact + Demos (0.5 day)
- [ ] Build `pages/contact.blade.php`
- [ ] Build `pages/demos.blade.php` (tabbed iframe viewer)
- [ ] Verify contact form still works
- [ ] Verify all 6 demo previews load

### Phase 7 — QA + Deploy (1 day)
- [ ] Mobile responsiveness
- [ ] Cross-browser test
- [ ] Lighthouse audit (target ≥ 90)
- [ ] Sitemap verification
- [ ] `php artisan up` (turn off maintenance)
- [ ] Smoke test production

**Total: 7 days** (single developer, content-ready)

---

## 8. Content Requirements (What David Must Supply)

Same as `MIGRATION.md` §5 and `TODO-Placeholders.md`, reorganized by page:

### Home Page
- [ ] Hero headline + subhead
- [ ] 4 stats numbers
- [ ] 6 tiered offers with prices
- [ ] Client logos (with permission)

### Case Studies Page
- [ ] 9+ case studies with: client name, industry, category, metric, description, workflow steps, full narrative

### Services Page
- [ ] 15 service tiers with exact Naira pricing
- [ ] 5 stats numbers

### About Page
- [ ] 3+ testimonials (real quotes, permission)
- [ ] Founder name, title, bio, portrait photo
- [ ] WhatsApp business number

---

## 9. Acceptance Criteria

1. ✅ Multi-page architecture — 6 distinct pages with unique URLs
2. ✅ Bootstrap 5 + Material Design 3 — zero Tailwind classes
3. ✅ All pages render correctly on desktop, tablet, mobile
4. ✅ Navigation works — active page highlighting, mobile collapse
5. ✅ Case studies filterable by category
6. ✅ Workflow diagrams render on case study detail pages
7. ✅ Services page shows exact pricing
8. ✅ Contact form submits successfully
9. ✅ All 6 demo previews load in iframe viewer
10. ✅ WhatsApp chat widget opens real conversation
11. ✅ Sitemap includes all new routes
12. ✅ Lighthouse ≥ 90 on all pages
13. ✅ Zero Lorem Ipsum in production
14. ✅ `public/demos/` untouched

---

## 10. Related Documents

| Document | Purpose | Status |
|----------|---------|--------|
| `MULTIPAGE_REBUILD.md` (this doc) | **Active build spec** — multi-page + Bootstrap/MD3 | Current |
| `MIGRATION.md` | Bootstrap/MD3 migration technical details | Reference |
| `docs/Redesign(1).md` | Pattern definitions (V4 master directive) | Reference |
| `docs/Redesign(2).md`–`(9).md` | Sequential build docs (historical) | Reference |
| `Open_Decision.md` | Decision log | Reference |
| `TODO-Placeholders.md` | Content gates | Reference |
| `README.md` | Stack overview | Updated |

---

*End of spec. This document supersedes all single-page and Tailwind-based specifications. Build from this spec only.*


---

## Loose Ends & PR Housekeeping

| PR | Status | Action Needed |
|----|--------|--------------|
| **#14** | Open | **CLOSE** — superseded by #16. Config migration absorbed into multipage branch. |
| **#11** | Open | **DECIDE** — R4 System Blueprints (pipeline pattern). Built against old single-page architecture. May need rebuilding for 6-page structure or closing as obsolete. |
| **#17** | Open → `feat/multipage-bootstrap-rebuild` | **MERGE** — Design Partner band (replaces trust bar). Clean cherry-pick from #15. |

**Correct reset target verified:**
- `6d4e58543dd42d74522c25b405acb01995613834` — "Update and Clean Up" (Aug 28)
- `Lorem.php` does NOT exist here (pre-R2) ✅
- `docs/Redesign(9).md` DOES exist here (planning docs intact) ✅
