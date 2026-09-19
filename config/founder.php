<?php

// Founder section — /about page.

return [
    'eyebrow' => 'The Team',
    'heading' => 'The Team',
    'title' => 'Founder & Lead Engineer',
    'bio' => 'We started Chada Digital because we saw Nigerian businesses paying too much for websites that did not bring in customers. Our goal is straightforward: clear pricing, honest timelines, and work we are proud to put our name on.',
    'paragraphs' => [
        'We started Chada Digital because we saw Nigerian businesses paying too much for websites that did not bring in customers. Our goal is straightforward: clear pricing, honest timelines, and work we are proud to put our name on.',
        'We do not have a long client list yet, and we will not pretend otherwise. What we do have is a set of live demo projects and transparent pricing. Take a look and decide if the work feels right for you.',
        'We meet the deadlines we set. We reply within one business day. And we measure success by whether the work helps your business grow, not just by whether we shipped it.',
    ],
    'bio_points' => [
        'We deliver on the date we quoted. If anything changes, you hear it from us right away.',
        'We respond within one business day. You will not be left waiting.',
        'A finished website, a working automation, or a brand kit you can actually use.',
    ],
    // Real founder portrait — replaces the "CD" initials placeholder on /about.
    // Image lives at public/assets/images/founder.jpg (46 KB optimized JPEG,
    // 490x626 source downsized to fit the founder card). When 'real' is true
    // and 'photo' is set, the about page renders <img>; otherwise it falls
    // back to the initials placeholder.
    'photo' => '/assets/images/founder.jpg',
    'real' => true,
    'initials' => 'CD',
    'cta_label' => 'Start a Conversation',
    'cta_route' => 'contact',
];
