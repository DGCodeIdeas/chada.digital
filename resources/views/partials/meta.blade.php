<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
<meta name="referrer" content="strict-origin-when-cross-origin" />
<meta name="author" content="{{ config('placeholders.brand.name') }}" />
<meta name="copyright" content="{{ config('placeholders.brand.name') }}" />
<meta name="theme-color" content="#f4f2ee" />
<title>{{ $meta['title'] ?? config('app.name', 'Chada Digital') }}</title>
<meta name="description" content="{{ $meta['description'] ?? config('placeholders.brand.tagline') }}" />
<link rel="canonical" href="{{ $meta['canonical'] ?? 'https://www.chadadigital.com' }}" />
<link rel="alternate" hreflang="en_NG" href="{{ $meta['hreflang_en'] ?? 'https://www.chadadigital.com' }}" />
<link rel="alternate" hreflang="x-default" href="{{ $meta['hreflang_default'] ?? 'https://www.chadadigital.com' }}" />
<meta property="og:url" content="{{ $meta['og_url'] ?? 'https://www.chadadigital.com' }}" />
<meta property="og:site_name" content="{{ $meta['og_site_name'] ?? config('placeholders.brand.name') }}" />
<meta property="og:title" content="{{ $meta['og_title'] ?? config('placeholders.brand.name') . ' | ' . config('placeholders.brand.tagline') }}" />
<meta property="og:description" content="{{ $meta['og_description'] ?? config('placeholders.brand.tagline') }}" />
<meta property="og:type" content="{{ $meta['og_type'] ?? 'website' }}" />
<meta property="og:locale" content="{{ $meta['og_locale'] ?? 'en_NG' }}" />
<meta property="og:image" content="{{ $meta['og_image'] ?? 'https://www.chadadigital.com/og-image.jpg' }}" />
<meta property="og:image:secure_url" content="{{ $meta['og_image_secure'] ?? 'https://www.chadadigital.com/og-image.jpg' }}" />
<meta property="og:image:type" content="{{ $meta['og_image_type'] ?? 'image/jpeg' }}" />
<meta property="og:image:width" content="{{ $meta['og_image_width'] ?? '1216' }}" />
<meta property="og:image:height" content="{{ $meta['og_image_height'] ?? '640' }}" />
<meta property="og:image:alt" content="{{ $meta['og_image_alt'] ?? config('placeholders.brand.name') . ' | ' . config('placeholders.brand.tagline') }}" />
<meta name="twitter:card" content="{{ $meta['twitter_card'] ?? 'summary_large_image' }}" />
<meta name="twitter:title" content="{{ $meta['twitter_title'] ?? config('placeholders.brand.name') . ' | ' . config('placeholders.brand.tagline') }}" />
<meta name="twitter:description" content="{{ $meta['twitter_description'] ?? config('placeholders.brand.tagline') }}" />
<meta name="twitter:image" content="{{ $meta['twitter_image'] ?? 'https://www.chadadigital.com/og-image.jpg' }}" />
<link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any" />
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}" />
<link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}" />
<meta name="msapplication-TileColor" content="#f4f2ee" />
@include('partials.structured-data')