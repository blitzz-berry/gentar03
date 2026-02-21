<?php

namespace Tests\Feature;

use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminMediaUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_store_galeri_with_video_file(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.galeri.store', [], false), [
            'judul' => 'GALERI_VIDEO_STORE',
            'deskripsi' => 'Video galeri',
            'kategori' => 'kegiatan',
            'aktif' => 1,
            'file' => UploadedFile::fake()->create('video-galeri.mp4', 2048, 'video/mp4'),
        ]);

        $response->assertRedirect(route('admin.galeri.index', [], false));

        $galeri = Galeri::where('judul', 'GALERI_VIDEO_STORE')->first();
        $this->assertNotNull($galeri);
        $this->assertSame('video', $galeri->tipe);
        $this->assertNotNull($galeri->path_file);
        Storage::disk('public')->assertExists($galeri->path_file);
    }

    public function test_admin_can_replace_galeri_video_and_old_file_is_deleted(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        Storage::disk('public')->put('galeri/old-galeri.mp4', 'old content');

        $galeri = Galeri::create([
            'judul' => 'GALERI_VIDEO_UPDATE',
            'deskripsi' => 'Old video',
            'path_file' => 'galeri/old-galeri.mp4',
            'tipe' => 'video',
            'kategori' => 'kegiatan',
            'aktif' => true,
        ]);

        $response = $this->actingAs($user)->put(route('admin.galeri.update', $galeri, false), [
            'judul' => 'GALERI_VIDEO_UPDATE',
            'deskripsi' => 'New video',
            'kategori' => 'kegiatan',
            'aktif' => 1,
            'file' => UploadedFile::fake()->create('new-galeri.mp4', 1024, 'video/mp4'),
        ]);

        $response->assertRedirect(route('admin.galeri.index', [], false));

        $galeri->refresh();
        $this->assertNotSame('galeri/old-galeri.mp4', $galeri->path_file);
        Storage::disk('public')->assertMissing('galeri/old-galeri.mp4');
        Storage::disk('public')->assertExists($galeri->path_file);
    }

    public function test_admin_can_store_artikel_with_video_file(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.artikel.store', [], false), [
            'judul' => 'ARTIKEL_VIDEO_STORE',
            'konten' => 'Konten artikel video',
            'kategori' => 'berita',
            'aktif' => 1,
            'tanggal_publikasi' => now()->toDateString(),
            'video_file' => UploadedFile::fake()->create('video-artikel.mp4', 3072, 'video/mp4'),
        ]);

        $response->assertRedirect(route('admin.artikel.index', [], false));

        $artikel = Artikel::where('judul', 'ARTIKEL_VIDEO_STORE')->first();
        $this->assertNotNull($artikel);
        $this->assertNotNull($artikel->video_file);
        Storage::disk('public')->assertExists($artikel->video_file);
    }

    public function test_admin_can_replace_artikel_video_and_old_file_is_deleted(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        Storage::disk('public')->put('artikel/old-artikel.mp4', 'old content');

        $artikel = Artikel::create([
            'judul' => 'ARTIKEL_VIDEO_UPDATE',
            'konten' => 'Konten lama',
            'kategori' => 'berita',
            'aktif' => true,
            'tanggal_publikasi' => now(),
            'video_file' => 'artikel/old-artikel.mp4',
        ]);

        $response = $this->actingAs($user)->put(route('admin.artikel.update', $artikel, false), [
            'judul' => 'ARTIKEL_VIDEO_UPDATE',
            'konten' => 'Konten baru',
            'kategori' => 'berita',
            'aktif' => 1,
            'tanggal_publikasi' => now()->toDateString(),
            'video_file' => UploadedFile::fake()->create('new-artikel.mp4', 2048, 'video/mp4'),
        ]);

        $response->assertRedirect(route('admin.artikel.index', [], false));

        $artikel->refresh();
        $this->assertNotSame('artikel/old-artikel.mp4', $artikel->video_file);
        Storage::disk('public')->assertMissing('artikel/old-artikel.mp4');
        Storage::disk('public')->assertExists($artikel->video_file);
    }
}
