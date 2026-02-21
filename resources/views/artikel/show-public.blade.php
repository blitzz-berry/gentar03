@extends('layouts.public')

@section('title', $artikel->judul . ' - Generasi Taruna 03')
@section('description', Str::limit(strip_tags($artikel->konten), 160))
@section('og-type', $artikel->has_video ? 'video.other' : 'article')
@section('og-image', $artikel->thumbnail ? asset('storage/' . $artikel->thumbnail) : ($artikel->video_thumbnail_url ?: asset('media/site/og-default.jpg')))

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center text-sm font-medium text-gray-500">
            <a href="{{ route('welcome') }}" class="hover:text-gray-700">Beranda</a>
            <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <a href="{{ route('artikel.index') }}" class="hover:text-gray-700">Berita</a>
            <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-gray-700">{{ Str::limit($artikel->judul, 30) }}</span>
        </div>
    </div>
</div>

<!-- Article Detail Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                <div class="mb-8">
                    @if($artikel->video_file)
                        <div class="w-full rounded-lg overflow-hidden bg-black">
                            <video controls class="w-full max-h-[620px] object-contain">
                                <source src="{{ asset('storage/' . $artikel->video_file) }}" type="video/mp4">
                                Browser Anda tidak mendukung pemutar video.
                            </video>
                        </div>
                    @elseif($artikel->video_embed_url)
                        <div class="w-full aspect-video rounded-lg overflow-hidden">
                            <iframe class="w-full h-full" src="{{ $artikel->video_embed_url }}" title="{{ $artikel->judul }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    @elseif($artikel->video_url)
                        <div class="w-full rounded-lg overflow-hidden bg-black">
                            <video controls class="w-full max-h-[620px] object-contain">
                                <source src="{{ $artikel->video_url }}" type="video/mp4">
                                Browser Anda tidak mendukung pemutar video.
                            </video>
                        </div>
                    @elseif($artikel->thumbnail)
                        <div class="w-full rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
                            <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="{{ $artikel->judul }}" class="w-full max-h-[620px] object-contain mx-auto">
                        </div>
                    @else
                        <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-96 flex items-center justify-center">
                            <span class="text-gray-500">Thumbnail Artikel</span>
                        </div>
                    @endif
                </div>
                
                <div class="mb-8">
                    <span class="inline-block px-3 py-1 text-sm font-semibold text-primary bg-red-100 rounded">{{ $artikel->kategori }}</span>
                    <h1 class="text-3xl font-bold text-gray-900 mt-4 mb-6">{{ $artikel->judul }}</h1>
                    <div class="flex items-center text-gray-600 mb-8">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>{{ $artikel->tanggal_publikasi->format('d M Y') }}</span>
                    </div>
                    
                    <div class="prose max-w-none">
                        <div class="text-gray-700">
                            {!! $artikel->safe_konten !!}
                        </div>
                    </div>
                </div>
                
                <!-- Share Section -->
                <div class="border-t border-gray-200 pt-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Bagikan Artikel Ini</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-full flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                            Facebook
                        </a>
                        <a href="#" class="bg-blue-400 hover:bg-blue-500 text-white py-2 px-4 rounded-full flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                            Twitter
                        </a>
                        <a href="#" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-full flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.672.15-.199.297-.771.965-.941 1.162-.17.197-.337.221-.628.075-.297-.15-.986-.351-1.726-.986-.686-.587-1.16-.996-1.653-1.612-.488-.609-.054-.928.336-1.336.39-.408.534-.668.727-.827.193-.159.258-.242.364-.42.106-.179.042-.328-.027-.457-.069-.13-.608-1.453-.825-1.996-.213-.543-.43-.417-.593-.434-.162-.017-.35-.017-.535.116-.185.134-.698.669-.698 1.632 0 .964.698 1.926.797 2.062.099.136.177.061.472-.121.297-.185.77-.472 1.104-.628.332-.156.664-.075.916.12.252.196.918.708 1.103 1.104.185.396.185.727.121 1.104-.064.377-.533 1.104-.964 1.453-.43.349-.77.472-1.042.521-.273.05-.545.025-.746-.075-.201-.1-.669-.417-.916-.825-.248-.408-.42-.395-.668-.42-.248-.025-.546-.025-.797.1-.25.127-.77.377-1.243.477-.474.102-.917.051-1.243-.302-.326-.351-.39-.825-.297-1.242.093-.417.298-.797.57-.946.271-.15.497-.1.727-.05.23.05.669.347.942.797.273.45.372.547.672.722.297.175.546.15.797.025.25-.125.77-.521 1.453-.696.686-.175 1.242.075 1.453.1.211.025.669.1 1.042-.348.372-.45.497-.798.628-1.243.13-.45.05-.825-.025-1.104-.075-.273-.669-1.612-.94-2.01-.271-.396-.544-.371-.745-.371z" />
                            </svg>
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="lg:col-span-1">
                <div class="bg-gray-50 p-6 rounded-lg shadow-md sticky top-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Info Artikel</h3>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600">Tanggal Publikasi</span>
                            <span class="font-medium">{{ $artikel->tanggal_publikasi->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600">Kategori</span>
                            <span class="font-medium">
                                <span class="inline-block px-3 py-1 text-sm font-semibold text-primary bg-red-100 rounded">{{ $artikel->kategori }}</span>
                            </span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600">Status</span>
                            <span class="font-medium">
                                <span class="inline-block px-3 py-1 text-sm font-semibold {{ $artikel->aktif ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }} rounded">
                                    {{ $artikel->aktif ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <h4 class="text-lg font-bold text-gray-900 mb-4">Artikel Lainnya</h4>
                        <div class="space-y-4">
                            @forelse ($relatedArtikels as $related)
                                <div class="flex items-start space-x-4">
                                    <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16 flex items-center justify-center flex-shrink-0 overflow-hidden">
                                        @if($related->thumbnail)
                                            <img src="{{ asset('storage/' . $related->thumbnail) }}" alt="{{ $related->judul }}" class="h-full w-full object-cover">
                                        @else
                                            <span class="text-gray-500 text-xs">Gambar</span>
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{ route('artikel.show', $related) }}" class="font-medium text-gray-900 hover:underline">{{ $related->judul }}</a>
                                        <p class="text-xs text-gray-600">Tanggal: {{ $related->tanggal_publikasi->format('d M Y') }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-sm text-gray-500">Belum ada artikel lainnya.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Berita Lainnya</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($relatedArtikels as $related)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if($related->thumbnail)
                            <img src="{{ asset('storage/' . $related->thumbnail) }}" alt="{{ $related->judul }}" class="w-full h-48 object-cover">
                        @else
                            <div class="bg-gray-200 border-2 border-dashed w-full h-48 flex items-center justify-center">
                                <span class="text-gray-500">Thumbnail Artikel</span>
                            </div>
                        @endif
                        <div class="p-6">
                            <span class="inline-block px-3 py-1 text-sm font-semibold text-primary bg-red-100 rounded">{{ $related->kategori }}</span>
                            <h3 class="text-xl font-bold text-gray-900 mt-3 mb-2">{{ $related->judul }}</h3>
                            <p class="text-gray-600 mb-2">Tanggal: {{ $related->tanggal_publikasi->format('d M Y') }}</p>
                            <a href="{{ route('artikel.show', $related) }}" class="text-primary hover:underline font-medium">Baca selengkapnya &rarr;</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500">Belum ada artikel lainnya.</div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
