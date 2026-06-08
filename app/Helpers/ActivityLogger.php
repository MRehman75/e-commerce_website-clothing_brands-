<?php
namespace App\Helpers;

use App\Models\UserActivityLog;

class ActivityLogger
{
    public static function log(string $action, string $module = null, string $description = null)
    {
        UserActivityLog::create([
            'user_id'     => auth()->id(),
            'action'      => $action,
            'module'      => $module,
            'description' => $description,
            'ip_address'  => request()->ip(),
            'user_agent'  => request()->userAgent(),
        ]);
    }
}