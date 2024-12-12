<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function general()
    {
        return view('admin.settings.general');
    }

    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string|max:1000',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'business_hours' => 'required|array',
            'social_media' => 'nullable|array',
        ]);

        // Save settings to database or config
        foreach ($validated as $key => $value) {
            setting([$key => $value])->save();
        }

        return redirect()->back()->with('success', 'Settings updated successfully');
    }

    public function notifications()
    {
        return view('admin.settings.notifications');
    }

    public function updateNotifications(Request $request)
    {
        $validated = $request->validate([
            'email_notifications' => 'boolean',
            'sms_notifications' => 'boolean',
            'push_notifications' => 'boolean',
            'notification_email' => 'required_if:email_notifications,true|email',
            'notification_phone' => 'required_if:sms_notifications,true|string|max:20',
        ]);

        foreach ($validated as $key => $value) {
            setting([$key => $value])->save();
        }

        return redirect()->back()->with('success', 'Notification settings updated successfully');
    }

    public function appearance()
    {
        return view('admin.settings.appearance');
    }

    public function updateAppearance(Request $request)
    {
        $validated = $request->validate([
            'theme_color' => 'required|string',
            'font_family' => 'required|string',
            'logo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|max:1024',
            'custom_css' => 'nullable|string',
            'custom_js' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('public/settings');
            $validated['logo'] = $logoPath;
        }

        if ($request->hasFile('favicon')) {
            $faviconPath = $request->file('favicon')->store('public/settings');
            $validated['favicon'] = $faviconPath;
        }

        foreach ($validated as $key => $value) {
            setting([$key => $value])->save();
        }

        return redirect()->back()->with('success', 'Appearance settings updated successfully');
    }

    public function booking()
    {
        return view('admin.settings.booking');
    }

    public function updateBooking(Request $request)
    {
        $validated = $request->validate([
            'booking_interval' => 'required|integer|min:15',
            'min_advance_time' => 'required|integer|min:0',
            'max_advance_time' => 'required|integer|min:1',
            'cancellation_period' => 'required|integer|min:0',
            'allow_guest_booking' => 'boolean',
            'require_deposit' => 'boolean',
            'deposit_amount' => 'required_if:require_deposit,true|numeric|min:0',
        ]);

        foreach ($validated as $key => $value) {
            setting([$key => $value])->save();
        }

        return redirect()->back()->with('success', 'Booking settings updated successfully');
    }

    public function staff()
    {
        return view('admin.settings.staff');
    }

    public function updateStaff(Request $request)
    {
        $validated = $request->validate([
            'allow_staff_login' => 'boolean',
            'staff_can_manage_schedule' => 'boolean',
            'staff_can_view_reports' => 'boolean',
            'staff_commission_type' => 'required|in:fixed,percentage',
            'staff_commission_value' => 'required|numeric|min:0',
        ]);

        foreach ($validated as $key => $value) {
            setting([$key => $value])->save();
        }

        return redirect()->back()->with('success', 'Staff settings updated successfully');
    }

    public function payments()
    {
        return view('admin.settings.payments');
    }

    public function updatePayments(Request $request)
    {
        $validated = $request->validate([
            'currency' => 'required|string|size:3',
            'stripe_key' => 'required_if:payment_gateway,stripe|string',
            'stripe_secret' => 'required_if:payment_gateway,stripe|string',
            'paypal_client_id' => 'required_if:payment_gateway,paypal|string',
            'paypal_secret' => 'required_if:payment_gateway,paypal|string',
            'payment_gateway' => 'required|in:stripe,paypal,both',
            'tax_rate' => 'required|numeric|min:0|max:100',
        ]);

        foreach ($validated as $key => $value) {
            setting([$key => $value])->save();
        }

        return redirect()->back()->with('success', 'Payment settings updated successfully');
    }

    public function integrations()
    {
        return view('admin.settings.integrations');
    }

    public function updateIntegrations(Request $request)
    {
        $validated = $request->validate([
            'google_analytics_id' => 'nullable|string',
            'facebook_pixel_id' => 'nullable|string',
            'mailchimp_api_key' => 'nullable|string',
            'mailchimp_list_id' => 'nullable|string',
            'twilio_sid' => 'nullable|string',
            'twilio_token' => 'nullable|string',
            'twilio_from' => 'nullable|string',
        ]);

        foreach ($validated as $key => $value) {
            setting([$key => $value])->save();
        }

        return redirect()->back()->with('success', 'Integration settings updated successfully');
    }
}
