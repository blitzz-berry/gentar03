@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard Admin') }}
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-bold text-gray-800 mb-8">Selamat Datang di Dashboard Admin</h1>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                    <!-- Total Kegiatan Card -->
                    <div class="bg-blue-50 p-6 rounded-lg shadow-md">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-3 rounded-full">
                                <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-2xl font-bold text-gray-800">{{ $totalKegiatan }}</h3>
                                <p class="text-gray-600">Total Kegiatan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kegiatan Bulan Ini Card -->
                    <div class="bg-green-50 p-6 rounded-lg shadow-md">
                        <div class="flex items-center">
                            <div class="bg-green-100 p-3 rounded-full">
                                <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-2xl font-bold text-gray-800">{{ $totalKegiatanBulanIni }}</h3>
                                <p class="text-gray-600">Kegiatan Bulan Ini</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Pesan Masuk Card -->
                    <div class="bg-yellow-50 p-6 rounded-lg shadow-md">
                        <div class="flex items-center">
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-2xl font-bold text-gray-800">{{ $totalPesanMasuk }}</h3>
                                <p class="text-gray-600">Pesan Masuk</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pesan Belum Dibaca Card -->
                    <div class="bg-red-50 p-6 rounded-lg shadow-md">
                        <div class="flex items-center">
                            <div class="bg-red-100 p-3 rounded-full">
                                <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-2xl font-bold text-gray-800">{{ $pesanBelumDibaca }}</h3>
                                <p class="text-gray-600">Pesan Belum Dibaca</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Recent Kegiatan -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Kegiatan Terbaru</h2>
                        <div class="space-y-4">
                            @forelse($kegiatanTerbaru as $kegiatan)
                                <div class="flex items-start border-b pb-3 last:border-0 last:pb-0">
                                    <div class="bg-gray-200 border-2 border-dashed rounded-xl w-12 h-12 flex items-center justify-center flex-shrink-0">
                                        @if($kegiatan->foto)
                                            <img src="{{ asset('storage/' . $kegiatan->foto) }}" alt="{{ $kegiatan->judul }}" class="w-10 h-10 rounded object-cover">
                                        @else
                                            <span class="text-gray-500 text-xs">Gambar</span>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-medium text-gray-900">{{ Str::limit($kegiatan->judul, 30) }}</h3>
                                        <p class="text-sm text-gray-600">Tanggal: {{ $kegiatan->tanggal->format('d M Y') }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-600">Tidak ada kegiatan terbaru</p>
                            @endforelse
                        </div>
                        <a href="{{ route('admin.kegiatan.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">Lihat Semua Kegiatan →</a>
                    </div>

                    <!-- Recent Pesan -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Pesan Terbaru</h2>
                        <div class="space-y-4">
                            @forelse($pesanTerbaru as $pesan)
                                <div class="border-b pb-3 last:border-0 last:pb-0">
                                    <div class="flex items-center justify-between">
                                        <h3 class="font-medium text-gray-900">{{ $pesan->nama }}</h3>
                                        <span class="text-xs text-gray-500">{{ $pesan->created_at->format('d M') }}</span>
                                    </div>
                                    <p class="text-sm text-gray-600 truncate">{{ $pesan->subjek }}</p>
                                    <div class="flex mt-1">
                                        <span class="inline-block px-2 py-1 text-xs font-semibold {{ $pesan->dibaca ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }} rounded">{{ $pesan->dibaca ? 'Dibaca' : 'Belum Dibaca' }}</span>
                                        <span class="inline-block px-2 py-1 text-xs font-semibold {{ $pesan->dibalas ? 'text-blue-800 bg-blue-100' : 'text-yellow-800 bg-yellow-100' }} rounded ml-2">{{ $pesan->dibalas ? 'Dibalas' : 'Belum Dibalas' }}</span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-600">Tidak ada pesan terbaru</p>
                            @endforelse
                        </div>
                        <a href="{{ route('pesan-kontak.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">Lihat Kotak Masuk →</a>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="mt-10">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Aksi Cepat</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{ route('admin.kegiatan.create') }}" class="bg-blue-100 hover:bg-blue-200 text-blue-800 font-semibold py-3 px-4 rounded-lg text-center transition">
                            Tambah Kegiatan
                        </a>
                        <a href="{{ route('admin.artikel.create') }}" class="bg-green-100 hover:bg-green-200 text-green-800 font-semibold py-3 px-4 rounded-lg text-center transition">
                            Tambah Artikel
                        </a>
                        <a href="{{ route('admin.galeri.create') }}" class="bg-yellow-100 hover:bg-yellow-200 text-yellow-800 font-semibold py-3 px-4 rounded-lg text-center transition">
                            Tambah Galeri
                        </a>
                        <a href="{{ route('pengurus.create') }}" class="bg-purple-100 hover:bg-purple-200 text-purple-800 font-semibold py-3 px-4 rounded-lg text-center transition">
                            Tambah Pengurus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
