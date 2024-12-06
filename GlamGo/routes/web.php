<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;

// Main route - show modern home page
Route::get('/', function () {
    return view('modern-home');
});

// Services route
Route::get('/services', function () {
    return view('services');
});

// Booking Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/bookings', [BookingController::class, 'adminIndex'])->name('admin.bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'adminShow'])->name('admin.bookings.show');
    Route::patch('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('admin.bookings.status');
});
