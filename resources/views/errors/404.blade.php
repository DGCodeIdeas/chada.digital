@extends('layouts.app')

@section('content')
<main class="flex min-h-screen items-center justify-center px-6">
    <div class="text-center">
        <span class="text-6xl font-extrabold text-primary">404</span>
        <h1 class="mt-4 font-display text-2xl font-bold tracking-tight md:text-4xl">Page Not Found</h1>
        <p class="mt-4 max-w-md mx-auto text-muted-foreground">The page you are looking for doesn't exist or has been moved.</p>
        <a href="{{ route('home') }}" class="mt-8 inline-flex items-center gap-2 rounded-full bg-primary px-7 py-3.5 text-xs font-semibold uppercase tracking-widest text-primary-foreground transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30">
            Go Back Home
        </a>
    </div>
</main>
@endsection