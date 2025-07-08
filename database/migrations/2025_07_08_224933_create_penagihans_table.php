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
        Schema::create('penagihans', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('antrian_id');
        $table->string('pesan');
        $table->timestamps();

        $table->foreign('antrian_id')->references('id')->on('antrians')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penagihans');
    }
};
