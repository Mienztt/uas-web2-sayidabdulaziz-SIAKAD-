<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            // tambahkan kolom id_prodi sebagai foreign key
            $table->unsignedBigInteger('id_prodi')->nullable()->after('alamat');
        
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropForeign(['id_prodi']);
            $table->dropColumn('id_prodi');
        });
    }
};
