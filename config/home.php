<?php

// Homepage sections — process steps, services teaser, section headings.

return [
    // "How We Work" process steps
    'process_eyebrow' => 'How We Work',
    'process_heading' => 'From First Call to Launch',
    'steps' => [
        ['number' => '01', 'title' => 'Discover', 'desc' => 'We start by understanding how your business works, who your customers are, and what budget makes sense. Then we suggest a tier.'],
        ['number' => '02', 'title' => 'Design', 'desc' => 'You see the design and the page plan before any code is written. We do not start building until you are happy with the direction.'],
        ['number' => '03', 'title' => 'Build', 'desc' => 'Then we build the site, the automation, or the brand identity. You get progress updates along the way.'],
        ['number' => '04', 'title' => 'Launch', 'desc' => 'We deploy, test, and hand over. You get the logins, a walkthrough, and ongoing support if you need it.'],
    ],

    // "What We Do" services teaser — matches the 3 pricing categories
    'services_eyebrow' => 'What We Do',
    'services_heading' => 'What we do',
    'services_subhead' => 'Each package has a Naira price range on the services page. You know the cost before we begin.',
    'services' => [
        ['icon' => 'code', 'title' => 'Website Design', 'desc' => 'Landing pages, business sites, and online shops. Mobile-friendly, findable on Google, and built so customers can reach you.', 'tools' => ['Starter', 'Business', 'Premium', 'E-Commerce']],
        ['icon' => 'zap', 'title' => 'Automation', 'desc' => 'Forms that notify you on WhatsApp or email. CRM integration. Follow-up sequences that keep working even when you are not at your desk.', 'tools' => ['Starter', 'Business', 'Advanced']],
        ['icon' => 'pen-tool', 'title' => 'Branding', 'desc' => 'Logo, colour palette, typography, social media templates, and business stationery.', 'tools' => ['Starter', 'Business', 'Complete']],
    ],

    // Final CTA
    'final_cta_heading' => 'Ready to start?',
    'final_cta_body' => 'Pick a package and send a message. We reply within 24 hours with next steps.',
    'final_cta_button' => 'View Services & Pricing',
];
