<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SpecialistsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/cookies', [HomeController::class, 'cookies'])->name('cookies');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/specialists', [SpecialistsController::class, 'index'])->name('specialists');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// Booking routes
Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/slots', [BookingController::class, 'getAvailableSlots'])->name('booking.slots');

// Appointment routes
Route::prefix('appointments')->name('appointments.')->group(function () {
    Route::get('/', [AppointmentsController::class, 'index'])->name('index');
    Route::get('/create', [AppointmentsController::class, 'create'])->name('create');
    Route::post('/', [AppointmentsController::class, 'store'])->name('store');
    Route::post('/{id}/cancel', [AppointmentsController::class, 'cancel'])->name('cancel');
    Route::post('/{id}/reschedule', [AppointmentsController::class, 'reschedule'])->name('reschedule');
    Route::get('/available-slots', [AppointmentsController::class, 'getAvailableSlots'])->name('available-slots');
});

// Customer routes
Route::get('/dashboard', function () { return view('customer.dashboard'); })->name('dashboard');
Route::get('/profile', function () { return view('customer.profile'); })->name('profile');
Route::get('/reviews', function () { return view('customer.reviews'); })->name('reviews');
Route::get('/favorites', function () { return view('customer.favorites'); })->name('favorites');

// Staff routes
Route::prefix('staff')->group(function () {
    Route::get('/profile', [StaffController::class, 'profile'])->name('staff.profile');
    Route::get('/appointments', [StaffController::class, 'appointments'])->name('staff.appointments');
});

// Help route
Route::get('/help', [HelpController::class, 'index'])->name('help');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Analytics routes
    Route::get('/revenue', [AdminController::class, 'revenueAnalytics'])->name('revenue');
    Route::get('/bookings', [AdminController::class, 'bookingsAnalytics'])->name('bookings');
    Route::get('/customers', [AdminController::class, 'customersAnalytics'])->name('customers');
    Route::get('/services', [AdminController::class, 'servicesAnalytics'])->name('services');
    Route::get('/staff', [AdminController::class, 'staffAnalytics'])->name('staff');
    
    // Staff management
    Route::get('/staff', [AdminController::class, 'staff'])->name('staff.index');
    Route::get('/staff/create', [AdminController::class, 'staffCreate'])->name('staff.create');
    Route::post('/staff', [AdminController::class, 'staffStore'])->name('staff.store');
    Route::get('/staff/schedule', [AdminController::class, 'staffSchedule'])->name('staff.schedule');
    
    // Services management
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', [AdminController::class, 'services'])->name('index');
        Route::post('/', [AdminController::class, 'servicesStore'])->name('store');
        Route::put('/{id}', [AdminController::class, 'servicesUpdate'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'servicesDestroy'])->name('destroy');
        
        // Service packages
        Route::prefix('packages')->name('packages.')->group(function () {
            Route::get('/', [AdminController::class, 'servicePackages'])->name('index');
            Route::post('/', [AdminController::class, 'servicePackagesStore'])->name('store');
            Route::put('/{id}', [AdminController::class, 'servicePackagesUpdate'])->name('update');
            Route::delete('/{id}', [AdminController::class, 'servicePackagesDestroy'])->name('destroy');
        });

        // Service addons
        Route::prefix('addons')->name('addons.')->group(function () {
            Route::get('/', [AdminController::class, 'serviceAddons'])->name('index');
            Route::post('/', [AdminController::class, 'serviceAddonsStore'])->name('store');
            Route::put('/{id}', [AdminController::class, 'serviceAddonsUpdate'])->name('update');
            Route::delete('/{id}', [AdminController::class, 'serviceAddonsDestroy'])->name('destroy');
        });

        // Service pricing
        Route::get('/pricing', [AdminController::class, 'servicePricing'])->name('pricing');
        Route::post('/pricing', [AdminController::class, 'servicePricingStore'])->name('pricing.store');
        Route::put('/pricing/{id}', [AdminController::class, 'servicePricingUpdate'])->name('pricing.update');
        Route::delete('/pricing/{id}', [AdminController::class, 'servicePricingDestroy'])->name('pricing.destroy');
    });
    
    // Service management
    Route::get('/services', [AdminController::class, 'services'])->name('services.index');
    Route::get('/services/create', [AdminController::class, 'serviceCreate'])->name('services.create');
    Route::post('/services', [AdminController::class, 'serviceStore'])->name('services.store');
    Route::get('/services/categories', [AdminController::class, 'serviceCategories'])->name('services.categories');
    
    // Appointment management
    Route::get('/appointments', [AdminController::class, 'appointments'])->name('appointments.index');
    Route::get('/appointments/create', [AdminController::class, 'appointmentCreate'])->name('appointments.create');
    Route::post('/appointments', [AdminController::class, 'appointmentStore'])->name('appointments.store');
    Route::post('/appointments/{id}/update', [AdminController::class, 'appointmentUpdate'])->name('appointments.update');
    Route::get('/appointments/calendar', [AdminController::class, 'appointmentCalendar'])->name('appointments.calendar');
    
    // Group bookings
    Route::get('/group-bookings', [AdminController::class, 'groupBookings'])->name('group-bookings.index');
    Route::get('/group-bookings/create', [AdminController::class, 'groupBookingsCreate'])->name('group-bookings.create');
    Route::post('/group-bookings', [AdminController::class, 'groupBookingsStore'])->name('group-bookings.store');
    Route::get('/group-bookings/{id}', [AdminController::class, 'groupBookingsShow'])->name('group-bookings.show');
    Route::post('/group-bookings/{id}/update', [AdminController::class, 'groupBookingsUpdate'])->name('group-bookings.update');
    Route::delete('/group-bookings/{id}', [AdminController::class, 'groupBookingsDestroy'])->name('group-bookings.destroy');
    
    // Waitlist management
    Route::get('/waitlist', [AdminController::class, 'waitlist'])->name('waitlist.index');
    Route::post('/waitlist', [AdminController::class, 'waitlistStore'])->name('waitlist.store');
    Route::post('/waitlist/{id}/contact-attempt', [AdminController::class, 'waitlistContactAttempt'])->name('waitlist.contact-attempt');
    Route::post('/waitlist/{id}/update-status', [AdminController::class, 'waitlistUpdateStatus'])->name('waitlist.update-status');
    Route::delete('/waitlist/{id}', [AdminController::class, 'waitlistDestroy'])->name('waitlist.destroy');
    
    // Booking rules
    Route::get('/booking-rules', [AdminController::class, 'bookingRules'])->name('booking-rules.index');
    Route::post('/booking-rules', [AdminController::class, 'bookingRulesStore'])->name('booking-rules.store');
    Route::put('/booking-rules/{id}', [AdminController::class, 'bookingRulesUpdate'])->name('booking-rules.update');
    Route::delete('/booking-rules/{id}', [AdminController::class, 'bookingRulesDestroy'])->name('booking-rules.destroy');
    
    // Content management
    Route::prefix('content')->name('content.')->group(function () {
        Route::get('/gallery', [AdminController::class, 'gallery'])->name('gallery');
        Route::post('/gallery/add', [AdminController::class, 'galleryAdd'])->name('gallery.add');
        Route::delete('/gallery/{id}', [AdminController::class, 'galleryRemove'])->name('gallery.remove');
        Route::post('/gallery/reorder', [AdminController::class, 'galleryReorder'])->name('gallery.reorder');
    });
    
    // Customer management
    Route::prefix('customers')->name('customers.')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/create', [CustomerController::class, 'create'])->name('create');
        Route::post('/', [CustomerController::class, 'store'])->name('store');
        Route::get('/{id}', [CustomerController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [CustomerController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CustomerController::class, 'update'])->name('update');
        Route::delete('/{id}', [CustomerController::class, 'destroy'])->name('destroy');
        
        // Customer preferences
        Route::get('/{id}/preferences', [CustomerController::class, 'preferences'])->name('preferences');
        Route::post('/{id}/preferences', [CustomerController::class, 'preferencesUpdate'])->name('preferences.update');
        
        // Customer loyalty
        Route::get('/{id}/loyalty', [CustomerController::class, 'loyalty'])->name('loyalty');
        Route::post('/{id}/loyalty/points/add', [CustomerController::class, 'addLoyaltyPoints'])->name('loyalty.points.add');
        Route::post('/{id}/loyalty/points/redeem', [CustomerController::class, 'redeemLoyaltyPoints'])->name('loyalty.points.redeem');
    });
    
    // Reports
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    
    // Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
});
