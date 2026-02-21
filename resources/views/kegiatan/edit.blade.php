@extends('layouts.app')

@section('title', 'Edit Kegiatan')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Kegiatan</h1>

        <form action="{{ route('admin.kegiatan.update', $kegiatan) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="judul">
                        Judul
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('judul') border-red-500 @enderror"
                           id="judul"
                           type="text"
                           name="judul"
                           value="{{ old('judul', $kegiatan->judul) }}"
                           required>
                    @error('judul')
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
                              rows="4"
                              required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal">
                            Tanggal
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tanggal') border-red-500 @enderror"
                               id="tanggal"
                               type="date"
                               name="tanggal"
                               value="{{ old('tanggal', $kegiatan->tanggal->format('Y-m-d')) }}"
                               required>
                        @error('tanggal')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="lokasi">
                            Lokasi
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('lokasi') border-red-500 @enderror"
                               id="lokasi"
                               type="text"
                               name="lokasi"
                               value="{{ old('lokasi', $kegiatan->lokasi) }}"
                               required>
                        @error('lokasi')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="kategori">
                            Kategori
                        </label>
                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('kategori') border-red-500 @enderror"
                                id="kategori"
                                name="kategori"
                                required>
                            <option value="">Pilih Kategori</option>
                            <option value="pelatihan" {{ old('kategori', $kegiatan->kategori) === 'pelatihan' ? 'selected' : '' }}>Pelatihan</option>
                            <option value="bakti sosial" {{ old('kategori', $kegiatan->kategori) === 'bakti sosial' ? 'selected' : '' }}>Bakti Sosial</option>
                            <option value="olahraga" {{ old('kategori', $kegiatan->kategori) === 'olahraga' ? 'selected' : '' }}>Olahraga</option>
                            <option value="kebudayaan" {{ old('kategori', $kegiatan->kategori) === 'kebudayaan' ? 'selected' : '' }}>Kebudayaan</option>
                            <option value="lainnya" {{ old('kategori', $kegiatan->kategori) === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <label class="flex items-center cursor-pointer">
                            <input type="hidden" name="aktif" value="0">
                            <input type="checkbox" name="aktif" value="1" class="form-checkbox" {{ old('aktif', $kegiatan->aktif) ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="foto">
                        Foto
                    </label>
                    @if($kegiatan->foto)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $kegiatan->foto) }}" alt="{{ $kegiatan->judul }}" class="h-32 w-32 object-cover rounded">
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

                <div class="flex items-center justify-between">
                    <a href="{{ route('admin.kegiatan.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
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
