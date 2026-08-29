@props([
    'steps' => [],
    'label' => null,   // optional pipeline label, e.g. client name (renders above the row)
    'compact' => false, // true = tighter boxes for dense pages like the home section
])

@php
    $steps = $steps ?: [];
@endphp

@if(! empty($steps))
    <div class="workflow-pipeline">
        @if($label)
            <p class="mb-3 text-xs font-semibold uppercase tracking-[0.3em] text-primary">{{ $label }}</p>
        @endif
        <div class="overflow-x-auto pb-2">
            <div class="flex min-w-max items-stretch gap-2 md:gap-3">
                @foreach($steps as $index => $step)
                    @if($index > 0)
                        <div class="flex items-center text-primary/70">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5 shrink-0"><path d="m9 18 6-6-6-6"></path></svg>
                        </div>
                    @endif

                    <div @class([
                        'flex flex-col justify-center rounded-xl border border-border bg-card px-5 text-left',
                        'min-w-[150px] py-3' => ! $compact,
                        'min-w-[140px] py-2.5' => $compact,
                    ])>
                        @if(isset($step['step']))
                            <span class="text-sm font-semibold leading-snug text-foreground">{{ $step['step'] }}</span>
                        @endif
                        @if(isset($step['tool']))
                            <span class="mt-1 text-xs uppercase tracking-widest text-muted-foreground">{{ $step['tool'] }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
