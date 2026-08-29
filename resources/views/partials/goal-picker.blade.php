@php
    $offers = config('placeholders.offers');
@endphp

<section class="px-6 py-20 md:py-28" id="goals">
    <div class="mx-auto max-w-7xl">
        <div class="mb-14 text-center">
            <x-section-badge>Services</x-section-badge>
            <x-section-heading class="mt-4">Pick your <span class="text-primary">starting point.</span></x-section-heading>
            <p class="mt-4 mx-auto max-w-2xl text-base text-muted-foreground">{{ \App\Support\Lorem::sentence('goal-picker.sub', 14) }}</p>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($offers as $i => $offer)
                <div class="group flex flex-col rounded-2xl border border-border bg-card p-8 transition-all duration-300 hover:-translate-y-1 hover:border-primary/40">
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">{{ $offer['badge'] ?? sprintf('OPTION %02d', $loop->iteration) }}</span>
                    <h3 class="mt-4 font-display text-lg font-bold tracking-tight">{{ $offer['title'] ?? \App\Support\Lorem::title("offers.{$i}.title", 4) }}</h3>
                    <p class="mt-3 text-sm leading-relaxed text-muted-foreground">{{ $offer['description'] ?? \App\Support\Lorem::paragraph("offers.{$i}.description", 2, 9) }}</p>

                    {{-- Pricing block — structure now, numbers when David sets them --}}
                    <div class="mt-6 rounded-xl border border-border/60 bg-background/60 px-4 py-3">
                        <span class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Pricing</span>
                        @if(! empty($offer['price_ngn']))
                            <p class="mt-1 font-display text-2xl font-bold tracking-tight text-primary">
                                &#8358;{{ number_format((float) $offer['price_ngn']) }}{{ $offer['price_period'] ?? '' }}
                            </p>
                            @if(! empty($offer['price_usd']))
                                <p class="text-xs text-muted-foreground">${{ number_format((float) $offer['price_usd'], 0) }}{{ $offer['price_period'] ?? '' }}</p>
                            @endif
                        @else
                            <p class="mt-1 text-sm font-semibold text-foreground">Contact for pricing</p>
                        @endif
                    </div>

                    <div class="mt-auto pt-6">
                        <x-button-outline href="{{ url('/#contact') }}">{{ $offer['cta_label'] ?? 'Get Started' }}</x-button-outline>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>