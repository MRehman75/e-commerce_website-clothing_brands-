<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;

class Orders extends Component
{
    use WithPagination;

    public $statusFilter = 'all';
    public $search = '';
    public $sortBy = 'newest';

    protected $queryString = [
        'statusFilter' => ['except' => 'all'],
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'newest'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function getOrders()
    {
        $query = Order::where('user_id', auth()->id());

        // Status filter
        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        // Search filter
        if (!empty($this->search)) {
            $query->where('order_number', 'like', '%' . $this->search . '%');
        }

        // Sorting
        switch ($this->sortBy) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'amount_high':
                $query->orderBy('total', 'desc');
                break;
            case 'amount_low':
                $query->orderBy('total', 'asc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
                break;
        }

        return $query->paginate(10);
    }

    public function getStatusCounts()
    {
        $userId = auth()->id();
        return [
            'all' => Order::where('user_id', $userId)->count(),
            'pending' => Order::where('user_id', $userId)->where('status', 'pending')->count(),
            'processing' => Order::where('user_id', $userId)->where('status', 'processing')->count(),
            'shipped' => Order::where('user_id', $userId)->where('status', 'shipped')->count(),
            'delivered' => Order::where('user_id', $userId)->where('status', 'delivered')->count(),
            'cancelled' => Order::where('user_id', $userId)->where('status', 'cancelled')->count(),
        ];
    }

    public function render()
    {
        $orders = $this->getOrders();
        $statusCounts = $this->getStatusCounts();

        return view('livewire.user.orders', [
            'orders' => $orders,
            'statusCounts' => $statusCounts,
        ])->layout('components.layouts.app');
    }
}