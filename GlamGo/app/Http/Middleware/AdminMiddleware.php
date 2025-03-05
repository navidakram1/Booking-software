<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            // Check if user is authenticated
            if (!auth()->check()) {
                Log::warning('Unauthenticated admin access attempt', [
                    'ip' => $request->ip(),
                    'url' => $request->fullUrl()
                ]);
                throw new AuthenticationException('Please login to access admin area');
            }

            $user = auth()->user();

            // Verify admin role
            if (!$user->isAdmin()) {
                Log::error('Unauthorized admin access attempt', [
                    'user_id' => $user->id,
                    'ip' => $request->ip(),
                    'url' => $request->fullUrl()
                ]);
                throw new AuthorizationException('Unauthorized access: Admin privileges required');
            }

            // Validate admin session
            if (!session()->has('admin_session')) {
                Log::warning('Admin session expired', [
                    'user_id' => $user->id,
                    'ip' => $request->ip()
                ]);
                throw new AuthenticationException('Your session has expired. Please login again');
            }

            // Rate limiting check
            $key = 'admin_attempts_' . $request->ip();
            $maxAttempts = 5; // Max attempts per minute
            $attempts = cache()->get($key, 0);

            if ($attempts > $maxAttempts) {
                Log::error('Admin rate limit exceeded', [
                    'ip' => $request->ip(),
                    'attempts' => $attempts
                ]);
                return response()->json([
                    'error' => 'Too many attempts. Please try again later.'
                ], Response::HTTP_TOO_MANY_REQUESTS);
            }

            cache()->put($key, $attempts + 1, 60); // Increment attempts, expire in 60 seconds

            // Audit logging for successful admin access
            Log::info('Admin access granted', [
                'user_id' => $user->id,
                'ip' => $request->ip(),
                'url' => $request->fullUrl(),
                'method' => $request->method()
            ]);

            return $next($request);

        } catch (AuthenticationException $e) {
            return redirect()->route('admin.login')
                ->with('error', $e->getMessage());

        } catch (AuthorizationException $e) {
            return redirect()->route('home')
                ->with('error', 'Unauthorized access to admin area');

        } catch (\Exception $e) {
            Log::error('Admin middleware error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('home')
                ->with('error', 'An unexpected error occurred');
        }
    }
}
