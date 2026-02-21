<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PesanKontak extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'subjek',
        'pesan',
    ];

    protected $casts = [
        'dibaca' => 'boolean',
        'dibalas' => 'boolean',
        'tanggal_dibaca' => 'datetime',
        'tanggal_dibalas' => 'datetime',
    ];
}
