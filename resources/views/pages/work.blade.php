@extends('layouts.app')

@section('content')
    <section class="px-6 py-16 md:py-24">
        <div class="mx-auto max-w-4xl text-center">
            <x-section-header
                label="Our Work"
                title="Built, shipped, measured."
                subtitle="A selection of systems we have designed, built, and shipped."
                center
            />
        </div>
    </section>

    @php
        $categories = app(\App\Services\CaseStudyService::class)->categories();
    @endphp

    @if(! empty($categories))
        <section class="px-6 pb-8">
            <div class="mx-auto max-w-7xl">
                <div class="showcase-filter-bar flex flex-wrap items-center justify-center gap-3">
                    <button
                        type="button"
                        class="filter-btn inline-flex items-center rounded-full border border-primary/40 bg-primary/10 px-5 py-2.5 text-sm font-medium text-primary transition-all duration-300 hover:bg-primary/10 hover:text-primary"
                        data-category="all"
                    >
                        All
                    </button>
                    @foreach($categories as $category)
                        <button
                            type="button"
                            class="filter-btn inline-flex items-center rounded-full border border-border bg-card/50 px-5 py-2.5 text-sm font-medium text-foreground transition-all duration-300 hover:bg-primary/10 hover:text-primary"
                            data-category="{{ $category }}"
                        >
                            {{ $category }}
                        </button>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="px-6 pb-20">
            <div class="mx-auto max-w-7xl">
                <div class="showcase-filter-grid grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($studies as $slug => $study)
                        <x-case-study-card :study="$study" :slug="$slug" />
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <section class="px-6 pb-24">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-muted-foreground">Case studies are being prepared. Check back soon.</p>
            </div>
        </section>
    @endif
@endsection
