<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\AppointmentController;
use App\Http\Controllers\Api\BookingController as ApiBookingController;
use App\Http\Controllers\Staff\ProfileController;
use App\Http\Controllers\Api\SpecialistController;
use App\Http\Controllers\Api\ServiceAddonController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\Api\ServiceAvailabilityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Status Route
Route::get('/status', [StatusController::class, 'index']);

// Booking Routes
Route::post('/bookings', [BookingController::class, 'store']);
Route::get('/bookings/{booking}', [BookingController::class, 'show']);
Route::get('/bookings', [BookingController::class, 'index']);

// Service Routes
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/categories', [ServiceController::class, 'categories']);
Route::get('/services/category/{categoryId}', [ServiceController::class, 'getByCategory']);

// Appointment Routes
Route::get('/appointments/check-availability', [AppointmentController::class, 'checkAvailability']);
Route::post('/appointments/book', [AppointmentController::class, 'book']);

Route::prefix('v1')->group(function () {
    // Booking routes
    Route::get('services', [ApiBookingController::class, 'getServices']);
    Route::post('check-availability', [ApiBookingController::class, 'checkAvailability']);
    Route::post('appointments', [ApiBookingController::class, 'createAppointment']);

    // Staff routes
    Route::prefix('staff')->group(function () {
        Route::get('{id}', [ProfileController::class, 'show']);
        Route::put('{id}', [ProfileController::class, 'update']);
        Route::get('{id}/availability', [ProfileController::class, 'getAvailability']);
        Route::get('{id}/performance', [ProfileController::class, 'getPerformanceMetrics']);
    });
});

// Service Categories with Services
Route::get('/service-categories', [ServiceController::class, 'categories']);

// Specialists
Route::get('/specialists', [SpecialistController::class, 'index']);

// Available Time Slots
Route::get('/available-slots', [ApiBookingController::class, 'availableSlots']);

// Service Add-ons
Route::get('/service-addons', [ServiceAddonController::class, 'index']);

// Booking Management
Route::post('/lock-slot', [ApiBookingController::class, 'lockSlot']);
Route::delete('/release-lock/{lockId}', [ApiBookingController::class, 'releaseLock']);
Route::get('/bookings/check-availability', [BookingController::class, 'checkAvailability']);
Route::post('/bookings/book', [BookingController::class, 'book']);
Route::post('bookings', [ApiBookingController::class, 'createBooking']);

// Availability routes
Route::prefix('availability')->group(function () {
    Route::get('specialist/{specialist}', [AvailabilityController::class, 'checkSpecialistAvailability']);
    Route::get('service/{service}', [AvailabilityController::class, 'checkServiceAvailability']);
    Route::get('next-available', [AvailabilityController::class, 'getNextAvailableSlot']);
});

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Booking routes
    Route::prefix('bookings')->group(function () {
        Route::post('/', [BookingController::class, 'store']);
        Route::get('/{booking}', [BookingController::class, 'show']);
        Route::post('/{booking}/cancel', [BookingController::class, 'cancel']);
        Route::post('/{booking}/reschedule', [BookingController::class, 'reschedule']);
    });

    // User profile and preferences
    Route::get('user/profile', 'UserController@profile');
    Route::put('user/profile', 'UserController@updateProfile');
    Route::get('user/bookings', 'UserController@bookings');
    
    // Reviews and ratings
    Route::post('reviews', 'ReviewController@store');
    Route::get('reviews/user', 'ReviewController@userReviews');
    Route::get('reviews/service/{service}', 'ReviewController@serviceReviews');
    Route::get('reviews/specialist/{specialist}', 'ReviewController@specialistReviews');
});

// Service Availability Routes
Route::get('/services/{service}/availability', [ServiceAvailabilityController::class, 'check']);
Route::post('/services/{service}/availability', [ServiceAvailabilityController::class, 'update'])
    ->middleware('auth:sanctum');
