# Redesign(9).md — QA, Performance, Originality Compliance, Deployment & Launch Gates

> **Series:** Redesign(1)–(9) · **This doc:** #9 of 9 (execute LAST)
> **Builds:** Nothing (with one optional exception: the consent banner snippet in §5). This document verifies everything docs 1–8 built, then walks the site to production.
> **Depends on:** ALL previous docs merged.
> **New in V4:** this doc now carries the **originality compliance program** — gates 2, 9, 10 and the §4 review protocol exist to make a copyright complaint against this site structurally impossible to substantiate.

```
CONSTRAINTS (repeat in your session — from Redesign(1).md §3):
1.  NEVER touch public/demos/.
2.  mix() not @vite(). 3. bun not npm. 4. ZERO new dependencies.
5.  Preserve route names. 6. Keep contact honeypot. 7. PHP 8.2 constructor
    promotion. 8. Blade components for reusable markup. 9. Follow the Chada
    style charter. 10. Placeholder prose is GENERATED ($real ?? Lorem::…).
11. ORIGINALITY: never copy third-party text/names/prices/metrics; never
    fetch or quote the reference site; these docs are the only reference.
12. Escape apostrophes in single-quoted PHP strings.
13. bun run dev clean after every change; bun run prod before phase done.
14. NEVER invent real-sounding content — this doc's whole job is proving it.
```

---

## 1. Static audits (grep gates — all must pass before deploy)

Run from repo root. Every command prints its expected result.

```bash
# GATE 1 — Zero placeholder leakage into rendered pages.
# (Config + Lorem still hold placeholder content — that is fine. The
#  PENDING/Placeholder *markers* must never reach rendered HTML.)
php artisan view:clear
for p in "/" "/work" "/services"; do
  curl -s "http://127.0.0.1:8000$p" > /tmp/pg.html
  echo "$p: PENDING=$(grep -c 'PENDING' /tmp/pg.html || true) \
        Placeholder=$(grep -c 'Placeholder' /tmp/pg.html || true) \
        Lorem=$(grep -c -i 'lorem ipsum' /tmp/pg.html || true)"
done
# EXPECT: work/services → all 0. Home → Lorem > 0 is EXPECTED while David's
# copy is pending (prose slots render generated lorem by design) — but
# PENDING=0 and Placeholder=0 ALWAYS.

# GATE 2 — No third-party or fabricated content in the DOM (DMCA gate).
# The blocklist below contains distinctive strings known to exist on the
# reference site (its metrics, badge texts, section titles, chrome microcopy)
# plus fabricated-claim patterns. They are DETECTION PATTERNS, never content
# to reproduce. Any hit = investigate + remove + re-review.
for p in "/" "/work" "/services"; do
  curl -s "http://127.0.0.1:8000$p" > /tmp/pg.html
  grep -icE "wab ?digital|wabara|caroline|mantrac|healthtracka|green key|charis|baron bath|manyChat API|Get Results Like This|Auto-?Synchronized|System Backend Workflow|Automated Revenue Systems|Verified Integration|1\.4 seconds|₦200M|40,000\+|1,200%|\\\$343,000|3,834|Book a Strategy Session" /tmp/pg.html
done
# EXPECT: 0 on every page.

# GATE 3 — Demos untouched.
git status --porcelain public/demos/
# EXPECT: empty

# GATE 4 — No Vite anywhere; Mix everywhere.
grep -rn "@vite" resources/views/ ; grep -rln "mix(" resources/views/layouts/ | wc -l
# EXPECT: no @vite hits; layouts hits >= 1

# GATE 5 — Route names preserved.
php artisan route:list
# EXPECT exactly: home, work, case-study.show, preview.show, preview.subpage,
# contact.submit, sitemap, services (+ the two 301 redirects for /showcase).

# GATE 6 — Honeypot intact.
grep -n "website" resources/views/partials/contact-form.blade.php
# EXPECT: the honeypot input still present, field name unchanged,
# ContactController validation untouched (git diff origin/main -- app/Http/Controllers/ContactController.php → empty).

# GATE 7 — Zero new dependencies.
git diff origin/main -- composer.json package.json bun.lock
# EXPECT: empty (or only whitespace/comments).

# GATE 8 — PHP syntax sweep (constraint 12 — the PR #5 lesson).
find app/ config/ routes/ -name "*.php" -exec php -l {} \; | grep -v "No syntax errors"
# EXPECT: no output.

# GATE 9 — Repo-level third-party copy sweep (DMCA gate).
# No file in the repo (code, views, docs, comments) may reference or quote
# the reference site — with ONE sanctioned exception: the blocklist pattern
# in this QA doc and the prohibition statements in Redesign(1).md §3/§8.
grep -riE "wabdigital|wab digital|wabara" --include="*.php" --include="*.blade.php" \
  --include="*.js" --include="*.json" --include="*.md" app/ config/ resources/ routes/ database/ scripts/ docs/ 2>/dev/null
# EXPECT: hits ONLY inside Redesign(9).md gate 2/9 definitions and
# Redesign(1).md prohibition lines. Any other hit = remove it before merge.

# GATE 10 — Emoji-free views (style charter §5.2 rule 5).
grep -rnP "[\x{1F300}-\x{1FAFF}\x{2600}-\x{27BF}\x{1F900}-\x{1F9FF}\x{2B00}-\x{2BFF}]" resources/views/ | wc -l
# EXPECT: 0 — Chada renders SVG line icons, never emoji.

# GATE 11 — Lorem generator integrity (constraints 10 + 14).
grep -rn "Lorem::" resources/views/ | grep -vP "App\\\\Support\\\\Lorem|\bLorem::" | wc -l   # sanity only
php artisan tinker --execute="
use App\Support\Lorem;
\$s = Lorem::sentence('gate11', 12);
echo (preg_match('/\d/', \$s) === 0 ? 'PASS no digits' : 'FAIL digits present'), PHP_EOL;
echo (\$s === Lorem::sentence('gate11', 12) ? 'PASS deterministic' : 'FAIL nondeterministic'), PHP_EOL;"
# EXPECT: PASS / PASS. The generator must never emit digits and must be
# deterministic within a request.

# GATE 12 — No hand-written marketing prose in the data layer.
# config/placeholders.php must contain only seeds, gates, and chrome labels:
awk 'length($0) > 120' config/placeholders.php | grep -vc "^\s*//" 
# EXPECT: 0 (no uncommented line longer than 120 chars — prose fails this).
```

---

## 2. Functional test matrix

| # | Test | How | Pass condition |
|---|---|---|---|
| F1 | Homepage section order | View source of `/` | Sections appear in the exact Redesign(1).md §2.1 order: hero → (stats) → (trust) → goals → audit → working-together → checklist → (webinar) → founder → demo-lab → (blueprints) → (case-studies) → (stats2) → testimonials → martech → exclusivity → contact. Parenthesized = allowed to be absent while content-gated |
| F2 | Demo Lab tabs | Click all 6 tabs on `/` | Panel swaps every time; aria-selected moves; iframe loads; "Open full screen" opens `/preview/{slug}` in a new tab; chrome chip reads "Live demo" |
| F3 | MarTech filter | Click each category pill | Cards filter; empty state appears for an empty category; "All Tools" restores |
| F4 | /work filters | Click each pill | Grid filters by `data-category`; All restores (existing `initShowcaseFilters` behavior) |
| F5 | Case study detail | Temporarily publish one study in a scratch branch | `/case-study/{slug}` renders all populated sections; PENDING fields render nothing; "View Live Demo" hits `/preview/{preview_slug}` |
| F6 | Contact form | Submit valid + invalid + honeypot-triggered payloads | Existing behavior unchanged (AJAX success toast / validation errors / honeypot silently drops) |
| F7 | Mobile nav | Hamburger at <1024px | Opens/closes; same 4 links + CTA |
| F8 | Chat widget | Hover; click | While number null: popover shows generated persona, click does nothing (documented no-op). After Q8: opens wa.me thread with prefill |
| F9 | 301 redirect | `curl -I /showcase` | 301 → `/work` |
| F10 | Sitemap | `curl /sitemap.xml` | Contains home, /work, /services, published case-study slugs, 6 preview URLs; XML valid |
| F11 | 404 | Visit `/case-study/does-not-exist` | Branded 404 page (existing `errors/404.blade.php`) |
| F12 | 503 | `php artisan down` then visit | Branded 503 renders with maintenance.css; `php artisan up` restores |
| F13 | Lorem rotation | Change `placeholders.lorem_seed` on a scratch branch; reload `/` | All placeholder prose changes; structure unchanged; revert |

---

## 3. Performance budget (Lighthouse)

**Targets (mobile, throttled):**

| Metric | Budget | Rationale |
|---|---|---|
| Performance | ≥ 90 | The V4 homepage is heavier (6 lazy iframes), so protect headroom |
| Accessibility | ≥ 95 | All new sections carry aria labels, alt text, tab roles |
| Best Practices | ≥ 95 | No console errors, no deprecated APIs |
| SEO | ≥ 95 | Meta/canonical/JSON-LD from Redesign(8) |
| Page weight | ≤ 1.5 MB transferred (home, cold) | Iframes load lazily and count toward the frame, not the parent, in Lighthouse |
| LCP element | Hero H1 or CTA | Keep the hero text-only (it already is) |

**Measure:** `npx lighthouse http://127.0.0.1:8000 --preset=desktop --output=json` (or Chrome DevTools, mobile throttling). Run twice, take the second. Record the score in the PR.

**Known risks & mitigations (already designed in):**
- 6 lazy iframes → `loading="lazy"` on all; only the first panel is in view
- Google Fonts (Outfit/Inter/Playfair) → already `preconnect` + `preload as=style` in `fonts.blade.php`; Playfair Display is still unused by any rendered section — if David rejects Playfair usage (V1 OD-015 leftover decision), drop its weights from the font URL and save ~30 KB
- SVG icons everywhere (V4 replaced the emoji approach) → near-zero cost, cacheable markup

**Baseline discipline:** capture the CURRENT production Lighthouse score before deploying V4. Without a baseline you cannot prove improvement — record both numbers in the launch PR.

---

## 4. Originality compliance review (the DMCA program)

This is the section that makes the Tech Lead sleep at night. The build replicates a **conversion architecture** (uncopyrightable functional patterns); the review below proves the **expression** is Chada's own. Run it once before launch, and re-run it whenever a new section or real content lands.

**4.1 Automated proof (already enforced by gates):**
- Gate 2: the rendered DOM contains none of the reference site's distinctive strings.
- Gate 9: the repo contains no third-party site references outside the sanctioned blocklist/prohibition lines.
- Gate 10: no emoji fingerprints; all iconography is Chada's SVG set.
- Gate 11 + the Lorem model: placeholder prose is generated from a public-domain word bank — it cannot coincide with anyone's marketing copy.

**4.2 Manual side-by-side review (Tech Lead, ~30 minutes, document in the launch PR):**

| Check | Method | Pass condition |
|---|---|---|
| Section titles | Compare the V4 section titles list against the reference site's | Every title differs in wording, not just casing ("System Blueprints", "See the systems in action.", "Ways to work with us.") |
| Headlines & CTAs | Read each section's H1/H2 and primary CTA aloud | No shared distinctive phrase; shared words are only generic function words ("Get Started" class) |
| Visual gestalt | Screenshot both homepages side by side | Different typography, color palette, spacing rhythm, card treatment at a glance — Chada's tokens, not theirs |
| Content provenance | For every shipped fact (metric, price, quote, client): trace to a TODO-Placeholders row with a named owner | Every shipped fact is Chada-verified or absent |
| Style charter drift | Re-read Redesign(1).md §5.2 against the live build | All eight composition rules hold |

**4.3 Standing rules (enforced in review, forever):**
- The V3 doc series and any file quoting third-party site copy must never enter the repo (gate 9 catches it).
- Nobody fetches the reference site during the build (Redesign(1).md §8 rule 8). If a reviewer wants a comparison for the §4.2 review, the **Tech Lead** performs it manually in a browser that touches no repo tooling, and only the pass/fail result is recorded — never quoted text.
- New sections added after V4 follow the same content model: chrome / generated lorem / gated facts. No fourth kind.

---

## 5. NDPA 2023 compliance (Nigeria Data Protection Act)

The site captures personal data via: contact form, webinar opt-in (when enabled), and WhatsApp click-through. Under NDPA 2023:

| Requirement | Status in V4 | Action |
|---|---|---|
| Lawful basis + notice for form data | Partial — the contact form collects name/email/message | Confirm the footer/privacy notice states purpose + retention. A full privacy policy page is recommended; defer with David's sign-off |
| Analytics cookies consent | N/A today — no GA/pixel ships in V4 | **If** analytics are added later, a consent banner becomes mandatory BEFORE the snippet loads. Do not add tracking in this redesign |
| WhatsApp click-to-chat | User-initiated, no data stored by the site | No action |
| Webinar form | Disabled by default; posts through the same contact pipeline | When enabled, same notice as contact form |

**Optional minimal snippet (only if David confirms analytics will run):** a self-hosted, dependency-free banner — do NOT add a third-party consent SaaS (constraint 4). Defer entirely if no analytics: this doc adds nothing to the DOM by default.

---

## 6. Deployment runbook

The pipeline: push to `main` → GitHub Actions → build assets on CI (Bun) → rsync to EC2 `/opt/dstack-panel/projects/chada.digital` → `post-deploy-dstack.sh` on the host. The site is currently under the deliberate maintenance lock (`storage/app/maintenance-lock`).

**Sequence for the V4 launch:**

```bash
# ON YOUR MACHINE — final pre-flight
git checkout main && git pull
bun install --frozen-lockfile && bun run prod   # proves the CI build will pass
php artisan view:clear

# Merge the V4 PR series (docs 2–8 branches, or the squashed phase branches
# per REDESIGN_IMPLEMENTATION.md §Phases). Push main → Actions deploys
# automatically. The maintenance lock KEEPS the site down through the deploy
# (that is its purpose — scripts/maintenance-lock.sh).

# ON EC2 — verify the deploy landed
ssh ubuntu@<EC2_HOST>
cd /opt/dstack-panel/projects/chada.digital
git log -1 --oneline                          # or check deployed revision marker
ls -la public/mix-manifest.json               # fresh timestamp = CI assets synced
sudo -u www-data php artisan about | head -5

# SMOKE TEST THROUGH THE BYPASS URL FIRST (site still locked for the public)
# Visit the maintenance bypass URL and run section F1-F4 from §2, plus the
# §4.2 originality review. The maintenance bypass renders the full site for you.

# WHEN SMOKE TESTS + ORIGINALITY REVIEW PASS — release the world
sudo bash scripts/maintenance-lock.sh off
# → lock file removed, artisan up, future deploys behave normally again
```

**Rollback (worst case):**

```bash
# The redesign is view-layer + config only — zero migrations ran (verify:
# git diff origin/main -- database/migrations/  → empty).
# Roll back by reverting the merge:
git revert -m 1 <merge-commit-sha>
git push origin main        # Actions redeploys the previous site
# If the site must go down during rollback:
sudo bash scripts/maintenance-lock.sh on
```

**Post-deploy watch (first 24h):**
- `tail -f storage/logs/laravel.log` on EC2 — watch for Blade/Model exceptions
- Re-run GATE 1 + GATE 2 against production (no PENDING/Placeholder markers, no third-party strings in rendered HTML)
- Confirm `/sitemap.xml` in a browser
- Submit the contact form once from a real device and confirm the email lands
- Re-run Lighthouse against production and record the score next to the baseline

---

## 7. Launch gate checklist (the human sign-off)

The V4 build is **live-complete** when every box is checked. "Structure-complete" (shippable under maintenance or as a soft launch) requires only the first block.

**Structure-complete (code):**
- [ ] All §1 grep gates pass on production (1–12, including the originality gates 2, 9, 10, 11)
- [ ] All §2 functional tests pass through the bypass URL
- [ ] Lighthouse recorded (baseline + V4), Performance ≥ 90 mobile
- [ ] `public/demos/` untouched; zero new dependencies; route names preserved
- [ ] JSON-LD validates; sitemap valid
- [ ] 503/404 pages render branded
- [ ] §4.2 originality review completed and documented in the launch PR (Tech Lead sign-off)

**Content-complete (David's gates — tracked in TODO-Placeholders.md):**
- [ ] Hero headline + subhead (Q1)
- [ ] Client logos in trust bar (Q2)
- [ ] Six real offers + prices — Pricing blocks light up (Q3)
- [ ] Free-review copy approved
- [ ] Case study metrics + narratives verified → `published => true`, one by one
- [ ] Workflows verified by Tech Lead → `verified => true` (System Blueprints lights up)
- [ ] Stats bars populated (top + bottom)
- [ ] Founder bio + photo (Q6) → `founder.real => true` → JSON-LD Person node activates
- [ ] Testimonials with permission (Q5) — real entries replace lorem cards
- [ ] Standards band principles approved
- [ ] Chat widget: WhatsApp number + persona (Q8) → widget goes live
- [ ] Webinar section: real asset or stays disabled
- [ ] OG image refreshed for the light theme

**Go-live:**
- [ ] Maintenance lock released (`maintenance-lock.sh off`)
- [ ] Post-deploy watch completed (24h)
- [ ] Launch scores recorded in the repo (append to `TODO-Placeholders.md` bottom: Lighthouse before/after)

---

## 8. What was deliberately NOT built (deferred scope)

So nobody re-litigates this in a PR review — these pattern-level features are deferred with reasons, per Redesign(1).md §2.2:

| Feature | Why deferred | Revisit when |
|---|---|---|
| Sales-goal calculator page | No Chada calculator exists; a fake one is worse than none | David wants a lead-gen tool |
| Blog | No content pipeline | Content team exists |
| Webinar / training / shop pages | No programs or products exist | Programs exist |
| Interactive quiz funnels inside demo-lab panels | Chada's real demos already fill the panels with genuine interactivity | A client project needs a bespoke quiz demo |
| Footer currency selector | No dual-currency pricing display | Prices ship in ₦ + $ |
| Free-review slide-out form | The free-review CTA routes to `#contact` — same conversion, less code | Conversion data says a dedicated form outperforms |
| Cookie consent banner | No analytics/tracking ships | Analytics get added (then banner is mandatory, §5) |

## Definition of done (this doc)

- [ ] Every §1 gate green on the deployed revision — including gates 2, 9, 10, 11 (originality program)
- [ ] §2 matrix executed and recorded in the launch PR body (F1–F13)
- [ ] §4.2 originality review executed, documented, signed off by the Tech Lead
- [ ] Lighthouse baseline + V4 scores captured
- [ ] Deploy sequence followed; smoke tests through the bypass URL; lock released only on human sign-off
- [ ] Rollback path documented in the PR; zero migrations confirmed
- [ ] Committed (if the optional consent snippet was built) on `feat/v4-r9` as `chore(v4-r9): QA gates, perf budget, originality program, NDPA review, deploy runbook`

*End of Redesign(9).md — end of the series. The orchestration summary lives in REDESIGN_IMPLEMENTATION.md (v3, Clarified).*
