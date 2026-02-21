<main>
    <!-- Hero Section -->
    <section class="py-20 bg-gradient-to-br from-[#F7F7F2] to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-[#0B2A4A] mb-6">Tentang Kami</h1>
                <p class="text-xl text-gray-700 max-w-3xl mx-auto">Karang Taruna RW 03 Kelurahan Duri Kosambi, Cengkareng, Jakarta Barat</p>

                <div class="mt-10">
                    <x-button variant="gold" size="lg" :href="route('kegiatan.index')">
                        Lihat Kegiatan
                    </x-button>
                </div>
            </div>
        </div>
    </section>

    <!-- About Content Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <x-section-title level="h2" size="text-3xl" color="text-[#0B2A4A]" class="mb-6">
                        Sejarah Singkat
                    </x-section-title>
                    <p class="text-gray-700 mb-6 leading-relaxed">Generasi Taruna 03 berdiri sebagai organisasi kepemudaan di wilayah RW 03 Kelurahan Duri Kosambi. Organisasi ini terbentuk atas inisiatif masyarakat setempat yang ingin memberikan wadah positif bagi para pemuda di lingkungan ini.</p>
                    <p class="text-gray-700 mb-6 leading-relaxed">Sejak awal berdirinya, Generasi Taruna 03 telah aktif dalam berbagai kegiatan sosial, keagamaan, dan kemasyarakatan yang bertujuan untuk membangun solidaritas dan semangat gotong royong di kalangan pemuda.</p>
                    <p class="text-gray-700 leading-relaxed">Kami percaya bahwa pemuda adalah aset penting dalam pembangunan masyarakat, dan dengan arahan yang tepat, mereka mampu menjadi agen perubahan yang positif bagi lingkungan sekitarnya.</p>
                </div>

                @php
                    $aboutImage = 'media/site/about.jpg';
                @endphp
                @if(file_exists(public_path($aboutImage)))
                    <img src="{{ asset($aboutImage) }}" alt="Sejarah Generasi Taruna 03" class="w-full h-96 object-cover rounded-2xl" style="border-radius: 16px;">
                @else
                    <div class="bg-gray-200 border-2 border-dashed rounded-2xl w-full h-96 flex items-center justify-center" style="border-radius: 16px;">
                        <span class="text-gray-500 text-lg">Gambar Sejarah Organisasi</span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Vision & Mission Section -->
    <section class="py-16 bg-[#F7F7F2]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title level="h2" size="text-3xl" color="text-[#0B2A4A]" align="text-center" class="mb-16">
                Visi dan Misi
            </x-section-title>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="bg-gradient-to-br from-[#0B2A4A] to-[#1a3a5a] p-8 rounded-2xl shadow-lg text-white" style="border-radius: 16px;">
                    <h3 class="text-2xl font-bold mb-4 flex items-center">
                        <svg class="h-6 w-6 mr-3 text-[#F5C400]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                        </svg>
                        Visi
                    </h3>
                    <p class="text-lg">Menjadi organisasi kepemudaan yang aktif dan produktif dalam membangun masyarakat RW 03 Kelurahan Duri Kosambi yang religius, sejahtera, dan mandiri.</p>
                </div>

                <div class="bg-gradient-to-br from-[#F5C400] to-yellow-500 p-8 rounded-2xl shadow-lg text-[#0B2A4A]" style="border-radius: 16px;">
                    <h3 class="text-2xl font-bold mb-4 flex items-center">
                        <svg class="h-6 w-6 mr-3 text-[#0B2A4A]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Misi
                    </h3>
                    <ul class="list-disc pl-6 space-y-3 text-lg">
                        <li>Mewadahi dan menyalurkan aspirasi pemuda RW 03</li>
                        <li>Menyelenggarakan kegiatan keagamaan, sosial, dan kemasyarakatan</li>
                        <li>Mendorong kewirausahaan di kalangan pemuda</li>
                        <li>Menjalin kerja sama dengan berbagai elemen masyarakat</li>
                        <li>Meningkatkan rasa solidaritas dan gotong royong</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title level="h2" size="text-3xl" color="text-[#0B2A4A]" align="text-center" class="mb-16">
                Kenapa Memilih Kami?
            </x-section-title>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <x-card class="text-center p-8 transition-transform hover:scale-105">
                    <div class="bg-[#F5C400] text-[#0B2A4A] w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#0B2A4A] mb-3">Komunitas Yang Solid</h3>
                    <p class="text-gray-600">Kami memiliki komunitas pemuda yang aktif dan solid dalam menjalankan berbagai kegiatan sosial dan kemasyarakatan.</p>
                </x-card>

                <x-card class="text-center p-8 transition-transform hover:scale-105">
                    <div class="bg-[#F5C400] text-[#0B2A4A] w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#0B2A4A] mb-3">Kegiatan Bermakna</h3>
                    <p class="text-gray-600">Kegiatan yang kami selenggarakan memiliki dampak positif bagi masyarakat dan lingkungan sekitar.</p>
                </x-card>

                <x-card class="text-center p-8 transition-transform hover:scale-105">
                    <div class="bg-[#F5C400] text-[#0B2A4A] w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#0B2A4A] mb-3">Pengembangan Potensi</h3>
                    <p class="text-gray-600">Kami membantu mengembangkan potensi dan keterampilan pemuda melalui berbagai pelatihan dan workshop.</p>
                </x-card>
            </div>
        </div>
    </section>
</main>
