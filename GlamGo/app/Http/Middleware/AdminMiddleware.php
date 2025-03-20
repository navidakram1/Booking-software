<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use App\Traits\AdminAuditLog;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    use AdminAuditLog;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Allow access to login route
        if ($request->routeIs('login') || $request->routeIs('login.submit')) {
            return $next($request);
        }

        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login to access the admin area.');
        }

        return $next($request);
    }

    /**
     * Check rate limiting
     */
    private function checkRateLimiting(Request $request): bool
    {
        $key = 'login_attempts_'.$request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $this->logSecurityEvent(
                'rate_limit',
                'failure',
                'Too many login attempts',
                ['ip' => $request->ip()]
            );
            return false;
        }
        return true;
    }

    /**
     * Validate session
     */
    private function validateSession(Request $request): bool
    {
        $lastActivity = session('admin_last_activity');
        $timeout = config('session.admin_timeout', 120) * 60;

        if ($lastActivity && time() - $lastActivity > $timeout) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return false;
        }

        return true;
    }

    /**
     * Check role-based access
     */
    private function checkAccess(Request $request, $admin): bool
    {
        $module = $this->getModuleFromRequest($request);
        $action = $this->getActionFromRequest($request);

        // Skip permission check for super_admin
        if ($admin->hasRole('super_admin')) {
            return true;
        }

        // Check module access first
        if (!$admin->hasModuleAccess($module)) {
            $this->logAccessAttempt(
                $module,
                $action,
                false,
                'No module access'
            );
            return false;
        }

        // Then check specific action permission
        if (!$admin->hasPermission($module, $action)) {
            $this->logAccessAttempt(
                $module,
                $action,
                false,
                'No action permission'
            );
            return false;
        }

        return true;
    }

    /**
     * Get module name from request
     */
    private function getModuleFromRequest(Request $request): string
    {
        $path = $request->path();
        $segments = explode('/', $path);
        return $segments[1] ?? 'dashboard'; // After 'admin/'
    }

    /**
     * Get action from request method
     */
    private function getActionFromRequest(Request $request): string
    {
        return match ($request->method()) {
            'GET' => 'view',
            'POST' => 'create',
            'PUT', 'PATCH' => 'edit',
            'DELETE' => 'delete',
            default => 'view'
        };
    }

    /**
     * Handle error response
     */
    private function handleError(
        Request $request,
        string $message,
        string $error,
        int $status
    ): Response {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => $message,
                'error' => $error
            ], $status);
        }

        return redirect()->route('admin.login')
            ->with('error', $message);
    }
}
