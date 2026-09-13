@extends('layouts.app')

@section('content')

<section style="background: linear-gradient(135deg, #f8f6f3 0%, #f0ede8 100%); padding: 2rem 0 1rem;">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div>
                <h5 class="fw-semibold mb-0" style="color: var(--md-sys-color-on-surface); font-size: 1.125rem;">{{ $project['title'] }}</h5>
                <p class="mb-0" style="color: var(--md-sys-color-on-surface-variant); font-size: 0.75rem;">{{ $project['category'] }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('demos') }}" class="btn btn-outline-secondary btn-sm rounded-pill" style="border-color: var(--md-sys-color-outline); color: var(--md-sys-color-on-surface-variant); font-size: 0.75rem;">
                    ← All Work
                </a>
                <a href="{{ route('demo.content', ['slug' => $project['slug']]) }}/" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm rounded-pill" style="background: var(--md-sys-color-primary); border-color: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary); font-size: 0.75rem;">
                    Open Fullscreen
                </a>
            </div>
        </div>
    </div>
</section>

<section style="background: var(--md-sys-color-surface); padding: 0 0 2rem;">
    <div class="container">
        <div class="rounded-3 overflow-hidden" style="box-shadow: 0 4px 16px rgba(0,0,0,0.06);">
            <div class="ratio ratio-16x9" style="max-height: 500px;">
                <iframe src="{{ route('demo.content', ['slug' => $project['slug']]) }}/" title="{{ $project['title'] }}" style="border: none; width: 100%; height: 100%;" loading="eager"></iframe>
            </div>
        </div>
    </div>
</section>

@endsection
