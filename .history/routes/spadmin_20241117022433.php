<?php
use App\Http\Controllers\Spadmin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Spadmin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('spadmin')->name('spadmin.')->group(function () {
    // Guest routes
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store']);
    });

    // Protected routes
    Route::middleware('auth:spadmin')->group(function () {
        Route::get('/dashboard', function () {
            return view('spadmin.dashboard');
        })->name('dashboard');

        // Profile
         Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])
            ->name('profile.destroy');
    });

    // Password & Logout
    Route::put('password', [PasswordController::class, 'update'])
        ->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});