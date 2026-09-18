<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\Carts;
use App\Models\SeoSetting;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Products extends Component
{
    use WithPagination;

    public $selectedCategories = [];
    public $categorySlug;
    public $categoryName;
    public $minPrice;
    public $maxPrice;
    public $availability = 'all';
    public $sort = 'latest';
    public $wishlistStatus = [];
    public $featuredOnly = false;

    // For category wise sections (Women page)
    public $showCategorySections = false;
    public $categoriesWithProducts = [];

    // SEO Data
    public $seoData = [];

    public function mount($categorySlug = null)
    {
        $this->categorySlug = $categorySlug;

        if ($this->categorySlug) {
            $category = Category::where('slug', $this->categorySlug)->first();
            if ($category) {
                // ✅ For women page - category sections mode
                if ($categorySlug == 'women') {
                    $this->showCategorySections = true;
                    $this->categoryName = 'Women';
                } else {
                    // ✅ For luxury, embroidered, lawn, new-arrivals, sale
                    $this->selectedCategories = [$category->id];
                    $this->categoryName = $category->name;
                    $this->showCategorySections = false;
                    $this->featuredOnly = true; // ✅ Sirf featured products show honge
                }
            }
        }

        $this->loadWishlistStatus();

        if ($this->showCategorySections) {
            $this->loadCategoriesWithProducts();
        }

        // ============================================================
        // SEO DATA FOR CATEGORY PAGE
        // ============================================================
        $settings = SeoSetting::forPage('category');

        if ($this->categorySlug && !$this->showCategorySections) {
            // Single category page (Luxury, Embroidered, etc.)
            $category = Category::where('slug', $this->categorySlug)->first();
            if ($category) {
                $categoryName = $category->name;
                $categoryDescription = $category->description ?? 'Shop premium ' . $categoryName . ' collection at VELENZA.';

                $this->seoData = [
                    'title' => $category->meta_title ?? $categoryName . ' · VELENZA',
                    'description' => $category->meta_description ?? Str::limit(strip_tags($categoryDescription), 160),
                    'og_title' => $category->meta_title ?? $categoryName . ' · VELENZA',
                    'og_description' => $category->meta_description ?? Str::limit(strip_tags($categoryDescription), 160),
                    'og_image' => $category->image ? asset('storage/' . $category->image) : null,
                    'canonical' => route('category.show', $category->slug),
                    'settings' => $settings,
                    'schema_type' => 'collection',
                    'category' => [
                        'name' => $categoryName,
                        'description' => $categoryDescription,
                        'url' => route('category.show', $category->slug),
                    ],
                    'breadcrumb' => [
                        ['name' => 'Home', 'url' => route('home')],
                        ['name' => 'Products', 'url' => route('products')],
                        ['name' => $categoryName, 'url' => route('category.show', $category->slug)],
                    ],
                ];
            }
        } elseif ($this->categorySlug && $this->showCategorySections) {
            // Women page (category sections)
            $this->seoData = [
                'title' => 'Women · VELENZA',
                'description' => 'Explore our exclusive women\'s collection at VELENZA. Shop luxury clothing, embroidered suits, and contemporary designs.',
                'og_title' => 'Women · VELENZA',
                'og_description' => 'Shop premium women\'s fashion at VELENZA.',
                'canonical' => route('category.show', 'women'),
                'settings' => $settings,
                'schema_type' => 'collection',
            ];
        } else {
            // All Products page
            $settingsAll = SeoSetting::forPage('products');
            $this->seoData = [
                'title' => 'All Products · VELENZA',
                'description' => 'Explore our complete collection of premium fashion at VELENZA. Shop luxury clothing, embroidered suits, and contemporary designs.',
                'og_title' => 'All Products · VELENZA',
                'og_description' => 'Shop premium Pakistani fashion at VELENZA.',
                'canonical' => route('products'),
                'settings' => $settingsAll,
                'schema_type' => 'collection',
            ];
        }
    }

    public function loadCategoriesWithProducts()
    {
        $categories = Category::where('status', 1)
            ->whereNotIn('name', ['Kids', 'Sale'])
            ->orderBy('name')
            ->get();

        foreach ($categories as $category) {
            $query = Product::with('category')
                ->where('category_id', $category->id)
                ->where('status', 1);

            if ($this->featuredOnly) {
                $query->where('featured', 1);
            }

            $this->categoriesWithProducts[$category->id] = [
                'category' => $category,
                'products' => $query->latest()->take(8)->get(),
            ];
        }
    }

    public function loadWishlistStatus()
    {
        if (auth()->check()) {
            $wishlistProducts = Wishlist::where('user_id', auth()->id())
                ->pluck('product_id')
                ->toArray();
            $this->wishlistStatus = $wishlistProducts;
        }
    }

    public function toggleFeatured()
    {
        $this->featuredOnly = !$this->featuredOnly;
        $this->resetPage();
        if ($this->showCategorySections) {
            $this->loadCategoriesWithProducts();
        }
    }

    public function toggleWishlist($productId)
    {
        if (!auth()->check()) {
            session()->flash('error', 'Please login to add items to wishlist.');
            return;
        }

        $existing = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();

        if ($existing) {
            $existing->delete();
            $message = 'Removed from wishlist.';
        } else {
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
            ]);
            $message = 'Added to wishlist!';
        }

        $this->loadWishlistStatus();
        session()->flash('message', $message);
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            session()->flash('error', 'Product not found.');
            return;
        }

        if ($product->stock <= 0) {
            session()->flash('error', 'This product is out of stock.');
            return;
        }

        if (auth()->check()) {
            $cartItem = Carts::where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                $cartItem->quantity += 1;
                $cartItem->save();
            } else {
                Carts::create([
                    'user_id' => auth()->id(),
                    'product_id' => $productId,
                    'quantity' => 1,
                    'size' => null,
                    'color' => null,
                ]);
            }
        } else {
            $cart = session()->get('cart', []);
            $productKey = $productId;

            if (isset($cart[$productKey])) {
                $cart[$productKey]['quantity'] += 1;
            } else {
                $cart[$productKey] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'quantity' => 1,
                ];
            }
            session()->put('cart', $cart);
        }

        $this->dispatch('cartUpdated');
        session()->flash('message', $product->name . ' added to cart!');
    }

    public function render()
    {
        // ✅ If category sections mode (Women page only)
        if ($this->showCategorySections) {
            return view('livewire.products', [
                'products' => collect([]),
                'categories' => Category::where('status', 1)->get(),
                'categoriesWithProducts' => $this->categoriesWithProducts,
                'categoryName' => $this->categoryName,
                'showCategorySections' => true,
                'seoData' => $this->seoData,
            ])->layout('components.layouts.app');
        }

        // ✅ Normal products listing (All Products, Luxury, Embroidered, Lawn, New Arrivals, Sale)
        $query = Product::with('category')->where('status', 1);

        // ✅ Featured filter (for category pages it will be true, for All Products it will be false)
        if ($this->featuredOnly) {
            $query->where('featured', 1);
        }

        // ✅ Category filter
        if (!empty($this->selectedCategories)) {
            $query->whereIn('category_id', $this->selectedCategories);
        }

        // Price filter
        if ($this->minPrice) {
            $query->where('price', '>=', $this->minPrice);
        }

        if ($this->maxPrice) {
            $query->where('price', '<=', $this->maxPrice);
        }

        // Availability filter
        if ($this->availability == 'stock') {
            $query->where('stock', '>', 0);
        } elseif ($this->availability == 'out') {
            $query->where('stock', '<=', 0);
        }

        // Sorting
        if ($this->sort == 'low') {
            $query->orderBy('price', 'asc');
        } elseif ($this->sort == 'high') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        return view('livewire.products', [
            'products' => $query->paginate(9),
            'categories' => Category::where('status', 1)->get(),
            'categoriesWithProducts' => [],
            'categoryName' => $this->categoryName,
            'showCategorySections' => false,
            'seoData' => $this->seoData,
        ])->layout('components.layouts.app');
    }
}
