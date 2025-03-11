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
        Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AdminAuthController::class, 'login']);
    });

    // Authenticated admin routes
    Route::middleware(['web', 'auth:admin'])->group(function () {
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Profile routes
        Route::get('/profile', [AdminAuthController::class, 'profile'])->name('profile');
        Route::put('/profile', [AdminAuthController::class, 'updateProfile'])->name('profile.update');
        Route::put('/profile/password', [AdminAuthController::class, 'updatePassword'])->name('profile.password');
        
        // Session check
        Route::post('check-session', [AdminAuthController::class, 'checkSession'])->name('check-session');
        
        // Content Pages
        Route::resource('content/pages', ContentPageController::class)->names('content.pages');
        
        // Bookings Management
        Route::prefix('bookings')->name('bookings.')->group(function () {
            Route::get('/', [AdminBookingsController::class, 'index'])->name('index');
            Route::get('/calendar', [AdminBookingsController::class, 'calendar'])->name('calendar');
            Route::get('/list', [AdminBookingsController::class, 'list'])->name('list');
            Route::get('/pending', [AdminBookingsController::class, 'pending'])->name('pending');
            Route::get('/create', [AdminBookingsController::class, 'create'])->name('create');
            Route::post('/', [AdminBookingsController::class, 'store'])->name('store');
            Route::get('/{booking}', [AdminBookingsController::class, 'show'])->name('show');
            Route::get('/{booking}/edit', [AdminBookingsController::class, 'edit'])->name('edit');
            Route::put('/{booking}', [AdminBookingsController::class, 'update'])->name('update');
            Route::delete('/{booking}', [AdminBookingsController::class, 'destroy'])->name('destroy');
            Route::post('/{booking}/status', [AdminBookingsController::class, 'updateStatus'])->name('status');
            Route::post('/{booking}/reschedule', [AdminBookingsController::class, 'reschedule'])->name('reschedule');
            Route::get('/export', [AdminBookingsController::class, 'export'])->name('export');
            
            // Calendar specific routes
            Route::get('/calendar/events', [AdminBookingsController::class, 'getCalendarEvents'])->name('calendar.events');
            Route::post('/calendar/move', [AdminBookingsController::class, 'moveCalendarEvent'])->name('calendar.move');
            Route::post('/calendar/resize', [AdminBookingsController::class, 'resizeCalendarEvent'])->name('calendar.resize');
        });
        
        // Services
        Route::resource('services', ServiceController::class);
        Route::get('services/categories', [ServiceController::class, 'categories'])->name('services.categories');
        Route::get('services/offers', [ServiceController::class, 'offers'])->name('services.offers');
        Route::get('services/catalog', [ServiceController::class, 'catalog'])->name('services.catalog');
        
        // Staff
        Route::prefix('staff')->name('staff.')->group(function () {
            Route::get('/', [StaffController::class, 'index'])->name('index');
            Route::get('/list', [StaffController::class, 'list'])->name('list');
            Route::get('/schedule', [StaffController::class, 'schedule'])->name('schedule');
            Route::get('/performance', [StaffController::class, 'performance'])->name('performance');
        });
        
        // Customers
        Route::prefix('customers')->name('customers.')->group(function () {
            Route::get('/', [AdminCustomerController::class, 'index'])->name('index');
            Route::get('/list', [AdminCustomerController::class, 'list'])->name('list');
            Route::get('/loyalty', [AdminCustomerController::class, 'loyalty'])->name('loyalty');
            Route::get('/communications', [AdminCustomerController::class, 'communications'])->name('communications');
        });
        
        // Marketing
        Route::prefix('marketing')->name('marketing.')->group(function () {
            Route::get('/campaigns', [AdminMarketingController::class, 'campaigns'])->name('campaigns');
            Route::get('/sms', [AdminMarketingController::class, 'sms'])->name('sms');
            Route::get('/promotions', [AdminMarketingController::class, 'promotions'])->name('promotions');
        });
        
        // Content
        Route::prefix('content')->name('content.')->group(function () {
            Route::get('/gallery', [ContentController::class, 'gallery'])->name('gallery');
            Route::get('/blog', [ContentController::class, 'blog'])->name('blog');
            Route::get('/testimonials', [ContentController::class, 'testimonials'])->name('testimonials');
        });
        
        // Analytics
        Route::prefix('analytics')->name('analytics.')->group(function () {
            Route::get('/revenue', [DashboardController::class, 'revenueAnalytics'])->name('revenue');
            Route::get('/revenue/export', [DashboardController::class, 'exportRevenueAnalytics'])->name('revenue.export');
            Route::get('/bookings', [DashboardController::class, 'bookingsAnalytics'])->name('bookings');
            Route::get('/customers', [DashboardController::class, 'customersAnalytics'])->name('customers');
        });
        
        // Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/business', [AdminSettingsController::class, 'business'])->name('business');
            Route::get('/integrations', [AdminSettingsController::class, 'integrations'])->name('integrations');
            Route::get('/security', [AdminSettingsController::class, 'security'])->name('security');
        });

        // API endpoints
        Route::get('/revenue-data', [DashboardController::class, 'getRevenueData'])->name('revenue-data');
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
