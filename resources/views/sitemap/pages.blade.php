<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Static Pages --}}
    @foreach($staticPages as $page)
    <url>
        <loc>{{ $baseUrl }}{{ $page['loc'] }}</loc>
        <lastmod>{{ $page['lastmod'] }}</lastmod>
        <changefreq>{{ $page['changefreq'] }}</changefreq>
        <priority>{{ $page['priority'] }}</priority>
    </url>
    @endforeach

    {{-- Dynamic Pages --}}
    @foreach($pages as $page)
    <url>
        <loc>{{ $baseUrl }}/page/{{ $page->slug }}</loc>
        <lastmod>{{ $page->updated_at->toW3CString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach
</urlset>