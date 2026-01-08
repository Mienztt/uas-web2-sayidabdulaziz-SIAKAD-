<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    // FIX: Pastikan semua kolom ini ada di fillable
    protected $fillable = [
        'nim',
        'nama',
        'alamat',
        'prodi_id',
        'dosen_pembimbing_id',
        'gambar_profil',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function dosenPembimbing()
    {
        // Relasi ke tabel dosens (pastikan nama tabel & foreign key benar)
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing_id');
    }
}