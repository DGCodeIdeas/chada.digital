<?php

namespace App\Services;

use Illuminate\Support\Collection;

class CaseStudyService
{
    public function all(): array
    {
        return [
            'sterling-vale' => [
                'client' => 'Sterling & Vale',
                'industry' => 'Construction / Corporate',
                'category' => 'Web Development',
                'metric' => '3× Lead Increase',
                'metric_label' => 'Qualified Leads',
                'metrics' => [
                    ['value' => '3×', 'label' => 'Qualified Leads'],
                    ['value' => '2.4s', 'label' => 'Avg. Load Time'],
                    ['value' => '94', 'label' => 'Lighthouse Score'],
                ],
                'tags' => ['Laravel', 'Corporate Branding', 'SEO'],
                'excerpt' => 'A complete digital rebrand and corporate website for a Lagos-based construction firm, replacing a static brochure site with a lead-generating platform.',
                'thumbnail' => '/assets/images/project-sterling.jpg',
                'workflow' => [
                    ['step' => 'Discovery', 'tool' => 'Brand Audit & Strategy'],
                    ['step' => 'Design', 'tool' => 'Figma + Brand Guidelines'],
                    ['step' => 'Build', 'tool' => 'Laravel + Tailwind'],
                    ['step' => 'Launch', 'tool' => 'AWS + Cloudflare'],
                    ['step' => 'Grow', 'tool' => 'SEO + Analytics'],
                ],
                'challenge' => 'Sterling & Vale had an outdated static website that failed to reflect their portfolio scale or capture project inquiries. Prospects couldn\'t view past work, and the contact form routed to a dead email.',
                'solution' => 'We designed and built a fully custom Laravel site with a project portfolio system, integrated contact routing, and on-page SEO optimization. The brand identity was modernized while preserving their established market trust.',
                'results' => 'Post-launch, the site achieved a 94 Lighthouse performance score and a 3× increase in qualified project inquiries within the first quarter. The project gallery became the most-visited section, directly supporting sales conversations.',
                'tools' => ['Laravel', 'Tailwind CSS', 'Figma', 'AWS', 'Cloudflare', 'Google Analytics'],
                'preview_slug' => 'sterling-vale',
            ],
            'apexflow' => [
                'client' => 'ApexFlow',
                'industry' => 'SaaS / AI Automation',
                'category' => 'Funnels',
                'metric' => '68% Trial Conversion',
                'metric_label' => 'Free-to-Paid Rate',
                'metrics' => [
                    ['value' => '68%', 'label' => 'Trial Conversion'],
                    ['value' => '4.2×', 'label' => 'ROAS'],
                    ['value' => '12s', 'label' => 'Onboarding Time'],
                ],
                'tags' => ['SaaS', 'Automation', 'Funnel Design'],
                'excerpt' => 'An AI-powered workflow automation platform that needed a high-converting landing experience to turn ad traffic into trial users.',
                'thumbnail' => '/assets/images/project-apexflow.jpg',
                'workflow' => [
                    ['step' => 'Ads', 'tool' => 'Meta + Google Ads'],
                    ['step' => 'Landing', 'tool' => 'Custom Laravel Page'],
                    ['step' => 'Trial', 'tool' => 'Self-Serve Onboarding'],
                    ['step' => 'Nurture', 'tool' => 'Email Drip (Brevo)'],
                    ['step' => 'Convert', 'tool' => 'Stripe Checkout'],
                ],
                'challenge' => 'ApexFlow was driving paid traffic to a generic homepage with no clear trial path. Bounce rates were high, and the free-to-paid conversion rate was below industry benchmarks.',
                'solution' => 'We built a dedicated landing funnel with a self-serve trial signup, automated email nurture sequences via Brevo, and a streamlined Stripe checkout for plan upgrades. The entire flow was instrumented for analytics.',
                'results' => 'The new funnel lifted trial-to-paid conversion from 22% to 68%. Average onboarding completion time dropped to under 12 seconds. The paid acquisition campaign achieved a 4.2× return on ad spend.',
                'tools' => ['Laravel', 'Stripe', 'Brevo', 'Meta Ads', 'Google Ads', 'Plausible'],
                'preview_slug' => 'apexflow',
            ],
            'elysian' => [
                'client' => 'ELYSIAN',
                'industry' => 'Hospitality / Hotel & Spa',
                'category' => 'Web Development',
                'metric' => '40% Direct Bookings',
                'metric_label' => 'vs. OTA Commissions',
                'metrics' => [
                    ['value' => '40%', 'label' => 'Direct Bookings'],
                    ['value' => '₦0', 'label' => 'OTA Commission on Direct'],
                    ['value' => '4.9★', 'label' => 'Guest Review Score'],
                ],
                'tags' => ['Booking System', 'Hospitality', 'Payment Integration'],
                'excerpt' => 'A luxury hotel and spa brand that needed to shift bookings away from third-party platforms and capture direct reservations with a seamless guest experience.',
                'thumbnail' => '/assets/images/project-elysian.jpg',
                'workflow' => [
                    ['step' => 'Search', 'tool' => 'SEO + Google Ads'],
                    ['step' => 'Browse', 'tool' => 'Immersive Gallery'],
                    ['step' => 'Book', 'tool' => 'Real-Time Availability'],
                    ['step' => 'Pay', 'tool' => 'Paystack Integration'],
                    ['step' => 'Confirm', 'tool' => 'Auto WhatsApp + Email'],
                ],
                'challenge' => 'ELYSIAN relied heavily on Online Travel Agencies (OTAs) that charged 15–25% commission per booking. Their existing website had no real-time availability or integrated payment, forcing guests to call or email.',
                'solution' => 'We built a custom booking platform with real-time room availability, Paystack payment integration, and automated confirmation flows via WhatsApp and email. The visual design emphasized the brand's luxury positioning.',
                'results' => 'Direct bookings rose to 40% of total reservations, eliminating OTA commissions on those transactions. Guest satisfaction scores improved to 4.9★, with many reviewers citing the seamless booking experience.',
                'tools' => ['Laravel', 'Paystack', 'WhatsApp API', 'Tailwind CSS', 'Google Ads'],
                'preview_slug' => 'elysian',
            ],
            'hirebase' => [
                'client' => 'HIREBASE',
                'industry' => 'Recruitment / HR Tech',
                'category' => 'Web Development',
                'metric' => '2,100+ Placements',
                'metric_label' => 'First 8 Months',
                'metrics' => [
                    ['value' => '2,100+', 'label' => 'Placements'],
                    ['value' => '3 days', 'label' => 'Avg. Time-to-Hire'],
                    ['value' => '89%', 'label' => 'Employer Satisfaction'],
                ],
                'tags' => ['Job Board', 'Recruitment', 'SaaS'],
                'excerpt' => 'A recruitment platform connecting African talent with global employers, built to handle high-volume applications and employer self-service job posting.',
                'thumbnail' => '/assets/images/project-hirebase.jpg',
                'workflow' => [
                    ['step' => 'Post', 'tool' => 'Employer Dashboard'],
                    ['step' => 'Match', 'tool' => 'Smart Filtering'],
                    ['step' => 'Apply', 'tool' => '1-Click Application'],
                    ['step' => 'Screen', 'tool' => 'Automated Shortlist'],
                    ['step' => 'Hire', 'tool' => 'Interview Scheduling'],
                ],
                'challenge' => 'HIREBASE needed to replace a basic WordPress job board that couldn\'t handle application volume or provide employers with self-service tools. Manual screening was bottlenecking growth.',
                'solution' => 'We built a custom Laravel job board with employer dashboards, smart candidate filtering, 1-click applications, and automated shortlisting. The platform was designed for mobile-first usage given the target demographic.',
                'results' => 'The platform facilitated over 2,100 successful placements in its first 8 months. Average time-to-hire dropped to 3 days, and employer satisfaction reached 89%. The self-service model reduced operational overhead by 60%.',
                'tools' => ['Laravel', 'MySQL', 'Tailwind CSS', 'AWS', 'SendGrid'],
                'preview_slug' => 'hirebase',
            ],
            'noir' => [
                'client' => 'NOIR',
                'industry' => 'E-Commerce / Fashion',
                'category' => 'Funnels',
                'metric' => '1,200% Sales Increase',
                'metric_label' => 'In 90 Days',
                'metrics' => [
                    ['value' => '1,200%', 'label' => 'Sales Increase'],
                    ['value' => '₦0', 'label' => 'Ad Spend (Organic)'],
                    ['value' => '4.5★', 'label' => 'Product Reviews'],
                ],
                'tags' => ['E-Commerce', 'Organic Growth', 'CRO'],
                'excerpt' => 'A fashion e-commerce brand that replaced a static product catalog with an interactive, conversion-optimized shopping experience — entirely through organic channels.',
                'thumbnail' => '/assets/images/project-noir.jpg',
                'workflow' => [
                    ['step' => 'Discover', 'tool' => 'Instagram + TikTok'],
                    ['step' => 'Browse', 'tool' => 'Lookbook + Filters'],
                    ['step' => 'Quiz', 'tool' => 'Style Matcher'],
                    ['step' => 'Cart', 'tool' => 'Paystack Checkout'],
                    ['step' => 'Retain', 'tool' => 'Email + SMS'],
                ],
                'challenge' => 'NOIR had a beautiful product line but a static Shopify site that treated every visitor the same. There was no personalization, no style guidance, and checkout abandonment was over 70%.',
                'solution' => 'We redesigned the storefront with an interactive style quiz that auto-recommended outfits, a streamlined Paystack checkout, and post-purchase retention flows via email and SMS. All growth was organic — zero ad spend.',
                'results' => 'Sales increased 1,200% in 90 days without any paid advertising. The style quiz became the primary entry point, with 68% of quiz-takers adding a recommended item to cart. Checkout abandonment dropped to 34%.',
                'tools' => ['Shopify', 'Paystack', 'Klaviyo', 'TikTok Shop', 'Instagram'],
                'preview_slug' => 'noir',
            ],
            'timber-mill' => [
                'client' => 'TimberMill',
                'industry' => 'Artisan / Bespoke Furniture',
                'category' => 'Web Development',
                'metric' => '5× Inquiry Volume',
                'metric_label' => 'Custom Orders',
                'metrics' => [
                    ['value' => '5×', 'label' => 'Inquiry Volume'],
                    ['value' => '100%', 'label' => 'Portfolio Online'],
                    ['value' => '2.1s', 'label' => 'Page Load'],
                ],
                'tags' => ['Artisan', 'Portfolio', 'Custom Orders'],
                'excerpt' => 'A bespoke furniture studio that needed a digital portfolio to showcase craftsmanship and capture custom order inquiries from design-conscious buyers.',
                'thumbnail' => '/assets/images/project-timbermill.jpg',
                'workflow' => [
                    ['step' => 'Discover', 'tool' => 'Instagram + Pinterest'],
                    ['step' => 'Browse', 'tool' => 'Immersive Portfolio'],
                    ['step' => 'Inquire', 'tool' => 'Custom Order Form'],
                    ['step' => 'Consult', 'tool' => 'WhatsApp + Video Call'],
                    ['step' => 'Deliver', 'tool' => 'Logistics Integration'],
                ],
                'challenge' => 'TimberMill relied entirely on Instagram DMs and word-of-mouth. Prospects couldn\'t browse the full catalog, and the inquiry process was manual and inconsistent. High-value custom orders were being lost to competitors with better digital presence.',
                'solution' => 'We built a visually rich portfolio site with high-resolution imagery, a structured custom order form that captured dimensions, wood preferences, and budget, and integrated WhatsApp for direct consultation.',
                'results' => 'Custom order inquiries increased 5× within the first two months. The portfolio became the primary sales tool, with 80% of new clients referencing specific pieces they saw online. Page load time stayed under 2.1s even with heavy imagery.',
                'tools' => ['Laravel', 'Tailwind CSS', 'Cloudflare Images', 'WhatsApp API', 'Google Analytics'],
                'preview_slug' => 'timber-mill',
            ],
        ];
    }

    public function exists(string $slug): bool
    {
        return array_key_exists($slug, $this->all());
    }

    public function get(string $slug): ?array
    {
        return $this->all()[$slug] ?? null;
    }

    public function collection(): Collection
    {
        return collect($this->all());
    }

    public function featured(int $limit = 3): Collection
    {
        return $this->collection()->take($limit);
    }

    public function byCategory(string $category): Collection
    {
        return $this->collection()->filter(fn ($s) => ($s['category'] ?? '') === $category);
    }
}
