@php
// SEO + AISEO meta tags — site-wide.
//
// Wired into the layout via @include('partials.meta') so every page
// inherits canonical URLs, hreflang, Open Graph, Twitter Cards, theme
// color, referrer policy, csrf token, and icons in a single pass.
//
// Per-page overrides: each controller passes a $meta array to its view.
// Supported keys: title, description, keywords, canonical, og_url,
// og_title, og_description, og_image, og_image_alt, og_type, article_author,
// article_published_time, article_modified_time, article_section, article_tag,
// twitter_card, twitter_title, twitter_description, twitter_image,
// hreflang_en, hreflang_default.
//
// Defaults: pulls from config/brand.php and config/seo.php. Pages that
// don't pass $meta still get reasonable defaults — site-wide title
// fallback, brand tagline as description, root URL as canonical.

$seoDefaults = config('seo.defaults', []);
$brandName   = config('brand.name', 'Chada Digital');
$brandTag    = config('brand.tagline');
$siteUrl     = config('app.url', url('/'));
$currentUrl  = url()->current();

// Per-page meta (passed from controller) merged over defaults
$meta = array_merge($seoDefaults, $meta ?? []);

// Resolve each meta value with sensible fallbacks
$title       = $meta['title']       ?? $brandName;
$description = $meta['description'] ?? $brandTag;
$keywords    = $meta['keywords']    ?? implode(', ', array_filter(['website design Lagos', 'Lagos web developer', 'automation', 'branding', 'Nigeria']));
$canonical   = $meta['canonical']   ?? $currentUrl;
$ogUrl       = $meta['og_url']       ?? $currentUrl;
$ogType      = $meta['og_type']      ?? 'website';
$ogTitle     = $meta['og_title']     ?? $title;
$ogDesc      = $meta['og_description'] ?? $description;
$ogImage     = $meta['og_image']     ?? asset('og-image.jpg');
$ogImageAlt  = $meta['og_image_alt'] ?? $title . ' — ' . $brandName;
$twCard      = $meta['twitter_card']        ?? 'summary_large_image';
$twTitle     = $meta['twitter_title']       ?? $ogTitle;
$twDesc      = $meta['twitter_description'] ?? $ogDesc;
$twImage     = $meta['twitter_image']       ?? $ogImage;
$hreflangEn  = $meta['hreflang_en']      ?? $siteUrl;
$hreflangDef = $meta['hreflang_default']  ?? $siteUrl;

// OG image dimensions — actual og-image.jpg is 1536x1024 (3:2).
// Override via $meta['og_image_width'] / og_image_height if using a custom image.
$ogImgWidth  = $meta['og_image_width']  ?? 1536;
$ogImgHeight = $meta['og_image_height'] ?? 1024;
$ogImgType   = $meta['og_image_type']   ?? 'image/jpeg';
@endphp

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="theme-color" content="#f4f2ee">
<meta name="referrer" content="strict-origin-when-cross-origin">

<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
@if(!empty($keywords))
<meta name="keywords" content="{{ $keywords }}">
@endif
<meta name="author" content="{{ $brandName }}">
<meta name="copyright" content="{{ $brandName }}">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1, max-image-preview:large">

<link rel="canonical" href="{{ $canonical }}">
<link rel="alternate" hreflang="en-ng" href="{{ $hreflangEn }}">
<link rel="alternate" hreflang="x-default" href="{{ $hreflangDef }}">

{{-- Open Graph --}}
<meta property="og:url" content="{{ $ogUrl }}">
<meta property="og:site_name" content="{{ $brandName }}">
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $ogDesc }}">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:locale" content="en_NG">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:secure_url" content="{{ $ogImage }}">
<meta property="og:image:type" content="{{ $ogImgType }}">
<meta property="og:image:width" content="{{ $ogImgWidth }}">
<meta property="og:image:height" content="{{ $ogImgHeight }}">
<meta property="og:image:alt" content="{{ $ogImageAlt }}">

{{-- Article-specific OG tags — only render when og_type === 'article' --}}
@if($ogType === 'article')
    @if(!empty($meta['article_author']))
    <meta property="article:author" content="{{ $meta['article_author'] }}">
    @endif
    @if(!empty($meta['article_published_time']))
    <meta property="article:published_time" content="{{ $meta['article_published_time'] }}">
    @endif
    @if(!empty($meta['article_modified_time']))
    <meta property="article:modified_time" content="{{ $meta['article_modified_time'] }}">
    @endif
    @if(!empty($meta['article_section']))
    <meta property="article:section" content="{{ $meta['article_section'] }}">
    @endif
    @if(!empty($meta['article_tag']))
    @foreach((array) $meta['article_tag'] as $tag)
    <meta property="article:tag" content="{{ $tag }}">
    @endforeach
    @endif
@endif

{{-- Twitter Card --}}
<meta name="twitter:card" content="{{ $twCard }}">
<meta name="twitter:title" content="{{ $twTitle }}">
<meta name="twitter:description" content="{{ $twDesc }}">
<meta name="twitter:image" content="{{ $twImage }}">
@if(config('social.twitter'))
<meta name="twitter:site" content="@{{ ltrim(parse_url(config('social.twitter'), PHP_URL_PATH), '/') }}">
@endif

{{-- Icons --}}
<link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
<link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
<meta name="msapplication-TileColor" content="#f4f2ee">

@include('partials.structured-data')
