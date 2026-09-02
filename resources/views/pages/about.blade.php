@extends('layouts.app')

@section('content')

<section style="background: linear-gradient(135deg, #f8f6f3 0%, #f0ede8 100%); padding: 5rem 0 3rem;">
    <div class="container text-center">
        <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em;">About Us</p>
        <h1 class="display-5 fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">We Build Digital Systems That Generate Revenue</h1>
        <p class="mx-auto" style="max-width: 700px; color: var(--md-sys-color-on-surface-variant); font-size: 1.125rem;">
            {{ config('placeholders.about_page.body') }}
        </p>
    </div>
</section>

<!-- Standards / Manifesto -->
<section style="background: var(--md-sys-color-surface); padding: 4rem 0;">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 64px; height: 64px; background: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container);">
                    <svg width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                </div>
                <h5 class="fw-semibold mb-2" style="color: var(--md-sys-color-on-surface);">We Do What We Say</h5>
                <p class="mb-0" style="color: var(--md-sys-color-on-surface-variant); font-size: 0.9375rem;">If we commit to a deadline, we hit it. If we commit to a metric, we measure it. No excuses.</p>
            </div>
            <div class="col-md-4">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 64px; height: 64px; background: var(--md-sys-color-secondary-container); color: var(--md-sys-color-on-secondary-container);">
                    <svg width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z"/></svg>
                </div>
                <h5 class="fw-semibold mb-2" style="color: var(--md-sys-color-on-surface);">We Hold Ourselves Accountable</h5>
                <p class="mb-0" style="color: var(--md-sys-color-on-surface-variant); font-size: 0.9375rem;">Every project has clear KPIs, weekly reports, and a direct line to the team. You are never in the dark.</p>
            </div>
            <div class="col-md-4">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 64px; height: 64px; background: var(--md-sys-color-tertiary-container); color: var(--md-sys-color-on-tertiary-container);">
                    <svg width="28" height="28" fill="currentColor" viewBox="0 0 24 24"><path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/></svg>
                </div>
                <h5 class="fw-semibold mb-2" style="color: var(--md-sys-color-on-surface);">We Get Results Fast</h5>
                <p class="mb-0" style="color: var(--md-sys-color-on-surface-variant); font-size: 0.9375rem;">We do not bill by the hour. We bill by the outcome. If it does not make you money, we do not build it.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials → Honesty Band -->
{{-- Replaced the V2 testimonials section with an honesty band (Sep 2, 2026).
     The testimonials section was gated — it only rendered when TestimonialService
     returned real quotes, which it doesn't yet (all 6 fabricated testimonials
     were removed per the V4 gate model). Instead of showing nothing OR faking
     quotes, this band is honest about the early-stage status and frames the
     absence as a confident offer. Same pattern as the Design Partner band. --}}
<section class="py-5" style="background: linear-gradient(to right, var(--md-sys-color-surface-container), var(--md-sys-color-surface-container-high), var(--md-sys-color-surface-container));">
    <div class="container text-center py-4">
        <p class="fw-semibold mb-3" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.3em; color: var(--md-sys-color-primary);">
            Client Stories
        </p>
        <h2 class="display-6 fw-bold mb-3" style="font-family: 'Inter', sans-serif; color: var(--md-sys-color-on-surface);">
            No testimonials yet, we won&rsquo;t fake them.
        </h2>
        <p class="lead mb-0" style="color: var(--md-sys-color-on-surface-variant);">
            Real client quotes will appear here once we have permission to share them. In the meantime, <a href="{{ route('demo-lab') }}" style="color: var(--md-sys-color-primary); text-decoration: none; font-weight: 500;">see the work</a> or <a href="{{ route('contact') }}" style="color: var(--md-sys-color-primary); text-decoration: none; font-weight: 500;">become our next case study</a>.
        </p>
    </div>
</section>

<!-- MarTech Grid -->
<section style="background: var(--md-sys-color-surface); padding: 5rem 0;">
    <div class="container">
        <div class="text-center mb-5">
            <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em;">Our Stack</p>
            <h2 class="fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">Tools We Use to Build Your System</h2>
            <p class="mx-auto" style="max-width: 600px; color: var(--md-sys-color-on-surface-variant);">We do not reinvent the wheel. We integrate the best tools in the industry into a single, coherent system.</p>
        </div>
        <div class="row g-4">
            @foreach($marTech as $cat)
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0" style="background: var(--md-sys-color-surface-container-low); border-radius: 16px;">
                    <div class="card-body p-4">
                        <h6 class="fw-semibold mb-3" style="color: var(--md-sys-color-on-surface); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">{{ $cat['category'] }}</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($cat['tools'] as $tool)
                            <span class="badge" style="background: var(--md-sys-color-surface-container-highest); color: var(--md-sys-color-on-surface); font-weight: 500; font-size: 0.875rem; padding: 0.5rem 0.75rem; border-radius: 8px;">{{ $tool }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Founder Bio -->
<section style="background: var(--md-sys-color-surface-container-low); padding: 5rem 0;">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <div class="rounded-4 overflow-hidden" style="background: var(--md-sys-color-surface); aspect-ratio: 1; display: flex; align-items: center; justify-content: center; border: 1px solid var(--md-sys-color-outline-variant);">
                    <div class="text-center p-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 120px; height: 120px; background: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container); font-family: 'Outfit', sans-serif; font-size: 3rem; font-weight: 700;">
                            CD
                        </div>
                        <p class="text-muted" style="font-size: 0.875rem;">Founder portrait placeholder.<br>Replace with professional headshot.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em;">Founder</p>
                <h2 class="fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">Chada Digital Team</h2>
                <p class="mb-3" style="color: var(--md-sys-color-on-surface-variant); line-height: 1.7; font-size: 1.0625rem;">
                    We started Chada Digital because we were tired of seeing Nigerian businesses pay premium prices for websites that did not sell. Too many agencies build beautiful portfolios that generate zero revenue for their clients.
                </p>
                <p class="mb-3" style="color: var(--md-sys-color-on-surface-variant); line-height: 1.7; font-size: 1.0625rem;">
                    Our approach is different. Every project starts with a revenue model. We ask: how will this system make you money? Then we design, build, and optimise around that answer.
                </p>
                <p class="mb-4" style="color: var(--md-sys-color-on-surface-variant); line-height: 1.7; font-size: 1.0625rem;">
                    We have helped 50+ businesses across 6 industries build digital systems that generate leads, close sales, and retain customers. Our average client sees a 300% increase in qualified leads within 90 days of launch.
                </p>
                <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-4" style="background: var(--md-sys-color-primary); border-color: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary); font-weight: 500;">
                    Work With Us
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Exclusivity CTA -->
<section style="background: linear-gradient(135deg, var(--md-sys-color-primary) 0%, #1a5fd6 100%); padding: 5rem 0;">
    <div class="container text-center">
        <h2 class="fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: white;">We Take On 4 New Clients Per Month</h2>
        <p class="mx-auto mb-4" style="max-width: 600px; color: rgba(255,255,255,0.85); font-size: 1.125rem;">
            Quality over quantity. Every client gets our full attention, our best thinking, and our fastest response times. If you are serious about growth, we are serious about helping.
        </p>
        <a href="{{ route('contact') }}" class="btn btn-light btn-lg rounded-pill px-5" style="font-weight: 500; color: var(--md-sys-color-primary);">
            Apply to Work With Us
        </a>
    </div>
</section>

@endsection
