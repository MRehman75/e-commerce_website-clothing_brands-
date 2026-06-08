<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCouponRequest;
use App\Http\Requests\Api\UpdateCouponRequest;
use App\Http\Resources\CouponResource;
use App\Models\Coupon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * GET /api/coupons
     */
    public function index(Request $request)
    {
        $query = Coupon::query();

        // Filter by status
        if ($request->filled('is_active')) {
            $query->where('is_active', filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN));
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Search by code
        if ($request->filled('search')) {
            $query->where('code', 'like', '%' . $request->search . '%');
        }

        $query->orderBy('created_at', 'desc');
        $perPage = min((int) $request->get('per_page', 15), 100);

        return CouponResource::collection($query->paginate($perPage));
    }

    /**
     * POST /api/coupons
     */
    public function store(StoreCouponRequest $request): JsonResponse
    {
        $coupon = Coupon::create($request->validated());

        return response()->json([
            'message' => 'Coupon ban gaya!',
            'data'    => new CouponResource($coupon),
        ], 201);
    }

    /**
     * GET /api/coupons/{id}
     */
    public function show(Coupon $coupon): JsonResponse
    {
        return response()->json([
            'data' => new CouponResource($coupon),
        ]);
    }

    /**
     * PUT /api/coupons/{id}
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon): JsonResponse
    {
        $coupon->update($request->validated());

        return response()->json([
            'message' => 'Coupon update ho gaya!',
            'data'    => new CouponResource($coupon->fresh()),
        ]);
    }

    /**
     * DELETE /api/coupons/{id}
     */
    public function destroy(Coupon $coupon): JsonResponse
    {
        $coupon->delete();

        return response()->json([
            'message' => 'Coupon delete ho gaya!',
        ]);
    }

    /**
     * POST /api/coupons/validate
     * Coupon valid hai ya nahi check karo
     */
    public function validateCoupon(Request $request): JsonResponse
    {
        $request->validate([
            'code'        => 'required|string',
            'order_amount'=> 'required|numeric|min:0',
        ]);

        $coupon = Coupon::where('code', strtoupper($request->code))->first();

        if (!$coupon) {
            return response()->json(['message' => 'Coupon nahi mila.'], 404);
        }

        if (!$coupon->is_active) {
            return response()->json(['message' => 'Coupon active nahi hai.'], 422);
        }

        if ($coupon->end_date && $coupon->end_date->isPast()) {
            return response()->json(['message' => 'Coupon expire ho gaya hai.'], 422);
        }

        if ($coupon->start_date && $coupon->start_date->isFuture()) {
            return response()->json(['message' => 'Coupon abhi start nahi hua.'], 422);
        }

        if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
            return response()->json(['message' => 'Coupon ki limit khatam ho gayi.'], 422);
        }

        if ($coupon->min_order_amount && $request->order_amount < $coupon->min_order_amount) {
            return response()->json([
                'message' => "Minimum order amount {$coupon->min_order_amount} honi chahiye.",
            ], 422);
        }

        // Discount calculate karo
        $discount = 0;
        if ($coupon->type === 'percentage') {
            $discount = ($request->order_amount * $coupon->value) / 100;
            if ($coupon->max_discount) {
                $discount = min($discount, $coupon->max_discount);
            }
        } else {
            $discount = min($coupon->value, $request->order_amount);
        }

        return response()->json([
            'message'  => 'Coupon valid hai!',
            'data'     => new CouponResource($coupon),
            'discount' => round($discount, 2),
            'final_amount' => round($request->order_amount - $discount, 2),
        ]);
    }

    /**
     * POST /api/coupons/apply
     * Coupon apply karo aur used_count update karo
     */
    public function apply(Request $request): JsonResponse
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $coupon = Coupon::where('code', strtoupper($request->code))->first();

        if (!$coupon) {
            return response()->json(['message' => 'Coupon nahi mila.'], 404);
        }

        $coupon->increment('used_count');

        return response()->json([
            'message' => 'Coupon apply ho gaya!',
            'data'    => new CouponResource($coupon->fresh()),
        ]);
    }
}