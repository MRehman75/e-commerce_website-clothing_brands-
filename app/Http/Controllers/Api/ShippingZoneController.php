<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreShippingZoneRequest;
use App\Http\Requests\Api\UpdateShippingZoneRequest;
use App\Http\Resources\ShippingZoneResource;
use App\Models\ShippingZone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShippingZoneController extends Controller
{
    /**
     * GET /api/shipping-zones
     */
    public function index(Request $request)
    {
        $query = ShippingZone::with('shippingMethods');

        if ($request->filled('is_active')) {
            $query->where('is_active', filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN));
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('region', 'like', '%' . $request->search . '%');
        }

        $query->orderBy('created_at', 'desc');
        $perPage = min((int) $request->get('per_page', 15), 100);

        return ShippingZoneResource::collection($query->paginate($perPage));
    }

    /**
     * POST /api/shipping-zones
     */
    public function store(StoreShippingZoneRequest $request): JsonResponse
    {
        $zone = ShippingZone::create($request->validated());

        return response()->json([
            'message' => 'Shipping Zone ban gaya!',
            'data'    => new ShippingZoneResource($zone->load('shippingMethods')),
        ], 201);
    }

    /**
     * GET /api/shipping-zones/{id}
     */
    public function show(ShippingZone $shippingZone): JsonResponse
    {
        return response()->json([
            'data' => new ShippingZoneResource($shippingZone->load('shippingMethods')),
        ]);
    }

    /**
     * PUT /api/shipping-zones/{id}
     */
    public function update(UpdateShippingZoneRequest $request, ShippingZone $shippingZone): JsonResponse
    {
        $shippingZone->update($request->validated());

        return response()->json([
            'message' => 'Shipping Zone update ho gaya!',
            'data'    => new ShippingZoneResource($shippingZone->fresh('shippingMethods')),
        ]);
    }

    /**
     * DELETE /api/shipping-zones/{id}
     */
    public function destroy(ShippingZone $shippingZone): JsonResponse
    {
        $shippingZone->delete();

        return response()->json([
            'message' => 'Shipping Zone delete ho gaya!',
        ]);
    }

    /**
     * PATCH /api/shipping-zones/{id}/toggle
     */
    public function toggle(ShippingZone $shippingZone): JsonResponse
    {
        $shippingZone->update(['is_active' => !$shippingZone->is_active]);

        $state = $shippingZone->fresh()->is_active ? 'active' : 'inactive';

        return response()->json([
            'message' => "Shipping Zone {$state} ho gaya!",
            'data'    => new ShippingZoneResource($shippingZone->fresh('shippingMethods')),
        ]);
    }

    /**
     * GET /api/shipping-zones/calculate
     * Order ke liye shipping rate calculate karo
     */
    public function calculate(Request $request): JsonResponse
    {
        $request->validate([
            'country_code'  => 'required|string|max:5',
            'order_amount'  => 'required|numeric|min:0',
        ]);

        $countryCode = strtoupper($request->country_code);

        // Country ke hisaab se zone dhundo
        $zone = ShippingZone::active()
            ->with('activeMethods')
            ->get()
            ->first(fn($z) => $z->hasCountry($countryCode));

        if (!$zone) {
            return response()->json([
                'message' => 'Is country ke liye koi shipping zone nahi mila.',
            ], 404);
        }

        $methods = $zone->activeMethods->map(fn($method) => [
            'id'                => $method->id,
            'name'              => $method->name,
            'carrier'           => $method->carrier,
            'rate'              => $method->getRateForOrder($request->order_amount),
            'is_free'           => $method->isFreeShipping($request->order_amount),
            'estimated_delivery'=> $method->getEstimatedDelivery(),
        ]);

        return response()->json([
            'zone'    => $zone->name,
            'methods' => $methods,
        ]);
    }
}