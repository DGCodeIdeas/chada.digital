@php
    $exclusivity = config('placeholders.exclusivity');
@endphp

@if(! empty($exclusivity))
    <section class="px-6 py-20 md:py-28" id="exclusivity">
        <div class="mx-auto max-w-3xl text-center">
            <x-section-badge>Exclusivity</x-section-badge>
            <x-section-heading class="mt-4">{{ $exclusivity['headline'] }}</x-section-heading>
            <p class="mt-4 text-base text-muted-foreground">{{ $exclusivity['body'] }}</p>
            <div class="mt-8">
                <x-button-primary href="{{ url('/#contact') }}">Start a Project</x-button-primary>
            </div>
        </div>
    </section>
@endif
