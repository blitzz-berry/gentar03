<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\PesanKontak;
use App\Models\Artikel;
use App\Models\Galeri;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $this->middleware('auth');

        // Hitung statistik
        $totalKegiatan = Kegiatan::count();
        $totalKegiatanBulanIni = Kegiatan::whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->count();
        $totalPesanMasuk = PesanKontak::count();
        $pesanBelumDibaca = PesanKontak::where('dibaca', false)->count();

        // Ambil data terbaru
        $kegiatanTerbaru = Kegiatan::orderBy('tanggal', 'desc')->limit(5)->get();
        $pesanTerbaru = PesanKontak::orderBy('created_at', 'desc')->limit(5)->get();

        // Data untuk grafik (jumlah kegiatan per bulan dalam setahun terakhir)
        $kegiatanPerBulan = [];
        for ($i = 11; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i);
            $jumlah = Kegiatan::whereYear('tanggal', $bulan->year)
                ->whereMonth('tanggal', $bulan->month)
                ->count();
            $kegiatanPerBulan[] = [
                'bulan' => $bulan->format('M Y'),
                'jumlah' => $jumlah
            ];
        }

        return view('dashboard', [
            'totalKegiatan' => $totalKegiatan,
            'totalKegiatanBulanIni' => $totalKegiatanBulanIni,
            'totalPesanMasuk' => $totalPesanMasuk,
            'pesanBelumDibaca' => $pesanBelumDibaca,
            'kegiatanTerbaru' => $kegiatanTerbaru,
            'pesanTerbaru' => $pesanTerbaru,
            'kegiatanPerBulan' => $kegiatanPerBulan,
        ]);
    }
}
