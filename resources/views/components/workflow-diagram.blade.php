@props(['steps' => []])

@php
    $steps = $steps ?: [];
@endphp

@if(!empty($steps))
    <div class="overflow-x-auto">
        <div class="flex min-w-max items-stretch gap-2 pb-4 md:gap-4">
            @foreach($steps as $index => $step)
                @if($index > 0)
                    <div class="flex items-center text-muted-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5"><path d="m9 18 6-6-6-6"></path></svg>
                    </div>
                @endif

                <div class="flex min-w-[140px] flex-col items-center justify-center rounded-xl border border-border bg-card px-5 py-4 text-center">
                    @if(isset($step['step']))
                        <span class="text-xs uppercase tracking-widest text-muted-foreground">{{ $step['step'] }}</span>
                    @endif
                    @if(isset($step['tool']))
                        <span class="mt-1 font-semibold">{{ $step['tool'] }}</span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endif
