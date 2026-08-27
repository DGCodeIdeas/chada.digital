@php
    $assessment = config('placeholders.assessment');
@endphp

{{-- Placeholder only — Open_Decision.md Q4 (quiz fidelity) not yet decided.
     This is the lowest-cost static version. Q4 could upgrade this later
     to a scored interactive quiz or an embedded Typeform/Tally flow. --}}
<section class="px-6 py-20 md:py-28" id="assessment">
    <div class="mx-auto max-w-3xl text-center">
        <x-section-badge>Assessment</x-section-badge>
        <x-section-heading class="mt-4">{{ $assessment['headline'] }}</x-section-heading>
        <p class="mt-4 text-base text-muted-foreground">{{ $assessment['body'] }}</p>
        <div class="mt-8">
            <x-button-primary href="{{ url('/#contact') }}">Lorem Ipsum</x-button-primary>
        </div>
    </div>
</section>
