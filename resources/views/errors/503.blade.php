<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>We'll be right back — Chada Digital</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="bg-background text-foreground antialiased">
    <main class="flex min-h-screen flex-col items-center justify-center px-6 text-center">
        <img
            src="{{ asset('chada-logo-horizontal-dark.png') }}"
            alt="Chada Digital"
            class="h-9 w-auto mb-12"
        />

        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-primary/10">
            <svg class="h-7 w-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17L4.929 21m8.749-13.749c.34-.34.815-.421 1.229-.24l.4.174a2.652 2.652 0 001.905-.14l.774-.387a2.652 2.652 0 011.905-.14l.4.174c.414.181.889.1 1.229-.24l.774-.774a2.652 2.652 0 00.53-2.858l-.174-.4a2.652 2.652 0 00-2.858-.53l-.774.387a2.652 2.652 0 01-1.905.14l-.4-.174a2.652 2.652 0 00-1.905.14l-.774.387a2.652 2.652 0 01-1.229.24z" />
            </svg>
        </div>

        <h1 class="font-display text-2xl font-bold tracking-tight md:text-4xl">
            We're making a few updates
        </h1>
        <p class="mt-4 max-w-md text-muted-foreground">
            Chada Digital is offline briefly for scheduled maintenance. We'll be back
            shortly — thanks for bearing with us.
        </p>

        <p class="mt-10 text-xs uppercase tracking-widest text-muted-foreground">
            Need us urgently?
            <a href="mailto:info@chadadigital.com" class="text-primary hover:underline">
                info@chadadigital.com
            </a>
        </p>
    </main>
</body>
</html>
