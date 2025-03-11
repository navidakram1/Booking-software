<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\SpecialistsController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\DB;

// Admin Controllers
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceAddonsController;
use App\Http\Controllers\Admin\ServicePricingController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\GroupBookingController;
use App\Http\Controllers\Admin\WaitlistController;
use App\Http\Controllers\Admin\BookingRuleController;
use App\Http\Controllers\Admin\MarketingController as AdminMarketingController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\StaffScheduleController;
use App\Http\Controllers\Admin\ServicePackageController;
use App\Http\Controllers\Admin\RevenueController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ContentPageController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\BookingsController as AdminBookingsController;

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest routes (login only)
    Route::middleware(['web', 'guest:admin'])->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AuthController::class, 'login']);
    });

    // Authenticated admin routes
    Route::middleware(['web', 'auth:admin'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Session check
        Route::post('check-session', [AdminAuthController::class, 'checkSession'])->name('check-session');
        
        // Content Pages
        Route::resource('content/pages', ContentPageController::class)->names('content.pages');
        
        // Bookings
        Route::resource('bookings', AdminBookingsController::class)->names('bookings');
        Route::get('bookings/export', [AdminBookingsController::class, 'export'])->name('bookings.export');
        Route::post('bookings/{booking}/status', [AdminBookingsController::class, 'updateStatus'])->name('bookings.status');
        Route::post('bookings/{booking}/reschedule', [AdminBookingsController::class, 'reschedule'])->name('bookings.reschedule');
        
        // Appointments
        Route::resource('appointments', AppointmentController::class);
        Route::get('appointments/export', [AppointmentController::class, 'export'])->name('appointments.export');
        Route::post('appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.status');
        Route::post('appointments/{appointment}/reschedule', [AppointmentController::class, 'reschedule'])->name('appointments.reschedule');
        
        // Services
        Route::resource('services', ServiceController::class);
        
        // Staff
        Route::resource('staff', StaffController::class);
        
        // Customers
        Route::resource('customers', CustomerController::class);
        
        // Analytics
        Route::get('analytics/revenue', [DashboardController::class, 'revenueAnalytics'])->name('analytics.revenue');
        Route::get('analytics/revenue/export', [DashboardController::class, 'exportRevenueAnalytics'])->name('analytics.revenue.export');
    });
});

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/services/{service}', [ServicesController::class, 'show'])->name('services.show');
Route::get('/specialists', [SpecialistsController::class, 'index'])->name('specialists');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/help', [HelpController::class, 'index'])->name('help');

// Legal routes
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/cookies', [HomeController::class, 'cookies'])->name('cookies');

// Contact routes
Route::prefix('contact')->name('contact.')->group(function () {
    Route::post('/send', [ContactController::class, 'sendContact'])->name('send');
});

// Customer routes
Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [CustomerController::class, 'profile'])->name('profile');
    Route::get('/bookings', [CustomerController::class, 'bookings'])->name('bookings');
    Route::get('/reviews', [CustomerController::class, 'reviews'])->name('reviews');
    Route::get('/favorites', [CustomerController::class, 'favorites'])->name('favorites');
});

// Booking routes
Route::prefix('booking')->name('booking.')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('index');
    Route::post('/', [BookingController::class, 'store'])->name('store');
    Route::get('/specialists/{serviceId}', [BookingController::class, 'getSpecialists'])->name('specialists');
    Route::get('/time-slots', [BookingController::class, 'getAvailableTimeSlots'])->name('timeSlots');
});

// Temporary debug route - REMOVE IN PRODUCTION
Route::get('/debug-admin', function () {
    $admin = DB::table('admins')->where('email', 'admin@glamgo.com')->first();
    dd([
        'exists' => !is_null($admin),
        'email' => $admin->email ?? null,
        'password_length' => strlen($admin->password ?? ''),
    ]);
});
