@php
$structuredData = [
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => config('brand.name'),
    'url' => url('/'),
    'logo' => asset('images/chada-logo-horizontal-dark.png'),
    'description' => config('brand.tagline'),
    'address' => [
        '@type' => 'PostalAddress',
        'addressLocality' => config('contact.location'),
        'addressCountry' => 'NG',
    ],
    'contactPoint' => [
        '@type' => 'ContactPoint',
        'contactType' => 'customer service',
        'email' => config('contact.email'),
        'telephone' => config('contact.phone'),
        'availableLanguage' => ['English'],
    ],
    'sameAs' => array_filter([
        config('social.linkedin'),
        config('social.instagram'),
        config('social.twitter'),
    ]),
];
@endphp

<script type="application/ld+json">
{!! json_encode($structuredData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}
</script>
