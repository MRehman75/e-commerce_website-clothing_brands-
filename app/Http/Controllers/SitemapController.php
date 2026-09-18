<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    /**
     * Generate the main sitemap index
     */
    public function index()
    {
        $sitemaps = [
            [
                'loc' => route('sitemap.products'),
                'lastmod' => now()->toW3CString(),
            ],
            [
                'loc' => route('sitemap.categories'),
                'lastmod' => now()->toW3CString(),
            ],
            [
                'loc' => route('sitemap.pages'),
                'lastmod' => now()->toW3CString(),
            ],
        ];

        return response()->view('sitemap.index', [
            'sitemaps' => $sitemaps,
        ])->header('Content-Type', 'application/xml');
    }

    /**
     * Generate products sitemap
     */
    public function products()
    {
        $products = Cache::remember('sitemap_products', 86400, function () {
            return Product::where('status', 'active')
                ->select('id', 'slug', 'updated_at')
                ->get();
        });

        return response()->view('sitemap.products', [
            'products' => $products,
            'baseUrl' => 'https://velenza.pk',
        ])->header('Content-Type', 'application/xml');
    }

    /**
     * Generate categories sitemap
     */
    public function categories()
    {
        $categories = Cache::remember('sitemap_categories', 86400, function () {
            return Category::where('status', 1)
                ->select('id', 'slug', 'updated_at')
                ->get();
        });

        return response()->view('sitemap.categories', [
            'categories' => $categories,
            'baseUrl' => 'https://velenza.pk',
        ])->header('Content-Type', 'application/xml');
    }

    /**
     * Generate pages sitemap
     */
    public function pages()
    {
        $pages = Cache::remember('sitemap_pages', 86400, function () {
            return Page::where('is_active', true)
                ->select('id', 'slug', 'updated_at')
                ->get();
        });

        // Static pages
        $staticPages = [
            ['loc' => '/', 'lastmod' => now()->toW3CString(), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['loc' => '/about', 'lastmod' => now()->toW3CString(), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => '/contact', 'lastmod' => now()->toW3CString(), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => '/privacy', 'lastmod' => now()->toW3CString(), 'priority' => '0.5', 'changefreq' => 'yearly'],
            ['loc' => '/terms', 'lastmod' => now()->toW3CString(), 'priority' => '0.5', 'changefreq' => 'yearly'],
        ];

        return response()->view('sitemap.pages', [
            'pages' => $pages,
            'staticPages' => $staticPages,
            'baseUrl' => 'https://velenza.pk',
        ])->header('Content-Type', 'application/xml');
    }

    /**
     * Generate sitemap for a specific page type
     */
    public function all()
    {
        return response()->view('sitemap.all', [
            'baseUrl' => 'https://velenza.pk',
        ])->header('Content-Type', 'application/xml');
    }

    /**
     * Clear sitemap cache (for admin use)
     */
    public function clearCache()
    {
        Cache::forget('sitemap_products');
        Cache::forget('sitemap_categories');
        Cache::forget('sitemap_pages');

        return response()->json(['message' => 'Sitemap cache cleared successfully!']);
    }
}
