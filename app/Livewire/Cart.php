<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Carts;
use App\Models\Product;

class Cart extends Component
{
    public $cartItems = [];
    public $subtotal = 0;
    public $tax = 0;
    public $shipping = 0;
    public $discount = 0;
    public $grandTotal = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cartItems = [];
        
        // Check if user is logged in and has database cart
        if (auth()->check()) {
            $dbCartItems = Carts::with('product')
                ->where('user_id', auth()->id())
                ->get();
            
            if ($dbCartItems->isNotEmpty()) {
                foreach ($dbCartItems as $item) {
                    if ($item->product) {
                        $this->cartItems[] = [
                            'id' => $item->id,  // Database ID (numeric)
                            'product_id' => $item->product_id,
                            'name' => $item->product->name,
                            'price' => floatval($item->product->price),
                            'image' => $item->product->image,
                            'quantity' => $item->quantity,
                            'size' => $item->size,
                            'color' => $item->color,
                            'stock' => $item->product->stock,
                            'subtotal' => floatval($item->product->price) * $item->quantity,
                            'is_db' => true,  // ✅ FLAG: This is a database item
                        ];
                    }
                }
            }
        }
        
        // If no database items, check session (for guests OR logged-in users without DB items)
        if (empty($this->cartItems)) {
            $sessionCart = session()->get('cart', []);
            
            foreach ($sessionCart as $key => $item) {
                if (isset($item['name']) && isset($item['price'])) {
                    $product = Product::find($item['id'] ?? null);
                    
                    $this->cartItems[] = [
                        'id' => $key,  // Session key (string like "16")
                        'product_id' => $item['id'] ?? null,
                        'name' => $item['name'],
                        'price' => floatval($item['price']),
                        'image' => $item['image'] ?? null,
                        'quantity' => intval($item['quantity'] ?? 1),
                        'size' => $item['size'] ?? null,
                        'color' => $item['color'] ?? null,
                        'stock' => $product ? $product->stock : 999,
                        'subtotal' => floatval($item['price']) * intval($item['quantity'] ?? 1),
                        'is_db' => false,  // ✅ FLAG: This is a session item
                    ];
                }
            }
        }

        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->subtotal = collect($this->cartItems)->sum('subtotal');
        $this->tax = $this->subtotal * 0.10;
        $this->shipping = $this->subtotal > 100 ? 0 : 10;
        $this->grandTotal = $this->subtotal + $this->tax + $this->shipping - $this->discount;
    }

    public function updateQuantity($itemId, $quantity)
    {
        if ($quantity < 1) {
            $this->removeFromCart($itemId);
            return;
        }

        // Find the item in cartItems to check if it's from database or session
        $item = collect($this->cartItems)->firstWhere('id', $itemId);
        
        if (!$item) {
            session()->flash('error', 'Item not found.');
            return;
        }

        // ✅ Check if it's a database item using the flag
        if ($item['is_db'] == true) {
            // Update database
            $cartItem = Carts::where('user_id', auth()->id())
                ->where('id', $itemId)
                ->first();
            
            if ($cartItem) {
                if ($quantity > $cartItem->product->stock) {
                    session()->flash('error', 'Only ' . $cartItem->product->stock . ' items available.');
                    return;
                }
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        } else {
            // Update session (for guest or session items)
            $cart = session()->get('cart', []);
            if (isset($cart[$itemId])) {
                $cart[$itemId]['quantity'] = $quantity;
                session()->put('cart', $cart);
            }
        }

        $this->loadCart();
        $this->dispatch('cartUpdated');
        session()->flash('message', 'Cart updated.');
    }

    public function removeFromCart($itemId)
    {
        // Find the item in cartItems to check if it's from database or session
        $item = collect($this->cartItems)->firstWhere('id', $itemId);
        
        if (!$item) {
            session()->flash('error', 'Item not found.');
            return;
        }

        // ✅ Check if it's a database item using the flag
        if ($item['is_db'] == true) {
            // Remove from database
            Carts::where('user_id', auth()->id())
                ->where('id', $itemId)
                ->delete();
        } else {
            // Remove from session
            $cart = session()->get('cart', []);
            unset($cart[$itemId]);
            session()->put('cart', $cart);
        }

        $this->loadCart();
        $this->dispatch('cartUpdated');
        session()->flash('message', 'Item removed from cart.');
    }

    public function clearCart()
    {
        if (auth()->check()) {
            Carts::where('user_id', auth()->id())->delete();
        }
        session()->forget('cart');

        $this->loadCart();
        $this->dispatch('cartUpdated');
        session()->flash('message', 'Cart cleared.');
    }

    public function applyCoupon($couponCode)
    {
        if (empty($couponCode)) {
            session()->flash('error', 'Enter a coupon code.');
            return;
        }

        if (strtolower($couponCode) === 'velenza10') {
            $this->discount = $this->subtotal * 0.10;
            $this->grandTotal = $this->subtotal + $this->tax + $this->shipping - $this->discount;
            session()->flash('message', 'Coupon applied! Saved $' . number_format($this->discount, 2));
        } else {
            session()->flash('error', 'Invalid coupon code.');
        }
    }

    public function render()
    {
        return view('livewire.cart')
        ->layout('components.layouts.app');
    }
}