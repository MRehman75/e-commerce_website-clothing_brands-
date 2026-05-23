<?php

namespace App\Livewire\Products;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class AllProducts extends Component
{
    use WithPagination;

    public $search = '';
    public $filterCategory = '';
    public $filterBrand = '';
    public $filterStatus = '';
    public $confirmingDeleteId = null;

    public function updatingSearch()         { $this->resetPage(); }
    public function updatingFilterCategory() { $this->resetPage(); }
    public function updatingFilterBrand()    { $this->resetPage(); }
    public function updatingFilterStatus()   { $this->resetPage(); }

    public function toggleFeatured($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['featured' => !$product->featured]);
    }

    public function toggleStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['status' => $product->status === 'active' ? 'inactive' : 'active']);
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    public function delete()
    {
        Product::findOrFail($this->confirmingDeleteId)->delete();
        $this->confirmingDeleteId = null;
        session()->flash('success', 'Product deleted.');
    }

    public function render()
    {
        return view('livewire.products.all-products', [
            'products' => Product::with(['category', 'brand'])
                ->when($this->search, fn($q) => $q
                    ->where('name', 'like', "%{$this->search}%")
                    ->orWhere('sku', 'like', "%{$this->search}%"))
                ->when($this->filterCategory, fn($q) => $q->where('category_id', $this->filterCategory))
                ->when($this->filterBrand,    fn($q) => $q->where('brand_id', $this->filterBrand))
                ->when($this->filterStatus,   fn($q) => $q->where('status', $this->filterStatus))
                ->latest()
                ->paginate(12),
            'categories' => Category::orderBy('name')->get(),
            'brands'     => Brand::orderBy('name')->get(),
        ])->layout('layouts.admin');
    }
}