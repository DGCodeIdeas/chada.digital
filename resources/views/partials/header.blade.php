<header class="sticky-top" style="background: rgba(255,255,255,0.85); backdrop-filter: blur(12px); z-index: 1030;">
    <nav class="navbar navbar-expand-lg" style="height: 56px;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}" style="text-decoration: none;">
                <img src="{{ asset('chada-logo-horizontal-dark.png') }}" alt="{{ config('brand.name') }}" height="28" class="d-inline-block">
            </a>

            {{-- Desktop nav (lg and up) --}}
            <ul class="navbar-nav ms-auto d-none d-lg-flex align-items-center gap-3 mb-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : '' }}" href="{{ route('home') }}" style="color: var(--md-sys-color-on-surface); font-size: 0.875rem; padding: 0.25rem 0.5rem;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('case-studies.*') ? 'active fw-semibold' : '' }}" href="{{ route('case-studies.index') }}" style="color: var(--md-sys-color-on-surface); font-size: 0.875rem; padding: 0.25rem 0.5rem;">Case Studies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('services') ? 'active fw-semibold' : '' }}" href="{{ route('services') }}" style="color: var(--md-sys-color-on-surface); font-size: 0.875rem; padding: 0.25rem 0.5rem;">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active fw-semibold' : '' }}" href="{{ route('about') }}" style="color: var(--md-sys-color-on-surface); font-size: 0.875rem; padding: 0.25rem 0.5rem;">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('demos') ? 'active fw-semibold' : '' }}" href="{{ route('demos') }}" style="color: var(--md-sys-color-on-surface); font-size: 0.875rem; padding: 0.25rem 0.5rem;">Work</a>
                </li>
                <li class="nav-item ms-2">
                    <a class="btn btn-primary rounded-pill px-3" href="{{ route('contact') }}" style="background: var(--md-sys-color-primary); border-color: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary); font-weight: 500; font-size: 0.8125rem; padding: 0.375rem 0.875rem;">
                        Start a Project
                    </a>
                </li>
            </ul>

            {{-- Mobile sidebar toggle (below lg) --}}
            <button class="btn btn-link d-lg-none p-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileNav" aria-controls="mobileNav" aria-label="Open menu" style="color: var(--md-sys-color-on-surface); text-decoration: none; line-height: 1;">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </nav>
</header>

{{-- Mobile sidebar (offcanvas) — slides in from the right --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="mobileNav" aria-labelledby="mobileNavLabel" style="background: var(--md-sys-color-surface); width: 280px;">
    <div class="offcanvas-header" style="padding: 1rem 1.25rem;">
        <h5 class="offcanvas-title" id="mobileNavLabel" style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.125rem; color: var(--md-sys-color-primary);">
            <img src="{{ asset('chada-logo-horizontal-dark.png') }}" alt="{{ config('brand.name') }}" height="24" class="d-inline-block">
        </h5>
        <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas" aria-label="Close" style="opacity: 0.6;"></button>
    </div>
    <div class="offcanvas-body" style="padding: 0.5rem 0;">
        <ul class="list-unstyled mb-0">
            <li>
                <a class="d-block py-3 px-4 {{ request()->routeIs('home') ? 'fw-semibold' : '' }}" href="{{ route('home') }}" data-bs-dismiss="offcanvas" style="color: var(--md-sys-color-on-surface); font-size: 0.9375rem; text-decoration: none;">
                    Home
                </a>
            </li>
            <li>
                <a class="d-block py-3 px-4 {{ request()->routeIs('case-studies.*') ? 'fw-semibold' : '' }}" href="{{ route('case-studies.index') }}" data-bs-dismiss="offcanvas" style="color: var(--md-sys-color-on-surface); font-size: 0.9375rem; text-decoration: none;">
                    Case Studies
                </a>
            </li>
            <li>
                <a class="d-block py-3 px-4 {{ request()->routeIs('services') ? 'fw-semibold' : '' }}" href="{{ route('services') }}" data-bs-dismiss="offcanvas" style="color: var(--md-sys-color-on-surface); font-size: 0.9375rem; text-decoration: none;">
                    Services
                </a>
            </li>
            <li>
                <a class="d-block py-3 px-4 {{ request()->routeIs('about') ? 'fw-semibold' : '' }}" href="{{ route('about') }}" data-bs-dismiss="offcanvas" style="color: var(--md-sys-color-on-surface); font-size: 0.9375rem; text-decoration: none;">
                    About
                </a>
            </li>
            <li>
                <a class="d-block py-3 px-4 {{ request()->routeIs('demos') ? 'fw-semibold' : '' }}" href="{{ route('demos') }}" data-bs-dismiss="offcanvas" style="color: var(--md-sys-color-on-surface); font-size: 0.9375rem; text-decoration: none;">
                    Demos
                </a>
            </li>
            <li>
                <a class="d-block py-3 px-4 {{ request()->routeIs('contact') ? 'fw-semibold' : '' }}" href="{{ route('contact') }}" data-bs-dismiss="offcanvas" style="color: var(--md-sys-color-on-surface); font-size: 0.9375rem; text-decoration: none;">
                    Contact
                </a>
            </li>
        </ul>

        <div class="px-4 py-3 mt-3" style="background: var(--md-sys-color-surface-container-low, #f3edf7);">
            <p class="mb-2" style="font-size: 0.6875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; color: var(--md-sys-color-on-surface-variant);">Get in touch</p>
            <a href="mailto:{{ config('contact.email') }}" class="d-block mb-1" style="font-size: 0.8125rem; color: var(--md-sys-color-primary); text-decoration: none;">
                {{ config('contact.email') }}
            </a>
            <a href="tel:{{ config('contact.phone') }}" class="d-block" style="font-size: 0.8125rem; color: var(--md-sys-color-primary); text-decoration: none;">
                {{ config('contact.phone_display') }}
            </a>
        </div>

        <div class="px-4 py-3">
            <a href="{{ route('contact') }}" class="btn btn-primary w-100 rounded-pill" data-bs-dismiss="offcanvas" style="background: var(--md-sys-color-primary); border-color: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary); font-weight: 500; font-size: 0.875rem; padding: 0.625rem 1rem;">
                Start a Project
            </a>
        </div>
    </div>
</div>
