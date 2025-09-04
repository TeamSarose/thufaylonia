<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Password check route for debugging
Route::post('/check-password', [App\Http\Controllers\PasswordCheckController::class, 'checkPassword']);
Route::get('/password-check', function () {
    return view('password-check');
});

// Authentication debugging routes
Route::get('/auth-debug', [App\Http\Controllers\AuthDebugController::class, 'index'])->name('auth.debug');
Route::post('/auth-debug/test', [App\Http\Controllers\AuthDebugController::class, 'testLogin'])->name('auth.debug.test');
Route::post('/auth-debug/fix', [App\Http\Controllers\AuthDebugController::class, 'fixUser'])->name('auth.debug.fix');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
