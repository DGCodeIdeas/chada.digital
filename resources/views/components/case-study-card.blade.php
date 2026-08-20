@props(['study' => [], 'slug' => ''])

@php
    $study = $study ?: [];
    $category = $study['category'] ?? '';
    $client = $study['client'] ?? 'Untitled';
    $thumbnail = $study['thumbnail'] ?? '';
    $hasImage = $thumbnail && file_exists(public_path(ltrim($thumbnail, '/')));
    $initials = collect(explode(' ', $client))->take(2)->map(fn ($w) => mb_substr($w, 0, 1))->join('');
    $tags = $study['tags'] ?? [];
@endphp

<a
    href="{{ route('case-study.show', $slug) }}"
    data-category="{{ $category }}"
    class="work-card group block overflow-hidden rounded-2xl border border-border bg-card transition-all duration-300 hover:-translate-y-1 hover:border-primary/40 hover:shadow-xl hover:shadow-primary/10"
>
    <div class="relative aspect-[16/10] w-full overflow-hidden bg-primary/10">
        @if($hasImage)
            <img src="{{ asset(ltrim($thumbnail, '/')) }}" alt="{{ $client }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" />
        @else
            <div class="flex h-full w-full items-center justify-center">
                <span class="font-display text-4xl font-bold text-primary/60">{{ $initials ?: 'CS' }}</span>
            </div>
        @endif
    </div>

    <div class="flex flex-col gap-3 p-6">
        <div class="flex items-center justify-between gap-3">
            <h3 class="font-display text-xl font-bold tracking-tight">{{ $client }}</h3>
            @if($category)
                <span class="shrink-0 rounded-full border border-border px-3 py-1 text-xs font-medium text-muted-foreground">{{ $category }}</span>
            @endif
        </div>

        @if(isset($study['metric']))
            <p class="text-sm font-semibold text-primary">{{ $study['metric'] }}</p>
        @endif

        @if(!empty($tags))
            <p class="text-xs uppercase tracking-widest text-muted-foreground">{{ implode(' · ', $tags) }}</p>
        @endif

        @if(isset($study['excerpt']))
            <p class="text-sm leading-relaxed text-muted-foreground">{{ $study['excerpt'] }}</p>
        @endif

        <span class="mt-2 inline-flex items-center gap-1.5 text-sm font-semibold text-primary transition-transform group-hover:translate-x-1">
            View Case Study
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
        </span>
    </div>
</a>
