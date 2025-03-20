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
use Illuminate\Support\Facades\Auth;

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
use App\Http\Controllers\Admin\OfferController;

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    
    // Admin Auth Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });
    
    // Registration Routes
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    
    // Password Reset Routes
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Admin routes
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('check-session', [AdminAuthController::class, 'checkSession'])->name('check-session');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // Admin Profile Routes
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');

        // Booking Management Routes
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

        // Special Offers
        Route::resource('offers', OfferController::class);
        Route::patch('offers/{offer}/toggle-status', [OfferController::class, 'toggleStatus'])->name('offers.toggle-status');

        // Blog Posts
        Route::resource('blog', BlogController::class);
        Route::patch('blog/{post}/toggle-status', [BlogController::class, 'toggleStatus'])->name('blog.toggle-status');
    });

    // Customer routes
    Route::prefix('customer')->name('customer.')->middleware('customer')->group(function () {
        Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [CustomerController::class, 'profile'])->name('profile');
        Route::get('/bookings', [CustomerController::class, 'bookings'])->name('bookings');
        Route::get('/reviews', [CustomerController::class, 'reviews'])->name('reviews');
        Route::get('/favorites', [CustomerController::class, 'favorites'])->name('favorites');
    });

    // Booking Routes
    Route::prefix('booking')->name('booking.')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('index');
        Route::get('/create', [BookingController::class, 'create'])->name('create');
        Route::post('/store', [BookingController::class, 'store'])->name('store');
        Route::get('/confirmation/{booking}', [BookingController::class, 'confirmation'])->name('confirmation');
    });

    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Services Routes
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [ServicesController::class, 'index'])->name('index');
    Route::get('/{service}', [ServicesController::class, 'show'])->name('show');
    Route::get('/filter', [ServicesController::class, 'filter'])->name('filter');
});

// Specialists Routes
Route::prefix('specialists')->name('specialists.')->group(function () {
    Route::get('/', [SpecialistsController::class, 'index'])->name('index');
    Route::get('/{specialist}', [SpecialistsController::class, 'show'])->name('show');
    Route::get('/filter', [SpecialistsController::class, 'filter'])->name('filter');
});

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

// Temporary debug route - REMOVE IN PRODUCTION
Route::get('/debug-admin', function () {
    $admin = DB::table('admins')->where('email', 'admin@glamgo.com')->first();
    dd([
        'exists' => !is_null($admin),
        'email' => $admin->email ?? null,
        'password_length' => strlen($admin->password ?? ''),
    ]);
});
