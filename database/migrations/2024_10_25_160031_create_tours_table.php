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
        Schema::create('tours', function (Blueprint $table) {
            $table->id(); // Khóa chính tự động tăng
            $table->string('title'); // Tiêu đề tour
            $table->text('description'); // Mô tả chi tiết về tour
            $table->decimal('price', 8, 2); // Giá tour, với tổng số chữ số là 8 và 2 chữ số sau dấu phẩy
            $table->text('schedule'); // Lịch trình tour
            $table->integer('available_slots'); // Số lượng chỗ trống còn lại
            $table->date('start_date'); // Ngày bắt đầu tour
            $table->date('end_date'); // Ngày kết thúc tour
            $table->foreignId('operator_id')->constrained('users'); // Khóa ngoại liên kết tới bảng users
            $table->string('status'); // Trạng thái của tour: approved, pending, cancelled
            $table->timestamps(); // Timestamps cho created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours'); // Xóa bảng tours nếu cần
    }
};
