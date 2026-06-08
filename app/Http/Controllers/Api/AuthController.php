<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ✅ POST /api/auth/register
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registered successfully.',
            'token'   => $token,
            'user'    => new UserResource($user),
        ], 201);
    }

    // ✅ POST /api/auth/login
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password.',
            ], 401);
        }

        // Purane tokens delete karo
        $user->tokens()->delete();

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'token'   => $token,
            'user'    => new UserResource($user),
        ], 200);
    }

    // ✅ POST /api/auth/logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully.',
        ], 200);
    }

    // ✅ GET /api/auth/me
    public function me(Request $request)
    {
        return response()->json([
            'success' => true,
            'data'    => new UserResource($request->user()),
        ], 200);
    }

    // ✅ PUT /api/auth/profile
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name'    => 'sometimes|string|min:2|max:255',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $user->update($request->only(['name', 'phone', 'address']));

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully.',
            'data'    => new UserResource($user->fresh()),
        ], 200);
    }

    // ✅ PUT /api/auth/change-password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect.',
            ], 401);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Sare tokens delete karo — re-login zaroori
        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Password changed. Please login again.',
        ], 200);
    }
}