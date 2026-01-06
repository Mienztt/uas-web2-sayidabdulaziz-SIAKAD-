<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prodi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_prodi', 10);
            $table->string('nama_prodi', 100);
            $table->string('jenjang', 10);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prodi');
    }
};
