<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($products as $product)
    <url>
        <loc>{{ $baseUrl }}/product/{{ $product->slug }}</loc>
        <lastmod>{{ $product->updated_at->toW3CString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    @endforeach
</urlset>