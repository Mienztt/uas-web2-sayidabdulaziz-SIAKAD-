<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Jangan lupa import

class Mahasiswa extends Model
{
    use HasFactory;
    
    protected $table = 'mahasiswa';
    
    protected $fillable = [
        'nim',
        'nama',
        'alamat',
        'prodi_id',
        'dosen_pembimbing_id', 
        'gambar_profil',
    ];

    // Relasi ke Prodi (Sudah ada)
    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    // Relasi ke Dosen Pembimbing (Baru)
    public function dosenPembimbing(): BelongsTo
    {
        // Menghubungkan ke tabel 'users' menggunakan foreign key 'dosen_pembimbing_id'
        return $this->belongsTo(User::class, 'dosen_pembimbing_id');
    }
}