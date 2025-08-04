<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Role;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (auth()->check() && auth()->user()->role->name == $role) {
            // dd( $next($request)); // Debugging line to check the role
            return $next($request);
        } else {
            return redirect()->route('homepage')->with('error_msg', 'You do not have permission to access this page.');
        }
    }
}
