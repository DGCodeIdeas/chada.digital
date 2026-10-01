<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Site-wide meta (title, description, OG, Twitter, canonical,
         hreflang, theme-color, csrf-token, referrer, icons, structured
         data). Per-page overrides via $meta passed from the controller. --}}
    @include('partials.meta')

    {{-- Anti-FOUC: inline so it applies before any stylesheet or web
         component paints. Do not move this into compiled CSS. --}}
    <style>
        html { background-color: #fafafa; }
        body {
            font-family: Inter, system-ui, -apple-system, "Segoe UI", sans-serif;
            background-color: var(--md-sys-color-surface, #fafafa);
            color: var(--md-sys-color-on-surface, #171717);
        }
        h1, h2, h3, .display-5, .display-6 {
            font-family: Outfit, Inter, system-ui, sans-serif;
        }
        /* Undefined web components: keep space, do not paint as unknown tags. */
        wa-card:not(:defined) {
            display: block;
            visibility: hidden;
        }
        wa-card:defined {
            visibility: visible;
        }
        /* Font Awesome Kit (method:"js" / i2svg mode) injects SVGs after
           the deferred Kit script runs. The Kit adds two classes to <html>:
             - .fontawesome-i2svg-active  — added at the START of the scan
                                            (icons are still <i> elements,
                                             NOT yet replaced by SVGs)
             - .fontawesome-i2svg-complete — added when ALL icons have been
                                              replaced with inline SVGs

           The previous rule used :not(.complete):not(.active) which means
           "hide if NEITHER class is present" — i.e. show icons when EITHER
           is added. That was wrong: as soon as .fontawesome-i2svg-active
           was added (at scan START), the icons became visible as empty
           italic <i> boxes for the brief moment before SVG replacement.
           That was the FOUC.

           Fixed: only reveal when .fontawesome-i2svg-complete is present
           (scan is DONE, all icons are SVGs). If the Kit fails to add
           the class (Kit blocked, errored, etc.), a 2s fallback timer in
           the inline script below adds .fa-fallback-ready so icons
           become visible even without the Kit completing. */
        html:not(.fontawesome-i2svg-complete):not(.fa-fallback-ready) .fab,
        html:not(.fontawesome-i2svg-complete):not(.fa-fallback-ready) .fas,
        html:not(.fontawesome-i2svg-complete):not(.fa-fallback-ready) .far {
            visibility: hidden;
        }
    </style>

    {{-- Fallback: if the FA Kit never adds .fontawesome-i2svg-complete
         (script blocked, errored, slow CDN, etc.), reveal icons after
         a 2s delay so they don't stay hidden forever. The Kit's own
         completion class still wins (it's added by the Kit before
         the 2s elapses in the normal case). --}}
    <script>
        (function() {
            setTimeout(function() {
                document.documentElement.classList.add('fa-fallback-ready');
            }, 2000);
        })();
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://ka-f.webawesome.com" crossorigin>
    <link rel="preconnect" href="https://kit.fontawesome.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>

    {{-- Compiled site CSS first, so Bootstrap/MD3 win the first paint.
         Previously WA native.css (a reset) loaded before mix CSS and
         flashed unstyled / restyled content. --}}
    <link rel="preload" href="{{ mix('css/app.css') }}" as="style">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    {{-- display=optional: skip the swap if the font is not ready. --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=optional" rel="stylesheet">

    {{-- Web Awesome tokens only. utilities.css and native.css are a
         second design system / CSS reset and cause a first-paint flash
         against Bootstrap. wa-card still works from default.css + loader. --}}
    <link rel="stylesheet" href="https://ka-f.webawesome.com/webawesome@3.14.0/styles/themes/default.css">
    <script type="module" src="https://ka-f.webawesome.com/webawesome@3.14.0/webawesome.loader.js"></script>

    {{-- Kit deferred: does not block CSS. Icon FOUC covered by the
         .fontawesome-i2svg-* rules above. --}}
    <script src="https://kit.fontawesome.com/2a76805d59.js" crossorigin="anonymous" defer></script>

    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    @include('partials.header')

    <main class="flex-grow-1">
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.chat-widget')

    {{-- GSAP after content so it cannot delay first paint. --}}
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
