Kamu adalah senior frontend + Laravel developer. Tugas: refactor dan rebuild tampilan website “Karang Taruna RT 03 (Gentar 3)” menjadi modern, rapi, konsisten, dan responsif menggunakan Laravel + Livewire (boleh dibantu AlpineJS). Jangan ubah identitas warna utama: navy (primary) + kuning emas (accent). Fokus pada section yang saat ini terlihat di website: 
1) section “Bergabung Bersama Kami” (form join/contact) yang sekarang layoutnya masih kaku dan tombol merah, 
2) footer (alamat, quick links, kontak, map embed),
3) halaman “Tentang Kami” (hero heading + teks panjang + gambar besar),
4) gallery/daftar kegiatan (grid kartu gambar dengan overlay judul),
5) CTA “Mari Bersama Mewujudkan Perubahan Positif”.

TARGET HASIL:
- Tampilan modern “community/nonprofit website”: banyak whitespace, typography jelas, border radius halus, shadow soft, card style konsisten.
- Navbar sticky tetap sederhana: logo kiri, menu tengah (Home/Support/Tentang Kami), tombol CTA “Hubungi Kami” kuning di kanan.
- Semua section konsisten dalam container max-width (misal 1200px) dan padding vertikal yang seragam.
- Mobile-first: di mobile jadi 1 kolom, tablet 2 kolom, desktop 2-3 kolom sesuai section.
- Hindari warna merah mencolok untuk tombol “Send”; ganti jadi tombol primary kuning/navy dengan hover.

ATURAN TEKNIS:
- Gunakan layout utama: resources/views/layouts/app.blade.php
- Buat ulang section sebagai Livewire components:
  - Navbar: app/Livewire/Navbar.php + resources/views/livewire/navbar.blade.php
  - AboutPage: app/Livewire/AboutPage.php + view-nya
  - Gallery: app/Livewire/GalleryGrid.php + view-nya
  - JoinForm: app/Livewire/JoinForm.php + view-nya (validasi realtime, sukses message)
  - Footer: app/Livewire/Footer.php + view-nya
- Pakai Blade components untuk elemen reusable: button, card, section-title (buat di resources/views/components)
- Styling: gunakan Tailwind CSS kalau proyek sudah ada; jika belum ada Tailwind, gunakan CSS custom rapi di public/css/app.css dan impor lewat layout. Pilih salah satu, tapi hasil harus konsisten dan modern.
- Pastikan semua gambar menggunakan object-fit: cover dan punya ratio yang enak (misal aspect-video / aspect-[4/3]).
- Hindari teks rata tengah untuk paragraf panjang. Headline boleh center, paragraf lebih enak left.
- Pastikan form memiliki state: loading, success, error. Tombol disabled saat loading.
- Footer: 4 kolom di desktop (logo+alamat | quick links | kontak | map). Di mobile jadi stack 1 kolom. Map jangan terlalu besar (tinggi 220-260px). 
- Gallery: card overlay gradient bawah untuk judul, hover: scale kecil + shadow.
- About: buat hero section dengan heading besar “Tentang Kami”, subheading singkat, CTA kecil “Lihat Kegiatan”. Di bawahnya buat section “Misi Kami” dan “Kenapa Memilih Kami?” dalam layout 2 kolom dengan card bullet points.
- CTA section “Mari Bersama Mewujudkan Perubahan Positif”: buat panel/box center dengan background soft (light navy tint), heading tegas, deskripsi singkat, tombol “Hubungi Kami”.

LANGKAH IMPLEMENTASI:
1) Scan struktur project dan temukan halaman yang menampilkan section-section di atas (routes + views).
2) Refactor halaman agar memakai Livewire components di atas (tanpa merusak routing yang ada).
3) Terapkan design system:
   - Colors: --navy: #0B2A4A (atau yang mendekati), --gold: #F5C400, --bg: #F7F7F2
   - Radius: 16px
   - Shadow: soft
   - Spacing section: py-16 desktop, py-10 mobile
4) Perbaiki section Join/Contact:
   - Desktop: 2 kolom (kiri: visual/banner/foto kegiatan dengan overlay kecil; kanan: form card)
   - Form fields: nama, email, pesan (+ optional: nomor HP), label jelas, input tinggi nyaman.
   - Tombol primary kuning atau navy.
5) Footer:
   - Social icons rapi (Instagram, email, WhatsApp)
   - Quick links sesuai menu
   - Kontak: email & phone clickable
6) Gallery:
   - Grid 3 kolom desktop, 2 tablet, 1 mobile.
   - Satu card: image, title, subtitle (kategori/tanggal), tombol “Detail”.
7) Pastikan aksesibilitas: alt text, focus ring, button aria-label.
8) Rapikan CSS/utility class agar tidak duplikatif.

OUTPUT:
- Commit set perubahan pada file yang relevan.
- Tampilkan daftar file yang diubah + ringkasan perubahan.
- Pastikan tidak ada error Livewire (namespace, render, mount, validation).
- Hasil akhir harus tampak jauh lebih modern dibanding layout lama.

Mulai kerjakan sekarang. Jangan tanya balik, langsung implement.
