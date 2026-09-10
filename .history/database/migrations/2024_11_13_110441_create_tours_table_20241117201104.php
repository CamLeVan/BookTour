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
            $table->string('name');          // Tên tour
            $table->text('description');     // Mô tả
            $table->decimal('price', 10, 2); // Giá
            $table->integer('duration');     // Số ngày
            $table->integer('max_people');   // Số người tối đa
            $table->string('location');      // Địa điểm
            $table->string('image');         // Ảnh đại diện
            $table->date('start_date');      // Ngày khởi hành
            $table->date('end_date');        // Ngày kết thúc
            $table->text('schedule');        // Lịch trình
            $table->integer('available_slots'); // Số chỗ còn trống
            $table->foreignId('destination_id')->constrained(); // Liên kết với điểm đến
            $table->enum('status', ['active', 'inactive'])->default('active');
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
