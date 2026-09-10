<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Thêm thông tin thanh toán
            $table->enum('payment_status', ['unpaid', 'paid', 'refunded'])
                  ->default('unpaid')
                  ->after('status');
            $table->string('payment_method', 50)->nullable()->after('payment_status');
            $table->string('payment_id', 100)->nullable()->after('payment_method');
            $table->timestamp('paid_at')->nullable()->after('payment_id');
            
            // Mở rộng các trạng thái
            DB::statement("ALTER TABLE bookings MODIFY COLUMN status ENUM('pending', 'confirmed', 'completed', 'cancelled', 'refunded') DEFAULT 'pending'");
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Rollback các thay đổi
            $table->dropColumn([
                'payment_status',
                'payment_method', 
                'payment_id',
                'paid_at'
            ]);
            
            // Rollback status enum
            DB::statement("ALTER TABLE bookings MODIFY COLUMN status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending'");
        });
    }
};