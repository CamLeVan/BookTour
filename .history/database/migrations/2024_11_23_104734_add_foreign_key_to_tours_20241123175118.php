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
            // Thêm trạng thái duyệt tour
            $table->enum('status_approval', ['pending', 'approved', 'rejected'])
                  ->after('status')
                  ->default('pending');

            // Thêm foreign key cho user_id
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });

        // Cập nhật dữ liệu cũ nếu cần
        DB::table('tours')
            ->whereNull('user_id')
            ->update(['user_id' => 1]); // ID của admin mặc định
    }

    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('status_approval');
        });
    }
};