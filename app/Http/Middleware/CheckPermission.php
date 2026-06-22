<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    // public function handle(Request $request, Closure $next, string $permission): Response
    // {
    //     // Login nahi hai to login page pe bhejo
    //     if (!auth()->check()) {
    //         return redirect()->route('login');
    //     }

    //     // Permission check karo
    //     if (!auth()->user()->hasPermission($permission)) {
    //         abort(403, 'Aapke paas is page ki ijazat nahi hai.');
    //     }

    //     return $next($request);
    // }
}