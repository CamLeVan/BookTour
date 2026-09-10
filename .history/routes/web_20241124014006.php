<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Spadmin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\TourController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Spadmin\DashboardController as SpadminDashboardController;
use App\Http\Controllers\Frontend\DestinationController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Middleware\CheckFrontend;
use App\Http\Middleware\SpadminMiddleware;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Frontend\PaymentController;


// Frontend Routes
Route::middleware(['web', CheckFrontend::class])
    ->name('frontend.')
    ->group(function () {
        // Home
        Route::get('/', [HomeController::class, 'index'])->name('home');

        // About
        Route::get('/about', [AboutController::class, 'index'])->name('about');

        // Tours
        Route::prefix('tours')->name('tours.')->group(function () {
            Route::get('/', [TourController::class, 'index'])->name('index');
            Route::get('/{tour}', [TourController::class, 'show'])->name('show');
            Route::get('/search', [TourController::class, 'search'])->name('search');
            Route::get('/category/{category}', [TourController::class, 'category'])->name('category');
            
            // Booking routes (cần auth)
            Route::middleware(['auth'])->group(function () {
                Route::post('/{tour}/booking', [TourController::class, 'booking'])
                    ->name('booking');
            });
        });

        // Blog
        Route::prefix('blog')->name('blog.')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('index');
            Route::get('/{post}', [BlogController::class, 'show'])->name('show');
            Route::get('/category/{category}', [BlogController::class, 'category'])->name('category');
            Route::get('/search', [BlogController::class, 'search'])->name('search');
        });

        // Contact
        Route::get('/contact', [ContactController::class, 'index'])->name('contact');
        Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

        // Destinations
        Route::prefix('destinations')->name('destinations.')->group(function () {
            Route::get('/', [DestinationController::class, 'index'])->name('index');
            Route::get('/{destination}', [DestinationController::class, 'show'])->name('show');
        });

        // Newsletter
        Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
            ->name('newsletter.subscribe');

        // Booking routes (cần auth)
        Route::middleware(['auth'])->prefix('bookings')->name('bookings.')->group(function () {
            Route::get('/vnpay/return', [TourController::class, 'vnPayReturn'])
                ->name('vnpay.return');
            Route::get('/success/{booking}', [TourController::class, 'success'])
                ->name('success');
            Route::get('/failed', [TourController::class, 'failed'])
                ->name('failed');
              });
    });

// User Dashboard Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->role !== 'user') {
            return redirect('/');
        }
        return view('dashboard');
    })->name('dashboard');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Routes
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/spadmin.php';
// Admin Routes
// Route::middleware(['auth', AdminMiddleware::class])
//     ->prefix('admin')
//     ->name('admin.')
//     ->group(function () {
//         Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
//     });

// Spadmin Routes
Route::middleware(['auth', SpadminMiddleware::class])
    ->prefix('spadmin')
    ->name('spadmin.')
    ->group(function () {
        Route::get('/dashboard', [SpadminDashboardController::class, 'index'])->name('dashboard');
    });

// Thêm route test không có middleware để debug
Route::get('/test-spadmin', [App\Http\Controllers\Spadmin\DashboardController::class, 'index']);

Route::name('frontend.')->group(function () {
    Route::get('/tours', [TourController::class, 'index'])->name('tours.index');
    Route::get('/tours/{tour}', [TourController::class, 'show'])->name('tours.show');

    // Thêm route cho booking
    Route::post('/tours/{tour}/booking', [TourController::class, 'booking'])
        ->name('tours.booking');

    Route::get('/bookings/history', [BookingController::class, 'history'])->name('booking.history');
});

Route::group(['prefix' => 'blog', 'as' => 'frontend.blog.'], function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/search', [BlogController::class, 'search'])->name('search');
    Route::get('/category/{slug}', [BlogController::class, 'category'])->name('category');
    Route::get('/tag/{slug}', [BlogController::class, 'tag'])->name('tag');
    Route::get('/archive/{year}/{month}', [BlogController::class, 'archive'])->name('archive');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});

// Booking Routes
Route::middleware(['auth'])->name('frontend.')->group(function () {
    Route::prefix('bookings')->name('bookings.')->group(function () {
        Route::get('/tours/{tour}/book', [BookingController::class, 'create'])->name('create');
        Route::get('/{pendingBooking}/review', [BookingController::class, 'review'])->name('review');
        // ... other routes
    });
});

// Payment Webhook
Route::post('webhooks/payment', [PaymentController::class, 'handleWebhook'])
    ->name('webhooks.payment');

// Thêm middleware cho các routes booking
Route::middleware(['auth', 'check.pending.booking'])->group(function () {
    Route::get('/{pendingBooking}/review', [BookingController::class, 'review']);
    Route::post('/{pendingBooking}/confirm', [BookingController::class, 'confirm']);
});

// Thêm middleware cho webhook
Route::post('webhooks/payment', [PaymentController::class, 'handleWebhook'])
    ->middleware('validate.payment.webhook');

// Chỉ register route này trong môi trường development
if (config('app.env') === 'local') {
    Route::post('/bookings/{pendingBooking}/simulate-payment', [PaymentController::class, 'simulatePayment'])
        ->name('frontend.bookings.simulate-payment');
}

Route::middleware(['auth'])->group(function () {
    Route::get('/bookings/{tour}/review', [BookingController::class, 'review'])
         ->name('frontend.bookings.review');
});


