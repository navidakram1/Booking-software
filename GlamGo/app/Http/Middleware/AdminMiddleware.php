<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    protected $maxAttempts = 5;
    protected $decayMinutes = 1;

    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            Log::warning('Unauthenticated admin access attempt', [
                'ip' => $request->ip(),
                'url' => $request->fullUrl()
            ]);
            return redirect()->route('admin.login');
        }

        // Check if user is admin
        if (!Auth::user()->is_admin) {
            Log::error('Unauthorized admin access attempt', [
                'user_id' => Auth::id(),
                'ip' => $request->ip(),
                'url' => $request->fullUrl()
            ]);
            return redirect()->route('home')->with('error', 'Unauthorized access');
        }

        // Check session expiry
        if (!session()->has('admin_session') || 
            now()->diffInMinutes(session('admin_session')) > 60) {
            Log::warning('Admin session expired', [
                'user_id' => Auth::id(),
                'ip' => $request->ip()
            ]);
            Auth::logout();
            return redirect()->route('admin.login')
                           ->with('error', 'Session expired. Please login again.');
        }

        // Rate limiting
        $key = 'admin_attempts_' . $request->ip();
        $attempts = Cache::get($key, 0) + 1;
        
        if ($attempts > $this->maxAttempts) {
            Log::error('Admin rate limit exceeded', [
                'ip' => $request->ip(),
                'attempts' => $attempts
            ]);
            return response()->json([
                'error' => 'Too many attempts. Please try again later.'
            ], 429);
        }

        Cache::put($key, $attempts, now()->addMinutes($this->decayMinutes));

        try {
            $response = $next($request);
            
            // Log successful access
            Log::info('Admin access granted', [
                'user_id' => Auth::id(),
                'ip' => $request->ip(),
                'url' => $request->fullUrl()
            ]);

            return $response;
        } catch (\Exception $e) {
            Log::error('Admin middleware error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
