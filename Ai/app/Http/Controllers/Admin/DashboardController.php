<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Use try-catch to handle missing tables gracefully
        try {
            $totalOrders = Order::count();
            $totalRevenue = Order::sum('total');
            $totalCustomers = User::where('role', 'customer')->count();
            $totalProducts = Product::count();
            $recentOrders = Order::with('user')->latest()->take(5)->get();
        } catch (\Exception $e) {
            // If tables don't exist yet, use dummy data
            $totalOrders = 0;
            $totalRevenue = 0;
            $totalCustomers = 0;
            $totalProducts = 0;
            $recentOrders = collect();
        }
        
        return view('admin.dashboard', compact(
            'totalOrders', 'totalRevenue', 'totalCustomers', 
            'totalProducts', 'recentOrders'
        ));
    }
    
    public function generalSettings()
    {
        return view('admin.settings.general');
    }
    
    public function paymentSettings()
    {
        return view('admin.settings.payment');
    }
    
    public function profile()
    {
        return view('admin.profile');
    }
}