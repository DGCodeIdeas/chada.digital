@extends('layouts.app')

@section('content')

<section style="background: linear-gradient(135deg, #f8f6f3 0%, #f0ede8 100%); padding: 4rem 0 2rem;">
    <div class="container">
        <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.08em;">Legal</p>
        <h1 class="display-6 fw-bold mb-2" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface); font-size: 2rem;">Terms of Service</h1>
        <p class="mb-0" style="color: var(--md-sys-color-on-surface-variant); font-size: 0.8125rem;">Last updated: September 2026</p>
    </div>
</section>

<section style="background: var(--md-sys-color-surface); padding: 3rem 0;">
    <div class="container" style="max-width: 720px;">
        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">1. About these terms</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">Chada Digital ("we", "us", "our") provides website design, automation, and branding services to businesses in Nigeria and beyond. These terms apply to anyone who visits our website or engages our services. By using this site or hiring us, you agree to what is written here.</p>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">2. Our services</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">We design and build websites, set up automation workflows, and create brand identities. Each project is scoped individually. The price ranges listed on our services page are starting points, not final quotes. Final pricing depends on project scope, complexity, and timeline, and will be agreed in writing before any work begins.</p>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">3. Quotes and payment</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">All quotes are valid for 30 days from the date issued. Payment terms are agreed per project and stated in the project agreement. Typically, we require a deposit before work begins and the balance on delivery. Prices are in Nigerian Naira (NGN) unless otherwise stated.</p>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">4. What we deliver</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">For website projects, we deliver the source code, design files, and login credentials upon final payment. For automation projects, we deliver the configured workflows and documentation. For branding projects, we deliver the design files in agreed formats. Ongoing support is available as a separate retainer.</p>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">5. Revisions</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">Each package includes a set number of revision rounds, stated in the project agreement. Additional revisions beyond the agreed count are billed at an hourly rate. We try to be reasonable, but scope creep benefits no one.</p>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">6. Client responsibilities</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">You agree to provide content, feedback, and approvals in a timely manner. Delays on your end may extend the project timeline. You are responsible for the accuracy of any content, images, or data you provide to us.</p>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">7. Intellectual property</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">Upon full payment, ownership of the final deliverables transfers to you. We retain the right to display the work in our portfolio unless you specifically request otherwise in writing. Third-party tools, fonts, and libraries used in the project remain licensed under their respective terms.</p>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">8. Limitation of liability</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">We are not liable for indirect or consequential damages arising from the use of our work. Our liability is limited to the amount paid for the specific project in question. We are not responsible for issues caused by third-party services, hosting providers, or platform changes outside our control.</p>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">9. Cancellation</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">Either party may cancel a project with written notice. Work completed up to the cancellation date is billable. Deposits are non-refundable once work has begun.</p>
        </div>

        <div class="mb-4">
            <h2 class="fw-semibold mb-2" style="font-size: 1.125rem; color: var(--md-sys-color-on-surface);">10. Contact</h2>
            <p style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.7;">Questions about these terms? Email <a href="mailto:{{ config('contact.email') }}" style="color: var(--md-sys-color-primary); text-decoration: none;">{{ config('contact.email') }}</a> or WhatsApp <a href="tel:{{ config('contact.phone') }}" style="color: var(--md-sys-color-primary); text-decoration: none;">{{ config('contact.phone_display') }}</a>.</p>
        </div>
    </div>
</section>

@endsection
