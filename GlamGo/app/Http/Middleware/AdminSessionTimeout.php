<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminSessionTimeout
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $lastActivity = session('admin_last_activity');
            $timeout = config('session.admin_timeout', 120); // 2 hours default

            if ($lastActivity && Carbon::parse($lastActivity)->addMinutes($timeout)->isPast()) {
                Auth::logout();
                session()->flush();
                return redirect()->route('admin.login')->with('error', 'Your session has expired. Please login again.');
            }

            session(['admin_last_activity' => Carbon::now()]);
        }

        return $next($request);
    }
} 