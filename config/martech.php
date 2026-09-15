<?php

return [
    'heading' => 'Our Stack',
    'eyebrow' => 'Our Stack',
    'title' => 'The tools we actually use',
    'subtitle' => 'Paystack, HubSpot, Laravel, Meta Ads. Reliable tools, wired together so your team can manage them day to day.',
    'footnote' => 'Tool logos are property of their respective owners. Listed tools reflect our standard integration stack.',

    // Tools: each entry may set `brand` (a Simple Icons slug, e.g. 'stripe')
    // to render a real brand logo via the `si si-{slug}` webfont class.
    // If `brand` is absent, the partial falls back to the generic Bootstrap
    // Icons class given in `icon`. Brands not shipped by Simple Icons
    // (Paystack, Flutterwave, Ahrefs, RankMath, AWS) intentionally keep
    // their Bootstrap Icons fallback — see partials/our-stack.blade.php.
    'categories' => [
        [
            'name' => 'Payments',
            'icon' => 'bi-credit-card',
            'tools' => [
                ['name' => 'Paystack',       'icon' => 'bi-cash-stack'],
                ['name' => 'Stripe',         'icon' => 'bi-credit-card-2-front', 'brand' => 'stripe'],
                ['name' => 'Flutterwave',    'icon' => 'bi-bank'],
            ],
        ],
        [
            'name' => 'Analytics',
            'icon' => 'bi-bar-chart-line',
            'tools' => [
                ['name' => 'Google Analytics 4', 'icon' => 'bi-graph-up-arrow', 'brand' => 'googleanalytics'],
                ['name' => 'Plausible',          'icon' => 'bi-eye',            'brand' => 'plausibleanalytics'],
                ['name' => 'PostHog',            'icon' => 'bi-piggy-bank',     'brand' => 'posthog'],
            ],
        ],
        [
            'name' => 'CRM & Marketing',
            'icon' => 'bi-people',
            'tools' => [
                ['name' => 'HubSpot',    'icon' => 'bi-bullseye',   'brand' => 'hubspot'],
                ['name' => 'Brevo',      'icon' => 'bi-envelope-at','brand' => 'brevo'],
                ['name' => 'Mailchimp',  'icon' => 'bi-mailbox',    'brand' => 'mailchimp'],
            ],
        ],
        [
            'name' => 'Advertising',
            'icon' => 'bi-megaphone',
            'tools' => [
                ['name' => 'Meta Ads',     'icon' => 'bi-facebook',     'brand' => 'meta'],
                ['name' => 'Google Ads',   'icon' => 'bi-google',       'brand' => 'googleads'],
                ['name' => 'TikTok Ads',   'icon' => 'bi-music-note-beamed', 'brand' => 'tiktok'],
            ],
        ],
        [
            'name' => 'Automation',
            'icon' => 'bi-gear-wide-connected',
            'tools' => [
                ['name' => 'Zapier', 'icon' => 'bi-lightning-charge', 'brand' => 'zapier'],
                ['name' => 'Make',   'icon' => 'bi-hammer',          'brand' => 'make'],
                ['name' => 'n8n',    'icon' => 'bi-diagram-3',       'brand' => 'n8n'],
            ],
        ],
        [
            'name' => 'CMS & E-Commerce',
            'icon' => 'bi-cart',
            'tools' => [
                ['name' => 'Laravel',   'icon' => 'bi-box',  'brand' => 'laravel'],
                ['name' => 'WordPress', 'icon' => 'bi-type', 'brand' => 'wordpress'],
                ['name' => 'Shopify',   'icon' => 'bi-bag',  'brand' => 'shopify'],
            ],
        ],
        [
            'name' => 'SEO',
            'icon' => 'bi-search',
            'tools' => [
                ['name' => 'Ahrefs',   'icon' => 'bi-link-45deg'],
                ['name' => 'SEMrush',  'icon' => 'bi-graph-up', 'brand' => 'semrush'],
                ['name' => 'RankMath', 'icon' => 'bi-123'],
            ],
        ],
        [
            'name' => 'Infrastructure',
            'icon' => 'bi-hdd-network',
            'tools' => [
                ['name' => 'AWS',         'icon' => 'bi-cloud'],
                ['name' => 'Cloudflare',  'icon' => 'bi-shield-check', 'brand' => 'cloudflare'],
                ['name' => 'Vercel',      'icon' => 'bi-triangle',     'brand' => 'vercel'],
            ],
        ],
    ],
];
