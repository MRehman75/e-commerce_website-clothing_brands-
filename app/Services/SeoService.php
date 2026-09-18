<?php

namespace App\Services;

use App\Models\SeoSetting;
use Illuminate\Support\Str;

class SeoService
{
    protected $siteName = 'VELENZA';
    protected $siteUrl = 'https://velenza.pk';
    protected $defaultDescription = 'Discover timeless luxury fashion at VELENZA. Shop premium embroidered suits, contemporary clothing, and accessories for men and women.';

    /**
     * Get SEO settings for a specific page
     */
    public function getPageSettings(string $page): SeoSetting
    {
        return SeoSetting::forPage($page);
    }

    /**
     * Generate page title with site name suffix
     */
    public function title(?string $title = null, bool $appendSiteName = true): string
    {
        if (empty($title)) {
            return $this->siteName . ' · Luxury Pakistani Fashion';
        }

        return $appendSiteName ? $title . ' · ' . $this->siteName : $title;
    }

    /**
     * Generate meta description with fallback
     */
    public function description(?string $description = null, int $length = 160): string
    {
        if (!empty($description)) {
            return Str::limit(strip_tags($description), $length);
        }

        return $this->defaultDescription;
    }

    /**
     * Get canonical URL
     */
    public function canonical(?string $url = null): string
    {
        if ($url) {
            return $url;
        }

        return url()->current();
    }

    /**
     * Get robots meta tag
     */
    public function robots(bool $noIndex = false, bool $noFollow = false): string
    {
        $tags = [];
        
        if ($noIndex) {
            $tags[] = 'noindex';
        } else {
            $tags[] = 'index';
        }
        
        if ($noFollow) {
            $tags[] = 'nofollow';
        } else {
            $tags[] = 'follow';
        }
        
        return implode(', ', $tags);
    }

    /**
     * Get Open Graph data
     */
    public function og(?string $title = null, ?string $description = null, ?string $image = null, string $type = 'website'): array
    {
        return [
            'title' => $this->title($title, false),
            'description' => $this->description($description),
            'image' => $image ? asset($image) : null,
            'type' => $type,
            'url' => $this->canonical(),
            'site_name' => $this->siteName,
        ];
    }

    /**
     * Get Twitter Card data
     */
    public function twitter(?string $title = null, ?string $description = null, ?string $image = null, string $card = 'summary_large_image'): array
    {
        return [
            'card' => $card,
            'title' => $this->title($title, false),
            'description' => $this->description($description),
            'image' => $image ? asset($image) : null,
        ];
    }

    /**
     * Get site name
     */
    public function siteName(): string
    {
        return $this->siteName;
    }

    /**
     * Get site URL
     */
    public function siteUrl(): string
    {
        return $this->siteUrl;
    }

    /**
     * Get default description
     */
    public function defaultDescription(): string
    {
        return $this->defaultDescription;
    }
}