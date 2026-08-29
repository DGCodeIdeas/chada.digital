@php
    $founder = config('placeholders.founder');
@endphp

<section class="px-6 py-20 md:py-28" id="founder">
    <div class="mx-auto grid max-w-7xl gap-12 lg:grid-cols-2 lg:items-center">
        <div class="aspect-square w-full max-w-md mx-auto lg:mx-0 overflow-hidden rounded-2xl border border-border bg-card flex items-center justify-center">
            @if(! empty(data_get($founder, 'real')))
                <img class="h-full w-full object-cover" src="{{ data_get($founder, 'photo') }}" alt="{{ data_get($founder, 'name', 'Founder') }}" />
            @endif
        </div>
        <div>
            <x-section-badge>About</x-section-badge>
            <x-section-heading class="mt-4">Meet <span class="text-primary">the founder.</span></x-section-heading>
            <p class="mt-2 text-sm font-semibold text-muted-foreground">{{ data_get($founder, 'title') ?? \App\Support\Lorem::title('founder.role', 3) }}</p>
            <p class="mt-6 text-base leading-relaxed text-muted-foreground">{{ data_get($founder, 'bio') ?? \App\Support\Lorem::paragraph('founder.bio', 2, 12) }}</p>
            <ul class="mt-6 space-y-3">
                @foreach(range(0, 2) as $i)
                    <li class="flex items-start gap-3">
                        <span class="mt-1 inline-flex size-5 shrink-0 items-center justify-center rounded-full bg-primary/15 text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="size-3"><path d="M20 6 9 17l-5-5"/></svg>
                        </span>
                        <span class="text-sm leading-relaxed text-muted-foreground">{{ data_get($founder, "bio_points.{$i}") ?? \App\Support\Lorem::sentence("founder.point.{$i}", 10) }}</span>
                    </li>
                @endforeach
            </ul>
            <div class="mt-8">
                <x-button-primary href="{{ url('/#contact') }}">{{ data_get($founder, 'cta_label') ?? 'Start a Conversation' }}</x-button-primary>
            </div>
        </div>
    </div>
</section>