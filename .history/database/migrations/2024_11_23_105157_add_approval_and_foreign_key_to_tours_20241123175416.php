<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // 1. Thêm status_approval trước
        Schema::table('tours', function (Blueprint $table) {
            $table->enum('status_approval', ['pending', 'approved', 'rejected'])
                  ->after('status')
                  ->default('pending');
        });

        // 2. Kiểm tra và cập nhật dữ liệu
        $adminUser = DB::table('users')
            ->where('role', 'admin')
            ->first();

        if ($adminUser) {
            DB::table('tours')->update([
                'user_id' => $adminUser->id
            ]);
        } else {
            // Tạo admin mặc định nếu chưa có
            $adminId = DB::table('users')->insertGetId([
                'name' => 'Default Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('tours')->update([
                'user_id' => $adminId
            ]);
        }

        // 3. Sau khi dữ liệu đã hợp lệ, thêm foreign key
        Schema::table('tours', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('status_approval');
        });
    }
};