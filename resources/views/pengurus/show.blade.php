@extends('layouts.app')

@section('title', $pengurus->nama)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Detail Pengurus</h1>
            <div class="flex space-x-2">
                <a href="{{ route('pengurus.edit', $pengurus) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('pengurus.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex flex-col md:flex-row items-center md:items-start">
                <div class="mb-4 md:mb-0 md:mr-6">
                    @if($pengurus->foto)
                        <img src="{{ asset('storage/' . $pengurus->foto) }}" alt="{{ $pengurus->nama }}" class="h-48 w-48 object-cover rounded-lg">
                    @else
                        <div class="bg-gray-200 border-2 border-dashed rounded-xl w-48 h-48 flex items-center justify-center">
                            <span class="text-gray-500">No Photo</span>
                        </div>
                    @endif
                </div>
                
                <div class="text-center md:text-left">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $pengurus->nama }}</h2>
                    <p class="text-lg text-blue-600 mt-2">{{ $pengurus->jabatan }}</p>
                    <p class="text-gray-600 mt-2">Masa Jabatan: {{ $pengurus->masa_jabatan }}</p>
                </div>
            </div>

            <div class="mt-6">
                <h3 class="text-xl font-bold text-gray-800 mb-2">Deskripsi</h3>
                <p class="text-gray-700 whitespace-pre-line">
                    {{ $pengurus->deskripsi ?: 'Tidak ada deskripsi' }}
                </p>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <form action="{{ route('pengurus.destroy', $pengurus) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengurus ini?')">
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