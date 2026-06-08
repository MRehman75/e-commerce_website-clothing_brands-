<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreBannerRequest;
use App\Http\Requests\Api\UpdateBannerRequest;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $query = Banner::query();

        if ($request->filled('position')) {
            $query->where('position', $request->position);
        }
        if ($request->filled('is_active')) {
            $query->where('is_active', filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN));
        }
        if ($request->filled('active_only')) {
            $query->active();
        }

        $query->orderBy('sort_order')->orderBy('created_at', 'desc');

        return BannerResource::collection($query->get());
    }

    public function store(StoreBannerRequest $request): JsonResponse
    {
        $banner = Banner::create($request->validated());

        return response()->json([
            'message' => 'Banner ban gaya!',
            'data'    => new BannerResource($banner),
        ], 201);
    }

    public function show(Banner $banner): JsonResponse
    {
        return response()->json(['data' => new BannerResource($banner)]);
    }

    public function update(UpdateBannerRequest $request, Banner $banner): JsonResponse
    {
        $banner->update($request->validated());

        return response()->json([
            'message' => 'Banner update ho gaya!',
            'data'    => new BannerResource($banner->fresh()),
        ]);
    }

    public function destroy(Banner $banner): JsonResponse
    {
        $banner->delete();
        return response()->json(['message' => 'Banner delete ho gaya!']);
    }

    public function toggle(Banner $banner): JsonResponse
    {
        $banner->update(['is_active' => !$banner->is_active]);
        return response()->json([
            'message' => 'Banner ' . ($banner->fresh()->is_active ? 'active' : 'inactive') . ' ho gaya!',
            'data'    => new BannerResource($banner->fresh()),
        ]);
    }

    public function positions(): JsonResponse
    {
        return response()->json(['data' => Banner::positions()]);
    }
}