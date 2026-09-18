<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Homepage --}}
    <url>
        <loc>{{ $baseUrl }}</loc>
        <lastmod>{{ now()->toW3CString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    {{-- Products --}}
    @foreach(\App\Models\Product::where('status', 'active')->get() as $product)
    <url>
        <loc>{{ $baseUrl }}/product/{{ $product->slug }}</loc>
        <lastmod>{{ $product->updated_at->toW3CString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    @endforeach

    {{-- Categories --}}
    @foreach(\App\Models\Category::where('status', 1)->get() as $category)
    <url>
        <loc>{{ $baseUrl }}/category/{{ $category->slug }}</loc>
        <lastmod>{{ $category->updated_at->toW3CString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    {{-- Pages --}}
    @foreach(\App\Models\Page::where('is_active', true)->get() as $page)
    <url>
        <loc>{{ $baseUrl }}/page/{{ $page->slug }}</loc>
        <lastmod>{{ $page->updated_at->toW3CString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach

    {{-- Static Pages --}}
    <url>
        <loc>{{ $baseUrl }}/about</loc>
        <lastmod>{{ now()->toW3CString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ $baseUrl }}/contact</loc>
        <lastmod>{{ now()->toW3CString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
</urlset>