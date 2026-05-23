<?php

namespace App\Livewire;

use Livewire\Component;

class DashboardStats extends Component
{
    public $totalOrders = 0;
    public $totalRevenue = 0;
    public $totalCustomers = 0;
    public $totalProducts = 0;

    public function mount()
    {
        // Load real data from database
        // $this->totalOrders = Order::count();
        // $this->totalRevenue = Order::sum('total');
        // $this->totalCustomers = User::count();
        // $this->totalProducts = Product::count();
        
        // Temporary dummy data
        $this->totalOrders = 1234;
        $this->totalRevenue = 54200;
        $this->totalCustomers = 5678;
        $this->totalProducts = 892;
    }

    public function render()
    {
        return view('livewire.dashboard-stats');
    }
}