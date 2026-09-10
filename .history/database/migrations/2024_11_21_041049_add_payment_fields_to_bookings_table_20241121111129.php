<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Số lượng người chi tiết
            $table->renameColumn('number_of_people', 'adults');
            $table->integer('children')->default(0)->after('number_of_people');
            
            // Thông tin thanh toán
            $table->enum('payment_status', ['unpaid', 'paid', 'refunded'])
                ->default('unpaid')
                ->after('status');
            $table->string('payment_method')->nullable()->after('payment_status');
            $table->string('payment_id')->nullable()->after('payment_method');
            $table->timestamp('paid_at')->nullable()->after('payment_id');
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'children',
                'payment_status',
                'payment_method',
                'payment_id',
                'paid_at'
            ]);
            $table->renameColumn('adults', 'number_of_people');
        });
    }
};