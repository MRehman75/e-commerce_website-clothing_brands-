<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorePageRequest;
use App\Http\Requests\Api\UpdatePageRequest;
use App\Http\Resources\PageResource;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $query = Page::query();

        if ($request->filled('is_active')) {
            $query->where('is_active', filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN));
        }
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $query->orderBy('created_at', 'desc');

        return PageResource::collection($query->get());
    }

    public function store(StorePageRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);

        $page = Page::create($data);

        return response()->json([
            'message' => 'Page ban gayi!',
            'data'    => new PageResource($page),
        ], 201);
    }

    public function show(Page $page): JsonResponse
    {
        return response()->json(['data' => new PageResource($page)]);
    }

    public function update(UpdatePageRequest $request, Page $page): JsonResponse
    {
        if ($page->is_fixed && $request->has('slug')) {
            return response()->json(['message' => 'Fixed page ka slug change nahi ho sakta.'], 403);
        }

        $page->update($request->validated());

        return response()->json([
            'message' => 'Page update ho gayi!',
            'data'    => new PageResource($page->fresh()),
        ]);
    }

    public function destroy(Page $page): JsonResponse
    {
        if ($page->is_fixed) {
            return response()->json(['message' => 'Fixed page delete nahi ho sakta.'], 403);
        }

        $page->delete();
        return response()->json(['message' => 'Page delete ho gayi!']);
    }

    public function toggle(Page $page): JsonResponse
    {
        $page->update(['is_active' => !$page->is_active]);
        return response()->json([
            'message' => 'Page ' . ($page->fresh()->is_active ? 'active' : 'inactive') . ' ho gayi!',
            'data'    => new PageResource($page->fresh()),
        ]);
    }
}