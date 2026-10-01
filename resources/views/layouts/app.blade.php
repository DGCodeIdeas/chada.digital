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

    <!-- Font Awesome Kit — the founder's own Kit at kit.fontawesome.com.
         Loaded as a synchronous <script> (no defer) so the icon CSS is
         injected before any inline SVG/icon usage runs, avoiding FOUC.
         The Kit auto-handles icon subset loading, accessibility, and
         version updates — replaces the earlier @fortawesome/fontawesome-free
         CDN link. -->
    <script src="https://kit.fontawesome.com/2a76805d59.js" crossorigin="anonymous"></script>

    <!-- Web Components (Web Awesome by Font Awesome) — used by all
         card components site-wide. The loader is an ES module that
         auto-registers every <wa-*> custom element on the page as it's
         encountered. Pinned to v3.14.0. Three stylesheets:
           - default.css: design tokens (--wa-* custom properties)
           - utilities.css: utility classes ("CSS Utilities")
           - native.css: CSS reset ("Native Styles")
         The MD3 ↔ WA token bridge in resources/sass/_chada-custom.scss
         maps our --md-sys-color-* values into --wa-color-* / --wa-panel-*
         tokens so wa-card components inherit Chada's brand palette
         instead of WA's defaults. -->
    <link rel="stylesheet" href="https://ka-f.webawesome.com/webawesome@3.14.0/styles/themes/default.css">
    <link rel="stylesheet" href="https://ka-f.webawesome.com/webawesome@3.14.0/styles/utilities.css">
    <link rel="stylesheet" href="https://ka-f.webawesome.com/webawesome@3.14.0/styles/native.css">
    <script type="module" src="https://ka-f.webawesome.com/webawesome@3.14.0/webawesome.loader.js"></script>

    <!-- GSAP — GreenSock Animation Platform. Used for all site
         animations (replaces CSS keyframes for the marquee, plus any
         future animation work). Loaded as a regular <script> (not
         type=module) so it's globally available as window.gsap before
         app.js runs. Pinned to v3.12.5. The ScrollTrigger plugin is
         NOT loaded — we don't use scroll-driven animations yet. Add
         it via a separate <script> tag if needed later. -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>

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
