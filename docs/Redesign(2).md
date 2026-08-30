# Redesign(2).md — Data Layer: Lorem Generator + CaseStudyService v2 + placeholders.php v4

> **Series:** Redesign(1)–(9) · **This doc:** #2 of 9
> **Builds:** `app/Support/Lorem.php` (NEW), `app/Services/CaseStudyService.php` (full replacement), `config/placeholders.php` (full replacement), `TODO-Placeholders.md` (append rows)
> **Depends on:** Redesign(1).md (context — especially §4 content model). No other build doc.
> **Why first:** Every homepage section built in docs 3–8 renders its prose through `Lorem` and reads its gates from these two files. Get the data layer right and the rest is markup.

```
CONSTRAINTS (repeat in your session — from Redesign(1).md §3):
1.  NEVER touch public/demos/.
2.  mix() not @vite(). 3. bun not npm. 4. ZERO new dependencies
    (App\Support\Lorem is pure PHP — allowed).
5.  Preserve route names. 6. Keep contact honeypot. 7. PHP 8.2 constructor
    promotion. 8. Blade components for reusable markup. 9. Follow the Chada
    style charter. 10. Placeholder prose is GENERATED ($real ?? Lorem::…).
11. ORIGINALITY: never copy third-party text/names/prices/metrics; never
    fetch or quote the reference site; these docs are the only reference.
12. Escape apostrophes in single-quoted PHP strings — unescaped apostrophes
    caused the Aug 20 production 500 (PR #5 incident).
13. bun run dev clean after every change; bun run prod before phase done.
14. NEVER invent real-sounding content — the Lorem bank has no digits.
```

---

## 0. Content philosophy for this doc (read once)

Two prior incidents define everything below:

- **The PR #5 incident** (merged, broke production, reverted): an agent populated `CaseStudyService` with fabricated metrics attributed to real demo clients. Corrected here by **content gates** — `published`/`verified` flags and null facts, so nothing unverified can render.
- **The V3 DMCA exposure** (caught before commit): the prior doc series quoted the reference site's copy verbatim as build material. Corrected here by **generated lorem** — there is no hand-written marketing prose anywhere in the data layer to leak, and no slot where copied prose could hide.

The three rules this doc enforces:

- **Structure is real and complete.** Every array key the views need exists, with the exact shape the pattern build requires.
- **Prose is generated.** Views call `Lorem::…()` with a stable slot key; rotating `placeholders.lorem_seed` regenerates every placeholder string site-wide without touching a view.
- **Facts are gated.** Prices, stats, metrics, and workflow verification are `null`/`false` until a human flips them.

---

## TASK 0 — Create `app/Support/Lorem.php` (NEW — the dynamic Lorem Ipsum generator)

**Action:** New file. This is the engine behind "all dynamic Lorem Ipsum" (Tech Lead V4 directive). Pure PHP, zero dependencies, deterministic per seed.

**Design notes:**
- The word bank is the classic public-domain lorem ipsum vocabulary — safe by construction, and instantly recognizable as placeholder (nobody mistakes it for real copy, including a plaintiff's lawyer).
- The bank contains **no digits and no currency symbols**, so the generator is structurally incapable of producing a metric, price, or date (constraint 14).
- Deterministic: same key + same global seed ⇒ same string for the whole request (memoized). Pages are stable per deploy — nothing flickers on reload.
- "Dynamic": changing `config('placeholders.lorem_seed')` (one line) regenerates **every** placeholder string on the site. The Tech Lead can rotate placeholder copy at will; views never change.
- No apostrophes can appear in generated output (the bank has none), so constraint 12 is automatically satisfied for generated text.

```php
<?php

namespace App\Support;

/**
 * Lorem — seeded placeholder-text generator (the "dynamic Lorem Ipsum").
 *
 * WHY THIS EXISTS (Tech Lead directive, V4):
 * Every placeholder prose slot on the site renders generated lorem ipsum
 * instead of hand-written marketing copy. Benefits:
 *   - Placeholder copy can never be confused with real copy — or with any
 *     third party's copy. No hand-written prose lives in the codebase, so
 *     there is nowhere for copied text to hide.
 *   - Rotating config('placeholders.lorem_seed') regenerates every
 *     placeholder string site-wide, with zero view changes.
 *   - The word bank contains no digits or currency symbols, so the
 *     generator can never produce a metric, price, or date (constraint 14
 *     is enforced by construction).
 *
 * RULES:
 *   - Deterministic and request-memoized: same key + seed => same string.
 *   - NEVER use this for real content. Real, stable content lives in
 *     service classes (PreviewService / CaseStudyService pattern). When a
 *     slot gets real content, the view's Lorem call becomes the fallback:
 *     {{ $real ?? Lorem::…(key) }} — the slot fallback rule.
 *   - Pure PHP, zero dependencies (constraint 4).
 */
class Lorem
{
    /** Public-domain lorem ipsum word bank — no digits, no proper nouns. */
    private const WORDS = [
        'lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipiscing', 'elit',
        'sed', 'eiusmod', 'tempor', 'incididunt', 'labore', 'dolore', 'magna', 'aliqua',
        'enim', 'minim', 'veniam', 'quis', 'nostrud', 'exercitation', 'ullamco', 'laboris',
        'aliquip', 'commodo', 'consequat', 'duis', 'aute', 'irure', 'reprehenderit',
        'voluptate', 'velit', 'cillum', 'fugiat', 'nulla', 'pariatur', 'excepteur',
        'occaecat', 'cupidatat', 'proident', 'culpa', 'officia', 'deserunt', 'mollit',
        'anim', 'laborum', 'perspiciatis', 'omnis', 'iste', 'natus', 'error',
        'voluptatem', 'accusantium', 'doloremque', 'laudantium', 'totam', 'aperiam',
        'eaque', 'ipsa', 'quae', 'inventore', 'veritatis', 'nemo', 'ipsam',
    ];

    /** @var array<string, string> request-level memoization cache */
    private static array $cache = [];

    /**
     * A run of $count lorem words, deterministic for ($key, global seed).
     */
    public static function words(string $key, int $count): string
    {
        $count = max(1, min($count, 60));

        return self::memoize("w:{$key}:{$count}", function () use ($key, $count) {
            $bank = self::WORDS;
            $total = count($bank);
            $seed = self::seed($key . ':' . self::globalSeed());
            $out = [];
            for ($i = 0; $i < $count; $i++) {
                $seed = ($seed * 1103515245 + 12345) & 0x7fffffff;
                $out[] = $bank[$seed % $total];
            }

            return implode(' ', $out);
        });
    }

    /**
     * A lorem sentence: capitalized, period-terminated.
     */
    public static function sentence(string $key, int $words = 10): string
    {
        return self::memoize("s:{$key}:{$words}", fn () => ucfirst(self::words($key, $words)) . '.');
    }

    /**
     * A lorem paragraph of $sentences sentences, varied length.
     */
    public static function paragraph(string $key, int $sentences = 3, int $wordsPerSentence = 10): string
    {
        return self::memoize("p:{$key}:{$sentences}:{$wordsPerSentence}", function () use ($key, $sentences, $wordsPerSentence) {
            $out = [];
            for ($i = 0; $i < $sentences; $i++) {
                $out[] = self::sentence("{$key}.{$i}", $wordsPerSentence + ($i % 4));
            }

            return implode(' ', $out);
        });
    }

    /**
     * A Title Case lorem string — for card titles, headings, name slots.
     */
    public static function title(string $key, int $words = 4): string
    {
        return self::memoize("t:{$key}:{$words}", function () use ($key, $words) {
            $parts = explode(' ', self::words($key, max(1, min($words, 8))));

            return implode(' ', array_map('ucfirst', $parts));
        });
    }

    /**
     * A two-word Title Case name — for testimonial attribution slots.
     */
    public static function name(string $key): string
    {
        return self::title("{$key}.name", 2);
    }

    /**
     * Flush the memoization cache (useful in tests / tinker).
     */
    public static function flush(): void
    {
        self::$cache = [];
    }

    private static function memoize(string $token, callable $fn): string
    {
        return self::$cache[$token] ??= (string) $fn();
    }

    private static function globalSeed(): string
    {
        return (string) config('placeholders.lorem_seed', 'v4-initial');
    }

    private static function seed(string $key): int
    {
        $hash = crc32($key);

        return $hash === 0 ? 1 : abs($hash);
    }
}
```

**Verify:**

```bash
php -l app/Support/Lorem.php
php artisan tinker --execute="
use App\Support\Lorem;
echo Lorem::sentence('smoke.test', 8) . PHP_EOL;
echo Lorem::title('smoke.test', 4) . PHP_EOL;
echo Lorem::paragraph('smoke.para', 2, 12) . PHP_EOL;
echo Lorem::sentence('smoke.test', 8) . PHP_EOL; // must equal the first line
"
```

Expected: three lorem strings, and line 4 **identical** to line 1 (determinism). No digits anywhere in the output.

**Composer autoload note:** `app/` is PSR-4 mapped to `App\` in a default Laravel 12 app (check `composer.json` autoload psr-4 → `"App\\": "app/"`). `app/Support/` needs no registration. If the mapping differs, STOP and ask the Tech Lead — do not edit `composer.json` (constraint 4).

---

## TASK 1 — Replace `app/Services/CaseStudyService.php`

**Action:** Full file replacement. The current file holds 3 throwaway placeholder entries (`case-study-a/b/c`). Delete them; ship the structure below.

**Design notes:**
- Slugs match the existing `PreviewService` demo slugs exactly (`sterling-vale`, `apexflow`, `elysian`, `hirebase`, `noir`, `timber-mill`) so case studies can deep-link to live demos via `preview_slug`.
- Categories use plain capability vocabulary (`Web Development`, `Funnel Design`, `Marketing Automation`, `Paid Ads`, `SEO`) so the `/work` filter pills are derived from real Chada work.
- `metric` + `metric_label` drive the result card (Redesign(5)). `metrics` (3-slot array) drives the detail page metrics bar.
- All strings avoid unescaped apostrophes (constraint 12). Where an apostrophe is natural, the string is phrased without one.
- The raw array lives in `everything()`; the public `all()` filters to published entries only. Every existing caller (`PageController::home()`, `CaseStudyController`) goes through `collection()`/`get()`/`byCategory()`, so public behavior automatically becomes "published only" with zero controller changes.
- These entries describe **Chada's own demo projects** — original content, not copied from anyone. Narratives and metrics remain gated.

```php
<?php

namespace App\Services;

use Illuminate\Support\Collection;

/**
 * CaseStudyService — single source of truth for case study content.
 *
 * V4 structure. Every entry maps to a real interactive demo in
 * public/demos/{preview_slug}/ (6 entries). Future client case studies
 * copy the block shape (see the "pending slots" comment at the bottom).
 *
 * CONTENT GATES — do not bypass:
 *   - 'published' => false → the entry renders NOWHERE (home grid, /work,
 *     and /case-study/{slug} 404s). Flip to true only when David has
 *     verified the metric and the narrative.
 *   - workflow 'verified' => false → the workflow is a draft. It renders
 *     in the System Blueprints section only after the Tech Lead confirms
 *     every step reflects what was actually built. See verifiedWorkflows().
 *
 * Do NOT invent entries to reach any external site's card count — the
 * grid renders whatever is published. 6 real beats 9 faked.
 */
class CaseStudyService
{
    /**
     * Raw entries, including unpublished. Internal/dev use only.
     */
    public function everything(): array
    {
        return [
            // ─────────────────────────────────────────────────────────────
            // 1. Sterling & Vale — construction firm corporate site (demo)
            // ─────────────────────────────────────────────────────────────
            'sterling-vale' => [
                'client' => 'Sterling & Vale',
                'industry' => 'Construction',
                'category' => 'Web Development',
                'metric' => null, // PENDING DAVID — e.g. lead/inquiry growth. Never ship a guess.
                'metric_label' => 'Result',
                'metrics' => [
                    ['value' => null, 'label' => 'Leads'],      // PENDING DAVID
                    ['value' => null, 'label' => 'Engagement'], // PENDING DAVID
                    ['value' => null, 'label' => 'Delivery'],   // PENDING DAVID
                ],
                'tags' => ['Corporate Website', 'Project Gallery', 'Inquiry Funnel'],
                'excerpt' => 'A portfolio-grade corporate website for a construction firm, built to convert project showcases into qualified inquiries.',
                'thumbnail' => '/assets/images/project-sterling.jpg',
                'preview_slug' => 'sterling-vale',
                'published' => false,
                'challenge' => 'PENDING DAVID — one paragraph on the client problem this build solved.',
                'solution' => 'PENDING DAVID — one paragraph on what Chada built.',
                'results' => 'PENDING DAVID — one paragraph, or 3 bullet points, of verified outcomes.',
                'workflow' => [
                    // DRAFT — Tech Lead sets 'verified' => true only after
                    // confirming each step reflects what was actually built.
                    'verified' => false,
                    'steps' => [
                        ['step' => 'Google Search & SEO', 'tool' => 'Organic'],
                        ['step' => 'Conversion Landing Page', 'tool' => 'Web'],
                        ['step' => 'Project Inquiry Form', 'tool' => 'Capture'],
                        ['step' => 'Lead Routing to Inbox', 'tool' => 'CRM'],
                        ['step' => 'Follow-up Dispatch', 'tool' => 'WhatsApp'],
                    ],
                ],
                'tools' => ['Laravel', 'Bootstrap 5', 'jQuery'],
            ],

            // ─────────────────────────────────────────────────────────────
            // 2. ApexFlow — SaaS / AI automation platform (demo)
            // ─────────────────────────────────────────────────────────────
            'apexflow' => [
                'client' => 'ApexFlow',
                'industry' => 'SaaS / AI Automation',
                'category' => 'Web Development',
                'metric' => null, // PENDING DAVID — e.g. trial signup conversion. Never ship a guess.
                'metric_label' => 'Result',
                'metrics' => [
                    ['value' => null, 'label' => 'Signups'],    // PENDING DAVID
                    ['value' => null, 'label' => 'Activation'], // PENDING DAVID
                    ['value' => null, 'label' => 'Retention'],  // PENDING DAVID
                ],
                'tags' => ['SaaS Platform', 'Onboarding Flow', 'Product Tour'],
                'excerpt' => 'A product-first SaaS marketing site with an interactive onboarding tour that walks prospects to signup.',
                'thumbnail' => '/assets/images/project-apexflow.jpg',
                'preview_slug' => 'apexflow',
                'published' => false,
                'challenge' => 'PENDING DAVID — one paragraph.',
                'solution' => 'PENDING DAVID — one paragraph.',
                'results' => 'PENDING DAVID — verified outcomes only.',
                'workflow' => [
                    'verified' => false,
                    'steps' => [
                        ['step' => 'Targeted Ads', 'tool' => 'Paid'],
                        ['step' => 'Product Landing Page', 'tool' => 'Web'],
                        ['step' => 'Interactive Tour', 'tool' => 'Product'],
                        ['step' => 'Trial Signup Form', 'tool' => 'Capture'],
                        ['step' => 'Onboarding Email Sequence', 'tool' => 'Automation'],
                    ],
                ],
                'tools' => ['Laravel', 'React', 'Material Web'],
            ],

            // ─────────────────────────────────────────────────────────────
            // 3. ELYSIAN — hotel & spa booking (demo)
            // ─────────────────────────────────────────────────────────────
            'elysian' => [
                'client' => 'ELYSIAN',
                'industry' => 'Hospitality',
                'category' => 'Web Development',
                'metric' => null, // PENDING DAVID — e.g. direct-booking share. Never ship a guess.
                'metric_label' => 'Result',
                'metrics' => [
                    ['value' => null, 'label' => 'Bookings'],  // PENDING DAVID
                    ['value' => null, 'label' => 'Occupancy'], // PENDING DAVID
                    ['value' => null, 'label' => 'Revenue'],   // PENDING DAVID
                ],
                'tags' => ['Booking System', 'Availability', 'Payments'],
                'excerpt' => 'A booking experience for a hotel and spa, with real-time availability, package selection, and payment-ready checkout.',
                'thumbnail' => '/assets/images/project-elysian.jpg',
                'preview_slug' => 'elysian',
                'published' => false,
                'challenge' => 'PENDING DAVID — one paragraph.',
                'solution' => 'PENDING DAVID — one paragraph.',
                'results' => 'PENDING DAVID — verified outcomes only.',
                'workflow' => [
                    'verified' => false,
                    'steps' => [
                        ['step' => 'Search & Social Ads', 'tool' => 'Paid'],
                        ['step' => 'Package Landing Page', 'tool' => 'Web'],
                        ['step' => 'Availability Calendar', 'tool' => 'Booking'],
                        ['step' => 'Checkout & Payment', 'tool' => 'Paystack'],
                        ['step' => 'Confirmation & Reminders', 'tool' => 'Automation'],
                    ],
                ],
                'tools' => ['Laravel', 'Bootstrap 5', 'Paystack'],
            ],

            // ─────────────────────────────────────────────────────────────
            // 4. HIREBASE — recruitment / job board (demo)
            // ─────────────────────────────────────────────────────────────
            'hirebase' => [
                'client' => 'HIREBASE',
                'industry' => 'Recruitment',
                'category' => 'Web Development',
                'metric' => null, // PENDING DAVID — e.g. placements or application volume. Never ship a guess.
                'metric_label' => 'Result',
                'metrics' => [
                    ['value' => null, 'label' => 'Applications'], // PENDING DAVID
                    ['value' => null, 'label' => 'Placements'],   // PENDING DAVID
                    ['value' => null, 'label' => 'Time-to-fill'], // PENDING DAVID
                ],
                'tags' => ['Job Board', 'Candidate Flow', 'Filters'],
                'excerpt' => 'A job board platform with faceted search, employer accounts, and a candidate pipeline built for recruiters.',
                'thumbnail' => '/assets/images/project-hirebase.jpg',
                'preview_slug' => 'hirebase',
                'published' => false,
                'challenge' => 'PENDING DAVID — one paragraph.',
                'solution' => 'PENDING DAVID — one paragraph.',
                'results' => 'PENDING DAVID — verified outcomes only.',
                'workflow' => [
                    'verified' => false,
                    'steps' => [
                        ['step' => 'Employer & Candidate Acquisition', 'tool' => 'Organic'],
                        ['step' => 'Job Board Search & Filters', 'tool' => 'Web'],
                        ['step' => 'Application Form', 'tool' => 'Capture'],
                        ['step' => 'Candidate Pipeline', 'tool' => 'CRM'],
                        ['step' => 'Alert Digests', 'tool' => 'Email'],
                    ],
                ],
                'tools' => ['Laravel', 'React', 'Material Web'],
            ],

            // ─────────────────────────────────────────────────────────────
            // 5. NOIR — e-commerce fashion store (demo)
            // ─────────────────────────────────────────────────────────────
            'noir' => [
                'client' => 'NOIR',
                'industry' => 'E-Commerce / Fashion',
                'category' => 'Funnel Design',
                'metric' => null, // PENDING DAVID — e.g. conversion lift or AOV. Never ship a guess.
                'metric_label' => 'Result',
                'metrics' => [
                    ['value' => null, 'label' => 'Conversion'],  // PENDING DAVID
                    ['value' => null, 'label' => 'AOV'],        // PENDING DAVID
                    ['value' => null, 'label' => 'Repeat rate'], // PENDING DAVID
                ],
                'tags' => ['Storefront', 'Style Quiz', 'Checkout'],
                'excerpt' => 'A fashion storefront with a style-guidance flow that routes shoppers to curated collections and a streamlined checkout.',
                'thumbnail' => '/assets/images/project-noir.jpg',
                'preview_slug' => 'noir',
                'published' => false,
                'challenge' => 'PENDING DAVID — one paragraph.',
                'solution' => 'PENDING DAVID — one paragraph.',
                'results' => 'PENDING DAVID — verified outcomes only.',
                'workflow' => [
                    'verified' => false,
                    'steps' => [
                        ['step' => 'Instagram & Meta Ads', 'tool' => 'Paid'],
                        ['step' => 'Style Quiz Entry', 'tool' => 'Funnel'],
                        ['step' => 'Curated Collection View', 'tool' => 'Web'],
                        ['step' => 'Cart & Checkout', 'tool' => 'Paystack'],
                        ['step' => 'Post-purchase Flow', 'tool' => 'Automation'],
                    ],
                ],
                'tools' => ['Laravel', 'Bootstrap 5', 'Paystack'],
            ],

            // ─────────────────────────────────────────────────────────────
            // 6. TimberMill — artisan furniture studio (demo)
            // ─────────────────────────────────────────────────────────────
            'timber-mill' => [
                'client' => 'TimberMill',
                'industry' => 'Artisan / Furniture',
                'category' => 'Web Development',
                'metric' => null, // PENDING DAVID — e.g. inquiry volume or commission value. Never ship a guess.
                'metric_label' => 'Result',
                'metrics' => [
                    ['value' => null, 'label' => 'Inquiries'],        // PENDING DAVID
                    ['value' => null, 'label' => 'Commission value'], // PENDING DAVID
                    ['value' => null, 'label' => 'Catalog views'],    // PENDING DAVID
                ],
                'tags' => ['Catalog', 'Custom Orders', 'Craft Brand'],
                'excerpt' => 'A digital catalog and custom-order funnel for a woodworking studio, moving bespoke commissions off DMs and into a structured pipeline.',
                'thumbnail' => '/assets/images/project-timbermill.jpg',
                'preview_slug' => 'timber-mill',
                'published' => false,
                'challenge' => 'PENDING DAVID — one paragraph.',
                'solution' => 'PENDING DAVID — one paragraph.',
                'results' => 'PENDING DAVID — verified outcomes only.',
                'workflow' => [
                    'verified' => false,
                    'steps' => [
                        ['step' => 'Social Discovery', 'tool' => 'Organic'],
                        ['step' => 'Catalog Landing Page', 'tool' => 'Web'],
                        ['step' => 'Custom Order Form', 'tool' => 'Capture'],
                        ['step' => 'Quote Pipeline', 'tool' => 'CRM'],
                        ['step' => 'Deposit Invoice', 'tool' => 'Payments'],
                    ],
                ],
                'tools' => ['Laravel', 'Bootstrap 5'],
            ],

            // ─────────────────────────────────────────────────────────────
            // 7+. Pending slots — future client case studies.
            // Copy the block shape above when real clients are added.
            // ─────────────────────────────────────────────────────────────
        ];
    }

    /**
     * Published entries only. This is what every public view consumes.
     */
    public function all(): array
    {
        return array_filter($this->everything(), fn ($item) => ($item['published'] ?? false) === true);
    }

    public function exists(string $slug): bool
    {
        return array_key_exists($slug, $this->all());
    }

    public function get(string $slug): ?array
    {
        return $this->all()[$slug] ?? null;
    }

    /**
     * Published entries as a Collection. Views receive this as $studies.
     */
    public function collection(): Collection
    {
        return collect($this->all());
    }

    public function byCategory(string $category): array
    {
        if ($category === 'all' || $category === '') {
            return $this->all();
        }

        return array_filter($this->all(), fn ($item) => ($item['category'] ?? null) === $category);
    }

    /**
     * Distinct categories among published entries — drives the /work filter
     * pills dynamically.
     */
    public function categories(): array
    {
        return array_values(array_unique(array_map(
            fn ($item) => $item['category'] ?? 'Other',
            $this->all()
        )));
    }

    /**
     * Workflows for the homepage System Blueprints section
     * (Redesign(4)). Returns only VERIFIED workflows, as
     * ['slug' => ..., 'client' => ..., 'steps' => [...]] pairs.
     */
    public function verifiedWorkflows(): array
    {
        $out = [];
        foreach ($this->all() as $slug => $item) {
            $wf = $item['workflow'] ?? null;
            if ($wf && ($wf['verified'] ?? false) === true && ! empty($wf['steps'])) {
                $out[] = ['slug' => $slug, 'client' => $item['client'], 'steps' => $wf['steps']];
            }
        }

        return $out;
    }
}
```

**⚠️ PHP syntax check (do not skip):**

```bash
php -l app/Services/CaseStudyService.php
php artisan tinker --execute="app(\App\Services\CaseStudyService::class)->everything(); app(\App\Services\CaseStudyService::class)->collection(); app(\App\Services\CaseStudyService::class)->verifiedWorkflows();"
```

Expected: `No syntax errors detected` · tinker prints the 6 raw entries for `everything()`, `[]` for `collection()` and `verifiedWorkflows()` (nothing published yet — correct).

---

## TASK 2 — Replace `config/placeholders.php`

**Action:** Full file replacement. This version contains **no hand-written marketing prose at all** — only the lorem seed, gates (null/false), and short Chada chrome labels. Prose slots are generated in the views via `Lorem` (docs 3–8). Every key removed versus the old file is either replaced by a Lorem slot or was a prose string that must not exist as data.

```php
<?php

// TEMPORARY PLACEHOLDER CONTENT — lorem-ipsum policy, approved Aug 20 2026.
// V4 MODEL (Redesign(2)): this file holds ONLY three kinds of value:
//   1. lorem_seed — rotate the string => every generated placeholder on the
//      site regenerates (dynamic Lorem Ipsum, Tech Lead directive).
//   2. GATES — null/false values that hide facts or whole sections until a
//      human sets them (see TODO-Placeholders.md for every gate's owner).
//   3. CHROME — short Chada-original UI labels: buttons, eyebrows, badges,
//      tier names. Never marketing prose, never third-party wording.
//
// Hand-written marketing prose is FORBIDDEN in this file. Prose slots render
// $real ?? \App\Support\Lorem::…(key) in the views. Real, stable content
// lives in service classes (PreviewService / CaseStudyService pattern).
//
// RULES:
//  - null price  → views render the "Contact for pricing" fallback.
//  - null stats  → the stats-bar partial renders nothing (guarded).
//  - enabled=false → the section renders nothing at all.

return [
    // ── 1. Dynamic lorem ────────────────────────────────────────────────
    // Rotate this value (any new string) to regenerate ALL placeholder
    // prose site-wide. Document each rotation in TODO-Placeholders.md.
    'lorem_seed' => 'v4-initial',

    // ── 2. Chrome (Chada-original UI labels) ────────────────────────────
    'hero' => [
        // Eyebrow + headline + subhead are lorem slots (view-generated).
        // The eyebrow "Based in Lagos · Serving the World" is pre-existing
        // approved Chada copy and stays inline in the view.
        'primary_cta' => 'Start a Project',
        'secondary_cta' => 'Explore Our Work',
        // GATED proof line: renders nothing while null (needs verification
        // before a "trusted by N" claim ships — constraint 14).
        'proof_line' => null, // e.g. 'Trusted by 50+ brands' — only with proof
    ],

    // ── 3. Gates ────────────────────────────────────────────────────────
    // Stats band pattern: 4 numbers under the hero, repeated near the
    // bottom. Values stay null until David supplies verified numbers —
    // the partial renders nothing while ALL values in a variant are null.
    // Labels below are suggested slot labels ONLY (they render alongside
    // a value; replace them when real numbers land).
    'stats' => [
        'home_top' => [
            ['value' => null, 'label' => 'PENDING DAVID — e.g. Projects Delivered'],
            ['value' => null, 'label' => 'PENDING DAVID — e.g. Clients Served'],
            ['value' => null, 'label' => 'PENDING DAVID — e.g. Industries Covered'],
            ['value' => null, 'label' => 'PENDING DAVID — e.g. Avg. Lighthouse Score'],
        ],
        'home_bottom' => [
            ['value' => null, 'label' => 'PENDING DAVID — e.g. Repeat Clients'],
            ['value' => null, 'label' => 'PENDING DAVID — e.g. Support Response'],
            ['value' => null, 'label' => 'PENDING DAVID — e.g. Systems Shipped'],
            ['value' => null, 'label' => 'PENDING DAVID — e.g. Referral Rate'],
        ],
    ],

    // Tiered offer pattern: six cards. Titles + descriptions are lorem
    // slots (view-generated, keyed offers.0 … offers.5). Badges are
    // Chada chrome. price_ngn / price_usd / price_period stay null until
    // David sets real prices (Open_Decision Q3 + pricing policy). Views
    // show "Contact for pricing" while null — NEVER invent a number.
    'offers' => [
        ['badge' => 'ADVISORY', 'price_ngn' => null, 'price_usd' => null, 'price_period' => null, 'cta_label' => 'Get Started'],
        ['badge' => 'SPRINT', 'price_ngn' => null, 'price_usd' => null, 'price_period' => null, 'cta_label' => 'Get Started'],
        ['badge' => 'BUILD', 'price_ngn' => null, 'price_usd' => null, 'price_period' => null, 'cta_label' => 'Get Started'],
        ['badge' => 'SYSTEM', 'price_ngn' => null, 'price_usd' => null, 'price_period' => null, 'cta_label' => 'Get Started'],
        ['badge' => 'RETAINER', 'price_ngn' => null, 'price_usd' => null, 'price_period' => '/month', 'cta_label' => 'Get Started'],
        ['badge' => 'CARE', 'price_ngn' => null, 'price_usd' => null, 'price_period' => '/month', 'cta_label' => 'Get Started'],
    ],

    // Free-consult CTA: headline + body are lorem slots. CTA is chrome.
    'audit' => [
        'cta_label' => 'Request a Free Review',
    ],

    // Transition band: headline + subhead are lorem slots (view-generated).

    // Capability checklist: the one section carrying REAL content — these
    // items are Chada capabilities derived from the approved services
    // array in partials/services.blade.php (Web Development, Funnel &
    // Automation, Paid Advertising, Brand & Strategy + tool stacks).
    // The intro paragraph is a lorem slot pending approved copy.
    // If an item overclaims, treat it as a content edit — raise it, do
    // not ship it.
    'checklist' => [
        'items' => [
            'Custom websites & web applications',
            'Landing pages & sales pages',
            'Sales funnels & lead capture flows',
            'Marketing automation & workflows',
            'CRM setup & lead routing',
            'Email sequence design',
            'Paid campaign setup & management',
            'Brand identity & design systems',
            'Analytics & conversion tracking',
            'E-commerce storefront builds',
            'Booking & scheduling systems',
            'Care plans & ongoing iteration',
        ],
    ],

    // Gated-content opt-in: Chada has no webinar/replay asset yet, so this
    // section is DISABLED. When enabled, copy comes from David and the form
    // posts to the existing /api/contact endpoint with form_type=webinar
    // (reuses the honeypot-protected pipeline).
    'webinar' => [
        'enabled' => false,
        'cta_label' => 'Get the Replay',
    ],

    // Testimonials: quote/name/role are lorem slots (3 cards) while this
    // array is EMPTY. When David supplies real quotes with permission,
    // each becomes ['quote' => …, 'name' => …, 'role' => …] here and the
    // view renders real entries instead of generated ones.
    'testimonials' => [],

    // Standards band above testimonials (gated — do not invent principles).
    'manifesto' => [
        'enabled' => false,
        'label' => 'Our Standards',
        'items' => [],
    ],

    // Founder block: all prose is lorem while 'real' is false. Flip 'real'
    // => true when the actual bio, photo, and name land (Q6) — this also
    // activates the JSON-LD Person node (Redesign(8)).
    'founder' => [
        'real' => false,
        'photo' => '/assets/images/founder-placeholder.jpg',
        'cta_label' => 'Start a Conversation',
    ],

    // Integrations grid: tools drawn from the approved services stacks —
    // keep this list to tools Chada genuinely works with; add/remove with
    // David. Badges render "READY" (honest) — never a certification claim.
    'martech' => [
        'subintro' => null, // lorem slot until David approves a real line
        'categories' => ['All Tools', 'Websites & Shops', 'Automation', 'Ads', 'Analytics', 'CRM'],
        'tools' => [
            ['category' => 'Websites & Shops', 'name' => 'Laravel + Blade'],
            ['category' => 'Websites & Shops', 'name' => 'WordPress + Shopify'],
            ['category' => 'Automation', 'name' => 'Zapier + Make'],
            ['category' => 'Automation', 'name' => 'ManyChat'],
            ['category' => 'Ads', 'name' => 'Meta Ads + Google Ads'],
            ['category' => 'Ads', 'name' => 'LinkedIn Ads'],
            ['category' => 'Analytics', 'name' => 'Analytics & Goal Tracking'],
            ['category' => 'CRM', 'name' => 'HubSpot'],
            ['category' => 'Websites & Shops', 'name' => 'Paystack Checkout'],
        ],
    ],

    // Closing exclusivity band: lorem slots (view-generated).

    // Persistent chat widget: whatsapp_number stays null until
    // Open_Decision Q8 is answered — while null the widget remains the
    // documented no-op (constraint 14: never wire a guessed number).
    'chat' => [
        'whatsapp_number' => null, // E.164 format when set, e.g. '2348012345678'
        'whatsapp_prefill' => 'Hello Chada Digital — I would like to discuss a project.',
    ],

    // System Blueprints closing speed line: null until David approves a
    // MEASURED claim for a Chada system. Never a borrowed figure.
    'workflow_speed_claim' => null,
];
```

**Verify:**

```bash
php -l config/placeholders.php
php artisan config:clear
php artisan tinker --execute="
dump(config('placeholders.lorem_seed'));
dump(config('placeholders.stats.home_top'));
dump(config('placeholders.offers.0.price_ngn'));
dump(config('placeholders.chat.whatsapp_number'));
dump(config('placeholders.martech.tools'));
"
```

Expected: no syntax errors; `lorem_seed` resolves to `'v4-initial'`; `offers.0.price_ngn` is null; `chat.whatsapp_number` is null; martech tools array has 9 entries.

**Rotation smoke test (proves the "dynamic"):**

```bash
php artisan tinker --execute="echo App\Support\Lorem::sentence('demo', 8), PHP_EOL;"
# edit config: 'lorem_seed' => 'v4-rotation-test'  (scratch only)
php artisan config:clear
php artisan tinker --execute="echo App\Support\Lorem::sentence('demo', 8), PHP_EOL;"
# expect: DIFFERENT string than the first run. Revert the config edit.
```

---

## TASK 3 — Append rows to `TODO-Placeholders.md`

**Action:** Append the block below to the end of `TODO-Placeholders.md` (repo root — do not rewrite the file — append). These rows track every gate and lorem slot introduced by the V4 data layer.

> **Reconciliation note (2026-08-28):** the repo-root `TODO-Placeholders.md` was rewritten upstream (commit `ed76bea`, 2026-08-27) to a V4 gate list that already covers most of the block below (offers, hero proof line, case-study published/workflow gates, stats bars, webinar, founder, chat, services pricing). Before appending, diff this block against the current file and append only rows that are genuinely missing. If everything is already tracked, this task is a no-op — record that in the PR body instead of duplicating rows.

```markdown
---

## V4 additions (Redesign(2).md — lorem generator + gates)

| ✅ | Config key / location | What's needed | Owner | Related |
|---|---|---|---|---|
| ☐ | `CaseStudyService` → 6 × `metric` + `metrics` | One verified headline number per demo client (e.g. lead growth, conversion lift). **Each entry stays `published => false` until its metric lands.** | Founder + Tech Lead | Replaces the old "placeholder" entries |
| ☐ | `CaseStudyService` → 6 × `challenge` / `solution` / `results` | One-paragraph narratives per case study | Founder | — |
| ☐ | `CaseStudyService` → 6 × `workflow.verified` | Tech Lead confirms every workflow step/tool reflects what was actually built, then flips to `true` | Tech Lead | Feeds System Blueprints |
| ☐ | `placeholders.offers.*.price_ngn` / `price_usd` / `price_period` | Real price per offer tier (₦ + $ + period). Views show "Contact for pricing" until set | Founder | Open_Decision Q3 |
| ☐ | `placeholders.stats.home_top` (×4) + `home_bottom` (×4) | Verified numbers + labels. Section hidden until a variant is fully populated | Founder | — |
| ☐ | `placeholders.hero.proof_line` | Verified trust line (or leave null — renders nothing) | Founder | Was hardcoded pre-V4; now gated |
| ☐ | `placeholders.webinar.enabled` | Stays `false` until a real replay/masterclass asset exists | Founder | Open_Decision Q4 family |
| ☐ | `placeholders.testimonials` (array) | Real quotes WITH client permission — each entry replaces a lorem card | Founder | Open_Decision Q5 |
| ☐ | `placeholders.manifesto.enabled` + `items` | David-approved standards/principles | Founder | Do not invent promises |
| ☐ | `placeholders.founder.real` + bio/photo/name | Real founder content (Q6). Flipping `real` also activates the JSON-LD Person node | Founder | Open_Decision Q6 |
| ☐ | `placeholders.martech.tools` + `subintro` | Confirm the tool list matches what Chada genuinely supports; approve intro line | Tech Lead | — |
| ☐ | `placeholders.chat.whatsapp_number` | E.164 WhatsApp number + persona decision (Q8). Widget stays no-op until set | Founder | Open_Decision Q8 |
| ☐ | `placeholders.workflow_speed_claim` | A MEASURED Chada system-speed claim, approved by David | Founder + Tech Lead | Never a borrowed figure |
| ☐ | `placeholders.lorem_seed` | Rotation log: record each rotation date/reason here | Tech Lead | Dynamic lorem control |
```

---

## Definition of done (this doc)

- [ ] `app/Support/Lorem.php` created exactly as specified; `php -l` clean; determinism smoke test passes (same key ⇒ same string); rotation smoke test passes (new seed ⇒ new string)
- [ ] `app/Services/CaseStudyService.php` replaced exactly as specified; `php -l` clean; tinker checks pass (`collection()` and `verifiedWorkflows()` both empty)
- [ ] `config/placeholders.php` replaced exactly as specified; `php -l` clean; `config:clear` run; tinker checks pass; the file contains **zero hand-written marketing prose** (grep it: no sentence longer than ~15 words outside comments)
- [ ] `TODO-Placeholders.md` has the V4 block appended
- [ ] No view file changed yet (that is docs 3–8 — homepage keeps rendering exactly as before until then)
- [ ] `bun run dev` still compiles clean (nothing in the asset pipeline changed, but verify anyway)
- [ ] Committed on `feat/v4-r2` with message `feat(v4-r2): data layer — Lorem generator + CaseStudyService v2 + placeholders v4 + TODO rows`

*End of Redesign(2).md — proceed to Redesign(3).md.*
