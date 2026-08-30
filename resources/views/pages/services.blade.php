@extends('layouts.app')

@section('content')

<section style="background: linear-gradient(135deg, #f8f6f3 0%, #f0ede8 100%); padding: 5rem 0 3rem;">
    <div class="container text-center">
        <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em;">Services & Pricing</p>
        <h1 class="display-5 fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">Transparent Pricing. No Surprises.</h1>
        <p class="mx-auto" style="max-width: 600px; color: var(--md-sys-color-on-surface-variant); font-size: 1.125rem;">
            Every service has a fixed price or a clear monthly retainer. You know exactly what you are paying for before we start.
        </p>
    </div>
</section>

<!-- Stats bar -->
<section style="background: var(--md-sys-color-surface); border-bottom: 1px solid var(--md-sys-color-outline-variant); padding: 2.5rem 0;">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3">
                <p class="display-6 fw-bold mb-1" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-primary);">50+</p>
                <p class="mb-0" style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant);">Projects Delivered</p>
            </div>
            <div class="col-6 col-md-3">
                <p class="display-6 fw-bold mb-1" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-primary);">6+</p>
                <p class="mb-0" style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant);">Industries Served</p>
            </div>
            <div class="col-6 col-md-3">
                <p class="display-6 fw-bold mb-1" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-primary);">95%</p>
                <p class="mb-0" style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant);">Client Retention</p>
            </div>
            <div class="col-6 col-md-3">
                <p class="display-6 fw-bold mb-1" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-primary);">24h</p>
                <p class="mb-0" style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant);">Response Time</p>
            </div>
        </div>
    </div>
</section>

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
<section style="background: {{ $loop->odd ? 'var(--md-sys-color-surface)' : 'var(--md-sys-color-surface-container-low)' }}; padding: 5rem 0;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-2" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">{{ $section['title'] }}</h2>
            <p class="mx-auto" style="max-width: 600px; color: var(--md-sys-color-on-surface-variant);">{{ $section['description'] }}</p>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($section['tiers'] as $tier)
            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 position-relative" style="background: var(--md-sys-color-surface); border-radius: 16px; box-shadow: {{ $tier['highlight'] ? '0 8px 24px rgba(37,99,235,0.12)' : '0 2px 8px rgba(0,0,0,0.04)' }}; border: {{ $tier['highlight'] ? '2px solid var(--md-sys-color-primary)' : '1px solid var(--md-sys-color-outline-variant)' }};">
                    @if($tier['highlight'])
                    <div class="position-absolute top-0 start-50 translate-middle-x">
                        <span class="badge rounded-pill px-3 py-1" style="background: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary); font-size: 0.75rem; font-weight: 600;">Most Popular</span>
                    </div>
                    @endif
                    <div class="card-body p-4 pt-5">
                        <h5 class="fw-semibold mb-2" style="color: var(--md-sys-color-on-surface);">{{ $tier['name'] }}</h5>
                        <div class="d-flex align-items-baseline gap-2 mb-3">
                            <span class="fw-bold" style="font-family: 'Outfit', sans-serif; font-size: 2.25rem; color: var(--md-sys-color-primary);">{{ $tier['price'] }}</span>
                            <span style="color: var(--md-sys-color-on-surface-variant); font-size: 0.875rem;">{{ $tier['price_note'] }}</span>
                        </div>
                        <p class="mb-4" style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.6;">{{ $tier['description'] }}</p>
                        <ul class="list-unstyled mb-4">
                            @foreach($tier['features'] as $feature)
                            <li class="d-flex align-items-start gap-2 mb-2" style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant);">
                                <svg width="18" height="18" fill="currentColor" class="flex-shrink-0 mt-1" style="color: var(--md-sys-color-primary);" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                                {{ $feature }}
                            </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('contact') }}" class="btn w-100 rounded-pill {{ $tier['highlight'] ? 'btn-primary' : 'btn-outline-primary' }}" style="{{ $tier['highlight'] ? 'background: var(--md-sys-color-primary); border-color: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary);' : 'border-color: var(--md-sys-color-primary); color: var(--md-sys-color-primary);' }} font-weight: 500;">
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
