<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratTugas extends Model
{
    use HasFactory;

    protected $table = 'surat_tugas';

    protected $fillable = [
        'nomor_surat',
        'dosen_id',
        'semester_aktif',
        'tanggal_terbit',
    ];

    /**
     * Relasi: Surat Tugas ini milik satu Dosen
     */
    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
}