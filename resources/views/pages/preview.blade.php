@extends('layouts.app')

@section('content')

<section style="background: var(--md-sys-color-surface-container-low); padding: 1.5rem 0;">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <h5 class="fw-semibold mb-1" style="color: var(--md-sys-color-on-surface);">{{ $project['title'] }}</h5>
                <p class="mb-0" style="color: var(--md-sys-color-on-surface-variant); font-size: 0.875rem;">{{ $project['category'] }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('demos') }}" class="btn btn-outline-secondary btn-sm rounded-pill" style="border-color: var(--md-sys-color-outline); color: var(--md-sys-color-on-surface-variant);">
                    ← All Demos
                </a>
                <a href="{{ route('demo.content', ['slug' => $project['slug']]) }}" target="_blank" class="btn btn-primary btn-sm rounded-pill" style="background: var(--md-sys-color-primary); border-color: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary);">
                    Open in New Tab
                </a>
            </div>
        </div>
    </div>
</section>

<section style="background: var(--md-sys-color-surface); padding: 0;">
    <div class="container-fluid p-0">
        <div class="ratio ratio-16x9" style="min-height: 80vh;">
            <iframe src="{{ route('demo.content', ['slug' => $project['slug']]) }}/" title="{{ $project['title'] }}" style="border: none; width: 100%; height: 100%;" loading="eager"></iframe>
        </div>
    </div>
</section>

@endsection
