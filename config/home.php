<?php

// Homepage sections — process steps, services teaser, section headings.

return [
    // "How We Work" process steps
    'process_eyebrow' => 'How We Work',
    'process_heading' => 'From First Call to Launch',
    'steps' => [
        ['number' => '01', 'title' => 'Discover', 'desc' => 'The team starts by learning how the business actually works, and who it is for. That conversation shapes the brief.'],
        ['number' => '02', 'title' => 'Design', 'desc' => 'You see the design and the page plan before any code is written. Building starts once the direction is agreed.'],
        ['number' => '03', 'title' => 'Build', 'desc' => 'Then the site, the automation, or the brand identity gets built. You get progress updates along the way.'],
        ['number' => '04', 'title' => 'Launch', 'desc' => 'The team deploys, tests, and hands over. You get the logins, a walkthrough, and help after launch if you need it.'],
    ],

    // "What We Do" services teaser — matches the 3 pricing categories
    'services_eyebrow' => 'What We Do',
    'services_heading' => 'What we do',
    'services_subhead' => 'Websites, automation, and brands. Scoped so the work fits the people who will use it.',
    'services' => [
        ['icon' => 'code', 'title' => 'Website Design', 'desc' => 'Landing pages, business sites, and shops. Built so customers can find you on a phone and get in touch.', 'tools' => ['Starter', 'Business', 'Premium', 'E-Commerce']],
        ['icon' => 'zap', 'title' => 'Automation', 'desc' => 'Forms that notify you on WhatsApp or email. CRM setup. Follow-up sequences that keep working when you are away from the desk.', 'tools' => ['Starter', 'Business', 'Advanced']],
        ['icon' => 'pen-tool', 'title' => 'Branding', 'desc' => 'Logo, colour palette, typography, social templates, and stationery you can actually use.', 'tools' => ['Starter', 'Business', 'Complete']],
    ],

    // Final CTA
    'final_cta_heading' => 'Tell the studio what you need',
    'final_cta_body' => 'A short note is enough. The team replies within a business day.',
    'final_cta_button' => 'Start a Conversation',
];
