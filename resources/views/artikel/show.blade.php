@extends('layouts.app')

@section('title', $artikel->judul)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Detail Artikel</h1>
            <div class="flex space-x-2">
                <a href="{{ route('admin.artikel.edit', $artikel) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('admin.artikel.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            @if($artikel->thumbnail)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="{{ $artikel->judul }}" class="w-full h-64 object-cover rounded-lg">
                </div>
            @endif
            
            <div class="mb-4">
                <h2 class="text-2xl font-bold text-gray-800">{{ $artikel->judul }}</h2>
                <div class="flex flex-wrap items-center mt-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 mr-2 mb-2">
                        {{ $artikel->kategori }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $artikel->aktif ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} mr-2 mb-2">
                        {{ $artikel->aktif ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                    <span class="text-gray-600 text-sm mb-2">
                        {{ $artikel->tanggal_publikasi->format('d M Y') }}
                    </span>
                </div>
            </div>

            <div class="prose max-w-none">
                {!! $artikel->konten !!}
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <form action="{{ route('admin.artikel.destroy', $artikel) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
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
