<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class Thankyou extends Component
{
    public $order;
    public $orderItems = [];
    public $subtotal = 0;
    public $tax = 0;
    public $shipping = 0;
    public $grandTotal = 0;
    public $estimatedDelivery = '';

    public function mount($orderId)
    {
        $this->order = Order::with(['items', 'user'])
            ->findOrFail($orderId);

        $this->orderItems = $this->order->items;
        $this->subtotal = $this->order->subtotal ?? 0;
        $this->tax = $this->order->tax ?? 0;
        $this->shipping = $this->order->shipping_cost ?? 0;
        $this->grandTotal = $this->order->total ?? 0;

        $this->estimatedDelivery = $this->order->created_at->addDays(5)->format('F d') . ' - ' . 
                                   $this->order->created_at->addDays(7)->format('F d, Y');
    }

    public function render()
    {
        return view('livewire.thankyou')
            ->layout('components.layouts.app');
    }
}