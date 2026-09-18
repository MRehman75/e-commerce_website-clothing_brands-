<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Order;
use App\Models\Carts;
use App\Models\Wishlist;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $stats = [
        'total_orders' => 0,
        'pending_orders' => 0,
        'delivered_orders' => 0,
        'cancelled_orders' => 0,
        'total_spent' => 0,
        'cart_items' => 0,
        'wishlist_items' => 0,
    ];

    public $recentOrders = [];
    public $monthlySpending = [];
    public $memberSince = '';
    public $greeting = '';

    public function mount()
    {
        $this->loadStats();
        $this->loadRecentOrders();
        $this->loadMonthlySpending();
        $this->setGreeting();
        $this->setMemberSince();
    }

    public function loadStats()
    {
        $userId = auth()->id();

        // Order stats
        $this->stats['total_orders'] = Order::where('user_id', $userId)->count();
        $this->stats['pending_orders'] = Order::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();
        $this->stats['delivered_orders'] = Order::where('user_id', $userId)
            ->where('status', 'delivered')
            ->count();
        $this->stats['cancelled_orders'] = Order::where('user_id', $userId)
            ->where('status', 'cancelled')
            ->count();

        // Total spent
        $this->stats['total_spent'] = Order::where('user_id', $userId)
            ->where('status', 'delivered')
            ->sum('total');

        // Cart items
        $this->stats['cart_items'] = Carts::where('user_id', $userId)->sum('quantity');

        // Wishlist items
        $this->stats['wishlist_items'] = Wishlist::where('user_id', $userId)->count();
    }

    public function loadRecentOrders()
    {
        $this->recentOrders = Order::where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();
    }

    public function loadMonthlySpending()
    {
        $userId = auth()->id();
        $months = collect(range(1, 12))->map(function($month) {
            return Carbon::create(null, $month, 1)->format('M');
        });

        $spending = Order::where('user_id', $userId)
            ->where('status', 'delivered')
            ->whereYear('created_at', Carbon::now()->year)
            ->selectRaw('MONTH(created_at) as month, SUM(total) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        $this->monthlySpending = $months->mapWithKeys(function($month, $index) use ($spending) {
            $monthNumber = $index + 1;
            return [$month => $spending->get($monthNumber, 0)];
        })->toArray();
    }

    public function setGreeting()
    {
        $hour = Carbon::now()->hour;
        
        if ($hour < 12) {
            $this->greeting = 'Good Morning';
        } elseif ($hour < 17) {
            $this->greeting = 'Good Afternoon';
        } elseif ($hour < 21) {
            $this->greeting = 'Good Evening';
        } else {
            $this->greeting = 'Good Night';
        }
    }

    public function setMemberSince()
    {
        $user = auth()->user();
        $this->memberSince = $user->created_at->format('F Y');
    }

    public function render()
    {
        return view('livewire.user.dashboard')
            ->layout('components.layouts.app');
    }
}