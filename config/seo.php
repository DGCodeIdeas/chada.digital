<?php

// SEO + AISEO defaults.
//
// Used by: resources/views/partials/meta.blade.php (as fallback when a
// controller doesn't pass a $meta override for that key).
//
// Per-page overrides: each controller passes a $meta array to its view.
// Any key in that array takes precedence over the values below.

return [

    // Site-wide defaults — used when $meta doesn't override.
    'defaults' => [
        'title'             => null,            // falls back to brand.name
        'description'        => config('brand.tagline'),
        'keywords'          => 'website design Lagos, Lagos web studio, web development Nigeria, marketing automation, brand identity, Shopify Lagos, Laravel Nigeria',
        'og_type'            => 'website',
        'og_image'           => null,            // falls back to /og-image.jpg
        'og_image_width'     => 1536,            // matches public/og-image.jpg
        'og_image_height'    => 1024,
        'og_image_type'      => 'image/jpeg',
        'twitter_card'      => 'summary_large_image',
        'hreflang_en'        => config('app.url', 'https://chadadigital.com'),
        'hreflang_default'  => config('app.url', 'https://chadadigital.com'),
    ],

    // Per-route meta. The PageController pulls from this map by route name.
    'routes' => [
        'home' => [
            'title'       => 'Chada Digital — Web Design, Automation, and Branding in Lagos',
            'description' => 'A Lagos studio. Websites people can find, automation that keeps running, and brands that hold together. Founded by Okeoma Joseph in 2023.',
            'keywords'    => 'website design Lagos, Lagos web studio, web development Nigeria, marketing automation Lagos, brand identity Lagos, Shopify Nigeria, Laravel development Nigeria',
            'og_type'     => 'website',
        ],
        'about' => [
            'title'       => 'About Chada Digital — Founder Okeoma Joseph, Lagos Studio',
            'description' => 'Chada Digital is a small Lagos studio founded by Okeoma Joseph in 2023. Designers and engineers build websites, automation, and brand identities. Deadlines are met. Replies come within one business day.',
            'keywords'    => 'Chada Digital founder, Okeoma Joseph, Lagos web studio, Nigerian web development team, Lagos digital studio',
            'og_type'     => 'profile',
        ],
        'services' => [
            'title'       => 'Services — Chada Digital (Lagos)',
            'description' => 'Websites, automation, and brands from a Lagos studio. Scoped in writing before work starts. Ranges listed so you can plan.',
            'keywords'    => 'web design Lagos, Lagos website studio, marketing automation Lagos, brand identity Lagos, Shopify setup Nigeria',
            'og_type'     => 'website',
        ],
        'contact' => [
            'title'       => 'Contact Chada Digital — Start a Project in Lagos',
            'description' => 'Tell the studio what you need. Replies within one business day. Email info@chadadigital.com or WhatsApp +234 810 189 2632.',
            'keywords'    => 'contact Chada Digital, Lagos web studio contact, hire web designer Nigeria, WhatsApp Lagos web studio',
            'og_type'     => 'website',
        ],
        'case-studies.index' => [
            'title'       => 'Case Studies — Chada Digital (Coming Soon)',
            'description' => 'Write-ups with real numbers come after clients say they can be shared. Until then, the live demos are the work.',
            'keywords'    => 'Chada Digital case studies, Lagos web design portfolio, Nigerian web development case studies',
            'og_type'     => 'website',
        ],
        'demos' => [
            'title'       => 'Demo Lab — 18 Live Site Demos by Chada Digital',
            'description' => 'Eighteen clickable sites built by the studio: shops, clinics, schools, restaurants, agencies, and more. Open one and look around.',
            'keywords'    => 'web design demos Lagos, live site demos Nigeria, Shopify demo Lagos, WordPress demo, restaurant website demo, clinic website demo',
            'og_type'     => 'website',
        ],
        'design-partner' => [
            'title'       => 'Become a Design Partner — Chada Digital',
            'description' => 'No customer logos yet, and none will be invented. Work with the team building the project. Small Lagos studio, founder-led.',
            'keywords'    => 'design partner Lagos, Nigerian web studio partner, Chada Digital design partner',
            'og_type'     => 'website',
        ],
        'terms' => [
            'title'       => 'Terms of Service — Chada Digital',
            'description' => 'Terms of service for Chada Digital. Covers engagement, payment, IP handover, and support.',
            'og_type'     => 'article',
        ],
        'privacy' => [
            'title'       => 'Privacy Policy — Chada Digital',
            'description' => 'Privacy policy for Chada Digital. What is collected, how it is used, and how to request deletion.',
            'og_type'     => 'article',
        ],
        'cookies' => [
            'title'       => 'Cookie Policy — Chada Digital',
            'description' => 'Cookie policy for Chada Digital. Which cookies are set, why, and how to turn them off.',
            'og_type'     => 'article',
        ],
    ],

    // Founder-level social profiles (for Person.sameAs in structured data).
    // Empty by default — fill in when the founder has personal profile URLs
    // (NOT the company accounts, which are already in config/social.php).
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
