<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        return redirect('/dashboard')->with('error', 'You are not authorized to access this page.');
    }
}