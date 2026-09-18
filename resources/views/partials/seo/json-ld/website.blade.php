@php
$website = [
'@context' => 'https://schema.org',
'@type' => 'WebSite',
'name' => 'VELENZA · Luxury Pakistani Fashion',
'url' => 'https://velenza.pk',
'description' => 'Discover timeless luxury fashion at VELENZA. Shop premium embroidered suits, contemporary clothing, and accessories for men and women. Free shipping across Pakistan.',
'potentialAction' => [
'@type' => 'SearchAction',
'target' => 'https://velenza.pk/products?search={search_term_string}',
'query-input' => 'required name=search_term_string',
],
];
@endphp

<script type="application/ld+json">
    {
        !!json_encode($website, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!
    }
</script>