<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mk extends Model
{
    use HasFactory;

    protected $table = 'mks'; // Pastikan nama tabelnya 'mks' sesuai SQL

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
    ];
}