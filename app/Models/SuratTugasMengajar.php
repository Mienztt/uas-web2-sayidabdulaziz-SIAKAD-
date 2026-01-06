<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;   
use Illuminate\Database\Eloquent\Relations\HasMany;

class SuratTugasMengajar extends Model
{
    use HasFactory;
    protected $table = 'surat_tugas_mengajars'; // 
    protected $guarded = ['id'];
    public function dosen(): BelongsTo
    {
        // FK 'dosen_id' merujuk ke tabel 'users'
        return $this->belongsTo(User::class, 'dosen_id'); 
    }

    public function mataKuliah(): BelongsTo
    {
        // FK 'mata_kuliah_id' merujuk ke tabel 'mks'
        return $this->belongsTo(Mk::class, 'mata_kuliah_id');
    }

    public function kelas(): BelongsTo
    {
        // FK 'kelas_id' merujuk ke tabel 'kelas'
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
