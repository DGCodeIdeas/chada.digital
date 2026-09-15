<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $meta['title'] ?? config('brand.name') }}</title>
    <meta name="description" content="{{ $meta['description'] ?? config('brand.tagline') }}">
    <meta name="keywords" content="website design Lagos, automation, branding, {{ config('contact.location') }}">
    <meta name="author" content="{{ config('brand.name') }}">
    <meta name="robots" content="index, follow">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $meta['title'] ?? config('brand.name') }}">
    <meta property="og:description" content="{{ $meta['description'] ?? config('brand.tagline') }}">
    <meta property="og:image" content="{{ $meta['og_image'] ?? asset('og-image.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('brand.name') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $meta['title'] ?? config('brand.name') }}">
    <meta name="twitter:description" content="{{ $meta['description'] ?? config('brand.tagline') }}">
    <meta name="twitter:image" content="{{ $meta['og_image'] ?? asset('og-image.jpg') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    <!-- Preload CSS to prevent FOUC (flash of unstyled content) -->
    <link rel="preload" href="{{ mix('css/app.css') }}" as="style">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @include('partials.structured-data')

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
