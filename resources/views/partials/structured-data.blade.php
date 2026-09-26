@php
// Structured data (Schema.org JSON-LD) for SEO + AISEO.
//
// Goals:
//   1. Give classic search engines (Google, Bing) rich entity markup for
//      sitelinks, rich results, and Knowledge Graph reconciliation.
//   2. Give LLM-based answer engines (ChatGPT, Perplexity, Claude, Google
//      AI Overviews) a clean, machine-readable description of who we are,
//      who founded us, what we do, and how to reach us.
//
// Blocks emitted (all on every page — Google's structured data guidelines
// allow multiple top-level entities per page):
//   - Organization (the studio)
//   - WebSite       (with SearchAction — enables sitelinks search box)
//   - Person        (the founder, Okeoma Joseph)
//   - BreadcrumbList (only on non-home pages — @if(!$isHome))
//
// Per-page structured data (Service, FAQPage, etc.) is emitted by the
// page itself via @push('structured-data').

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

$isHome    = Route::currentRouteNamed('home') ?? (request()->path() === '/');
$founderName    = config('founder.heading') === 'Founder' ? 'Okeoma Joseph' : (config('founder.heading') ?? 'Okeoma Joseph');
$founderTitle   = config('founder.title', 'Founder & Lead Engineer');
$founderPhoto   = config('founder.real') ? asset((string) config('founder.photo')) : null;
$siteUrl        = config('app.url', url('/'));
$siteName       = config('brand.name', 'Chada Digital');
$siteTagline    = config('brand.tagline');
$foundedYear    = (int) config('brand.founded_year', 2023);

// sameAs — Knowledge Graph reconciliation links. Company-level accounts
// (LinkedIn page, Instagram, Twitter/X). Founder-level accounts could be
// added later under Person.sameAs when available.
$companySameAs = array_filter(array_map('trim', [
    config('social.linkedin'),
    config('social.instagram'),
    config('social.twitter'),
]));

// Organization (the studio)
$organization = [
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    '@id' => $siteUrl . '#organization',
    'name' => $siteName,
    'url' => $siteUrl,
    'logo' => asset('chada-logo-horizontal-dark.png'),
    'description' => $siteTagline,
    'foundingDate' => $foundedYear,
    'address' => [
        '@type' => 'PostalAddress',
        'addressLocality' => config('contact.location', 'Lagos, Nigeria'),
        'addressCountry' => 'NG',
    ],
    'contactPoint' => [
        '@type' => 'ContactPoint',
        'contactType' => 'customer service',
        'email' => config('contact.email'),
        'telephone' => config('contact.phone'),
        'availableLanguage' => ['English'],
    ],
    'sameAs' => $companySameAs,
    'founder' => ['@type' => 'Person', '@id' => $siteUrl . '#founder'],
];

// WebSite (enables sitelinks search box in Google results).
// We don't have a site-wide search endpoint yet, so the SearchAction
// target is intentionally minimal — points at /?s={search_term_string}
// which we can wire up later. Better to declare it now than be missing
// the markup when search is added.
$website = [
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    '@id' => $siteUrl . '#website',
    'url' => $siteUrl,
    'name' => $siteName,
    'description' => $siteTagline,
    'inLanguage' => 'en-NG',
    'publisher' => ['@id' => $siteUrl . '#organization'],
    'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => [
            '@type' => 'EntryPoint',
            'urlTemplate' => $siteUrl . '/?s={search_term_string}',
            'actionPlatform' => [
                'https://schema.org/DesktopWebPlatform',
                'https://schema.org/MobileWebPlatform',
            ],
        ],
        'query-input' => 'required name=search_term_string',
    ],
];

// Person (the founder). Critical for AISEO — LLMs use Person schema to
// attribute content to authors and to disambiguate entities.
$person = [
    '@context' => 'https://schema.org',
    '@type' => 'Person',
    '@id' => $siteUrl . '#founder',
    'name' => $founderName,
    'jobTitle' => $founderTitle,
    'worksFor' => ['@id' => $siteUrl . '#organization'],
    'url' => route('about'),
    'description' => 'Founder and lead engineer at ' . $siteName . '. Based in Lagos, Nigeria.',
    'knowsAbout' => [
        'Web development',
        'Marketing automation',
        'Brand identity design',
        'Laravel',
        'Paystack integration',
        'HubSpot',
        'Meta Ads',
    ],
];
if ($founderPhoto) {
    $person['image'] = $founderPhoto;
}
// Person.sameAs — only include if we have founder-level profile URLs.
// Currently the social config is company-level. Leaving empty is better
// than pointing founder.sameAs at company pages (which would confuse
// entity disambiguation). Add founder's personal LinkedIn/Twitter here
// when available.

// BreadcrumbList (only on non-home pages — Google's guidelines say
// breadcrumb markup should reflect the page's position in the site
// hierarchy, and the homepage has no parent so it gets none).
$breadcrumb = null;
if (!$isHome) {
    $currentPath = trim(request()->path(), '/');
    // Build a simple Home > {Section} breadcrumb. Page-specific paths can
    // be overridden by pushing a more detailed breadcrumb via @push.
    $sectionLabel = match(true) {
        str_starts_with($currentPath, 'about')         => 'About',
        str_starts_with($currentPath, 'services')      => 'Services & Pricing',
        str_starts_with($currentPath, 'contact')      => 'Contact',
        str_starts_with($currentPath, 'case-studies')  => 'Case Studies',
        str_starts_with($currentPath, 'case-study/')   => 'Case Studies',
        str_starts_with($currentPath, 'demo-lab')      => 'Demo Lab',
        str_starts_with($currentPath, 'preview/')      => 'Live Preview',
        str_starts_with($currentPath, 'design-partner') => 'Design Partner',
        str_starts_with($currentPath, 'terms')         => 'Terms of Service',
        str_starts_with($currentPath, 'privacy')       => 'Privacy Policy',
        str_starts_with($currentPath, 'cookies')       => 'Cookie Policy',
        default                                         => null,
    };
    if ($sectionLabel !== null) {
        $breadcrumb = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Home',
                    'item' => $siteUrl,
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => $sectionLabel,
                    'item' => url()->current(),
                ],
            ],
        ];
    }
}

$blocks = array_filter([$organization, $website, $person, $breadcrumb]);
@endphp

@foreach($blocks as $block)
<script type="application/ld+json">
{!! json_encode($block, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endforeach

@stack('structured-data')
