<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <x-section-title level="h2" size="text-3xl" color="text-[#0B2A4A]" align="text-center" class="mb-4">
                Galeri Kegiatan
            </x-section-title>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Potret aktivitas dan kegiatan Generasi Taruna 03</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($items as $item)
                <div class="group relative rounded-2xl overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105" style="border-radius: 16px;">
                    <div class="relative">
                        @if($item->tipe === 'image')
                            <img
                                src="{{ asset('storage/' . $item->path_file) }}"
                                alt="{{ $item->judul }}"
                                class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110"
                            >
                        @else
                            <div class="w-full h-64 bg-[#0B2A4A]/10 flex items-center justify-center text-[#0B2A4A] font-semibold">
                                Video
                            </div>
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <div class="absolute top-4 left-4 bg-[#F5C400] text-[#0B2A4A] text-xs font-bold px-3 py-1 rounded-full">
                            {{ $item->kategori ?: 'Umum' }}
                        </div>

                        <div class="absolute bottom-4 left-4 right-4 text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            <h3 class="text-lg font-bold mb-1">{{ $item->judul }}</h3>
                            <p class="text-sm text-gray-200">{{ $item->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    <div class="p-6 bg-white">
                        <h3 class="text-xl font-bold text-[#0B2A4A] mb-2">{{ $item->judul }}</h3>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">{{ $item->created_at->format('d M Y') }}</span>
                            <x-button variant="outline" size="sm" :href="route('galeri.show', $item)">
                                Detail
                            </x-button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">Belum ada galeri yang ditampilkan.</p>
                </div>
            @endforelse
        </div>

        @if($items->count() >= 6)
            <div class="text-center mt-12">
                <x-button variant="navy" wire:click="loadMore" class="px-8">
                    Muat Lebih Banyak
                </x-button>
            </div>
        @endif
    </div>
</section>
