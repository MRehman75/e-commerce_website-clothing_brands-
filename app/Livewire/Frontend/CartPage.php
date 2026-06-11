<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Product;

class CartPage extends Component
{
    public array $cart = [];

    public function mount()
    {
        $this->cart = session()->get('cart', []);
    }

    public function updateQuantity(int $productId, int $quantity)
    {
        if ($quantity < 1) {
            $this->removeItem($productId);
            return;
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            // Stock check
            $product = Product::find($productId);
            if ($product && $quantity > $product->stock) {
                $this->dispatch('notify', type: 'error', message: 'Stock mein itni quantity nahi hai!');
                return;
            }
            $cart[$productId]['quantity'] = $quantity;
            $cart[$productId]['total']    = $cart[$productId]['price'] * $quantity;
        }

        session()->put('cart', $cart);
        $this->cart = $cart;
        $this->dispatch('cartUpdated', count: $this->cartCount());
    }

    public function removeItem(int $productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);
        $this->cart = $cart;
        $this->dispatch('cartUpdated', count: $this->cartCount());
        $this->dispatch('notify', type: 'success', message: 'Item remove ho gaya!');
    }

    public function clearCart()
    {
        session()->forget('cart');
        $this->cart = [];
        $this->dispatch('cartUpdated', count: 0);
        $this->dispatch('notify', type: 'success', message: 'Cart clear ho gaya!');
    }

    public function cartCount(): int
    {
        return array_sum(array_column($this->cart, 'quantity'));
    }

    public function getSubtotalProperty(): float
    {
        return array_sum(array_column($this->cart, 'total'));
    }

    public function getShippingProperty(): float
    {
        return $this->subtotal > 0 ? 150 : 0;
    }

    public function getTotalProperty(): float
    {
        return $this->subtotal + $this->shipping;
    }

    public function render()
    {
        return view('livewire.frontend.cart-page')
            ->layout('layouts.frontend');
    }
}