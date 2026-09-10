<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

try {
    echo "Sending test email via SMTP...\n";
    
    Mail::raw("Chào bạn! Đây là email thử nghiệm từ hệ thống HC Travel để kiểm tra dịch vụ Mail Service.", function ($message) {
        $message->to('lvcama2k25@gmail.com')
                ->subject('[HC Travel] Test Chức Năng Gửi Mail - ' . date('d/m/Y H:i:s'));
    });

    echo "SUCCESS: Emailsent successfully!\n";
} catch (\Exception $e) {
    echo "ERROR sending mail: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
