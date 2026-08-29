@php
    $audit = config('placeholders.audit');
@endphp

<section class="px-6 py-16 md:py-20" id="audit">
    <div class="mx-auto max-w-3xl text-center rounded-2xl border border-primary/20 bg-primary/5 px-8 py-12">
        <x-section-badge>Free Review</x-section-badge>
        <x-section-heading class="mt-4">{{ data_get($audit, 'headline') ?? \App\Support\Lorem::sentence('audit.headline', 11) }}</x-section-heading>
        <p class="mt-4 text-base text-muted-foreground">{{ data_get($audit, 'body') ?? \App\Support\Lorem::paragraph('audit.body', 2, 12) }}</p>
        <div class="mt-8">
            <x-button-primary href="{{ url('/#contact') }}">{{ data_get($audit, 'cta_label') ?? 'Request a Free Review' }}</x-button-primary>
        </div>
    </div>
</section>