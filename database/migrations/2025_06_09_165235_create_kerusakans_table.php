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
        Schema::create('kerusakans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kerusakan'); // Kolom untuk nama kerusakan
            $table->integer('estimasi_waktu'); // Kolom untuk estimasi waktu perbaikan
            $table->timestamps(); // Kolom untuk timestamps (created_at dan updated_at)
            $table->softDeletes(); // Kolom untuk soft delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerusakans');
    }
};
