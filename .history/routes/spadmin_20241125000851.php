<?php
use App\Http\Controllers\Spadmin\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::prefix('spadmin')->name('spadmin.')->group(function () {
    // Guest routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    });

    // Protected routes - Chỉ thêm middleware web
    Route::middleware(['web', 'auth', 'spadmin'])->group(function () {
        Route::get('/', function () {
            return redirect()->route('spadmin.dashboard');
        });
        
        Route::get('/dashboard', function () {
            return view('spadmin.dashboard');
        })->name('dashboard');
    });

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout')
        ->middleware('auth');
});