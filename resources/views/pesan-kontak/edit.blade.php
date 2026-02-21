@extends('layouts.app')

@section('title', 'Edit Pesan')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Pesan</h1>

        <form action="{{ route('pesan-kontak.update', $pesanKontak) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">
                        Nama
                    </label>
                    <input 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama') border-red-500 @enderror"
                        id="nama"
                        type="text"
                        name="nama"
                        value="{{ old('nama', $pesanKontak->nama) }}"
                        required>
                    @error('nama')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $pesanKontak->email) }}"
                        required>
                    @error('email')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="subjek">
                        Subjek
                    </label>
                    <input 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('subjek') border-red-500 @enderror"
                        id="subjek"
                        type="text"
                        name="subjek"
                        value="{{ old('subjek', $pesanKontak->subjek) }}"
                        required>
                    @error('subjek')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="pesan">
                        Pesan
                    </label>
                    <textarea 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('pesan') border-red-500 @enderror"
                        id="pesan"
                        name="pesan"
                        rows="5"
                        required>{{ old('pesan', $pesanKontak->pesan) }}</textarea>
                    @error('pesan')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="flex items-center">
                        <label class="flex items-center cursor-pointer">
                            <input type="hidden" name="dibaca" value="0">
                            <input type="checkbox" name="dibaca" value="1" class="form-checkbox" {{ old('dibaca', $pesanKontak->dibaca) ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700">Dibaca</span>
                        </label>
                    </div>

                    <div class="flex items-center">
                        <label class="flex items-center cursor-pointer">
                            <input type="hidden" name="dibalas" value="0">
                            <input type="checkbox" name="dibalas" value="1" class="form-checkbox" {{ old('dibalas', $pesanKontak->dibalas) ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700">Dibalas</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('pesan-kontak.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
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