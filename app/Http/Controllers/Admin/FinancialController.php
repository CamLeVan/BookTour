<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FinancialController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->startOfDay();

        // 1. Tạm Thu (Unearned Revenue / Deposit Liability)
        // Tiền của các tour đã thanh toán/cọc nhưng chưa đi (hoặc chưa completed)
        $unearnedBookings = Booking::whereIn('payment_status', ['paid', 'deposit_paid'])
            ->whereNull('completed_at')
            ->where('booking_date', '>=', $today)
            ->where('status', '!=', 'cancelled')
            ->get();

        $unearnedRevenue = $unearnedBookings->sum(function ($b) {
            return $b->payment_status === 'deposit_paid' ? $b->deposit_amount : $b->total_amount;
        });

        // 2. Doanh Thu Thực Nhận (Earned Revenue)
        // Tiền của các tour đã hoàn thành
        $earnedBookings = Booking::where(function ($q) use ($today) {
            $q->where('status', 'completed')
              ->orWhereNotNull('completed_at')
              ->orWhere('booking_date', '<', $today);
        })
        ->whereIn('payment_status', ['paid', 'deposit_paid'])
        ->where('status', '!=', 'cancelled')
        ->get();

        $earnedRevenue = $earnedBookings->sum(function ($b) {
            return $b->payment_status === 'deposit_paid' ? $b->deposit_amount : $b->total_amount;
        });

        // 3. Phân chia Hoa hồng & Payout
        $platformCommission = round($earnedRevenue * 0.15); // 15% Hoa hồng sàn
        $partnerPayout = max(0, $earnedRevenue - $platformCommission); // 85% Quyết toán nhà cung cấp

        // 4. Tổng tiền cọc đang giữ
        $depositsHeld = Booking::where('payment_status', 'deposit_paid')
            ->where('status', '!=', 'cancelled')
            ->sum('deposit_amount');

        // 5. Tổng tiền nợ 70% còn lại của khách
        $totalRemainingBalance = Booking::where('payment_status', 'deposit_paid')
            ->where('status', '!=', 'cancelled')
            ->sum('remaining_amount');

        // 6. Tổng tiền đã hoàn trả
        $totalRefunded = Booking::where('refund_status', 'refunded')->sum('refund_amount');

        // 7. Danh sách booking gần đây kèm trạng thái tài chính
        $recentFinancialBookings = Booking::with(['user', 'tour'])
            ->latest()
            ->paginate(15);

        return view('admin.financial.index', compact(
            'unearnedRevenue',
            'earnedRevenue',
            'platformCommission',
            'partnerPayout',
            'depositsHeld',
            'totalRemainingBalance',
            'totalRefunded',
            'recentFinancialBookings'
        ));
    }

    public function refunds()
    {
        $refundRequests = Booking::with(['user', 'tour'])
            ->whereIn('refund_status', ['requested', 'approved', 'refunded', 'rejected'])
            ->latest()
            ->paginate(15);

        return view('admin.financial.refunds', compact('refundRequests'));
    }

    public function approveRefund(Booking $booking)
    {
        if ($booking->refund_status === 'refunded') {
            return back()->with('error', 'Yêu cầu này đã hoàn tiền trước đó.');
        }

        $booking->update([
            'refund_status' => 'refunded',
            'payment_status' => 'refunded',
            'status' => 'cancelled'
        ]);

        return back()->with('success', '⚡ [Giả Lập VNPay Reversal] Đã duyệt và giả lập lệnh chuyển hoàn ' . number_format($booking->refund_amount, 0, ',', '.') . ' VNĐ thành công về tài khoản của khách!');
    }

    public function rejectRefund(Booking $booking)
    {
        $booking->update([
            'refund_status' => 'rejected'
        ]);

        return back()->with('success', 'Đã từ chối yêu cầu hoàn tiền.');
    }

    public function simulateComplete(Booking $booking)
    {
        $booking->update([
            'status' => 'completed',
            'completed_at' => Carbon::now()
        ]);

        return back()->with('success', '⚡ [Giả Lập Kế Toán] Đã hoàn thành Tour! Dòng tiền đã được ghi nhận vào DOANH THU THỰC NHẬN & tự động tính Hoa hồng sàn (15%) + Quyết toán Đối tác (85%).');
    }
}
