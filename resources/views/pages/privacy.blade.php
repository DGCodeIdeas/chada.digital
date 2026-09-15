@extends('layouts.app')

@section('content')

<section style="background: linear-gradient(135deg, #f8f6f3 0%, #f0ede8 100%); padding: 4rem 0 2rem;">
    <div class="container">
        <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.08em;">Legal</p>
        <h1 class="display-6 fw-bold mb-2" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface); font-size: 2rem;">Privacy Policy</h1>
        <p class="mb-0" style="color: var(--md-sys-color-on-surface-variant); font-size: 0.8125rem;">Last updated: September 2026</p>
    </div>
</section>

<section style="background: var(--md-sys-color-surface); padding: 3rem 0;">
    <div class="container" style="max-width: 720px;">
        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">1. What we collect</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">When you contact us through our form, WhatsApp, or email, we collect the information you provide: your name, email address, phone number, and whatever you tell us about your project. We do not use tracking pixels, retargeting cookies, or third-party analytics that profile you across other sites.</p>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">2. How we use it</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">We use the information you give us to respond to your inquiry, prepare quotes, and deliver services if you hire us. That is it. We do not sell your data, share it with marketers, or use it for anything unrelated to your project.</p>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">3. Where it lives</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">Your data is stored on our email provider (for correspondence) and our project management tools (for active projects). We use WhatsApp for quick communication if you contact us that way. We do not maintain a customer database or CRM beyond active projects.</p>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">4. How long we keep it</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">If you contact us but do not become a client, we delete your information after 90 days. If you become a client, we keep project records for accounting and legal purposes as required by Nigerian law. You can request deletion at any time.</p>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">5. Your rights</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">You have the right to see what data we hold about you, request corrections, and ask for deletion (subject to legal record-keeping requirements). To exercise any of these rights, email us and we will respond within 30 days.</p>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">6. Cookies</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">Our website uses a single session cookie required by Laravel for form security (CSRF protection). It does not track you, profile you, or follow you to other sites. It is deleted when you close your browser. See our <a href="{{ route('cookies') }}" style="color: var(--md-sys-color-primary); text-decoration: none;">Cookie Policy</a> for details.</p>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">7. Third-party services</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">When you click our WhatsApp button, you leave our site and are subject to WhatsApp's privacy policy. When we embed demo sites in iframes, those demos may have their own cookies. We do not control third-party policies.</p>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">8. Contact</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">Questions about privacy? Email <a href="mailto:{{ config('contact.email') }}" style="color: var(--md-sys-color-primary); text-decoration: none;">{{ config('contact.email') }}</a>.</p>
        </div>
    </div>
</section>

@endsection
