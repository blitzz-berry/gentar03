<section
    class="hero-carousel"
    style="background-image: url('{{ $images[0] }}');"
    x-data="{
        activeIndex: 0,
        images: @js($images),
        interval: 5000,
        timer: null,
        next() {
            this.activeIndex = (this.activeIndex + 1) % this.images.length;
        },
        prev() {
            this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length;
        },
        start() {
            this.stop();
            this.timer = setInterval(() => this.next(), this.interval);
        },
        stop() {
            if (this.timer) {
                clearInterval(this.timer);
                this.timer = null;
            }
        },
        restart() {
            this.start();
        }
    }"
    x-init="start()"
    @mouseenter="stop()"
    @mouseleave="start()"
>
    <div
        class="hero-carousel-track"
        :style="`transform: translateX(-${activeIndex * 100}%);`"
    >
        <template x-for="(image, index) in images" :key="index">
            <div
                class="hero-carousel-slide"
                :style="`background-image: url('${image}');`"
            ></div>
        </template>
    </div>

    <div class="hero-carousel-overlay"></div>

    <button
        type="button"
        class="hero-carousel-arrow hero-carousel-arrow-left"
        aria-label="Slide sebelumnya"
        @click="prev(); restart()"
    >
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 18l-6-6 6-6" />
        </svg>
    </button>

    <button
        type="button"
        class="hero-carousel-arrow hero-carousel-arrow-right"
        aria-label="Slide berikutnya"
        @click="next(); restart()"
    >
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 18l6-6-6-6" />
        </svg>
    </button>

    <div class="hero-carousel-content max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="w-full text-center text-white">
            <h1 class="text-4xl font-bold md:text-6xl">Generasi Taruna 03</h1>
            <p class="mt-6 text-xl md:text-2xl">Karang Taruna RW 03 Kelurahan Duri Kosambi</p>
            <p class="mx-auto mt-4 max-w-2xl text-lg">"Muda, Kreatif, Peduli, dan Berdaya"</p>
            <div class="mt-10 flex flex-col justify-center gap-4 sm:flex-row">
                <x-button variant="gold" size="lg" :href="route('tentang-kami')">
                    Tentang Kami
                </x-button>
                <x-button variant="gold" size="lg" :href="route('kontak.create')">
                    Gabung Sekarang
                </x-button>
            </div>
        </div>
    </div>
</section>
