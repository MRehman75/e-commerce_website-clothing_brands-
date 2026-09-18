<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\HomeSlider;
use App\Models\FlashSale;
use App\Models\Banner;

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

        if (auth('customer')->check()) {
            $cartItem = \App\Models\Carts::where('user_id', auth('customer')->id())
                ->where('product_id', $product->id)
                ->first();

            if ($cartItem) {
                if ($cartItem->quantity >= $product->stock) {
                    $this->dispatch('notify', type: 'error', message: 'Stock mein itni quantity nahi!');
                    return;
                }
                $cartItem->quantity += 1;
                $cartItem->save();
            } else {
                \App\Models\Carts::create([
                    'user_id' => auth('customer')->id(),
                    'product_id' => $product->id,
                    'quantity' => 1,
                ]);
            }
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] += 1;
                $cart[$product->id]['total'] = $cart[$product->id]['price'] * $cart[$product->id]['quantity'];
            } else {
                $cart[$product->id] = [
                    'product_id' => $product->id,
                    'name'       => $product->name,
                    'price'      => $product->price,
                    'image'      => $product->image,
                    'quantity'   => 1,
                    'total'      => $product->price,
                ];
            }

            session()->put('cart', $cart);
        }

        session()->flash('message', "{$product->name} cart mein add ho gaya!");
        return $this->redirectRoute('cart');
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

    $activeFlashSale = FlashSale::where('is_active', true)
        ->where('start_time', '<=', now())
        ->where('end_time', '>=', now())
        ->first();

    $sliders = HomeSlider::where('is_active', true)->orderBy('sort_order')->get();

  

// render() mein add karo
$sidebarBanner = Banner::where('position', 'sidebar')
    ->where('is_active', true)
    ->where(function($q) {
        $q->whereNull('starts_at')
          ->orWhere('starts_at', '<=', now());
    })
    ->where(function($q) {
        $q->whereNull('ends_at')
          ->orWhere('ends_at', '>=', now());
    })
    ->orderBy('sort_order')
    ->first();
$getBanner = fn($pos) => \App\Models\Banner::active()
    ->forPosition($pos)
    ->first();
    
        // ── Banners ──────────────────────────────

$getBanner = fn($pos) => Banner::active()->forPosition($pos)->first();

$sidebarBanner        = $getBanner('sidebar');
$homepageTopBanner    = $getBanner('homepage_top');
$homepageMiddleBanner = $getBanner('homepage_middle');
$homepageBottomBanner = $getBanner('homepage_bottom');
$categoryTopBanner    = $getBanner('category_top');
$popupBanner          = $getBanner('popup');

return view('livewire.frontend.product-list', compact(
    'products', 'categories', 'brands', 'activeFlashSale',
    'sliders', 'sidebarBanner', 'homepageTopBanner',
    'homepageMiddleBanner', 'homepageBottomBanner',
    'categoryTopBanner', 'popupBanner'
))->layout('layouts.frontend');
}
}