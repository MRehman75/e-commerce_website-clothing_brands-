<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        // Admin panel routes ko kabhi block nahi karna (warna khud admin bhi lock ho jayega)
        if ($request->is('admin/*') || $request->is('admin')) {
            return $next($request);
        }

        $setting = GeneralSetting::first();

        if ($setting && $setting->maintenance_mode) {
            $allowedIps = array_filter(array_map('trim', explode(',', $setting->maintenance_allowed_ips ?? '')));

            // Agar visitor ki IP allowed list mein nahi hai, to maintenance page dikhao
            if (!in_array($request->ip(), $allowedIps)) {
                return response()->view('maintenance', [
                    'message' => $setting->maintenance_message ?? 'We are under maintenance. Please check back soon.',
                ])->setStatusCode(503);
            }
        }

        return $next($request);
    }
}