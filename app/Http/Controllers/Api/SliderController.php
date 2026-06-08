<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreSliderRequest;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        $query = Slider::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

     // ✅ Yeh karo
$query->orderBy('created_at', 'desc');

        return SliderResource::collection($query->get());
    }

    public function store(StoreSliderRequest $request): JsonResponse
    {
        $slider = Slider::create($request->validated());

        return response()->json([
            'message' => 'Slider ban gaya!',
            'data'    => new SliderResource($slider),
        ], 201);
    }

    public function show(Slider $slider): JsonResponse
    {
        return response()->json(['data' => new SliderResource($slider)]);
    }

    public function update(StoreSliderRequest $request, Slider $slider): JsonResponse
    {
        $slider->update($request->validated());

        return response()->json([
            'message' => 'Slider update ho gaya!',
            'data'    => new SliderResource($slider->fresh()),
        ]);
    }

    public function destroy(Slider $slider): JsonResponse
    {
        $slider->delete();
        return response()->json(['message' => 'Slider delete ho gaya!']);
    }

   public function toggle(Slider $slider): JsonResponse
{
    $slider->update(['is_active' => !$slider->is_active]);
    return response()->json([
        'message' => 'Slider ' . ($slider->fresh()->is_active ? 'active' : 'inactive') . ' ho gaya!',
        'data'    => new SliderResource($slider->fresh()),
    ]);
}
}