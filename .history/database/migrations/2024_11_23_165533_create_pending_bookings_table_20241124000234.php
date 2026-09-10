<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pending_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('tour_id')->constrained();
            $table->date('booking_date');
            $table->integer('adults');
            $table->integer('children')->default(0);
            $table->decimal('total_amount', 10, 2);
            $table->string('reference_code')->unique(); // Mã để đối chiếu giao dịch
            $table->enum('status', ['pending', 'completed', 'expired', 'cancelled'])
                ->default('pending');
            $table->text('notes')->nullable();
            $table->timestamp('expires_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pending_bookings');
    }
};