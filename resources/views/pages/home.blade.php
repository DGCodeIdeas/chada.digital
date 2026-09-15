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
                    {{ config('hero.headline_before_highlight', 'We Build Websites That ') }}<span style="color: var(--md-sys-color-primary);">{{ config('hero.headline_highlight', 'Work') }}</span>{{ config('hero.headline_after_highlight', ' for Your Business') }}
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
                    <div class="rounded-4 shadow-lg" style="background: var(--md-sys-color-surface); padding: 1.75rem;">
                        <p class="fw-semibold mb-3" style="font-size: 0.6875rem; text-transform: uppercase; letter-spacing: 0.15em; color: var(--md-sys-color-on-surface-variant);">What We Build</p>
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container);">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M3 3h18v2H3V3zm0 4h18v2H3V7zm0 4h18v2H3v-2zm0 4h12v2H3v-2z"/></svg>
                            </div>
                            <div class="flex-grow-1">
                                <p class="fw-semibold mb-0" style="font-size: 0.875rem;">Website Design</p>
                                <p class="mb-0" style="font-size: 0.75rem; color: var(--md-sys-color-on-surface-variant);">From ₦200,000</p>
                            </div>
                            <a href="{{ route('services') }}" class="btn btn-sm btn-outline-primary rounded-pill flex-shrink-0" style="border-color: var(--md-sys-color-primary); color: var(--md-sys-color-primary); font-size: 0.6875rem; padding: 0.25rem 0.625rem;">View</a>
                        </div>
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background: var(--md-sys-color-secondary-container); color: var(--md-sys-color-on-secondary-container);">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M13 2L3 14h7l-1 8 10-12h-7l1-8z"/></svg>
                            </div>
                            <div class="flex-grow-1">
                                <p class="fw-semibold mb-0" style="font-size: 0.875rem;">Automation</p>
                                <p class="mb-0" style="font-size: 0.75rem; color: var(--md-sys-color-on-surface-variant);">From ₦150,000</p>
                            </div>
                            <a href="{{ route('services') }}" class="btn btn-sm btn-outline-primary rounded-pill flex-shrink-0" style="border-color: var(--md-sys-color-primary); color: var(--md-sys-color-primary); font-size: 0.6875rem; padding: 0.25rem 0.625rem;">View</a>
                        </div>
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background: var(--md-sys-color-tertiary-container); color: var(--md-sys-color-on-tertiary-container);">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            </div>
                            <div class="flex-grow-1">
                                <p class="fw-semibold mb-0" style="font-size: 0.875rem;">Branding</p>
                                <p class="mb-0" style="font-size: 0.75rem; color: var(--md-sys-color-on-surface-variant);">From ₦100,000</p>
                            </div>
                            <a href="{{ route('services') }}" class="btn btn-sm btn-outline-primary rounded-pill flex-shrink-0" style="border-color: var(--md-sys-color-primary); color: var(--md-sys-color-primary); font-size: 0.6875rem; padding: 0.25rem 0.625rem;">View</a>
                        </div>
                        <a href="{{ route('services') }}" class="btn btn-primary w-100 rounded-pill mt-2" style="background: var(--md-sys-color-primary); border-color: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary); font-weight: 500; font-size: 0.8125rem;">
                            See All Pricing
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Design Partner band — always renders, no gate. Replaces the V2 trust-strip. --}}
@include('partials.design-partner-band')

<!-- ===== PROCESS ===== -->
<section style="background: var(--md-sys-color-surface); padding: 5rem 0;">
    <div class="container">
        <div class="text-center mb-5">
            <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em;">{{ config('home.process_eyebrow') }}</p>
            <h2 class="fw-bold" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">{{ config('home.process_heading') }}</h2>
        </div>
        <div class="row g-4">
            @foreach(config('home.steps') as $step)
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
                <h2 class="fw-bold mb-0" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">Work we can show with a real number</h2>
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
            <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em;">{{ config('home.services_eyebrow') }}</p>
            <h2 class="fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">{{ config('home.services_heading') }}</h2>
            <p class="mx-auto" style="max-width: 600px; color: var(--md-sys-color-on-surface-variant); font-size: 0.9375rem;">{{ config('home.services_subhead') }}</p>
        </div>
        <div class="row g-4">
            @foreach(config('home.services') as $service)
            <div class="col-md-6 col-lg-4">
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
                            <span class="badge rounded-pill" style="background: var(--md-sys-color-surface-container-highest); color: var(--md-sys-color-on-surface-variant); font-weight: 500; font-size: 0.6875rem; padding: 0.3rem 0.625rem;">{{ $tool }}</span>
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

<!-- ===== TECHNOLOGIES ===== -->
<section style="background: var(--md-sys-color-surface-container-low); padding: 3.5rem 0;">
    <div class="container">
        <div class="text-center mb-4">
            <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.08em;">{{ config('martech.eyebrow', 'Our Stack') }}</p>
            <h2 class="fw-bold mb-2" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface); font-size: 1.5rem;">{{ config('martech.title', 'The tools we actually use') }}</h2>
            <p class="mx-auto" style="max-width: 540px; color: var(--md-sys-color-on-surface-variant); font-size: 0.875rem;">{{ config('martech.subtitle') }}</p>
        </div>
        @php $techCategories = config('martech.categories', []); @endphp
        <div class="row g-2 justify-content-center">
            @foreach($techCategories as $cat)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100" style="background: var(--md-sys-color-surface); border-radius: 10px; box-shadow: var(--md-sys-elevation-1, 0 1px 2px 0 rgba(0,0,0,0.03));">
                    <div class="card-body p-3 text-center">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 36px; height: 36px; background: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container);">
                            <i class="fas {{ $cat['icon'] }}" style="font-size: 1.125rem;"></i>
                        </div>
                        <h6 class="fw-semibold mb-2" style="color: var(--md-sys-color-on-surface); font-size: 0.8125rem;">{{ $cat['name'] }}</h6>
                        <div class="d-flex flex-wrap gap-1 justify-content-center">
                            @foreach($cat['tools'] as $tool)
                            <span class="badge rounded-pill d-inline-flex align-items-center gap-1" style="background: var(--md-sys-color-surface-container-highest); color: var(--md-sys-color-on-surface-variant); font-weight: 500; font-size: 0.6875rem; padding: 0.25rem 0.625rem;">
                                @if(!empty($tool['brand']))
                                    <i class="fab fa-{{ $tool['brand'] }}" aria-hidden="true" style="font-size: 0.75rem; line-height: 1;"></i>
                                    <span class="visually-hidden">{{ $tool['name'] }}</span>
                                @elseif(!empty($tool['icon']))
                                    <i class="fas {{ $tool['icon'] }}" aria-hidden="true" style="font-size: 0.75rem; line-height: 1;"></i>
                                @endif
                                {{ $tool['name'] }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== CTA ===== -->
<section style="background: linear-gradient(135deg, var(--md-sys-color-primary) 0%, #1a5fd6 100%); padding: 5rem 0;">
    <div class="container text-center">
        <h2 class="fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: white;">{{ config('home.final_cta_heading') }}</h2>
        <p class="mx-auto mb-4" style="max-width: 560px; color: rgba(255,255,255,0.85); font-size: 1.125rem;">
            {{ config('home.final_cta_body') }}
        </p>
        <a href="{{ route('contact') }}" class="btn btn-light btn-lg rounded-pill px-5" style="font-weight: 500; color: var(--md-sys-color-primary);">
            {{ config('home.final_cta_button') }}
        </a>
    </div>
</section>

@endsection
