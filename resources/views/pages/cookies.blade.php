@extends('layouts.app')

@section('content')

<section style="background: linear-gradient(135deg, #f8f6f3 0%, #f0ede8 100%); padding: 4rem 0 2rem;">
    <div class="container">
        <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.08em;">Legal</p>
        <h1 class="display-6 fw-bold mb-2" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface); font-size: 2rem;">Cookie Policy</h1>
        <p class="mb-0" style="color: var(--md-sys-color-on-surface-variant); font-size: 0.8125rem;">Last updated: September 2026</p>
    </div>
</section>

<section style="background: var(--md-sys-color-surface); padding: 3rem 0;">
    <div class="container" style="max-width: 720px;">
        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">1. What cookies we use</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">Our website uses one essential cookie:</p>
            <ul style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7; list-style: disc; padding-left: 1.5rem;">
                <li><strong>laravel_session</strong> — a session cookie required for form security (CSRF protection). It prevents cross-site request forgery attacks on our contact form. It contains no personal data and is deleted when you close your browser.</li>
            </ul>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">2. What we do not use</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">We do not use:</p>
            <ul style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7; list-style: disc; padding-left: 1.5rem;">
                <li>Analytics cookies (Google Analytics, Mixpanel, etc.)</li>
                <li>Advertising or retargeting cookies</li>
                <li>Social media tracking pixels</li>
                <li>Third-party profiling cookies</li>
            </ul>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">3. Embedded content</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">Our Frontend (Work) page embeds demo projects in iframes. Those demos may set their own cookies. We do not control cookies set by third-party or embedded content.</p>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">4. Managing cookies</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">You can disable cookies in your browser settings. If you disable the session cookie, our contact form will not work (it needs CSRF protection). Everything else on the site will function normally.</p>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">5. Contact</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">Questions about cookies? Email <a href="mailto:{{ config('contact.email') }}" style="color: var(--md-sys-color-primary); text-decoration: none;">{{ config('contact.email') }}</a>.</p>
        </div>
    </div>
</section>

@endsection
