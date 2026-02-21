<?php

namespace Tests\Feature;

use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Kegiatan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicCategoryFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_kegiatan_filter_shows_only_selected_active_category(): void
    {
        Kegiatan::create([
            'judul' => 'KEGIATAN_MATCH',
            'deskripsi' => 'Match',
            'tanggal' => now()->toDateString(),
            'lokasi' => 'Jakarta',
            'kategori' => 'pelatihan',
            'aktif' => true,
        ]);

        Kegiatan::create([
            'judul' => 'KEGIATAN_OTHER',
            'deskripsi' => 'Other',
            'tanggal' => now()->toDateString(),
            'lokasi' => 'Jakarta',
            'kategori' => 'olahraga',
            'aktif' => true,
        ]);

        Kegiatan::create([
            'judul' => 'KEGIATAN_INACTIVE',
            'deskripsi' => 'Inactive',
            'tanggal' => now()->toDateString(),
            'lokasi' => 'Jakarta',
            'kategori' => 'pelatihan',
            'aktif' => false,
        ]);

        $this->get(route('kegiatan.index', ['kategori' => 'pelatihan'], false))
            ->assertOk()
            ->assertSee('KEGIATAN_MATCH')
            ->assertDontSee('KEGIATAN_OTHER')
            ->assertDontSee('KEGIATAN_INACTIVE');
    }

    public function test_galeri_filter_shows_only_selected_active_category(): void
    {
        Galeri::create([
            'judul' => 'GALERI_MATCH',
            'deskripsi' => 'Match',
            'path_file' => 'galeri/a.jpg',
            'tipe' => 'image',
            'kategori' => 'pelatihan',
            'aktif' => true,
        ]);

        Galeri::create([
            'judul' => 'GALERI_OTHER',
            'deskripsi' => 'Other',
            'path_file' => 'galeri/b.jpg',
            'tipe' => 'image',
            'kategori' => 'acara',
            'aktif' => true,
        ]);

        Galeri::create([
            'judul' => 'GALERI_INACTIVE',
            'deskripsi' => 'Inactive',
            'path_file' => 'galeri/c.jpg',
            'tipe' => 'image',
            'kategori' => 'pelatihan',
            'aktif' => false,
        ]);

        $this->get(route('galeri.index', ['kategori' => 'pelatihan'], false))
            ->assertOk()
            ->assertSee('GALERI_MATCH')
            ->assertDontSee('GALERI_OTHER')
            ->assertDontSee('GALERI_INACTIVE');
    }

    public function test_artikel_filter_shows_only_selected_active_category(): void
    {
        Artikel::create([
            'judul' => 'ARTIKEL_MATCH',
            'konten' => 'Match',
            'kategori' => 'berita',
            'aktif' => true,
            'tanggal_publikasi' => now()->subDay(),
        ]);

        Artikel::create([
            'judul' => 'ARTIKEL_OTHER',
            'konten' => 'Other',
            'kategori' => 'opini',
            'aktif' => true,
            'tanggal_publikasi' => now(),
        ]);

        Artikel::create([
            'judul' => 'ARTIKEL_INACTIVE',
            'konten' => 'Inactive',
            'kategori' => 'berita',
            'aktif' => false,
            'tanggal_publikasi' => now(),
        ]);

        $this->get(route('artikel.index', ['kategori' => 'berita'], false))
            ->assertOk()
            ->assertSee('ARTIKEL_MATCH')
            ->assertDontSee('ARTIKEL_OTHER')
            ->assertDontSee('ARTIKEL_INACTIVE');
    }

    public function test_invalid_kegiatan_category_falls_back_to_all_active_data(): void
    {
        Kegiatan::create([
            'judul' => 'KEGIATAN_ACTIVE_A',
            'deskripsi' => 'A',
            'tanggal' => now()->toDateString(),
            'lokasi' => 'Jakarta',
            'kategori' => 'pelatihan',
            'aktif' => true,
        ]);

        Kegiatan::create([
            'judul' => 'KEGIATAN_ACTIVE_B',
            'deskripsi' => 'B',
            'tanggal' => now()->toDateString(),
            'lokasi' => 'Jakarta',
            'kategori' => 'olahraga',
            'aktif' => true,
        ]);

        $this->get(route('kegiatan.index', ['kategori' => 'kategori-tidak-valid'], false))
            ->assertOk()
            ->assertSee('KEGIATAN_ACTIVE_A')
            ->assertSee('KEGIATAN_ACTIVE_B');
    }
}
