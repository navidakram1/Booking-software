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
use App\Http\Controllers\AuthController;

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

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/password/reset', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'reset'])->name('password.update');

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
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
    Route::get('/appointments', [CustomerController::class, 'appointments'])->name('appointments');
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

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Staff Management
    Route::prefix('staff')->name('staff.')->group(function () {
        Route::get('/', [StaffController::class, 'index'])->name('index');
        Route::get('/create', [StaffController::class, 'create'])->name('create');
        Route::post('/', [StaffController::class, 'store'])->name('store');
        Route::get('/{staff}/edit', [StaffController::class, 'edit'])->name('edit');
        Route::put('/{staff}', [StaffController::class, 'update'])->name('update');
        Route::delete('/{staff}', [StaffController::class, 'destroy'])->name('destroy');
        Route::get('/schedule', [StaffController::class, 'schedule'])->name('schedule');
        Route::post('/schedule', [StaffController::class, 'updateSchedule'])->name('schedule.update');
    });

    // Appointments
    Route::prefix('appointments')->name('appointments.')->group(function () {
        Route::get('/', [AppointmentController::class, 'index'])->name('index');
        Route::get('/calendar', [AppointmentController::class, 'calendar'])->name('calendar');
        Route::get('/create', [AppointmentController::class, 'create'])->name('create');
        Route::post('/', [AppointmentController::class, 'store'])->name('store');
        Route::get('/{appointment}/edit', [AppointmentController::class, 'edit'])->name('edit');
        Route::put('/{appointment}', [AppointmentController::class, 'update'])->name('update');
        Route::delete('/{appointment}', [AppointmentController::class, 'destroy'])->name('destroy');
    });

    // Services
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('/create', [ServiceController::class, 'create'])->name('create');
        Route::post('/', [ServiceController::class, 'store'])->name('store');
        Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('edit');
        Route::put('/{service}', [ServiceController::class, 'update'])->name('update');
        Route::delete('/{service}', [ServiceController::class, 'destroy'])->name('destroy');
    });

    // Service Addons
    Route::prefix('service-addons')->name('service-addons.')->group(function () {
        Route::get('/', [ServiceAddonsController::class, 'index'])->name('index');
        Route::get('/create', [ServiceAddonsController::class, 'create'])->name('create');
        Route::post('/', [ServiceAddonsController::class, 'store'])->name('store');
        Route::get('/{addon}/edit', [ServiceAddonsController::class, 'edit'])->name('edit');
        Route::put('/{addon}', [ServiceAddonsController::class, 'update'])->name('update');
        Route::delete('/{addon}', [ServiceAddonsController::class, 'destroy'])->name('destroy');
    });

    // Service Pricing
    Route::prefix('service-pricing')->name('service-pricing.')->group(function () {
        Route::get('/', [ServicePricingController::class, 'index'])->name('index');
        Route::post('/', [ServicePricingController::class, 'store'])->name('store');
        Route::put('/{pricing}', [ServicePricingController::class, 'update'])->name('update');
        Route::delete('/{pricing}', [ServicePricingController::class, 'destroy'])->name('destroy');
    });

    // Service Categories
    Route::prefix('service-categories')->name('service-categories.')->group(function () {
        Route::get('/', [ServiceCategoryController::class, 'index'])->name('index');
        Route::get('/create', [ServiceCategoryController::class, 'create'])->name('create');
        Route::post('/', [ServiceCategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [ServiceCategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [ServiceCategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [ServiceCategoryController::class, 'destroy'])->name('destroy');
        Route::post('/order', [ServiceCategoryController::class, 'updateOrder'])->name('order.update');
    });

    // Staff Schedules
    Route::prefix('staff-schedules')->name('staff-schedules.')->group(function () {
        Route::get('/', [StaffScheduleController::class, 'index'])->name('index');
        Route::get('/create', [StaffScheduleController::class, 'create'])->name('create');
        Route::post('/', [StaffScheduleController::class, 'store'])->name('store');
        Route::get('/{schedule}/edit', [StaffScheduleController::class, 'edit'])->name('edit');
        Route::put('/{schedule}', [StaffScheduleController::class, 'update'])->name('update');
        Route::delete('/{schedule}', [StaffScheduleController::class, 'destroy'])->name('destroy');
    });

    // Customer Management
    Route::prefix('customers')->name('customers.')->group(function () {
        Route::get('/', [AdminCustomerController::class, 'index'])->name('index');
        Route::get('/create', [AdminCustomerController::class, 'create'])->name('create');
        Route::post('/', [AdminCustomerController::class, 'store'])->name('store');
        Route::get('/{customer}/edit', [AdminCustomerController::class, 'edit'])->name('edit');
        Route::put('/{customer}', [AdminCustomerController::class, 'update'])->name('update');
        Route::delete('/{customer}', [AdminCustomerController::class, 'destroy'])->name('destroy');
    });

    // Group Bookings
    Route::prefix('group-bookings')->name('group-bookings.')->group(function () {
        Route::get('/', [GroupBookingController::class, 'index'])->name('index');
        Route::get('/create', [GroupBookingController::class, 'create'])->name('create');
        Route::post('/', [GroupBookingController::class, 'store'])->name('store');
        Route::get('/{booking}/edit', [GroupBookingController::class, 'edit'])->name('edit');
        Route::put('/{booking}', [GroupBookingController::class, 'update'])->name('update');
        Route::delete('/{booking}', [GroupBookingController::class, 'destroy'])->name('destroy');
    });

    // Waitlist
    Route::prefix('waitlist')->name('waitlist.')->group(function () {
        Route::get('/', [WaitlistController::class, 'index'])->name('index');
        Route::post('/', [WaitlistController::class, 'store'])->name('store');
        Route::delete('/{waitlist}', [WaitlistController::class, 'destroy'])->name('destroy');
    });

    // Booking Rules
    Route::prefix('booking-rules')->name('booking-rules.')->group(function () {
        Route::get('/', [BookingRuleController::class, 'index'])->name('index');
        Route::get('/create', [BookingRuleController::class, 'create'])->name('create');
        Route::post('/', [BookingRuleController::class, 'store'])->name('store');
        Route::get('/{rule}/edit', [BookingRuleController::class, 'edit'])->name('edit');
        Route::put('/{rule}', [BookingRuleController::class, 'update'])->name('update');
        Route::delete('/{rule}', [BookingRuleController::class, 'destroy'])->name('destroy');
    });

    // Marketing
    Route::prefix('marketing')->name('marketing.')->group(function () {
        Route::get('/', [AdminMarketingController::class, 'index'])->name('index');
        Route::get('/email', [AdminMarketingController::class, 'email'])->name('email');
        Route::get('/sms', [AdminMarketingController::class, 'sms'])->name('sms');
        Route::get('/campaigns', [AdminMarketingController::class, 'campaigns'])->name('campaigns');
    });

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportsController::class, 'index'])->name('index');
        Route::get('/export', [ReportsController::class, 'export'])->name('export');
        Route::get('/sales', [ReportsController::class, 'sales'])->name('sales');
        Route::get('/customers', [ReportsController::class, 'customers'])->name('customers');
        Route::get('/staff', [ReportsController::class, 'staff'])->name('staff');
        Route::get('/services', [ReportsController::class, 'services'])->name('services');
    });

    // Content Management
    Route::prefix('content')->name('content.')->group(function () {
        Route::get('/pages', [AdminController::class, 'pages'])->name('pages');
        Route::get('/blog', [AdminController::class, 'blog'])->name('blog');
        Route::get('/gallery', [AdminController::class, 'gallery'])->name('gallery');
        Route::get('/testimonials', [AdminController::class, 'testimonials'])->name('testimonials');
    });

    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/general', [AdminController::class, 'generalSettings'])->name('general');
        Route::get('/notifications', [AdminController::class, 'notificationSettings'])->name('notifications');
        Route::get('/integrations', [AdminController::class, 'integrationSettings'])->name('integrations');
        Route::get('/payment', [AdminController::class, 'paymentSettings'])->name('payment');
        Route::get('/security', [AdminController::class, 'securitySettings'])->name('security');
    });

    // Cache Management
    Route::get('/cache', [AdminController::class, 'cache'])->name('cache');
});
