@props([
    'title' => 'Mari Bersama Mewujudkan Perubahan Positif',
    'description' => 'Bergabunglah bersama kami dalam menciptakan dampak positif di lingkungan RW 03',
    'buttonText' => 'Hubungi Kami',
    'buttonLink' => '#',
    'fullHeight' => false,
    'eyebrow' => 'Generasi Taruna 03'
])

@if ($fullHeight)
    <style>
        @media (prefers-reduced-motion: no-preference) {
            .cta-float {
                animation: cta-float 14s ease-in-out infinite;
            }
            .cta-float-rev {
                animation: cta-float-rev 16s ease-in-out infinite;
            }
        }
        @keyframes cta-float {
            0% { transform: translate3d(0, 0, 0); }
            50% { transform: translate3d(0, 12px, 0); }
            100% { transform: translate3d(0, 0, 0); }
        }
        @keyframes cta-float-rev {
            0% { transform: translate3d(0, 0, 0); }
            50% { transform: translate3d(0, -16px, 0); }
            100% { transform: translate3d(0, 0, 0); }
        }
    </style>

    <section class="relative min-h-screen overflow-hidden bg-[#0B2A4A] text-white">
        <div
            class="absolute inset-0"
            aria-hidden="true"
            style="background-image: radial-gradient(900px circle at 15% 20%, rgba(245, 196, 0, 0.2), transparent 45%), radial-gradient(700px circle at 85% 30%, rgba(255, 255, 255, 0.12), transparent 40%);"
        ></div>
        <div class="cta-float absolute -top-24 -left-24 h-72 w-72 rounded-full bg-[#F5C400]/20 blur-3xl" aria-hidden="true"></div>
        <div class="cta-float-rev absolute -bottom-28 right-0 h-96 w-96 rounded-full bg-white/10 blur-3xl" aria-hidden="true"></div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 min-h-screen flex items-center">
            <div class="grid grid-cols-1 lg:grid-cols-[1.1fr_0.9fr] gap-10 items-center w-full py-16">
                <div>
                    @if ($eyebrow)
                        <p class="text-xs uppercase tracking-[0.35em] text-[#F5C400] font-semibold mb-4">{{ $eyebrow }}</p>
                    @endif
                    <h2 class="text-4xl md:text-6xl font-bold leading-tight">{{ $title }}</h2>
                    <p class="mt-4 text-lg md:text-xl text-white/80">{{ $description }}</p>

                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        <div class="flex items-start gap-3 rounded-xl border border-white/10 bg-white/5 p-4">
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#F5C400]/20 text-[#F5C400] font-semibold">01</span>
                            <div>
                                <p class="font-semibold">Aksi sosial nyata</p>
                                <p class="text-white/70">Kegiatan rutin yang berdampak di RW 03.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 rounded-xl border border-white/10 bg-white/5 p-4">
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#F5C400]/20 text-[#F5C400] font-semibold">02</span>
                            <div>
                                <p class="font-semibold">Ruang kreatif pemuda</p>
                                <p class="text-white/70">Kolaborasi ide, seni, dan olahraga.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 rounded-xl border border-white/10 bg-white/5 p-4">
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#F5C400]/20 text-[#F5C400] font-semibold">03</span>
                            <div>
                                <p class="font-semibold">Relasi yang kuat</p>
                                <p class="text-white/70">Kenal lebih banyak pemuda setempat.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 rounded-xl border border-white/10 bg-white/5 p-4">
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#F5C400]/20 text-[#F5C400] font-semibold">04</span>
                            <div>
                                <p class="font-semibold">Pengembangan diri</p>
                                <p class="text-white/70">Latih kepemimpinan dan skill baru.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <x-button variant="gold" size="lg" :href="$buttonLink">
                            {{ $buttonText }}
                        </x-button>
                        <div class="text-sm text-white/70">
                            <span class="font-semibold text-white">Gratis.</span> Isi form, tim kami akan menghubungi kamu.
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-white/15 bg-white/10 p-6 md:p-8 backdrop-blur-sm shadow-xl">
                    <div class="flex items-center justify-between">
                        <p class="text-xs uppercase tracking-[0.3em] text-white/60">Langkah Bergabung</p>
                        <span class="text-xs text-white/60">03</span>
                    </div>
                    <div class="mt-6 space-y-5">
                        <div class="flex items-start gap-4">
                            <div class="h-10 w-10 rounded-full bg-[#F5C400]/20 text-[#F5C400] flex items-center justify-center font-semibold">1</div>
                            <div>
                                <p class="font-semibold">Isi form singkat</p>
                                <p class="text-sm text-white/70">Ceritakan minat dan keahlian kamu.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="h-10 w-10 rounded-full bg-[#F5C400]/20 text-[#F5C400] flex items-center justify-center font-semibold">2</div>
                            <div>
                                <p class="font-semibold">Kami hubungi</p>
                                <p class="text-sm text-white/70">Tim admin konfirmasi jadwal perkenalan.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="h-10 w-10 rounded-full bg-[#F5C400]/20 text-[#F5C400] flex items-center justify-center font-semibold">3</div>
                            <div>
                                <p class="font-semibold">Mulai berkontribusi</p>
                                <p class="text-sm text-white/70">Gabung program yang sesuai minatmu.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 rounded-xl border border-[#F5C400]/30 bg-[#F5C400]/10 p-4 text-sm text-white/80">
                        <p class="font-semibold text-[#F5C400]">Butuh info cepat?</p>
                        <p>Isi form dan tim admin akan membalas lewat email.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@else
    <section class="py-16 bg-gradient-to-r from-[#0B2A4A]/5 to-[#F5C400]/5">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-white/80 backdrop-blur-sm p-8 md:p-12 rounded-2xl shadow-lg border border-[#F5C400]/20" style="border-radius: 16px;">
                <h2 class="text-3xl md:text-4xl font-bold text-[#0B2A4A] mb-4">{{ $title }}</h2>
                <p class="text-lg text-gray-700 mb-8 max-w-2xl mx-auto">{{ $description }}</p>
                <x-button variant="gold" size="lg" :href="$buttonLink">
                    {{ $buttonText }}
                </x-button>
            </div>
        </div>
    </section>
@endif
