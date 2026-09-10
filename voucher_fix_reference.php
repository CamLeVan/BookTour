<?php

/* ==============================================================================
 * TỆP THAM KHẢO SỬA LỖI LOGIC: LẠM DỤNG VOUCHER (VOUCHER EXPLOIT)
 * File này chỉ chứa code tham khảo đã được comment để không ảnh hưởng đến dự án.
 * ============================================================================== */

/* 
--------------------------------------------------------------------------------
SỬA LỖI: CHẶN USER SỬ DỤNG 1 MÃ GIẢM GIÁ NHIỀU LẦN
- File cần sửa: app/Models/Voucher.php
- Vị trí: Cập nhật lại hàm validateForOrder()
- Cách fix: Thêm logic query vào bảng bookings để kiểm tra xem Auth::user() 
            đã từng dùng mã này cho các đơn hàng thành công/đang xử lý chưa.
--------------------------------------------------------------------------------
*/

/*
    // Thay thế toàn bộ hàm validateForOrder hiện tại trong app/Models/Voucher.php bằng code này:

    public function validateForOrder(float $orderTotal): array
    {
        if ($this->status !== 'active') {
            return ['valid' => false, 'message' => 'Mã giảm giá này hiện không hoạt động.'];
        }

        $now = \Carbon\Carbon::now();
        if ($this->start_date && $now->lt($this->start_date)) {
            return ['valid' => false, 'message' => 'Mã giảm giá chưa đến thời gian sử dụng.'];
        }

        if ($this->end_date && $now->gt($this->end_date)) {
            return ['valid' => false, 'message' => 'Mã giảm giá đã hết hạn sử dụng.'];
        }

        // [GIỮ NGUYÊN] Kiểm tra giới hạn tổng số lần sử dụng của toàn hệ thống
        if ($this->usage_limit !== null && $this->used_count >= $this->usage_limit) {
            return ['valid' => false, 'message' => 'Mã giảm giá đã hết lượt sử dụng.'];
        }

        // --------------------------------------------------------------------
        // [SỬA LỖI TẠI ĐÂY] Kiểm tra giới hạn 1 lần sử dụng đối với mỗi User
        // --------------------------------------------------------------------
        if (\Illuminate\Support\Facades\Auth::check()) {
            $userId = \Illuminate\Support\Facades\Auth::id();
            
            // Đếm số đơn hàng của user này đã sử dụng voucher hiện tại.
            // Bỏ qua các đơn đã bị 'cancelled' hoặc 'expired' (trả lại mã cho khách).
            $userUsageCount = \App\Models\Booking::where('user_id', $userId)
                                ->where('voucher_id', $this->id)
                                ->whereNotIn('status', ['cancelled', 'expired'])
                                ->count();

            // Nếu user đã dùng mã này rồi -> Chặn lại
            if ($userUsageCount > 0) {
                return [
                    'valid' => false, 
                    'message' => 'Bạn đã sử dụng mã giảm giá này rồi. Mỗi tài khoản chỉ được dùng 1 lần.'
                ];
            }
        }
        // --------------------------------------------------------------------

        if ($orderTotal < $this->min_order_value) {
            return [
                'valid' => false,
                'message' => 'Đơn hàng tối thiểu ' . number_format($this->min_order_value, 0, ',', '.') . 'đ để sử dụng mã này.'
            ];
        }

        return ['valid' => true, 'message' => 'Áp dụng mã giảm giá thành công!'];
    }
*/

?>
