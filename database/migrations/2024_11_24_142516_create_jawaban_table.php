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
        Schema::create('jawaban', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_konsultasi');
            $table->string('kode_gejala')->references('kode')->on('gejala')->onDelete('cascade');
            $table->float('cf_user', 8, 2)->default(0.0);
            $table->timestamps();

            $table->foreign('id_konsultasi')->references('id')->on('konsultasi')->onDelete('cascade');
            $table->foreign('kode_gejala')->references('kode')->on('gejala')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban');
    }
};
