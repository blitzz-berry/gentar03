@extends('layouts.app')

@section('title', $kegiatan->judul)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Detail Kegiatan</h1>
            <div class="flex space-x-2">
                <a href="{{ route('admin.kegiatan.edit', $kegiatan) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('admin.kegiatan.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            @if($kegiatan->foto)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $kegiatan->foto) }}" alt="{{ $kegiatan->judul }}" class="w-full h-64 object-cover rounded-lg">
                </div>
            @endif
            
            <div class="mb-4">
                <h2 class="text-2xl font-bold text-gray-800">{{ $kegiatan->judul }}</h2>
                <div class="flex flex-wrap items-center mt-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 mr-2 mb-2">
                        {{ $kegiatan->kategori }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $kegiatan->aktif ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} mr-2 mb-2">
                        {{ $kegiatan->aktif ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="text-gray-600"><span class="font-semibold">Tanggal:</span> {{ $kegiatan->tanggal->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-600"><span class="font-semibold">Lokasi:</span> {{ $kegiatan->lokasi }}</p>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Deskripsi</h3>
                <p class="text-gray-700 whitespace-pre-line">
                    {{ $kegiatan->deskripsi }}
                </p>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <form action="{{ route('admin.kegiatan.destroy', $kegiatan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
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
