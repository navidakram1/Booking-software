<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Maximum number of login attempts allowed
     */
    private const MAX_LOGIN_ATTEMPTS = 5;

    /**
     * Time in minutes to block after max attempts
     */
    private const BLOCK_TIME = 15;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            Log::warning('Unauthenticated admin access attempt', [
                'ip' => $request->ip(),
                'url' => $request->url(),
                'user_agent' => $request->userAgent()
            ]);

            return redirect()->route('admin.login')
                ->with('error', 'Please login to access admin area');
        }

        // Verify admin role
        if (!Auth::user()->isAdmin()) {
            Log::error('Unauthorized admin access attempt', [
                'user_id' => Auth::id(),
                'ip' => $request->ip(),
                'url' => $request->url()
            ]);

            return redirect()->route('admin.login')
                ->with('error', 'Unauthorized access: Admin privileges required');
        }

        // Check admin session
        if (!Session::has('admin_session')) {
            Log::warning('Admin session expired', [
                'user_id' => Auth::id(),
                'ip' => $request->ip()
            ]);

            return redirect()->route('admin.login')
                ->with('error', 'Admin session expired. Please login again');
        }

        // Rate limiting for admin routes
        $key = 'admin_attempts_' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, self::MAX_LOGIN_ATTEMPTS)) {
            $seconds = RateLimiter::availableIn($key);
            
            Log::error('Admin rate limit exceeded', [
                'ip' => $request->ip(),
                'seconds_remaining' => $seconds
            ]);

            return redirect()->route('admin.login')
                ->with('error', "Too many attempts. Please try again in {$seconds} seconds.");
        }

        // Increment rate limiter
        RateLimiter::hit($key, self::BLOCK_TIME * 60);

        // Log successful admin access
        Log::info('Admin access granted', [
            'user_id' => Auth::id(),
            'ip' => $request->ip(),
            'url' => $request->url()
        ]);

        // Add security headers
        $response = $next($request);
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline';");

        return $response;
    }
}
