<?php

// /services page copy.
// Used by: pages/services.blade.php.
// To update: edit this file, save, refresh. No rebuild needed.

return [
    'eyebrow' => 'Services & Pricing',
    'headline' => 'Transparent Pricing. No Surprises.',
    'subhead' => 'Every service has a fixed price or a clear monthly retainer. You know exactly what you are paying for before we start.',
    // Stats are GATED — null means the stat is hidden. The stats band
    // hides entirely when all values are null. Replace null with a
    // verified number when the Founder supplies one. NEVER invent.
    'stats' => [
        ['value' => null, 'label' => 'Projects Delivered'],
        ['value' => null, 'label' => 'Industries Served'],
        ['value' => null, 'label' => 'Client Retention'],
        ['value' => null, 'label' => 'Response Time'],
    ],
];
