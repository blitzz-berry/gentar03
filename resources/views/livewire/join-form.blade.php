<section class="py-16 bg-gradient-to-br from-[#F7F7F2] to-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left side - Visual Banner -->
            <div class="hidden lg:block">
                <div class="relative rounded-2xl overflow-hidden shadow-xl" style="border-radius: 16px;">
                    <div class="bg-gradient-to-r from-[#0B2A4A] to-[#1a3a5a] w-full h-96 flex items-center justify-center">
                        <div class="text-center p-8">
                            <div class="bg-[#F5C400] text-[#0B2A4A] w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-4">Bergabung Bersama Kami</h3>
                            <p class="text-gray-200">Jadilah bagian dari komunitas Generasi Taruna 03 dan berkontribusi dalam kegiatan positif di lingkungan RW 03</p>
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                </div>
            </div>

            <!-- Right side - Form -->
            <div class="bg-white p-8 rounded-2xl shadow-lg" style="border-radius: 16px;">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-[#0B2A4A] mb-2">Bergabung Bersama Kami</h2>
                    <p class="text-gray-600">Isi formulir di bawah ini untuk menghubungi kami atau bergabung sebagai anggota</p>
                </div>

                @if($successMessage)
                    <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ $successMessage }}
                    </div>
                @endif

                @if($errorMessage)
                    <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                        {{ $errorMessage }}
                    </div>
                @endif

                <form wire:submit.prevent="submit" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input
                            type="text"
                            id="name"
                            wire:model="name"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#F5C400] focus:border-transparent"
                            placeholder="Masukkan nama lengkap Anda"
                        >
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input
                            type="email"
                            id="email"
                            wire:model="email"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#F5C400] focus:border-transparent"
                            placeholder="Masukkan email Anda"
                        >
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon (Opsional)</label>
                        <input
                            type="tel"
                            id="phone"
                            wire:model="phone"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#F5C400] focus:border-transparent"
                            placeholder="Masukkan nomor telepon Anda"
                        >
                        @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                        <textarea
                            id="message"
                            wire:model="message"
                            rows="5"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#F5C400] focus:border-transparent"
                            placeholder="Tulis pesan Anda di sini..."
                        ></textarea>
                        @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-4">
                        <x-button
                            variant="gold"
                            type="submit"
                            class="w-full py-3 text-base font-semibold"
                            :disabled="$isLoading"
                        >
                            @if($isLoading)
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Mengirim...
                            @else
                                Kirim Pesan
                            @endif
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
