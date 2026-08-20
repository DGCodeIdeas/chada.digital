@props(['label' => '', 'title' => '', 'subtitle' => '', 'center' => false])

<div @class([
    'space-y-4',
    'text-center mx-auto max-w-2xl' => $center,
])>
    @if($label)
        <span class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">{{ $label }}</span>
    @endif

    @if($title)
        <h2 class="font-display text-3xl font-bold tracking-tight md:text-5xl">{{ $title }}</h2>
    @endif

    @if($subtitle)
        <p class="mt-4 text-base text-muted-foreground">{{ $subtitle }}</p>
    @endif
</div>
