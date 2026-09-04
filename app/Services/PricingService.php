<?php

namespace App\Services;

/**
 * Services & Pricing data — Founder-approved pricing (Sep 3, 2026).
 *
 * Three categories: Website Design, Automation, Branding.
 * Each has 3-4 tiers with real Naira price ranges.
 */
class PricingService
{
    public function all(): array
    {
        return [
            'website' => [
                'title' => 'Website Design',
                'description' => 'From starter sites to full e-commerce storefronts. Every build is mobile-responsive, SEO-ready, and conversion-focused.',
                'tiers' => [
                    [
                        'name' => 'Starter Website',
                        'price' => '₦200,000',
                        'price_range' => '₦200,000 – ₦250,000',
                        'price_note' => 'one-time',
                        'description' => 'A clean, professional landing presence for new businesses.',
                        'features' => [
                            'Up to 3 pages',
                            'Mobile responsive',
                            'Professional UI design',
                            'Contact/WhatsApp integration',
                            'Basic SEO',
                            'Social media links',
                            '2 revisions',
                        ],
                        'cta' => 'Get Started',
                        'highlight' => false,
                    ],
                    [
                        'name' => 'Business Website',
                        'price' => '₦300,000',
                        'price_range' => '₦300,000 – ₦450,000',
                        'price_note' => 'one-time',
                        'description' => 'A complete business website built to convert visitors into leads.',
                        'features' => [
                            'Up to 5–7 pages',
                            'Custom design',
                            'Mobile responsive',
                            'Contact/WhatsApp integration',
                            'Basic SEO',
                            'Google Analytics',
                            'Testimonials',
                            'FAQ section',
                            'Strong CTA/conversion structure',
                            '3 revisions',
                        ],
                        'cta' => 'Get Started',
                        'highlight' => true,
                    ],
                    [
                        'name' => 'Premium Website',
                        'price' => '₦500,000',
                        'price_range' => '₦500,000 – ₦750,000+',
                        'price_note' => 'one-time',
                        'description' => 'Advanced, custom-designed websites with integrations and full conversion architecture.',
                        'features' => [
                            '7+ pages',
                            'Advanced/custom design',
                            'SEO setup',
                            'Analytics & tracking',
                            'Forms and lead capture',
                            'Third-party integrations',
                            'Advanced functionality',
                            'Conversion-focused structure',
                        ],
                        'cta' => 'Get Started',
                        'highlight' => false,
                    ],
                    [
                        'name' => 'E-Commerce Website',
                        'price' => '₦500,000',
                        'price_range' => '₦500,000 – ₦800,000+',
                        'price_note' => 'one-time',
                        'description' => 'Full online store with product catalogue, checkout, and payment integration.',
                        'features' => [
                            'Product catalogue',
                            'Shopping cart',
                            'Checkout',
                            'Paystack/Flutterwave',
                            'Order notifications',
                            'Customer management',
                            'Mobile optimization',
                            'Basic SEO',
                        ],
                        'cta' => 'Get Started',
                        'highlight' => false,
                    ],
                ],
            ],
            'automation' => [
                'title' => 'Automation',
                'description' => 'Workflows that capture, nurture, and convert leads automatically — 24/7.',
                'tiers' => [
                    [
                        'name' => 'Starter Automation',
                        'price' => '₦150,000',
                        'price_range' => '₦150,000 – ₦200,000',
                        'price_note' => 'one-time',
                        'description' => 'A single automated workflow to capture and route leads.',
                        'features' => [
                            'One workflow',
                            'Form → email/WhatsApp',
                            'Google Sheets integration',
                            'Basic notifications',
                        ],
                        'cta' => 'Get Started',
                        'highlight' => false,
                    ],
                    [
                        'name' => 'Business Automation',
                        'price' => '₦250,000',
                        'price_range' => '₦250,000 – ₦400,000',
                        'price_note' => 'one-time',
                        'description' => 'Multiple interconnected workflows with CRM and follow-up automation.',
                        'features' => [
                            'Multiple workflows',
                            'CRM integration',
                            'WhatsApp/email automation',
                            'Lead capture',
                            'Follow-up automation',
                            'Notifications',
                            'Basic reporting',
                        ],
                        'cta' => 'Get Started',
                        'highlight' => true,
                    ],
                    [
                        'name' => 'Advanced Automation',
                        'price' => '₦500,000+',
                        'price_range' => '₦500,000+',
                        'price_note' => 'one-time',
                        'description' => 'Complex, AI-powered automation systems with custom business processes.',
                        'features' => [
                            'Multiple interconnected workflows',
                            'CRM',
                            'AI integration',
                            'WhatsApp automation',
                            'Payment integration',
                            'Lead qualification',
                            'Automated follow-up',
                            'Custom business processes',
                        ],
                        'cta' => 'Get Started',
                        'highlight' => false,
                    ],
                ],
            ],
            'branding' => [
                'title' => 'Branding',
                'description' => 'Visual identities that make your business impossible to ignore.',
                'tiers' => [
                    [
                        'name' => 'Starter Branding',
                        'price' => '₦100,000',
                        'price_range' => '₦100,000 – ₦150,000',
                        'price_note' => 'one-time',
                        'description' => 'The essentials: logo, colours, and typography.',
                        'features' => [
                            'Logo',
                            'Colour palette',
                            'Typography',
                            'Basic brand direction',
                        ],
                        'cta' => 'Get Started',
                        'highlight' => false,
                    ],
                    [
                        'name' => 'Business Branding',
                        'price' => '₦200,000',
                        'price_range' => '₦200,000 – ₦300,000',
                        'price_note' => 'one-time',
                        'description' => 'A complete brand package with guidelines and marketing collateral.',
                        'features' => [
                            'Logo',
                            'Colour palette',
                            'Typography',
                            'Brand guidelines',
                            'Social media templates',
                            'Business card',
                            'Letterhead',
                        ],
                        'cta' => 'Get Started',
                        'highlight' => true,
                    ],
                    [
                        'name' => 'Complete Brand Identity',
                        'price' => '₦350,000+',
                        'price_range' => '₦350,000+',
                        'price_note' => 'one-time',
                        'description' => 'Full visual identity system with all marketing materials and stationery.',
                        'features' => [
                            'Full visual identity',
                            'Logo system',
                            'Brand guidelines',
                            'Social media templates',
                            'Marketing materials',
                            'Business stationery',
                        ],
                        'cta' => 'Get Started',
                        'highlight' => false,
                    ],
                ],
            ],
        ];
    }
}
