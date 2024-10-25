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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); // Khóa chính tự động tăng
            $table->foreignId('user_id')->constrained('users'); // Khóa ngoại liên kết tới bảng users
            $table->foreignId('tour_id')->constrained('tours'); // Khóa ngoại liên kết tới bảng tours
            $table->string('status'); // Trạng thái đặt chỗ: booked, paid, cancelled
            $table->timestamps(); // Timestamps cho created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings'); // Xóa bảng bookings nếu cần
    }
};
