<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Carts;

class Cart extends Component
{
    public $cartItems = [];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cartItems = Carts::with('product')
            ->where('user_id', auth()->id())
            ->get();
    }

    public function remove($id)
    {
        Carts::where('id', $id)
            ->where('user_id', auth()->id())
            ->delete();

        $this->loadCart();
        $this->dispatch('cartUpdated');
    }

    public function updateQuantity($id, $qty)
    {
        if ($qty < 1) {
            $this->remove($id);
            return;
        }

        Carts::where('id', $id)
            ->where('user_id', auth()->id())
            ->update(['quantity' => $qty]);

        $this->loadCart();
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return view('livewire.user.cart')
            ->layout('components.layouts.app');
    }
}