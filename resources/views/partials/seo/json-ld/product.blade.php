@php
$productData = $product ?? $seoData['product'] ?? null;

if (!$productData) {
return;
}

$productSchema = [
'@context' => 'https://schema.org',
'@type' => 'Product',
'name' => $productData['name'] ?? '',
'description' => $productData['description'] ?? '',
'image' => $productData['image'] ?? null,
'sku' => $productData['sku'] ?? null,
'brand' => [
'@type' => 'Brand',
'name' => $productData['brand'] ?? 'VELENZA',
],
'category' => $productData['category'] ?? '',
'offers' => [
'@type' => 'Offer',
'url' => $productData['url'] ?? url()->current(),
'price' => $productData['price'] ?? 0,
'priceCurrency' => 'PKR',
'availability' => ($productData['stock'] ?? 0) > 0
? 'https://schema.org/InStock'
: 'https://schema.org/OutOfStock',
'priceValidUntil' => date('Y-m-d', strtotime('+30 days')),
],
];

// Add aggregate rating if reviews exist
if (!empty($productData['rating']) && !empty($productData['review_count'])) {
$productSchema['aggregateRating'] = [
'@type' => 'AggregateRating',
'ratingValue' => $productData['rating'],
'reviewCount' => $productData['review_count'],
];
}
@endphp

@if($productData)
<script type="application/ld+json">
    {
        !!json_encode($productSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!
    }
</script>
@endif