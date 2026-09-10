<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Routes (Login)
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store']);
    });

    // Auth Routes - Chỉ sử dụng AdminMiddleware::class
    Route::middleware(['auth', AdminMiddleware::class])->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Profile Management
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Tour Management
        Route::prefix('tours')->name('tours.')->group(function () {
            Route::get('/', [TourController::class, 'index'])->name('index');
            Route::get('/create', [TourController::class, 'create'])->name('create');
            Route::post('/', [TourController::class, 'store'])->name('store');
            Route::get('/{tour}/edit', [TourController::class, 'edit'])->name('edit');
            Route::put('/{tour}', [TourController::class, 'update'])->name('update');
            Route::delete('/{tour}', [TourController::class, 'destroy'])->name('delete');
            Route::get('/pending', [TourController::class, 'pending'])->name('pending');
            Route::get('/published', [TourController::class, 'published'])->name('published');
        });

        // Booking Management
        Route::prefix('bookings')->name('bookings.')->group(function () {
            Route::get('/', [BookingController::class, 'index'])->name('index');
            Route::get('/status', [BookingController::class, 'status'])->name('status');
        });

        // Account Management
        Route::prefix('accounts')->name('accounts.')->group(function () {
            Route::get('/up-profile', function () {
                return view('admin.accounts.up-profile');
            })->name('up-profile');
        });
    });

    // Password Update
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
