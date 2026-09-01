@extends('layouts.app')

@section('content')

<section style="background: linear-gradient(135deg, #f8f6f3 0%, #f0ede8 100%); padding: 3.5rem 0 2rem;">
    <div class="container text-center">
        <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.08em;">{{ config('placeholders.services_page.eyebrow') }}</p>
        <h1 class="display-6 fw-bold mb-2" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface); font-size: 2.25rem;">{{ config('placeholders.services_page.headline') }}</h1>
        <p class="mx-auto" style="max-width: 600px; color: var(--md-sys-color-on-surface-variant); font-size: 0.9375rem;">
            {{ config('placeholders.services_page.subhead') }}
        </p>
    </div>
</section>

<!-- Stats bar — pulls from config/placeholders.php services_page.stats.
     Each stat is GATED: null value hides that stat. If all 4 are null,
     the whole section hides. NEVER hardcode stats here — they must come
     from config so the Founder can update them in one place. -->
@php $servicesStats = config('placeholders.services_page.stats', []); @endphp
@if(!empty(array_filter(array_column($servicesStats, 'value'))))
<section style="background: var(--md-sys-color-surface); padding: 2rem 0;">
    <div class="container">
        <div class="row g-3 text-center">
            @foreach($servicesStats as $stat)
            @if($stat['value'] !== null)
            <div class="col-6 col-md-3">
                <p class="fw-bold mb-1" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-primary); font-size: 1.75rem; line-height: 1.1;">{{ $stat['value'] }}</p>
                <p class="mb-0" style="font-size: 0.8125rem; color: var(--md-sys-color-on-surface-variant);">{{ $stat['label'] }}</p>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA band -->
<section style="background: var(--md-sys-color-primary-container); padding: 2rem 0;">
    <div class="container text-center">
        <p class="mb-2" style="color: var(--md-sys-color-on-primary-container); font-size: 1.0625rem;">
            Not sure which tier is right for you? <strong>Book a free 30-minute consultation.</strong> No pitch. No pressure.
        </p>
        <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-4" style="background: var(--md-sys-color-primary); border-color: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary); font-weight: 500;">
            Book Free Consultation
        </a>
    </div>
</section>

<!-- Pricing tiers -->
@foreach($tiers as $key => $section)
<section style="background: {{ $loop->odd ? 'var(--md-sys-color-surface)' : 'var(--md-sys-color-surface-container-low)' }}; padding: 3.5rem 0;">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold mb-1" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface); font-size: 1.5rem;">{{ $section['title'] }}</h2>
            <p class="mx-auto" style="max-width: 600px; color: var(--md-sys-color-on-surface-variant); font-size: 0.875rem;">{{ $section['description'] }}</p>
        </div>
        <div class="row g-3 justify-content-center">
            @foreach($section['tiers'] as $tier)
            <div class="col-md-6 col-xl-4">
                {{-- Highlighted tier uses a stronger elevation shadow + a slight
                     scale, not a border — the site's .card rule (see
                     _chada-custom.scss, No-Borders Fusion Principle) forces
                     border: 0 !important on every card regardless of inline
                     style, so a border here would never actually render.
                     This was a real bug: the "Most Popular" card looked
                     identical to the others except for the badge. --}}
                <div class="card h-100 border-0 position-relative" style="background: var(--md-sys-color-surface); border-radius: 12px; box-shadow: {{ $tier['highlight'] ? '0 6px 20px rgba(37,99,235,0.12)' : '0 1px 4px rgba(0,0,0,0.04)' }}; {{ $tier['highlight'] ? 'transform: scale(1.02);' : '' }}">
                    @if($tier['highlight'])
                    <div class="position-absolute top-0 start-50 translate-middle-x">
                        <span class="badge rounded-pill px-2 py-1" style="background: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary); font-size: 0.6875rem; font-weight: 600;">Most Popular</span>
                    </div>
                    @endif
                    <div class="card-body p-3 pt-4">
                        <h5 class="fw-semibold mb-2" style="color: var(--md-sys-color-on-surface); font-size: 1rem;">{{ $tier['name'] }}</h5>
                        <div class="d-flex align-items-baseline gap-2 mb-2">
                            @if($tier['price'] !== null)
                                <span class="fw-bold" style="font-family: 'Outfit', sans-serif; font-size: 1.75rem; color: var(--md-sys-color-primary); line-height: 1.1;">{{ $tier['price'] }}</span>
                                <span style="color: var(--md-sys-color-on-surface-variant); font-size: 0.75rem;">{{ $tier['price_note'] }}</span>
                            @else
                                <span class="fw-bold" style="font-family: 'Outfit', sans-serif; font-size: 1.125rem; color: var(--md-sys-color-on-surface-variant);">Contact for pricing</span>
                            @endif
                        </div>
                        <p class="mb-3" style="font-size: 0.8125rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.5;">{{ $tier['description'] }}</p>
                        <ul class="list-unstyled mb-3">
                            @foreach($tier['features'] as $feature)
                            <li class="d-flex align-items-start gap-2 mb-1" style="font-size: 0.8125rem; color: var(--md-sys-color-on-surface-variant);">
                                <svg width="14" height="14" fill="currentColor" class="flex-shrink-0 mt-1" style="color: var(--md-sys-color-primary);" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                                {{ $feature }}
                            </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('contact') }}" class="btn w-100 rounded-pill {{ $tier['highlight'] ? 'btn-primary' : 'btn-outline-primary' }}" style="{{ $tier['highlight'] ? 'background: var(--md-sys-color-primary); border-color: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary);' : 'border-color: var(--md-sys-color-primary); color: var(--md-sys-color-primary);' }} font-weight: 500; font-size: 0.8125rem; padding: 0.5rem 0.875rem;">
                            {{ $tier['cta'] }}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endforeach

<!-- Final CTA -->
<section style="background: linear-gradient(135deg, var(--md-sys-color-primary) 0%, #1a5fd6 100%); padding: 5rem 0;">
    <div class="container text-center">
        <h2 class="fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: white;">Still Have Questions?</h2>
        <p class="mx-auto mb-4" style="max-width: 500px; color: rgba(255,255,255,0.85); font-size: 1.125rem;">
            Every project starts with a conversation. Tell us what you are trying to achieve and we will tell you exactly how we can help.
        </p>
        <a href="{{ route('contact') }}" class="btn btn-light btn-lg rounded-pill px-5" style="font-weight: 500; color: var(--md-sys-color-primary);">Start a Conversation</a>
    </div>
</section>

@endsection
