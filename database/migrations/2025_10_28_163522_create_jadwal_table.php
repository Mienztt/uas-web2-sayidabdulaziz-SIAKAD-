<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            // $table->string('hari');
            // $table->string('waktu');
            // $table->string('mata_kuliah');
            // $table->string('dosen');
            // $table->string('ruang');
            // $table->string('prodi')->nullable();
            $table->foreignId('mk_id')->constrained('mks')->cascadeOnDelete();
            $table->foreignId('dosen_id')->constrained('dosens')->cascadeOnDelete();
            $table->foreignId('ruang_id')->constrained('ruangs')->cascadeOnDelete();
            $table->foreignId('shift_id')->constrained('shifts')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
