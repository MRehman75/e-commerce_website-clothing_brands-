<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreFlashSaleRequest;
use App\Http\Requests\Api\UpdateFlashSaleRequest;
use App\Http\Resources\FlashSaleResource;
use App\Models\FlashSale;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    /**
     * GET /api/flash-sales
     */
    public function index(Request $request)
    {
        $query = FlashSale::query();

        // Filter by active
        if ($request->filled('is_active')) {
            $query->where('is_active', filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN));
        }

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $query->orderBy('created_at', 'desc');
        $perPage = min((int) $request->get('per_page', 15), 100);

        return FlashSaleResource::collection($query->paginate($perPage));
    }

    /**
     * POST /api/flash-sales
     */
    public function store(StoreFlashSaleRequest $request): JsonResponse
    {
        $flashSale = FlashSale::create($request->validated());

        return response()->json([
            'message' => 'Flash Sale ban gayi!',
            'data'    => new FlashSaleResource($flashSale),
        ], 201);
    }

    /**
     * GET /api/flash-sales/{id}
     */
    public function show(FlashSale $flashSale): JsonResponse
    {
        return response()->json([
            'data' => new FlashSaleResource($flashSale),
        ]);
    }

    /**
     * PUT /api/flash-sales/{id}
     */
    public function update(UpdateFlashSaleRequest $request, FlashSale $flashSale): JsonResponse
    {
        $flashSale->update($request->validated());

        return response()->json([
            'message' => 'Flash Sale update ho gayi!',
            'data'    => new FlashSaleResource($flashSale->fresh()),
        ]);
    }

    /**
     * DELETE /api/flash-sales/{id}
     */
    public function destroy(FlashSale $flashSale): JsonResponse
    {
        $flashSale->delete();

        return response()->json([
            'message' => 'Flash Sale delete ho gayi!',
        ]);
    }

    /**
     * GET /api/flash-sales/active
     * Abhi chal rahi flash sales
     */
    public function active(): JsonResponse
    {
        $now = now();

        $flashSales = FlashSale::where('is_active', true)
            ->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->orderBy('end_time', 'asc')
            ->get();

        return response()->json([
            'data' => FlashSaleResource::collection($flashSales),
        ]);
    }

    /**
     * PATCH /api/flash-sales/{id}/toggle
     * Active/Inactive toggle karo
     */
    public function toggle(FlashSale $flashSale): JsonResponse
    {
        $flashSale->update(['is_active' => !$flashSale->is_active]);

        $state = $flashSale->fresh()->is_active ? 'active' : 'inactive';

        return response()->json([
            'message' => "Flash Sale {$state} ho gayi!",
            'data'    => new FlashSaleResource($flashSale->fresh()),
        ]);
    }
}