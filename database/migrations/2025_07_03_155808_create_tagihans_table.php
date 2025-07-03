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
    Schema::create('tagihans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('antrian_id')->constrained()->onDelete('cascade'); // Menghubungkan dengan antrian
        $table->decimal('jumlah', 10, 2); // Jumlah tagihan
        $table->string('status')->default('belum dibayar'); // Status tagihan
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
