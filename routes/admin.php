<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

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

        // Review Management
        Route::prefix('reviews')->name('reviews.')->group(function () {
            Route::get('/', [ReviewController::class, 'index'])->name('index');
            Route::post('/{review}/approve', [ReviewController::class, 'approve'])->name('approve');
            Route::post('/{review}/reject', [ReviewController::class, 'reject'])->name('reject');
            Route::delete('/{review}', [ReviewController::class, 'destroy'])->name('destroy');
        });

        // Financial & Accounting Management (Earned/Unearned Revenue, Refunds, Payouts)
        Route::prefix('financial')->name('financial.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\FinancialController::class, 'index'])->name('index');
            Route::get('/refunds', [\App\Http\Controllers\Admin\FinancialController::class, 'refunds'])->name('refunds');
            Route::post('/refunds/{booking}/approve', [\App\Http\Controllers\Admin\FinancialController::class, 'approveRefund'])->name('approve-refund');
            Route::post('/refunds/{booking}/reject', [\App\Http\Controllers\Admin\FinancialController::class, 'rejectRefund'])->name('reject-refund');
            Route::post('/bookings/{booking}/simulate-complete', [\App\Http\Controllers\Admin\FinancialController::class, 'simulateComplete'])->name('simulate-complete');
        });

        // Voucher Management
        Route::prefix('vouchers')->name('vouchers.')->group(function () {
            Route::get('/', [VoucherController::class, 'index'])->name('index');
            Route::get('/create', [VoucherController::class, 'create'])->name('create');
            Route::post('/', [VoucherController::class, 'store'])->name('store');
            Route::get('/{voucher}/edit', [VoucherController::class, 'edit'])->name('edit');
            Route::put('/{voucher}', [VoucherController::class, 'update'])->name('update');
            Route::delete('/{voucher}', [VoucherController::class, 'destroy'])->name('destroy');
            Route::post('/{voucher}/toggle-status', [VoucherController::class, 'toggleStatus'])->name('toggle-status');
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
