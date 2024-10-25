<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // Khóa chính tự động tăng
            $table->foreignId('booking_id')->constrained('bookings'); // Khóa ngoại liên kết tới bảng bookings
            $table->decimal('amount', 8, 2); // Số tiền thanh toán
            $table->date('payment_date'); // Ngày thanh toán
            $table->string('payment_method'); // Phương thức thanh toán: thẻ tín dụng, ví điện tử
            $table->string('payment_status'); // Trạng thái thanh toán: thành công, thất bại
            $table->timestamps(); // Timestamps cho created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments'); // Xóa bảng payments nếu cần
    }
};
