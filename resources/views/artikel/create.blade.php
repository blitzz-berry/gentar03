@extends('layouts.app')

@section('title', 'Tambah Artikel Baru')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Tambah Artikel Baru</h1>

        <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="judul">
                        Judul
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('judul') border-red-500 @enderror"
                           id="judul"
                           type="text"
                           name="judul"
                           value="{{ old('judul') }}"
                           required>
                    @error('judul')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="konten">
                        Konten
                    </label>
                    <input id="konten" type="hidden" name="konten" value="{{ old('konten') }}">
                    <trix-editor input="konten" class="trix-content"></trix-editor>
                    @error('konten')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
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
                            <option value="berita" {{ old('kategori') === 'berita' ? 'selected' : '' }}>Berita</option>
                            <option value="opini" {{ old('kategori') === 'opini' ? 'selected' : '' }}>Opini</option>
                            <option value="artikel" {{ old('kategori') === 'artikel' ? 'selected' : '' }}>Artikel</option>
                            <option value="lainnya" {{ old('kategori') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal_publikasi">
                            Tanggal Publikasi
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tanggal_publikasi') border-red-500 @enderror"
                               id="tanggal_publikasi"
                               type="date"
                               name="tanggal_publikasi"
                               value="{{ old('tanggal_publikasi', date('Y-m-d')) }}">
                        @error('tanggal_publikasi')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="thumbnail">
                        Thumbnail
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('thumbnail') border-red-500 @enderror"
                           id="thumbnail"
                           type="file"
                           name="thumbnail"
                           accept="image/*">
                    <p class="text-gray-600 text-xs italic mt-2">Format: jpeg, png, jpg (Max: 2MB)</p>
                    @error('thumbnail')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="video_url">
                        Video URL (Opsional)
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('video_url') border-red-500 @enderror"
                           id="video_url"
                           type="url"
                           name="video_url"
                           value="{{ old('video_url') }}"
                           placeholder="https://youtube.com/watch?v=...">
                    <p class="text-gray-600 text-xs italic mt-2">Bisa link YouTube. Kosongkan jika pakai upload video.</p>
                    @error('video_url')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="video_file">
                        Upload Video (Opsional)
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('video_file') border-red-500 @enderror"
                           id="video_file"
                           type="file"
                           name="video_file"
                           accept="video/*">
                    <p class="text-gray-600 text-xs italic mt-2">Format: mp4, webm, mov (Max: 100MB). Video file diprioritaskan.</p>
                    @error('video_file')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center mb-4">
                    <label class="flex items-center cursor-pointer">
                        <input type="hidden" name="aktif" value="0">
                        <input type="checkbox" name="aktif" value="1" class="form-checkbox" {{ old('aktif') ? 'checked' : 'checked' }}>
                        <span class="ml-2 text-gray-700">Aktif</span>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('admin.artikel.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
@endsection
