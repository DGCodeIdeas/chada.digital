@php
    // Decision 8 / Q1: client logos pending. Populate with entries shaped like:
    // ['src' => asset('assets/images/clients/foo.svg'), 'alt' => 'Foo']
    $clientLogos = [];
@endphp

@if(!empty($clientLogos))
    <section class="border-y border-border/40 bg-muted/40 px-6 py-10">
        <div class="mx-auto max-w-7xl">
            <p class="mb-6 text-center text-xs font-semibold uppercase tracking-[0.3em] text-muted-foreground">Trusted by teams at:</p>
            <div class="flex items-center justify-center gap-10 overflow-x-auto">
                @foreach($clientLogos as $logo)
                    <img src="{{ $logo['src'] }}" alt="{{ $logo['alt'] }}" class="h-8 w-auto opacity-50 grayscale transition-opacity hover:opacity-100" />
                @endforeach
            </div>
        </div>
    </section>
@endif
