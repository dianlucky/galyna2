<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Jika belum login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You must login first');
        }

        // Jika role sesuai
        if (Auth::user()->role === $role) {
            return $next($request);
        }

        // Jika role tidak sesuai
        return redirect('/')->with('error', 'You are not authorized to access this page');
    }
}
