<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Revenue;
use App\Models\Staff;
use App\Models\Service;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function revenue()
    {
        $revenue = Revenue::latest()->paginate(10);
        return view('admin.revenue.index', compact('revenue'));
    }

    public function revenueAnalytics()
    {
        return view('admin.revenue.analytics');
    }

    public function revenueReports()
    {
        return view('admin.revenue.reports');
    }

    public function transactions()
    {
        return view('admin.revenue.transactions');
    }

    public function bookings()
    {
        $bookings = Booking::with(['customer', 'service', 'staff'])
            ->latest()
            ->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function createBooking()
    {
        $services = Service::all();
        $staff = Staff::all();
        return view('admin.bookings.create', compact('services', 'staff'));
    }

    public function storeBooking(Request $request)
    {
        // Validate and store booking
        return redirect()->route('admin.bookings.index');
    }

    public function editBooking(Booking $booking)
    {
        $services = Service::all();
        $staff = Staff::all();
        return view('admin.bookings.edit', compact('booking', 'services', 'staff'));
    }

    public function updateBooking(Request $request, Booking $booking)
    {
        // Validate and update booking
        return redirect()->route('admin.bookings.index');
    }

    public function destroyBooking(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index');
    }

    public function content()
    {
        return view('admin.content.index');
    }

    public function pages()
    {
        return view('admin.content.pages.index');
    }

    public function blog()
    {
        return view('admin.content.blog');
    }

    public function gallery()
    {
        return view('admin.content.gallery');
    }

    public function testimonials()
    {
        return view('admin.content.testimonials');
    }

    public function settings()
    {
        return view('admin.settings.index');
    }

    public function generalSettings()
    {
        return view('admin.settings.general');
    }

    public function updateGeneralSettings(Request $request)
    {
        $validated = $request->validate([
            'salon_name' => 'required|string|max:255',
            'salon_email' => 'required|email',
            'salon_phone' => 'required|string|max:20',
            'salon_address' => 'required|string',
            'business_hours' => 'required|array',
            'timezone' => 'required|string',
            'currency' => 'required|string|size:3',
            'date_format' => 'required|string',
            'time_format' => 'required|string',
            'language' => 'required|string|size:2',
        ]);

        // Update settings in the database
        foreach ($validated as $key => $value) {
            setting([$key => $value]);
        }

        return redirect()
            ->route('admin.settings.general')
            ->with('success', 'General settings updated successfully');
    }

    public function notificationSettings()
    {
        return view('admin.settings.notifications');
    }

    public function integrationSettings()
    {
        return view('admin.settings.integrations');
    }

    public function updateIntegrationSettings(Request $request)
    {
        $validated = $request->validate([
            'google_analytics_id' => 'nullable|string|max:50',
            'facebook_pixel_id' => 'nullable|string|max:50',
            'google_maps_api_key' => 'nullable|string|max:100',
            'social_facebook' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_linkedin' => 'nullable|url|max:255',
            'mailchimp_api_key' => 'nullable|string|max:100',
            'mailchimp_list_id' => 'nullable|string|max:50',
            'twilio_account_sid' => 'nullable|string|max:100',
            'twilio_auth_token' => 'nullable|string|max:100',
            'twilio_phone_number' => 'nullable|string|max:20'
        ]);

        // Update settings in the database
        foreach ($validated as $key => $value) {
            setting([$key => $value]);
        }

        return redirect()
            ->route('admin.settings.integrations')
            ->with('success', 'Integration settings updated successfully');
    }

    public function paymentSettings()
    {
        return view('admin.settings.payment');
    }

    public function updatePaymentSettings(Request $request)
    {
        $validated = $request->validate([
            'accept_cash' => 'boolean',
            'accept_cards' => 'boolean',
            'accept_online' => 'boolean',
            'currency' => 'required|string|size:3',
            'currency_symbol_position' => 'required|in:before,after',
            'invoice_prefix' => 'nullable|string|max:10',
            'invoice_footer_text' => 'nullable|string|max:1000'
        ]);

        // Update settings in the database
        foreach ($validated as $key => $value) {
            setting([$key => $value]);
        }

        return redirect()
            ->route('admin.settings.payment')
            ->with('success', 'Payment settings updated successfully');
    }

    public function securitySettings()
    {
        return view('admin.settings.security');
    }

    public function updateSecuritySettings(Request $request)
    {
        $validated = $request->validate([
            'require_uppercase' => 'boolean',
            'require_numbers' => 'boolean',
            'require_symbols' => 'boolean',
            'min_password_length' => 'required|integer|min:8|max:32',
            'enable_2fa' => 'boolean',
            'force_password_change' => 'boolean',
            'max_login_attempts' => 'required|integer|min:3|max:10',
            'lockout_duration' => 'required|integer|min:5|max:1440',
            'session_timeout' => 'required|integer|min:5|max:1440',
            'force_https' => 'boolean'
        ]);

        // Update settings in the database
        foreach ($validated as $key => $value) {
            setting([$key => $value]);
        }

        return redirect()
            ->route('admin.settings.security')
            ->with('success', 'Security settings updated successfully');
    }

    public function cache()
    {
        // Clear various caches
        \Artisan::call('cache:clear');
        \Artisan::call('view:clear');
        \Artisan::call('config:clear');
        \Artisan::call('route:clear');

        return redirect()
            ->back()
            ->with('success', 'Cache cleared successfully');
    }

    public function profile()
    {
        return view('admin.profile.index');
    }

    public function editProfile()
    {
        return view('admin.profile.edit');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return redirect()
            ->route('admin.profile.index')
            ->with('success', 'Profile updated successfully');
    }

    public function password()
    {
        return view('admin.profile.password');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        auth()->user()->update([
            'password' => bcrypt($validated['password'])
        ]);

        return redirect()
            ->route('admin.profile.password')
            ->with('success', 'Password updated successfully');
    }
}
