<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Tên tour
            $table->text('description'); // Mô tả chi tiết
            $table->decimal('price', 10, 2); // Giá tour
            $table->text('schedule'); // Lịch trình
            $table->integer('available_slots'); // Số chỗ còn trống
            $table->date('start_date'); // Ngày khởi hành
            $table->date('end_date'); // Ngày kết thúc
            $table->foreignId('operator_id')->constrained('users'); // Khóa ngoại đến bảng users
            $table->enum('status', ['approved', 'pending', 'canceled']); // Trạng thái của tour
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
