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
                // PENDING DAVID — one-liner excerpt. R5's result card renders
                // the excerpt when populated; null here = empty card.
                'excerpt' => null,
                'thumbnail' => '/assets/images/project-sterling.jpg',
                'preview_slug' => 'sterling-vale',
                'published' => false,
                // PENDING DAVID — one paragraph each. R5 guards filter these
                // out (empty() + !str_starts_with 'PENDING'). Keeping them
                // null here means no guard-prefix needed in the value.
                'challenge' => null,   // PENDING DAVID — client problem this build solved.
                'solution' => null,    // PENDING DAVID — what Chada built.
                'results' => null,     // PENDING DAVID — verified outcomes.
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
                'tools' => ['Laravel', 'Tailwind CSS', 'jQuery'],
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
                'excerpt' => null,
                'thumbnail' => '/assets/images/project-apexflow.jpg',
                'preview_slug' => 'apexflow',
                'published' => false,
                'challenge' => null, // PENDING DAVID — one paragraph.
                'solution' => null,  // PENDING DAVID — one paragraph.
                'results' => null,   // PENDING DAVID — verified outcomes only.
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
                'tools' => ['Laravel', 'React', 'Tailwind CSS'],
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
                'excerpt' => null,
                'thumbnail' => '/assets/images/project-elysian.jpg',
                'preview_slug' => 'elysian',
                'published' => false,
                'challenge' => null, // PENDING DAVID — one paragraph.
                'solution' => null,  // PENDING DAVID — one paragraph.
                'results' => null,   // PENDING DAVID — verified outcomes only.
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
                'tools' => ['Laravel', 'Tailwind CSS', 'Paystack'],
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
                'excerpt' => null,
                'thumbnail' => '/assets/images/project-hirebase.jpg',
                'preview_slug' => 'hirebase',
                'published' => false,
                'challenge' => null, // PENDING DAVID — one paragraph.
                'solution' => null,  // PENDING DAVID — one paragraph.
                'results' => null,   // PENDING DAVID — verified outcomes only.
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
                'tools' => ['Laravel', 'React', 'Tailwind CSS'],
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
                'excerpt' => null,
                'thumbnail' => '/assets/images/project-noir.jpg',
                'preview_slug' => 'noir',
                'published' => false,
                'challenge' => null, // PENDING DAVID — one paragraph.
                'solution' => null,  // PENDING DAVID — one paragraph.
                'results' => null,   // PENDING DAVID — verified outcomes only.
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
                'tools' => ['Laravel', 'Tailwind CSS', 'Paystack'],
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
                'excerpt' => null,
                'thumbnail' => '/assets/images/project-timbermill.jpg',
                'preview_slug' => 'timber-mill',
                'published' => false,
                'challenge' => null, // PENDING DAVID — one paragraph.
                'solution' => null,  // PENDING DAVID — one paragraph.
                'results' => null,   // PENDING DAVID — verified outcomes only.
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
                'tools' => ['Laravel', 'Tailwind CSS'],
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
