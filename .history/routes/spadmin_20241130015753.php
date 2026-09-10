<?php

use App\Http\Controllers\Spadmin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Spadmin\TourSpController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SpAdminMiddleware;
use App\Http\Controllers\Spadmin\BookingSpController;
use App\Http\Controllers\Spadmin\AdminSpController;
use App\Http\Controllers\Spadmin\CustomerListController;
use App\Http\Controllers\Spadmin\RevenueReportController;
use App\Http\Controllers\Spadmin\UserReportController;
use App\Livewire\Spadmin\ManageCustomerList\CustomerList;

Route::prefix('spadmin')->name('spadmin.')->group(function () {
    // Guest routes
    Route::middleware('guest:spadmin')->group(function () {
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    });

    // Protected routes
    Route::middleware(['auth', SpAdminMiddleware::class])->group(function () {
        Route::get('/dashboard', function () {
            try {
                return view('spadmin.dashboard');
            } catch (\Exception $e) {
                // Debug
                dd($e->getMessage());
            }
        })->name('dashboard');

        // Tours Management Routes
        Route::prefix('tours')->name('tours.')->group(function () {
            Route::get('/', [TourSpController::class, 'index'])->name('tour-list-sp');
            Route::get('/{tour}', [TourSpController::class, 'show'])->name('show');
            Route::get('/pending', [TourSpController::class, 'pending'])->name('pending');
            Route::post('/{tour}/approve', [TourSpController::class, 'approve'])->name('approve');
            Route::post('/{tour}/reject', [TourSpController::class, 'reject'])->name('reject');
        });

        // Bookings Management Routes
        Route::prefix('bookings')->name('bookings.')->group(function () {
            Route::get('/', [BookingSpController::class, 'index'])->name('index');
            Route::get('/{booking}', [BookingSpController::class, 'show'])->name('show');
        });

        // Admins Management Routes
        Route::prefix('admins')->name('admins.')->group(function () {
            Route::get('/', [AdminSpController::class, 'index'])->name('index');
        });

        // Customer Management Routes
        Route::prefix('managecustomerlist')->name('managecustomerlist.')->group(function () {
            Route::get('/', [CustomerListController::class, 'index'])->name('customerlistsp');
        });

        // Revenue Management Routes
        Route::prefix('revenue')->name('revenue.')->group(function () {
            Route::get('/', [RevenueReportController::class, 'index'])->name('revenuereport');
        });

        // User Report Routes
        Route::get('/user-report', [UserReportController::class, 'index'])->name('user.report');

        Route::get('/customers', CustomerList::class)->name('customers');
    });
});