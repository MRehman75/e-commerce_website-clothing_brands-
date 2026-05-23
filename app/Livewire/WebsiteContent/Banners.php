<?php

namespace App\Livewire\WebsiteContent;

use App\Models\Banner;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Banners extends Component
{
    use WithFileUploads;

    // Form fields
    public $title, $subtitle, $link;
    public $open_in_new_tab = false;
    public $position        = 'homepage_top';
    public $starts_at       = '';
    public $ends_at         = '';
    public $sort_order      = 0;
    public $is_active       = true;
    public $image;
    public $existingImage   = '';

    // State
    public $editingId          = null;
    public $showModal          = false;
    public $confirmingDeleteId = null;

    // Filters
    public $filterPosition = '';
    public $filterStatus   = '';

    protected function rules()
    {
        return [
            'title'           => 'nullable|string|max:200',
            'subtitle'        => 'nullable|string|max:300',
            'link'            => 'nullable|string|max:500',
            'open_in_new_tab' => 'boolean',
            'position'        => 'required|in:' . implode(',', array_keys(Banner::positions())),
            'starts_at'       => 'nullable|date',
            'ends_at'         => 'nullable|date|after_or_equal:starts_at',
            'sort_order'      => 'integer|min:0',
            'is_active'       => 'boolean',
            'image' => ($this->editingId ? 'nullable' : 'required') . '|mimes:jpg,jpeg,png,webp,gif,svg|max:3048',
           
        ];
    }

    public function openCreate()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEdit($id)
    {
        $banner = Banner::findOrFail($id);
        $this->editingId       = $banner->id;
        $this->title           = $banner->title;
        $this->subtitle        = $banner->subtitle;
        $this->link            = $banner->link;
        $this->open_in_new_tab = $banner->open_in_new_tab;
        $this->position        = $banner->position;
        $this->starts_at       = $banner->starts_at?->format('Y-m-d') ?? '';
        $this->ends_at         = $banner->ends_at?->format('Y-m-d') ?? '';
        $this->sort_order      = $banner->sort_order;
        $this->is_active       = $banner->is_active;
        $this->existingImage   = $banner->image;
        $this->showModal       = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title'           => $this->title,
            'subtitle'        => $this->subtitle,
            'link'            => $this->link,
            'open_in_new_tab' => $this->open_in_new_tab,
            'position'        => $this->position,
            'starts_at'       => $this->starts_at ?: null,
            'ends_at'         => $this->ends_at   ?: null,
            'sort_order'      => $this->sort_order,
            'is_active'       => $this->is_active,
        ];

        if ($this->image) {
            if ($this->existingImage) {
                Storage::disk('public')->delete($this->existingImage);
            }
            $data['image'] = $this->image->store('banners', 'public');
        } else {
            $data['image'] = $this->existingImage;
        }

        $wasEditing = $this->editingId;
        Banner::updateOrCreate(['id' => $this->editingId], $data);

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', $wasEditing ? 'Banner updated.' : 'Banner added.');
    }

    public function toggleActive($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update(['is_active' => !$banner->is_active]);
    }

    public function moveUp($id)
    {
        $banner = Banner::findOrFail($id);
        $prev = Banner::where('position', $banner->position)
                    ->where('sort_order', '<', $banner->sort_order)
                    ->orderBy('sort_order', 'desc')->first();
        if ($prev) {
            [$banner->sort_order, $prev->sort_order] = [$prev->sort_order, $banner->sort_order];
            $banner->save(); $prev->save();
        }
    }

    public function moveDown($id)
    {
        $banner = Banner::findOrFail($id);
        $next = Banner::where('position', $banner->position)
                    ->where('sort_order', '>', $banner->sort_order)
                    ->orderBy('sort_order')->first();
        if ($next) {
            [$banner->sort_order, $next->sort_order] = [$next->sort_order, $banner->sort_order];
            $banner->save(); $next->save();
        }
    }

    public function confirmDelete($id) { $this->confirmingDeleteId = $id; }

    public function delete()
    {
        $banner = Banner::findOrFail($this->confirmingDeleteId);
        if ($banner->image) Storage::disk('public')->delete($banner->image);
        $banner->delete();
        $this->confirmingDeleteId = null;
        session()->flash('success', 'Banner deleted.');
    }

    private function resetForm()
    {
        $this->editingId = null;
        $this->title = $this->subtitle = $this->link = '';
        $this->open_in_new_tab = false;
        $this->position   = 'homepage_top';
        $this->starts_at  = $this->ends_at = '';
        $this->sort_order = 0;
        $this->is_active  = true;
        $this->image      = null;
        $this->existingImage = '';
        $this->resetErrorBag();
    }

    public function render()
    {
        // Group banners by position
        $banners = Banner::query()
            ->when($this->filterPosition, fn($q) =>
                $q->where('position', $this->filterPosition)
            )
            ->when($this->filterStatus === 'active',   fn($q) => $q->where('is_active', true))
            ->when($this->filterStatus === 'inactive', fn($q) => $q->where('is_active', false))
            ->orderBy('position')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('position');

        return view('livewire.website-content.banners', [
            'banners'   => $banners,
            'positions' => Banner::positions(),
        ])->layout('layouts.admin');
    }
}