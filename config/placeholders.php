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
    'hero' => [
        // Eyebrow + headline + subhead are lorem slots (view-generated).
        // The eyebrow "Based in Lagos · Serving the World" is pre-existing
        // approved Chada copy and stays inline in the view.
        'primary_cta' => 'Start a Project',
        'secondary_cta' => 'Explore Our Work',
        // GATED proof line: renders nothing while null (needs verification
        // before a "trusted by N" claim ships — constraint 14).
        // NOTE: partials/hero.blade.php line 20 currently hardcodes a
        // "Trusted by 50+ brands" claim. That line is the live constraint-14
        // violation (D12); it ships because R3 removes it. Do NOT release
        // to production before R3 lands. Flagged in the PR body.
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
];
