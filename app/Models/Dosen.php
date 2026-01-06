<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'dosens';

    protected $fillable = [
        'id',
        'nama_dosen',
        'inisial',
        // tambahkan kolom lain sesuai tabel dosens Anda
    ];
}