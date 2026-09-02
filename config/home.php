<?php

// Homepage sections — process steps, services teaser, section headings.
// Used by: pages/home.blade.php.
// To update: edit this file, save, refresh. No rebuild needed.

return [
    // "How We Work" process steps
    'process_eyebrow' => 'How We Work',
    'process_heading' => 'From First Call to First Sale',
    'steps' => [
        ['number' => '01', 'title' => 'Discover', 'desc' => 'We audit your current digital presence, analyse your competitors, and identify the highest-leverage opportunities.'],
        ['number' => '02', 'title' => 'Design', 'desc' => 'We design the user experience, information architecture, and visual system, all approved by you before we write a line of code.'],
        ['number' => '03', 'title' => 'Build', 'desc' => 'We build your system with clean, documented code. You get weekly progress updates and a staging URL for real-time feedback.'],
        ['number' => '04', 'title' => 'Scale', 'desc' => 'We launch, monitor, and optimise. A/B testing, conversion tracking, and continuous improvement are built into every engagement.'],
    ],

    // "What We Do" services teaser
    'services_eyebrow' => 'What We Do',
    'services_heading' => 'Four Services. One Goal: Revenue.',
    'services_subhead' => 'Every service we offer is measured against one metric: does it make you more money than it costs?',
    'services' => [
        ['icon' => 'code', 'title' => 'Web Development', 'desc' => 'Laravel, React, WordPress, Shopify. We build fast, secure, conversion-optimised websites and web applications.', 'tools' => ['Laravel', 'React', 'WordPress', 'Shopify']],
        ['icon' => 'zap', 'title' => 'Funnel & Automation', 'desc' => 'ManyChat, HubSpot, Zapier, Make. We design and build automated customer journeys that convert 24/7.', 'tools' => ['ManyChat', 'HubSpot', 'Zapier', 'Make']],
        ['icon' => 'target', 'title' => 'Paid Advertising', 'desc' => 'Meta Ads, Google Ads, LinkedIn Ads, TikTok Ads. We manage campaigns with relentless focus on ROAS.', 'tools' => ['Meta Ads', 'Google Ads', 'LinkedIn Ads', 'TikTok Ads']],
        ['icon' => 'pen-tool', 'title' => 'Brand & Strategy', 'desc' => 'Figma, brand strategy, CRO. We define how you look, sound, and convert, then we optimise all three.', 'tools' => ['Figma', 'Brand Strategy', 'CRO', 'A/B Testing']],
    ],

    // Final CTA
    'final_cta_heading' => 'Ready to Build Something That Sells?',
    'final_cta_body' => 'Book a free 30-minute consultation. We will audit your current setup and identify the highest-leverage opportunities, no pitch, no pressure.',
    'final_cta_button' => 'Book Free Consultation',
];
