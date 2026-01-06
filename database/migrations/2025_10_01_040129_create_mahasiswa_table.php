<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
             $table->id();
             $table->foreignId('prodi_id')->nullable()->constrained('prodi')->onDelete('set null');
            $table->string('nim', 20)->unique();
            $table->string('nama', 100);
            $table->string('alamat', 150)->nullable();
             
            $table->timestamps();
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }

};
