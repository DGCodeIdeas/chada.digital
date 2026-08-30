@extends('layouts.app')

@section('content')

<section style="background: linear-gradient(135deg, #f8f6f3 0%, #f0ede8 100%); padding: 5rem 0 3rem;">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge rounded-pill" style="background: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container); font-weight: 500;">{{ $study['industry'] }}</span>
                    <span class="badge rounded-pill" style="background: var(--md-sys-color-secondary-container); color: var(--md-sys-color-on-secondary-container); font-weight: 500;">{{ $study['category'] }}</span>
                    <span class="text-muted" style="font-size: 0.875rem;">{{ $study['timeframe'] }}</span>
                </div>
                <h1 class="display-5 fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">{{ $study['client'] }}</h1>
                <p class="lead mb-4" style="color: var(--md-sys-color-on-surface-variant);">{{ $study['excerpt'] }}</p>
                <p class="fw-bold mb-0" style="font-family: 'Outfit', sans-serif; font-size: 3rem; color: var(--md-sys-color-primary);">{{ $study['metric'] }}</p>
                <p class="text-muted" style="font-size: 0.9375rem;">Primary outcome</p>
            </div>
            <div class="col-lg-4">
                <div class="card border-0" style="background: var(--md-sys-color-surface); border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.06);">
                    <div class="card-body p-4">
                        <h6 class="fw-semibold mb-3" style="color: var(--md-sys-color-on-surface); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">Tech Stack</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($study['tech_stack'] as $tool)
                            <span class="badge" style="background: var(--md-sys-color-surface-container-highest); color: var(--md-sys-color-on-surface); font-weight: 500; font-size: 0.875rem; padding: 0.5rem 0.75rem; border-radius: 8px;">{{ $tool }}</span>
                            @endforeach
                        </div>
                        @if(isset($study['preview_slug']))
                        <hr style="border-color: var(--md-sys-color-outline-variant);">
                        <a href="{{ route('preview.show', $study['preview_slug']) }}" target="_blank" class="btn btn-outline-primary w-100 rounded-pill" style="border-color: var(--md-sys-color-primary); color: var(--md-sys-color-primary); font-weight: 500;">
                            View Live Demo →
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Challenge / Solution / Results -->
<section style="background: var(--md-sys-color-surface); padding: 5rem 0;">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <h3 class="fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">Challenge</h3>
                <p style="color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">{{ $study['challenge'] }}</p>
            </div>
            <div class="col-lg-4">
                <h3 class="fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">Solution</h3>
                <p style="color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">{{ $study['solution'] }}</p>
            </div>
            <div class="col-lg-4">
                <h3 class="fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">Results</h3>
                <p style="color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">{{ $study['results'] }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Workflow Diagram -->
<section style="background: var(--md-sys-color-surface-container-low); padding: 5rem 0;">
    <div class="container">
        <div class="text-center mb-5">
            <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em;">System Architecture</p>
            <h2 class="fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">How the System Works</h2>
            <p class="mx-auto" style="max-width: 600px; color: var(--md-sys-color-on-surface-variant);">Every step is automated, measured, and optimised. Our system coordinates these steps in under 1.4 seconds.</p>
        </div>

        <div class="position-relative">
            <!-- Desktop: horizontal pipeline -->
            <div class="d-none d-md-flex align-items-center justify-content-center gap-3 flex-wrap">
                @foreach($study['workflow'] as $index => $step)
                <div class="text-center" style="flex: 1; min-width: 160px; max-width: 200px;">
                    <div class="card border-0 mx-auto" style="background: var(--md-sys-color-surface); border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                        <div class="card-body p-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 40px; height: 40px; background: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container); font-weight: 700; font-size: 0.875rem;">
                                {{ $index + 1 }}
                            </div>
                            <p class="fw-semibold mb-1" style="font-size: 0.875rem; color: var(--md-sys-color-on-surface);">{{ $step['step'] }}</p>
                            <p class="mb-0" style="font-size: 0.75rem; color: var(--md-sys-color-on-surface-variant);">{{ $step['tool'] }}</p>
                        </div>
                    </div>
                </div>
                @if(!$loop->last)
                <div class="d-flex align-items-center" style="color: var(--md-sys-color-outline);">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/></svg>
                </div>
                @endif
                @endforeach
            </div>

            <!-- Mobile: vertical stack -->
            <div class="d-md-none">
                @foreach($study['workflow'] as $index => $step)
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container); font-weight: 700; font-size: 0.875rem;">
                        {{ $index + 1 }}
                    </div>
                    <div class="card border-0 flex-grow-1" style="background: var(--md-sys-color-surface); border-radius: 12px;">
                        <div class="card-body p-3">
                            <p class="fw-semibold mb-1" style="font-size: 0.875rem; color: var(--md-sys-color-on-surface);">{{ $step['step'] }}</p>
                            <p class="mb-0" style="font-size: 0.75rem; color: var(--md-sys-color-on-surface-variant);">{{ $step['tool'] }}</p>
                        </div>
                    </div>
                </div>
                @if(!$loop->last)
                <div class="d-flex justify-content-center mb-3" style="color: var(--md-sys-color-outline);">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" style="transform: rotate(90deg);"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/></svg>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Related Case Studies -->
@if($related->isNotEmpty())
<section style="background: var(--md-sys-color-surface); padding: 5rem 0;">
    <div class="container">
        <h3 class="fw-bold mb-4" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">Related Case Studies</h3>
        <div class="row g-4">
            @foreach($related as $rel)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0" style="background: var(--md-sys-color-surface-container-low); border-radius: 16px; transition: transform 0.2s ease;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="card-body p-4">
                        <p class="fw-bold mb-2" style="font-family: 'Outfit', sans-serif; font-size: 1.5rem; color: var(--md-sys-color-primary);">{{ $rel['metric'] }}</p>
                        <h5 class="fw-semibold mb-2" style="color: var(--md-sys-color-on-surface);">{{ $rel['client'] }}</h5>
                        <p class="mb-3" style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant);">{{ $rel['excerpt'] }}</p>
                        <a href="{{ route('case-study.show', $rel['slug']) }}" class="text-decoration-none fw-medium" style="color: var(--md-sys-color-primary);">Read Story →</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA -->
<section style="background: linear-gradient(135deg, var(--md-sys-color-primary) 0%, #1a5fd6 100%); padding: 4rem 0;">
    <div class="container text-center">
        <h2 class="fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: white;">Want Results Like This?</h2>
        <p class="mx-auto mb-4" style="max-width: 500px; color: rgba(255,255,255,0.85);">Book a free consultation. We will audit your current setup and show you exactly what is possible.</p>
        <a href="{{ route('contact') }}" class="btn btn-light btn-lg rounded-pill px-5" style="font-weight: 500; color: var(--md-sys-color-primary);">Book Free Consultation</a>
    </div>
</section>

@endsection
