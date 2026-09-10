<?php
use App\Http\Controllers\Spadmin\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::prefix('spadmin')->name('spadmin.')->group(function () {
    // Guest routes
    Route::middleware('guest:spadmin')->group(function () {
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    });

    // Protected routes
    Route::middleware('auth:spadmin')->group(function () {
        Route::get('/dashboard', function () {
            try {
                return view('spadmin.dashboard');
            } catch (\Exception $e) {
                // Debug
                dd($e->getMessage());
            }
        })->name('dashboard');
    });
});