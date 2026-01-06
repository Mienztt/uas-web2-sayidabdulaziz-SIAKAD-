<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            // hapus kolom yang tidak dibutuhkan
            if (Schema::hasColumn('mahasiswa', 'jurusan')) {
                $table->dropColumn('jurusan');
            }
            if (Schema::hasColumn('mahasiswa', 'angkatan')) {
                $table->dropColumn('angkatan');
            }

            // tambahkan kolom alamat jika belum ada
            if (!Schema::hasColumn('mahasiswa', 'alamat')) {
                $table->string('alamat')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            // rollback: tambahkan kolom lama
            $table->string('jurusan')->nullable();
            $table->integer('angkatan')->nullable();

            // hapus kolom alamat jika rollback
            $table->dropColumn('alamat');
        });
    }
};
