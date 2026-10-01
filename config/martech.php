<?php

return [
    'heading' => 'Our Stack',
    'eyebrow' => 'Our Stack',
    'title' => 'The tools behind the work',
    'subtitle' => 'Paystack, HubSpot, Laravel, Meta Ads. Tools the people who run the business can keep using after handover.',
    'footnote' => 'Tool logos are property of their respective owners. Listed tools reflect our standard integration stack.',

    // Tools & categories use Font Awesome 6 Free.
    //   - 'brand' (string|null) — Font Awesome BRAND slug (rendered as <i class="fab fa-{brand}">).
    //     Set when FA ships a brand logo for the tool (e.g. 'stripe', 'laravel').
    //   - 'icon' (string) — Font Awesome SOLID slug (rendered as <i class="fas fa-{icon}">).
    //     Used for category headers and as a fallback for tools without a brand logo
    //     (e.g. Paystack, Flutterwave, Ahrefs — these are not in Font Awesome Brands).
    //   - 'color' (string) — Official brand color (hex). Used by the marquee's
    //     "muted by default, native color on hover" treatment. Set on every tool
    //     that has a brand slug. Brand-less tools don't appear in the marquee,
    //     so they don't need a color.
    //
    // FA brand slugs verified against the live FA 6.7.2 brands.min.css at
    // https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6/css/brands.min.css
    // Brand colors sourced from each company's official brand guidelines.
    'categories' => [
        [
            'name' => 'Payments',
            'icon' => 'fa-credit-card',
            'tools' => [
                ['name' => 'Paystack',       'brand' => null,         'icon' => 'fa-credit-card'],
                ['name' => 'Stripe',         'brand' => 'stripe',     'icon' => 'fa-credit-card',     'color' => '#635bff'],
                ['name' => 'Flutterwave',    'brand' => null,         'icon' => 'fa-money-bill-wave'],
            ],
        ],
        [
            'name' => 'Analytics',
            'icon' => 'fa-chart-line',
            'tools' => [
                ['name' => 'Google Analytics 4', 'brand' => 'google', 'icon' => 'fa-chart-line', 'color' => '#4285f4'],
                ['name' => 'Plausible',          'brand' => null,      'icon' => 'fa-chart-line'],
                ['name' => 'PostHog',            'brand' => null,      'icon' => 'fa-piggy-bank'],
            ],
        ],
        [
            'name' => 'CRM & Marketing',
            'icon' => 'fa-users',
            'tools' => [
                ['name' => 'HubSpot',    'brand' => 'hubspot',   'icon' => 'fa-users',     'color' => '#ff7a59'],
                ['name' => 'Brevo',      'brand' => null,        'icon' => 'fa-envelope'],
                ['name' => 'Mailchimp',  'brand' => 'mailchimp', 'icon' => 'fa-envelope', 'color' => '#ffe01b'],
            ],
        ],
        [
            'name' => 'Advertising',
            'icon' => 'fa-bullhorn',
            'tools' => [
                ['name' => 'Meta Ads',     'brand' => 'meta',   'icon' => 'fa-bullhorn', 'color' => '#0866ff'],
                ['name' => 'Google Ads',   'brand' => 'google', 'icon' => 'fa-bullhorn', 'color' => '#4285f4'],
                ['name' => 'TikTok Ads',   'brand' => 'tiktok',  'icon' => 'fa-bullhorn', 'color' => '#000000'],
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
                ['name' => 'Laravel',   'brand' => 'laravel',   'icon' => 'fa-cart-shopping', 'color' => '#ff2d20'],
                ['name' => 'WordPress', 'brand' => 'wordpress', 'icon' => 'fa-cart-shopping', 'color' => '#21759b'],
                ['name' => 'Shopify',   'brand' => 'shopify',   'icon' => 'fa-cart-shopping', 'color' => '#95bf47'],
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
                ['name' => 'AWS',         'brand' => 'aws',         'icon' => 'fa-server',         'color' => '#ff9900'],
                ['name' => 'Cloudflare',  'brand' => 'cloudflare',  'icon' => 'fa-shield-halved', 'color' => '#f38020'],
                ['name' => 'Vercel',      'brand' => null,          'icon' => 'fa-rocket'],
            ],
        ],
    ],
];
