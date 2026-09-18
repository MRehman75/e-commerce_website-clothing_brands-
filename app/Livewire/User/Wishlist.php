<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Wishlist as WishlistModel;
use App\Models\Carts;
use Illuminate\Support\Facades\Session;

class Wishlist extends Component
{
    public $wishlistItems = [];
    public $wishlistCount = 0;

    public function mount()
    {
        $this->loadWishlist();
    }

    public function loadWishlist()
    {
        $this->wishlistItems = WishlistModel::with('product')
            ->where('user_id', auth()->id())
            ->get()
            ->map(function($item) {
                $product = $item->product;
                return [
                    'id' => $item->id,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'price' => $product->price,
                    'compare_price' => $product->compare_price,
                    'image' => $product->image,
                    'stock' => $product->stock,
                    'status' => $product->status,
                    'in_stock' => $product->stock > 0,
                    'created_at' => $item->created_at->diffForHumans(),
                ];
            })
            ->toArray();

        $this->wishlistCount = count($this->wishlistItems);
    }

    public function removeFromWishlist($wishlistId)
    {
        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('id', $wishlistId)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $this->loadWishlist();
            $this->dispatch('wishlistUpdated');
            session()->flash('message', 'Item removed from wishlist.');
        }
    }

    public function addToCart($productId)
    {
        $product = \App\Models\Product::find($productId);
        
        if (!$product) {
            session()->flash('error', 'Product not found.');
            return;
        }

        if ($product->stock <= 0) {
            session()->flash('error', 'This product is out of stock.');
            return;
        }

        // Check if already in cart
        $cart = Session::get('cart', []);
        $cartKey = $productId;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += 1;
        } else {
            $cart[$cartKey] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
            ];
        }

        Session::put('cart', $cart);
        $this->dispatch('cartUpdated');
        session()->flash('message', $product->name . ' added to cart!');
    }

    public function addAllToCart()
    {
        if (empty($this->wishlistItems)) {
            session()->flash('error', 'Your wishlist is empty.');
            return;
        }

        $cart = Session::get('cart', []);
        $addedCount = 0;

        foreach ($this->wishlistItems as $item) {
            if ($item['in_stock']) {
                $cartKey = $item['product_id'];
                if (isset($cart[$cartKey])) {
                    $cart[$cartKey]['quantity'] += 1;
                } else {
                    $cart[$cartKey] = [
                        'id' => $item['product_id'],
                        'name' => $item['name'],
                        'price' => $item['price'],
                        'image' => $item['image'],
                        'quantity' => 1,
                    ];
                }
                $addedCount++;
            }
        }

        Session::put('cart', $cart);
        $this->dispatch('cartUpdated');
        session()->flash('message', $addedCount . ' items added to cart!');
    }

    public function clearWishlist()
    {
        Wishlist::where('user_id', auth()->id())->delete();
        $this->loadWishlist();
        $this->dispatch('wishlistUpdated');
        session()->flash('message', 'Wishlist cleared successfully.');
    }

    public function render()
    {
        return view('livewire.user.wishlist')
            ->layout('components.layouts.app');
    }
}