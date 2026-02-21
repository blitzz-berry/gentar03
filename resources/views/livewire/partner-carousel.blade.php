@php
    $count = count($partners);
    $prevIndex = $count > 0 ? ($activeIndex - 1 + $count) % $count : 0;
    $nextIndex = $count > 0 ? ($activeIndex + 1) % $count : 0;
@endphp

<section class="bg-[#F7F6E7] py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-bold uppercase text-[#0B2A4A]" style="text-shadow: 0 2px 4px rgba(0, 0, 0, 0.12);">
                Partner Kami
            </h2>
        </div>

        <div
            class="relative"
            x-data="{
                timer: null,
                start() {
                    if (this.timer) {
                        return;
                    }
                    this.timer = setInterval(() => $wire.call('next'), 4500);
                },
                stop() {
                    if (this.timer) {
                        clearInterval(this.timer);
                        this.timer = null;
                    }
                }
            }"
            @mouseenter="start()"
            @mouseleave="stop()"
        >
            <div class="flex items-center justify-center gap-6">
                @if($count === 0)
                    <div class="text-gray-500">Belum ada partner.</div>
                @else
                    <a
                        href="{{ $partners[$prevIndex]['url'] }}"
                        class="hidden md:flex h-28 w-40 items-center justify-center rounded-2xl bg-white shadow-md opacity-70 transition-transform duration-300"
                    >
                        <img src="{{ $partners[$prevIndex]['logo'] }}" alt="{{ $partners[$prevIndex]['name'] }}" class="max-h-16 w-auto">
                    </a>

                    <a
                        href="{{ $partners[$activeIndex]['url'] }}"
                        class="flex h-32 w-48 items-center justify-center rounded-2xl bg-white shadow-lg transition-transform duration-300 md:scale-110"
                    >
                        <img src="{{ $partners[$activeIndex]['logo'] }}" alt="{{ $partners[$activeIndex]['name'] }}" class="max-h-20 w-auto">
                    </a>

                    <a
                        href="{{ $partners[$nextIndex]['url'] }}"
                        class="hidden md:flex h-28 w-40 items-center justify-center rounded-2xl bg-white shadow-md opacity-70 transition-transform duration-300"
                    >
                        <img src="{{ $partners[$nextIndex]['logo'] }}" alt="{{ $partners[$nextIndex]['name'] }}" class="max-h-16 w-auto">
                    </a>
                @endif
            </div>
            <div class="mt-8 flex items-center justify-center gap-2">
                @foreach($partners as $index => $partner)
                    <button
                        type="button"
                        class="h-2.5 w-2.5 rounded-full transition {{ $index === $activeIndex ? 'bg-[#0B2A4A]' : 'bg-[#0B2A4A]/30' }}"
                        wire:click="goTo({{ $index }})"
                        aria-label="Slide {{ $index + 1 }}"
                    ></button>
                @endforeach
            </div>
        </div>

    </div>
</section>
