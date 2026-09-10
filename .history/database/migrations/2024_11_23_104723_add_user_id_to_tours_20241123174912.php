<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            // Thêm user_id nhưng chưa tạo foreign key
            $table->unsignedBigInteger('user_id')->after('destination_id')->nullable();
            
            // Thêm trạng thái duyệt tour
            $table->enum('status_approval', ['pending', 'approved', 'rejected'])
                  ->after('status')
                  ->default('pending');
        });

        // Cập nhật dữ liệu cũ - gán cho một admin mặc định
        DB::table('tours')->update([
            'user_id' => 1 // ID của một admin mặc định
        ]);
    }

    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn(['user_id', 'status_approval']);
        });
    }
};