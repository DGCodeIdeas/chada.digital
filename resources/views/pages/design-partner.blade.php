@extends('layouts.app')

@section('content')

<section style="background: linear-gradient(135deg, #f8f6f3 0%, #f0ede8 100%); padding: 4rem 0 3rem;">
    <div class="container text-center">
        <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.08em;">Early Access</p>
        <h1 class="display-6 fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface); font-size: 2.25rem;">Become a Design Partner</h1>
        <p class="mx-auto mb-4" style="max-width: 540px; color: var(--md-sys-color-on-surface-variant); font-size: 0.9375rem; line-height: 1.65;">
            We do not have a wall of client logos yet, and we will not fake one. Click the demos, look at the prices, and if the work looks like yours, message us.
        </p>
        <a href="https://wa.me/{{ config('contact.whatsapp') }}?text={{ urlencode('Hi Chada Digital! I am interested in becoming a design partner. Can you tell me more about what that involves?') }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary rounded-pill" style="background: var(--md-sys-color-primary); border-color: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary); font-weight: 500; font-size: 0.8125rem; padding: 0.625rem 1.5rem;">
            Apply on WhatsApp
        </a>
    </div>
</section>

<section style="background: var(--md-sys-color-surface); padding: 3rem 0;">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100" style="background: var(--md-sys-color-surface-container-low); border-radius: 12px; box-shadow: var(--md-sys-elevation-1, 0 1px 2px 0 rgba(0,0,0,0.03));">
                    <div class="card-body p-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 48px; height: 48px; background: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container);">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        </div>
                        <h5 class="fw-semibold mb-2" style="color: var(--md-sys-color-on-surface); font-size: 1rem;">You talk to the people writing it</h5>
                        <p class="mb-0" style="font-size: 0.8125rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.6;">Not a salesperson who then writes it up for someone else.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100" style="background: var(--md-sys-color-surface-container-low); border-radius: 12px; box-shadow: var(--md-sys-elevation-1, 0 1px 2px 0 rgba(0,0,0,0.03));">
                    <div class="card-body p-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 48px; height: 48px; background: var(--md-sys-color-secondary-container); color: var(--md-sys-color-on-secondary-container);">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M13 2L3 14h7l-1 8 10-12h-7l1-8z"/></svg>
                        </div>
                        <h5 class="fw-semibold mb-2" style="color: var(--md-sys-color-on-surface); font-size: 1rem;">A date in the quote</h5>
                        <p class="mb-0" style="font-size: 0.8125rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.6;">Weekly check-ins and a staging link while we work. Live date is in the quote.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100" style="background: var(--md-sys-color-surface-container-low); border-radius: 12px; box-shadow: var(--md-sys-elevation-1, 0 1px 2px 0 rgba(0,0,0,0.03));">
                    <div class="card-body p-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 48px; height: 48px; background: var(--md-sys-color-tertiary-container); color: var(--md-sys-color-on-tertiary-container);">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                        </div>
                        <h5 class="fw-semibold mb-2" style="color: var(--md-sys-color-on-surface); font-size: 1rem;">Transparent Pricing</h5>
                        <p class="mb-0" style="font-size: 0.8125rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.6;">Every package has a Naira range on the site. You know the number before we start.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="background: linear-gradient(135deg, var(--md-sys-color-primary) 0%, #1a5fd6 100%); padding: 3.5rem 0;">
    <div class="container text-center">
        <h2 class="fw-bold mb-2" style="font-family: 'Outfit', sans-serif; color: white; font-size: 1.75rem;">Ready to Start?</h2>
        <p class="mx-auto mb-3" style="max-width: 500px; color: rgba(255,255,255,0.85); font-size: 0.9375rem;">
            Send us a message on WhatsApp and we will get back to you within 24 hours.
        </p>
        <a href="https://wa.me/{{ config('contact.whatsapp') }}?text={{ urlencode('Hi Chada Digital! I am interested in becoming a design partner. Can you tell me more about what that involves?') }}" target="_blank" rel="noopener noreferrer" class="btn btn-light rounded-pill" style="font-weight: 500; color: var(--md-sys-color-primary); font-size: 0.875rem; padding: 0.5rem 1.25rem;">
            Apply on WhatsApp
        </a>
    </div>
</section>

@endsection
