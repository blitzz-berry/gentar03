@extends('layouts.public')

@section('title', $kegiatan->judul . ' - Generasi Taruna 03')
@section('description', Str::limit(strip_tags($kegiatan->deskripsi), 160))
@section('og-type', 'article')
@section('og-image', $kegiatan->foto ? asset('storage/' . $kegiatan->foto) : asset('media/site/og-default.jpg'))

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center text-sm font-medium text-gray-500">
            <a href="{{ route('welcome') }}" class="hover:text-gray-700">Beranda</a>
            <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <a href="{{ route('kegiatan.index') }}" class="hover:text-gray-700">Kegiatan</a>
            <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-gray-700">{{ Str::limit($kegiatan->judul, 30) }}</span>
        </div>
    </div>
</div>

<!-- Activity Detail Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                <div class="mb-8">
                    @if($kegiatan->foto)
                        <div class="w-full rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
                            <img src="{{ asset('storage/' . $kegiatan->foto) }}" alt="{{ $kegiatan->judul }}" class="w-full max-h-[620px] object-contain mx-auto">
                        </div>
                    @else
                        <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-96 flex items-center justify-center">
                            <span class="text-gray-500">Gambar Kegiatan</span>
                        </div>
                    @endif
                </div>
                
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-6">{{ $kegiatan->judul }}</h1>
                    <div class="flex flex-wrap gap-4 mb-6">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $kegiatan->tanggal->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>{{ $kegiatan->lokasi }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="inline-block px-3 py-1 text-sm font-semibold text-primary bg-red-100 rounded">{{ $kegiatan->kategori }}</span>
                        </div>
                    </div>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 whitespace-pre-line">
                            {{ $kegiatan->deskripsi }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="lg:col-span-1">
                <div class="bg-gray-50 p-6 rounded-lg shadow-md sticky top-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Info Kegiatan</h3>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600">Tanggal</span>
                            <span class="font-medium">{{ $kegiatan->tanggal->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600">Lokasi</span>
                            <span class="font-medium">{{ $kegiatan->lokasi }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600">Kategori</span>
                            <span class="font-medium">
                                <span class="inline-block px-3 py-1 text-sm font-semibold text-primary bg-red-100 rounded">{{ $kegiatan->kategori }}</span>
                            </span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600">Status</span>
                            <span class="font-medium">
                                <span class="inline-block px-3 py-1 text-sm font-semibold {{ $kegiatan->aktif ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }} rounded">
                                    {{ $kegiatan->aktif ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <h4 class="text-lg font-bold text-gray-900 mb-4">Media Terkait</h4>
                        @if($relatedGaleris->isNotEmpty())
                            <div class="grid grid-cols-2 gap-3">
                                @foreach($relatedGaleris as $galeri)
                                    <a href="{{ route('galeri.show', $galeri) }}" class="relative aspect-square rounded-xl overflow-hidden bg-gray-200 border border-gray-200">
                                        @if($galeri->tipe === 'image')
                                            <img src="{{ asset('storage/' . $galeri->path_file) }}" alt="{{ $galeri->judul }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center text-sm font-semibold text-gray-600">Video</div>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-40 flex items-center justify-center">
                                <span class="text-gray-500">Belum ada media terkait.</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Kegiatan Lainnya</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($relatedKegiatans as $related)
                    <div class="bg-gray-50 rounded-lg shadow-md overflow-hidden">
                        @if($related->foto)
                            <img src="{{ asset('storage/' . $related->foto) }}" alt="{{ $related->judul }}" class="w-full h-48 object-cover">
                        @else
                            <div class="bg-gray-200 border-2 border-dashed w-full h-48 flex items-center justify-center">
                                <span class="text-gray-500">Gambar Kegiatan</span>
                            </div>
                        @endif
                        <div class="p-6">
                            <span class="inline-block px-3 py-1 text-sm font-semibold text-primary bg-red-100 rounded">{{ $related->kategori }}</span>
                            <h3 class="text-xl font-bold text-gray-900 mt-3 mb-2">{{ $related->judul }}</h3>
                            <p class="text-gray-700 mb-4">Tanggal: {{ $related->tanggal->format('d M Y') }}</p>
                            <a href="{{ route('kegiatan.show', $related) }}" class="text-primary hover:underline font-medium">Selengkapnya &rarr;</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500">Belum ada kegiatan lainnya.</div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
