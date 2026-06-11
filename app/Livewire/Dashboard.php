<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\FlashSale;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Transaction;
use App\Models\PaymentMethod;
use App\Models\ShippingZone;
use App\Models\ShippingMethod;
use App\Models\HomeSlider;
use App\Models\Page;
use App\Models\Banner;
use App\Models\Menu;
use App\Models\BlogPost;
use App\Models\GeneralSetting;
use App\Models\PaymentGateway;
use App\Models\ActivityLog;

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
         $totalCustomers = User::count(); // ← Customer count
         $totalCoupons = Coupon::count();
$activeCoupons = Coupon::where('is_active', true)->count();
$totalFlashSales = FlashSale::count();
$activeFlashSales = FlashSale::where('is_active', true)->count();
$totalProducts = Product::count();
$activeProducts = Product::where('status', 'active')->count();
$totalCategories = Category::count();
$totalBrands = Brand::count();
$totalTransactions = Transaction::count();
$completedTransactions = Transaction::where('status', 'completed')->count();
$totalPaymentMethods = PaymentMethod::count();
$activePaymentMethods = PaymentMethod::where('is_active', true)->count();
$totalShippingZones = ShippingZone::count();
$activeShippingZones = ShippingZone::where('is_active', true)->count();
$totalShippingMethods = ShippingMethod::count();
$activeShippingMethods = ShippingMethod::where('is_active', true)->count();
$totalSalesRevenue = Order::where('payment_status', 'paid')->sum('total');
$monthlySales = Order::whereMonth('created_at', now()->month)->sum('total');
$totalProductsSold = Order::sum('total_amount');
$lowStockProducts = Product::where('stock', '<=', 10)->count();
$totalUsers = User::count();
$verifiedUsers = User::whereNotNull('email_verified_at')->count();
$unverifiedUsers = User::whereNull('email_verified_at')->count();
$newUsersThisMonth = User::whereMonth('created_at', now()->month)->count();
$totalSliders = HomeSlider::count();
$activeSliders = HomeSlider::where('is_active', true)->count();
$totalPages = Page::count();
$activePages = Page::where('is_active', true)->count();
$totalBanners = Banner::count();
$activeBanners = Banner::where('is_active', true)->count();
$totalMenus = Menu::count();
$totalBlogPosts = BlogPost::count();
$publishedBlogPosts = BlogPost::where('status', 'published')->count();
$generalSettings = GeneralSetting::first();
$totalPaymentGateways = PaymentGateway::count();
$activePaymentGateways = PaymentGateway::where('is_active', true)->count();
$maintenanceMode = $generalSettings ? $generalSettings->maintenance_mode : false;
$totalActivityLogs = ActivityLog::count();
$todayActivityLogs = ActivityLog::whereDate('created_at', today())->count();
$newCustomersThisMonth = User::whereMonth('created_at', now()->month)->count();


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
             'totalCustomers', // ← add karo
             'totalCoupons',
'activeCoupons',
'totalFlashSales',
'activeFlashSales',
'totalProducts',
'activeProducts',
'totalCategories',
'totalBrands',
'totalTransactions',
'completedTransactions',
'totalPaymentMethods',
'activePaymentMethods',
'totalShippingZones',
'activeShippingZones',
'totalShippingMethods',
'activeShippingMethods',
'totalSalesRevenue',
'monthlySales',
'totalProductsSold',
'lowStockProducts',
'totalUsers',
'verifiedUsers',
'unverifiedUsers',
'newUsersThisMonth',
'totalSliders',
'activeSliders',
'totalPages',
'activePages',
'totalBanners',
'activeBanners',
'totalMenus',
'totalBlogPosts',
'publishedBlogPosts',
'generalSettings',
'totalPaymentGateways',
'activePaymentGateways',
'maintenanceMode',
'totalActivityLogs',
'todayActivityLogs',
'newCustomersThisMonth',
        ));
    }
}