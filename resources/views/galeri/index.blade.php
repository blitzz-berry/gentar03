@extends('layouts.app')

@section('title', 'Galeri Kegiatan')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Galeri Kegiatan</h1>
        <a href="{{ route('admin.galeri.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Tambah Galeri
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($galeris as $galeri)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                @if($galeri->tipe === 'image')
                    <img src="{{ asset('storage/' . $galeri->path_file) }}" alt="{{ $galeri->judul }}" class="w-full h-48 object-cover">
                @elseif($galeri->tipe === 'video')
                    <video controls class="w-full h-48 object-cover">
                        <source src="{{ asset('storage/' . $galeri->path_file) }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutar video.
                    </video>
                @endif
                
                <div class="p-4">
                    <h3 class="font-bold text-lg text-gray-800 truncate">{{ $galeri->judul }}</h3>
                    <p class="text-gray-600 text-sm mt-1 truncate">{{ $galeri->deskripsi ?: 'Tanpa deskripsi' }}</p>
                    <div class="flex justify-between items-center mt-3">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $galeri->kategori ?: 'Umum' }}
                        </span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $galeri->aktif ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $galeri->aktif ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>
                    <div class="flex space-x-2 mt-4">
                        <a href="{{ route('admin.galeri.show', $galeri) }}" class="text-blue-600 hover:text-blue-900 text-sm">Lihat</a>
                        <a href="{{ route('admin.galeri.edit', $galeri) }}" class="text-yellow-600 hover:text-yellow-900 text-sm">Edit</a>
                        <form action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-8">
                <p class="text-gray-600">Belum ada data galeri.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $galeris->links() }}
    </div>
</div>
@endsection
