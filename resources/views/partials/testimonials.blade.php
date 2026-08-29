@php
    $testimonials = config('placeholders.testimonials');
    $manifesto = config('placeholders.manifesto');
    $real = collect($testimonials)->filter(fn ($t) => ! empty($t['quote']))->values();
    $cards = $real->isNotEmpty() ? $real : collect(range(0, 2));
@endphp

<section class="px-6 py-20 md:py-28" id="testimonials">
    <div class="mx-auto max-w-7xl">
        <div class="mb-14 text-center">
            <x-section-badge>Testimonials</x-section-badge>
            <x-section-heading class="mt-4">What clients <span class="text-primary">say.</span></x-section-heading>
        </div>

        @if(! empty($manifesto['enabled']) && ! empty($manifesto['items']))
            <div class="mb-12 rounded-2xl border border-border bg-card/60 px-8 py-8 text-center">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">{{ $manifesto['label'] ?? 'Our Standards' }}</p>
                <p class="mt-3 font-display text-xl font-bold tracking-tight md:text-2xl">
                    {{ implode(' &middot; ', $manifesto['items']) }}
                </p>
            </div>
        @endif

        {{-- Static grid v1 — no carousel library present in resources/js/modules/.
             A carousel can be added later as an enhancement if desired. --}}
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($cards as $i => $card)
                @php
                    $isReal = is_array($card);
                    $quote = ($isReal && ($card['quote'] ?? null)) ? $card['quote'] : \App\Support\Lorem::paragraph("testimonials.{$i}.quote", 2, 14);
                    $name  = ($isReal && ($card['name'] ?? null)) ? $card['name']  : \App\Support\Lorem::name("testimonials.{$i}");
                    $role  = ($isReal && ($card['role'] ?? null)) ? $card['role']  : \App\Support\Lorem::title("testimonials.{$i}.role", 3) . ', ' . \App\Support\Lorem::title("testimonials.{$i}.org", 2) . ' Ltd.';
                @endphp
                <div class="rounded-2xl border border-border bg-card p-8">
                    <p class="text-sm leading-relaxed text-muted-foreground">{{ $quote }}</p>
                    <div class="mt-6 border-t border-border/40 pt-6">
                        <p class="font-display text-sm font-bold">{{ $name }}</p>
                        <p class="mt-1 text-xs text-muted-foreground">{{ $role }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>