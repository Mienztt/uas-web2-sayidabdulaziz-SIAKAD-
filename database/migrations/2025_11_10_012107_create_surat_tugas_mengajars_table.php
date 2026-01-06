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
        Schema::create('surat_tugas_mengajars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dosen_id')->constrained('users'); // FK ke user.id (User dengan role Dosen) 
        $table->foreignId('mata_kuliah_id')->constrained('mks'); // FK ke mks.id (kita pakai 'mks' dari CRUD kemarin) 
        $table->foreignId('kelas_id')->constrained('kelas'); // FK ke kelas.id 
        // $table->unsignedBigInteger('status_id'); // (Draft, Publish)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_tugas_mengajars');
    }
};
