<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityLogResource;
use App\Models\UserActivityLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * GET /api/activity-logs
     */
    public function index(Request $request)
    {
        $query = UserActivityLog::with('user');

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        if ($request->filled('search')) {
            $query->where('description', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        $query->orderBy('created_at', 'desc');
        $perPage = min((int) $request->get('per_page', 20), 100);

        return ActivityLogResource::collection($query->paginate($perPage));
    }

    /**
     * GET /api/activity-logs/{id}
     */
    public function show(UserActivityLog $activityLog): JsonResponse
    {
        return response()->json([
            'data' => new ActivityLogResource($activityLog->load('user')),
        ]);
    }

    /**
     * DELETE /api/activity-logs/{id}
     */
    public function destroy(UserActivityLog $activityLog): JsonResponse
    {
        $activityLog->delete();

        return response()->json(['message' => 'Log delete ho gaya!']);
    }

    /**
     * DELETE /api/activity-logs/clear
     * Saare logs clear karo
     */
    public function clear(Request $request): JsonResponse
    {
        $query = UserActivityLog::query();

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $count = $query->count();
        $query->delete();

        return response()->json([
            'message' => "{$count} logs delete ho gaye!",
        ]);
    }
}