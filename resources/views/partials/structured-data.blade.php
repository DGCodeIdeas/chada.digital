@php
$structuredData = [
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => config('placeholders.brand.name'),
    'url' => url('/'),
    'logo' => asset('images/chada-logo-horizontal-dark.png'),
    'description' => config('placeholders.brand.tagline'),
    'address' => [
        '@type' => 'PostalAddress',
        'addressLocality' => config('placeholders.contact.location'),
        'addressCountry' => 'NG',
    ],
    'contactPoint' => [
        '@type' => 'ContactPoint',
        'contactType' => 'customer service',
        'email' => config('placeholders.contact.email'),
        'telephone' => config('placeholders.contact.phone'),
        'availableLanguage' => ['English'],
    ],
    'sameAs' => array_filter([
        config('placeholders.social.linkedin'),
        config('placeholders.social.instagram'),
        config('placeholders.social.twitter'),
    ]),
];
@endphp

<script type="application/ld+json">
{!! json_encode($structuredData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}
</script>
