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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('hari', 50); // Misal: Senin, Selasa
            $table->time('jam_mulai'); // Misal: 07:30:00
            $table->time('jam_selesai'); // Misal: 10:00:00
            $table->string('prodi', 100); // Misal: S1 SI, D3 KA
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
