<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Carts;
use App\Models\Wishlist;
use App\Models\SeoSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SingalProduct extends Component
{
    public $product;
    public $quantity = 1;
    public $selectedSize = null;
    public $selectedColor = null;
    public $isInWishlist = false;
    public $relatedProducts = [];
    public $filteredRelatedProducts = [];
    public $mainImage = null;
    public $productImages = [];
    public $stock = 0;

    // Size and Color collections
    public $sizes = [];
    public $colors = [];

    // Cart feedback
    public $cartMessage = null;
    public $cartMessageType = null;

    // SEO Data
    public $seoData = [];

    public function mount($slug)
    {
        // Find product by slug with sizes and colors
        $product = Product::with(['category', 'brand', 'sizes', 'colors', 'reviews'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Store the product model
        $this->product = $product;
        $this->stock = $product->stock ?? 0;

        // Load sizes and colors
        $this->sizes = $product->sizes;
        $this->colors = $product->colors;

        // Set default selected size if available
        if ($this->sizes->isNotEmpty()) {
            $this->selectedSize = $this->sizes->first()->size_name;
        }

        // Set default selected color if available
        if ($this->colors->isNotEmpty()) {
            $this->selectedColor = $this->colors->first()->color_name;
        }

        // Handle images
        $mainImagePath = $product->image;
        $galleryImages = $product->gallery ?? [];

        if ($mainImagePath) {
            $this->mainImage = $this->getImageUrl($mainImagePath);
        } else {
            $this->mainImage = null;
        }

        $this->productImages = [];
        if ($this->mainImage) {
            $this->productImages[] = $this->mainImage;
        }

        if (!empty($galleryImages) && is_array($galleryImages)) {
            foreach ($galleryImages as $galleryImage) {
                if ($galleryImage) {
                    $this->productImages[] = $this->getImageUrl($galleryImage);
                }
            }
        }

        // Load related products
        $this->loadRelatedProducts();

        // Check if product is in wishlist
        if (auth()->check()) {
            $this->isInWishlist = Wishlist::where('user_id', auth()->id())
                ->where('product_id', $product->id)
                ->exists();
        }

        // ============================================================
        // SEO DATA FOR PRODUCT PAGE
        // ============================================================
        $settings = SeoSetting::forPage('product');

        // Get product image for OG
        $ogImage = $product->image ? asset('storage/' . $product->image) : null;

        // Get product rating if reviews exist
        $rating = $product->reviews->avg('rating') ?? null;
        $reviewCount = $product->reviews->count() ?? null;

        $this->seoData = [
            'title' => $product->seo_title ?? $product->name . ' · VELENZA',
            'description' => $product->seo_description ?? Str::limit(strip_tags($product->description), 160),
            'og_title' => $product->seo_title ?? $product->name . ' · VELENZA',
            'og_description' => $product->seo_description ?? Str::limit(strip_tags($product->description), 160),
            'og_image' => $ogImage,
            'canonical' => route('product.show', $product->slug),
            'settings' => $settings,
            'schema_type' => 'product',
            'product' => [
                'name' => $product->name,
                'description' => Str::limit(strip_tags($product->description), 120),
                'image' => $ogImage,
                'sku' => $product->sku ?? null,
                'brand' => $product->brand->name ?? 'VELENZA',
                'category' => $product->category->name ?? null,
                'price' => $product->price,
                'stock' => $product->stock,
                'url' => route('product.show', $product->slug),
                'rating' => $rating,
                'review_count' => $reviewCount,
            ],
            'breadcrumb' => [
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'Products', 'url' => route('products')],
                ['name' => $product->category->name ?? 'Products', 'url' => $product->category ? route('category.show', $product->category->slug) : ''],
                ['name' => $product->name, 'url' => route('product.show', $product->slug)],
            ],
        ];
    }

    public function loadRelatedProducts()
    {
        if ($this->product->category_id) {
            // Get all products from same category
            $query = Product::where('category_id', $this->product->category_id)
                ->where('id', '!=', $this->product->id)
                ->where('status', 1);

            // ✅ Filter by selected size
            if ($this->selectedSize) {
                $query->whereHas('sizes', function ($q) {
                    $q->where('size_name', $this->selectedSize)
                        ->where('stock', '>', 0);
                });
            }

            // ✅ Filter by selected color
            if ($this->selectedColor) {
                $query->whereHas('colors', function ($q) {
                    $q->where('color_name', $this->selectedColor)
                        ->where('stock', '>', 0);
                });
            }

            $this->filteredRelatedProducts = $query->limit(8)->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'slug' => $item->slug,
                    'name' => $item->name,
                    'price' => $item->price,
                    'compare_price' => $item->compare_price,
                    'image' => $item->image ? $this->getImageUrl($item->image) : null,
                    'category' => $item->category ? $item->category->name : null,
                ];
            })->toArray();
        }
    }

    public function selectSize($size)
    {
        $this->selectedSize = $size;
        $this->loadRelatedProducts(); // Refresh related products
    }

    public function selectColor($color)
    {
        $this->selectedColor = $color;
        $this->loadRelatedProducts(); // Refresh related products
    }

    public function incrementQuantity()
    {
        if ($this->quantity < 10) {
            $this->quantity++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        // Validate
        if (!$this->product) {
            $this->cartMessage = 'Product not found.';
            $this->cartMessageType = 'error';
            return;
        }

        // Check if product has sizes/colors and validate selection
        if ($this->sizes->isNotEmpty() && empty($this->selectedSize)) {
            $this->cartMessage = 'Please select a size.';
            $this->cartMessageType = 'error';
            return;
        }

        if ($this->colors->isNotEmpty() && empty($this->selectedColor)) {
            $this->cartMessage = 'Please select a color.';
            $this->cartMessageType = 'error';
            return;
        }

        // Check stock
        if ($this->stock <= 0) {
            $this->cartMessage = 'This product is out of stock.';
            $this->cartMessageType = 'error';
            return;
        }

        if ($this->quantity > $this->stock) {
            $this->cartMessage = 'Only ' . $this->stock . ' items available.';
            $this->cartMessageType = 'error';
            return;
        }

        // Check if user is logged in
        if (auth()->check()) {
            // LOGGED IN USER - Save to database
            $cartItem = Carts::where('user_id', auth()->id())
                ->where('product_id', $this->product->id)
                ->where('size', $this->selectedSize)
                ->where('color', $this->selectedColor)
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $this->quantity;
                $cartItem->save();
            } else {
                Carts::create([
                    'user_id' => auth()->id(),
                    'product_id' => $this->product->id,
                    'quantity' => $this->quantity,
                    'size' => $this->selectedSize,
                    'color' => $this->selectedColor,
                ]);
            }
        } else {
            // GUEST USER - Save to session
            $cart = session()->get('cart', []);
            $productKey = $this->product->id . '_' . ($this->selectedSize ?? '') . '_' . ($this->selectedColor ?? '');

            if (isset($cart[$productKey])) {
                $cart[$productKey]['quantity'] += $this->quantity;
            } else {
                $cart[$productKey] = [
                    'id' => $this->product->id,
                    'name' => $this->product->name,
                    'price' => $this->product->price,
                    'image' => $this->product->image,
                    'quantity' => $this->quantity,
                    'size' => $this->selectedSize,
                    'color' => $this->selectedColor,
                ];
            }

            session()->put('cart', $cart);
        }

        // Dispatch event to update cart count
        $this->dispatch('cartUpdated');

        // Show success message
        $this->cartMessage = $this->product->name . ' added to cart successfully!';
        $this->cartMessageType = 'success';

        // Reset quantity to 1 after adding
        $this->quantity = 1;
    }

    public function toggleWishlist()
    {
        if (!auth()->check()) {
            $this->cartMessage = 'Please login to add items to wishlist.';
            $this->cartMessageType = 'error';
            return;
        }

        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $this->product->id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $this->isInWishlist = false;
            $this->cartMessage = 'Removed from wishlist.';
            $this->cartMessageType = 'success';
        } else {
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $this->product->id,
            ]);
            $this->isInWishlist = true;
            $this->cartMessage = 'Added to wishlist!';
            $this->cartMessageType = 'success';
        }
    }

    private function getImageUrl($imagePath)
    {
        if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
            return $imagePath;
        }

        if (str_starts_with($imagePath, 'storage/')) {
            return asset($imagePath);
        }

        if (str_starts_with($imagePath, 'products/')) {
            return asset('storage/' . $imagePath);
        }

        if (str_starts_with($imagePath, 'uploads/')) {
            return asset($imagePath);
        }

        return asset('storage/' . $imagePath);
    }

    public function render()
    {
        return view('livewire.singal-product', [
            'seoData' => $this->seoData,
        ])->layout('components.layouts.app');
    }
}
