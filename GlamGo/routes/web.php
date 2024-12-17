<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('modern-home');
});

// Customer Routes
Route::get('/services', function () { return view('services'); });
Route::get('/gallery', function () { return view('gallery'); });
Route::get('/specialists', function () { return view('specialists'); });
Route::get('/booking', function () { return view('booking'); });
Route::get('/about', function () { return view('about'); });
Route::get('/contact', function () { return view('contact'); });
Route::get('/blog', function () { return view('blog'); });

// Admin Routes (temporarily without middleware)
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () { return view('admin.dashboard'); });
    Route::get('/appointments', function () { return view('admin.appointments.index'); });
    Route::get('/services', function () { return view('admin.services.index'); });
    Route::get('/staff', function () { return view('admin.staff.index'); });
    Route::get('/customers', function () { return view('admin.customers.index'); });
    Route::get('/marketing', function () { return view('admin.marketing.index'); });
    Route::get('/reports', function () { return view('admin.reports.index'); });
    Route::get('/settings', function () { return view('admin.settings.index'); });
});
