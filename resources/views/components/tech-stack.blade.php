@props(['tools' => []])

@php
    $tools = $tools ?: [];
@endphp

@if(!empty($tools))
    <div class="flex flex-wrap gap-2">
        @foreach($tools as $tool)
            <span class="rounded-full border border-border bg-card px-4 py-2 text-sm">{{ $tool }}</span>
        @endforeach
    </div>
@endif
