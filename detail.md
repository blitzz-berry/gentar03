# Ringkasan Sistem

Dokumen ini menjelaskan cara kerja sistem saat ini, dibagi untuk pengunjung (user) dan admin, serta lokasi file/gambar yang mudah diganti tanpa edit kode.

## Alur Pengunjung (User/Public)
- Beranda (`/`): menampilkan banner slider otomatis, daftar kegiatan terbaru, galeri terbaru, dan artikel/berita terbaru dari database.
- Kegiatan (`/kegiatan`): daftar kegiatan aktif dari database, detail kegiatan di `/kegiatan/{id}`.
- Galeri (`/galeri`): daftar galeri aktif (gambar/video) dari database, detail galeri di `/galeri/{id}`.
- Berita/Artikel (`/artikel`): daftar artikel aktif dari database, detail artikel di `/artikel/{id}`. Artikel bisa menampilkan video jika tersedia.
- Kontak (`/kontak`): form kontak publik tanpa login, data masuk ke pesan kontak admin.
- Tentang Kami (`/tentang-kami`): konten statis + gambar sejarah dari file publik.

## Alur Admin
- Login dibutuhkan untuk mengelola konten admin:
  - Kegiatan: tambah/edit/hapus + upload foto.
  - Galeri: tambah/edit/hapus + upload gambar atau video.
  - Artikel: tambah/edit/hapus + upload thumbnail, video URL, atau upload file video.
  - Pesan Kontak: lihat dan balas pesan yang dikirim dari form publik.
  - Pengurus: tambah/edit/hapus + upload foto pengurus.

## Lokasi File Gambar/Video (Mudah Diganti)
Ganti file di folder berikut tanpa ubah kode:
- Banner beranda:
  - `public/images/banners/slide-1.jpg`
  - `public/images/banners/slide-2.jpg`
  - `public/images/banners/slide-3.jpg`
- Tentang Kami (gambar sejarah):
  - `public/images/about/sejarah.jpg`

Upload dari admin akan tersimpan di:
- Kegiatan: `storage/app/public/kegiatan`
- Galeri: `storage/app/public/galeri`
- Artikel (thumbnail dan video): `storage/app/public/artikel`
- Pengurus: `storage/app/public/pengurus`

Semua file di atas ditampilkan lewat URL `storage/...` (butuh symlink).

## Video untuk Artikel
Admin bisa menambahkan video dengan 2 cara:
- `video_url`: link YouTube (atau URL video lain).
- `video_file`: upload file video (mp4/webm/mov). Jika ada file, file diprioritaskan.

Di halaman detail artikel, video akan tampil otomatis. Di listing artikel, thumbnail video YouTube akan dipakai jika tidak ada thumbnail gambar.

## Setup yang Perlu Dijalankan
Jika belum dilakukan:
- `php artisan migrate` (menambah kolom video untuk artikel)
- `php artisan storage:link` (agar upload bisa diakses publik)

## Catatan Tampilan
- Beranda menampilkan konten terbaru:
  - 3 kegiatan aktif terbaru.
  - 3 artikel aktif terbaru.
  - Galeri aktif terbaru (Livewire).
- Halaman artikel menampilkan featured artikel (terbaru) dan list artikel lainnya.
