@php
$articleData = $article ?? $seoData['article'] ?? null;

if (!$articleData) {
return;
}

$articleSchema = [
'@context' => 'https://schema.org',
'@type' => 'Article',
'headline' => $articleData['title'] ?? '',
'description' => $articleData['description'] ?? '',
'image' => $articleData['image'] ?? null,
'author' => [
'@type' => 'Person',
'name' => $articleData['author'] ?? 'VELENZA',
],
'datePublished' => $articleData['published_at'] ?? date('Y-m-d'),
'dateModified' => $articleData['updated_at'] ?? date('Y-m-d'),
'publisher' => [
'@type' => 'Organization',
'name' => 'VELENZA',
'logo' => [
'@type' => 'ImageObject',
'url' => asset('velenza_logo.png'),
],
],
'mainEntityOfPage' => [
'@type' => 'WebPage',
'@id' => $articleData['url'] ?? url()->current(),
],
];
@endphp

@if($articleData)
<script type="application/ld+json">
    {
        !!json_encode($articleSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!
    }
</script>
@endif