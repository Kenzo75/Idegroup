<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
    // Check if user is admin
    if (auth()->check() && auth()->user()->role === 'admin') {
        return $next($request);
    }

    // Redirect user to unauthorized page
        return redirect()->route('user.dashboard');
    }
}
