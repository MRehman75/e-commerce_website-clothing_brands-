<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreRoleRequest;
use App\Http\Requests\Api\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * GET /api/roles
     */
    public function index(Request $request)
    {
        $query = Role::with('permissions');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $query->orderBy('created_at', 'desc');

        return RoleResource::collection($query->get());
    }

    /**
     * POST /api/roles
     */
    public function store(StoreRoleRequest $request): JsonResponse
    {
        $role = Role::create($request->validated());

        if (!empty($request->permissions)) {
            $role->permissions()->sync($request->permissions);
        }

        return response()->json([
            'message' => 'Role ban gaya!',
            'data'    => new RoleResource($role->load('permissions')),
        ], 201);
    }

    /**
     * GET /api/roles/{id}
     */
    public function show(Role $role): JsonResponse
    {
        return response()->json([
            'data' => new RoleResource($role->load('permissions')),
        ]);
    }

    /**
     * PUT /api/roles/{id}
     */
    public function update(UpdateRoleRequest $request, Role $role): JsonResponse
    {
        $role->update($request->validated());

        if (isset($request->permissions)) {
            $role->permissions()->sync($request->permissions);
        }

        return response()->json([
            'message' => 'Role update ho gaya!',
            'data'    => new RoleResource($role->fresh('permissions')),
        ]);
    }

    /**
     * DELETE /api/roles/{id}
     */
    public function destroy(Role $role): JsonResponse
    {
        $role->permissions()->detach();
        $role->users()->detach();
        $role->delete();

        return response()->json(['message' => 'Role delete ho gaya!']);
    }

    /**
     * GET /api/roles/{id}/permissions
     * Role ki permissions dekho
     */
    public function permissions(Role $role): JsonResponse
    {
        return response()->json([
            'data' => $role->permissions,
        ]);
    }

    /**
     * PATCH /api/roles/{id}/permissions
     * Role ko permissions assign karo
     */
    public function assignPermissions(Request $request, Role $role): JsonResponse
    {
        $request->validate([
            'permissions'   => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->permissions()->sync($request->permissions);

        return response()->json([
            'message' => 'Permissions assign ho gayi!',
            'data'    => new RoleResource($role->fresh('permissions')),
        ]);
    }

    /**
     * GET /api/permissions
     * Saari permissions list
     */
    public function allPermissions(): JsonResponse
    {
        $permissions = Permission::orderBy('module')->get()
            ->groupBy('module')
            ->map(fn($perms) => $perms->map(fn($p) => [
                'id'   => $p->id,
                'name' => $p->name,
                'slug' => $p->slug,
            ]));

        return response()->json(['data' => $permissions]);
    }
}