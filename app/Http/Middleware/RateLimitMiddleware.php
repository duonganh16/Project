<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class RateLimitMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $maxAttempts = 60, $decayMinutes = 1): Response
    {
        $key = $request->ip();

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            abort(429, 'Too Many Requests');
        }

        RateLimiter::hit($key, $decayMinutes * 60);

        return $next($request);
    }
}
