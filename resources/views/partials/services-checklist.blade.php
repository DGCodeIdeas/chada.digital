@php
    $checklist = config('placeholders.checklist');
@endphp

<section class="px-6 py-20 md:py-28" id="services-checklist">
    <div class="mx-auto max-w-7xl">
        <div class="mb-12 max-w-3xl">
            <x-section-badge>What We Do</x-section-badge>
            <x-section-heading class="mt-4">Everything we <span class="text-primary">bring to the table.</span></x-section-heading>
            <p class="mt-4 text-base leading-relaxed text-muted-foreground">{{ data_get($checklist, 'intro') ?? \App\Support\Lorem::paragraph('checklist.intro', 2, 12) }}</p>
        </div>
        <div class="grid gap-3 sm:grid-cols-2">
            @foreach($checklist['items'] as $item)
                <div class="flex items-center gap-3 rounded-xl border border-border bg-card px-5 py-4">
                    <span class="inline-flex size-6 shrink-0 items-center justify-center rounded-full bg-primary/15 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="size-3.5"><path d="M20 6 9 17l-5-5"/></svg>
                    </span>
                    <span class="text-sm font-medium text-foreground">{{ $item }}</span>
                </div>
            @endforeach
        </div>
        <div class="mt-10 flex flex-wrap gap-4">
            <x-button-primary href="{{ url('/#goals') }}">See Services</x-button-primary>{{-- TODO(R3): swap to url('/services') once Phase 6 merges --}}
            <x-button-outline href="{{ url('/#contact') }}">Get In Touch</x-button-outline>
        </div>
    </div>
</section>