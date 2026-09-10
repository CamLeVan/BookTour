<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VietQRService
{
    /**
     * Thông tin ngân hàng
     */
    protected array $bankInfo;

    public function __construct()
    {
        $this->bankInfo = [
            'accountNo' => '1039398990',
            'accountName' => 'LE VAN CAM',
            'acqId' => '970436', // Mã VCB
        ];
    }

    /**
     * Tạo mã QR cho thanh toán
     *
     * @param float $amount Số tiền thanh toán
     * @param string $bookingCode Mã booking
     * @return string URL của mã QR
     * @throws \Exception
     */
    public function generateQR(float $amount, string $bookingCode): string
    {
        try {
            $data = array_merge($this->bankInfo, [
                'amount' => $amount,
                'addInfo' => $bookingCode,
                'template' => 'compact2'
            ]);

            $response = Http::post('https://api.vietqr.io/v2/generate', $data);

            if ($response->successful()) {
                return $response->json()['data']['qrDataURL'];
            }

            throw new \Exception('Không thể tạo mã QR: ' . $response->body());
        } catch (\Exception $e) {
            Log::error('VietQR Error: ' . $e->getMessage(), [
                'amount' => $amount,
                'bookingCode' => $bookingCode
            ]);
            throw $e;
        }
    }

    /**
     * Validate transaction data từ webhook
     */
    public function validateTransaction(array $data): bool
    {
        return isset($data['accountNo']) 
            && $data['accountNo'] === $this->bankInfo['accountNo']
            && isset($data['amount'])
            && isset($data['description']);
    }

    /**
     * Extract booking code từ nội dung chuyển khoản
     */
    public function extractBookingCode(string $description): ?string
    {
        if (preg_match('/TOUR[A-Z0-9]+/', $description, $matches)) {
            return $matches[0];
        }
        return null;
    }
} 