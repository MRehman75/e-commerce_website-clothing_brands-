<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * GET /api/orders
     * Saare orders list karo (paginated + filters)
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Order::with('items', 'user');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment_status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Filter by user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Search by order_number, customer_name, customer_email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }

        // Sort
        $sortBy    = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $allowedSorts = ['created_at', 'total', 'status', 'order_number'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder === 'asc' ? 'asc' : 'desc');
        }

        $perPage = min((int) $request->get('per_page', 15), 100);

        return OrderResource::collection($query->paginate($perPage));
    }

    /**
     * POST /api/orders
     * Naya order banao
     */
    public function store(StoreOrderRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Auto-generate order number agar nahi diya
        $data['order_number'] = $data['order_number']
            ?? 'ORD-' . strtoupper(Str::random(8));

        $order = Order::create([
            'order_number'    => $data['order_number'],
            'user_id'         => $data['user_id'] ?? auth()->id(),
            'customer_name'   => $data['customer_name'],
            'customer_email'  => $data['customer_email'],
            'customer_phone'  => $data['customer_phone'] ?? null,
            'shipping_address'=> $data['shipping_address'],
            'billing_address' => $data['billing_address'] ?? $data['shipping_address'],
            'subtotal'        => $data['subtotal'],
            'tax'             => $data['tax'] ?? 0,
            'shipping_cost'   => $data['shipping_cost'] ?? 0,
            'discount'        => $data['discount'] ?? 0,
            'total'           => $data['total'],
            'payment_method'  => $data['payment_method'],
            'payment_status'  => $data['payment_status'] ?? 'pending',
            'status'          => $data['status'] ?? 'pending',
            'notes'           => $data['notes'] ?? null,
        ]);

        // Order items save karo
        if (!empty($data['items'])) {
            foreach ($data['items'] as $item) {
                $order->items()->create([
                    'product_id'   => $item['product_id'] ?? null,
                    'product_name' => $item['product_name'],
                    'product_sku'  => $item['product_sku'] ?? null,
                    'quantity'     => $item['quantity'],
                    'price'        => $item['price'],
                    'total'        => $item['quantity'] * $item['price'],
                ]);
            }
        }

        return response()->json([
            'message' => 'Order successfully ban gaya.',
            'data'    => new OrderResource($order->load('items', 'user')),
        ], 201);
    }

    /**
     * GET /api/orders/{id}
     * Ek order ki detail
     */
    public function show(Order $order): JsonResponse
    {
        return response()->json([
            'data' => new OrderResource($order->load('items', 'user')),
        ]);
    }

    /**
     * PUT/PATCH /api/orders/{id}
     * Order update karo
     */
    public function update(UpdateOrderRequest $request, Order $order): JsonResponse
    {
        $data = $request->validated();

        $order->update($data);

        return response()->json([
            'message' => 'Order update ho gaya.',
            'data'    => new OrderResource($order->fresh('items', 'user')),
        ]);
    }

    /**
     * DELETE /api/orders/{id}
     * Order delete karo
     */
    public function destroy(Order $order): JsonResponse
    {
        // Pehle items delete karo
        $order->items()->delete();
        $order->delete();

        return response()->json([
            'message' => 'Order delete ho gaya.',
        ]);
    }

    /**
     * PATCH /api/orders/{id}/status
     * Sirf status update karo
     */
    public function updateStatus(Request $request, Order $order): JsonResponse
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return response()->json([
            'message' => "Order status '{$request->status}' ho gaya.",
            'data'    => new OrderResource($order->fresh('items', 'user')),
        ]);
    }

    /**
     * PATCH /api/orders/{id}/payment-status
     * Sirf payment status update karo
     */
    public function updatePaymentStatus(Request $request, Order $order): JsonResponse
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed,refunded',
        ]);

        $order->update(['payment_status' => $request->payment_status]);

        return response()->json([
            'message' => "Payment status '{$request->payment_status}' ho gaya.",
            'data'    => new OrderResource($order->fresh('items', 'user')),
        ]);
    }
}