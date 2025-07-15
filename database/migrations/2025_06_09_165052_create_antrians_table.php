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
        Schema::create('antrians', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemilik');
            $table->string('nomor_motor')->unique();
            $table->string('type_motor');
            $table->enum('status', ['draft', 'dalam_antrian', 'selesai'])->default('draft');
            $table->timestamp('tanggal_masuk')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('nomor_antrian')->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrians');
    }
};
