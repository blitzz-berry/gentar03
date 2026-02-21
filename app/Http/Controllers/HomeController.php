<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kegiatan;

class HomeController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::where('aktif', true)
            ->orderBy('tanggal', 'desc')
            ->take(3)
            ->get();

        $artikels = Artikel::where('aktif', true)
            ->orderBy('tanggal_publikasi', 'desc')
            ->take(3)
            ->get();

        return view('welcome', compact('kegiatans', 'artikels'));
    }
}
