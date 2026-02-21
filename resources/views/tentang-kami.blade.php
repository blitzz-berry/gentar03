@extends('layouts.public')

@section('title', 'Tentang Kami - Generasi Taruna 03')
@section('description', 'Sejarah, visi, misi, dan struktur pengurus Generasi Taruna 03 - Karang Taruna RW 03 Kelurahan Duri Kosambi, Cengkareng, Jakarta Barat.')

@section('content')
<!-- Breadcrumb -->
<div class="bg-[#F7F7F2] py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center text-sm font-medium text-gray-500">
            <a href="{{ route('welcome') }}" class="hover:text-[#0B2A4A]">Beranda</a>
            <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-gray-700">Tentang Kami</span>
        </div>
    </div>
</div>

<livewire:about-page />
@endsection