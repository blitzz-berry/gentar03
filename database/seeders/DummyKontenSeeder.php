<?php

namespace Database\Seeders;

use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Kegiatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DummyKontenSeeder extends Seeder
{
    public function run(): void
    {
        $images = $this->prepareDummyAssets();

        $kegiatanA = Kegiatan::updateOrCreate(
            ['judul' => 'Kerja Bakti Lingkungan RW 03'],
            [
                'deskripsi' => 'Kegiatan gotong royong rutin untuk membersihkan lingkungan, saluran air, dan area umum bersama warga.',
                'tanggal' => now()->subDays(14)->toDateString(),
                'lokasi' => 'RW 03 Duri Kosambi',
                'kategori' => 'Bakti Sosial',
                'foto' => $images['kegiatan_a'],
                'aktif' => true,
            ]
        );

        $kegiatanB = Kegiatan::updateOrCreate(
            ['judul' => 'Pelatihan Digital Marketing Pemuda'],
            [
                'deskripsi' => 'Pelatihan dasar promosi digital untuk UMKM dan inisiatif bisnis pemuda di lingkungan sekitar.',
                'tanggal' => now()->subDays(9)->toDateString(),
                'lokasi' => 'Balai Warga RW 03',
                'kategori' => 'Pelatihan',
                'foto' => $images['kegiatan_b'],
                'aktif' => true,
            ]
        );

        $kegiatanC = Kegiatan::updateOrCreate(
            ['judul' => 'Turnamen Futsal Antar RT'],
            [
                'deskripsi' => 'Ajang olahraga dan silaturahmi antar pemuda untuk membangun sportivitas dan kekompakan warga.',
                'tanggal' => now()->subDays(4)->toDateString(),
                'lokasi' => 'Lapangan Serbaguna RW 03',
                'kategori' => 'Olahraga',
                'foto' => $images['kegiatan_c'],
                'aktif' => true,
            ]
        );

        Galeri::updateOrCreate(
            ['judul' => 'Dokumentasi Kerja Bakti'],
            [
                'kegiatan_id' => $kegiatanA->id,
                'deskripsi' => 'Momen kebersamaan saat kerja bakti lingkungan.',
                'path_file' => $images['galeri_a'],
                'tipe' => 'image',
                'kategori' => 'Kegiatan',
                'aktif' => true,
            ]
        );

        Galeri::updateOrCreate(
            ['judul' => 'Sesi Pelatihan Pemuda'],
            [
                'kegiatan_id' => $kegiatanB->id,
                'deskripsi' => 'Dokumentasi pelatihan digital marketing untuk anggota Karang Taruna.',
                'path_file' => $images['galeri_b'],
                'tipe' => 'image',
                'kategori' => 'Pelatihan',
                'aktif' => true,
            ]
        );

        Galeri::updateOrCreate(
            ['judul' => 'Keseruan Turnamen Futsal'],
            [
                'kegiatan_id' => $kegiatanC->id,
                'deskripsi' => 'Potret pertandingan futsal antar RT di wilayah RW 03.',
                'path_file' => $images['galeri_c'],
                'tipe' => 'image',
                'kategori' => 'Olahraga',
                'aktif' => true,
            ]
        );

        Artikel::updateOrCreate(
            ['judul' => 'Karang Taruna RW 03 Gelar Kerja Bakti Bulanan'],
            [
                'konten' => 'Karang Taruna RW 03 kembali menggelar kerja bakti bulanan dengan fokus pada kebersihan lingkungan dan saluran air warga.',
                'thumbnail' => $images['artikel_a'],
                'kategori' => 'berita',
                'aktif' => true,
                'tanggal_publikasi' => now()->subDays(12),
            ]
        );

        Artikel::updateOrCreate(
            ['judul' => 'Pemuda RW 03 Ikuti Pelatihan Digital Marketing'],
            [
                'konten' => 'Puluhan pemuda mengikuti sesi pelatihan digital marketing untuk meningkatkan keterampilan promosi usaha lokal.',
                'thumbnail' => $images['artikel_b'],
                'kategori' => 'artikel',
                'aktif' => true,
                'tanggal_publikasi' => now()->subDays(7),
            ]
        );

        Artikel::updateOrCreate(
            ['judul' => 'Turnamen Futsal Antar RT Berlangsung Meriah'],
            [
                'konten' => 'Turnamen futsal antar RT berjalan lancar dan meriah, menjadi ajang silaturahmi positif bagi pemuda setempat.',
                'thumbnail' => $images['artikel_c'],
                'kategori' => 'berita',
                'aktif' => true,
                'tanggal_publikasi' => now()->subDays(2),
            ]
        );
    }

    private function prepareDummyAssets(): array
    {
        $assetMap = [
            'kegiatan_a' => ['source' => 'media/site/hero-1.jpg', 'target' => 'kegiatan/dummy-kerja-bakti.jpg'],
            'kegiatan_b' => ['source' => 'media/site/about.jpg', 'target' => 'kegiatan/dummy-pelatihan.jpg'],
            'kegiatan_c' => ['source' => 'media/site/hero-2.jpg', 'target' => 'kegiatan/dummy-futsal.jpg'],
            'galeri_a' => ['source' => 'media/site/hero-3.jpg', 'target' => 'galeri/dummy-kerja-bakti.jpg'],
            'galeri_b' => ['source' => 'media/site/about.jpg', 'target' => 'galeri/dummy-pelatihan.jpg'],
            'galeri_c' => ['source' => 'media/site/hero-2.jpg', 'target' => 'galeri/dummy-futsal.jpg'],
            'artikel_a' => ['source' => 'media/site/og-default.jpg', 'target' => 'artikel/dummy-berita-1.jpg'],
            'artikel_b' => ['source' => 'media/site/hero-1.jpg', 'target' => 'artikel/dummy-berita-2.jpg'],
            'artikel_c' => ['source' => 'media/site/about.jpg', 'target' => 'artikel/dummy-berita-3.jpg'],
        ];

        $fallbackSource = public_path('media/site/logo-katar.png');
        $result = [];

        foreach ($assetMap as $key => $asset) {
            $source = public_path($asset['source']);
            $destination = storage_path('app/public/' . $asset['target']);
            $directory = dirname($destination);

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            if (File::exists($source)) {
                File::copy($source, $destination);
            } elseif (File::exists($fallbackSource)) {
                File::copy($fallbackSource, $destination);
            }

            $result[$key] = $asset['target'];
        }

        return $result;
    }
}
