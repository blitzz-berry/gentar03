@extends('layouts.public')

@section('title', 'Generasi Taruna 03 - Karang Taruna RW 03')
@section('description', 'Generasi Taruna 03 adalah organisasi kepemudaan di RW 03 Kelurahan Duri Kosambi, Cengkareng, Jakarta Barat. Kami aktif dalam berbagai kegiatan sosial, kreatif, dan edukatif untuk memberdayakan pemuda di lingkungan kami.')

@section('content')
<!-- Hero Section -->
<livewire:hero-carousel />

<!-- About Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <x-section-title level="h2" size="text-3xl" color="text-[#0B2A4A]" class="mb-4">
                Tentang Kami
            </x-section-title>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Karang Taruna RW 03 Kelurahan Duri Kosambi, Cengkareng, Jakarta Barat</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-gray-700 mb-4 leading-relaxed">Generasi Taruna 03 adalah organisasi kepemudaan yang aktif di wilayah RW 03 Kelurahan Duri Kosambi. Kami berkomitmen untuk memberdayakan pemuda-pemudi di lingkungan kami melalui berbagai program dan kegiatan sosial, kreatif, dan edukatif.</p>
                <p class="text-gray-700 mb-4 leading-relaxed">Dengan semboyan "Muda, Kreatif, Peduli, dan Berdaya", kami terus berusaha menjadi wadah yang produktif dan positif bagi generasi muda di lingkungan RW 03.</p>
                <ul class="list-disc pl-5 text-gray-700 space-y-2">
                    <li>Mengembangkan potensi pemuda melalui pelatihan dan workshop</li>
                    <li>Menyelenggarakan kegiatan sosial dan bakti masyarakat</li>
                    <li>Mendorong kewirausahaan di kalangan pemuda</li>
                    <li>Mewadahi berbagai kegiatan olahraga dan seni</li>
                </ul>
            </div>
            <div class="rounded-2xl w-full h-96 overflow-hidden" style="border-radius: 16px;">
                <img
                    src="{{ asset('media/site/puncak1.jpg') }}"
                    alt="Gambar Kegiatan Kami"
                    class="w-full h-full object-cover"
                >
            </div>
        </div>
    </div>
</section>

<!-- Activities Section -->
<section class="py-16 bg-[#F7F7F2]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <x-section-title level="h2" size="text-3xl" color="text-[#0B2A4A]" class="mb-4">
                Program & Kegiatan
            </x-section-title>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Berbagai program dan kegiatan yang kami laksanakan untuk memberdayakan pemuda</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse ($kegiatans as $kegiatan)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform hover:scale-105" style="border-radius: 16px;">
                    @if($kegiatan->foto)
                        <img src="{{ asset('storage/' . $kegiatan->foto) }}" alt="{{ $kegiatan->judul }}" class="w-full h-48 object-cover">
                    @else
                        <div class="bg-gray-200 border-2 border-dashed w-full h-48 flex items-center justify-center">
                            <span class="text-gray-500">Gambar Kegiatan</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <span class="inline-block px-3 py-1 text-sm font-semibold text-[#0B2A4A] bg-[#F5C400] rounded-full">{{ $kegiatan->kategori }}</span>
                        <h3 class="text-xl font-bold text-[#0B2A4A] mt-3 mb-2">{{ $kegiatan->judul }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($kegiatan->deskripsi), 110) }}</p>
                        <a href="{{ route('kegiatan.show', $kegiatan) }}" class="text-[#0B2A4A] hover:text-[#F5C400] font-medium inline-flex items-center">
                            Lihat detail
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">Belum ada kegiatan yang ditampilkan.</div>
            @endforelse
        </div>

        <div class="text-center mt-12">
            <x-button variant="navy" size="lg" :href="route('kegiatan.index')">
                Lihat Semua Kegiatan
            </x-button>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<livewire:gallery-grid />

<!-- News Section -->
<section class="py-16 bg-[#F7F7F2]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <x-section-title level="h2" size="text-3xl" color="text-[#0B2A4A]" class="mb-4">
                Berita & Artikel
            </x-section-title>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Perkembangan dan informasi terbaru dari Generasi Taruna 03</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($artikels as $artikel)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform hover:scale-105" style="border-radius: 16px;">
                    @if($artikel->thumbnail)
                        <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="{{ $artikel->judul }}" class="w-full h-48 object-cover">
                    @elseif($artikel->video_thumbnail_url)
                        <img src="{{ $artikel->video_thumbnail_url }}" alt="{{ $artikel->judul }}" class="w-full h-48 object-cover">
                    @else
                        <div class="bg-gray-200 border-2 border-dashed w-full h-48 flex items-center justify-center">
                            <span class="text-gray-500">Thumbnail</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <span class="inline-block px-3 py-1 text-sm font-semibold text-[#0B2A4A] bg-[#F5C400] rounded-full">{{ $artikel->kategori }}</span>
                        <h3 class="text-xl font-bold text-[#0B2A4A] mt-3 mb-2">{{ $artikel->judul }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($artikel->konten), 110) }}</p>
                        <a href="{{ route('artikel.show', $artikel) }}" class="text-[#0B2A4A] hover:text-[#F5C400] font-medium inline-flex items-center">
                            Baca selengkapnya
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">Belum ada artikel yang ditampilkan.</div>
            @endforelse
        </div>

        <div class="text-center mt-12">
            <x-button variant="navy" size="lg" :href="route('artikel.index')">
                Lihat Semua Berita
            </x-button>
        </div>
    </div>
</section>

<livewire:partner-carousel />

<!-- Join Form Section -->
<livewire:join-form />

<!-- CTA Section -->
<x-cta-section
    title="Mari Bersama Mewujudkan Perubahan Positif"
    description="Bergabunglah bersama kami dalam menciptakan dampak positif di lingkungan RW 03"
    buttonText="Hubungi Kami"
    :button-link="route('kontak.create')"
/>

@endsection
