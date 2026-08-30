@php
$structuredData = [
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => 'Chada Digital',
    'url' => url('/'),
    'logo' => asset('images/chada-logo-horizontal-dark.png'),
    'description' => 'Digital solutions that help businesses grow. Web development, funnel automation, paid advertising, and brand strategy for startups, SMEs, and enterprises.',
    'address' => [
        '@type' => 'PostalAddress',
        'addressLocality' => 'Lagos',
        'addressCountry' => 'NG',
    ],
    'contactPoint' => [
        '@type' => 'ContactPoint',
        'contactType' => 'customer service',
        'email' => 'hello@chadadigital.com',
        'availableLanguage' => ['English'],
    ],
    'sameAs' => [
        // Add social URLs when available
    ],
];
@endphp

<script type="application/ld+json">
{!! json_encode($structuredData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}
</script>
