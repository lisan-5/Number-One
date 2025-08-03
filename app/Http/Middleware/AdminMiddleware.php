<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // Only allow users with the admin role
        if (!$user || !$user->hasRole('admin')) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
