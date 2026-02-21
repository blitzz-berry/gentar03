@extends('layouts.public')

@section('title', 'Program & Kegiatan - Generasi Taruna 03')
@section('description', 'Berbagai program dan kegiatan yang diselenggarakan oleh Generasi Taruna 03 - Karang Taruna RW 03 Kelurahan Duri Kosambi, Cengkareng, Jakarta Barat.')

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center text-sm font-medium text-gray-500">
            <a href="{{ route('welcome') }}" class="hover:text-gray-700">Beranda</a>
            <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-gray-700">Kegiatan</span>
        </div>
    </div>
</div>

<!-- Activities Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-900 mb-6">Program & Kegiatan</h1>
            <p class="text-xl text-gray-700 max-w-3xl mx-auto">Berbagai program dan kegiatan yang kami laksanakan untuk memberdayakan pemuda</p>
        </div>
        
        <!-- Filter Section -->
        <div class="mb-10 flex flex-wrap justify-center gap-4">
            <a href="{{ route('kegiatan.index') }}"
               class="px-4 py-2 rounded-full transition {{ empty($selectedKategori) ? 'bg-primary text-white hover:bg-red-700' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Semua
            </a>
            @foreach($kategoriList as $kategori)
                <a href="{{ route('kegiatan.index', ['kategori' => $kategori]) }}"
                   class="px-4 py-2 rounded-full transition {{ $selectedKategori === $kategori ? 'bg-primary text-white hover:bg-red-700' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    {{ ucwords($kategori) }}
                </a>
            @endforeach
        </div>
        
        <!-- Activities Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse ($kegiatans as $kegiatan)
                <div class="bg-gray-50 rounded-lg shadow-md overflow-hidden transform transition duration-500 hover:scale-105">
                    @if($kegiatan->foto)
                        <img src="{{ asset('storage/' . $kegiatan->foto) }}" alt="{{ $kegiatan->judul }}" class="w-full h-48 object-cover">
                    @else
                        <div class="bg-gray-200 border-2 border-dashed w-full h-48 flex items-center justify-center">
                            <span class="text-gray-500">Gambar Kegiatan</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <span class="inline-block px-3 py-1 text-sm font-semibold text-primary bg-red-100 rounded">{{ $kegiatan->kategori }}</span>
                        <h3 class="text-xl font-bold text-gray-900 mt-3 mb-2">{{ $kegiatan->judul }}</h3>
                        <p class="text-gray-700 mb-4">Tanggal: {{ $kegiatan->tanggal->format('d M Y') }}</p>
                        <p class="text-gray-600 mb-4">Lokasi: {{ $kegiatan->lokasi }}</p>
                        <p class="text-gray-700 mb-4">{{ Str::limit(strip_tags($kegiatan->deskripsi), 120) }}</p>
                        <a href="{{ route('kegiatan.show', $kegiatan) }}" class="text-primary hover:underline font-medium inline-block">Lihat Selengkapnya &rarr;</a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    Belum ada kegiatan yang ditampilkan.
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $kegiatans->links() }}
        </div>
    </div>
</section>
@endsection
