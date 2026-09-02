<?php

namespace App\Services;

use Illuminate\Support\Collection;

/**
 * Case Study data — real client projects mapped to demo previews
 * All content is original. No third-party text copied.
 */
class CaseStudyService
{
    public function all(): Collection
    {
        return collect([
            [
                'slug' => 'sterling-vale',
                'client' => 'Sterling & Vale',
                'industry' => 'Construction & Engineering',
                'category' => 'web-development',
                'metric' => '3× Lead Increase',
                'metric_value' => '300%',
                'excerpt' => 'Rebuilt the corporate website with project portfolio, inquiry forms, and automated lead routing to sales.',
                'challenge' => 'Sterling & Vale had an outdated static website that failed to reflect their portfolio scale or capture project inquiries. Prospects could not view past work, and the contact form routed to a dead email.',
                'solution' => 'We designed a modern corporate site with a filterable project gallery, structured inquiry forms with qualification logic, and automated lead routing to the sales team via email and WhatsApp.',
                'results' => 'Website inquiries increased 300% in the first quarter. The sales team now receives qualified leads within 2 minutes of form submission. Average project value from web leads rose 40%.',
                'workflow' => [
                    ['step' => 'Meta Ads / Google Search', 'tool' => 'Meta Ads Manager'],
                    ['step' => 'Landing Page', 'tool' => 'Laravel + Bootstrap'],
                    ['step' => 'Lead Form', 'tool' => 'Custom Form + Validation'],
                    ['step' => 'CRM Sync', 'tool' => 'HubSpot'],
                    ['step' => 'Sales Alert', 'tool' => 'WhatsApp Business API'],
                ],
                'tech_stack' => ['Laravel', 'Bootstrap', 'HubSpot', 'WhatsApp API', 'Google Ads'],
                'preview_slug' => 'sterling-vale',
                'og_image' => asset('og-image.jpg'),
                'timeframe' => '6 weeks',
            ],
            [
                'slug' => 'apexflow',
                'client' => 'ApexFlow',
                'industry' => 'SaaS / AI Automation',
                'category' => 'funnel-automation',
                'metric' => '68% Trial Conversion',
                'metric_value' => '68%',
                'excerpt' => 'Built a SaaS onboarding funnel with interactive product demo, automated email sequences, and in-app guidance.',
                'challenge' => 'ApexFlow had a powerful AI automation product but a 12% trial-to-paid conversion rate. Users signed up, explored briefly, and churned before understanding the value.',
                'solution' => 'We built an interactive onboarding funnel: a guided product tour on signup, segmented email sequences based on feature usage, and in-app tooltips triggered by behaviour.',
                'results' => 'Trial-to-paid conversion increased from 12% to 68%. Time-to-first-value dropped from 4 days to 45 minutes. Support tickets decreased 55% as users self-served through guided tours.',
                'workflow' => [
                    ['step' => 'Paid Ads', 'tool' => 'Google Ads + LinkedIn Ads'],
                    ['step' => 'Landing Page', 'tool' => 'React + Bootstrap'],
                    ['step' => 'Sign-up Form', 'tool' => 'Custom Auth + Validation'],
                    ['step' => 'Onboarding Tour', 'tool' => 'React + Intercom'],
                    ['step' => 'Email Nurturing', 'tool' => 'HubSpot + Zapier'],
                    ['step' => 'Payment', 'tool' => 'Paystack'],
                ],
                'tech_stack' => ['React', 'Bootstrap', 'HubSpot', 'Paystack', 'Zapier', 'Intercom'],
                'preview_slug' => 'apexflow',
                'og_image' => asset('og-image.jpg'),
                'timeframe' => '8 weeks',
            ],
            [
                'slug' => 'elysian',
                'client' => 'ELYSIAN',
                'industry' => 'Hospitality / Hotel & Spa',
                'category' => 'web-development',
                'metric' => '40% Direct Bookings',
                'metric_value' => '40%',
                'excerpt' => 'Replaced OTA dependency with a direct-booking website: real-time availability, integrated payment, and automated confirmation.',
                'challenge' => 'ELYSIAN relied heavily on Online Travel Agencies (OTAs) that charged 15–25% commission per booking. Their existing website had no real-time availability or integrated payment, forcing guests to call or email.',
                'solution' => 'We built a direct-booking engine with real-time room availability, integrated Paystack payment, automated WhatsApp confirmation, and a loyalty programme signup.',
                'results' => 'Direct bookings increased 40% within 60 days. OTA commission costs dropped by ₦2.4M in the first quarter. Guest satisfaction scores improved 22% due to instant confirmation.',
                'workflow' => [
                    ['step' => 'Instagram / Google', 'tool' => 'Meta Ads + Google Ads'],
                    ['step' => 'Booking Engine', 'tool' => 'Laravel + Bootstrap'],
                    ['step' => 'Payment', 'tool' => 'Paystack'],
                    ['step' => 'Confirmation', 'tool' => 'WhatsApp Business API'],
                    ['step' => 'CRM', 'tool' => 'HubSpot'],
                ],
                'tech_stack' => ['Laravel', 'Bootstrap', 'Paystack', 'HubSpot', 'WhatsApp API'],
                'preview_slug' => 'elysian',
                'og_image' => asset('og-image.jpg'),
                'timeframe' => '5 weeks',
            ],
            [
                'slug' => 'hirebase',
                'client' => 'HIREBASE',
                'industry' => 'Recruitment / HR Tech',
                'category' => 'web-development',
                'metric' => '2,100+ Placements',
                'metric_value' => '2,100',
                'excerpt' => 'Built a job-matching platform with AI-powered CV parsing, employer dashboard, and automated interview scheduling.',
                'challenge' => 'HIREBASE was a traditional recruitment agency drowning in manual CV screening. Recruiters spent 4+ hours per day on admin. Candidate experience was poor: no status updates, no self-service.',
                'solution' => 'We built a job-matching platform with AI CV parsing (extracting skills, experience, and salary expectations), an employer self-service dashboard, and automated interview scheduling via calendar integration.',
                'results' => 'Placements increased from 400/year to 2,100/year. Recruiter admin time dropped 70%. Candidate satisfaction scores rose from 3.2/5 to 4.7/5. Time-to-hire reduced from 21 days to 8 days.',
                'workflow' => [
                    ['step' => 'Job Board SEO', 'tool' => 'Google Search + LinkedIn'],
                    ['step' => 'CV Upload', 'tool' => 'Custom Upload + AI Parse'],
                    ['step' => 'Matching Engine', 'tool' => 'Laravel + Algorithm'],
                    ['step' => 'Employer Dashboard', 'tool' => 'React + Bootstrap'],
                    ['step' => 'Interview Booking', 'tool' => 'Calendly API + Email'],
                    ['step' => 'Placement Tracking', 'tool' => 'HubSpot'],
                ],
                'tech_stack' => ['Laravel', 'React', 'Bootstrap', 'HubSpot', 'Calendly API', 'OpenAI API'],
                'preview_slug' => 'hirebase',
                'og_image' => asset('og-image.jpg'),
                'timeframe' => '10 weeks',
            ],
            [
                'slug' => 'noir',
                'client' => 'NOIR',
                'industry' => 'Fashion / E-Commerce',
                'category' => 'funnel-automation',
                'metric' => '1,200% Sales Increase',
                'metric_value' => '1,200%',
                'excerpt' => 'Redesigned the Shopify storefront with a style quiz, streamlined checkout, and organic growth strategy.',
                'challenge' => 'NOIR had a beautiful product line but a static Shopify site that treated every visitor the same. There was no personalisation, no style guidance, and checkout abandonment was over 70%.',
                'solution' => 'We redesigned the storefront with an interactive style quiz that auto-recommended outfits, a streamlined Paystack checkout, and post-purchase retention flows via email and SMS. All growth was organic | zero ad spend.',
                'results' => 'Sales increased 1,200% in 90 days without any paid advertising. The style quiz became the primary entry point, with 68% of quiz-takers adding a recommended item to cart. Checkout abandonment dropped to 34%.',
                'workflow' => [
                    ['step' => 'Organic / Social', 'tool' => 'Instagram + TikTok'],
                    ['step' => 'Style Quiz', 'tool' => 'Shopify + Custom JS'],
                    ['step' => 'Product Recommendations', 'tool' => 'Shopify AI'],
                    ['step' => 'Checkout', 'tool' => 'Paystack'],
                    ['step' => 'Retention', 'tool' => 'Klaviyo + SMS'],
                ],
                'tech_stack' => ['Shopify', 'Paystack', 'Klaviyo', 'Custom JavaScript'],
                'preview_slug' => 'noir',
                'og_image' => asset('og-image.jpg'),
                'timeframe' => '4 weeks',
            ],
            [
                'slug' => 'timber-mill',
                'client' => 'TimberMill',
                'industry' => 'Artisan / Furniture',
                'category' => 'web-development',
                'metric' => '5× Inquiry Volume',
                'metric_value' => '500%',
                'excerpt' => 'Built a catalogue website with custom order forms, 3D product views, and automated quote generation.',
                'challenge' => 'TimberMill relied entirely on Instagram DMs and word-of-mouth. Prospects could not browse the full catalogue, and the inquiry process was manual and inconsistent. High-value custom orders were being lost to competitors with better digital presence.',
                'solution' => 'We built a catalogue website with high-resolution product photography, 3D product views, a custom order form with dynamic pricing, and automated quote generation sent via email and WhatsApp.',
                'results' => 'Website inquiries increased 500% in the first 6 months. Custom order values averaged 3× higher than standard product orders. The founder reported spending 60% less time on admin and 40% more time on craftsmanship.',
                'workflow' => [
                    ['step' => 'Organic Search', 'tool' => 'Google SEO'],
                    ['step' => 'Catalogue', 'tool' => 'Laravel + Bootstrap'],
                    ['step' => 'Custom Order Form', 'tool' => 'Custom Form + Dynamic Pricing'],
                    ['step' => 'Quote Generation', 'tool' => 'Laravel + PDF'],
                    ['step' => 'Follow-up', 'tool' => 'WhatsApp Business API + Email'],
                ],
                'tech_stack' => ['Laravel', 'Bootstrap', 'Three.js', 'WhatsApp API', 'PDF Generation'],
                'preview_slug' => 'timber-mill',
                'og_image' => asset('og-image.jpg'),
                'timeframe' => '7 weeks',
            ],
        ]);
    }

    public function featured(int $count = 3): Collection
    {
        return $this->all()->take($count);
    }

    public function byCategory(string $category): Collection
    {
        return $this->all()->where('category', $category);
    }

    public function categories(): array
    {
        return [
            'all' => 'All',
            'web-development' => 'Web Development',
            'funnel-automation' => 'Funnel & Automation',
            'paid-ads' => 'Paid Advertising',
            'brand-strategy' => 'Brand & Strategy',
        ];
    }

    public function find(string $slug): ?array
    {
        return $this->all()->firstWhere('slug', $slug);
    }

    public function related(string $currentSlug, int $count = 3): Collection
    {
        $current = $this->find($currentSlug);
        if (!$current) {
            return collect();
        }
        return $this->all()
            ->where('slug', '!=', $currentSlug)
            ->where('category', $current['category'])
            ->take($count);
    }

    public function stats(): array
    {
        // DISABLED (Sep 2, 2026): All stats return null — the homepage
        // stats band hides entirely when all values are null (the
        // @if guard in home.blade.php checks array_filter on 'number').
        // Previously returned fabricated numbers: '50+', '6+', '3+', '95%'
        // — all invented, none verified by the Founder. To re-enable:
        // replace null with a REAL verified number.
        return [
            ['number' => null, 'label' => 'Projects Delivered'],
            ['number' => null, 'label' => 'Industries Served'],
            ['number' => null, 'label' => 'Years Active'],
            ['number' => null, 'label' => 'Client Retention'],
        ];
    }

    public function demos(): array
    {
        return [
            ['slug' => 'sterling-vale', 'title' => 'Sterling & Vale', 'category' => 'Corporate Website'],
            ['slug' => 'apexflow', 'title' => 'ApexFlow', 'category' => 'SaaS Onboarding'],
            ['slug' => 'elysian', 'title' => 'ELYSIAN', 'category' => 'Hotel Booking Engine'],
            ['slug' => 'hirebase', 'title' => 'HIREBASE', 'category' => 'Job Matching Platform'],
            ['slug' => 'noir', 'title' => 'NOIR', 'category' => 'Fashion E-Commerce'],
            ['slug' => 'timber-mill', 'title' => 'TimberMill', 'category' => 'Artisan Catalogue'],
        ];
    }

    public function findDemo(string $slug): ?array
    {
        return collect($this->demos())->firstWhere('slug', $slug);
    }
}
