@extends('layouts.app')

@section('content')

<section style="background: linear-gradient(135deg, #f8f6f3 0%, #f0ede8 100%); padding: 5rem 0 3rem;">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5">
                <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em;">Contact</p>
                <h1 class="display-5 fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">Let Us Build Your Next Revenue System</h1>
                <p class="mb-4" style="color: var(--md-sys-color-on-surface-variant); font-size: 1.0625rem; line-height: 1.7;">
                    Tell us what you are trying to achieve. We will reply within 24 hours with a clear assessment of what is possible, how long it will take, and what it will cost.
                </p>

                <div class="card border-0 mb-4" style="background: var(--md-sys-color-surface); border-radius: 16px;">
                    <div class="card-body p-4">
                        <h6 class="fw-semibold mb-3" style="font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--md-sys-color-on-surface);">Direct Contact</h6>
                        <ul class="list-unstyled mb-0" style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant);">
                            <li class="d-flex align-items-center gap-3 mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container);">
                                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                                </div>
                                <span>hello@chadadigital.com</span>
                            </li>
                            <li class="d-flex align-items-center gap-3 mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container);">
                                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                                </div>
                                <span>+234 000 000 0000</span>
                            </li>
                            <li class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container);">
                                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                                </div>
                                <span>Lagos, Nigeria</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card border-0" style="background: var(--md-sys-color-surface); border-radius: 16px;">
                    <div class="card-body p-4">
                        <h6 class="fw-semibold mb-3" style="font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--md-sys-color-on-surface);">Response Guarantee</h6>
                        <p class="mb-0" style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.6;">
                            We reply to all inquiries within 24 hours during business days. For urgent requests, WhatsApp us directly and we will respond within 2 hours.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card border-0" style="background: var(--md-sys-color-surface); border-radius: 16px; box-shadow: 0 4px 16px rgba(0,0,0,0.06);">
                    <div class="card-body p-4 p-lg-5">
                        <h4 class="fw-semibold mb-4" style="color: var(--md-sys-color-on-surface);">Send a Message</h4>
                        <form id="contactForm" action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label" style="font-weight: 500; font-size: 0.875rem; color: var(--md-sys-color-on-surface);">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required style="border-radius: 12px; border-color: var(--md-sys-color-outline-variant); padding: 0.75rem 1rem;">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label" style="font-weight: 500; font-size: 0.875rem; color: var(--md-sys-color-on-surface);">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required style="border-radius: 12px; border-color: var(--md-sys-color-outline-variant); padding: 0.75rem 1rem;">
                                </div>
                                <div class="col-12">
                                    <label for="subject" class="form-label" style="font-weight: 500; font-size: 0.875rem; color: var(--md-sys-color-on-surface);">Subject</label>
                                    <select class="form-select" id="subject" name="subject" required style="border-radius: 12px; border-color: var(--md-sys-color-outline-variant); padding: 0.75rem 1rem;">
                                        <option value="">Select a topic...</option>
                                        <option value="Web Development Project">Web Development Project</option>
                                        <option value="Funnel & Automation">Funnel & Automation</option>
                                        <option value="Paid Advertising">Paid Advertising</option>
                                        <option value="Brand Strategy">Brand Strategy</option>
                                        <option value="General Inquiry">General Inquiry</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label" style="font-weight: 500; font-size: 0.875rem; color: var(--md-sys-color-on-surface);">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required style="border-radius: 12px; border-color: var(--md-sys-color-outline-variant); padding: 0.75rem 1rem; resize: vertical;"></textarea>
                                </div>
                                <!-- Honeypot -->
                                <div class="d-none">
                                    <input type="text" name="website" tabindex="-1" autocomplete="off">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-3" style="background: var(--md-sys-color-primary); border-color: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary); font-weight: 500; font-size: 1rem;">
                                        Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div id="formResponse" class="mt-3" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.getElementById('contactForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = this;
    const responseDiv = document.getElementById('formResponse');
    const btn = form.querySelector('button[type="submit"]');
    const originalText = btn.textContent;
    btn.disabled = true;
    btn.textContent = 'Sending...';

    try {
        const res = await fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(Object.fromEntries(new FormData(form))),
        });
        const data = await res.json();
        responseDiv.style.display = 'block';
        if (data.success) {
            responseDiv.className = 'alert alert-success rounded-3';
            responseDiv.textContent = data.message;
            form.reset();
        } else {
            responseDiv.className = 'alert alert-danger rounded-3';
            responseDiv.textContent = data.message || 'Something went wrong. Please try again.';
        }
    } catch (err) {
        responseDiv.style.display = 'block';
        responseDiv.className = 'alert alert-danger rounded-3';
        responseDiv.textContent = 'Network error. Please email us directly at hello@chadadigital.com';
    } finally {
        btn.disabled = false;
        btn.textContent = originalText;
    }
});
</script>
@endpush

@endsection
