<?php

namespace App\Livewire\Orders;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Order;

#[Layout('layouts.admin')]
class Processing extends Component
{
    use WithPagination;

    public $search = '';
    public $dateFrom = '';
    public $dateTo = '';
    public $perPage = 10;

    public function updatingSearch() { $this->resetPage(); }

    public function clearFilters()
    {
        $this->search = '';
        $this->dateFrom = '';
        $this->dateTo = '';
        $this->resetPage();
    }

    public function updateStatus($id, $status)
    {
        Order::findOrFail($id)->update(['status' => $status]);
        session()->flash('message', 'Order status updated!');
    }

    public function deleteOrder($id)
    {
        Order::findOrFail($id)->delete();
        session()->flash('message', 'Order deleted successfully!');
    }

    public function render()
    {
        $orders = Order::query()
            ->where('status', 'processing')
            ->when($this->search, function ($query) {
                $query->where('order_number', 'like', '%' . $this->search . '%')
                      ->orWhere('customer_name', 'like', '%' . $this->search . '%')
                      ->orWhere('customer_email', 'like', '%' . $this->search . '%');
            })
            ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo, fn($q) => $q->whereDate('created_at', '<=', $this->dateTo))
            ->latest()
            ->paginate($this->perPage);

        $total = Order::where('status', 'processing')->count();

        return view('livewire.orders.processing', compact('orders', 'total'));
    }
}