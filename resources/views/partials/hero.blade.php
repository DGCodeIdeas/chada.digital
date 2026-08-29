@php
    $hero = config('placeholders.hero');
    $headline = \App\Support\Lorem::title('hero.headline', 6);
    $words = explode(' ', $headline);
    $last = array_pop($words);
@endphp
<section class="relative overflow-hidden bg-muted/30 px-6 pb-20 pt-12 md:pt-20" id="hero">
    <div class="relative mx-auto max-w-3xl text-center">
        <div class="flex flex-col items-center">
            <span class="mb-5 inline-block text-xs font-semibold uppercase tracking-[0.3em] text-primary">Based in Lagos &middot; Serving the World</span>
            <h1 class="font-display text-4xl font-bold leading-[1.1] tracking-tight md:text-5xl">
                {{ implode(' ', $words) }}<br/><span class="text-primary">{{ $last }}</span>
            </h1>
            <p class="mt-6 max-w-xl text-base leading-relaxed text-muted-foreground md:text-lg">{{ \App\Support\Lorem::paragraph('hero.subhead', 2, 12) }}</p>
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <a class="group inline-flex items-center gap-2 rounded-full bg-primary px-7 py-3.5 text-xs font-semibold uppercase tracking-widest text-primary-foreground transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30" href="{{ url('/#contact') }}">
                    {{ $hero['primary_cta'] ?? 'Start a Project' }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4 transition-transform group-hover:translate-x-1"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
                <a class="group inline-flex items-center gap-2 rounded-full border border-border bg-card px-7 py-3.5 text-xs font-semibold uppercase tracking-widest text-foreground transition-all hover:border-primary/40 hover:text-primary" href="{{ route('work') }}">
                    {{ $hero['secondary_cta'] ?? 'Explore Our Work' }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4 transition-transform group-hover:translate-y-1"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg>
                </a>
            </div>
            @if(! empty($hero['proof_line']))
                <p class="mt-10 text-sm font-medium uppercase tracking-widest text-muted-foreground">{{ $hero['proof_line'] }}</p>
            @endif
        </div>
    </div>
</section>