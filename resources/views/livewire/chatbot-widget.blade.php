<div
    x-data="{
        open: $wire.entangle('isOpen').live,
        minimized: $wire.entangle('isMinimized').live,
        tooltip: $wire.entangle('showTooltip').live
    }"
    class="pointer-events-none fixed inset-x-0 bottom-0 z-[1200]"
>
    <div class="pointer-events-none fixed bottom-4 right-4 z-[1210] flex flex-col items-end gap-3 sm:bottom-6 sm:right-6">
        <div
            x-cloak
            x-show="tooltip && !open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2"
            class="chatbot-tooltip pointer-events-auto max-w-[270px] rounded-2xl bg-white px-4 py-3 text-sm text-slate-700 shadow-lg"
        >
            <div class="flex items-start gap-3">
                <p class="leading-relaxed">Butuh info lomba 17-an? Chat di sini, biar cepat.</p>
                <button
                    type="button"
                    wire:click="dismissTooltip"
                    class="mt-0.5 text-slate-400 transition hover:text-slate-600"
                    aria-label="Tutup tooltip chatbot"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 6l12 12M18 6l-12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <button
            x-cloak
            x-show="!open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            type="button"
            wire:click="openPanel"
            class="chatbot-fab pointer-events-auto inline-flex h-14 w-14 items-center justify-center rounded-full text-[#0B2A4A] shadow-xl"
            aria-label="Buka chatbot panitia"
        >
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h8M8 14h5m-9 7l2.3-2.3A9 9 0 1112 21a8.9 8.9 0 01-4.7-1.3L4 21z" />
            </svg>
        </button>
    </div>

    <div
        x-cloak
        x-show="open && minimized"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="pointer-events-auto fixed bottom-24 right-4 z-[1210] rounded-full bg-white px-3 py-2 shadow-lg sm:right-6"
    >
        <div class="flex items-center gap-2">
            <button
                type="button"
                wire:click="restorePanel"
                class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700 transition hover:bg-slate-200"
                aria-label="Buka kembali chatbot"
            >
                Panitia 17-an RW 03
            </button>
            <button
                type="button"
                wire:click="closePanel"
                class="rounded-full p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
                aria-label="Tutup chatbot"
            >
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 6l12 12M18 6l-12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div
        x-cloak
        x-show="open && !minimized"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        class="pointer-events-auto fixed inset-x-0 bottom-0 z-[1205] px-2 pb-2 sm:inset-x-auto sm:right-6 sm:w-[420px] sm:px-0 sm:pb-6"
    >
        <section
            class="chatbot-sheet flex h-[80dvh] w-full flex-col overflow-hidden rounded-t-[24px] bg-white shadow-2xl sm:h-[76vh] sm:max-h-[700px] sm:rounded-[24px]"
            role="dialog"
            aria-label="Chatbot Panitia 17-an RW 03"
        >
            <header class="border-b border-slate-100 px-4 pb-3 pt-4">
                <div class="flex items-center justify-between gap-2">
                    <div class="flex items-center gap-3">
                        <div class="chatbot-avatar inline-flex h-10 w-10 items-center justify-center rounded-full text-sm font-semibold text-[#0B2A4A]">
                            SP
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Panitia 17-an RW 03</p>
                            <p class="text-xs text-slate-500">Si Panitia Santuy</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1">
                        <button
                            type="button"
                            wire:click="minimizePanel"
                            class="rounded-full p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
                            aria-label="Minimize chatbot"
                        >
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
                            </svg>
                        </button>
                        <button
                            type="button"
                            wire:click="closePanel"
                            class="rounded-full p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
                            aria-label="Tutup chatbot"
                        >
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 6l12 12M18 6l-12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <p class="mt-2 text-xs text-slate-500">Online | Balas cepat, kecuali pas lomba lagi super rame.</p>
            </header>

            <div data-chatbot-messages class="flex-1 space-y-4 overflow-y-auto px-4 py-4">
                @if ($showWelcomeCard)
                    <article class="rounded-2xl border border-yellow-100 bg-yellow-50 p-4 text-slate-700">
                        <p class="text-sm leading-relaxed">
                            Halo! Aku Si Panitia Santuy. Mau tanya lomba apa, jadwal, atau daftar peserta?
                        </p>
                        <div class="mt-4 grid grid-cols-1 gap-2">
                            <button
                                type="button"
                                wire:click="handleWelcomeCta('Tentang Lomba')"
                                class="chatbot-cta rounded-2xl px-4 py-2.5 text-sm font-semibold text-[#0B2A4A] transition"
                            >
                                Tentang Lomba
                            </button>
                            <button
                                type="button"
                                wire:click="handleWelcomeCta('Daftar Sekarang')"
                                class="chatbot-cta rounded-2xl px-4 py-2.5 text-sm font-semibold text-[#0B2A4A] transition"
                            >
                                Daftar Sekarang
                            </button>
                            <button
                                type="button"
                                wire:click="handleWelcomeCta('Lihat Jadwal')"
                                class="chatbot-cta rounded-2xl px-4 py-2.5 text-sm font-semibold text-[#0B2A4A] transition"
                            >
                                Lihat Jadwal
                            </button>
                        </div>
                    </article>
                @endif

                @foreach ($messages as $message)
                    <div class="flex {{ $message['sender'] === 'user' ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[84%]">
                            <div @class([
                                'whitespace-pre-line break-words rounded-[18px] px-4 py-2.5 text-sm leading-relaxed shadow-sm',
                                'chatbot-user-bubble text-white' => $message['sender'] === 'user',
                                'chatbot-bot-bubble text-slate-700' => $message['sender'] === 'bot',
                            ])>
                                {{ $message['text'] }}
                            </div>

                            @if ($showTimestamp)
                                <p class="mt-1 text-[11px] text-slate-400 {{ $message['sender'] === 'user' ? 'text-right' : 'text-left' }}">
                                    {{ $message['time'] }}
                                </p>
                            @endif

                            @if (!empty($message['quick_replies']) && $loop->last)
                                <div class="mt-3 flex flex-wrap gap-2">
                                    @foreach ($message['quick_replies'] as $quickReply)
                                        <button
                                            type="button"
                                            wire:click="useQuickReply(@js($quickReply))"
                                            class="chatbot-chip rounded-full border px-3 py-1.5 text-xs font-medium text-slate-600 transition"
                                        >
                                            {{ $quickReply }}
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

                <div
                    wire:loading.flex
                    wire:target="sendMessage,useQuickReply,handleWelcomeCta"
                    class="justify-start"
                >
                    <div class="chatbot-bot-bubble rounded-[18px] px-4 py-2.5 text-sm text-slate-600 shadow-sm">
                        <span class="inline-flex items-center gap-1">
                            <span class="h-2 w-2 animate-pulse rounded-full bg-slate-400"></span>
                            <span class="h-2 w-2 animate-pulse rounded-full bg-slate-400 [animation-delay:120ms]"></span>
                            <span class="h-2 w-2 animate-pulse rounded-full bg-slate-400 [animation-delay:220ms]"></span>
                        </span>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="sendMessage" class="border-t border-slate-100 p-3">
                @php
                    $isInputEmpty = trim($newMessage) === '';
                @endphp
                <div class="flex items-center gap-2">
                    <button
                        type="button"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-full text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
                        aria-label="Emoji"
                    >
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>

                    <label for="chatbot-message" class="sr-only">Ketik pertanyaan</label>
                    <input
                        id="chatbot-message"
                        type="text"
                        wire:model.live.debounce.200ms="newMessage"
                        class="h-11 flex-1 rounded-full border border-slate-200 px-4 text-sm text-slate-700 placeholder:text-slate-400 focus:border-yellow-300 focus:ring-yellow-200"
                        placeholder="Ketik pertanyaan..."
                        autocomplete="off"
                    >

                    <button
                        type="submit"
                        @disabled($isInputEmpty)
                        class="chatbot-send-btn inline-flex h-11 w-11 items-center justify-center rounded-full text-[#0B2A4A] transition {{ $isInputEmpty ? 'cursor-not-allowed opacity-50' : '' }}"
                        aria-label="Kirim pesan"
                    >
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h13m0 0l-4-4m4 4l-4 4" />
                        </svg>
                    </button>
                </div>
            </form>
        </section>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            if (window.__chatbotScrollReady) {
                return;
            }

            window.__chatbotScrollReady = true;

            const scrollPanels = () => {
                document.querySelectorAll('[data-chatbot-messages]').forEach((panel) => {
                    panel.scrollTop = panel.scrollHeight;
                });
            };

            scrollPanels();
            Livewire.on('chatbot-scroll', () => requestAnimationFrame(scrollPanels));
        });
    </script>
@endpush
