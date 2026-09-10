<?php
use App\Http\Controllers\Spadmin\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::prefix('spadmin')->name('spadmin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    });

    Route::middleware(['auth', 'role:spadmin'])->group(function () {
        Route::get('/dashboard', function () {
            return view('spadmin.dashboard');
        })->name('dashboard');
    });
});