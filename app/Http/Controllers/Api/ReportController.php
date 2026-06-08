<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * GET /api/reports/sales
     * Sales & Revenue Report
     */
    public function sales(Request $request): JsonResponse
    {
        $from = $request->get('from', now()->startOfMonth()->toDateString());
        $to   = $request->get('to',   now()->toDateString());

        // Total revenue
        $totalRevenue = Order::whereBetween('created_at', [$from, $to])
            ->whereNotIn('status', ['cancelled'])
            ->sum('total');

        // Daily sales
        $dailySales = Order::whereBetween('created_at', [$from, $to])
            ->whereNotIn('status', ['cancelled'])
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as orders'),
                DB::raw('SUM(total) as revenue')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Status wise orders
        $statusWise = Order::whereBetween('created_at', [$from, $to])
            ->select('status', DB::raw('COUNT(*) as count'), DB::raw('SUM(total) as revenue'))
            ->groupBy('status')
            ->get();

        // Payment method wise
        $paymentWise = Order::whereBetween('created_at', [$from, $to])
            ->select('payment_method', DB::raw('COUNT(*) as count'), DB::raw('SUM(total) as revenue'))
            ->groupBy('payment_method')
            ->get();

        return response()->json([
            'period' => ['from' => $from, 'to' => $to],
            'summary' => [
                'total_revenue'  => (float) $totalRevenue,
                'total_orders'   => Order::whereBetween('created_at', [$from, $to])->count(),
                'average_order'  => (float) Order::whereBetween('created_at', [$from, $to])->avg('total'),
                'total_discount' => (float) Order::whereBetween('created_at', [$from, $to])->sum('discount'),
                'total_tax'      => (float) Order::whereBetween('created_at', [$from, $to])->sum('tax'),
            ],
            'daily_sales'    => $dailySales,
            'status_wise'    => $statusWise,
            'payment_wise'   => $paymentWise,
        ]);
    }

    /**
     * GET /api/reports/orders
     * Orders Report
     */
    public function orders(Request $request): JsonResponse
    {
        $from = $request->get('from', now()->startOfMonth()->toDateString());
        $to   = $request->get('to',   now()->toDateString());

        $total      = Order::whereBetween('created_at', [$from, $to])->count();
        $pending    = Order::whereBetween('created_at', [$from, $to])->where('status', 'pending')->count();
        $processing = Order::whereBetween('created_at', [$from, $to])->where('status', 'processing')->count();
        $shipped    = Order::whereBetween('created_at', [$from, $to])->where('status', 'shipped')->count();
        $delivered  = Order::whereBetween('created_at', [$from, $to])->where('status', 'delivered')->count();
        $cancelled  = Order::whereBetween('created_at', [$from, $to])->where('status', 'cancelled')->count();

        // Recent orders
        $recentOrders = Order::with('items')
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(fn($o) => [
                'id'           => $o->id,
                'order_number' => $o->order_number,
                'customer'     => $o->customer_name,
                'total'        => (float) $o->total,
                'status'       => $o->status,
                'date'         => $o->created_at->toDateTimeString(),
            ]);

        return response()->json([
            'period'  => ['from' => $from, 'to' => $to],
            'summary' => [
                'total'      => $total,
                'pending'    => $pending,
                'processing' => $processing,
                'shipped'    => $shipped,
                'delivered'  => $delivered,
                'cancelled'  => $cancelled,
            ],
            'recent_orders' => $recentOrders,
        ]);
    }

    /**
     * GET /api/reports/customers
     * Customers Report
     */
    public function customers(Request $request): JsonResponse
    {
        $from = $request->get('from', now()->startOfMonth()->toDateString());
        $to   = $request->get('to',   now()->toDateString());

        $totalCustomers = User::whereBetween('created_at', [$from, $to])->count();

        // Top customers by orders
        $topCustomers = Order::whereBetween('created_at', [$from, $to])
            ->select(
                'customer_name',
                'customer_email',
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(total) as total_spent')
            )
            ->groupBy('customer_name', 'customer_email')
            ->orderBy('total_spent', 'desc')
            ->limit(10)
            ->get();

        // New vs returning
        $newCustomers = Order::whereBetween('created_at', [$from, $to])
            ->select('customer_email')
            ->groupBy('customer_email')
            ->havingRaw('COUNT(*) = 1')
            ->count();

        $returningCustomers = Order::whereBetween('created_at', [$from, $to])
            ->select('customer_email')
            ->groupBy('customer_email')
            ->havingRaw('COUNT(*) > 1')
            ->count();

        return response()->json([
            'period'  => ['from' => $from, 'to' => $to],
            'summary' => [
                'total_customers'     => $totalCustomers,
                'new_customers'       => $newCustomers,
                'returning_customers' => $returningCustomers,
            ],
            'top_customers' => $topCustomers,
        ]);
    }

    /**
     * GET /api/reports/products
     * Top Selling Products Report
     */
    public function products(Request $request): JsonResponse
    {
        $from  = $request->get('from', now()->startOfMonth()->toDateString());
        $to    = $request->get('to',   now()->toDateString());
        $limit = (int) $request->get('limit', 10);

        // Top selling products
        $topProducts = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->whereBetween('orders.created_at', [$from, $to])
            ->whereNotIn('orders.status', ['cancelled'])
            ->select(
                'order_items.product_id',
                'order_items.product_name',
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.total) as total_revenue'),
                DB::raw('COUNT(DISTINCT orders.id) as total_orders')
            )
            ->groupBy('order_items.product_id', 'order_items.product_name')
            ->orderBy('total_quantity', 'desc')
            ->limit($limit)
            ->get();

        // Total products sold
        $totalSold = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->whereBetween('orders.created_at', [$from, $to])
            ->whereNotIn('orders.status', ['cancelled'])
            ->sum('order_items.quantity');

        return response()->json([
            'period'  => ['from' => $from, 'to' => $to],
            'summary' => [
                'total_products_sold' => (int) $totalSold,
                'unique_products'     => $topProducts->count(),
            ],
            'top_products' => $topProducts,
        ]);
    }

    /**
     * GET /api/reports/transactions
     * Transactions / Payments Report
     */
    public function transactions(Request $request): JsonResponse
    {
        $from = $request->get('from', now()->startOfMonth()->toDateString());
        $to   = $request->get('to',   now()->toDateString());

        $total     = Transaction::whereBetween('created_at', [$from, $to])->count();
        $completed = Transaction::whereBetween('created_at', [$from, $to])->where('status', 'completed')->count();
        $pending   = Transaction::whereBetween('created_at', [$from, $to])->where('status', 'pending')->count();
        $failed    = Transaction::whereBetween('created_at', [$from, $to])->where('status', 'failed')->count();
        $refunded  = Transaction::whereBetween('created_at', [$from, $to])->where('status', 'refunded')->count();

        $totalAmount    = Transaction::whereBetween('created_at', [$from, $to])->where('status', 'completed')->sum('amount');
        $refundedAmount = Transaction::whereBetween('created_at', [$from, $to])->where('status', 'refunded')->sum('amount');

        // Payment method wise
        $methodWise = Transaction::whereBetween('created_at', [$from, $to])
            ->select(
                'payment_method',
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('payment_method')
            ->get();

        return response()->json([
            'period'  => ['from' => $from, 'to' => $to],
            'summary' => [
                'total'           => $total,
                'completed'       => $completed,
                'pending'         => $pending,
                'failed'          => $failed,
                'refunded'        => $refunded,
                'total_amount'    => (float) $totalAmount,
                'refunded_amount' => (float) $refundedAmount,
                'net_amount'      => (float) ($totalAmount - $refundedAmount),
            ],
            'method_wise' => $methodWise,
        ]);
    }

    /**
     * GET /api/reports/dashboard
     * Dashboard ke liye quick stats
     */
    public function dashboard(): JsonResponse
    {
        $today     = now()->toDateString();
        $thisMonth = now()->startOfMonth()->toDateString();

        return response()->json([
            'today' => [
                'orders'  => Order::whereDate('created_at', $today)->count(),
                'revenue' => (float) Order::whereDate('created_at', $today)->whereNotIn('status', ['cancelled'])->sum('total'),
            ],
            'this_month' => [
                'orders'    => Order::whereBetween('created_at', [$thisMonth, $today])->count(),
                'revenue'   => (float) Order::whereBetween('created_at', [$thisMonth, $today])->whereNotIn('status', ['cancelled'])->sum('total'),
                'customers' => User::whereBetween('created_at', [$thisMonth, $today])->count(),
            ],
            'all_time' => [
                'total_orders'    => Order::count(),
                'total_revenue'   => (float) Order::whereNotIn('status', ['cancelled'])->sum('total'),
                'total_customers' => User::count(),
                'total_products'  => DB::table('products')->count(),
            ],
            'order_status' => [
                'pending'    => Order::where('status', 'pending')->count(),
                'processing' => Order::where('status', 'processing')->count(),
                'shipped'    => Order::where('status', 'shipped')->count(),
                'delivered'  => Order::where('status', 'delivered')->count(),
                'cancelled'  => Order::where('status', 'cancelled')->count(),
            ],
        ]);
    }
}