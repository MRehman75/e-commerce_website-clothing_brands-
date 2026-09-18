@php
$organization = [
'@context' => 'https://schema.org',
'@type' => 'Organization',
'name' => 'VELENZA',
'url' => 'https://velenza.pk',
'logo' => asset('velenza_logo.png'),
'description' => 'Discover timeless luxury fashion at VELENZA. Shop premium embroidered suits, contemporary clothing, and accessories for men and women.',
'address' => [
'@type' => 'PostalAddress',
'addressCountry' => 'PK',
'addressLocality' => 'Lahore',
'addressRegion' => 'Punjab',
],
'contactPoint' => [
'@type' => 'ContactPoint',
'contactType' => 'customer service',
'email' => 'support@velenza.pk',
],
'sameAs' => [
'https://www.instagram.com/velenza',
'https://www.facebook.com/velenza',
'https://www.pinterest.com/velenza',
],
];
@endphp

<script type="application/ld+json">
    {
        !!json_encode($organization, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!
    }
</script>