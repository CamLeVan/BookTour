<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddForeignKeyToTours extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('tours', 'user_id')) {
            Schema::table('tours', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            });
        }

        $adminUser = DB::table('users')->where('role', 'admin')->first();

        if ($adminUser) {
            DB::table('tours')
                ->whereNull('user_id')
                ->update(['user_id' => $adminUser->id]);
        }
    }

    public function down()
    {
        if (Schema::hasColumn('tours', 'user_id')) {
            Schema::table('tours', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }
    }
}
