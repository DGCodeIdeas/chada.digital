<?php

// Placeholders — V4 gate model + backward compatibility.
//
// This file was SPLIT into individual config files (Sep 2, 2026):
//   config/brand.php           → brand identity
//   config/contact.php         → contact info
//   config/social.php          → social URLs
//   config/hero.php            → homepage hero copy
//   config/services_page.php   → /services page copy
//   config/about_page.php      → /about page copy
//   config/contact_page.php    → /contact page copy
//   config/design_partner.php  → Design Partner band copy
//   config/cta.php             → closing CTAs
//
// This file now MERGES those individual configs back together for backward
// compatibility — any view still reading config('placeholders.contact.email')
// continues to work. New views should read from the individual config files
// directly: config('contact.email'), config('brand.name'), etc.
//
// To update content: edit the individual config files (e.g. config/brand.php).
// This file is just a merge layer — don't edit content here.

$merged = array_merge(
    [
        // ── V4 gates (kept here — not split yet) ────────────────────────
        'lorem_seed' => 'v4-initial',

        'hero_legacy' => [
            'primary_cta' => 'Start a Project',
            'secondary_cta' => 'Explore Our Work',
            'proof_line' => null,
        ],

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

        'offers' => [
            ['badge' => 'ADVISORY', 'price_ngn' => null, 'price_usd' => null, 'price_period' => null, 'cta_label' => 'Get Started'],
            ['badge' => 'SPRINT', 'price_ngn' => null, 'price_usd' => null, 'price_period' => null, 'cta_label' => 'Get Started'],
            ['badge' => 'BUILD', 'price_ngn' => null, 'price_usd' => null, 'price_period' => null, 'cta_label' => 'Get Started'],
            ['badge' => 'SYSTEM', 'price_ngn' => null, 'price_usd' => null, 'price_period' => null, 'cta_label' => 'Get Started'],
            ['badge' => 'RETAINER', 'price_ngn' => null, 'price_usd' => null, 'price_period' => '/month', 'cta_label' => 'Get Started'],
            ['badge' => 'CARE', 'price_ngn' => null, 'price_usd' => null, 'price_period' => '/month', 'cta_label' => 'Get Started'],
        ],

        'audit' => [
            'cta_label' => 'Request a Free Review',
        ],

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

        'webinar' => [
            'enabled' => false,
            'cta_label' => 'Get the Replay',
        ],

        'testimonials' => [],

        'manifesto' => [
            'enabled' => false,
            'label' => 'Our Standards',
            'items' => [],
        ],

        'founder' => [
            'real' => false,
            'photo' => '/assets/images/founder-placeholder.jpg',
            'cta_label' => 'Start a Conversation',
        ],

        'martech' => [
            'subintro' => null,
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

        'chat' => [
            'whatsapp_number' => null,
            'whatsapp_prefill' => 'Hello Chada Digital, I would like to discuss a project.',
        ],

        'workflow_speed_claim' => null,
    ],
    // Merge in the individual config files (backward compatibility)
    ['brand' => config('brand')],
    ['contact' => config('contact')],
    ['social' => config('social')],
    ['hero' => config('hero')],
    ['services_page' => config('services_page')],
    ['about_page' => config('about_page')],
    ['contact_page' => config('contact_page')],
    ['design_partner' => config('design_partner')],
    ['cta' => config('cta')],
);

return $merged;
