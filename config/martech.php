<?php

return [
    'heading' => 'Our Stack',
    'eyebrow' => 'Our Stack',
    'title' => 'The tools we actually use',
    'subtitle' => 'Paystack, HubSpot, Laravel, Meta Ads. Reliable tools, wired together so your team can manage them day to day.',
    'footnote' => 'Tool logos are property of their respective owners. Listed tools reflect our standard integration stack.',

    // Tools & categories use Font Awesome 6 Free.
    //   - 'brand' (string|null) — Font Awesome BRAND slug (rendered as <i class="fab fa-{brand}">).
    //     Set when FA ships a brand logo for the tool (e.g. 'stripe', 'laravel').
    //   - 'icon' (string) — Font Awesome SOLID slug (rendered as <i class="fas fa-{icon}">).
    //     Used for category headers and as a fallback for tools without a brand logo
    //     (e.g. Paystack, Flutterwave, Ahrefs — these are not in Font Awesome Brands).
    //
    // FA brand slugs were verified against the live FA 6.7.2 brands.min.css at
    // https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6/css/brands.min.css
    // Solid slugs were verified against all.min.css.
    'categories' => [
        [
            'name' => 'Payments',
            'icon' => 'fa-credit-card',
            'tools' => [
                ['name' => 'Paystack',       'brand' => null,         'icon' => 'fa-credit-card'],
                ['name' => 'Stripe',         'brand' => 'stripe',     'icon' => 'fa-credit-card'],
                ['name' => 'Flutterwave',    'brand' => null,         'icon' => 'fa-money-bill-wave'],
            ],
        ],
        [
            'name' => 'Analytics',
            'icon' => 'fa-chart-line',
            'tools' => [
                ['name' => 'Google Analytics 4', 'brand' => 'google', 'icon' => 'fa-chart-line'],
                ['name' => 'Plausible',          'brand' => null,      'icon' => 'fa-chart-line'],
                ['name' => 'PostHog',            'brand' => null,      'icon' => 'fa-piggy-bank'],
            ],
        ],
        [
            'name' => 'CRM & Marketing',
            'icon' => 'fa-users',
            'tools' => [
                ['name' => 'HubSpot',    'brand' => 'hubspot',   'icon' => 'fa-users'],
                ['name' => 'Brevo',      'brand' => null,        'icon' => 'fa-envelope'],
                ['name' => 'Mailchimp',  'brand' => 'mailchimp', 'icon' => 'fa-envelope'],
            ],
        ],
        [
            'name' => 'Advertising',
            'icon' => 'fa-bullhorn',
            'tools' => [
                ['name' => 'Meta Ads',     'brand' => 'meta',   'icon' => 'fa-bullhorn'],
                ['name' => 'Google Ads',   'brand' => 'google', 'icon' => 'fa-bullhorn'],
                ['name' => 'TikTok Ads',   'brand' => 'tiktok',  'icon' => 'fa-bullhorn'],
            ],
        ],
        [
            'name' => 'Automation',
            'icon' => 'fa-bolt',
            'tools' => [
                ['name' => 'Zapier', 'brand' => null, 'icon' => 'fa-bolt'],
                ['name' => 'Make',   'brand' => null, 'icon' => 'fa-gears'],
                ['name' => 'n8n',    'brand' => null, 'icon' => 'fa-diagram-project'],
            ],
        ],
        [
            'name' => 'CMS & E-Commerce',
            'icon' => 'fa-cart-shopping',
            'tools' => [
                ['name' => 'Laravel',   'brand' => 'laravel',   'icon' => 'fa-cart-shopping'],
                ['name' => 'WordPress', 'brand' => 'wordpress', 'icon' => 'fa-cart-shopping'],
                ['name' => 'Shopify',   'brand' => 'shopify',   'icon' => 'fa-cart-shopping'],
            ],
        ],
        [
            'name' => 'SEO',
            'icon' => 'fa-magnifying-glass',
            'tools' => [
                ['name' => 'Ahrefs',   'brand' => null, 'icon' => 'fa-link'],
                ['name' => 'SEMrush',  'brand' => null, 'icon' => 'fa-magnifying-glass-chart'],
                ['name' => 'RankMath', 'brand' => null, 'icon' => 'fa-ranking-star'],
            ],
        ],
        [
            'name' => 'Infrastructure',
            'icon' => 'fa-server',
            'tools' => [
                ['name' => 'AWS',         'brand' => 'aws',         'icon' => 'fa-server'],
                ['name' => 'Cloudflare',  'brand' => 'cloudflare',  'icon' => 'fa-shield-halved'],
                ['name' => 'Vercel',      'brand' => null,          'icon' => 'fa-rocket'],
            ],
        ],
    ],
];
