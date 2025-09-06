<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tours', [TourController::class, 'index'])->name('tours');
Route::get('/guides', [GuideController::class, 'index'])->name('guides');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

// Dashboard routes with auth middleware
Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/bookings', [DashboardController::class, 'bookings'])->name('bookings');
    Route::get('/itineraries', [DashboardController::class, 'itineraries'])->name('itineraries');
    Route::get('/messages', [DashboardController::class, 'messages'])->name('messages');
    Route::get('/payments', [DashboardController::class, 'payments'])->name('payments');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
