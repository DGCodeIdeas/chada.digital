@php
    $testimonials = config('placeholders.testimonials');
@endphp

<section class="px-6 py-20 md:py-28" id="testimonials">
    <div class="mx-auto max-w-7xl">
        <div class="mb-14 text-center">
            <x-section-badge>Testimonials</x-section-badge>
            <x-section-heading class="mt-4">What clients <span class="text-primary">say.</span></x-section-heading>
        </div>
        {{-- Static grid v1 — no carousel library present in resources/js/modules/.
             A carousel can be added later as an enhancement if desired. --}}
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($testimonials as $testimonial)
                <div class="rounded-2xl border border-border bg-card p-8">
                    <p class="text-sm leading-relaxed text-muted-foreground">{{ $testimonial['quote'] }}</p>
                    <div class="mt-6 border-t border-border/40 pt-6">
                        <p class="font-display text-sm font-bold">{{ $testimonial['name'] }}</p>
                        <p class="mt-1 text-xs text-muted-foreground">{{ $testimonial['role'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
