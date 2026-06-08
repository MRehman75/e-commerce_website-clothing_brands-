<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreShippingMethodRequest;
use App\Http\Requests\Api\UpdateShippingMethodRequest;
use App\Http\Resources\ShippingMethodResource;
use App\Models\ShippingMethod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    /**
     * GET /api/shipping-methods
     */
    public function index(Request $request)
    {
        $query = ShippingMethod::with('shippingZone');

        if ($request->filled('is_active')) {
            $query->where('is_active', filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN));
        }

        if ($request->filled('shipping_zone_id')) {
            $query->where('shipping_zone_id', $request->shipping_zone_id);
        }

        if ($request->filled('carrier')) {
            $query->where('carrier', 'like', '%' . $request->carrier . '%');
        }

        if ($request->filled('rate_type')) {
            $query->where('rate_type', $request->rate_type);
        }

        $query->orderBy('created_at', 'desc');
        $perPage = min((int) $request->get('per_page', 15), 100);

        return ShippingMethodResource::collection($query->paginate($perPage));
    }

    /**
     * POST /api/shipping-methods
     */
    public function store(StoreShippingMethodRequest $request): JsonResponse
    {
        $method = ShippingMethod::create($request->validated());

        return response()->json([
            'message' => 'Shipping Method ban gaya!',
            'data'    => new ShippingMethodResource($method->load('shippingZone')),
        ], 201);
    }

    /**
     * GET /api/shipping-methods/{id}
     */
    public function show(ShippingMethod $shippingMethod): JsonResponse
    {
        return response()->json([
            'data' => new ShippingMethodResource($shippingMethod->load('shippingZone')),
        ]);
    }

    /**
     * PUT /api/shipping-methods/{id}
     */
    public function update(UpdateShippingMethodRequest $request, ShippingMethod $shippingMethod): JsonResponse
    {
        $shippingMethod->update($request->validated());

        return response()->json([
            'message' => 'Shipping Method update ho gaya!',
            'data'    => new ShippingMethodResource($shippingMethod->fresh('shippingZone')),
        ]);
    }

    /**
     * DELETE /api/shipping-methods/{id}
     */
    public function destroy(ShippingMethod $shippingMethod): JsonResponse
    {
        $shippingMethod->delete();

        return response()->json([
            'message' => 'Shipping Method delete ho gaya!',
        ]);
    }

    /**
     * PATCH /api/shipping-methods/{id}/toggle
     */
    public function toggle(ShippingMethod $shippingMethod): JsonResponse
    {
        $shippingMethod->update(['is_active' => !$shippingMethod->is_active]);

        $state = $shippingMethod->fresh()->is_active ? 'active' : 'inactive';

        return response()->json([
            'message' => "Shipping Method {$state} ho gaya!",
            'data'    => new ShippingMethodResource($shippingMethod->fresh('shippingZone')),
        ]);
    }
}