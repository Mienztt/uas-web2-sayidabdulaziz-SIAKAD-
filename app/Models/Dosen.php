<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosens';

    protected $fillable = [
        'user_id', 
        'nidn', 
        'nama_dosen', 
        'inisial',
    ];

    // WAJIB ADA: Jembatan ke tabel users
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}