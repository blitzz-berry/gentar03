# Spesifikasi UI Chatbot Generasi Taruna 03

## 1. Spesifikasi Visual

### Warna
- `--gentar-yellow`: `#F5C400` untuk FAB, CTA, dan tombol kirim.
- `--gentar-yellow-hover`: `#E3B300` untuk hover state CTA.
- `--gentar-overlay`: `rgba(11, 42, 74, 0.60)` untuk nuansa gelap hero.
- Bubble bot: `#F3F4F6`.
- Bubble user: `#0B2A4A` dengan teks putih.

### Radius
- FAB: `9999px`.
- Bottom sheet top radius: `24px`.
- Bubble chat: `18px`.
- Quick reply chip: `9999px`.
- Input: `9999px`.

### Typography
- Font utama: `Figtree`.
- Header chatbot: `14px semibold`.
- Subheader status: `12px`.
- Isi chat: `14px`.
- Quick reply chip: `12px medium`.

### Spacing
- Padding panel: `16px`.
- Gap antar bubble: `12px sampai 16px`.
- Padding bubble: `10px vertikal`, `16px horizontal`.
- Input bar: `12px`.

### Motion
- Semua transisi utama: `200ms`.
- Muncul panel: `translate-y + fade`.
- Tooltip dan FAB: `scale + fade`.
- Indicator mengetik: pulse dot ringan.

### Responsif
- Mobile utama: panel tinggi `80dvh`.
- Lebar minimum aman untuk layar `360px`.
- Desktop kecil: panel maksimal `420px`, tetap sebagai floating sheet.

## 2. Wireframe Deskriptif

### A. Closed State
- Navbar tetap di atas.
- FAB chat kuning di kanan bawah.
- Tooltip bubble di atas FAB dengan tombol tutup.

### B. Open State
- Bottom sheet putih dari bawah layar.
- Header berisi avatar `SP`, judul `Panitia 17-an RW 03`, tombol minimize, tombol close.
- Subheader status online di bawah baris judul.

### C. Content State
- Area pesan scrollable di tengah.
- Welcome card di awal berisi sapaan dan 3 CTA besar:
  - `Tentang Lomba`
  - `Daftar Sekarang`
  - `Lihat Jadwal`
- Bubble bot di kiri, bubble user di kanan.
- Quick reply chips tampil di bawah pesan bot terakhir:
  - `Daftar Lomba`
  - `Lihat Jadwal`
  - `Info Lokasi`
  - `Kontak Panitia`
  - `Aturan Lomba`

### D. Input State
- Bar input sticky di bawah.
- Ikon emoji di kiri.
- Input rounded di tengah.
- Tombol kirim bulat di kanan.
- Tombol kirim disabled saat input kosong.

### E. Minimized State
- Panel ditutup sementara.
- Muncul capsule mini `Panitia 17-an RW 03` di kanan bawah untuk restore.
- Tombol close kecil tetap tersedia.

## 3. Prompt Microcopy

### Tooltip
- `Butuh info lomba 17-an? Chat di sini, biar cepat.`

### Header
- `Panitia 17-an RW 03`
- `Online | Balas cepat, kecuali pas lomba lagi super rame.`

### Greeting
- `Halo! Aku Si Panitia Santuy. Mau tanya lomba apa, jadwal, atau daftar peserta?`

### Respon Bot Utama
- Daftar lomba:
  - `Kategori lomba tahun ini ada futsal, tarik tambang, e-sport, karaoke, dan lomba anak. Mau aku kirim syarat kategori yang mana dulu?`
- Jadwal:
  - `Jadwal utama: pembukaan jam 08.00, lomba anak jam 09.00, final futsal jam 19.30. Datang lebih awal biar dapat spot duduk enak.`
- Lokasi:
  - `Lokasi di lapangan RW 03 Duri Kosambi. Patokannya dekat pos RW dan panggung utama warna kuning. Kalau nyasar, kabarin, nanti dituntun.`
- Kontak:
  - `Kontak panitia aktif: 0812-3456-7890. Fast response, kecuali pas lomba makan kerupuk lagi panas-panasnya.`
- Aturan:
  - `Aturan utama: sportivitas wajib, daftar ulang 30 menit sebelum lomba, dan keputusan juri final. Protes boleh, tapi tetap santuy.`

## 4. Implementasi File
- `app/Livewire/ChatbotWidget.php`
- `resources/views/livewire/chatbot-widget.blade.php`
- `resources/views/layouts/public.blade.php`
- `resources/css/app.css`
- `tailwind.config.js`
