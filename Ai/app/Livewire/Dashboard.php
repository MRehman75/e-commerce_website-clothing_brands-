<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Order;
use Carbon\Carbon;

#[Layout('layouts.admin')]
class Dashboard extends Component
{
    public function render()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total');
        $pendingOrders = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $shippedOrders = Order::where('status', 'shipped')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        $activeOrders = Order::whereIn('status', ['pending', 'processing', 'shipped'])->count();
        $recentOrders = Order::latest()->take(10)->get();

        // Chart Data - Last 30 days
        $chartLabels = [];
        $revenueData = [];
        $ordersData = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $chartLabels[] = $date->format('d M');

            $revenueData[] = Order::whereDate('created_at', $date)->sum('total');
            $ordersData[] = Order::whereDate('created_at', $date)->count();
        }

        return view('livewire.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'pendingOrders',
            'processingOrders',
            'shippedOrders',
            'deliveredOrders',
            'cancelledOrders',
            'activeOrders',
            'recentOrders',
            'chartLabels',
            'revenueData',
            'ordersData',
        ));
    }
}