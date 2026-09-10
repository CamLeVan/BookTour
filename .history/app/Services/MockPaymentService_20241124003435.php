<?php

namespace App\Services;

class MockPaymentService
{
    public function generateQR(float $amount, string $bookingCode): string
    {
        // Tạo mã QR giả bằng thư viện QR code
        return "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=VCB-1039398990-" . $bookingCode;
    }

    // Thêm method giả lập thanh toán thành công
    public function simulatePayment(string $bookingCode): bool
    {
        // Luôn return true để giả lập thanh toán thành công
        return true;
    }
} 