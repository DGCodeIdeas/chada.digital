@php
    $offers = config('placeholders.offers');
@endphp

<section class="px-6 py-20 md:py-28" id="goals">
    <div class="mx-auto max-w-7xl">
        <div class="mb-14 text-center">
            <x-section-badge>Pick Your Goal</x-section-badge>
            <x-section-heading class="mt-4">I want Chada Digital to <span class="text-primary">deliver this for me.</span></x-section-heading>
            <p class="mt-4 max-w-2xl mx-auto text-base text-muted-foreground">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($offers as $index => $offer)
                <div class="group rounded-2xl border border-border bg-card p-8 transition-all duration-300 hover:-translate-y-1 hover:border-primary/40">
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">Option {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3 class="mt-4 font-display text-lg font-bold tracking-tight">{{ $offer['title'] }}</h3>
                    <p class="mt-3 text-sm leading-relaxed text-muted-foreground">{{ $offer['description'] }}</p>
                    <div class="mt-6">
                        <x-button-outline href="{{ url('/#contact') }}">{{ $offer['cta_label'] }}</x-button-outline>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
