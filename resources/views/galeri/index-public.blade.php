@extends('layouts.public')

@section('title', 'Galeri Kegiatan - Generasi Taruna 03')
@section('description', 'Kumpulan foto dan video kegiatan Generasi Taruna 03 - Karang Taruna RW 03 Kelurahan Duri Kosambi, Cengkareng, Jakarta Barat.')

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center text-sm font-medium text-gray-500">
            <a href="{{ route('welcome') }}" class="hover:text-gray-700">Beranda</a>
            <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-gray-700">Galeri</span>
        </div>
    </div>
</div>

<!-- Gallery Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-900 mb-6">Galeri Kegiatan</h1>
            <p class="text-xl text-gray-700 max-w-3xl mx-auto">Potret aktivitas dan kegiatan Generasi Taruna 03</p>
        </div>
        
        <!-- Filter Section -->
        <div class="mb-10 flex flex-wrap justify-center gap-4">
            <a href="{{ route('galeri.index') }}"
               class="px-4 py-2 rounded-full transition {{ empty($selectedKategori) ? 'bg-primary text-white hover:bg-red-700' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Semua
            </a>
            @foreach($kategoriList as $kategori)
                <a href="{{ route('galeri.index', ['kategori' => $kategori]) }}"
                   class="px-4 py-2 rounded-full transition {{ $selectedKategori === $kategori ? 'bg-primary text-white hover:bg-red-700' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    {{ ucwords($kategori) }}
                </a>
            @endforeach
        </div>
        
        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($galeris as $galeri)
                <a href="{{ route('galeri.show', $galeri) }}" class="group relative aspect-square rounded-xl overflow-hidden bg-gray-200 shadow-md">
                    @if($galeri->tipe === 'image')
                        <img src="{{ asset('storage/' . $galeri->path_file) }}" alt="{{ $galeri->judul }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="flex h-full w-full items-center justify-center bg-[#0B2A4A]/10 text-[#0B2A4A] font-semibold">Video</div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute bottom-3 left-3 right-3 text-white opacity-0 group-hover:opacity-100 transition-opacity">
                        <p class="text-sm font-semibold">{{ $galeri->judul }}</p>
                        <p class="text-xs text-white/80">{{ $galeri->kategori ?: 'Umum' }}</p>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center text-gray-500 py-12">Belum ada galeri yang ditampilkan.</div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $galeris->links() }}
        </div>
    </div>
</section>
@endsection
