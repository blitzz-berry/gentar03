@extends('layouts.app')

@section('title', 'Edit Pengurus')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Pengurus</h1>

        <form action="{{ route('pengurus.update', $pengurus) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">
                        Nama
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama') border-red-500 @enderror"
                           id="nama"
                           type="text"
                           name="nama"
                           value="{{ old('nama', $pengurus->nama) }}"
                           required>
                    @error('nama')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jabatan">
                        Jabatan
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('jabatan') border-red-500 @enderror"
                           id="jabatan"
                           type="text"
                           name="jabatan"
                           value="{{ old('jabatan', $pengurus->jabatan) }}"
                           required>
                    @error('jabatan')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="foto">
                        Foto
                    </label>
                    @if($pengurus->foto)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $pengurus->foto) }}" alt="{{ $pengurus->nama }}" class="h-24 w-24 object-cover rounded">
                        </div>
                    @endif
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('foto') border-red-500 @enderror"
                           id="foto"
                           type="file"
                           name="foto"
                           accept="image/*">
                    <p class="text-gray-600 text-xs italic mt-2">Format: jpeg, png, jpg (Max: 2MB). Kosongkan jika tidak ingin mengganti foto.</p>
                    @error('foto')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="masa_jabatan">
                        Masa Jabatan
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('masa_jabatan') border-red-500 @enderror"
                           id="masa_jabatan"
                           type="text"
                           name="masa_jabatan"
                           value="{{ old('masa_jabatan', $pengurus->masa_jabatan) }}"
                           placeholder="Contoh: 2023-2025"
                           required>
                    @error('masa_jabatan')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="deskripsi">
                        Deskripsi
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('deskripsi') border-red-500 @enderror"
                              id="deskripsi"
                              name="deskripsi"
                              rows="4">{{ old('deskripsi', $pengurus->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('pengurus.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection