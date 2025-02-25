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
        return view('admin.content.pages');
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

    public function notificationSettings()
    {
        return view('admin.settings.notifications');
    }

    public function integrationSettings()
    {
        return view('admin.settings.integrations');
    }

    public function paymentSettings()
    {
        return view('admin.settings.payment');
    }

    public function securitySettings()
    {
        return view('admin.settings.security');
    }

    public function cache()
    {
        return view('admin.cache');
    }
}
