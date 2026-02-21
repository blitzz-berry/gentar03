<?php

namespace Tests\Feature;

use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoutingAndRedirectsTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_galeri_and_artikel_pages_are_accessible_without_authentication(): void
    {
        Galeri::create([
            'judul' => 'GALERI_PUBLIC_VISIBLE',
            'deskripsi' => 'Public galeri test',
            'path_file' => 'galeri/test.jpg',
            'tipe' => 'image',
            'kategori' => 'kegiatan',
            'aktif' => true,
        ]);

        Artikel::create([
            'judul' => 'ARTIKEL_PUBLIC_VISIBLE',
            'konten' => 'Public artikel test',
            'kategori' => 'berita',
            'aktif' => true,
            'tanggal_publikasi' => now(),
        ]);

        $this->get(route('galeri.index', [], false))
            ->assertOk()
            ->assertSee('GALERI_PUBLIC_VISIBLE');

        $this->get(route('artikel.index', [], false))
            ->assertOk()
            ->assertSee('ARTIKEL_PUBLIC_VISIBLE');
    }

    public function test_admin_galeri_and_artikel_index_routes_require_authentication(): void
    {
        $this->get(route('admin.galeri.index', [], false))
            ->assertRedirect('/login');

        $this->get(route('admin.artikel.index', [], false))
            ->assertRedirect('/login');
    }

    public function test_admin_destroy_routes_redirect_back_to_admin_index(): void
    {
        $user = User::factory()->create();

        $galeri = Galeri::create([
            'judul' => 'GALERI_TO_DELETE',
            'deskripsi' => 'Delete me',
            'path_file' => 'galeri/delete.jpg',
            'tipe' => 'image',
            'kategori' => 'kegiatan',
            'aktif' => true,
        ]);

        $artikel = Artikel::create([
            'judul' => 'ARTIKEL_TO_DELETE',
            'konten' => 'Delete me',
            'kategori' => 'berita',
            'aktif' => true,
            'tanggal_publikasi' => now(),
        ]);

        $this->actingAs($user)
            ->delete(route('admin.galeri.destroy', $galeri, false))
            ->assertRedirect(route('admin.galeri.index', [], false));

        $this->assertDatabaseMissing('galeris', ['id' => $galeri->id]);

        $this->actingAs($user)
            ->delete(route('admin.artikel.destroy', $artikel, false))
            ->assertRedirect(route('admin.artikel.index', [], false));

        $this->assertDatabaseMissing('artikels', ['id' => $artikel->id]);
    }
}
