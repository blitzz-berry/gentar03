<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>@yield('title', 'Generasi Taruna 03 - Karang Taruna RW 03')</title>
    <meta name="description" content="@yield('description', 'Generasi Taruna 03 adalah organisasi kepemudaan di RW 03 Kelurahan Duri Kosambi, Cengkareng, Jakarta Barat. Kami aktif dalam berbagai kegiatan sosial, kreatif, dan edukatif untuk memberdayakan pemuda di lingkungan kami.')">
    <meta name="keywords" content="Generasi Taruna 03, Karang Taruna RW 03, Duri Kosambi, Cengkareng, Jakarta Barat, organisasi pemuda, kegiatan sosial, kewirausahaan pemuda">
    <meta name="author" content="Generasi Taruna 03">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta Tags for Social Sharing -->
    <meta property="og:title" content="@yield('title', 'Generasi Taruna 03 - Karang Taruna RW 03')">
    <meta property="og:description" content="@yield('description', 'Generasi Taruna 03 adalah organisasi kepemudaan di RW 03 Kelurahan Duri Kosambi, Cengkareng, Jakarta Barat.')">
    <meta property="og:type" content="@yield('og-type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og-image', asset('media/site/og-default.jpg'))">
    <meta property="og:site_name" content="Generasi Taruna 03">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Generasi Taruna 03 - Karang Taruna RW 03')">
    <meta name="twitter:description" content="@yield('description', 'Generasi Taruna 03 adalah organisasi kepemudaan di RW 03 Kelurahan Duri Kosambi, Cengkareng, Jakarta Barat.')">
    <meta name="twitter:image" content="@yield('og-image', asset('media/site/og-default.jpg'))">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('media/site/favicon.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-red: #e74c3c;
            --primary-white: #ffffff;
            --primary-green: #27ae60;
        }

        .bg-primary {
            background-color: var(--primary-red);
        }

        .bg-secondary {
            background-color: var(--primary-green);
        }

        .text-primary {
            color: var(--primary-red);
        }

        .text-secondary {
            color: var(--primary-green);
        }

        .border-primary {
            border-color: var(--primary-red);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Header/Navigation -->
    <livewire:navbar />

    <!-- Page Content -->
    <main class="{{ request()->routeIs('welcome') ? '' : 'pt-20' }}">
        @yield('content')
    </main>

    <!-- Footer -->
    <livewire:footer />

    <!-- Chatbot Widget -->
    <livewire:chatbot-widget />

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>
