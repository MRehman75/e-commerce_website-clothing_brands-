<?php

use App\Services\SeoService;

if (!function_exists('seo')) {
    function seo(): SeoService
    {
        return app(SeoService::class);
    }
}