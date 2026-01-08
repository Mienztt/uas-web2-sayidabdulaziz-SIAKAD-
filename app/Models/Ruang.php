<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ruang extends Model
{
    use HasFactory;

    // Tambahkan ini agar aman saat input data
    protected $fillable = ['nama_ruang']; 

    protected $guarded = ['id'];

    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}