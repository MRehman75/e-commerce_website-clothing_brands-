<?php

namespace App\Livewire\WebsiteContent;

use App\Models\HomeSlider as HomeSliderModel;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class HomeSlider extends Component
{
    use WithFileUploads;

    // Form fields
    public $title, $subtitle, $button_text, $button_link;
    public $badge_color = 'primary';
    public $sort_order  = 0;
    public $is_active   = true;
    public $image;
    public $existingImage = '';

    // State
    public $editingId          = null;
    public $showModal          = false;
    public $confirmingDeleteId = null;

    protected function rules()
    {
        return [
            'title'        => 'nullable|string|max:200',
            'subtitle'     => 'nullable|string|max:300',
            'button_text'  => 'nullable|string|max:100',
            'button_link'  => 'nullable|string|max:255',
            'badge_color'  => 'required|in:primary,success,danger,warning,info',
            'sort_order'   => 'integer|min:0',
            'is_active'    => 'boolean',
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
        $slide = HomeSliderModel::findOrFail($id);
        $this->editingId     = $slide->id;
        $this->title         = $slide->title;
        $this->subtitle      = $slide->subtitle;
        $this->button_text   = $slide->button_text;
        $this->button_link   = $slide->button_link;
        $this->badge_color   = $slide->badge_color;
        $this->sort_order    = $slide->sort_order;
        $this->is_active     = $slide->is_active;
        $this->existingImage = $slide->image;
        $this->showModal     = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title'       => $this->title,
            'subtitle'    => $this->subtitle,
            'button_text' => $this->button_text,
            'button_link' => $this->button_link,
            'badge_color' => $this->badge_color,
            'sort_order'  => $this->sort_order,
            'is_active'   => $this->is_active,
        ];

        if ($this->image) {
            // Delete old image on edit
            if ($this->existingImage) {
                Storage::disk('public')->delete($this->existingImage);
            }
            $data['image'] = $this->image->store('sliders', 'public');
        } else {
            $data['image'] = $this->existingImage;
        }

        $wasEditing = $this->editingId;
        HomeSliderModel::updateOrCreate(['id' => $this->editingId], $data);

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', $wasEditing ? 'Slide updated.' : 'Slide added.');
    }

    public function toggleActive($id)
    {
        $slide = HomeSliderModel::findOrFail($id);
        $slide->update(['is_active' => !$slide->is_active]);
    }

    public function moveUp($id)
    {
        $slide = HomeSliderModel::findOrFail($id);
        $prev  = HomeSliderModel::where('sort_order', '<', $slide->sort_order)
                    ->orderBy('sort_order', 'desc')->first();
        if ($prev) {
            [$slide->sort_order, $prev->sort_order] = [$prev->sort_order, $slide->sort_order];
            $slide->save();
            $prev->save();
        }
    }

    public function moveDown($id)
    {
        $slide = HomeSliderModel::findOrFail($id);
        $next  = HomeSliderModel::where('sort_order', '>', $slide->sort_order)
                    ->orderBy('sort_order')->first();
        if ($next) {
            [$slide->sort_order, $next->sort_order] = [$next->sort_order, $slide->sort_order];
            $slide->save();
            $next->save();
        }
    }

    public function confirmDelete($id) { $this->confirmingDeleteId = $id; }

    public function delete()
    {
        $slide = HomeSliderModel::findOrFail($this->confirmingDeleteId);
        if ($slide->image) {
            Storage::disk('public')->delete($slide->image);
        }
        $slide->delete();
        $this->confirmingDeleteId = null;
        session()->flash('success', 'Slide deleted.');
    }

    private function resetForm()
    {
        $this->editingId = null;
        $this->title = $this->subtitle = $this->button_text = $this->button_link = '';
        $this->badge_color   = 'primary';
        $this->sort_order    = 0;
        $this->is_active     = true;
        $this->image         = null;
        $this->existingImage = '';
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.website-content.home-slider', [
            'sliders' => HomeSliderModel::orderBy('sort_order')->get(),
        ])->layout('layouts.admin');
    }
}