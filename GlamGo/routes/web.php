<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\GroupBookingController;
use App\Http\Controllers\Admin\WaitlistController;
use App\Http\Controllers\Admin\BookingRulesController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\ServicePackagesController;
use App\Http\Controllers\Admin\ServiceAddonsController;
use App\Http\Controllers\Admin\ServicePricingController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\StaffShiftsController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\MarketingController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;

// Main route - show modern home page
Route::get('/', function () {
    return view('modern-home');
})->name('home');

// About route
Route::get('/about', function () {
    return view('about');
})->name('about');

// Contact Routes
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// Blog route
Route::get('/blog', function () {
    return view('blog');
})->name('blog');

// Services route
Route::get('/services', function () {
    return view('services');
})->name('services');

// Specialists route
Route::get('/specialists', function () {
    return view('specialists');
})->name('specialists');

// Gallery route
Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');

// Booking Routes
Route::get('/booking', function () {
    return view('booking');
})->name('booking');

Route::get('/booking/services', function () {
    return view('service-selection');
})->name('booking.services');

Route::get('/appointments', function () {
    return view('appointments');
})->name('appointments');

// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Appointments Routes
    Route::prefix('appointments')->group(function () {
        Route::get('/', [AppointmentController::class, 'index'])->name('admin.appointments.index');
        Route::get('/create', [AppointmentController::class, 'create'])->name('admin.appointments.create');
        Route::post('/', [AppointmentController::class, 'store'])->name('admin.appointments.store');
        Route::get('/calendar', [AppointmentController::class, 'calendar'])->name('admin.appointments.calendar');
        Route::get('/{appointment}/edit', [AppointmentController::class, 'edit'])->name('admin.appointments.edit');
        Route::put('/{appointment}', [AppointmentController::class, 'update'])->name('admin.appointments.update');
        Route::delete('/{appointment}', [AppointmentController::class, 'destroy'])->name('admin.appointments.destroy');
        Route::post('/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('admin.appointments.update-status');
    });

    // Analytics Routes
    Route::get('/analytics/retention', [AnalyticsController::class, 'retention'])->name('admin.analytics.retention');
    Route::get('/analytics/revenue', [AnalyticsController::class, 'revenue'])->name('admin.analytics.revenue');
    Route::get('/analytics/trends', [AnalyticsController::class, 'trends'])->name('admin.analytics.trends');
    Route::get('/analytics/abandoned', [AnalyticsController::class, 'abandoned'])->name('admin.analytics.abandoned');

    // Marketing Routes
    Route::get('/marketing/campaigns', [MarketingController::class, 'campaigns'])->name('admin.marketing.campaigns');
    Route::get('/marketing/promotions', [MarketingController::class, 'promotions'])->name('admin.marketing.promotions');
    Route::get('/marketing/email', [MarketingController::class, 'email'])->name('admin.marketing.email');
    Route::get('/marketing/sms', [MarketingController::class, 'sms'])->name('admin.marketing.sms');
    Route::get('/marketing/push', [MarketingController::class, 'push'])->name('admin.marketing.push');
    Route::post('/marketing/push/send', [MarketingController::class, 'sendPushNotification'])->name('admin.marketing.push.send');
    Route::get('/marketing/push/subscribers', [MarketingController::class, 'pushSubscribers'])->name('admin.marketing.push.subscribers');
    Route::get('/marketing/affiliates', [MarketingController::class, 'affiliates'])->name('admin.marketing.affiliates');
    Route::post('/marketing/affiliates', [MarketingController::class, 'storeAffiliate'])->name('admin.marketing.affiliates.store');
    Route::put('/marketing/affiliates/{id}', [MarketingController::class, 'updateAffiliate'])->name('admin.marketing.affiliates.update');
    Route::delete('/marketing/affiliates/{id}', [MarketingController::class, 'destroyAffiliate'])->name('admin.marketing.affiliates.destroy');

    Route::get('/staff', function () {
        return view('admin.staff');
    })->name('admin.staff');

    Route::get('/reports', function () {
        return view('admin.reports');
    })->name('admin.reports');

    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');

    Route::get('/marketing', function () {
        return view('admin.marketing');
    })->name('admin.marketing');

    // Group Bookings Routes
    Route::get('/group-bookings', [GroupBookingController::class, 'index'])->name('admin.group-bookings');
    Route::get('/group-bookings/create', [GroupBookingController::class, 'create'])->name('admin.group-bookings.create');
    Route::post('/group-bookings', [GroupBookingController::class, 'store'])->name('admin.group-bookings.store');
    Route::get('/group-bookings/{id}', [GroupBookingController::class, 'show'])->name('admin.group-bookings.show');
    Route::get('/group-bookings/{id}/edit', [GroupBookingController::class, 'edit'])->name('admin.group-bookings.edit');
    Route::put('/group-bookings/{id}', [GroupBookingController::class, 'update'])->name('admin.group-bookings.update');
    Route::delete('/group-bookings/{id}', [GroupBookingController::class, 'destroy'])->name('admin.group-bookings.destroy');

    // Waitlist Routes
    Route::get('/waitlist', [WaitlistController::class, 'index'])->name('admin.waitlist');
    Route::post('/waitlist', [WaitlistController::class, 'store'])->name('admin.waitlist.store');
    Route::get('/waitlist/{id}/convert', [WaitlistController::class, 'convert'])->name('admin.waitlist.convert');
    Route::put('/waitlist/{id}', [WaitlistController::class, 'update'])->name('admin.waitlist.update');
    Route::delete('/waitlist/{id}', [WaitlistController::class, 'destroy'])->name('admin.waitlist.destroy');

    // Booking Rules Routes
    Route::get('/booking-rules', [BookingRulesController::class, 'index'])->name('admin.booking-rules');
    Route::post('/booking-rules', [BookingRulesController::class, 'store'])->name('admin.booking-rules.store');
    Route::put('/booking-rules/{id}', [BookingRulesController::class, 'update'])->name('admin.booking-rules.update');
    Route::delete('/booking-rules/{id}', [BookingRulesController::class, 'destroy'])->name('admin.booking-rules.destroy');
    Route::put('/booking-rules/{id}/toggle', [BookingRulesController::class, 'toggleStatus'])->name('admin.booking-rules.toggle');

    // Service Management Routes
    Route::get('/services', [ServicesController::class, 'index'])->name('admin.services.index');
    Route::get('/services/create', [ServicesController::class, 'create'])->name('admin.services.create');
    Route::post('/services', [ServicesController::class, 'store'])->name('admin.services.store');
    Route::get('/services/{id}/edit', [ServicesController::class, 'edit'])->name('admin.services.edit');
    Route::put('/services/{id}', [ServicesController::class, 'update'])->name('admin.services.update');
    Route::delete('/services/{id}', [ServicesController::class, 'destroy'])->name('admin.services.destroy');
    Route::put('/services/{id}/toggle', [ServicesController::class, 'toggleStatus'])->name('admin.services.toggle');
    Route::post('/services/order', [ServicesController::class, 'updateOrder'])->name('admin.services.order');

    // Service Pricing Routes
    Route::get('/services/pricing', [ServicePricingController::class, 'index'])->name('admin.services.pricing');
    Route::post('/services/pricing', [ServicePricingController::class, 'store'])->name('admin.services.pricing.store');
    Route::get('/services/pricing/{id}/edit', [ServicePricingController::class, 'edit'])->name('admin.services.pricing.edit');
    Route::put('/services/pricing/{id}', [ServicePricingController::class, 'update'])->name('admin.services.pricing.update');
    Route::delete('/services/pricing/{id}', [ServicePricingController::class, 'destroy'])->name('admin.services.pricing.destroy');
    Route::post('/services/pricing/apply-discount', [ServicePricingController::class, 'applyDiscount'])->name('admin.services.pricing.apply-discount');

    // Service Packages Routes
    Route::get('/services/packages', [ServicePackagesController::class, 'index'])->name('admin.services.packages');
    Route::get('/services/packages/create', [ServicePackagesController::class, 'create'])->name('admin.services.packages.create');
    Route::post('/services/packages', [ServicePackagesController::class, 'store'])->name('admin.services.packages.store');
    Route::get('/services/packages/{id}/edit', [ServicePackagesController::class, 'edit'])->name('admin.services.packages.edit');
    Route::put('/services/packages/{id}', [ServicePackagesController::class, 'update'])->name('admin.services.packages.update');
    Route::delete('/services/packages/{id}', [ServicePackagesController::class, 'destroy'])->name('admin.services.packages.destroy');
    Route::put('/services/packages/{id}/toggle', [ServicePackagesController::class, 'toggleStatus'])->name('admin.services.packages.toggle');
    Route::put('/services/packages/{id}/services', [ServicePackagesController::class, 'updateServices'])->name('admin.services.packages.services');

    // Service Addons Routes
    Route::get('/services/addons', [ServiceAddonsController::class, 'index'])->name('admin.services.addons');
    Route::get('/services/addons/create', [ServiceAddonsController::class, 'create'])->name('admin.services.addons.create');
    Route::post('/services/addons', [ServiceAddonsController::class, 'store'])->name('admin.services.addons.store');
    Route::get('/services/addons/{id}/edit', [ServiceAddonsController::class, 'edit'])->name('admin.services.addons.edit');
    Route::put('/services/addons/{id}', [ServiceAddonsController::class, 'update'])->name('admin.services.addons.update');
    Route::delete('/services/addons/{id}', [ServiceAddonsController::class, 'destroy'])->name('admin.services.addons.destroy');
    Route::put('/services/addons/{id}/toggle', [ServiceAddonsController::class, 'toggleStatus'])->name('admin.services.addons.toggle');
    Route::put('/services/addons/{id}/assign', [ServiceAddonsController::class, 'assignToService'])->name('admin.services.addons.assign');

    // Customer Management Routes
    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('admin.customers.index');
        Route::get('/create', [CustomerController::class, 'create'])->name('admin.customers.create');
        Route::post('/', [CustomerController::class, 'store'])->name('admin.customers.store');
        Route::get('/rewards', [CustomerController::class, 'rewards'])->name('admin.customers.rewards');
        Route::get('/reviews', [CustomerController::class, 'reviews'])->name('admin.customers.reviews');
        Route::get('/import', [CustomerController::class, 'import'])->name('admin.customers.import');
        Route::post('/import', [CustomerController::class, 'importCustomers'])->name('admin.customers.import.process');
        Route::get('/export', [CustomerController::class, 'export'])->name('admin.customers.export');
        Route::get('/{customer}', [CustomerController::class, 'show'])->name('admin.customers.show');
        Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('admin.customers.edit');
        Route::put('/{customer}', [CustomerController::class, 'update'])->name('admin.customers.update');
        Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('admin.customers.destroy');
    });

    // Staff Routes
    Route::prefix('staff')->group(function () {
        Route::get('/', [StaffController::class, 'list'])->name('admin.staff.list');
        Route::get('/create', [StaffController::class, 'create'])->name('admin.staff.create');
        Route::post('/', [StaffController::class, 'store'])->name('admin.staff.store');
        Route::get('/{staff}', [StaffController::class, 'show'])->name('admin.staff.show');
        Route::get('/{staff}/edit', [StaffController::class, 'edit'])->name('admin.staff.edit');
        Route::put('/{staff}', [StaffController::class, 'update'])->name('admin.staff.update');
        Route::delete('/{staff}', [StaffController::class, 'destroy'])->name('admin.staff.destroy');
        
        // Staff Leave Routes
        Route::get('/leave/requests', [StaffController::class, 'leaveRequests'])->name('admin.staff.leave');
        Route::post('/leave/{leave}/approve', [StaffController::class, 'approveLeave'])->name('admin.staff.leave.approve');
        Route::post('/leave/{leave}/reject', [StaffController::class, 'rejectLeave'])->name('admin.staff.leave.reject');
    });

    // Staff Shifts Routes
    Route::get('/staff/shifts', [StaffShiftsController::class, 'index'])->name('admin.staff.shifts');
    Route::post('/staff/shifts', [StaffShiftsController::class, 'store'])->name('admin.staff.shifts.store');
    Route::put('/staff/shifts/{id}', [StaffShiftsController::class, 'update'])->name('admin.staff.shifts.update');
    Route::delete('/staff/shifts/{id}', [StaffShiftsController::class, 'destroy'])->name('admin.staff.shifts.destroy');
    Route::post('/staff/shifts/bulk-update', [StaffShiftsController::class, 'bulkUpdate'])->name('admin.staff.shifts.bulk-update');
    Route::post('/staff/shifts/copy-week', [StaffShiftsController::class, 'copyWeek'])->name('admin.staff.shifts.copy-week');
    Route::get('/staff/{id}/availability', [StaffShiftsController::class, 'getStaffAvailability'])->name('admin.staff.shifts.availability');
    Route::put('/staff/{id}/availability', [StaffShiftsController::class, 'setStaffAvailability'])->name('admin.staff.shifts.set-availability');
    Route::get('/staff/shifts/templates', [StaffShiftsController::class, 'getShiftTemplates'])->name('admin.staff.shifts.templates');
    Route::post('/staff/shifts/templates', [StaffShiftsController::class, 'saveShiftTemplate'])->name('admin.staff.shifts.save-template');

    // Staff Leave Routes
    Route::get('/staff/leave', [StaffController::class, 'leaveRequests'])->name('admin.staff.leave');
    Route::post('/staff/leave', [StaffController::class, 'storeLeave'])->name('admin.staff.leave.store');
    Route::put('/staff/leave/{id}', [StaffController::class, 'updateLeave'])->name('admin.staff.leave.update');
    Route::delete('/staff/leave/{id}', [StaffController::class, 'destroyLeave'])->name('admin.staff.leave.destroy');
    Route::put('/staff/leave/{id}/approve', [StaffController::class, 'approveLeave'])->name('admin.staff.leave.approve');
    Route::put('/staff/leave/{id}/reject', [StaffController::class, 'rejectLeave'])->name('admin.staff.leave.reject');

    // Content Management Routes
    Route::get('/content/testimonials', [ContentController::class, 'testimonials'])->name('admin.content.testimonials');
    Route::post('/content/testimonials', [ContentController::class, 'storeTestimonial'])->name('admin.content.testimonials.store');
    Route::put('/content/testimonials/{id}', [ContentController::class, 'updateTestimonial'])->name('admin.content.testimonials.update');
    Route::delete('/content/testimonials/{id}', [ContentController::class, 'destroyTestimonial'])->name('admin.content.testimonials.destroy');
    Route::post('/content/testimonials/{id}/approve', [ContentController::class, 'approveTestimonial'])->name('admin.content.testimonials.approve');
    Route::get('/content/team', [ContentController::class, 'team'])->name('admin.content.team');
    Route::post('/content/team', [ContentController::class, 'storeTeamMember'])->name('admin.content.team.store');
    Route::put('/content/team/{id}', [ContentController::class, 'updateTeamMember'])->name('admin.content.team.update');
    Route::delete('/content/team/{id}', [ContentController::class, 'destroyTeamMember'])->name('admin.content.team.destroy');
    Route::post('/content/team/reorder', [ContentController::class, 'reorderTeam'])->name('admin.content.team.reorder');
    Route::get('/content/events', [ContentController::class, 'events'])->name('admin.content.events');
    Route::post('/content/events', [ContentController::class, 'storeEvent'])->name('admin.content.events.store');
    Route::put('/content/events/{id}', [ContentController::class, 'updateEvent'])->name('admin.content.events.update');
    Route::delete('/content/events/{id}', [ContentController::class, 'destroyEvent'])->name('admin.content.events.destroy');
    Route::post('/content/events/{id}/publish', [ContentController::class, 'publishEvent'])->name('admin.content.events.publish');
    Route::get('/content/landing', [ContentController::class, 'landing'])->name('admin.content.landing');
    Route::put('/content/landing/hero', [ContentController::class, 'updateHero'])->name('admin.content.landing.hero');
    Route::put('/content/landing/about', [ContentController::class, 'updateAbout'])->name('admin.content.landing.about');
    Route::put('/content/landing/features', [ContentController::class, 'updateFeatures'])->name('admin.content.landing.features');
    Route::put('/content/landing/stats', [ContentController::class, 'updateStats'])->name('admin.content.landing.stats');
    Route::post('/content/landing/gallery', [ContentController::class, 'addGalleryImage'])->name('admin.content.landing.gallery.add');
    Route::delete('/content/landing/gallery/{id}', [ContentController::class, 'removeGalleryImage'])->name('admin.content.landing.gallery.remove');
    Route::post('/content/landing/gallery/reorder', [ContentController::class, 'reorderGallery'])->name('admin.content.landing.gallery.reorder');

    // Settings Routes
    Route::prefix('settings')->group(function () {
        Route::get('/general', [SettingsController::class, 'general'])->name('admin.settings.general');
        Route::get('/appearance', [SettingsController::class, 'appearance'])->name('admin.settings.appearance');
        Route::get('/notifications', [SettingsController::class, 'notifications'])->name('admin.settings.notifications');
        Route::get('/booking', [SettingsController::class, 'booking'])->name('admin.settings.booking');
        Route::get('/staff', [SettingsController::class, 'staff'])->name('admin.settings.staff');
        Route::get('/payments', [SettingsController::class, 'payments'])->name('admin.settings.payments');
        Route::get('/integrations', [SettingsController::class, 'integrations'])->name('admin.settings.integrations');
        
        // Settings Updates
        Route::put('/general', [SettingsController::class, 'updateGeneral'])->name('admin.settings.general.update');
        Route::put('/appearance', [SettingsController::class, 'updateAppearance'])->name('admin.settings.appearance.update');
        Route::put('/notifications', [SettingsController::class, 'updateNotifications'])->name('admin.settings.notifications.update');
        Route::put('/booking', [SettingsController::class, 'updateBooking'])->name('admin.settings.booking.update');
        Route::put('/staff', [SettingsController::class, 'updateStaff'])->name('admin.settings.staff.update');
        Route::put('/payments', [SettingsController::class, 'updatePayments'])->name('admin.settings.payments.update');
        Route::put('/integrations', [SettingsController::class, 'updateIntegrations'])->name('admin.settings.integrations.update');
    });
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('verify-email', [AuthController::class, 'showVerificationNotice'])->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');
    Route::post('email/verification-notification', [AuthController::class, 'resendVerificationEmail'])->name('verification.send');
});

// Social Media Routes
Route::redirect('/facebook', 'https://facebook.com/glamgo', 301)->name('social.facebook');
Route::redirect('/instagram', 'https://instagram.com/glamgo', 301)->name('social.instagram');
Route::redirect('/twitter', 'https://twitter.com/glamgo', 301)->name('social.twitter');

// Legal Routes
Route::get('/privacy-policy', function () {
    return view('legal.privacy-policy');
})->name('privacy');

Route::get('/terms-of-service', function () {
    return view('legal.terms-of-service');
})->name('terms');

// Fallback route for 404
Route::fallback(function () {
    return view('errors.404');
});
