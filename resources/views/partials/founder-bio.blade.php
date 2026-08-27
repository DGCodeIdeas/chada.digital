@php
    $founder = config('placeholders.founder');
@endphp

<section class="px-6 py-20 md:py-28" id="founder">
    <div class="mx-auto grid max-w-7xl gap-12 lg:grid-cols-2 lg:items-center">
        <div class="aspect-square w-full max-w-md mx-auto lg:mx-0 overflow-hidden rounded-2xl border border-border bg-card flex items-center justify-center">
            {{-- Placeholder only — /assets/images/founder-placeholder.jpg is a neutral
                 silhouette/initials graphic, not a real photo of any person. Replace
                 with the Founder's real headshot when available (Open_Decision.md Q6). --}}
            <img class="h-full w-full object-cover" src="{{ $founder['photo'] }}" alt="{{ $founder['name'] }}" />
        </div>
        <div>
            <x-section-badge>About the Founder</x-section-badge>
            <x-section-heading class="mt-4">{{ $founder['name'] }}</x-section-heading>
            <p class="mt-2 text-sm font-semibold text-muted-foreground">{{ $founder['title'] }}</p>
            <p class="mt-6 text-base leading-relaxed text-muted-foreground">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <ul class="mt-6 space-y-3">
                @foreach($founder['bio_points'] as $point)
                    <li class="flex items-start gap-3">
                        <span class="mt-1 inline-flex size-5 shrink-0 items-center justify-center rounded-full bg-primary/15 text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="size-3"><path d="M20 6 9 17l-5-5"/></svg>
                        </span>
                        <span class="text-sm leading-relaxed text-muted-foreground">{{ $point }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
