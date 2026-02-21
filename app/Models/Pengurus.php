<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengurus extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'masa_jabatan',
        'deskripsi',
    ];

    protected $casts = [
        'masa_jabatan' => 'string',
    ];
}
