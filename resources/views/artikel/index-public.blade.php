@extends('layouts.public')

@section('title', 'Berita & Artikel - Generasi Taruna 03')
@section('description', 'Berita dan artikel terbaru dari Generasi Taruna 03 - Karang Taruna RW 03 Kelurahan Duri Kosambi, Cengkareng, Jakarta Barat.')

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center text-sm font-medium text-gray-500">
            <a href="{{ route('welcome') }}" class="hover:text-gray-700">Beranda</a>
            <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-gray-700">Berita</span>
        </div>
    </div>
</div>

<!-- News Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-900 mb-6">Berita & Artikel</h1>
            <p class="text-xl text-gray-700 max-w-3xl mx-auto">Perkembangan dan informasi terbaru dari Generasi Taruna 03</p>
        </div>
        
        <!-- Filter Section -->
        <div class="mb-10 flex flex-wrap justify-center gap-4">
            <a href="{{ route('artikel.index') }}"
               class="px-4 py-2 rounded-full transition {{ empty($selectedKategori) ? 'bg-primary text-white hover:bg-red-700' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Semua
            </a>
            @foreach($kategoriList as $kategori)
                <a href="{{ route('artikel.index', ['kategori' => $kategori]) }}"
                   class="px-4 py-2 rounded-full transition {{ $selectedKategori === $kategori ? 'bg-primary text-white hover:bg-red-700' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    {{ ucwords($kategori) }}
                </a>
            @endforeach
        </div>
        
        <!-- Featured News -->
        @if($featured)
            <div class="bg-gray-50 rounded-lg p-8 mb-16">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                    <div>
                        <span class="inline-block px-3 py-1 text-sm font-semibold text-primary bg-red-100 rounded">{{ $featured->kategori }}</span>
                        <h2 class="text-3xl font-bold text-gray-900 mt-4 mb-4">{{ $featured->judul }}</h2>
                        <p class="text-gray-700 mb-6">{{ Str::limit(strip_tags($featured->konten), 180) }}</p>
                        <div class="flex items-center">
                            <span class="text-gray-600">Tanggal: {{ $featured->tanggal_publikasi->format('d M Y') }}</span>
                        </div>
                        <a href="{{ route('artikel.show', $featured) }}" class="inline-block mt-4 text-primary hover:underline font-medium">Baca Selengkapnya &rarr;</a>
                    </div>
                    <div>
                        @if($featured->thumbnail)
                            <img src="{{ asset('storage/' . $featured->thumbnail) }}" alt="{{ $featured->judul }}" class="rounded-xl w-full h-80 object-cover">
                        @elseif($featured->video_thumbnail_url)
                            <img src="{{ $featured->video_thumbnail_url }}" alt="{{ $featured->judul }}" class="rounded-xl w-full h-80 object-cover">
                        @else
                            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-80 flex items-center justify-center">
                                <span class="text-gray-500">Thumbnail Artikel</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($artikels as $artikel)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($artikel->thumbnail)
                        <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="{{ $artikel->judul }}" class="w-full h-48 object-cover">
                    @elseif($artikel->video_thumbnail_url)
                        <img src="{{ $artikel->video_thumbnail_url }}" alt="{{ $artikel->judul }}" class="w-full h-48 object-cover">
                    @else
                        <div class="bg-gray-200 border-2 border-dashed w-full h-48 flex items-center justify-center">
                            <span class="text-gray-500">Thumbnail Artikel</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <span class="inline-block px-3 py-1 text-sm font-semibold text-primary bg-red-100 rounded">{{ $artikel->kategori }}</span>
                        <h3 class="text-xl font-bold text-gray-900 mt-3 mb-2">{{ $artikel->judul }}</h3>
                        <p class="text-gray-600 mb-2">Tanggal: {{ $artikel->tanggal_publikasi->format('d M Y') }}</p>
                        <p class="text-gray-700 mb-4">{{ Str::limit(strip_tags($artikel->konten), 120) }}</p>
                        <a href="{{ route('artikel.show', $artikel) }}" class="text-primary hover:underline font-medium">Baca selengkapnya &rarr;</a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 py-12">Belum ada artikel yang ditampilkan.</div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $artikels->links() }}
        </div>
    </div>
</section>
@endsection
