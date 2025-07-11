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
       Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('content');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade'); // Menambahkan kolom receiver_id
            $table->boolean('is_read')->default(false); // Menambahkan kolom is_read
            $table->timestamp('read_at')->nullable(); // Menambahkan kolom read_at untuk
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
