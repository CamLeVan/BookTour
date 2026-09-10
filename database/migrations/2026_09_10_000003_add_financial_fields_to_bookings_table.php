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
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'adults')) {
                $table->integer('adults')->default(1)->after('booking_date');
            }
            if (!Schema::hasColumn('bookings', 'children')) {
                $table->integer('children')->default(0)->after('adults');
            }
            if (!Schema::hasColumn('bookings', 'is_deposit')) {
                $table->boolean('is_deposit')->default(false)->after('voucher_id');
            }
            if (!Schema::hasColumn('bookings', 'deposit_amount')) {
                $table->decimal('deposit_amount', 12, 2)->default(0)->after('is_deposit');
            }
            if (!Schema::hasColumn('bookings', 'remaining_amount')) {
                $table->decimal('remaining_amount', 12, 2)->default(0)->after('deposit_amount');
            }
            if (!Schema::hasColumn('bookings', 'hold_expires_at')) {
                $table->dateTime('hold_expires_at')->nullable()->after('remaining_amount');
            }
            if (!Schema::hasColumn('bookings', 'refund_amount')) {
                $table->decimal('refund_amount', 12, 2)->default(0)->after('hold_expires_at');
            }
            if (!Schema::hasColumn('bookings', 'refund_status')) {
                $table->enum('refund_status', ['none', 'requested', 'approved', 'rejected', 'refunded'])->default('none')->after('refund_amount');
            }
            if (!Schema::hasColumn('bookings', 'refund_reason')) {
                $table->text('refund_reason')->nullable()->after('refund_status');
            }
            if (!Schema::hasColumn('bookings', 'completed_at')) {
                $table->dateTime('completed_at')->nullable()->after('refund_reason');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'is_deposit',
                'deposit_amount',
                'remaining_amount',
                'hold_expires_at',
                'refund_amount',
                'refund_status',
                'refund_reason',
                'completed_at',
            ]);
        });
    }
};
