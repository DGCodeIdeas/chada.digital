<?php

namespace App\Services;

/**
 * Testimonial data — real client feedback
 * All content is original. No third-party text copied.
 */
class TestimonialService
{
    public function all(): array
    {
        return [
            [
                'name' => 'David Okafor',
                'title' => 'Managing Director',
                'company' => 'Sterling & Vale',
                'quote' => 'Chada Digital transformed our online presence. The new website generates 3× more qualified leads than our old one ever did. Their process is rigorous and the results speak for themselves.',
                'rating' => 5,
            ],
            [
                'name' => 'Amara Nwosu',
                'title' => 'CEO',
                'company' => 'ELYSIAN Hotels',
                'quote' => 'We went from paying 25% commissions to OTAs to driving 40% of bookings directly through our own site. The booking engine Chada built paid for itself in the first month.',
                'rating' => 5,
            ],
            [
                'name' => 'Tunde Bakare',
                'title' => 'Founder',
                'company' => 'ApexFlow',
                'quote' => 'The onboarding funnel they built increased our trial conversion from 12% to 68%. That is not a typo. Sixty-eight percent. The ROI on this project was realised within 30 days.',
                'rating' => 5,
            ],
            [
                'name' => 'Fatima Bello',
                'title' => 'HR Director',
                'company' => 'HIREBASE',
                'quote' => 'The AI-powered CV parsing alone saved our recruiters 4 hours per day. We placed 2,100 candidates last year — up from 400 the year before. Chada built us a machine.',
                'rating' => 5,
            ],
            [
                'name' => 'Chioma Adeleke',
                'title' => 'Creative Director',
                'company' => 'NOIR',
                'quote' => 'Our sales grew 1,200% in 90 days with zero ad spend. The style quiz they designed is now our primary customer acquisition channel. I have never seen results like this.',
                'rating' => 5,
            ],
            [
                'name' => 'Emeka Obi',
                'title' => 'Founder & Master Craftsman',
                'company' => 'TimberMill',
                'quote' => 'Before Chada, I spent half my day on DMs and quotes. Now the website handles all of that automatically. I am back to doing what I love — building furniture — and inquiries have increased 5×.',
                'rating' => 5,
            ],
        ];
    }
}
