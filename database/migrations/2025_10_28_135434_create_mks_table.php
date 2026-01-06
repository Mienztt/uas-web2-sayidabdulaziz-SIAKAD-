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
        Schema::create('mks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mk', 255); // Misal: Analisa Proses Bisnis
            $table->string('kode_mk', 20)->nullable(); // Misal: SI101
            $table->integer('sks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mks');
    }
};
