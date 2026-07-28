<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Website Resmi Desa Olobaru')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-square.png') }}">
    
    <!-- Meta SEO -->
    <meta name="description" content="Pusat informasi dan layanan terpadu Desa Olobaru, Kecamatan Parigi Selatan, Kabupaten Parigi Moutong. Melestarikan warisan, menyambut masa depan.">
    <meta name="keywords" content="Desa Olobaru, Olobaru, Parigi Moutong, Website Desa, KKN Tematik 117, Layanan Warga, UMKM Olobaru">
    <meta name="author" content="KKN Tematik 117 Desa Olobaru">

    <!-- Fonts: Plus Jakarta Sans & Merriweather (for headings) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Leaflet CSS for maps (optional, ready for contacts page) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-serif {
            font-family: 'Merriweather', Georgia, serif;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
    
    <!-- Dark Mode Init Script (Prevents FOUC) -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="flex flex-col min-h-screen text-slate-900 dark:text-white bg-[#f8faf7] dark:bg-slate-900 antialiased overflow-x-hidden">

    <!-- Navigation Header -->
    <header id="main-header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border-b border-slate-100 dark:border-[#334155]/50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Logo / Brand -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="h-10 flex items-center justify-center transition-transform duration-300 group-hover:scale-105">
                        <img src="{{ asset('images/logo-parigi.png') }}" alt="Logo Kabupaten Parigi Moutong" class="h-10 w-auto object-contain drop-shadow-md">
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-bold tracking-tight text-green-950 dark:text-green-400 group-hover:text-green-700 dark:text-green-300 dark:group-hover:text-green-400 transition-colors">Desa Olobaru</span>
                        <span class="text-[10px] text-slate-500 dark:text-white font-medium uppercase tracking-wider">Parigi Moutong</span>
                    </div>
                </a>

                <!-- Desktop Navigation Menu -->
                <nav class="hidden lg:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('home') ? 'text-green-700 bg-green-50' : 'text-slate-600 dark:text-white hover:text-green-700 dark:text-green-300 hover:bg-slate-50 dark:bg-slate-900/50' }}">
                        Beranda
                    </a>
                    <a href="{{ route('profil') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('profil') ? 'text-green-700 bg-green-50' : 'text-slate-600 dark:text-white hover:text-green-700 dark:text-green-300 hover:bg-slate-50 dark:bg-slate-900/50' }}">
                        Profil Desa
                    </a>
                    <a href="{{ route('struktur') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('struktur') ? 'text-green-700 bg-green-50' : 'text-slate-600 dark:text-white hover:text-green-700 dark:text-green-300 hover:bg-slate-50 dark:bg-slate-900/50' }}">
                        Struktur Organisasi
                    </a>
                    <a href="{{ route('data-desa') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('data-desa') ? 'text-green-700 bg-green-50' : 'text-slate-600 dark:text-white hover:text-green-700 dark:text-green-300 hover:bg-slate-50 dark:bg-slate-900/50' }}">
                        Data Desa
                    </a>
                    <a href="{{ route('berita') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('berita') ? 'text-green-700 bg-green-50' : 'text-slate-600 dark:text-white hover:text-green-700 dark:text-green-300 hover:bg-slate-50 dark:bg-slate-900/50' }}">
                        Berita
                    </a>
                    <a href="{{ route('galeri') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('galeri') ? 'text-green-700 bg-green-50' : 'text-slate-600 dark:text-white hover:text-green-700 dark:text-green-300 hover:bg-slate-50 dark:bg-slate-900/50' }}">
                        Galeri
                    </a>

                </nav>

                <!-- Right-side actions -->
                <div class="hidden lg:flex items-center gap-4">
                    <!-- Dark Mode Toggle Button Desktop -->
                    <button id="theme-toggle" type="button" class="text-slate-500 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none rounded-lg text-sm p-2.5 transition-colors">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                    </button>
                    <!-- CTA Hubungi Kami Button -->
                    <a href="{{ route('kontak') }}" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-green-900 dark:bg-green-700 hover:bg-green-850 dark:hover:bg-green-600 text-white text-sm font-semibold shadow-md shadow-green-900/10 dark:shadow-green-900/30 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                        Hubungi Kami
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center lg:hidden">
                    <button id="mobile-menu-btn" class="p-2.5 rounded-xl text-slate-600 dark:text-white hover:text-green-700 dark:text-green-300 hover:bg-slate-150 transition-colors focus:outline-none" aria-label="Buka Menu">
                        <svg id="menu-icon-open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg id="menu-icon-close" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Navigation Drawer -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white/95 dark:bg-slate-900/95 border-b border-slate-100 dark:border-[#334155]/50 max-h-[calc(100vh-80px)] overflow-y-auto">
            <div class="px-4 pt-2 pb-6 space-y-1.5 shadow-inner">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('home') ? 'text-green-700 dark:text-green-300 bg-green-50' : 'text-slate-700 dark:text-slate-100 hover:text-green-700 dark:text-green-300 hover:bg-slate-50 dark:bg-slate-900/50' }}">
                    Beranda
                </a>
                <a href="{{ route('profil') }}" class="block px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('profil') ? 'text-green-700 dark:text-green-300 bg-green-50' : 'text-slate-700 dark:text-slate-100 hover:text-green-700 dark:text-green-300 hover:bg-slate-50 dark:bg-slate-900/50' }}">
                    Profil Desa
                </a>
                <a href="{{ route('struktur') }}" class="block px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('struktur') ? 'text-green-700 dark:text-green-300 bg-green-50' : 'text-slate-700 dark:text-slate-100 hover:text-green-700 dark:text-green-300 hover:bg-slate-50 dark:bg-slate-900/50' }}">
                    Struktur Organisasi
                </a>
                <a href="{{ route('data-desa') }}" class="block px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('data-desa') ? 'text-green-700 dark:text-green-300 bg-green-50' : 'text-slate-700 dark:text-slate-100 hover:text-green-700 dark:text-green-300 hover:bg-slate-50 dark:bg-slate-900/50' }}">
                    Data Desa
                </a>
                <a href="{{ route('berita') }}" class="block px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('berita') ? 'text-green-700 dark:text-green-300 bg-green-50' : 'text-slate-700 dark:text-slate-100 hover:text-green-700 dark:text-green-300 hover:bg-slate-50 dark:bg-slate-900/50' }}">
                    Berita
                </a>
                <a href="{{ route('galeri') }}" class="block px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('galeri') ? 'text-green-700 dark:text-green-300 bg-green-50' : 'text-slate-700 dark:text-slate-100 hover:text-green-700 dark:text-green-300 hover:bg-slate-50 dark:bg-slate-900/50' }}">
                    Galeri
                </a>

                <div class="pt-4 border-t border-slate-100 dark:border-[#334155]/50 flex flex-col gap-3">
                    <div class="flex justify-center mb-2">
                        <!-- Dark Mode Toggle Button Mobile -->
                        <button id="theme-toggle-mobile" type="button" class="flex items-center justify-center gap-2 text-slate-500 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg text-sm px-4 py-2 transition-colors w-full border border-slate-200 dark:border-slate-700/50">
                            <span id="theme-text-mobile" class="font-semibold">Ubah Tema</span>
                        </button>
                    </div>
                    <div class="relative mx-4 mt-2">
                        <a href="{{ route('kontak') }}" class="text-center px-6 py-3 rounded-xl bg-green-900 dark:bg-green-700 text-white font-semibold shadow-md block hover:bg-green-800 dark:hover:bg-green-600 transition-colors">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 dark:bg-slate-950 text-slate-600 pt-16 pb-8 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 pb-12 border-b border-slate-800">
                
                <!-- Footer Brand Column -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="h-10 flex items-center justify-center">
                            <img src="{{ asset('images/logo-parigi.png') }}" alt="Logo Kabupaten Parigi Moutong" class="h-10 w-auto object-contain drop-shadow-md">
                        </div>
                        <span class="text-xl font-bold tracking-tight text-white">Desa Olobaru</span>
                    </div>
                    <p class="text-sm leading-relaxed text-slate-200">
                        Pusat informasi profil desa, pelestarian budaya, dan potensi ekonomi terpadu Desa Olobaru.
                    </p>
                    <div class="flex space-x-4 pt-2">
                        <!-- Social Media Icon Buttons -->
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-slate-800 text-slate-400 hover:bg-green-700 hover:text-white flex items-center justify-center transition-colors">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                        </a>
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-slate-800 text-slate-400 hover:bg-green-700 hover:text-white flex items-center justify-center transition-colors">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2c2.717 0 3.056.01 4.122.058 1.065.048 1.79.217 2.428.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.637.416 1.363.465 2.428.047 1.066.058 1.405.058 4.122 0 2.717-.01 3.056-.058 4.122-.048 1.065-.217 1.79-.465 2.428a4.88 4.88 0 01-1.153 1.772 4.88 4.88 0 01-1.772 1.153c-.637.247-1.363.416-2.428.465-1.066.047-1.405.058-4.122.058-2.717 0-3.056-.01-4.122-.058-1.065-.048-1.79-.217-2.428-.465a4.89 4.89 0 01-1.772-1.153 4.89 4.89 0 01-1.153-1.772c-.247-.637-.416-.1363-.465-2.428C2.01 15.056 2 14.717 2 12c0-2.717.01-3.056.058-4.122.048-1.065.217-1.79.465-2.428a4.88 4.88 0 011.153-1.772A4.88 4.88 0 015.45 2.525c.637-.247 1.363-.416 2.428-.465C8.944 2.01 9.283 2 12 2zm0 5a5 5 0 100 10 5 5 0 000-10zm0 8a3 3 0 110-6 3 3 0 010 6zm5.6-7.51a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                        </a>
                        <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-slate-800 text-slate-400 hover:bg-green-700 hover:text-white flex items-center justify-center transition-colors">
                            <span class="sr-only">YouTube</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.42 4.814c-.23.861-.907 1.538-1.768 1.768C18.254 19 12 19 12 19s-6.254 0-7.812-.418c-.861-.23-1.538-.907-1.768-1.768C2 15.254 2 12 2 12s0-3.255.418-4.814c.23-.861.907-1.538 1.768-1.768C5.746 5 12 5 12 5s6.254 0 7.812.418zM9.75 15.02l5.75-3.02-5.75-3.02v6.04z" clip-rule="evenodd" /></svg>
                        </a>
                    </div>
                </div>

                <!-- Footer Quick Links -->
                <div class="space-y-4 lg:pl-6">
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider">Tautan Cepat</h3>
                    <ul class="space-y-2.5 text-sm text-slate-300">
                        <li><a href="{{ route('profil') }}" class="hover:text-green-400 transition-colors">Profil Visi & Misi</a></li>
                        <li><a href="{{ route('profil') }}" class="hover:text-green-400 transition-colors">Struktur Organisasi</a></li>
                        <li><a href="{{ route('kontak') }}" class="hover:text-green-400 transition-colors">Kontak & Hubungi Kami</a></li>

                    </ul>
                </div>

                <!-- Footer Services / Info -->
                <div class="space-y-4">
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider">Jam Pelayanan Kantor</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex flex-col gap-1">
                            <span class="text-slate-400">Senin - Kamis</span> 
                            <span class="text-white font-medium">08.00 - 12.00 | 13.00 - 16.00 WITA</span>
                        </li>
                        <li class="flex flex-col gap-1">
                            <span class="text-slate-400">Jumat</span> 
                            <span class="text-white font-medium">08.00 - 11.00 | 13.00 - 16.00 WITA</span>
                        </li>
                        <li class="flex justify-between items-center pt-1">
                            <span class="text-slate-400">Sabtu - Minggu</span> 
                            <span class="text-red-400 font-medium">Tutup</span>
                        </li>
                        <li class="pt-3 mt-1 border-t border-slate-700 text-xs text-white">Kantor Pemerintah Desa Olobaru.</li>
                    </ul>
                </div>

                <!-- Footer Contact Column -->
                <div class="space-y-4">
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider">Kontak & Lokasi</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-white">Kantor Kepala Desa Olobaru, Parigi Selatan, Kab. Parigi Moutong, Sulawesi Tengah, 94371</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="text-white">+62 822-xxxx-xxxx</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="break-all text-white">info@desa-olobaru.id</span>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Footer Bottom -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs">
                <p class="text-white">&copy; 2026 Pemerintah Desa Olobaru. KKN Tematik 117 Universitas Tadulako. All Rights Reserved.</p>
                <div class="flex space-x-6 text-slate-600">
                    <a href="{{ route('home') }}" class="hover:text-green-400">Kebijakan Privasi</a>
                    <a href="{{ route('home') }}" class="hover:text-green-400">Syarat & Ketentuan</a>
                    <a href="{{ route('home') }}" class="hover:text-green-400">Peta Situs</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Navigation Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const openIcon = document.getElementById('menu-icon-open');
            const closeIcon = document.getElementById('menu-icon-close');
            const header = document.getElementById('main-header');

            menuBtn.addEventListener('click', function () {
                // Toggle Menu Visibility
                mobileMenu.classList.toggle('hidden');
                
                // Toggle Icon
                openIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });

            // Sticky Header Effect on Scroll
            window.addEventListener('scroll', function () {
                if (window.scrollY > 20) {
                    header.classList.add('shadow-md');
                    header.classList.remove('shadow-sm');
                } else {
                    header.classList.add('shadow-sm');
                    header.classList.remove('shadow-md');
                }
            });
        });
    </script>

    <!-- Theme Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const themeToggleBtn = document.getElementById('theme-toggle');
            const themeToggleMobileBtn = document.getElementById('theme-toggle-mobile');
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');
            const themeTextMobile = document.getElementById('theme-text-mobile');

            // Set initial icon based on current theme
            if (document.documentElement.classList.contains('dark')) {
                lightIcon?.classList.remove('hidden');
                if (themeTextMobile) themeTextMobile.textContent = 'Mode Terang';
            } else {
                darkIcon?.classList.remove('hidden');
                if (themeTextMobile) themeTextMobile.textContent = 'Mode Gelap';
            }

            function toggleTheme() {
                darkIcon?.classList.toggle('hidden');
                lightIcon?.classList.toggle('hidden');

                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                    if (themeTextMobile) themeTextMobile.textContent = 'Mode Gelap';
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                    if (themeTextMobile) themeTextMobile.textContent = 'Mode Terang';
                }
            }

            themeToggleBtn?.addEventListener('click', toggleTheme);
            themeToggleMobileBtn?.addEventListener('click', toggleTheme);
        });
    </script>
    
    <!-- Leaflet JS for maps (optional, ready for contacts page) -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    
    <!-- Floating Visitor Counter Widget (Draggable) -->
    <div id="visitor-widget-draggable" class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-[9999] cursor-move select-none animate-[fade-in-up_0.5s_ease-out_forwards]" style="touch-action: none;">
        <button id="visitor-widget-btn" class="focus:outline-none focus:ring-4 focus:ring-green-500/20 rounded-2xl transition-transform hover:scale-105 active:scale-95 text-left w-full h-full">
            <div class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border border-slate-200 dark:border-slate-700/50 p-2.5 sm:p-3 rounded-xl shadow-2xl flex items-center gap-3 group hover:bg-white dark:bg-[#1e293b] dark:hover:bg-slate-900 transition-all duration-300">
                <div class="w-8 h-8 rounded-full bg-green-50 dark:bg-green-900/50 flex items-center justify-center text-green-600 dark:text-green-300 shrink-0 shadow-inner group-hover:rotate-12 transition-transform duration-300">
                    <svg class="w-4 h-4 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
                <div class="pointer-events-none">
                    <p class="text-[10px] text-slate-500 dark:text-white font-bold uppercase tracking-wider mb-0.5">Pengunjung Website</p>
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-base sm:text-lg font-black text-slate-900 dark:text-white leading-none">{{ number_format($globalVisitorCount ?? 0, 0, ',', '.') }}</span>
                        <span class="text-[9px] text-green-600 dark:text-green-300 font-semibold flex items-center">
                            <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                            {{ number_format($globalVisitorsToday ?? 0, 0, ',', '.') }} hari ini
                        </span>
                    </div>
                </div>
            </div>
        </button>
    </div>

    <!-- Visitor Stats Modal -->
    <div id="visitor-modal" class="fixed inset-0 z-[10000] flex items-center justify-center p-4 sm:p-0 opacity-0 pointer-events-none transition-opacity duration-300">
        <!-- Backdrop -->
        <div id="visitor-modal-backdrop" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
        
        <!-- Modal Content -->
        <div class="relative bg-white dark:bg-slate-900 rounded-3xl shadow-2xl border border-slate-200 dark:border-[#334155]/50 w-full max-w-sm overflow-hidden transform scale-95 opacity-0 transition-all duration-300" id="visitor-modal-panel">
            <!-- Header -->
            <div class="relative bg-gradient-to-br from-green-600 to-green-800 p-6 text-white text-center">
                <button id="visitor-modal-close" class="absolute top-4 right-4 text-white/80 hover:text-white bg-white/20 dark:bg-[#1e293b]/10 hover:bg-white/30 dark:hover:bg-[#1e293b]/20 p-2 rounded-full backdrop-blur-sm transition-colors focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                <div class="w-16 h-16 mx-auto bg-white/20 dark:bg-[#1e293b]/20 backdrop-blur-md rounded-full flex items-center justify-center mb-3 shadow-inner">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold font-serif tracking-tight">Statistik Pengunjung</h3>
                <p class="text-green-100 text-sm mt-1">Rincian data akses website Desa Olobaru</p>
            </div>
            <!-- Body -->
            <div class="p-6 bg-slate-50 dark:bg-slate-900/50 space-y-5">
                <p class="text-xs text-slate-500 dark:text-white font-semibold uppercase tracking-wider text-center">Filter Waktu Akses</p>
                <div class="grid grid-cols-3 gap-3">
                    <div class="space-y-1">
                        <label class="text-[10px] text-slate-500 dark:text-white font-bold ml-1">Hari</label>
                        <select id="filter-day" class="w-full bg-white dark:bg-[#1e293b] border border-slate-200 dark:border-slate-700/50 text-slate-700 dark:text-slate-200 text-sm rounded-xl px-3 py-2 focus:ring-2 focus:ring-green-500/50 outline-none transition-all">
                            <option value="">Semua</option>
                            @for($i = 1; $i <= 31; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] text-slate-500 dark:text-white font-bold ml-1">Bulan</label>
                        <select id="filter-month" class="w-full bg-white dark:bg-[#1e293b] border border-slate-200 dark:border-slate-700/50 text-slate-700 dark:text-slate-200 text-sm rounded-xl px-3 py-2 focus:ring-2 focus:ring-green-500/50 outline-none transition-all">
                            <option value="">Semua</option>
                            @php
                                $months = [
                                    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                                    '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                                    '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                ];
                            @endphp
                            @foreach($months as $num => $name)
                                <option value="{{ $num }}" {{ (date('m') == $num) ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] text-slate-500 dark:text-white font-bold ml-1">Tahun</label>
                        <select id="filter-year" class="w-full bg-white dark:bg-[#1e293b] border border-slate-200 dark:border-slate-700/50 text-slate-700 dark:text-slate-200 text-sm rounded-xl px-3 py-2 focus:ring-2 focus:ring-green-500/50 outline-none transition-all">
                            <option value="">Semua</option>
                            @php
                                $currentYear = date('Y');
                                $startYear = 2026;
                            @endphp
                            @for($y = $startYear; $y <= $currentYear + 2; $y++)
                                <option value="{{ $y }}" {{ ($currentYear == $y) ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex flex-col items-center justify-center p-6 bg-white dark:bg-[#1e293b] rounded-2xl border border-green-100 dark:border-green-900/30 shadow-sm relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-transparent dark:from-green-900/10 opacity-50"></div>
                    <div class="relative z-10 text-center">
                        <p class="text-sm text-slate-500 dark:text-white font-semibold mb-1">Total Kunjungan</p>
                        <div class="flex items-center justify-center gap-2">
                            <span id="filter-result-count" class="text-4xl font-black text-green-700 dark:text-green-300">
                                <svg class="animate-spin h-8 w-8 text-green-500 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="pt-2 border-t border-slate-200 dark:border-slate-700/50 flex items-center justify-between px-2">
                    <span class="text-sm font-bold text-slate-600 dark:text-white">Total Sepanjang Waktu</span>
                    <span class="text-xl font-black text-slate-800 dark:text-white">{{ number_format($globalVisitorCount ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Draggable & Modal Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const draggableEl = document.getElementById('visitor-widget-draggable');
            const widgetBtn = document.getElementById('visitor-widget-btn');
            
            // --- Draggable Logic ---
            let isDragging = false;
            let hasDragged = false;
            let currentX;
            let currentY;
            let initialX;
            let initialY;
            let xOffset = 0;
            let yOffset = 0;
            
            function dragStart(e) {
                if (e.type === "touchstart") {
                    initialX = e.touches[0].clientX - xOffset;
                    initialY = e.touches[0].clientY - yOffset;
                } else {
                    initialX = e.clientX - xOffset;
                    initialY = e.clientY - yOffset;
                }
                
                // Allow drag from anywhere on the widget
                if (e.target === draggableEl || draggableEl.contains(e.target)) {
                    isDragging = true;
                    hasDragged = false; // Reset drag flag
                }
            }
            
            function dragEnd(e) {
                initialX = currentX;
                initialY = currentY;
                isDragging = false;
            }
            
            function drag(e) {
                if (isDragging) {
                    e.preventDefault();
                    hasDragged = true;
                    
                    if (e.type === "touchmove") {
                        currentX = e.touches[0].clientX - initialX;
                        currentY = e.touches[0].clientY - initialY;
                    } else {
                        currentX = e.clientX - initialX;
                        currentY = e.clientY - initialY;
                    }

                    xOffset = currentX;
                    yOffset = currentY;

                    setTranslate(currentX, currentY, draggableEl);
                }
            }
            
            function setTranslate(xPos, yPos, el) {
                el.style.transform = `translate3d(${xPos}px, ${yPos}px, 0)`;
            }

            draggableEl.addEventListener("touchstart", dragStart, {passive: false});
            draggableEl.addEventListener("touchend", dragEnd, {passive: false});
            draggableEl.addEventListener("touchmove", drag, {passive: false});

            draggableEl.addEventListener("mousedown", dragStart, {passive: false});
            document.addEventListener("mouseup", dragEnd, {passive: false});
            document.addEventListener("mousemove", drag, {passive: false});

            // --- Modal Logic ---
            const modal = document.getElementById('visitor-modal');
            const modalPanel = document.getElementById('visitor-modal-panel');
            const backdrop = document.getElementById('visitor-modal-backdrop');
            const closeBtn = document.getElementById('visitor-modal-close');
            const resultCount = document.getElementById('filter-result-count');
            const filterDay = document.getElementById('filter-day');
            const filterMonth = document.getElementById('filter-month');
            const filterYear = document.getElementById('filter-year');

            function fetchVisitorStats() {
                resultCount.innerHTML = '<svg class="animate-spin h-8 w-8 text-green-500 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
                const params = new URLSearchParams();
                if (filterDay.value) params.append('day', filterDay.value);
                if (filterMonth.value) params.append('month', filterMonth.value);
                if (filterYear.value) params.append('year', filterYear.value);

                fetch(`/api/visitor-stats?${params.toString()}`)
                    .then(response => response.json())
                    .then(data => { resultCount.textContent = data.formatted; })
                    .catch(error => { resultCount.textContent = 'Error'; });
            }

            function openModal(e) {
                if (hasDragged) return; // Prevent clicking if we were dragging
                modal.classList.remove('opacity-0', 'pointer-events-none');
                setTimeout(() => {
                    modalPanel.classList.remove('scale-95', 'opacity-0');
                    modalPanel.classList.add('scale-100', 'opacity-100');
                }, 10);
                fetchVisitorStats();
            }

            function closeModal() {
                modalPanel.classList.remove('scale-100', 'opacity-100');
                modalPanel.classList.add('scale-95', 'opacity-0');
                setTimeout(() => { modal.classList.add('opacity-0', 'pointer-events-none'); }, 300);
            }

            // Click event listener
            widgetBtn.addEventListener('click', openModal);
            // In case a touch ends quickly without dragging, ensure it counts as a click
            widgetBtn.addEventListener('touchend', (e) => {
                if (!hasDragged) {
                    e.preventDefault();
                    openModal();
                }
            });
            
            closeBtn.addEventListener('click', closeModal);
            backdrop.addEventListener('click', closeModal);
            
            function updateDays() {
                const yearVal = filterYear.value;
                const monthVal = filterMonth.value;
                const currentDayVal = filterDay.value;
                let daysInMonth = 31;
                
                if (monthVal) {
                    const year = yearVal ? parseInt(yearVal) : new Date().getFullYear();
                    const month = parseInt(monthVal);
                    daysInMonth = new Date(year, month, 0).getDate();
                }
                
                filterDay.innerHTML = '<option value="">Semua</option>';
                for (let i = 1; i <= daysInMonth; i++) {
                    const option = document.createElement('option');
                    option.value = i.toString().padStart(2, '0');
                    option.textContent = i;
                    filterDay.appendChild(option);
                }
                
                if (currentDayVal && parseInt(currentDayVal) <= daysInMonth) {
                    filterDay.value = currentDayVal;
                }
            }

            filterDay.addEventListener('change', fetchVisitorStats);
            filterMonth.addEventListener('change', () => { updateDays(); fetchVisitorStats(); });
            filterYear.addEventListener('change', () => { updateDays(); fetchVisitorStats(); });
            
            updateDays();
        });
    </script>

    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init({
                duration: 600,
                once: true,
                easing: 'ease-out-quad',
                offset: 20,
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>
