<?php
namespace App\Livewire\Orders;

use Livewire\Component;
use App\Models\Order;

class OrderDetail extends Component
{
    public $orderId;
    public $order;

    public function mount($id)
    {
        $this->orderId = $id;
        $this->order = Order::with('items', 'user')->findOrFail($id);
    }

    public function updateStatus($status)
    {
        $this->order->update(['status' => $status]);
        $this->order->refresh();
        session()->flash('message', 'Status update ho gaya!');
    }
    public function updatePaymentStatus(string $status): void
{
    $this->order->update(['payment_status' => $status]);
    session()->flash('message', "Payment status '{$status}' ho gaya!");
}

    public function render()
    {
        return view('livewire.orders.order-detail')
            ->layout('layouts.admin');
    }
}