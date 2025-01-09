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
        Schema::create('aturan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_gejala')->references('kode')->on('gejala')->onDelete('cascade');
            $table->string('kode_kerusakan')->references('kode')->on('kerusakan')->onDelete('cascade');
            $table->float('cf_pakar', 8, 2)->default(0.0);
            $table->timestamps();

            $table->foreign('kode_kerusakan')->references('kode')->on('kerusakan')->onDelete('cascade');
            $table->foreign('kode_gejala')->references('kode')->on('gejala')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aturan');
    }
};
