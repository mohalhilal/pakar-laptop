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
        Schema::create('solusi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kerusakan');
            $table->text('solusi');
            $table->timestamps();

            $table->foreign('kode_kerusakan')->references('kode')->on('kerusakan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solusi');
    }
};
