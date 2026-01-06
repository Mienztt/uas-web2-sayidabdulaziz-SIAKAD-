<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Mk extends Model
{
    use HasFactory;
     protected $table = 'mks'; 
      protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
    ];

    // Relasi: Satu Mata Kuliah MEMILIKI BANYAK Jadwal
    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }

    public function suratTugasMengajar()
{
    return $this->hasMany(SuratTugasMengajar::class, 'mata_kuliah_id');
}
}
