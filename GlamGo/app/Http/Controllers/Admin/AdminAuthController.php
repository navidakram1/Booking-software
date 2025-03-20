<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;
use Carbon\Carbon;

class AdminAuthController extends Controller
{
    public function profile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.index', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($admin->avatar && Storage::exists('public/avatars/' . $admin->avatar)) {
                Storage::delete('public/avatars/' . $admin->avatar);
            }

            // Store new avatar
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/avatars', $filename);
            $validated['avatar'] = $filename;
        }

        $admin->update($validated);

        return redirect()->route('admin.profile')
            ->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($validated['current_password'], $admin->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $admin->update([
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()->route('admin.profile')
            ->with('success', 'Password updated successfully.');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // Implement rate limiting
        $key = 'login_attempts_'.$request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => "Too many login attempts. Please try again in {$seconds} seconds."]);
        }

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            RateLimiter::clear($key);
            
            $request->session()->regenerate();
            session(['admin_last_activity' => time()]);
            
            // Log successful login
            $admin = Auth::guard('admin')->user();
            $admin->update([
                'last_login_at' => now(),
                'last_login_ip' => $request->ip()
            ]);
            
            Log::info('Admin login successful', [
                'admin_id' => $admin->id,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Welcome back, ' . $admin->name);
        }

        // Log failed login attempt
        Log::warning('Failed admin login attempt', [
            'email' => $request->email,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        RateLimiter::hit($key);

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'These credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        $admin_id = Auth::guard('admin')->id();
        
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Log logout
        Log::info('Admin logged out', [
            'admin_id' => $admin_id,
            'ip' => $request->ip()
        ]);

        return redirect()->route('admin.login')
            ->with('success', 'You have been successfully logged out.');
    }

    public function checkSession()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            session(['admin_last_activity' => Carbon::now()]);
            return response()->json(['status' => 'active']);
        }
        return response()->json(['status' => 'expired'], 401);
    }
} 