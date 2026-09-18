<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Order;
use App\Models\Carts;
use Illuminate\Support\Facades\Session;

class OrderDetail extends Component
{
    public $order;
    public $canCancel = false;
    public $statusTimeline = [];
    public $statusSteps = [];

    public function mount(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $this->order = $order->load(['items', 'statuses', 'user']);
        $this->canCancel = in_array($order->status, ['pending', 'processing']);
        $this->buildStatusTimeline();
        $this->buildStatusSteps();
    }

    public function buildStatusTimeline()
    {
        $statuses = [
            'pending' => ['label' => 'Order Placed', 'icon' => 'fa-clock', 'color' => 'warning'],
            'processing' => ['label' => 'Processing', 'icon' => 'fa-cog', 'color' => 'info'],
            'shipped' => ['label' => 'Shipped', 'icon' => 'fa-truck', 'color' => 'primary'],
            'delivered' => ['label' => 'Delivered', 'icon' => 'fa-check-circle', 'color' => 'success'],
        ];

        $currentStatus = $this->order->status;
        $statusKeys = array_keys($statuses);
        $currentIndex = array_search($currentStatus, $statusKeys);

        foreach ($statuses as $key => &$status) {
            $statusIndex = array_search($key, $statusKeys);
            $status['completed'] = $statusIndex <= $currentIndex;
            $status['active'] = $statusIndex == $currentIndex;
            $status['index'] = $statusIndex;
        }

        $this->statusTimeline = $statuses;
    }

    public function buildStatusSteps()
    {
        $this->statusSteps = [
            [
                'label' => 'Order Placed',
                'icon' => 'fa-shopping-bag',
                'date' => $this->order->created_at->format('d M Y, h:i A'),
                'completed' => true,
            ],
            [
                'label' => 'Processing',
                'icon' => 'fa-spinner',
                'date' => $this->order->status != 'pending' ? $this->order->updated_at->format('d M Y, h:i A') : null,
                'completed' => !in_array($this->order->status, ['pending', 'cancelled']),
            ],
            [
                'label' => 'Shipped',
                'icon' => 'fa-truck',
                'date' => $this->order->status == 'shipped' || $this->order->status == 'delivered' ? $this->order->updated_at->format('d M Y, h:i A') : null,
                'completed' => in_array($this->order->status, ['shipped', 'delivered']),
            ],
            [
                'label' => 'Delivered',
                'icon' => 'fa-check-circle',
                'date' => $this->order->status == 'delivered' ? $this->order->updated_at->format('d M Y, h:i A') : null,
                'completed' => $this->order->status == 'delivered',
            ],
        ];
    }

    public function cancelOrder()
    {
        if (!$this->canCancel) {
            session()->flash('error', 'This order cannot be cancelled.');
            return;
        }

        $this->order->status = 'cancelled';
        $this->order->save();

        $this->order->statuses()->create([
            'status' => 'cancelled',
            'note' => 'Order cancelled by customer',
        ]);

        $this->canCancel = false;
        $this->buildStatusTimeline();
        $this->buildStatusSteps();
        session()->flash('message', 'Order cancelled successfully.');
    }

    public function reorder()
    {
        $cart = Session::get('cart', []);

        foreach ($this->order->items as $item) {
            $cartKey = $item->product_id . '_' . ($item->size ?? '') . '_' . ($item->color ?? '');

            if (isset($cart[$cartKey])) {
                $cart[$cartKey]['quantity'] += $item->quantity;
            } else {
                $product = \App\Models\Product::find($item->product_id);
                $cart[$cartKey] = [
                    'id' => $item->product_id,
                    'name' => $item->product_name,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'image' => $product && $product->image ? $product->image : null,
                    'size' => $item->size,
                    'color' => $item->color,
                ];
            }
        }

        Session::put('cart', $cart);
        $this->dispatch('cartUpdated');
        session()->flash('message', 'Items added to cart successfully!');
        return redirect()->route('cart');
    }

    public function downloadInvoice()
    {
        session()->flash('info', 'Invoice download will be available soon.');
    }

    public function render()
    {
        return view('livewire.user.order-detail')
            ->layout('components.layouts.app');
    }
}