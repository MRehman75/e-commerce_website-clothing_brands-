<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\HomeSlider;
use App\Models\Product;
use App\Models\SeoSetting;

class Welcome extends Component
{
    public $seoData = [];

    public function mount()
    {
        // Load homepage SEO settings
        $settings = SeoSetting::forPage('home');

        $this->seoData = [
            'title' => $settings->meta_title ?? 'VELENZA · Luxury Pakistani Fashion',
            'description' => $settings->meta_description ?? 'Discover timeless luxury fashion at VELENZA. Shop premium embroidered suits, contemporary clothing, and accessories for men and women.',
            'og_title' => $settings->og_title ?? 'VELENZA · Luxury Fashion',
            'og_description' => $settings->og_description ?? 'Shop premium Pakistani fashion at VELENZA.',
            'og_image' => $settings->og_image ?? asset('velenza_logo.png'),
            'canonical' => route('home'),
            'settings' => $settings,
            'schema_type' => 'website',
        ];
    }

    public function render()
    {
        // Active sliders
        $sliders = HomeSlider::where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        // Featured products
        $featuredProducts = Product::with('category')
            ->where(function ($query) {
                $query->where('status', 1)
                    ->orWhere('status', 'active');
            })
            ->where('featured', 1) // Only featured products
            ->latest()
            ->take(4)
            ->get();

        // Fallback if no featured products exist
        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::with('category')
                ->where(function ($query) {
                    $query->where('status', 1)
                        ->orWhere('status', 'active');
                })
                ->latest()
                ->take(4)
                ->get();
        }

        return view('livewire.welcome', [
            'sliders' => $sliders,
            'featuredProducts' => $featuredProducts,
            'seoData' => $this->seoData,
        ])->layout('components.layouts.app');
    }
}
