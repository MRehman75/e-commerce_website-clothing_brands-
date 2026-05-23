<?php
namespace App\Livewire\Products;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Brands extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $showModal = false;
    public $editingId = null;
    public $confirmingDeleteId = null;

    public $name = '';
    public $slug = '';
    public $description = '';
    public $status = 'active';
    public $logo;
    public $existingLogo = '';

    protected $rules = [
        'name'        => 'required|string|max:100',
        'slug'        => 'required|string|max:100',
        'description' => 'nullable|string',
        'status'      => 'required|in:active,inactive',
        'logo'        => 'nullable|image|max:1024',
    ];

    public function updatingSearch() { $this->resetPage(); }

    public function updatedName($value)
    {
        if (!$this->editingId) {
            $this->slug = Str::slug($value);
        }
    }

    public function openCreate()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->dispatch('brandModalOpened', content: ''); // ← Added
    }

    public function openEdit($id)
    {
        $brand = Brand::findOrFail($id);
        $this->editingId     = $brand->id;
        $this->name          = $brand->name;
        $this->slug          = $brand->slug;
        $this->description   = $brand->description ?? '';
        $this->status        = $brand->status;
        $this->existingLogo  = $brand->logo ?? '';
        $this->showModal     = true;
        $this->dispatch('brandModalOpened', content: $brand->description ?? ''); // ← Added
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name'        => $this->name,
            'slug'        => $this->slug,
            'description' => $this->description,
            'status'      => $this->status,
        ];

        if ($this->logo) {
            $data['logo'] = $this->logo->store('brands', 'public');
        } else {
            $data['logo'] = $this->existingLogo;
        }

        Brand::updateOrCreate(['id' => $this->editingId], $data);
        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', $this->editingId ? 'Brand updated.' : 'Brand created.');
    }

    public function confirmDelete($id) { $this->confirmingDeleteId = $id; }

    public function delete()
    {
        Brand::findOrFail($this->confirmingDeleteId)->delete();
        $this->confirmingDeleteId = null;
        session()->flash('success', 'Brand deleted.');
    }

    private function resetForm()
    {
        $this->editingId = null;
        $this->name = $this->slug = $this->description = $this->existingLogo = '';
        $this->status = 'active';
        $this->logo = null;
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.products.brands', [
            'brands' => Brand::withCount('products')
                ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
                ->latest()
                ->paginate(15),
        ])->layout('layouts.admin');
    }
}