<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Kegiatan;

class Galeri extends Model
{
    use HasFactory;

    protected $fillable = [
        'kegiatan_id',
        'judul',
        'deskripsi',
        'path_file',
        'tipe',
        'kategori',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
