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
        Schema::create('hasil', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_konsultasi');
            $table->string('kode_kerusakan');
            $table->BigInteger('persentase');
            $table->timestamps();

            $table->foreign('id_konsultasi')->references('id')->on('konsultasi')->onDelete('cascade');
            $table->foreign('kode_kerusakan')->references('kode')->on('kerusakan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil');
    }
};
