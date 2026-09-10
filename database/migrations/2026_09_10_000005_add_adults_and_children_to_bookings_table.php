<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'adults')) {
                $table->integer('adults')->default(1)->after('booking_date');
            }
            if (!Schema::hasColumn('bookings', 'children')) {
                $table->integer('children')->default(0)->after('adults');
            }
        });

        // Update status enum/varchar and number_of_people default
        try {
            DB::statement("ALTER TABLE bookings MODIFY COLUMN status VARCHAR(50) NOT NULL DEFAULT 'pending'");
            DB::statement("ALTER TABLE bookings MODIFY COLUMN number_of_people INT NOT NULL DEFAULT 1");
        } catch (\Throwable $e) {
            // Ignore if already string or running in different environment
        }
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'adults')) {
                $table->dropColumn('adults');
            }
            if (Schema::hasColumn('bookings', 'children')) {
                $table->dropColumn('children');
            }
        });
    }
};
