<?php

namespace App\Livewire\Products;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Inventory extends Component
{
    use WithPagination;

    public $search = '';
    public $filterCategory = '';
    public $filterStock = ''; // low, out, in
    public $editingId = null;
    public $editStock = 0;
    public $showModal = false;

    public function updatingSearch()         { $this->resetPage(); }
    public function updatingFilterCategory() { $this->resetPage(); }
    public function updatingFilterStock()    { $this->resetPage(); }

    public function openStockEdit($id)
    {
        $product = Product::findOrFail($id);
        $this->editingId  = $id;
        $this->editStock  = $product->stock;
        $this->showModal  = true;
    }

    public function updateStock()
    {
        $this->validate(['editStock' => 'required|integer|min:0']);
        Product::findOrFail($this->editingId)->update(['stock' => $this->editStock]);
        $this->showModal = false;
        $this->editingId = null;
        session()->flash('success', 'Stock updated.');
    }

    public function render()
    {
        $query = Product::with('category')
            ->when($this->search, fn($q) => $q
                ->where('name', 'like', "%{$this->search}%")
                ->orWhere('sku', 'like', "%{$this->search}%"))
            ->when($this->filterCategory, fn($q) => $q->where('category_id', $this->filterCategory))
            ->when($this->filterStock === 'out',  fn($q) => $q->where('stock', 0))
            ->when($this->filterStock === 'low',  fn($q) => $q->where('stock', '>', 0)->where('stock', '<=', 10))
            ->when($this->filterStock === 'in',   fn($q) => $q->where('stock', '>', 10))
            ->latest();

        return view('livewire.products.inventory', [
            'products'   => $query->paginate(15),
            'categories' => Category::orderBy('name')->get(),
            'outOfStock' => Product::where('stock', 0)->count(),
            'lowStock'   => Product::where('stock', '>', 0)->where('stock', '<=', 10)->count(),
            'inStock'    => Product::where('stock', '>', 10)->count(),
        ])->layout('layouts.admin');
    }
}