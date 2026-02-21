@extends('layouts.app')

@section('title', $galeri->judul)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Detail Galeri</h1>
            <div class="flex space-x-2">
                <a href="{{ route('admin.galeri.edit', $galeri) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('admin.galeri.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="mb-4">
                @if($galeri->tipe === 'image')
                    <img src="{{ asset('storage/' . $galeri->path_file) }}" alt="{{ $galeri->judul }}" class="w-full h-96 object-contain rounded-lg">
                @elseif($galeri->tipe === 'video')
                    <video controls class="w-full h-96 object-contain rounded-lg">
                        <source src="{{ asset('storage/' . $galeri->path_file) }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutar video.
                    </video>
                @endif
            </div>
            
            <div class="mb-4">
                <h2 class="text-2xl font-bold text-gray-800">{{ $galeri->judul }}</h2>
                <div class="flex flex-wrap items-center mt-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 mr-2 mb-2">
                        {{ $galeri->kategori ?: 'Umum' }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $galeri->aktif ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} mr-2 mb-2">
                        {{ $galeri->aktif ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 mb-2">
                        {{ $galeri->tipe === 'image' ? 'Gambar' : 'Video' }}
                    </span>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Deskripsi</h3>
                <p class="text-gray-700">
                    {{ $galeri->deskripsi ?: 'Tidak ada deskripsi' }}
                </p>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <form action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
