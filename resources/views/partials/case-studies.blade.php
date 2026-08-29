@php
    $studies = $studies ?? app(\App\Services\CaseStudyService::class)->collection();
@endphp

@if($studies->isNotEmpty())
    <section class="px-6 py-20 md:py-28" id="case-studies">
        <div class="mx-auto max-w-7xl">
            <div class="mb-12">
                <x-section-header
                    label="Case Studies"
                    title="Built, shipped, measured."
                    subtitle="Verified results from systems we designed, built, and shipped."
                />
            </div>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($studies as $slug => $study)
                    <x-result-card :study="$study" :slug="$slug" />
                @endforeach
            </div>
        </div>
    </section>
@endif
