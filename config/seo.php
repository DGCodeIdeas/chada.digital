<?php

// SEO + AISEO defaults.
//
// Used by: resources/views/partials/meta.blade.php (as fallback when a
// controller doesn't pass a $meta override for that key).
//
// Per-page overrides: each controller passes a $meta array to its view.
// Any key in that array takes precedence over the values below.
//
// Per-route title/description: see the $routeMeta map at the bottom of
// this file — the PageController could (optionally) pull from this map
// to centralize per-page meta in one place.

return [

    // Site-wide defaults — used when $meta doesn't override.
    'defaults' => [
        'title'             => null,            // falls back to brand.name
        'description'        => config('brand.tagline'),
        'keywords'          => 'website design Lagos, Lagos web developer, web development Nigeria, marketing automation, brand identity, Shopify Lagos, Laravel Nigeria',
        'og_type'            => 'website',
        'og_image'           => null,            // falls back to /og-image.jpg
        'og_image_width'     => 1536,            // matches public/og-image.jpg
        'og_image_height'    => 1024,
        'og_image_type'      => 'image/jpeg',
        'twitter_card'      => 'summary_large_image',
        'hreflang_en'        => config('app.url', 'https://chadadigital.com'),
        'hreflang_default'  => config('app.url', 'https://chadadigital.com'),
    ],

    // Per-route meta. The PageController pulls from this map by route name
    // to set page-specific title/description/keywords without hardcoding
    // them in the controller. Routes NOT in this map fall back to the
    // site-wide defaults above.
    'routes' => [
        'home' => [
            'title'       => 'Chada Digital — Web Design, Automation, and Branding in Lagos',
            'description' => 'A Lagos-based digital studio. We build websites, set up marketing automation, and design brand identities. Pricing is in Naira, listed on the site. Founded by Okeoma Joseph in 2023.',
            'keywords'    => 'website design Lagos, Lagos web developer, web development Nigeria, marketing automation Lagos, brand identity Lagos, Shopify Nigeria, Laravel development Nigeria',
            'og_type'     => 'website',
        ],
        'about' => [
            'title'       => 'About Chada Digital — Founder Okeoma Joseph, Lagos Studio',
            'description' => 'Chada Digital is a small Lagos studio founded by Okeoma Joseph in 2023. We design websites, set up automation, and create brand identities. Pricing listed on the site. The team is small, deadlines are met, and replies come within one business day.',
            'keywords'    => 'Chada Digital founder, Okeoma Joseph, Lagos web studio, Nigerian web development team, Lagos digital agency',
            'og_type'     => 'profile',
        ],
        'services' => [
            'title'       => 'Services & Pricing — Chada Digital (Lagos)',
            'description' => 'Ten packages priced in Naira. Strategy sessions, done-for-you website builds, marketing automation, paid advertising, and brand identity. Transparent pricing, realistic timelines, no hourly retainers.',
            'keywords'    => 'web design pricing Nigeria, Lagos web design packages, Naira website pricing, marketing automation Lagos, brand identity Lagos, Shopify setup Nigeria',
            'og_type'     => 'website',
        ],
        'contact' => [
            'title'       => 'Contact Chada Digital — Start a Project in Lagos',
            'description' => 'Start a project, book a consultation, or ask a question. We reply within one business day. Email info@chadadigital.com or WhatsApp +234 810 189 2632.',
            'keywords'    => 'contact Chada Digital, Lagos web developer contact, hire web designer Nigeria, WhatsApp Lagos web studio',
            'og_type'     => 'website',
        ],
        'case-studies.index' => [
            'title'       => 'Case Studies — Chada Digital (Coming Soon)',
            'description' => 'Detailed case studies for each Chada Digital demo project are being prepared. Each will include the workflow, the tech stack, and verified business outcomes. Until then, browse the live demos.',
            'keywords'    => 'Chada Digital case studies, Lagos web design portfolio, Nigerian web development case studies',
            'og_type'     => 'website',
        ],
        'demos' => [
            'title'       => 'Demo Lab — 18 Live Site Demos by Chada Digital',
            'description' => 'Eighteen clickable live site demos built by Chada Digital — shops, clinics, schools, restaurants, agencies, and more. Open any demo and explore the frontend. Grouped by category the way we actually get hired.',
            'keywords'    => 'web design demos Lagos, live site demos Nigeria, Shopify demo Lagos, WordPress demo, restaurant website demo, clinic website demo',
            'og_type'     => 'website',
        ],
        'design-partner' => [
            'title'       => 'Become a Design Partner — Chada Digital',
            'description' => 'No customer logos yet — Chada Digital will not fake them. Become a design partner and work directly with the team building your project. Early-stage studio, founder-led.',
            'keywords'    => 'design partner Lagos, Nigerian web studio partner, Chada Digital design partner, early-stage web design partner',
            'og_type'     => 'website',
        ],
        'terms' => [
            'title'       => 'Terms of Service — Chada Digital',
            'description' => 'Terms of service for Chada Digital. Covers engagement model, payment terms, IP handover, and support scope.',
            'og_type'     => 'article',
        ],
        'privacy' => [
            'title'       => 'Privacy Policy — Chada Digital',
            'description' => 'Privacy policy for Chada Digital. Covers what data we collect, how we use it, and how to request deletion.',
            'og_type'     => 'article',
        ],
        'cookies' => [
            'title'       => 'Cookie Policy — Chada Digital',
            'description' => 'Cookie policy for Chada Digital. Covers which cookies we set, why, and how to disable them.',
            'og_type'     => 'article',
        ],
    ],

    // Founder-level social profiles (for Person.sameAs in structured data).
    // Empty by default — fill in when the founder has personal profile URLs
    // (NOT the company accounts, which are already in config/social.php).
    // Having founder.sameAs pointing at company accounts would confuse
    // entity disambiguation in the Knowledge Graph.
    'founder_same_as' => [
        // e.g. 'https://www.linkedin.com/in/okeoma-joseph/'
        // e.g. 'https://x.com/okeomajoseph'
        // e.g. 'https://github.com/okeomajoseph'
    ],

    // Twitter handle for twitter:site tag — company account.
    'twitter_site' => config('social.twitter'),

    // AI crawler policy — surfaced in robots.txt and llms.txt.
    // 'allow'   — explicitly allowed in robots.txt.
    // 'block'   — explicitly blocked in robots.txt.
    // (omitted)  — no explicit rule, falls back to User-agent: * Allow: /
    'ai_crawlers' => [
        'GPTBot'           => 'allow',     // OpenAI
        'ClaudeBot'        => 'allow',     // Anthropic
        'PerplexityBot'    => 'allow',     // Perplexity
        'Google-Extended'  => 'allow',     // Google's AI training crawler
        'CCBot'            => 'allow',     // Common Crawl (used by many LLMs)
        'Amazonbot'         => 'allow',     // Amazon (Rufus etc.)
        'Applebot-Extended' => 'allow',     // Apple Intelligence
        'cohere-ai'         => 'allow',     // Cohere
    ],
];
