<?php

// Homepage sections — process steps, services teaser, section headings.

return [
    // "How We Work" process steps
    'process_eyebrow' => 'How We Work',
    'process_heading' => 'From First Call to Launch',
    'steps' => [
        ['number' => '01', 'title' => 'Discover', 'desc' => 'Tell us how the business actually works. Budget, customers, what is already live. We pick a tier from there.'],
        ['number' => '02', 'title' => 'Design', 'desc' => 'You see the look and the page plan first. Nothing gets built until you say yes.'],
        ['number' => '03', 'title' => 'Build', 'desc' => 'Then we write the site, the workflow, or the brand files.'],
        ['number' => '04', 'title' => 'Launch', 'desc' => 'It goes live. You get the logins, a short walkthrough, and support if you want it.'],
    ],

    // "What We Do" services teaser — matches the 3 pricing categories
    'services_eyebrow' => 'What We Do',
    'services_heading' => 'What you can hire us for',
    'services_subhead' => 'Each package has a Naira range on the services page. You know the number before we start.',
    'services' => [
        ['icon' => 'code', 'title' => 'Website Design', 'desc' => 'Landing pages, business sites, and shops. They work on a phone, they show up on Google, and people can actually reach you.', 'tools' => ['Starter', 'Business', 'Premium', 'E-Commerce']],
        ['icon' => 'zap', 'title' => 'Automation', 'desc' => 'Forms that ping you on WhatsApp or email. CRM hooks. Follow-ups that keep going without you sitting on the inbox.', 'tools' => ['Starter', 'Business', 'Advanced']],
        ['icon' => 'pen-tool', 'title' => 'Branding', 'desc' => 'Logo, colours, type, social templates, and the stationery you hand people.', 'tools' => ['Starter', 'Business', 'Complete']],
    ],

    // Final CTA
    'final_cta_heading' => 'Want a number and a date?',
    'final_cta_body' => 'Pick a package, send a message. We reply within 24 hours with next steps.',
    'final_cta_button' => 'View Services & Pricing',
];
