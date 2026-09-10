<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Thêm trường adults và children thay vì rename
            $table->integer('adults')->after('booking_date')->default(1);
            $table->integer('children')->after('adults')->default(0);
            
            // Thông tin thanh toán
            $table->enum('payment_status', ['unpaid', 'paid', 'refunded'])
                ->default('unpaid')
                ->after('status');
            $table->string('payment_method')->nullable()->after('payment_status');
            $table->string('payment_id')->nullable()->after('payment_method');
            $table->timestamp('paid_at')->nullable()->after('payment_id');

            // Xóa cột number_of_people cũ
            $table->dropColumn('number_of_people');
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Thêm lại cột number_of_people
            $table->integer('number_of_people')->after('booking_date');
            
            // Xóa các cột đã thêm
            $table->dropColumn([
                'adults',
                'children',
                'payment_status',
                'payment_method',
                'payment_id',
                'paid_at'
            ]);
        });
    }
};