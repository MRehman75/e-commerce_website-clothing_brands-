<?php
namespace App\Livewire\Reports;
use Livewire\Component;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Category;
use App\Models\Brand;

class ProductReport extends Component
{
    public $filterCategory = '';
    public $filterBrand = '';
    public $sortBy = 'total_sold';

    public function getStatsProperty()
    {
        return [
            'total_products'  => Product::count(),
            'active_products' => Product::where('status', 'active')->count(),
            'out_of_stock'    => Product::where('stock', 0)->count(),
            'low_stock'       => Product::where('stock', '>', 0)->where('stock', '<=', 10)->count(),
            'total_revenue'   => OrderItem::sum(\DB::raw('price * quantity')),
            'total_sold'      => OrderItem::sum('quantity'),
        ];
    }

    public function getProductsProperty()
    {
        return Product::query()
            ->withCount('orderItems')
            ->withSum('orderItems', 'quantity')
            ->when($this->filterCategory, fn($q) => $q->where('category_id', $this->filterCategory))
            ->when($this->filterBrand, fn($q) => $q->where('brand_id', $this->filterBrand))
            ->orderByDesc('order_items_count')
            ->get();
    }

    public function getCategoriesProperty()
    {
        return Category::orderBy('name')->get();
    }

    public function getBrandsProperty()
    {
        return Brand::orderBy('name')->get();
    }
// public function mount()
// {
//     if (!auth()->user()->hasPermission('view-reports')) {
//         abort(403);
//     }
// }
    public function render()
    {
        return view('livewire.reports.product-report', [
            'stats'      => $this->stats,
            'products'   => $this->products,
            'categories' => $this->categories,
            'brands'     => $this->brands,
        ])->layout('layouts.admin');
    }
    
}