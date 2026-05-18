<?php

namespace App\Http\Middleware;

// use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    public function handle($request, Closure $next, $role)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if ((int) auth()->user()->role !== (int) $role) {
            abort(403); // forbidden
        }

        return $next($request);
    }
}
