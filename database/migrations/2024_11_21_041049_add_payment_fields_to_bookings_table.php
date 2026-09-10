<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Chỉ thêm các cột thanh toán mới
            $table->string('payment_status', 50)
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
                'payment_status',
                'payment_method',
                'payment_id',
                'paid_at'
            ]);
        });
    }
};