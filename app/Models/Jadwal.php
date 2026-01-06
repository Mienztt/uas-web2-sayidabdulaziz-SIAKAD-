<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     * @var string
     */
    protected $table = 'jadwal';

    /**
     * Atribut yang dapat diisi secara massal.
     * @var array
     */
    protected $fillable = [
        'dosen_id',
        'mk_id',
        'ruang_id',
        'shift_id',
        'prodi',
    ];

    /**
     * Relasi ke Model Dosen.
     * Mengarah ke tabel 'dosens' melalui model Dosen.
     */
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    /**
     * Relasi ke Model Mata Kuliah (Mk).
     * Mengarah ke tabel 'mks' melalui model Mk.
     */
    public function mk()
    {
        return $this->belongsTo(Mk::class, 'mk_id');
    }

    /**
     * Relasi ke Model Ruang.
     */
    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'ruang_id');
    }

    /**
     * Relasi ke Model Shift.
     */
    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }
}