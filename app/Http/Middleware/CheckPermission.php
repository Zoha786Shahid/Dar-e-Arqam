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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $permission)
    {
        // Ensure the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('root')->with('error', 'You must be logged in to access this page.');
        }

        // Check if the authenticated user has the required permission
        if (!auth()->user()->hasPermissionTo($permission)) {
            return redirect()->route('root')->with('error', 'You do not have permission to access this page.');
        }

        // Proceed to the next request if permission check passes
        return $next($request);
    }
    
    
    
    
}
