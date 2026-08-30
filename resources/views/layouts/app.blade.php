<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $meta['title'] ?? 'Chada Digital' }}</title>
    <meta name="description" content="{{ $meta['description'] ?? 'Digital solutions that help businesses grow.' }}">
    <meta name="keywords" content="web development, digital marketing, automation, Lagos, Nigeria">
    <meta name="author" content="Chada Digital">
    <meta name="robots" content="index, follow">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $meta['title'] ?? 'Chada Digital' }}">
    <meta property="og:description" content="{{ $meta['description'] ?? 'Digital solutions that help businesses grow.' }}">
    <meta property="og:image" content="{{ $meta['og_image'] ?? asset('og-image.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Chada Digital">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $meta['title'] ?? 'Chada Digital' }}">
    <meta name="twitter:description" content="{{ $meta['description'] ?? 'Digital solutions that help businesses grow.' }}">
    <meta name="twitter:image" content="{{ $meta['og_image'] ?? asset('og-image.jpg') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
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
    <script src="{{ mix('js/app.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
