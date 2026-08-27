@php
    $services = [
        [
            'title' => 'Web Development',
            'desc' => 'High-converting websites and web apps built for speed, SEO, and conversion.',
            'stack' => ['Laravel', 'React', 'WordPress', 'Shopify'],
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="size-6"><path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/></svg>',
        ],
        [
            'title' => 'Funnel & Automation',
            'desc' => 'Smart workflows and AI integrations that save time and close deals while you sleep.',
            'stack' => ['ManyChat', 'HubSpot', 'Zapier', 'Make'],
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="size-6"><circle cx="13.5" cy="6.5" r=".5"/><circle cx="17.5" cy="10.5" r=".5"/><circle cx="8.5" cy="7.5" r=".5"/><circle cx="6.5" cy="12.5" r=".5"/><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.555C21.965 6.012 17.461 2 12 2z"/></svg>',
        ],
        [
            'title' => 'Paid Advertising',
            'desc' => 'Meta, Google, and LinkedIn campaigns that deliver measurable ROI, not just impressions.',
            'stack' => ['Meta Ads', 'Google Ads', 'LinkedIn Ads'],
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="size-6"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>',
        ],
        [
            'title' => 'Brand & Strategy',
            'desc' => 'Strategic branding and data-driven roadmaps that align your digital presence with revenue goals.',
            'stack' => ['Figma', 'Brand Strategy', 'CRO'],
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="size-6"><rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/></svg>',
        ],
    ];
@endphp

<section class="px-6 py-20 md:py-28" id="services-checklist">
    <div class="mx-auto max-w-7xl">
        <div class="mb-14 text-center">
            <x-section-badge>What's Included</x-section-badge>
            <x-section-heading class="mt-4">Everything we <span class="text-primary">bring to the table.</span></x-section-heading>
        </div>
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($services as $service)
                <div class="rounded-2xl border border-border bg-card p-6">
                    <div class="mb-4 inline-flex size-11 items-center justify-center rounded-xl bg-primary/15 text-primary">
                        {!! $service['icon'] !!}
                    </div>
                    <h3 class="font-display text-base font-bold tracking-tight">{{ $service['title'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ $service['desc'] }}</p>
                    <p class="mt-3 text-xs text-muted-foreground">{{ implode(' · ', $service['stack']) }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
