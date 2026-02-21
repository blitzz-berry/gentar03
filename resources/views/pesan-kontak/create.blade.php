@extends('layouts.public')

@section('title', 'Kontak Kami - Generasi Taruna 03')
@section('description', 'Hubungi Generasi Taruna 03 - Karang Taruna RW 03 Kelurahan Duri Kosambi, Cengkareng, Jakarta Barat. Kirim pesan, saran, atau pertanyaan Anda.')

@section('content')
<x-cta-section
    title="Ayo Gabung Karang Taruna 03"
    description="Jadilah bagian dari pemuda yang aktif, kreatif, dan peduli. Isi formulir singkat untuk mulai bergabung."
    buttonText="Isi Formulir Bergabung"
    :button-link="'#form-kontak'"
    eyebrow="Karang Taruna RW 03"
    :full-height="true"
/>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto" id="form-kontak">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Hubungi Kami</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('kontak.store') }}" method="POST">
            @csrf
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
                        value="{{ old('nama') }}"
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
                        value="{{ old('email') }}"
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
                        value="{{ old('subjek') }}"
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
                        required
                        placeholder="Tulis pesan Anda di sini...">{{ old('pesan') }}</textarea>
                    @error('pesan')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Kirim Pesan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
