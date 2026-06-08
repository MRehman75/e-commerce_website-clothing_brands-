<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreMenuRequest;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::with('rootItems');

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }
        if ($request->filled('is_active')) {
            $query->where('is_active', filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN));
        }

        return MenuResource::collection($query->get());
    }

    public function store(StoreMenuRequest $request): JsonResponse
    {
        $menu = Menu::create($request->validated());

        return response()->json([
            'message' => 'Menu ban gaya!',
            'data'    => new MenuResource($menu->load('rootItems')),
        ], 201);
    }

    public function show(Menu $menu): JsonResponse
    {
        return response()->json(['data' => new MenuResource($menu->load('rootItems'))]);
    }

    public function update(StoreMenuRequest $request, Menu $menu): JsonResponse
    {
        $menu->update($request->validated());

        return response()->json([
            'message' => 'Menu update ho gaya!',
            'data'    => new MenuResource($menu->fresh('rootItems')),
        ]);
    }

    public function destroy(Menu $menu): JsonResponse
    {
        $menu->items()->delete();
        $menu->delete();
        return response()->json(['message' => 'Menu delete ho gaya!']);
    }

    // POST /api/menus/{menu}/items - item add karo
    public function addItem(Request $request, Menu $menu): JsonResponse
    {
        $request->validate([
            'label'          => 'required|string|max:100',
            'url'            => 'required|string|max:500',
            'parent_id'      => 'nullable|exists:menu_items,id',
            'icon'           => 'nullable|string|max:100',
            'open_in_new_tab'=> 'boolean',
            'sort_order'     => 'nullable|integer|min:0',
            'is_active'      => 'boolean',
        ]);

        $item = $menu->items()->create($request->all());

        return response()->json([
            'message' => 'Menu item add ho gaya!',
            'data'    => $item,
        ], 201);
    }

    // DELETE /api/menus/{menu}/items/{item}
    public function removeItem(Menu $menu, MenuItem $menuItem): JsonResponse
    {
        $menuItem->children()->delete();
        $menuItem->delete();

        return response()->json(['message' => 'Menu item delete ho gaya!']);
    }

    public function locations(): JsonResponse
    {
        return response()->json(['data' => Menu::locations()]);
    }
}