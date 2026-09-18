<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;

class Women extends Component
{
    public $categories = [];
    public $categoryProducts = [];

    public function mount()
    {
        // Fetch all categories except "Kids"
        $this->categories = Category::where('status', 1)
            ->where('name', '!=', 'Kids')
            ->orderBy('name')
            ->get();

        // Fetch products for each category
        foreach ($this->categories as $category) {
            $this->categoryProducts[$category->id] = Product::with('category')
                ->where('category_id', $category->id)
                ->where('status', 1)
                ->latest()
                ->take(8)
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.women')
            ->layout('components.layouts.app');
    }
}