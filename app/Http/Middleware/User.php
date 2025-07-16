<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //        check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('auth.login')->with("error", "You must be logged in to access this page.");
        }
        if (auth()->check() && auth()->user()->role !== 'user') {
                return redirect()->back()->with('error', 'Your account cannot using this feature!');
        }
        return $next($request);
    }
}
