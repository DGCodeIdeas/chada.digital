@props(['value' => '', 'label' => ''])

<div class="flex flex-col gap-1">
    <span class="font-display text-3xl font-bold text-primary md:text-4xl">{{ $value ?: '—' }}</span>
    @if($label)
        <span class="text-xs uppercase tracking-widest text-muted-foreground">{{ $label }}</span>
    @endif
</div>
