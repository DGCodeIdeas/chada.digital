<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Site-wide meta (title, description, OG, Twitter, canonical,
         hreflang, theme-color, csrf-token, referrer, icons, structured
         data). Per-page overrides via $meta passed from the controller. --}}
    @include('partials.meta')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Brand Icons (Font Awesome 6 Free) — used by Our Stack section.
         Renders brand logos (Stripe, Laravel, Shopify, HubSpot, Meta, etc.)
         via the `fab fa-{slug}` class and solid fallback icons via `fas fa-{slug}`.
         Replaces the earlier Simple Icons CDN. -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6/css/all.min.css">

    <!-- Web Components (Web Awesome / Shoelace) — used by all card
         components site-wide. Loaded as ES module (autoloader registers
         every <sl-*> custom element on the page). Pinned to v2.20.1
         (the current production version of @shoelace-style/shoelace,
         which is being renamed to "Web Awesome"). The light theme CSS
         is loaded separately so the components inherit our MD3 token
         values via the .sl-style-custom-bridge overrides in
         resources/sass/_chada-custom.scss. -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.20.1/cdn/themes/light.css">
    <script type="module" src="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.20.1/cdn/shoelace-autoloader.js"></script>

    <!-- Styles -->
    <!-- Preload CSS to prevent FOUC (flash of unstyled content) -->
    <link rel="preload" href="{{ mix('css/app.css') }}" as="style">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100" style="font-family: 'Inter', sans-serif; background-color: var(--md-sys-color-surface); color: var(--md-sys-color-on-surface);">

    @include('partials.header')

    <main class="flex-grow-1">
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.chat-widget')

    <!-- Scripts -->
    <!-- Scripts: loaded WITHOUT defer so jQuery/Bootstrap are available before
         any inline scripts run. The 'defer' was causing '$ is not defined' errors
         because app.js wasn't executed before page-level scripts tried to use $. -->
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
