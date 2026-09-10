<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Controllers
use App\Http\Controllers\Frontend\{HomeController, AboutController, TourController, BlogController, ContactController, NewsletterController, DestinationController, BookingController, PaymentController};
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Spadmin\DashboardController as SpadminDashboardController;

// Middleware
use App\Http\Middleware\{CheckFrontend, SpadminMiddleware, AdminMiddleware};

// === Frontend Routes ===
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
            Route::get('/search', [TourController::class, 'search'])->name('search');
            Route::get('/category/{category}', [TourController::class, 'category'])->name('category');
            Route::get('/{tour}', [TourController::class, 'show'])->name('show');

            // Booking (requires auth)
            Route::middleware(['auth'])->group(function () {
                Route::post('/{tour}/booking', [TourController::class, 'booking'])->name('booking');
            });
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
        Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

        // Bookings
        Route::middleware(['auth'])->prefix('bookings')->name('bookings.')->group(function () {
            Route::get('/vnpay/return', [TourController::class, 'vnPayReturn'])->name('vnpay.return');
            Route::get('/failed', [TourController::class, 'failed'])->name('failed');
        });
    });

// === User Dashboard Routes ===
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->role !== 'user') {
            return redirect('/');
        }
        return view('dashboard');
    })->name('dashboard');
});

// === Profile Routes ===
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// === Auth Routes ===
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/spadmin.php';

// === Debugging Routes ===
Route::get('/test-spadmin', [SpadminDashboardController::class, 'index']);

// === Blog Routes ===
Route::prefix('blog')->name('frontend.blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/search', [BlogController::class, 'search'])->name('search');
    Route::get('/category/{slug}', [BlogController::class, 'category'])->name('category');
    Route::get('/tag/{slug}', [BlogController::class, 'tag'])->name('tag');
    Route::get('/archive/{year}/{month}', [BlogController::class, 'archive'])->name('archive');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});

// === booking nâng cao ===
Route::middleware(['auth'])->prefix('bookings')->name('frontend.bookings.')->group(function () {
    Route::get('/tours/{tour}/book', [BookingController::class, 'create'])->name('create');
    Route::get('/{tour}/review', [BookingController::class, 'review'])->name('review');
    Route::post('/{tour}/apply-voucher', [BookingController::class, 'applyVoucher'])->name('apply-voucher');
    Route::post('/{tour}/remove-voucher', [BookingController::class, 'removeVoucher'])->name('remove-voucher');
    Route::post('/{tour}/store', [BookingController::class, 'store'])->name('store');
    Route::get('/{booking}/payment', [BookingController::class, 'payment'])->name('payment');
    Route::post('/{booking}/process-payment', [BookingController::class, 'processPayment'])->name('process-payment');
    Route::get('/{booking}/success', [BookingController::class, 'success'])->name('success');
    Route::get('/history', [BookingController::class, 'history'])->name('history');
    Route::post('/{booking}/pay-remaining', [BookingController::class, 'payRemaining'])->name('pay-remaining');
    Route::post('/{booking}/request-refund', [BookingController::class, 'requestRefund'])->name('request-refund');
    Route::post('/{booking}/simulate-expire', [BookingController::class, 'simulateExpire'])->name('simulate-expire');
    Route::post('/{booking}/review', [\App\Http\Controllers\Frontend\ReviewController::class, 'store'])->name('review.store');
});

// === Payment Webhooks VNP => lỗilỗi ===
Route::post('webhooks/payment', [PaymentController::class, 'handleWebhook'])
    ->middleware('validate.payment.webhook')
    ->name('webhooks.payment');

// === Development-Only Routes ===
if (config('app.env') === 'local') {
    Route::post('/bookings/{pendingBooking}/simulate-payment', [PaymentController::class, 'simulatePayment'])
        ->name('frontend.bookings.simulate-payment');
}

// === Email Verification ===
Route::get('/email/verify/{id}/{hash}', function (Request $request) {
    // Email verification logic
})->middleware(['auth', 'signed'])->name('verification.verify');
