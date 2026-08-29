@php
    $variant = $variant ?? 'home_top';
    $stats = config("placeholders.stats.{$variant}", []);
    $ready = collect($stats)->filter(fn ($s) => ! empty($s['value']))->values();
@endphp
@if($ready->isNotEmpty())
    <section class="border-y border-border/60 bg-card/60 px-6 py-10" aria-label="Results">
        <div class="mx-auto grid max-w-7xl grid-cols-2 gap-8 md:grid-cols-4">
            @foreach($ready as $stat)
                <div class="text-center">
                    <p class="font-display text-3xl font-bold tracking-tight text-foreground md:text-4xl">{{ $stat['value'] }}</p>
                    <p class="mt-2 text-xs font-medium uppercase tracking-widest text-muted-foreground">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </section>
@endif