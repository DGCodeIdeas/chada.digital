@extends('layouts.app')

@section('content')

<!-- ===== HERO ===== -->
<section class="position-relative overflow-hidden" style="background: linear-gradient(135deg, #f8f6f3 0%, #f0ede8 100%); padding: 4rem 0 3rem;">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.08em;">
                    {{ config('hero.eyebrow') }}
                </p>
                <h1 class="display-5 fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface); line-height: 1.15; font-size: 2.5rem;">
                    {{ config('hero.headline_before_highlight', 'We Build Systems That Generate ') }}<span style="color: var(--md-sys-color-primary);">{{ config('hero.headline_highlight', 'Revenue') }}</span>
                </h1>
                <p class="mb-4" style="color: var(--md-sys-color-on-surface-variant); max-width: 540px; font-size: 0.9375rem; line-height: 1.65;">
                    {{ config('hero.subhead') }}
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('services') }}" class="btn btn-primary btn-lg rounded-pill px-4" style="background: var(--md-sys-color-primary); border-color: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary); font-weight: 500;">
                        See Services & Pricing
                    </a>
                    <a href="{{ route('case-studies.index') }}" class="btn btn-outline-primary btn-lg rounded-pill px-4" style="border-color: var(--md-sys-color-primary); color: var(--md-sys-color-primary); font-weight: 500;">
                        View Our Work
                    </a>
                </div>
                {{-- Design Partner band replaces the V2 trust-strip + the hardcoded "Trusted by 50+ brands"
                     line that was here. See partials/design-partner-band.blade.php and
                     Open_Decision.md Q11 (Founder directive, ratified Aug 30, 2026). --}}
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="position-relative">
                    <div class="rounded-4 shadow-lg" style="background: var(--md-sys-color-surface); border: 1px solid var(--md-sys-color-outline-variant); padding: 2rem;">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container);">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/></svg>
                            </div>
                            <div>
                                <p class="fw-semibold mb-0" style="font-size: 0.9375rem;">Revenue Growth</p>
                                <p class="mb-0" style="font-size: 0.875rem; color: var(--md-sys-color-on-surface-variant);">+1,200% for NOIR</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: var(--md-sys-color-secondary-container); color: var(--md-sys-color-on-secondary-container);">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                            </div>
                            <div>
                                <p class="fw-semibold mb-0" style="font-size: 0.9375rem;">Lead Quality</p>
                                <p class="mb-0" style="font-size: 0.875rem; color: var(--md-sys-color-on-surface-variant);">3× increase for Sterling & Vale</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: var(--md-sys-color-tertiary-container); color: var(--md-sys-color-on-tertiary-container);">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                            </div>
                            <div>
                                <p class="fw-semibold mb-0" style="font-size: 0.9375rem;">Conversion Rate</p>
                                <p class="mb-0" style="font-size: 0.875rem; color: var(--md-sys-color-on-surface-variant);">68% trial-to-paid for ApexFlow</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== STATS ===== -->
<section style="background: var(--md-sys-color-surface); border-bottom: 1px solid var(--md-sys-color-outline-variant); padding: 3rem 0;">
    <div class="container">
        <div class="row g-4 text-center">
            @foreach($stats as $stat)
            <div class="col-6 col-md-3">
                <p class="display-5 fw-bold mb-1" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-primary);">{{ $stat['number'] }}</p>
                <p class="mb-0" style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant);">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Design Partner band — always renders, no gate. Replaces the V2 trust-strip. --}}
@include('partials.design-partner-band')

<!-- ===== PROCESS ===== -->
<section style="background: var(--md-sys-color-surface); padding: 5rem 0;">
    <div class="container">
        <div class="text-center mb-5">
            <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em;">How We Work</p>
            <h2 class="fw-bold" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">From First Call to First Sale</h2>
        </div>
        <div class="row g-4">
            @php
            $steps = [
                ['number' => '01', 'title' => 'Discover', 'desc' => 'We audit your current digital presence, analyse your competitors, and identify the highest-leverage opportunities.'],
                ['number' => '02', 'title' => 'Design', 'desc' => 'We design the user experience, information architecture, and visual system, all approved by you before we write a line of code.'],
                ['number' => '03', 'title' => 'Build', 'desc' => 'We build your system with clean, documented code. You get weekly progress updates and a staging URL for real-time feedback.'],
                ['number' => '04', 'title' => 'Scale', 'desc' => 'We launch, monitor, and optimise. A/B testing, conversion tracking, and continuous improvement are built into every engagement.'],
            ];
            @endphp
            @foreach($steps as $step)
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0" style="background: var(--md-sys-color-surface-container-low); border-radius: 16px;">
                    <div class="card-body p-4">
                        <p class="fw-bold mb-2" style="font-family: 'Outfit', sans-serif; font-size: 2.5rem; color: var(--md-sys-color-primary); opacity: 0.3;">{{ $step['number'] }}</p>
                        <h5 class="fw-semibold mb-2" style="color: var(--md-sys-color-on-surface);">{{ $step['title'] }}</h5>
                        <p class="mb-0" style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.6;">{{ $step['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== FEATURED CASE STUDIES ===== -->
@if($featuredStudies->isNotEmpty())
<section style="background: var(--md-sys-color-surface-container-low); padding: 5rem 0;">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-5 gap-3">
            <div>
                <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em;">Case Studies</p>
                <h2 class="fw-bold mb-0" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">Real Results for Real Businesses</h2>
            </div>
            <a href="{{ route('case-studies.index') }}" class="btn btn-outline-primary rounded-pill px-4" style="border-color: var(--md-sys-color-primary); color: var(--md-sys-color-primary); font-weight: 500;">
                View All Case Studies
            </a>
        </div>
        <div class="row g-4">
            @foreach($featuredStudies as $study)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0" style="background: var(--md-sys-color-surface); border-radius: 16px; transition: transform 0.2s ease, box-shadow 0.2s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge rounded-pill" style="background: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container); font-weight: 500; font-size: 0.75rem;">{{ $study['industry'] }}</span>
                            <span class="badge rounded-pill" style="background: var(--md-sys-color-secondary-container); color: var(--md-sys-color-on-secondary-container); font-weight: 500; font-size: 0.75rem;">{{ $study['category'] }}</span>
                        </div>
                        <p class="fw-bold mb-2" style="font-family: 'Outfit', sans-serif; font-size: 1.75rem; color: var(--md-sys-color-primary);">{{ $study['metric'] }}</p>
                        <h5 class="fw-semibold mb-2" style="color: var(--md-sys-color-on-surface);">{{ $study['client'] }}</h5>
                        <p class="mb-3" style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.6;">{{ $study['excerpt'] }}</p>
                        <a href="{{ route('case-study.show', $study['slug']) }}" class="text-decoration-none fw-medium" style="color: var(--md-sys-color-primary); font-size: 0.9375rem;">
                            Read Story →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
{{-- Case studies locked behind "Coming Soon" (Sep 1, 2026). The entire
     featured section is hidden because $featuredStudies is an empty
     collection (see PageController::home()). To unlock: restore the
     featured(3) call in PageController and remove this @if guard. --}}

<!-- ===== SERVICES TEASER ===== -->
<section style="background: var(--md-sys-color-surface); padding: 5rem 0;">
    <div class="container">
        <div class="text-center mb-5">
            <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em;">What We Do</p>
            <h2 class="fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">Four Services. One Goal: Revenue.</h2>
            <p class="mx-auto" style="max-width: 600px; color: var(--md-sys-color-on-surface-variant); font-size: 0.9375rem;">Every service we offer is measured against one metric: does it make you more money than it costs?</p>
        </div>
        <div class="row g-4">
            @php
            $services = [
                ['icon' => 'code', 'title' => 'Web Development', 'desc' => 'Laravel, React, WordPress, Shopify. We build fast, secure, conversion-optimised websites and web applications.', 'tools' => ['Laravel', 'React', 'WordPress', 'Shopify']],
                ['icon' => 'zap', 'title' => 'Funnel & Automation', 'desc' => 'ManyChat, HubSpot, Zapier, Make. We design and build automated customer journeys that convert 24/7.', 'tools' => ['ManyChat', 'HubSpot', 'Zapier', 'Make']],
                ['icon' => 'target', 'title' => 'Paid Advertising', 'desc' => 'Meta Ads, Google Ads, LinkedIn Ads, TikTok Ads. We manage campaigns with relentless focus on ROAS.', 'tools' => ['Meta Ads', 'Google Ads', 'LinkedIn Ads', 'TikTok Ads']],
                ['icon' => 'pen-tool', 'title' => 'Brand & Strategy', 'desc' => 'Figma, brand strategy, CRO. We define how you look, sound, and convert, then we optimise all three.', 'tools' => ['Figma', 'Brand Strategy', 'CRO', 'A/B Testing']],
            ];
            @endphp
            @foreach($services as $service)
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0" style="background: var(--md-sys-color-surface-container-low); border-radius: 16px;">
                    <div class="card-body p-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 48px; height: 48px; background: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container);">
                            @if($service['icon'] === 'code')
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                            @elseif($service['icon'] === 'zap')
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                            @elseif($service['icon'] === 'target')
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                            @else
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 19l7-7 3 3-7 7-3-3z"></path><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path><path d="M2 2l7.586 7.586"></path><circle cx="11" cy="11" r="2"></circle></svg>
                            @endif
                        </div>
                        <h5 class="fw-semibold mb-2" style="color: var(--md-sys-color-on-surface);">{{ $service['title'] }}</h5>
                        <p class="mb-3" style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.6;">{{ $service['desc'] }}</p>
                        <div class="d-flex flex-wrap gap-1">
                            @foreach($service['tools'] as $tool)
                            <span class="badge" style="background: var(--md-sys-color-surface-container-highest); color: var(--md-sys-color-on-surface-variant); font-weight: 400; font-size: 0.75rem;">{{ $tool }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('services') }}" class="btn btn-primary rounded-pill px-4" style="background: var(--md-sys-color-primary); border-color: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary); font-weight: 500;">
                See Full Services & Pricing
            </a>
        </div>
    </div>
</section>

<!-- ===== CTA ===== -->
<section style="background: linear-gradient(135deg, var(--md-sys-color-primary) 0%, #1a5fd6 100%); padding: 5rem 0;">
    <div class="container text-center">
        <h2 class="fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: white;">Ready to Build Something That Sells?</h2>
        <p class="mx-auto mb-4" style="max-width: 560px; color: rgba(255,255,255,0.85); font-size: 1.125rem;">
            Book a free 30-minute consultation. We will audit your current setup and identify the highest-leverage opportunities, no pitch, no pressure.
        </p>
        <a href="{{ route('contact') }}" class="btn btn-light btn-lg rounded-pill px-5" style="font-weight: 500; color: var(--md-sys-color-primary);">
            Book Free Consultation
        </a>
    </div>
</section>

@endsection
