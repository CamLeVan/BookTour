<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Mở rộng các trạng thái của status
        DB::statement("ALTER TABLE bookings MODIFY COLUMN status 
            ENUM('pending', 'confirmed', 'completed', 'cancelled', 'refunded') 
            DEFAULT 'pending'");
    }

    public function down()
    {
        // Rollback status enum về các giá trị cũ
        DB::statement("ALTER TABLE bookings MODIFY COLUMN status 
            ENUM('pending', 'confirmed', 'cancelled') 
            DEFAULT 'pending'");
    }
};