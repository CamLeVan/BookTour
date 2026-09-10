<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPendingBookingStatus
{
    public function handle(Request $request, Closure $next)
    {
        $pendingBooking = $request->route('pendingBooking');

        if ($pendingBooking->isExpired()) {
            return redirect()->route('frontend.tours.show', $pendingBooking->tour)
                           ->with('error', 'Phiên đặt tour đã hết hạn.');
        }

        if (!$pendingBooking->isPending()) {
            return redirect()->route('frontend.tours.show', $pendingBooking->tour)
                           ->with('error', 'Trạng thái booking không hợp lệ.');
        }

        return $next($request);
    }
} 