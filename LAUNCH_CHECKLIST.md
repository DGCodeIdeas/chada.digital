# Launch Checklist — Chada Digital Redesign

> **Last updated:** 2026-08-20
> **Status:** Pre-launch — content populated, awaiting David approval
> **Branch:** `feat/redesign-wabdigital` (or merge target)

---

## Content Gate (David must approve)

| # | Item | File | Status | Notes |
|---|------|------|--------|-------|
| 1 | Hero headline approved | `partials/hero.blade.php` | 🟡 PENDING | Current: "Help Businesses Grow" — has TODO comment |
| 2 | Case study metrics real | `CaseStudyService.php` | 🟢 POPULATED | 6 case studies with realistic metrics — David to verify |
| 3 | Founder bio approved | `partials/founder.blade.php` | 🟡 PENDING | Generic "Chada Digital Team" — needs real name/bio/photo |
| 4 | Testimonials approved | `partials/testimonials.blade.php` | 🟡 PENDING | Realistic but not from actual clients — needs permission |
| 5 | Client logos sourced | `partials/trust-bar.blade.php` | 🔴 EMPTY | `$clientLogos = []` — renders nothing until populated |
| 6 | OG image reviewed | `public/og-image.jpg` | 🟡 PENDING | Exists but unreviewed |
| 7 | Meta description approved | `PageController.php` | 🟡 PENDING | Current copy unapproved |
| 8 | Products section fate | `partials/products.blade.php` | 🟡 PENDING | 4 fictional products still shown — hide or reframe? |
| 9 | Stats numbers verified | `partials/stats.blade.php` | 🟡 PENDING | 50+ projects, 6+ industries, 3+ years, 95% retention |
| 10 | MarTech list confirmed | `partials/martech.blade.php` | 🟢 POPULATED | 24 tools across 8 categories — verify all used in last 12mo |

---

## Technical Gate (Tech Lead must verify)

| # | Item | How to Verify | Status |
|---|------|--------------|--------|
| 1 | `bun run prod` builds cleanly | Run command, check exit code | ⬜ |
| 2 | No new Composer dependencies | `git diff composer.json` should be empty | ✅ |
| 3 | No new npm dependencies | `git diff package.json` should be empty | ✅ |
| 4 | `public/demos/` untouched | `git status public/demos/` — no changes | ✅ |
| 5 | All routes respond 200 | `php artisan serve` + curl each route | ⬜ |
| 6 | `/showcase` 301 redirects to `/work` | `curl -I /showcase` → 301 Location: /work | ⬜ |
| 7 | Sitemap includes `/work` + case studies | View `/sitemap.xml`, count URLs | ⬜ |
| 8 | Contact form submits successfully | Submit test message, verify JSON response | ⬜ |
| 9 | Mobile nav works | Test on iOS Safari + Android Chrome | ⬜ |
| 10 | Lighthouse ≥ 90 (mobile) | Chrome DevTools → Lighthouse → Mobile | ⬜ |
| 11 | Lighthouse ≥ 90 (desktop) | Chrome DevTools → Lighthouse → Desktop | ⬜ |
| 12 | No console errors | Open DevTools, refresh, check Console | ⬜ |
| 13 | All images have alt text | `grep -r "<img" resources/views/ | grep -v "alt="` should be empty | ⬜ |
| 14 | Keyboard navigable | Tab through every interactive element | ⬜ |
| 15 | Preview iframe loads all 6 demos | Visit `/preview/{slug}` for each slug | ⬜ |

---

## SEO Gate

| # | Item | Status |
|---|------|--------|
| 1 | Meta titles unique per page | ⬜ |
| 2 | Meta descriptions present | ⬜ |
| 3 | Canonical URLs correct | ⬜ |
| 4 | OG image renders on WhatsApp/Twitter | ⬜ |
| 5 | JSON-LD structured data valid | ⬜ |
| 6 | `/robots.txt` unchanged | ✅ |

---

## Deploy Gate

| # | Item | Status |
|---|------|--------|
| 1 | Staging deploy successful | ⬜ |
| 2 | Smoke test on staging | ⬜ |
| 3 | `scripts/post-deploy.sh` runs without error | ⬜ |
| 4 | Production backup confirmed | ⬜ |
| 5 | GitHub Actions pipeline green | ⬜ |
| 6 | Rollback plan documented | ⬜ |

---

## Post-Launch (Week 1)

| # | Item | Tool | Target |
|---|------|------|--------|
| 1 | Monitor error logs | `tail -f storage/logs/laravel.log` | Zero new errors |
| 2 | Track homepage bounce rate | Google Analytics 4 | Baseline + compare |
| 3 | Track contact form submissions | Backend logs | ≥ baseline |
| 4 | Track `/work` page views | GA4 | Top 3 pages |
| 5 | Track case study detail views | GA4 | > 30% of /work visitors |
| 6 | Re-run Lighthouse | Chrome DevTools | ≥ 90 |

---

## Rollback Plan

If critical issues are found post-deploy:

1. **Immediate:** `git revert HEAD` on `main`, push, trigger deploy
2. **Assets:** Old assets remain in `public/assets/` — new assets use new filenames
3. **Database:** Zero schema changes — no DB rollback needed
4. **Routes:** Old `/showcase` route would need to be restored if `/work` fails
5. **DNS/infra:** No changes — rollback is purely code-level

---

## Sign-off

| Role | Name | Date | Signature |
|------|------|------|-----------|
| Product/Design Lead | | | |
| Tech Lead | | | |
| Founder | David | | |
| Marketing | | | |

---

*Do not deploy to production until all 🟡 and 🔴 items are resolved and signed off.*
