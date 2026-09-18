{{-- ============================================================
    SEO HEAD - Dynamic Meta Tags
    ============================================================ --}}

@php
$seo = seo();
$seoData = $seoData ?? [];
$pageSettings = $seoData['settings'] ?? null;

// Get title with priority: seoData > pageSettings > fallback
$title = $seoData['title'] ?? ($pageSettings->meta_title ?? null);
$description = $seoData['description'] ?? ($pageSettings->meta_description ?? null);
$ogImage = $seoData['og_image'] ?? ($pageSettings->og_image ?? null);
$canonicalUrl = $seoData['canonical'] ?? ($pageSettings->canonical_url ?? null);

$pageTitle = $seo->title($title);
$pageDescription = $seo->description($description);
$robots = $seo->robots(
$pageSettings->no_index ?? false,
$pageSettings->no_follow ?? false
);
@endphp

{{-- Title --}}
<title>{{ $pageTitle }}</title>

{{-- Meta Description --}}
@if($pageDescription)
<meta name="description" content="{{ $pageDescription }}" />
@endif

{{-- Meta Keywords --}}
@if(!empty($pageSettings->meta_keywords))
<meta name="keywords" content="{{ $pageSettings->meta_keywords }}" />
@endif

{{-- Canonical URL --}}
<link rel="canonical" href="{{ $seo->canonical($canonicalUrl) }}" />

{{-- Robots --}}
<meta name="robots" content="{{ $robots }}" />

{{-- Viewport --}}
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

{{-- Language --}}
<meta http-equiv="Content-Language" content="en" />

{{-- Author --}}
<meta name="author" content="Asad Mukhtar (Senior Developer) & Muhammad Rehman (Junior Developer)" />

{{-- Designer / Developer --}}
<meta name="designer" content="webEducatorz" />

{{-- Copyright --}}
<meta name="copyright" content="VELENZA - All Rights Reserved" />

{{-- Generator --}}
<meta name="generator" content="Laravel 12 - webEducatorz" />

{{-- ============================================================
    OPEN GRAPH (Facebook, LinkedIn)
    ============================================================ --}}
@php
$ogTitle = $seoData['og_title'] ?? ($pageSettings->og_title ?? $title);
$ogDesc = $seoData['og_description'] ?? ($pageSettings->og_description ?? $description);
$og = $seo->og(
$ogTitle,
$ogDesc,
$ogImage ?? $seoData['og_image'] ?? null,
$seoData['og_type'] ?? 'website'
);
@endphp

<meta property="og:title" content="{{ $og['title'] }}" />
<meta property="og:description" content="{{ $og['description'] }}" />
<meta property="og:url" content="{{ $og['url'] }}" />
<meta property="og:site_name" content="{{ $og['site_name'] }}" />
<meta property="og:type" content="{{ $og['type'] }}" />
@if($og['image'])
<meta property="og:image" content="{{ $og['image'] }}" />
@endif

{{-- ============================================================
    TWITTER CARD
    ============================================================ --}}
@php
$twitterTitle = $seoData['twitter_title'] ?? ($pageSettings->og_title ?? $title);
$twitterDesc = $seoData['twitter_description'] ?? ($pageSettings->og_description ?? $description);
$twitter = $seo->twitter(
$twitterTitle,
$twitterDesc,
$ogImage ?? $seoData['og_image'] ?? null,
$seoData['twitter_card'] ?? 'summary_large_image'
);
@endphp

<meta name="twitter:card" content="{{ $twitter['card'] }}" />
<meta name="twitter:title" content="{{ $twitter['title'] }}" />
<meta name="twitter:description" content="{{ $twitter['description'] }}" />
@if($twitter['image'])
<meta name="twitter:image" content="{{ $twitter['image'] }}" />
@endif

{{-- ============================================================
    ADDITIONAL META TAGS
    ============================================================ --}}

{{-- Theme Color --}}
<meta name="theme-color" content="#0a0a0a" />

{{-- Favicon --}}
<link rel="icon" type="image/png" href="{{ asset('velenza_logo.png') }}" />
<link rel="apple-touch-icon" href="{{ asset('velenza_logo.png') }}" />

{{-- Custom Scripts (Analytics, etc.) --}}
@if(!empty($pageSettings->custom_scripts))
{!! $pageSettings->custom_scripts !!}
@endif

{{-- Extra meta tags from seoData --}}
@if(!empty($seoData['extra_meta']))
{!! $seoData['extra_meta'] !!}
@endif

{{-- ============================================================
    JSON-LD SCHEMA
    ============================================================ --}}

{{-- Organization Schema (Always present) --}}
@include('partials.seo.json-ld.organization')

{{-- Website Schema (Always present) --}}
@include('partials.seo.json-ld.website')

{{-- Breadcrumb Schema (if available) --}}
@if(!empty($seoData['breadcrumb']))
@include('partials.seo.json-ld.breadcrumb')
@endif

{{-- Product Schema (if product data exists) --}}
@if(!empty($seoData['product']))
@include('partials.seo.json-ld.product')
@endif

{{-- Category Schema (if category data exists) --}}
@if(!empty($seoData['category']))
@include('partials.seo.json-ld.category')
@endif

{{-- Article Schema (if article data exists) --}}
@if(!empty($seoData['article']))
@include('partials.seo.json-ld.article')
@endif

{{-- Extra JSON-LD from seoData --}}
@if(!empty($seoData['extra_json_ld']))
{!! $seoData['extra_json_ld'] !!}
@endif