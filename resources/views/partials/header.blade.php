<header class="sticky-top" style="background: rgba(255,255,255,0.85); backdrop-filter: blur(12px); border-bottom: 1px solid var(--md-sys-color-outline-variant); z-index: 1030;">
    <nav class="navbar navbar-expand-lg" style="height: 64px;">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}" style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.5rem; color: var(--md-sys-color-primary); text-decoration: none;">
                <img src="{{ asset('images/chada-logo-horizontal-dark.png') }}" alt="Chada Digital" height="32" class="d-inline-block">
            </a>

            <!-- Mobile toggle -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Nav links -->
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : '' }}" href="{{ route('home') }}" style="color: var(--md-sys-color-on-surface); font-size: 0.9375rem;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('case-studies.*') ? 'active fw-semibold' : '' }}" href="{{ route('case-studies.index') }}" style="color: var(--md-sys-color-on-surface); font-size: 0.9375rem;">Case Studies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('services') ? 'active fw-semibold' : '' }}" href="{{ route('services') }}" style="color: var(--md-sys-color-on-surface); font-size: 0.9375rem;">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active fw-semibold' : '' }}" href="{{ route('about') }}" style="color: var(--md-sys-color-on-surface); font-size: 0.9375rem;">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('demos') ? 'active fw-semibold' : '' }}" href="{{ route('demos') }}" style="color: var(--md-sys-color-on-surface); font-size: 0.9375rem;">Demos</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-primary rounded-pill px-4" href="{{ route('contact') }}" style="background: var(--md-sys-color-primary); border-color: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary); font-weight: 500; font-size: 0.875rem;">
                            Start a Project
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
