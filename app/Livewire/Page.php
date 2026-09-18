<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Page as PageModel;
use App\Models\SeoSetting;
use Illuminate\Support\Str;

class Page extends Component
{
    public $page;
    public $seoData = [];

    public function mount($slug)
    {
        $this->page = PageModel::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // ============================================================
        // SEO DATA FOR STATIC PAGE
        // ============================================================
        $settings = SeoSetting::forPage($slug);

        $this->seoData = [
            'title' => $this->page->meta_title ?? $this->page->title . ' · VELENZA',
            'description' => $this->page->meta_description ?? Str::limit(strip_tags($this->page->content), 160),
            'og_title' => $this->page->meta_title ?? $this->page->title . ' · VELENZA',
            'og_description' => $this->page->meta_description ?? Str::limit(strip_tags($this->page->content), 160),
            'canonical' => route('page.show', $this->page->slug),
            'settings' => $settings,
            'schema_type' => 'article',
            'article' => [
                'title' => $this->page->title,
                'description' => Str::limit(strip_tags($this->page->content), 160),
                'published_at' => $this->page->created_at->toDateString(),
                'updated_at' => $this->page->updated_at->toDateString(),
                'url' => route('page.show', $this->page->slug),
            ],
            'breadcrumb' => [
                ['name' => 'Home', 'url' => route('home')],
                ['name' => $this->page->title, 'url' => route('page.show', $this->page->slug)],
            ],
        ];
    }

    public function render()
    {
        return view('livewire.page', [
            'seoData' => $this->seoData,
        ])->layout('components.layouts.app');
    }
}
