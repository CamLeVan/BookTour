<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Spadmin\DashboardController;
use App\Http\Controllers\Spadmin\TourManagementController;
use App\Http\Controllers\Spadmin\BookingManagementController;
use App\Http\Controllers\Spadmin\StatisticsController;

Route::middleware(['auth', 'spadmin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('spadmin.dashboard');
    
    // Tours Management
    Route::resource('tours', TourManagementController::class);
    
    // Bookings Management
    Route::resource('bookings', BookingManagementController::class);
    
    // Statistics
    Route::get('statistics', [StatisticsController::class, 'index'])->name('spadmin.statistics');
    Route::get('statistics/revenue', [StatisticsController::class, 'revenue'])->name('spadmin.statistics.revenue');
});