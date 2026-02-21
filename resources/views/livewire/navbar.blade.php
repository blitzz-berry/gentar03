@php
    $isHome = request()->routeIs('welcome');
@endphp

<nav id="site-navbar" class="site-navbar {{ $isHome ? 'is-home' : 'scrolled' }}" data-home="{{ $isHome ? 'true' : 'false' }}">
    <div class="mx-auto flex h-20 w-full max-w-7xl items-center px-4 sm:px-6 lg:px-8">
        <a href="{{ route('welcome') }}" class="flex shrink-0 items-center">
            <img src="{{ asset('media/site/logo-katar.png') }}" alt="Logo Karang Taruna" class="h-10 w-auto">
            <span class="site-brand-text ml-2 hidden text-lg font-bold sm:inline">Generasi Taruna 03</span>
        </a>

        <div class="hidden flex-1 justify-center md:flex">
            <div class="flex items-center gap-8">
                <a href="{{ route('welcome') }}" class="site-nav-link text-sm font-medium">Beranda</a>
                <a href="{{ route('tentang-kami') }}" class="site-nav-link text-sm font-medium">Tentang Kami</a>
                <a href="{{ route('kegiatan.index') }}" class="site-nav-link text-sm font-medium">Kegiatan</a>
                <a href="{{ route('galeri.index') }}" class="site-nav-link text-sm font-medium">Galeri</a>
                <a href="{{ route('artikel.index') }}" class="site-nav-link text-sm font-medium">Berita</a>
                <a href="{{ route('kontak.create') }}" class="site-nav-link text-sm font-medium">Kontak</a>
            </div>
        </div>

        <div class="ml-auto flex items-center gap-3">
            <x-button variant="gold" size="sm" :href="route('kontak.create')" class="hidden md:inline-flex">
                Hubungi Kami
            </x-button>

            <button id="mobile-menu-button" type="button" class="site-mobile-toggle md:hidden" aria-label="Toggle menu">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="site-mobile-menu hidden md:hidden">
        <div class="mx-auto max-w-7xl px-4 pb-5">
            <div class="flex flex-col gap-3 pt-3">
                <a href="{{ route('welcome') }}" class="site-mobile-link text-sm font-medium">Beranda</a>
                <a href="{{ route('tentang-kami') }}" class="site-mobile-link text-sm font-medium">Tentang Kami</a>
                <a href="{{ route('kegiatan.index') }}" class="site-mobile-link text-sm font-medium">Kegiatan</a>
                <a href="{{ route('galeri.index') }}" class="site-mobile-link text-sm font-medium">Galeri</a>
                <a href="{{ route('artikel.index') }}" class="site-mobile-link text-sm font-medium">Berita</a>
                <a href="{{ route('kontak.create') }}" class="site-mobile-link text-sm font-medium">Kontak</a>
                <x-button variant="gold" size="sm" :href="route('kontak.create')" class="w-full justify-center">
                    Hubungi Kami
                </x-button>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const nav = document.getElementById('site-navbar');

        if (!nav || nav.dataset.initialized === 'true') {
            return;
        }

        nav.dataset.initialized = 'true';

        const isHome = nav.dataset.home === 'true';
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        const syncNavbarState = () => {
            if (!isHome) {
                nav.classList.add('scrolled');
                return;
            }
            nav.classList.toggle('scrolled', window.scrollY > 20);
        };

        syncNavbarState();
        window.addEventListener('scroll', syncNavbarState, { passive: true });

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function () {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>
