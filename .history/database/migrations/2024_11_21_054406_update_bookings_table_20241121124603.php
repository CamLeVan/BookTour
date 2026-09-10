<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Thêm số lượng người lớn/trẻ em
            $table->integer('adults')->default(1)->after('booking_date');
            $table->integer('children')->default(0)->after('adults');
            
            // Thêm thông tin thanh toán
            $table->enum('payment_status', ['unpaid', 'paid', 'refunded'])
                  ->default('unpaid')
                  ->after('status');
            $table->string('payment_method', 50)->nullable()->after('payment_status');
            $table->string('payment_id', 100)->nullable()->after('payment_method');
            $table->timestamp('paid_at')->nullable()->after('payment_id');
            
            // Mở rộng các trạng thái
            $table->enum('status', [
                'pending',
                'confirmed', 
                'completed',
                'cancelled',
                'refunded'
            ])->default('pending')->change();
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Rollback các thay đổi
            $table->dropColumn([
                'adults',
                'children',
                'payment_status',
                'payment_method',
                'payment_id',
                'paid_at'
            ]);
            
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])
                  ->default('pending')
                  ->change();
        });
    }
};