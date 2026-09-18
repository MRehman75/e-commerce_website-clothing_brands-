<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class NewArrivals extends Component
{
    public $products = [];

    public function mount()
    {
        // Find category by name "New Arrivals"
        $category = Category::where('name', 'New Arrivals')->first();
        
        if ($category) {
            // Fetch products from this category
            $this->products = Product::with('category')
                ->where('category_id', $category->id)
                ->where('status', 1)
                ->latest()
                ->get();
        } else {
            // If "New Arrivals" category doesn't exist, fetch all products
            $this->products = Product::with('category')
                ->where('status', 1)
                ->latest()
                ->take(8)
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.new-arrivals')
            ->layout('components.layouts.app');
    }
}