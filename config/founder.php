<?php

// Founder section — /about page.
//
// Voice: third-person, semi-formal. Names the founder (Okeoma Joseph) and
// credits the team he leads. No "I" — the team is acknowledged alongside
// the founder. The /about page renders this copy next to the founder
// portrait.

return [
    'eyebrow' => 'The Team',
    'heading' => 'The Team',
    'title' => 'Founder & Lead Engineer',
    'bio' => 'Okeoma Joseph founded Chada Digital and leads a small team of designers and engineers in Lagos. He sets the standard for the work; the team designs, builds, and delivers it. When a project is done, complete files and access are handed over.',
    'paragraphs' => [
        'Okeoma Joseph founded Chada Digital and leads a small team of designers and engineers in Lagos. He sets the standard for the work; the team designs, builds, and delivers it. When a project is done, complete files and access are handed over.',
        'The studio is still early. There is no long client list to display. Live demos are on the site so you can judge the work for yourself.',
        'Deadlines are the dates in the quote. Replies come within one business day. Success is whether the site, workflow, or brand kit is useful to the people it was made for.',
    ],
    'bio_points' => [
        'The team delivers on the date quoted. If that changes, you hear it from them first.',
        'Someone replies within one business day. You will not be left waiting.',
        'A finished website, a working automation, or a brand kit you can actually use.',
    ],
    // Real founder portrait — replaces the "CD" initials placeholder on /about.
    // Image lives at public/assets/images/founder.jpg (46 KB optimized JPEG,
    // 490x626 source downsized to fit the founder card). When 'real' is true
    // and 'photo' is set, the about page renders <img>; otherwise it falls
    // back to the initials placeholder.
    'photo' => '/assets/images/founder.jpg',
    'real' => true,
    'initials' => 'OJ',
    'cta_label' => 'Start a Conversation',
    'cta_route' => 'contact',
];
