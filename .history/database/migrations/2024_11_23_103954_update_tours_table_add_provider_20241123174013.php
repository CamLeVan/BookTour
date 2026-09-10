<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            // Thêm user_id để biết tour thuộc nhà cung cấp nào
            $table->foreignId('user_id')
                  ->after('destination_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Thêm trạng thái duyệt tour
            $table->enum('status_approval', ['pending', 'approved', 'rejected'])
                  ->after('status')
                  ->default('pending');
        });
    }

    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'status_approval']);
        });
    }
};