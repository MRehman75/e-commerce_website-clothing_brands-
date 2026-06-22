<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\FlashSale;

class ProductList extends Component
{
    use WithPagination;

    public string $search      = '';
    public string $category    = '';
    public string $brand       = '';
    public string $sortBy      = 'created_at';
    public string $sortOrder   = 'desc';
    public float  $minPrice    = 0;
    public float  $maxPrice    = 100000;
    public int    $perPage     = 12;

    protected $queryString = [
        'search'    => ['except' => ''],
        'category'  => ['except' => ''],
        'brand'     => ['except' => ''],
        'sortBy'    => ['except' => 'created_at'],
        'sortOrder' => ['except' => 'desc'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function addToCart(int $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            $this->dispatch('notify', type: 'error', message: 'Product nahi mila!');
            return;
        }

        if ($product->stock < 1) {
            $this->dispatch('notify', type: 'error', message: 'Product out of stock hai!');
            return;
        }

        $cart = session()->get('cart', []);

        // ✅ Active flash sale check karo
        $flashSale = FlashSale::where('is_active', true)
            ->where('start_time', '<=', now())
            ->where('end_time', '>=', now())
            ->first();

        $finalPrice = (float) $product->price;
        if ($flashSale) {
          $finalPrice = $finalPrice - ($finalPrice * $flashSale->discount_percentage / 100);
        }

        if (isset($cart[$productId])) {
            if ($cart[$productId]['quantity'] >= $product->stock) {
                $this->dispatch('notify', type: 'error', message: 'Stock mein itni quantity nahi!');
                return;
            }
            $cart[$productId]['quantity']++;
            $cart[$productId]['total'] = $cart[$productId]['price'] * $cart[$productId]['quantity'];
        } else {
            $cart[$productId] = [
                'product_id' => $product->id,
                'name'       => $product->name,
                'sku'        => $product->sku,
                'price'      => $finalPrice,
                'quantity'   => 1,
                'total'      => $finalPrice,
                'image'      => $product->image,
            ];
        }

        session()->put('cart', $cart);
        $count = array_sum(array_column($cart, 'quantity'));
        $this->dispatch('cartUpdated', count: $count);
        $this->dispatch('notify', type: 'success', message: "{$product->name} cart mein add ho gaya!");
    }

    public function render()
    {
        $products = Product::query()
            ->where('status', 'active')
            ->when($this->search, fn($q) =>
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
            )
            ->when($this->category, fn($q) =>
                $q->whereHas('category', fn($q) => $q->where('slug', $this->category))
            )
            ->when($this->brand, fn($q) =>
                $q->whereHas('brand', fn($q) => $q->where('slug', $this->brand))
            )
            ->whereBetween('price', [$this->minPrice, $this->maxPrice])
            ->orderBy($this->sortBy, $this->sortOrder)
            ->paginate($this->perPage);

        $categories = Category::orderBy('name')->get();
        $brands     = Brand::orderBy('name')->get();

        // ✅ Active flash sale lao
        $activeFlashSale = FlashSale::where('is_active', true)
            ->where('start_time', '<=', now())
            ->where('end_time', '>=', now())
            ->first();

        return view('livewire.frontend.product-list', compact('products', 'categories', 'brands', 'activeFlashSale'))
            ->layout('layouts.frontend');
    }
}