<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('messages', function (Blueprint $table) {
        if (!Schema::hasColumn('messages', 'receiver_id')) {
            $table->foreignId('receiver_id')->after('user_id')->constrained('users')->onDelete('cascade');
        }
    });
}
public function down()
{
    Schema::table('messages', function (Blueprint $table) {
        $table->dropForeign(['receiver_id']);
        $table->dropColumn('receiver_id');
    });
}
};
