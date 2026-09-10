<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Đổi tên cột number_of_people thành adults
            $table->renameColumn('number_of_people', 'adults');
            
            // Thêm cột children sau adults
            $table->integer('children')->default(0)->after('adults');
            
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
            // Rollback rename column
            $table->renameColumn('adults', 'number_of_people');
            
            // Rollback các thay đổi
            $table->dropColumn([
                'children',
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