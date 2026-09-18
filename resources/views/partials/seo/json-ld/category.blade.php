@php
$categoryData = $category ?? $seoData['category'] ?? null;

if (!$categoryData) {
return;
}

$categorySchema = [
'@context' => 'https://schema.org',
'@type' => 'CollectionPage',
'name' => $categoryData['name'] ?? '',
'description' => $categoryData['description'] ?? '',
'url' => $categoryData['url'] ?? url()->current(),
'about' => [
'@type' => 'Thing',
'name' => $categoryData['name'] ?? '',
],
];

// Add breadcrumb if available
if (!empty($categoryData['breadcrumb'])) {
$categorySchema['breadcrumb'] = [
'@type' => 'BreadcrumbList',
'itemListElement' => $categoryData['breadcrumb'],
];
}
@endphp

@if($categoryData)
<script type="application/ld+json">
    {
        !!json_encode($categorySchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!
    }
</script>
@endif