<?php

// TEMPORARY PLACEHOLDER CONTENT — lorem-ipsum policy, approved Aug 20 2026.
// V4 MODEL (Redesign(2)): this file holds ONLY three kinds of value:
//   1. lorem_seed — rotate the string => every generated placeholder on the
//      site regenerates (dynamic Lorem Ipsum, Tech Lead directive).
//   2. GATES — null/false values that hide facts or whole sections until a
//      human sets them (see TODO-Placeholders.md for every gate's owner).
//   3. CHROME — short Chada-original UI labels: buttons, eyebrows, badges,
//      tier names. Never marketing prose, never third-party wording.
//
// Hand-written marketing prose is FORBIDDEN in this file. Prose slots render
// $real ?? \App\Support\Lorem::…(key) in the views. Real, stable content
// lives in service classes (PreviewService / CaseStudyService pattern).
//
// RULES:
//  - null price  → views render the "Contact for pricing" fallback.
//  - null stats  → the stats-bar partial renders nothing (guarded).
//  - enabled=false → the section renders nothing at all.

return [
    // ── 1. Dynamic lorem ────────────────────────────────────────────────
    // Rotate this value (any new string) to regenerate ALL placeholder
    // prose site-wide. Document each rotation in TODO-Placeholders.md.
    'lorem_seed' => 'v4-initial',

    // ── 2. Chrome (Chada-original UI labels) ────────────────────────────
    // Hero copy now lives in the centralized 'hero' block below (§4).
    // Kept here for backward compatibility with any view still reading the
    // old shape. Will be removed once all views migrate.
    'hero_legacy' => [
        'primary_cta' => 'Start a Project',
        'secondary_cta' => 'Explore Our Work',
        'proof_line' => null, // e.g. 'Trusted by 50+ brands' — only with proof
    ],

    // ── 3. Gates ────────────────────────────────────────────────────────
    // Stats band pattern: 4 numbers under the hero, repeated near the
    // bottom. Values stay null until David supplies verified numbers —
    // the partial renders nothing while ALL values in a variant are null.
    // Labels below are suggested slot labels ONLY (they render alongside
    // a value; replace them when real numbers land).
    //
    // NOTE: the /services stats band is owned by PricingService::stats()
    // (R6), not by this file. Do NOT add a 'services' key here.
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

    // Tiered offer pattern: six cards. Titles + descriptions are lorem
    // slots (view-generated, keyed offers.0 … offers.5). Badges are
    // Chada chrome. price_ngn / price_usd / price_period stay null until
    // David sets real prices (Open_Decision Q3 + pricing policy). Views
    // show "Contact for pricing" while null — NEVER invent a number.
    'offers' => [
        ['badge' => 'ADVISORY', 'price_ngn' => null, 'price_usd' => null, 'price_period' => null, 'cta_label' => 'Get Started'],
        ['badge' => 'SPRINT', 'price_ngn' => null, 'price_usd' => null, 'price_period' => null, 'cta_label' => 'Get Started'],
        ['badge' => 'BUILD', 'price_ngn' => null, 'price_usd' => null, 'price_period' => null, 'cta_label' => 'Get Started'],
        ['badge' => 'SYSTEM', 'price_ngn' => null, 'price_usd' => null, 'price_period' => null, 'cta_label' => 'Get Started'],
        ['badge' => 'RETAINER', 'price_ngn' => null, 'price_usd' => null, 'price_period' => '/month', 'cta_label' => 'Get Started'],
        ['badge' => 'CARE', 'price_ngn' => null, 'price_usd' => null, 'price_period' => '/month', 'cta_label' => 'Get Started'],
    ],

    // Free-consult CTA: headline + body are lorem slots. CTA is chrome.
    'audit' => [
        'cta_label' => 'Request a Free Review',
    ],

    // Transition band: headline + subhead are lorem slots (view-generated).

    // Capability checklist: the one section carrying REAL content — these
    // items are Chada capabilities derived from the approved services
    // array in partials/services.blade.php (Web Development, Funnel &
    // Automation, Paid Advertising, Brand & Strategy + tool stacks).
    // The intro paragraph is a lorem slot pending approved copy.
    // If an item overclaims, treat it as a content edit — raise it, do
    // not ship it.
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

    // Gated-content opt-in: Chada has no webinar/replay asset yet, so this
    // section is DISABLED. When enabled, copy comes from David and the form
    // posts to the existing /api/contact endpoint with form_type=webinar
    // (reuses the honeypot-protected pipeline).
    'webinar' => [
        'enabled' => false,
        'cta_label' => 'Get the Replay',
    ],

    // Testimonials: quote/name/role are lorem slots (3 cards) while this
    // array is EMPTY. When David supplies real quotes with permission,
    // each becomes ['quote' => …, 'name' => …, 'role' => …] here and the
    // view renders real entries instead of generated ones.
    //
    // NOTE (R3 handoff): views/partials/testimonials.blade.php loops over
    // this array. Empty array here = 0 cards rendered after R3 switches
    // the view to Lorem:: fallbacks when the array is empty. The 3 legacy
    // V2 entries were intentionally removed (literal V4-only replacement —
    // see D1).
    'testimonials' => [],

    // Standards band above testimonials (gated — do not invent principles).
    'manifesto' => [
        'enabled' => false,
        'label' => 'Our Standards',
        'items' => [],
    ],

    // Founder block: all prose is lorem while 'real' is false. Flip 'real'
    // => true when the actual bio, photo, and name land (Q6) — this also
    // activates the JSON-LD Person node (Redesign(8)).
    'founder' => [
        'real' => false,
        'photo' => '/assets/images/founder-placeholder.jpg',
        'cta_label' => 'Start a Conversation',
    ],

    // Integrations grid: tools drawn from the approved services stacks —
    // keep this list to tools Chada genuinely works with; add/remove with
    // David. Badges render "READY" (honest) — never a certification claim.
    'martech' => [
        'subintro' => null, // lorem slot until David approves a real line
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

    // Closing exclusivity band: lorem slots (view-generated).

    // Persistent chat widget: whatsapp_number stays null until
    // Open_Decision Q8 is answered — while null the widget remains the
    // documented no-op (constraint 14: never wire a guessed number).
    //
    // NOTE (R3 handoff): views/partials/chat-widget.blade.php currently
    // reads persona_name and greeting — both removed here (V4-only).
    // R3 upgrades chat-widget to use whatsapp_number / whatsapp_prefill
    // directly. See the outage scope note in the PR body.
    'chat' => [
        'whatsapp_number' => null, // E.164 format when set, e.g. '2348012345678'
        'whatsapp_prefill' => 'Hello Chada Digital — I would like to discuss a project.',
    ],

    // System Blueprints closing speed line: null until David approves a
    // MEASURED claim for a Chada system. Never a borrowed figure.
    'workflow_speed_claim' => null,

    // ── 4. Site-wide content (centralized Sep 1, 2026) ────────────────
    // All dynamic placeholder content lives in this file. Views read via
    // config('placeholders.contact.email') etc. — never hardcode contact
    // info, hero copy, or any other text in Blade.
    //
    // To update any text on the site: edit this file, save, refresh.
    // No code changes, no view edits, no rebuild needed.

    'contact' => [
        'email' => 'info@chadadigital.com',
        'phone' => '+2348101892632',
        'phone_display' => '+234 810 189 2632',
        'whatsapp' => '2348101892632',
        'location' => 'Lagos, Nigeria',
        'response_time' => '24 hours during business days. For urgent requests, WhatsApp us directly and we will respond within 2 hours.',
    ],

    'social' => [
        'linkedin' => '#',
        'instagram' => '#',
        'twitter' => '#',
    ],

    'brand' => [
        'name' => 'Chada Digital',
        'tagline' => 'Digital solutions that help businesses grow. Web development, funnel automation, paid advertising, and brand strategy.',
        'footer_tagline' => 'Digital solutions that help businesses grow. Web development, funnel automation, paid advertising, and brand strategy.',
        'founded_year' => 2023,
    ],

    'hero' => [
        'eyebrow' => 'Digital Solutions That Help Businesses Grow',
        'headline' => 'We Build Systems That Generate Revenue',
        'headline_highlight' => 'Revenue',
        'subhead' => 'Not just websites. Not just ads. We design, build, and automate digital systems that turn visitors into customers, and customers into repeat buyers.',
        'primary_cta' => 'Start a Project',
        'primary_cta_route' => 'contact',
        'secondary_cta' => 'Explore Our Work',
        'secondary_cta_route' => 'case-studies.index',
        // GATED proof line: renders nothing while null.
        'proof_line' => null,
    ],

    'services_page' => [
        'eyebrow' => 'Services & Pricing',
        'headline' => 'Transparent Pricing. No Surprises.',
        'subhead' => 'Every service has a fixed price or a clear monthly retainer. You know exactly what you are paying for before we start.',
        // Stats are GATED — null means the stat is hidden. Replace null with
        // a verified number when the Founder supplies one. NEVER invent.
        'stats' => [
            ['value' => null, 'label' => 'Projects Delivered'],
            ['value' => null, 'label' => 'Industries Served'],
            ['value' => null, 'label' => 'Client Retention'],
            ['value' => null, 'label' => 'Response Time'],
        ],
    ]),

    'about_page' => [
        'eyebrow' => 'About',
        'headline' => 'We Build Systems, Not Just Websites',
        'body' => 'Chada Digital is a Lagos-based digital agency specialising in web development, funnel automation, paid advertising, and brand strategy. We do not just build websites, we build systems that turn visitors into customers, and customers into repeat buyers.',
    ],

    'contact_page' => [
        'eyebrow' => 'Contact',
        'headline' => 'Let Us Build Your Next Revenue System',
        'subhead' => 'Tell us what you are trying to achieve. We will reply within 24 hours with a clear assessment of what is possible, how long it will take, and what it will cost.',
    ],

    'design_partner' => [
        'eyebrow' => 'Early Access',
        'headline' => 'No customer logos yet, we won\'t fake them.',
        'subhead' => 'Become a',
        'cta_text' => 'design partner',
        'cta_route' => 'contact',
    ],

    // Closing CTA on home + services
    'cta' => [
        'home_headline' => 'Still Have Questions?',
        'home_body' => 'Every project starts with a conversation. Tell us what you are trying to achieve and we will tell you exactly how we can help.',
        'home_button' => 'Start a Conversation',
        'services_headline' => 'Still Have Questions?',
        'services_body' => 'Every project starts with a conversation. Tell us what you are trying to achieve and we will tell you exactly how we can help.',
        'services_button' => 'Start a Conversation',
    ],
];
