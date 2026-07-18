<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Website Resmi Desa Olobaru')</title>
    
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

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8faf7;
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
</head>
<body class="flex flex-col min-h-screen text-slate-800 antialiased overflow-x-hidden">

    <!-- Navigation Header -->
    <header id="main-header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-white/90 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Logo / Brand -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="h-10 flex items-center justify-center transition-transform duration-300 group-hover:scale-105">
                        <img src="{{ asset('images/logo-parigi.png') }}" alt="Logo Kabupaten Parigi Moutong" class="h-10 w-auto object-contain drop-shadow-md">
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-bold tracking-tight text-green-950 group-hover:text-green-700 transition-colors">Desa Olobaru</span>
                        <span class="text-[10px] text-slate-500 font-medium uppercase tracking-wider">Parigi Moutong</span>
                    </div>
                </a>

                <!-- Desktop Navigation Menu -->
                <nav class="hidden lg:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('home') ? 'text-green-700 bg-green-50' : 'text-slate-600 hover:text-green-700 hover:bg-slate-50' }}">
                        Beranda
                    </a>
                    <a href="{{ route('profil') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('profil') ? 'text-green-700 bg-green-50' : 'text-slate-600 hover:text-green-700 hover:bg-slate-50' }}">
                        Profil Desa
                    </a>
                    <a href="{{ route('data-desa') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('data-desa') ? 'text-green-700 bg-green-50' : 'text-slate-600 hover:text-green-700 hover:bg-slate-50' }}">
                        Data Desa
                    </a>
                    <a href="{{ route('berita') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('berita') ? 'text-green-700 bg-green-50' : 'text-slate-600 hover:text-green-700 hover:bg-slate-50' }}">
                        Berita
                    </a>
                    <a href="{{ route('galeri') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('galeri') ? 'text-green-700 bg-green-50' : 'text-slate-600 hover:text-green-700 hover:bg-slate-50' }}">
                        Galeri
                    </a>
                    <a href="{{ route('potensi') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('potensi') ? 'text-green-700 bg-green-50' : 'text-slate-600 hover:text-green-700 hover:bg-slate-50' }}">
                        Potensi Desa
                    </a>
                </nav>

                <!-- Right-side actions -->
                <div class="hidden lg:flex items-center gap-4">
                    <!-- Search Icon removed -->
                    <!-- CTA Hubungi Kami Button -->
                    <a href="{{ route('kontak') }}" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-green-900 hover:bg-green-850 text-white text-sm font-semibold shadow-md shadow-green-900/10 hover:shadow-lg hover:shadow-green-900/20 transform hover:-translate-y-0.5 transition-all duration-200">
                        Hubungi Kami
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center lg:hidden">
                    <button id="mobile-menu-btn" class="p-2.5 rounded-xl text-slate-600 hover:text-green-700 hover:bg-slate-150 transition-colors focus:outline-none" aria-label="Buka Menu">
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
        <div id="mobile-menu" class="hidden lg:hidden bg-white/95 border-b border-slate-100 max-h-[calc(100vh-80px)] overflow-y-auto">
            <div class="px-4 pt-2 pb-6 space-y-1.5 shadow-inner">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('home') ? 'text-green-700 bg-green-50' : 'text-slate-700 hover:text-green-700 hover:bg-slate-50' }}">
                    Beranda
                </a>
                <a href="{{ route('profil') }}" class="block px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('profil') ? 'text-green-700 bg-green-50' : 'text-slate-700 hover:text-green-700 hover:bg-slate-50' }}">
                    Profil Desa
                </a>
                <a href="{{ route('data-desa') }}" class="block px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('data-desa') ? 'text-green-700 bg-green-50' : 'text-slate-700 hover:text-green-700 hover:bg-slate-50' }}">
                    Data Desa
                </a>
                <a href="{{ route('berita') }}" class="block px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('berita') ? 'text-green-700 bg-green-50' : 'text-slate-700 hover:text-green-700 hover:bg-slate-50' }}">
                    Berita
                </a>
                <a href="{{ route('galeri') }}" class="block px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('galeri') ? 'text-green-700 bg-green-50' : 'text-slate-700 hover:text-green-700 hover:bg-slate-50' }}">
                    Galeri
                </a>
                <a href="{{ route('potensi') }}" class="block px-4 py-3 rounded-xl text-base font-semibold {{ request()->routeIs('potensi') ? 'text-green-700 bg-green-50' : 'text-slate-700 hover:text-green-700 hover:bg-slate-50' }}">
                    Potensi Desa
                </a>
                <div class="pt-4 border-t border-slate-100 flex flex-col gap-3">
                    <!-- Search Input removed -->
                    <div class="relative mx-4 mt-2">
                        <a href="{{ route('kontak') }}" class="text-center px-6 py-3 rounded-xl bg-green-900 text-white font-semibold shadow-md block hover:bg-green-800 transition-colors">
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
    <footer class="bg-slate-900 text-slate-400 pt-16 pb-8 border-t border-slate-800">
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
                    <p class="text-sm leading-relaxed">
                        Pusat informasi profil desa, pelestarian budaya, dan potensi ekonomi terpadu Desa Olobaru.
                    </p>
                    <div class="flex space-x-4 pt-2">
                        <!-- Social Media Icon Buttons -->
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-green-700 hover:text-white flex items-center justify-center transition-colors">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                        </a>
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-green-700 hover:text-white flex items-center justify-center transition-colors">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2c2.717 0 3.056.01 4.122.058 1.065.048 1.79.217 2.428.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.637.416 1.363.465 2.428.047 1.066.058 1.405.058 4.122 0 2.717-.01 3.056-.058 4.122-.048 1.065-.217 1.79-.465 2.428a4.88 4.88 0 01-1.153 1.772 4.88 4.88 0 01-1.772 1.153c-.637.247-1.363.416-2.428.465-1.066.047-1.405.058-4.122.058-2.717 0-3.056-.01-4.122-.058-1.065-.048-1.79-.217-2.428-.465a4.89 4.89 0 01-1.772-1.153 4.89 4.89 0 01-1.153-1.772c-.247-.637-.416-.1363-.465-2.428C2.01 15.056 2 14.717 2 12c0-2.717.01-3.056.058-4.122.048-1.065.217-1.79.465-2.428a4.88 4.88 0 011.153-1.772A4.88 4.88 0 015.45 2.525c.637-.247 1.363-.416 2.428-.465C8.944 2.01 9.283 2 12 2zm0 5a5 5 0 100 10 5 5 0 000-10zm0 8a3 3 0 110-6 3 3 0 010 6zm5.6-7.51a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                        </a>
                        <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-green-700 hover:text-white flex items-center justify-center transition-colors">
                            <span class="sr-only">YouTube</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.42 4.814c-.23.861-.907 1.538-1.768 1.768C18.254 19 12 19 12 19s-6.254 0-7.812-.418c-.861-.23-1.538-.907-1.768-1.768C2 15.254 2 12 2 12s0-3.255.418-4.814c.23-.861.907-1.538 1.768-1.768C5.746 5 12 5 12 5s6.254 0 7.812.418zM9.75 15.02l5.75-3.02-5.75-3.02v6.04z" clip-rule="evenodd" /></svg>
                        </a>
                    </div>
                </div>

                <!-- Footer Quick Links -->
                <div class="space-y-4 lg:pl-6">
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider">Tautan Cepat</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('profil') }}" class="hover:text-green-500 transition-colors">Profil Visi & Misi</a></li>
                        <li><a href="{{ route('profil') }}" class="hover:text-green-500 transition-colors">Struktur Organisasi</a></li>
                        <li><a href="{{ route('kontak') }}" class="hover:text-green-500 transition-colors">Kontak & Hubungi Kami</a></li>
                        <li><a href="{{ route('potensi') }}" class="hover:text-green-500 transition-colors">Destinasi Wisata</a></li>
                        <li><a href="{{ route('potensi') }}" class="hover:text-green-500 transition-colors">Belanja Produk UMKM</a></li>
                    </ul>
                </div>

                <!-- Footer Services / Info -->
                <div class="space-y-4">
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider">Jam Pelayanan Kantor</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li class="flex justify-between"><span>Senin - Kamis</span> <span class="text-slate-300 font-medium">08:00 - 15:00 WITA</span></li>
                        <li class="flex justify-between"><span>Jumat</span> <span class="text-slate-300 font-medium">08:00 - 11:30 WITA</span></li>
                        <li class="flex justify-between"><span>Sabtu - Minggu</span> <span class="text-red-400 font-medium">Tutup</span></li>
                        <li class="pt-2 border-t border-slate-800 text-xs text-slate-500">Kantor Pemerintah Desa Olobaru.</li>
                    </ul>
                </div>

                <!-- Footer Contact Column -->
                <div class="space-y-4">
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider">Kontak & Lokasi</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Kantor Kepala Desa Olobaru, Parigi Selatan, Kab. Parigi Moutong, Sulawesi Tengah, 94371</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>+62 822-xxxx-xxxx</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="break-all">info@desa-olobaru.id</span>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Footer Bottom -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs">
                <p>&copy; 2026 Pemerintah Desa Olobaru. KKN Tematik 117 Universitas Tadulako. All Rights Reserved.</p>
                <div class="flex space-x-6">
                    <a href="{{ route('home') }}" class="hover:text-green-500">Kebijakan Privasi</a>
                    <a href="{{ route('home') }}" class="hover:text-green-500">Syarat & Ketentuan</a>
                    <a href="{{ route('home') }}" class="hover:text-green-500">Peta Situs</a>
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

    <!-- Leaflet JS for maps (optional, ready for contacts page) -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    @yield('scripts')
</body>
</html>
