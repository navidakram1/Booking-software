<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Staff;
use App\Models\User;
use App\Models\Waitlist;
use App\Models\BookingRule;
use App\Models\Gallery;
use App\Models\ServicePackage;
use App\Models\ServiceAddon;
use App\Models\PricingRule;
use Carbon\Carbon;
use App\Events\AppointmentStatusChanged;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function dashboard()
    {
        $now = Carbon::now();
        $lastMonth = $now->copy()->subMonth();

        // Current month metrics
        $currentRevenue = Booking::where('status', 'completed')
            ->whereMonth('appointment_date', $now->month)
            ->whereYear('appointment_date', $now->year)
            ->sum('price');

        $lastMonthRevenue = Booking::where('status', 'completed')
            ->whereMonth('appointment_date', $lastMonth->month)
            ->whereYear('appointment_date', $lastMonth->year)
            ->sum('price');

        $revenueGrowth = $lastMonthRevenue > 0 
            ? (($currentRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 
            : 100;

        // Bookings metrics
        $currentBookings = Booking::whereMonth('appointment_date', $now->month)
            ->whereYear('appointment_date', $now->year)
            ->count();

        $lastMonthBookings = Booking::whereMonth('appointment_date', $lastMonth->month)
            ->whereYear('appointment_date', $lastMonth->year)
            ->count();

        $bookingsGrowth = $lastMonthBookings > 0 
            ? (($currentBookings - $lastMonthBookings) / $lastMonthBookings) * 100 
            : 100;

        // Customer metrics
        $currentCustomers = User::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        $lastMonthCustomers = User::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();

        $customersGrowth = $lastMonthCustomers > 0 
            ? (($currentCustomers - $lastMonthCustomers) / $lastMonthCustomers) * 100 
            : 100;

        // Staff metrics
        $activeStaff = Staff::where('status', 'active')->count();
        $newStaffThisMonth = Staff::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        // Get analytics data
        $analytics = [
            'total_appointments' => Booking::count(),
            'today_appointments' => Booking::whereDate('appointment_date', Carbon::today())->count(),
            'pending_appointments' => Booking::where('status', 'pending')->count(),
            'total_revenue' => Booking::where('status', 'completed')->sum('price'),
            'current_revenue' => $currentRevenue,
            'popular_services' => Service::withCount('bookings')
                ->orderBy('bookings_count', 'desc')
                ->take(5)
                ->get(),
            'top_staff' => Staff::withCount('bookings')
                ->orderBy('bookings_count', 'desc')
                ->take(5)
                ->get()
        ];

        // Get today's appointments
        $todayAppointments = Booking::with(['customer', 'service', 'staff'])
            ->whereDate('appointment_date', Carbon::today())
            ->orderBy('appointment_date')
            ->get();

        // Get recent bookings
        $recentBookings = Booking::with(['customer', 'service'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'analytics',
            'currentRevenue',
            'revenueGrowth',
            'currentBookings',
            'bookingsGrowth',
            'currentCustomers',
            'customersGrowth',
            'activeStaff',
            'newStaffThisMonth',
            'recentBookings',
            'todayAppointments'
        ));
    }

    public function staff()
    {
        $staff = Staff::withCount('bookings')->get();
        return view('admin.staff.index', compact('staff'));
    }

    public function staffCreate()
    {
        $services = Service::all();
        return view('admin.staff.create', compact('services'));
    }

    public function staffStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff',
            'phone' => 'required|string|max:20',
            'role' => 'required|string|max:100',
            'services' => 'required|array',
            'bio' => 'nullable|string',
            'working_hours' => 'required|array'
        ]);

        $staff = Staff::create($request->all());
        $staff->services()->sync($request->services);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff member added successfully');
    }

    public function services()
    {
        $services = Service::withCount('bookings')->get();
        return view('admin.services.index', compact('services'));
    }

    public function serviceCreate()
    {
        return view('admin.services.create');
    }

    public function serviceStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer|min:15',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:100'
        ]);

        Service::create($request->all());

        return redirect()->route('admin.services.index')
            ->with('success', 'Service added successfully');
    }

    public function appointments()
    {
        $appointments = Booking::with(['client', 'staff', 'service'])
            ->orderBy('appointment_date', 'desc')
            ->paginate(20);

        return view('admin.appointments.index', compact('appointments'));
    }

    public function appointmentCreate()
    {
        $services = Service::all();
        $staff = Staff::with('services')->get();
        $customers = User::all();
        
        return view('admin.appointments.create', compact('services', 'staff', 'customers'));
    }

    public function appointmentStore(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:staff,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
            'notes' => 'nullable|string'
        ]);

        // Combine date and time
        $appointmentDateTime = Carbon::parse($request->appointment_date . ' ' . $request->appointment_time);

        // Create the booking
        $booking = Booking::create([
            'user_id' => $request->customer_id,
            'service_id' => $request->service_id,
            'staff_id' => $request->staff_id,
            'appointment_date' => $appointmentDateTime,
            'status' => 'pending',
            'notes' => $request->notes,
            'price' => Service::find($request->service_id)->price
        ]);

        // Fire appointment created event
        event(new AppointmentStatusChanged($booking));

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment created successfully');
    }

    public function appointmentUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $appointment = Booking::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();

        // Send notification
        event(new AppointmentStatusChanged($appointment));

        return back()->with('success', 'Appointment status updated successfully');
    }

    public function reports()
    {
        // Calculate current month's revenue
        $currentRevenue = Booking::where('status', 'completed')
            ->whereMonth('appointment_date', Carbon::now()->month)
            ->whereYear('appointment_date', Carbon::now()->year)
            ->sum('price');

        $monthlyRevenue = Booking::where('status', 'completed')
            ->selectRaw('MONTH(appointment_date) as month, SUM(price) as revenue')
            ->groupBy('month')
            ->get();

        $servicePerformance = Service::withCount('bookings')
            ->withSum('bookings', 'price')
            ->orderBy('bookings_count', 'desc')
            ->get();

        $staffPerformance = Staff::withCount('bookings')
            ->withSum('bookings', 'price')
            ->orderBy('bookings_count', 'desc')
            ->get();

        return view('admin.reports', compact('monthlyRevenue', 'servicePerformance', 'staffPerformance', 'currentRevenue'));
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'business_email' => 'required|email',
            'business_phone' => 'required|string|max:20',
            'business_address' => 'required|string',
            'working_hours' => 'required|array',
            'notification_email' => 'required|email'
        ]);

        // Update settings
        setting([
            'business_name' => $request->business_name,
            'business_email' => $request->business_email,
            'business_phone' => $request->business_phone,
            'business_address' => $request->business_address,
            'working_hours' => $request->working_hours,
            'notification_email' => $request->notification_email
        ])->save();

        return back()->with('success', 'Settings updated successfully');
    }

    public function revenueAnalytics()
    {
        $now = Carbon::now();
        
        // Get daily revenue for current month
        $dailyRevenue = Booking::where('status', 'completed')
            ->whereMonth('appointment_date', $now->month)
            ->whereYear('appointment_date', $now->year)
            ->select(
                DB::raw('DATE(appointment_date) as date'),
                DB::raw('SUM(price) as revenue')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Get monthly revenue for past 12 months
        $monthlyRevenue = Booking::where('status', 'completed')
            ->where('appointment_date', '>=', $now->copy()->subMonths(11))
            ->select(
                DB::raw('YEAR(appointment_date) as year'),
                DB::raw('MONTH(appointment_date) as month'),
                DB::raw('SUM(price) as revenue')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Calculate revenue metrics
        $currentMonthRevenue = $monthlyRevenue->last()->revenue ?? 0;
        $previousMonthRevenue = $monthlyRevenue->reverse()->skip(1)->first()->revenue ?? 0;
        $revenueGrowth = $previousMonthRevenue > 0 
            ? (($currentMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100 
            : 100;

        // Calculate total revenue
        $totalRevenue = Booking::where('status', 'completed')->sum('price');

        // Calculate growth rate
        $growthRate = $revenueGrowth;

        // Calculate average transaction value
        $avgTransaction = Booking::where('status', 'completed')
            ->whereMonth('appointment_date', $now->month)
            ->whereYear('appointment_date', $now->year)
            ->avg('price') ?? 0;

        // Calculate customer LTV
        $customerLTV = DB::table('bookings')
            ->where('status', 'completed')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->select('users.id', DB::raw('AVG(price) as avg_value'))
            ->groupBy('users.id')
            ->avg('avg_value') ?? 0;

        // Get top performing services by revenue
        $topServices = Service::withSum(['bookings' => function($query) {
                $query->where('status', 'completed');
            }], 'price')
            ->orderByDesc('bookings_sum_price')
            ->take(5)
            ->get();

        // Get revenue by payment method
        $revenueByPaymentMethod = Booking::where('status', 'completed')
            ->select('payment_method', DB::raw('SUM(price) as total'))
            ->groupBy('payment_method')
            ->get();

        return view('admin.analytics.revenue', compact(
            'dailyRevenue',
            'monthlyRevenue',
            'currentMonthRevenue',
            'previousMonthRevenue',
            'revenueGrowth',
            'topServices',
            'totalRevenue',
            'growthRate',
            'avgTransaction',
            'customerLTV',
            'revenueByPaymentMethod'
        ));
    }

    public function bookingsAnalytics()
    {
        $now = Carbon::now();
        
        // Get daily bookings for current month
        $dailyBookings = Booking::whereMonth('appointment_date', $now->month)
            ->whereYear('appointment_date', $now->year)
            ->select(
                DB::raw('DATE(appointment_date) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Get monthly bookings for past 12 months
        $monthlyBookings = Booking::where('appointment_date', '>=', $now->copy()->subMonths(11))
            ->select(
                DB::raw('YEAR(appointment_date) as year'),
                DB::raw('MONTH(appointment_date) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Calculate booking metrics
        $currentMonthBookings = $monthlyBookings->last()->count ?? 0;
        $previousMonthBookings = $monthlyBookings->reverse()->skip(1)->first()->count ?? 0;
        $bookingsGrowth = $previousMonthBookings > 0 
            ? (($currentMonthBookings - $previousMonthBookings) / $previousMonthBookings) * 100 
            : 100;

        // Get booking status distribution
        $bookingStatuses = Booking::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        return view('admin.analytics.bookings', compact(
            'dailyBookings',
            'monthlyBookings',
            'currentMonthBookings',
            'previousMonthBookings',
            'bookingsGrowth',
            'bookingStatuses'
        ));
    }

    public function customersAnalytics()
    {
        $now = Carbon::now();
        
        // Get new customers by month
        $monthlyCustomers = User::where('created_at', '>=', $now->copy()->subMonths(11))
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Calculate customer metrics
        $currentMonthCustomers = $monthlyCustomers->last()->count ?? 0;
        $previousMonthCustomers = $monthlyCustomers->reverse()->skip(1)->first()->count ?? 0;
        $customersGrowth = $previousMonthCustomers > 0 
            ? (($currentMonthCustomers - $previousMonthCustomers) / $previousMonthCustomers) * 100 
            : 100;

        // Get top customers by bookings
        $topCustomers = User::withCount('bookings')
            ->withSum(['bookings' => function($query) {
                $query->where('status', 'completed');
            }], 'price')
            ->orderByDesc('bookings_count')
            ->take(10)
            ->get();

        return view('admin.analytics.customers', compact(
            'monthlyCustomers',
            'currentMonthCustomers',
            'previousMonthCustomers',
            'customersGrowth',
            'topCustomers'
        ));
    }

    public function servicesAnalytics()
    {
        // Get service performance metrics
        $services = Service::withCount('bookings')
            ->withSum(['bookings' => function($query) {
                $query->where('status', 'completed');
            }], 'price')
            ->orderByDesc('bookings_count')
            ->get();

        // Calculate average ratings if you have a ratings system
        $serviceRatings = []; // Implement if you have ratings

        return view('admin.analytics.services', compact('services', 'serviceRatings'));
    }

    public function staffAnalytics()
    {
        $now = Carbon::now();
        
        // Get staff performance metrics
        $staff = Staff::withCount(['bookings' => function($query) use ($now) {
                $query->whereMonth('appointment_date', $now->month)
                    ->whereYear('appointment_date', $now->year);
            }])
            ->withSum(['bookings' => function($query) {
                $query->where('status', 'completed');
            }], 'price')
            ->orderByDesc('bookings_count')
            ->get();

        // Calculate average ratings if you have a ratings system
        $staffRatings = []; // Implement if you have ratings

        return view('admin.analytics.staff', compact('staff', 'staffRatings'));
    }

    // Gallery Management Methods
    public function gallery()
    {
        $galleryImages = Gallery::orderBy('order')->get();
        return view('admin.content.gallery', compact('galleryImages'));
    }

    public function galleryAdd(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'description' => 'nullable|string|max:500'
        ]);

        $imagePath = $request->file('image')->store('gallery', 'public');
        
        $maxOrder = Gallery::max('order') ?? 0;
        
        Gallery::create([
            'image' => $imagePath,
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'order' => $maxOrder + 1
        ]);

        return redirect()->back()->with('success', 'Gallery image added successfully');
    }

    public function galleryRemove($id)
    {
        $image = Gallery::findOrFail($id);
        
        // Delete the image file
        if ($image->image) {
            Storage::disk('public')->delete($image->image);
        }
        
        $image->delete();

        return redirect()->back()->with('success', 'Gallery image removed successfully');
    }

    public function galleryReorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*' => 'exists:gallery,id'
        ]);

        foreach ($request->items as $index => $id) {
            Gallery::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    // Booking Rules Methods
    public function bookingRules()
    {
        $rules = BookingRule::with(['service', 'staff'])
            ->orderBy('created_at', 'desc')
            ->get();

        $services = Service::all();
        $staff = Staff::all();

        return view('admin.booking-rules.index', compact('rules', 'services', 'staff'));
    }

    public function bookingRulesStore(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'nullable|exists:services,id',
            'staff_id' => 'nullable|exists:staff,id',
            'day_of_week' => 'nullable|integer|min:0|max:6',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'max_bookings' => 'required|integer|min:0',
            'buffer_time' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $rule = new BookingRule();
        $rule->service_id = $validated['service_id'];
        $rule->staff_id = $validated['staff_id'];
        $rule->day_of_week = $validated['day_of_week'];
        $rule->start_time = $validated['start_time'];
        $rule->end_time = $validated['end_time'];
        $rule->max_bookings = $validated['max_bookings'];
        $rule->buffer_time = $validated['buffer_time'];
        $rule->is_active = $validated['is_active'];
        $rule->save();

        return redirect()->route('admin.booking-rules.index')
            ->with('success', 'Booking rule created successfully');
    }

    public function bookingRulesUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'service_id' => 'nullable|exists:services,id',
            'staff_id' => 'nullable|exists:staff,id',
            'day_of_week' => 'nullable|integer|min:0|max:6',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'max_bookings' => 'required|integer|min:0',
            'buffer_time' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $rule = BookingRule::findOrFail($id);
        $rule->service_id = $validated['service_id'];
        $rule->staff_id = $validated['staff_id'];
        $rule->day_of_week = $validated['day_of_week'];
        $rule->start_time = $validated['start_time'];
        $rule->end_time = $validated['end_time'];
        $rule->max_bookings = $validated['max_bookings'];
        $rule->buffer_time = $validated['buffer_time'];
        $rule->is_active = $validated['is_active'];
        $rule->save();

        return redirect()->route('admin.booking-rules.index')
            ->with('success', 'Booking rule updated successfully');
    }

    public function bookingRulesDestroy($id)
    {
        $rule = BookingRule::findOrFail($id);
        $rule->delete();

        return redirect()->route('admin.booking-rules.index')
            ->with('success', 'Booking rule deleted successfully');
    }

    // Waitlist Methods
    public function waitlist()
    {
        $waitlist = Waitlist::with(['service', 'staff'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $services = Service::all();
        $staff = Staff::all();

        return view('admin.waitlist.index', compact('waitlist', 'services', 'staff'));
    }

    public function waitlistStore(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'nullable|exists:staff,id',
            'preferred_date' => 'required|date|after:today',
            'preferred_time' => 'required',
            'notes' => 'nullable|string'
        ]);

        $waitlist = new Waitlist();
        $waitlist->customer_name = $validated['customer_name'];
        $waitlist->email = $validated['email'];
        $waitlist->phone = $validated['phone'];
        $waitlist->service_id = $validated['service_id'];
        $waitlist->staff_id = $validated['staff_id'];
        $waitlist->preferred_date = Carbon::parse($validated['preferred_date'] . ' ' . $validated['preferred_time']);
        $waitlist->notes = $validated['notes'];
        $waitlist->status = 'pending';
        $waitlist->save();

        return redirect()->route('admin.waitlist.index')
            ->with('success', 'Customer added to waitlist successfully');
    }

    public function waitlistContactAttempt(Request $request, $id)
    {
        $waitlist = Waitlist::findOrFail($id);
        $waitlist->contact_attempts = ($waitlist->contact_attempts ?? 0) + 1;
        $waitlist->last_contact_attempt = now();
        $waitlist->save();

        return redirect()->route('admin.waitlist.index')
            ->with('success', 'Contact attempt recorded successfully');
    }

    public function waitlistUpdateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,contacted,booked,cancelled'
        ]);

        $waitlist = Waitlist::findOrFail($id);
        $waitlist->status = $validated['status'];
        $waitlist->save();

        return redirect()->route('admin.waitlist.index')
            ->with('success', 'Waitlist status updated successfully');
    }

    public function waitlistDestroy($id)
    {
        $waitlist = Waitlist::findOrFail($id);
        $waitlist->delete();

        return redirect()->route('admin.waitlist.index')
            ->with('success', 'Waitlist entry removed successfully');
    }

    // Group Bookings Methods
    public function groupBookings()
    {
        $groupBookings = Booking::where('is_group', true)
            ->with(['customer', 'service', 'staff'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.group-bookings.index', compact('groupBookings'));
    }

    public function groupBookingsCreate()
    {
        $services = Service::where('allows_group', true)->get();
        $staff = Staff::all();
        return view('admin.group-bookings.create', compact('services', 'staff'));
    }

    public function groupBookingsStore(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:staff,id',
            'date' => 'required|date|after:today',
            'time' => 'required',
            'participants' => 'required|integer|min:2',
            'notes' => 'nullable|string'
        ]);

        $booking = new Booking();
        $booking->service_id = $validated['service_id'];
        $booking->staff_id = $validated['staff_id'];
        $booking->appointment_date = Carbon::parse($validated['date'] . ' ' . $validated['time']);
        $booking->participants = $validated['participants'];
        $booking->notes = $validated['notes'];
        $booking->is_group = true;
        $booking->status = 'pending';
        $booking->save();

        return redirect()->route('admin.group-bookings.index')
            ->with('success', 'Group booking created successfully');
    }

    public function groupBookingsShow($id)
    {
        $booking = Booking::where('is_group', true)
            ->with(['customer', 'service', 'staff'])
            ->findOrFail($id);

        return view('admin.group-bookings.show', compact('booking'));
    }

    public function groupBookingsUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:staff,id',
            'date' => 'required|date',
            'time' => 'required',
            'participants' => 'required|integer|min:2',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->service_id = $validated['service_id'];
        $booking->staff_id = $validated['staff_id'];
        $booking->appointment_date = Carbon::parse($validated['date'] . ' ' . $validated['time']);
        $booking->participants = $validated['participants'];
        $booking->notes = $validated['notes'];
        $booking->status = $validated['status'];
        $booking->save();

        event(new AppointmentStatusChanged($booking));

        return redirect()->route('admin.group-bookings.show', $id)
            ->with('success', 'Group booking updated successfully');
    }

    public function groupBookingsDestroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.group-bookings.index')
            ->with('success', 'Group booking deleted successfully');
    }

    // Service Packages Methods
    public function servicePackages()
    {
        $packages = ServicePackage::with('services')->orderBy('created_at', 'desc')->get();
        $services = Service::all();
        return view('admin.services.packages.index', compact('packages', 'services'));
    }

    public function servicePackagesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'services' => 'required|array',
            'services.*' => 'exists:services,id',
            'duration' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ]);

        $package = ServicePackage::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'is_active' => $request->is_active ?? true
        ]);

        $package->services()->attach($request->services);

        return redirect()->back()->with('success', 'Service package created successfully');
    }

    public function servicePackagesUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'services' => 'required|array',
            'services.*' => 'exists:services,id',
            'duration' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ]);

        $package = ServicePackage::findOrFail($id);
        
        $package->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'is_active' => $request->is_active ?? true
        ]);

        $package->services()->sync($request->services);

        return redirect()->back()->with('success', 'Service package updated successfully');
    }

    public function servicePackagesDestroy($id)
    {
        $package = ServicePackage::findOrFail($id);
        $package->services()->detach();
        $package->delete();

        return redirect()->back()->with('success', 'Service package deleted successfully');
    }

    // Service Addons Methods
    public function serviceAddons()
    {
        $addons = ServiceAddon::with('service')->orderBy('created_at', 'desc')->get();
        $services = Service::all();
        return view('admin.services.addons.index', compact('addons', 'services'));
    }

    public function serviceAddonsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'service_id' => 'required|exists:services,id',
            'duration' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ]);

        ServiceAddon::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'service_id' => $request->service_id,
            'duration' => $request->duration,
            'is_active' => $request->is_active ?? true
        ]);

        return redirect()->back()->with('success', 'Service add-on created successfully');
    }

    public function serviceAddonsUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'service_id' => 'required|exists:services,id',
            'duration' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ]);

        $addon = ServiceAddon::findOrFail($id);
        
        $addon->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'service_id' => $request->service_id,
            'duration' => $request->duration,
            'is_active' => $request->is_active ?? true
        ]);

        return redirect()->back()->with('success', 'Service add-on updated successfully');
    }

    public function serviceAddonsDestroy($id)
    {
        $addon = ServiceAddon::findOrFail($id);
        $addon->delete();

        return redirect()->back()->with('success', 'Service add-on deleted successfully');
    }

    // Service Pricing Methods
    public function servicePricing()
    {
        $pricingRules = PricingRule::with(['service', 'staff'])
            ->orderBy('priority', 'desc')
            ->get();
            
        $services = Service::all();
        $staff = Staff::all();
        
        return view('admin.services.pricing', compact('pricingRules', 'services', 'staff'));
    }

    public function servicePricingStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'service_id' => 'nullable|exists:services,id',
            'staff_id' => 'nullable|exists:staff,id',
            'day_of_week' => 'nullable|integer|min:0|max:6',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'priority' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'min_booking_value' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0'
        ]);

        PricingRule::create([
            'name' => $request->name,
            'description' => $request->description,
            'service_id' => $request->service_id,
            'staff_id' => $request->staff_id,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'priority' => $request->priority,
            'is_active' => $request->is_active ?? true,
            'min_booking_value' => $request->min_booking_value,
            'max_discount' => $request->max_discount
        ]);

        return redirect()->back()->with('success', 'Pricing rule created successfully');
    }

    public function servicePricingUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'service_id' => 'nullable|exists:services,id',
            'staff_id' => 'nullable|exists:staff,id',
            'day_of_week' => 'nullable|integer|min:0|max:6',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'priority' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'min_booking_value' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0'
        ]);

        $rule = PricingRule::findOrFail($id);
        
        $rule->update([
            'name' => $request->name,
            'description' => $request->description,
            'service_id' => $request->service_id,
            'staff_id' => $request->staff_id,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'priority' => $request->priority,
            'is_active' => $request->is_active ?? true,
            'min_booking_value' => $request->min_booking_value,
            'max_discount' => $request->max_discount
        ]);

        return redirect()->back()->with('success', 'Pricing rule updated successfully');
    }

    public function servicePricingDestroy($id)
    {
        $rule = PricingRule::findOrFail($id);
        $rule->delete();

        return redirect()->back()->with('success', 'Pricing rule deleted successfully');
    }
}
