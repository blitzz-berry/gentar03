@extends('layouts.public')

@section('title', $galeri->judul . ' - Generasi Taruna 03')
@section('description', Str::limit(strip_tags($galeri->deskripsi), 160))
@section('og-type', $galeri->tipe === 'image' ? 'article' : 'video.other')
@section('og-image', asset('storage/' . $galeri->path_file))

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center text-sm font-medium text-gray-500">
            <a href="{{ route('welcome') }}" class="hover:text-gray-700">Beranda</a>
            <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <a href="{{ route('galeri.index') }}" class="hover:text-gray-700">Galeri</a>
            <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-gray-700">{{ Str::limit($galeri->judul, 30) }}</span>
        </div>
    </div>
</div>

<!-- Gallery Detail Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                <div class="mb-8">
                    @if($galeri->tipe === 'image')
                        <img src="{{ asset('storage/' . $galeri->path_file) }}" alt="{{ $galeri->judul }}" class="w-full h-96 object-contain rounded-lg max-h-[600px]">
                    @elseif($galeri->tipe === 'video')
                        <video controls class="w-full h-96 object-contain rounded-lg max-h-[600px]">
                            <source src="{{ asset('storage/' . $galeri->path_file) }}" type="video/mp4">
                            Browser Anda tidak mendukung pemutar video.
                        </video>
                    @endif
                </div>
                
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-6">{{ $galeri->judul }}</h1>
                    <div class="flex flex-wrap gap-4 mb-6">
                        <div class="flex items-center">
                            <span class="inline-block px-3 py-1 text-sm font-semibold text-primary bg-red-100 rounded">{{ $galeri->kategori ?: 'Umum' }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="inline-block px-3 py-1 text-sm font-semibold text-secondary bg-green-100 rounded">{{ ucfirst($galeri->tipe) }}</span>
                        </div>
                    </div>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 whitespace-pre-line">
                            {{ $galeri->deskripsi }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="lg:col-span-1">
                <div class="bg-gray-50 p-6 rounded-lg shadow-md sticky top-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Info Media</h3>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600">Jenis Media</span>
                            <span class="font-medium">{{ ucfirst($galeri->tipe) }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600">Kategori</span>
                            <span class="font-medium">{{ $galeri->kategori ?: 'Umum' }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600">Status</span>
                            <span class="font-medium">
                                <span class="inline-block px-3 py-1 text-sm font-semibold {{ $galeri->aktif ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }} rounded">
                                    {{ $galeri->aktif ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600">Tanggal Upload</span>
                            <span class="font-medium">{{ $galeri->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <h4 class="text-lg font-bold text-gray-900 mb-4">Galeri Lainnya</h4>
                        <div class="space-y-4">
                            @forelse ($relatedGaleris->take(3) as $related)
                                <div class="flex items-center space-x-4">
                                    <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16 flex items-center justify-center flex-shrink-0 overflow-hidden">
                                        @if($related->tipe === 'image')
                                            <img src="{{ asset('storage/' . $related->path_file) }}" alt="{{ $related->judul }}" class="h-full w-full object-cover">
                                        @else
                                            <span class="text-gray-500 text-xs">Video</span>
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{ route('galeri.show', $related) }}" class="font-medium text-gray-900 hover:underline">{{ $related->judul }}</a>
                                        <p class="text-sm text-gray-600">{{ $related->kategori ?: 'Umum' }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-sm text-gray-500">Belum ada galeri lainnya.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Galeri Lainnya</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($relatedGaleris as $related)
                    <a href="{{ route('galeri.show', $related) }}" class="aspect-square bg-gray-200 border-2 border-dashed rounded-xl flex items-center justify-center overflow-hidden">
                        @if($related->tipe === 'image')
                            <img src="{{ asset('storage/' . $related->path_file) }}" alt="{{ $related->judul }}" class="h-full w-full object-cover">
                        @else
                            <span class="text-gray-500">Video</span>
                        @endif
                    </a>
                @empty
                    <div class="col-span-full text-center text-gray-500">Belum ada galeri lainnya.</div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection