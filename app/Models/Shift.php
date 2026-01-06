<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import relasi
class Shift extends Model
{
    use HasFactory;
    protected $guarded = ['id']; // Boleh diisi massal

    // Relasi: Satu Shift MEMILIKI BANYAK Jadwal
    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}
