<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mhs extends Model
{
    use HasFactory;

    // Karena nama tabelmu 'mhs' (bukan plural 'mhs_s'), kita harus sebutkan spesifik
    protected $table = 'mhs'; 
    
    // Matikan timestamps karena tabel hasil import biasanya tidak punya kolom created_at/updated_at
    public $timestamps = false; 
    
    protected $guarded = [];
}