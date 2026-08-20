<section class="px-6 py-20 md:py-28" id="case-studies">
    <div class="mx-auto max-w-7xl">
        <div class="mb-12">
            <x-section-header label="Case Studies" title="Real Results for Real Businesses" />
        </div>

        @if(isset($studies) && $studies->isNotEmpty())
            <div class="grid gap-6 sm:grid-cols-2">
                @foreach($studies as $slug => $study)
                    <x-case-study-card :study="$study" :slug="$slug" />
                @endforeach
            </div>
        @else
            <p class="text-muted-foreground">Case studies coming soon.</p>
        @endif
    </div>
</section>
