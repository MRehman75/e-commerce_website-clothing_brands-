<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Carts;

class CartCount extends Component
{
    public $count = 0;

    protected $listeners = ['cartUpdated' => 'updateCount'];

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        if (auth()->check()) {
            $this->count = Carts::where('user_id', auth()->id())->sum('quantity');
        } else {
            $this->count = collect(session('cart', []))->sum('quantity');
        }
    }

    public function render()
    {
        return view('livewire.cart-count');
    }
}