# Open_Decision.md — Chada Digital Redesign

> **Author:** DGCodeIdeas
> **Project:** chada.digital website redesign  
> **Reference:** https://wabdigital.com/  
> **Decision Date:** August 2026  
> **Decision Owner:** Product/Design Lead (post-meeting consensus)  
> **Audience:** Technical team, stakeholders, laymen, future hires  

---

## 1. Why Are We Redesigning?

### The Problem
The current Chada Digital website looks like a generic dark-mode SaaS template. It:
- **Blends in** with every other "tech studio" site
- **Hides our best work** behind iframe previews with no context
- **Lacks proof** — no metrics, no process transparency, no client stories
- **Feels small** — service cards and product grids make us look like a tool shop, not a strategic partner

### The Opportunity
WAB Digital (https://wabdigital.com/) demonstrates that **showing your process and results** builds more trust than showing screenshots. Their site:
- Leads with **backend workflow diagrams** ("This is HOW we do it")
- Leads with **hard numbers** ("$343K generated", "1,200% increase")
- Leads with **client names** ("Healthtracka", "Mantrac CAT Nigeria")
- Uses a **clean, minimalist aesthetic** that feels premium and confident

### The Consensus
In the August 2026 meeting, the team agreed:
> *"We want it minimalist like WAB Digital and its features."*

This document translates that consensus into concrete decisions.

---

## 2. What "Minimalist Like WAB Digital" Means

### It Does NOT Mean
- ❌ Boring or empty
- ❌ Removing all color
- ❌ Losing personality
- ❌ Copying WAB's exact content

### It DOES Mean
- ✅ **More whitespace** — let content breathe
- ✅ **Fewer sections, deeper content** — quality over quantity
- ✅ **Results-first** — metrics before descriptions
- ✅ **Process-visible** — show the backend workflow, not just the frontend
- ✅ **Light background** — white/off-white instead of dark navy
- ✅ **Restrained color** — one accent color (blue), mostly black/gray/white
- ✅ **Editorial typography** — large headlines, readable body text

### The Visual Shift
| Before | After |
|--------|-------|
| Dark navy background (`#0e1b2e`) | White/off-white (`#fafafa`) |
| Gradient glow blobs | Clean, no decorative noise |
| 6-7 sections on home page | 5-6 sections, more depth each |
| "Services That Drive Real Results" | "$343K Generated for Healthtracka" |
| Screenshot grids | Workflow diagrams + metrics |
| "View Our Work" CTA | "View Case Study" CTA |

---

## 3. Key Decisions Made

### Decision 1: Light Theme
**What:** Switch from dark navy to white/light gray.  
**Why:** Dark themes feel "developer-tool"; light themes feel "agency-professional". WAB, Ogilvy, Pentagram — top agencies use light. It also prints better and feels more accessible.  
**Impact:** Every Blade partial needs restyling. Logo may need a dark variant.  
**Status:** ✅ Decided. No objections raised.

### Decision 2: Case Studies Replace Portfolio
**What:** Instead of showing 6 project screenshots in a grid, we show 6-8 detailed case studies with metrics, workflow diagrams, and narratives.  
**Why:** A screenshot says "we made a website." A case study says "we generated $343K in revenue by rebuilding a diagnostic funnel with WooCommerce, Paystack, and custom forms." The second sells the *outcome*, not the *output*.  
**Impact:** New data structure (`CaseStudyService`), new pages (`/work`, `/case-study/{slug}`), new components (workflow diagrams, metric badges).  
**Status:** ✅ Decided. Content team to provide case study copy.

### Decision 3: Workflow Diagrams
**What:** Every case study shows a visual pipeline of the automation/backend workflow (e.g., Meta Ads → Landing Page → Paystack → CRM).  
**Why:** This is WAB's signature feature. It proves technical competence without requiring the visitor to read code. It turns abstract "automation" into concrete steps.  
**Impact:** New Blade component (`x-workflow-diagram`). Pure CSS/SVG — no libraries needed.  
**Status:** ✅ Decided. Design team to approve diagram style.

### Decision 4: Keep Existing Tech Stack
**What:** Laravel 12, Blade, Tailwind v3, Laravel Mix, jQuery, AWS EC2.  
**Why:** The redesign is front-end and content only. No framework benefit from changing stacks. Laravel 12 is current. Migration would add 2+ weeks.  
**Impact:** Zero infrastructure changes. Developers use existing patterns.  
**Status:** ✅ Decided unanimously.

### Decision 5: Preserve Demo Iframe System
**What:** The 6 demo projects in `public/demos/` stay exactly as they are.  
**Why:** They are independent, read-only, and still valuable. Case studies will LINK to them as "Live Demo" instead of EMBEDDING them as the primary content.  
**Impact:** No changes to demos. Preview controller stays.  
**Status:** ✅ Decided.

### Decision 6: Rename /showcase to /work
**What:** The portfolio page moves from `/showcase` to `/work`. Old URL 301 redirects.  
**Why:** "Work" is agency-standard (WAB uses it implicitly). "Showcase" sounds like a template gallery.  
**Impact:** One redirect rule. Update any external links.  
**Status:** ✅ Decided.

### Decision 7: Add Process Section
**What:** New home page section: "Our Process" (Discover → Design → Build → Scale).  
**Why:** WAB doesn't explicitly label this, but their workflow diagrams ARE their process. We make it explicit. It answers "how do you work?" before the client asks.  
**Impact:** One new partial. Can reuse for proposals.  
**Status:** ✅ Decided.

### Decision 8: Trust Bar (Client Logos)
**What:** Strip of client logos below the hero.  
**Why:** Social proof in the first viewport. WAB uses client names heavily; logos are the visual equivalent.  
**Impact:** Need client permission for logos. Need logo assets.  
**Status:** ⚠️ Decided PENDING client logo availability. Fallback: use text names or skip.

---

## 4. What Stays the Same

| Element | Why It Stays |
|---------|-------------|
| **Laravel 12 + Blade** | Framework is current; no migration benefit |
| **Tailwind CSS v3** | Still supported; v4 migration out of scope |
| **Laravel Mix + Bun** | Build pipeline works; no reason to change |
| **Contact form backend** | Logic is fine; only styling changes |
| **Demo iframe previews** | Independent assets; still valuable |
| **SEO meta system** | Structure is good; content updates only |
| **Sitemap generation** | Works; just add new routes |
| **Mobile navigation pattern** | Proven; just restyle |
| **Honeypot spam protection** | Still effective |

---

## 5. What's New

| Feature | What It Does | Who Cares |
|---------|-------------|-----------|
| **Case Study Pages** | Deep-dive project stories with metrics | Prospects who need proof |
| **Workflow Diagrams** | Visual automation pipelines | Technical buyers |
| **Metric Badges** | "$343K Generated" prominently displayed | Business owners |
| **Process Section** | "How we work" in 4 steps | Prospects evaluating process |
| **Trust Bar** | Client logo strip | Everyone (social proof) |
| **Light Theme** | White background, editorial feel | Designers, brand perception |
| **/work Page** | Filterable case study grid | Prospects browsing portfolio |
| **Tech Stack Labels** | "Built with Laravel, Paystack, Meta Ads" | Technical stakeholders |

---

## 6. For Non-Technical Stakeholders

### What You Need to Know
1. **This is a redesign, not a rebuild.** The "engine" (Laravel) stays. We're changing the "bodywork" (HTML/CSS) and the "story" (content).
2. **It will take ~1 week of development** after content is ready.
3. **You need to provide:**
   - Case study content (client names, metrics, challenge/solution/results)
   - Client logos (with permission)
   - New hero copy (or approve our draft)
   - Any new images (or we use placeholders)
4. **The old site stays live** until we flip the switch. No downtime.
5. **Your email and phone** on the contact page stay the same.

### What You DON'T Need to Worry About
- ❌ Server crashes — no infrastructure changes
- ❌ Losing data — no database changes
- ❌ Broken demos — iframe previews untouched
- ❌ SEO disaster — 301 redirects preserve rankings

---

## 7. For Technical Team

### What You Need to Know
1. **Read `Redesign.md`** — it has file-by-file instructions, component specs, and acceptance criteria.
2. **Branch:** Create `feat/redesign-wabdigital` from `main`.
3. **Constraints:**
   - Use `mix()` not `@vite()`
   - Use `bun` not `npm`
   - Never touch `public/demos/`
   - Follow existing Blade patterns (partials, components, layouts)
4. **New files:** `CaseStudyService`, `CaseStudyController`, workflow diagram component, case study detail page.
5. **Modified files:** Almost every partial and the Tailwind config.
6. **No new dependencies** — pure Tailwind + Blade + optional Alpine.js.

### Architecture Decision Records (ADRs)

**ADR-001: Hardcoded Case Study Data**  
We use a PHP array in `CaseStudyService` (same pattern as `PreviewService`) instead of a database table. Why: case studies change infrequently; no admin panel exists; avoids migration complexity. If we later need a CMS, we migrate to Eloquent models.

**ADR-002: CSS-Only Workflow Diagrams**  
We use Tailwind flexbox + SVG arrows instead of a charting library (D3, Mermaid). Why: zero dependencies, fast render, easy to style, works without JS. If complexity grows, we can upgrade to Mermaid later.

**ADR-003: Keep jQuery for Existing Modules**  
New interactivity (filters, tabs) should use Alpine.js or vanilla JS. Existing jQuery modules (mobile nav, contact form, projects modal) stay as-is to avoid regression.

---

## 8. Open Questions & Blockers

| # | Question | Owner | Status | Impact if Unresolved |
|---|----------|-------|--------|----------------------|
| 1 | Do we have client permission for logos? | Business Dev | ⚠️ Open | Trust bar delayed or skipped |
| 2 | Are case study metrics real or estimated? | Operations | ⚠️ Open | Cannot publish fake numbers |
| 3 | Do we have a dark-text logo variant? | Design | ⚠️ Open | May need to create one |
| 4 | Should products show pricing? | Product | ⚠️ Open | Affects products section design |
| 5 | Do we have client testimonials/quotes? | Business Dev | ⚠️ Open | Case studies less persuasive |
| 6 | Should we add a blog? | Marketing | ⚠️ Open | Out of scope for now; can add later |
| 7 | Which 6-8 case studies do we feature? | Operations | ⚠️ Open | Blocks content population |

### How to Resolve
- **Questions 1, 5, 7:** Business Dev to email clients for permission and quotes.
- **Question 2:** Operations to provide real numbers or approve "representative" metrics with disclaimers.
- **Question 3:** Design to deliver `chada-logo-dark.png` or SVG by Day 1 of dev.
- **Question 4:** Product to decide before Phase 2 (home page build).
- **Question 6:** Marketing to propose blog strategy separately; not a blocker.

---

## 9. Success Metrics

How do we know the redesign worked?

| Metric | Current | Target | How to Measure |
|--------|---------|--------|---------------|
| Homepage bounce rate | ? | -15% | Google Analytics 4 |
| Time on page (home) | ? | +30% | Google Analytics 4 |
| Contact form submissions | ? | +25% | Backend logs |
| "Work" page views | ? | Top 3 pages | Google Analytics 4 |
| Case study detail views | N/A | > 40% of /work visitors | Google Analytics 4 |
| Lighthouse score | ? | ≥ 90 | Chrome DevTools |

*Baseline metrics to be captured before launch.*

---

## 10. Rollback Plan

If something goes wrong:
1. **Code:** `main` branch is untouched. `feat/redesign-wabdigital` can be abandoned.
2. **Assets:** Old assets remain in `public/assets/`. New assets use new filenames.
3. **Database:** No schema changes. Zero rollback risk.
4. **Deployment:** Deploy to staging first. Production switch is a single Git pull + `bun run prod`.
5. **Emergency:** Revert to previous commit: `git revert HEAD` + redeploy.

---

## 11. Glossary for Laymen

| Term | What It Means |
|------|---------------|
| **Blade** | Laravel's HTML templating language |
| **Tailwind** | A CSS framework — think "pre-built styles we combine" |
| **Partial** | A reusable chunk of HTML (like a header or footer) |
| **Component** | A smaller reusable piece (like a button or card) |
| **Laravel Mix** | The tool that compiles our CSS and JS |
| **Bun** | A fast JavaScript package manager (like npm but quicker) |
| **301 Redirect** | Tells Google "this page moved here permanently" |
| **Case Study** | A detailed story of a project: challenge → solution → results |
| **Workflow Diagram** | A visual chart showing steps in a process |
| **Iframe** | A window inside a webpage showing another webpage |
| **OG Image** | The image that appears when you share a link on social media |
| **Honeypot** | A hidden form field that catches spam bots |

---

## 12. Timeline at a Glance

```
Week 1
├── Day 1-2:  Foundation (colors, layout, data layer)
├── Day 3-4:  Home page sections
├── Day 5-6:  Case study pages (/work, /case-study/*)
└── Day 7:    Polish, testing, content review

Week 2
├── Day 8-9:  Stakeholder review + revisions
├── Day 10:   Content finalization
├── Day 11:   Final QA + Lighthouse audit
└── Day 12:   Deploy to production
```

*Content team should deliver case study copy by Day 3.*  
*Design team should deliver logo variant by Day 1.*

---

## 13. Who to Ask

| Role | Responsibility | Contact |
|------|---------------|---------|
| **Product/Design Lead** | Visual direction, approval | [Your name] |
| **Tech Lead** | Architecture, code review | [Developer name] |
| **Business Dev** | Client permissions, metrics | [BD name] |
| **Operations** | Case study data, real numbers | [Ops name] |
| **Marketing** | Copy, SEO, social proof | [Marketing name] |

---

## 14. Reference Links

- **Current site:** https://www.chadadigital.com/
- **Reference site:** https://wabdigital.com/
- **Technical brief:** `Redesign.md` (in this repo)
- **Repo:** `DGCodeIdeas/chada.digital`
- **Laravel docs:** https://laravel.com/docs/12.x
- **Tailwind docs:** https://tailwindcss.com/docs

---

*This document is a living decision log. Update it as questions are resolved, scope changes, or new stakeholders join.*

*Last updated: August 2026*
