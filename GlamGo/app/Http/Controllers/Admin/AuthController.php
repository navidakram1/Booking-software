<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Notifications\AdminPasswordResetNotification;
use App\Traits\LogsAdminActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use LogsAdminActivity;

    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle admin login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Check rate limiting
        $key = 'admin_login_' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            $this->logAdminActivity(
                'login_attempt',
                'Too many login attempts',
                'failed',
                ['seconds_remaining' => $seconds]
            );
            throw ValidationException::withMessages([
                'email' => ["Too many login attempts. Please try again in {$seconds} seconds."],
            ]);
        }

        RateLimiter::hit($key, 60);

        // Attempt login
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Verify admin role
            if (!$user->isAdmin()) {
                Auth::logout();
                $this->logAdminActivity(
                    'login_attempt',
                    'Non-admin login attempt',
                    'failed',
                    ['email' => $credentials['email']]
                );
                throw ValidationException::withMessages([
                    'email' => ['Unauthorized access. Admin privileges required.'],
                ]);
            }

            // Set admin session with timeout
            Session::put('admin_session', true);
            Session::put('admin_last_activity', now());
            Session::put('admin_session_timeout', config('session.admin_timeout', 30)); // 30 minutes default

            $this->logAdminActivity(
                'login',
                'Admin login successful',
                'success'
            );

            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        $this->logAdminActivity(
            'login_attempt',
            'Invalid credentials',
            'failed',
            ['email' => $credentials['email']]
        );

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    /**
     * Handle admin logout request.
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        
        $this->logAdminActivity(
            'logout',
            'Admin logout',
            'success'
        );

        // Clear admin session
        Session::forget('admin_session');
        Session::forget('admin_last_activity');
        Session::forget('admin_session_timeout');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    /**
     * Show admin password reset form.
     */
    public function showResetForm()
    {
        return view('admin.auth.reset-password');
    }

    /**
     * Handle admin password reset request.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        // Rate limit password reset attempts
        $key = 'admin_password_reset_' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            $this->logAdminActivity(
                'password_reset_attempt',
                'Too many password reset attempts',
                'failed',
                ['seconds_remaining' => $seconds]
            );
            throw ValidationException::withMessages([
                'email' => ["Too many password reset attempts. Please try again in {$seconds} seconds."],
            ]);
        }

        RateLimiter::hit($key, 300); // 5 minutes

        $status = Password::sendResetLink(
            $request->only('email'),
            function ($user) {
                $user->notify(new AdminPasswordResetNotification(Password::createToken($user)));
            }
        );

        if ($status === Password::RESET_LINK_SENT) {
            $this->logAdminActivity(
                'password_reset_request',
                'Password reset link sent',
                'success',
                ['email' => $request->email]
            );
            return back()->with('status', 'Password reset link sent!');
        }

        $this->logAdminActivity(
            'password_reset_request',
            'Failed to send password reset link',
            'failed',
            ['email' => $request->email]
        );

        return back()->withErrors(['email' => __($status)]);
    }

    /**
     * Handle password reset form submission.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                $this->logAdminActivity(
                    'password_reset',
                    'Password reset successful',
                    'success',
                    ['email' => $user->email]
                );
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('admin.login')->with('status', 'Password has been reset!');
        }

        $this->logAdminActivity(
            'password_reset',
            'Password reset failed',
            'failed',
            ['email' => $request->email]
        );

        return back()->withErrors(['email' => __($status)]);
    }

    /**
     * Check admin session timeout.
     */
    public function checkSessionTimeout()
    {
        if (!Session::has('admin_session') || !Session::has('admin_last_activity')) {
            return response()->json(['timeout' => true]);
        }

        $timeout = Session::get('admin_session_timeout', config('session.admin_timeout', 30));
        $lastActivity = Session::get('admin_last_activity');
        $timeoutMinutes = now()->diffInMinutes($lastActivity);

        if ($timeoutMinutes >= $timeout) {
            $this->logAdminActivity(
                'session_timeout',
                'Admin session timed out',
                'success'
            );
            Session::forget('admin_session');
            Session::forget('admin_last_activity');
            Session::forget('admin_session_timeout');
            return response()->json(['timeout' => true]);
        }

        return response()->json(['timeout' => false]);
    }
} 