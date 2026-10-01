<?php

// Frequently Asked Questions — used by:
//   - resources/views/pages/services.blade.php (renders the FAQ section)
//   - resources/views/partials/structured-data.blade.php (emits FAQPage
//     JSON-LD schema on the /services page for AEO/GEO — LLM-based
//     answer engines like ChatGPT, Perplexity, Claude, Google AI
//     Overviews use FAQPage schema to extract Q&A pairs and cite them
//     in their generated answers).
//
// Voice: third-person, semi-formal — matches the rest of the site.
// Answers are 1-3 sentences, factual, and self-contained (no "see X"
// or "as mentioned above" — LLMs extract individual Q&A pairs, so
// each answer must stand alone).
//
// To add/remove FAQs: edit this array, save, refresh. No rebuild
// needed. The FAQ section on /services and the FAQPage JSON-LD schema
// both render from this single source.

return [
    [
        'q' => 'How much does a website cost?',
        'a' => 'Website packages start at ₦150,000 for a starter site and go up to ₦1.2 million for a premium e-commerce build. All ten packages are priced in Naira and listed on the /services page. You see the price before we start — no hourly retainers.',
    ],
    [
        'q' => 'How long does a website take to build?',
        'a' => 'A starter site takes 1–2 weeks. A business site takes 3–4 weeks. A premium or e-commerce build takes 4–8 weeks depending on scope. The timeline is confirmed in the quote before any work begins. Deadlines are met on the date we set.',
    ],
    [
        'q' => 'Do you work with businesses outside Lagos?',
        'a' => 'Yes. Chada Digital is based in Lagos but works with clients across Nigeria and internationally. Communication is via email, WhatsApp, and video calls. The team replies within one business day regardless of your time zone.',
    ],
    [
        'q' => 'What is included in the handover?',
        'a' => 'You receive the finished website, all source files, admin logins, a walkthrough of how to update content, and 30 days of post-launch support. Everything is handed over — we do not hold your site hostage for ongoing retainers.',
    ],
    [
        'q' => 'Can you fix or redesign an existing website?',
        'a' => 'Yes. About a third of the work is redesigning or fixing existing sites. The process starts with a discovery call to understand what is and is not working, then a quote for the redesign or fixes. Book a strategy session on the /contact page.',
    ],
    [
        'q' => 'Do you set up marketing automation?',
        'a' => 'Yes. Automation packages include contact forms that notify you on WhatsApp or email, CRM integration (HubSpot, Brevo, Mailchimp), and follow-up sequences that keep working even when you are not at your desk. Pricing is on the /services page.',
    ],
    [
        'q' => 'What is the difference between a strategy session and a done-for-you build?',
        'a' => 'A strategy session is a 60–90 minute consulting call where you get a written plan and recommendations — no code. A done-for-you build is the full implementation: design, development, automation, and launch. Strategy sessions suit businesses that want direction; builds suit businesses that want execution.',
    ],
    [
        'q' => 'Who is the founder of Chada Digital?',
        'a' => 'Chada Digital was founded by Okeoma Joseph in 2023. He leads a small team of designers and engineers in Lagos, Nigeria. You will work with him directly — not a sales rep or a project coordinator. Deadlines are met by the people who set them.',
    ],
];
