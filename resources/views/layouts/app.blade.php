<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.meta')
    @include('partials.fonts')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @stack('head')
</head>
<body class="bg-background text-foreground antialiased">
    @include('partials.header')
    
    <main>
        @yield('content')
    </main>
    
    @include('partials.footer')

    @include('partials.chat-widget')

    <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>