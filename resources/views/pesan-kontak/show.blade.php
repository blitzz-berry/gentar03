@extends('layouts.app')

@section('title', 'Detail Pesan dari ' . $pesanKontak->nama)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Detail Pesan</h1>
            <a href="{{ route('pesan-kontak.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 border-b pb-6">
                <div>
                    <p class="text-gray-600"><span class="font-semibold">Nama:</span> {{ $pesanKontak->nama }}</p>
                    <p class="text-gray-600"><span class="font-semibold">Email:</span> {{ $pesanKontak->email }}</p>
                </div>
                <div>
                    <p class="text-gray-600"><span class="font-semibold">Tanggal:</span> {{ $pesanKontak->created_at->format('d M Y H:i') }}</p>
                    <p class="text-gray-600">
                        <span class="font-semibold">Status:</span>
                        <span class="{{ $pesanKontak->dibaca ? 'text-green-600' : 'text-yellow-600' }}">
                            {{ $pesanKontak->dibaca ? 'Dibaca' : 'Belum Dibaca' }}
                        </span>,
                        <span class="{{ $pesanKontak->dibalas ? 'text-blue-600' : 'text-gray-600' }}">
                            {{ $pesanKontak->dibalas ? 'Dibalas' : 'Belum Dibalas' }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $pesanKontak->subjek }}</h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-700 whitespace-pre-line">
                        {{ $pesanKontak->pesan }}
                    </p>
                </div>
            </div>

            <div class="flex space-x-2">
                @if(!$pesanKontak->dibalas)
                    <a href="#balas-form" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Balas Pesan
                    </a>
                @endif
                <form action="{{ route('pesan-kontak.destroy', $pesanKontak) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        @if(!$pesanKontak->dibalas)
        <div id="balas-form" class="mt-6 bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Balas Pesan</h2>
            <form action="{{ route('pesan-kontak.balas', $pesanKontak) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="pesan_balasan">
                        Pesan Balasan
                    </label>
                    <textarea 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('pesan_balasan') border-red-500 @enderror"
                        id="pesan_balasan"
                        name="pesan_balasan"
                        rows="5"
                        required
                        placeholder="Tulis pesan balasan Anda di sini...">{{ old('pesan_balasan') }}</textarea>
                    @error('pesan_balasan')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Kirim Balasan
                    </button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
