<?php

namespace App\Services;

class MockPaymentService
{
    public function generateQR(float $amount, string $bookingCode): string
    {
        // Tạo mã QR giả
        return "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=MOCK_PAYMENT_" . $bookingCode;
    }

    public function simulatePayment(string $bookingCode): bool
    {
        // Luôn return true để giả lập thanh toán thành công
        return true;
    }
} 