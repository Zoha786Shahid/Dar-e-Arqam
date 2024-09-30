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
        if (!auth()->user()) {
            return redirect()->route('root')->with('error', 'You must be logged in to access this page.');
        }
    
        $user = auth()->user();
    
        // Check for user permissions through the role
        if (!$user->hasPermission($permission)) {
            return redirect()->route('root')->with('error', 'You do not have permission to access this page.');
        }
    
        return $next($request);
    }
    
    
    
    
}
