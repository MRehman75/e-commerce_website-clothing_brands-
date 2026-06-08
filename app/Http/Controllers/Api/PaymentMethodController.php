<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorePaymentMethodRequest;
use App\Http\Requests\Api\UpdatePaymentMethodRequest;
use App\Http\Resources\PaymentMethodResource;
use App\Models\PaymentMethod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * GET /api/payment-methods
     */
    public function index(Request $request)
    {
        $query = PaymentMethod::query();

        // Filter by active
        if ($request->filled('is_active')) {
            $query->where('is_active', filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN));
        }

        $query->orderBy('sort_order', 'asc');

        return PaymentMethodResource::collection($query->get());
    }

    /**
     * POST /api/payment-methods
     */
    public function store(StorePaymentMethodRequest $request): JsonResponse
    {
        $paymentMethod = PaymentMethod::create($request->validated());

        return response()->json([
            'message' => 'Payment Method ban gaya!',
            'data'    => new PaymentMethodResource($paymentMethod),
        ], 201);
    }

    /**
     * GET /api/payment-methods/{id}
     */
    public function show(PaymentMethod $paymentMethod): JsonResponse
    {
        return response()->json([
            'data' => new PaymentMethodResource($paymentMethod),
        ]);
    }

    /**
     * PUT /api/payment-methods/{id}
     */
    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $paymentMethod): JsonResponse
    {
        $paymentMethod->update($request->validated());

        return response()->json([
            'message' => 'Payment Method update ho gaya!',
            'data'    => new PaymentMethodResource($paymentMethod->fresh()),
        ]);
    }

    /**
     * DELETE /api/payment-methods/{id}
     */
    public function destroy(PaymentMethod $paymentMethod): JsonResponse
    {
        $paymentMethod->delete();

        return response()->json([
            'message' => 'Payment Method delete ho gaya!',
        ]);
    }

    /**
     * PATCH /api/payment-methods/{id}/toggle
     */
    public function toggle(PaymentMethod $paymentMethod): JsonResponse
    {
        $paymentMethod->update(['is_active' => !$paymentMethod->is_active]);

        $state = $paymentMethod->fresh()->is_active ? 'active' : 'inactive';

        return response()->json([
            'message' => "Payment Method {$state} ho gaya!",
            'data'    => new PaymentMethodResource($paymentMethod->fresh()),
        ]);
    }
}