<footer style="background: var(--md-sys-color-surface-variant); border-top: 1px solid var(--md-sys-color-outline-variant); padding: 4rem 0 2rem;">
    <div class="container">
        <div class="row g-4">
            <!-- Brand -->
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('home') }}" class="d-inline-block mb-3">
                    <img src="{{ asset('images/chada-logo-horizontal-dark.png') }}" alt="Chada Digital" height="32">
                </a>
                <p class="mb-3" style="color: var(--md-sys-color-on-surface-variant); font-size: 0.9375rem; max-width: 320px;">
                    Digital solutions that help businesses grow. Web development, funnel automation, paid advertising, and brand strategy.
                </p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-decoration-none" style="color: var(--md-sys-color-on-surface-variant);" aria-label="LinkedIn">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </a>
                    <a href="#" class="text-decoration-none" style="color: var(--md-sys-color-on-surface-variant);" aria-label="Instagram">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="#" class="text-decoration-none" style="color: var(--md-sys-color-on-surface-variant);" aria-label="Twitter">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Navigation -->
            <div class="col-lg-2 col-md-6">
                <h6 class="fw-semibold mb-3" style="color: var(--md-sys-color-on-surface); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">Navigate</h6>
                <ul class="list-unstyled mb-0" style="font-size: 0.9375rem;">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--md-sys-color-on-surface-variant);">Home</a></li>
                    <li class="mb-2"><a href="{{ route('case-studies.index') }}" class="text-decoration-none" style="color: var(--md-sys-color-on-surface-variant);">Case Studies</a></li>
                    <li class="mb-2"><a href="{{ route('services') }}" class="text-decoration-none" style="color: var(--md-sys-color-on-surface-variant);">Services</a></li>
                    <li class="mb-2"><a href="{{ route('about') }}" class="text-decoration-none" style="color: var(--md-sys-color-on-surface-variant);">About</a></li>
                    <li class="mb-2"><a href="{{ route('contact') }}" class="text-decoration-none" style="color: var(--md-sys-color-on-surface-variant);">Contact</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div class="col-lg-2 col-md-6">
                <h6 class="fw-semibold mb-3" style="color: var(--md-sys-color-on-surface); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">Services</h6>
                <ul class="list-unstyled mb-0" style="font-size: 0.9375rem;">
                    <li class="mb-2"><a href="{{ route('services') }}" class="text-decoration-none" style="color: var(--md-sys-color-on-surface-variant);">Web Development</a></li>
                    <li class="mb-2"><a href="{{ route('services') }}" class="text-decoration-none" style="color: var(--md-sys-color-on-surface-variant);">Funnel Automation</a></li>
                    <li class="mb-2"><a href="{{ route('services') }}" class="text-decoration-none" style="color: var(--md-sys-color-on-surface-variant);">Paid Advertising</a></li>
                    <li class="mb-2"><a href="{{ route('services') }}" class="text-decoration-none" style="color: var(--md-sys-color-on-surface-variant);">Brand Strategy</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-lg-4 col-md-6">
                <h6 class="fw-semibold mb-3" style="color: var(--md-sys-color-on-surface); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">Contact</h6>
                <ul class="list-unstyled mb-0" style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant);">
                    <li class="mb-2 d-flex align-items-center gap-2">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                        hello@chadadigital.com
                    </li>
                    <li class="mb-2 d-flex align-items-center gap-2">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                        +234 000 000 0000
                    </li>
                    <li class="mb-2 d-flex align-items-center gap-2">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        Lagos, Nigeria
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-4" style="border-color: var(--md-sys-color-outline-variant);">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2" style="font-size: 0.875rem; color: var(--md-sys-color-on-surface-variant);">
            <p class="mb-0">© {{ date('Y') }} Chada Digital. All rights reserved.</p>
            <div class="d-flex gap-4">
                <a href="#" class="text-decoration-none" style="color: var(--md-sys-color-on-surface-variant);">Privacy Policy</a>
                <a href="#" class="text-decoration-none" style="color: var(--md-sys-color-on-surface-variant);">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
