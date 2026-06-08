<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreUserRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * GET /api/users
     */
    public function index(Request $request)
    {
        $query = User::with('roles');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('role')) {
            $query->whereHas('roles', fn($q) => $q->where('slug', $request->role));
        }

        $query->orderBy('created_at', 'desc');
        $perPage = min((int) $request->get('per_page', 15), 100);

        return UserResource::collection($query->paginate($perPage));
    }

    /**
     * POST /api/users
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        // Roles assign karo
        if (!empty($data['roles'])) {
            $user->roles()->sync($data['roles']);
        }

        return response()->json([
            'message' => 'User ban gaya!',
            'data'    => new UserResource($user->load('roles')),
        ], 201);
    }

    /**
     * GET /api/users/{id}
     */
    public function show(User $user): JsonResponse
    {
        return response()->json([
            'data' => new UserResource($user->load('roles')),
        ]);
    }

    /**
     * PUT /api/users/{id}
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        // Roles update karo
        if (isset($data['roles'])) {
            $user->roles()->sync($data['roles']);
        }

        return response()->json([
            'message' => 'User update ho gaya!',
            'data'    => new UserResource($user->fresh('roles')),
        ]);
    }

    /**
     * DELETE /api/users/{id}
     */
    public function destroy(User $user): JsonResponse
    {
        if ($user->id === auth()->id()) {
            return response()->json(['message' => 'Aap apna account delete nahi kar sakte.'], 403);
        }

        $user->delete();

        return response()->json(['message' => 'User delete ho gaya!']);
    }

    /**
     * PATCH /api/users/{id}/roles
     * User ko roles assign karo
     */
    public function assignRoles(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'roles'   => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user->roles()->sync($request->roles);

        return response()->json([
            'message' => 'Roles assign ho gaye!',
            'data'    => new UserResource($user->fresh('roles')),
        ]);
    }
}