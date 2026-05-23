<?php
namespace App\Livewire\WebsiteContent;

use App\Models\SeoSetting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class SeoSettings extends Component
{
    use WithFileUploads;

    public $activePage = 'home';

    // Fields
    public $meta_title, $meta_description, $meta_keywords;
    public $og_title, $og_description;
    public $og_image, $existingOgImage = '';
    public $canonical_url;
    public $no_index  = false;
    public $no_follow = false;
    public $custom_scripts;

    public function mount()
    {
        $this->loadPage($this->activePage);
    }

    public function loadPage($page)
    {
        $this->activePage = $page;
        $s = SeoSetting::forPage($page);

        $this->meta_title        = $s->meta_title;
        $this->meta_description  = $s->meta_description;
        $this->meta_keywords     = $s->meta_keywords;
        $this->og_title          = $s->og_title;
        $this->og_description    = $s->og_description;
        $this->existingOgImage   = $s->og_image ?? '';
        $this->canonical_url     = $s->canonical_url;
        $this->no_index          = $s->no_index;
        $this->no_follow         = $s->no_follow;
        $this->custom_scripts    = $s->custom_scripts;
        $this->og_image          = null;
        $this->resetErrorBag();
    }

    public function save()
    {
       $this->validate([
    'meta_title'       => 'nullable|string|max:200',
    'meta_description' => 'nullable|string|max:300',
    'meta_keywords'    => 'nullable|string|max:200',
    'og_title'         => 'nullable|string|max:200',
    'og_description'   => 'nullable|string|max:300',
    'og_image'         => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
    'canonical_url'    => 'nullable|string|max:300',
    'no_index'         => 'boolean',
    'no_follow'        => 'boolean',
    'custom_scripts'   => 'nullable|string',
]);

$data = [
    'meta_title'       => $this->meta_title ?: null,
    'meta_description' => $this->meta_description ?: null,
    'meta_keywords'    => $this->meta_keywords ?: null,
    'og_title'         => $this->og_title ?: null,
    'og_description'   => $this->og_description ?: null,
    'canonical_url'    => $this->canonical_url ?: null,
    'no_index'         => $this->no_index,
    'no_follow'        => $this->no_follow,
    'custom_scripts'   => $this->custom_scripts ?: null,
];

        if ($this->og_image) {
            if ($this->existingOgImage) {
                Storage::disk('public')->delete($this->existingOgImage);
            }
            $data['og_image']      = $this->og_image->store('seo', 'public');
            $this->existingOgImage = $data['og_image'];
            $this->og_image        = null;
        } else {
            $data['og_image'] = $this->existingOgImage;
        }



        // SeoSetting::forPage($this->activePage)->update($data);
  SeoSetting::updateOrCreate(
    ['page' => $this->activePage],
    $data
);

$this->loadPage($this->activePage);

session()->flash('success', 'SEO settings saved for ' . SeoSetting::pages()[$this->activePage] . '!');
    }

    public function render()
    {
        return view('livewire.website-content.seo-settings', [
            'pages' => SeoSetting::pages(),
        ])->layout('layouts.admin');
    }
}