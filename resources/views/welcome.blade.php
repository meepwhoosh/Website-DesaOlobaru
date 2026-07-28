@extends('layouts.app')

@section('title', 'Beranda - Website Resmi Desa Olobaru')

@section('content')
<!-- Hero Section -->
<section data-aos="fade-in" class="relative min-h-[90vh] flex items-center justify-center bg-slate-900 overflow-hidden pt-12">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1500485035595-cbe6f645feb1?q=80&w=1600&auto=format&fit=crop" 
             alt="Persawahan Desa Olobaru" 
             class="w-full h-full object-cover object-center opacity-40 scale-105 animate-[subtle-zoom_20s_infinite_alternate]" />
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/60 to-transparent"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white py-20">
        <!-- Badge -->
        <span class="inline-flex items-center px-4.5 py-1.5 rounded-full text-xs font-semibold bg-green-950/80 border border-green-800 text-green-300 backdrop-blur-md mb-6 uppercase tracking-wider">
            Selamat Datang di Website Resmi Desa Olobaru
        </span>
        
        <!-- Heading -->
        <h1 class="font-serif text-4xl sm:text-5xl md:text-6xl font-bold tracking-tight mb-6 leading-tight max-w-4xl mx-auto">
            Mengenal Desa Olobaru, <br class="hidden sm:inline" />
            <span class="text-green-400">Dalam Satu Portal Informasi.</span>
        </h1>
        
        <!-- Subtitle -->
        <p class="text-lg sm:text-xl text-slate-200 font-light max-w-3xl mx-auto mb-10 leading-relaxed">
            Temukan informasi mengenai profil desa, struktur organisasi, data desa, berita terbaru, serta galeri kegiatan Desa Olobaru dalam satu website resmi.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-6 mb-8 lg:mb-12">
            <a href="{{ route('profil') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-full bg-green-700 hover:bg-green-600 text-white font-semibold shadow-lg shadow-green-900/30 transition-all duration-200 transform hover:-translate-y-0.5">
                Jelajahi Desa
            </a>
            <a href="{{ route('profil') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-full border-2 border-white/80 hover:border-white text-white font-semibold backdrop-blur-sm hover:bg-white dark:bg-[#1e293b]/10 transition-all duration-200 transform hover:-translate-y-0.5">
                Struktur Organisasi
            </a>
        </div>
    </div>
</section>

<!-- Features / Quick Links Section -->
<section data-aos="fade-in" class="relative z-20 -mt-16 lg:-mt-20 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div data-aos="fade-up" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Card 1: Profil Desa -->
            <a href="{{ route('profil') }}" data-aos="fade-up" data-aos-delay="100" class="group bg-white  dark:bg-[#1e293b] rounded-2xl p-6 shadow-md border border-slate-100 dark:border-slate-700/50 hover:shadow-xl hover:border-green-100 dark:hover:border-green-800 transition-all duration-300 transform hover:-translate-y-1 flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-300 flex items-center justify-center mb-5 group-hover:bg-green-700 group-hover:text-white transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 group-hover:text-green-700 dark:text-green-300 dark:group-hover:text-green-400 transition-colors">Profil Desa</h3>
                    <p class="text-sm text-slate-600 dark:text-white leading-relaxed">Kenali sejarah asal-usul, visi & misi pembangunan, serta letak geografis Desa Olobaru.</p>
                </div>
                <div class="mt-4 flex items-center text-xs font-semibold text-green-700 dark:text-green-300 group-hover:translate-x-1.5 transition-transform duration-300 gap-1.5">
                    Pelajari Sejarah 
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                </div>
            </a>

            <!-- Card 2: Struktur Organisasi -->
            <a href="{{ route('profil') }}" data-aos="fade-up" data-aos-delay="200" class="group bg-white  dark:bg-[#1e293b] rounded-2xl p-6 shadow-md border border-slate-100 dark:border-slate-700/50 hover:shadow-xl hover:border-orange-100 dark:hover:border-orange-800 transition-all duration-300 transform hover:-translate-y-1 flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-orange-50 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300 flex items-center justify-center mb-5 group-hover:bg-orange-600 group-hover:text-white transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 group-hover:text-orange-700 dark:text-orange-300 dark:group-hover:text-orange-400 transition-colors">Struktur Organisasi</h3>
                    <p class="text-sm text-slate-600 dark:text-white leading-relaxed">Bagan tata kelola perangkat desa serta bagan kerja kepemimpinan SOTK Desa Olobaru.</p>
                </div>
                <div class="mt-4 flex items-center text-xs font-semibold text-orange-700 dark:text-orange-300 group-hover:translate-x-1.5 transition-transform duration-300 gap-1.5">
                    Lihat SOTK
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                </div>
            </a>

            <!-- Card 3: Data Desa -->
            <a href="{{ route('data-desa') }}" data-aos="fade-up" data-aos-delay="300" class="group bg-white  dark:bg-[#1e293b] rounded-2xl p-6 shadow-md border border-slate-100 dark:border-slate-700/50 hover:shadow-xl hover:border-purple-100 dark:hover:border-purple-800 transition-all duration-300 transform hover:-translate-y-1 flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-purple-50 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400 flex items-center justify-center mb-5 group-hover:bg-purple-600 group-hover:text-white transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 group-hover:text-purple-700 dark:text-purple-400 dark:group-hover:text-purple-400 transition-colors">Data Desa</h3>
                    <p class="text-sm text-slate-600 dark:text-white leading-relaxed">Informasi demografi, statistik kependudukan, dan ringkasan data wilayah Desa Olobaru.</p>
                </div>
                <div class="mt-4 flex items-center text-xs font-semibold text-purple-700 dark:text-purple-400 group-hover:translate-x-1.5 transition-transform duration-300 gap-1.5">
                    Lihat Data
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                </div>
            </a>
            
            <!-- Card 4: Berita Desa -->
            <a href="{{ route('berita') }}" data-aos="fade-up" data-aos-delay="400" class="group bg-white  dark:bg-[#1e293b] rounded-2xl p-6 shadow-md border border-slate-100 dark:border-slate-700/50 hover:shadow-xl hover:border-blue-100 dark:hover:border-blue-800 transition-all duration-300 transform hover:-translate-y-1 flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 flex items-center justify-center mb-5 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 group-hover:text-blue-700 dark:text-blue-300 dark:group-hover:text-blue-400 transition-colors">Berita Desa</h3>
                    <p class="text-sm text-slate-600 dark:text-white leading-relaxed">Informasi terkini, agenda kegiatan, dan pengumuman resmi dari aparatur desa.</p>
                </div>
                <div class="mt-4 flex items-center text-xs font-semibold text-blue-700 dark:text-blue-300 group-hover:translate-x-1.5 transition-transform duration-300 gap-1.5">
                    Baca Berita
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section data-aos="fade-in" class="py-12 bg-white dark:bg-slate-900 border-y border-slate-100 dark:border-[#334155]/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div data-aos="fade-up" class="grid grid-cols-2 lg:grid-cols-4 gap-y-8 gap-x-4 text-center divide-y lg:divide-y-0 lg:divide-x divide-slate-100 dark:divide-slate-800">
            
            <!-- Stat 1 -->
            <div data-aos="fade-up" data-aos-delay="100" class="pt-4 lg:pt-0">
                <span class="block text-4xl sm:text-5xl font-extrabold text-green-950 dark:text-white font-serif leading-none tracking-tight">{{ number_format($totalPenduduk, 0, ',', '.') }}</span>
                <span class="block text-xs sm:text-sm text-slate-500 dark:text-white font-semibold uppercase tracking-wider mt-2.5">Total Penduduk</span>
            </div>

            <!-- Stat 2 -->
            <div data-aos="fade-up" data-aos-delay="200" class="pt-4 lg:pt-0">
                <span class="block text-4xl sm:text-5xl font-extrabold text-green-950 dark:text-white font-serif leading-none tracking-tight">{{ number_format($lakiLaki, 0, ',', '.') }}</span>
                <span class="block text-xs sm:text-sm text-slate-500 dark:text-white font-semibold uppercase tracking-wider mt-2.5">Laki-laki</span>
            </div>

            <!-- Stat 3 -->
            <div data-aos="fade-up" data-aos-delay="300" class="pt-4 lg:pt-0">
                <span class="block text-4xl sm:text-5xl font-extrabold text-green-950 dark:text-white font-serif leading-none tracking-tight">{{ number_format($perempuan, 0, ',', '.') }}</span>
                <span class="block text-xs sm:text-sm text-slate-500 dark:text-white font-semibold uppercase tracking-wider mt-2.5">Perempuan</span>
            </div>

            <!-- Stat 4 -->
            <div data-aos="fade-up" data-aos-delay="400" class="pt-4 lg:pt-0">
                <span class="block text-4xl sm:text-5xl font-extrabold text-green-950 dark:text-white font-serif leading-none tracking-tight">{{ number_format($totalDusun, 0, ',', '.') }}</span>
                <span class="block text-xs sm:text-sm text-slate-500 dark:text-white font-semibold uppercase tracking-wider mt-2.5">Total Dusun</span>
            </div>

        </div>
    </div>
</section>

<!-- Sambutan Kepala Desa Section -->
<section data-aos="fade-in" class="py-20 bg-white dark:bg-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-start gap-12">
            <!-- Foto Kepala Desa -->
            <div data-aos="fade-right" class="w-full md:w-1/3 flex justify-center md:justify-end lg:justify-center">
                <div class="relative">
                    <div class="absolute inset-0 bg-green-700 rounded-3xl translate-x-4 translate-y-4 -z-10 opacity-20"></div>
                    <img src="{{ asset('images/foto-kades.jpg') }}" 
                         alt="Foto Kepala Desa Olobaru" 
                         class="w-64 h-80 object-cover rounded-3xl shadow-xl border-4 border-white dark:border-[#334155]/50" />
                    <!-- Name badge -->
                    <div class="absolute -bottom-6 left-1/2 -translate-x-1/2 bg-white dark:bg-[#1e293b] px-6 py-3 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700/50 w-[110%] text-center">
                        <h4 class="font-bold text-slate-900 dark:text-white text-lg">Arnold</h4>
                        <p class="text-xs text-green-700 dark:text-green-300 font-semibold uppercase tracking-wider mt-1">Kepala Desa Olobaru</p>
                    </div>
                </div>
            </div>
            
            <!-- Teks Sambutan -->
            <div data-aos="fade-left" class="w-full md:w-2/3 space-y-6 pt-10 md:pt-0">
                <span class="text-sm font-bold text-green-700 dark:text-green-400 uppercase tracking-widest block">Sambutan Kepala Desa</span>
                <h2 class="text-3xl sm:text-4xl font-bold font-serif text-slate-900 dark:text-white tracking-tight leading-tight">
                    Selamat Datang di Website Resmi Desa Olobaru
                </h2>
                <div class="relative">
                    <svg class="absolute -top-4 -left-6 w-12 h-12 text-slate-200 dark:text-slate-800 dark:text-slate-100 -z-10 transform -scale-x-100" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
                        <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.896 3.456-8.352 9.12-8.352 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z"></path>
                    </svg>
                    <p class="text-slate-600 dark:text-white leading-relaxed text-lg font-medium italic">
                        "Selamat datang di Website Profil Desa Olobaru. Website ini hadir sebagai media informasi yang memperkenalkan sejarah, pemerintahan, kondisi wilayah, serta data desa Olobaru."
                    </p>
                </div>
                <p class="text-slate-600 dark:text-white leading-relaxed text-base">
                    Melalui website ini, kami berharap masyarakat dan seluruh pengunjung dapat mengenal Desa Olobaru lebih dekat, memahami perkembangan desa. Semoga website ini menjadi jendela informasi yang memberikan manfaat bagi semua pihak dan semakin memperkenalkan Desa Olobaru kepada masyarakat luas.
                </p>
                <div class="pt-2">
                    <img src="{{ asset('images/ttd-kades.png') }}" alt="Tanda Tangan" class="h-16 opacity-60 mix-blend-multiply dark:mix-blend-normal dark:invert dark:opacity-80" onerror="this.style.display='none'">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Overview / Profil Singkat Section -->
<section data-aos="fade-in" class="py-20 bg-slate-50 dark:bg-slate-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div data-aos="fade-up" class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Image Frame -->
            <div data-aos="fade-right" class="lg:col-span-5 relative">
                <div class="absolute -top-4 -left-4 w-72 h-72 bg-green-200 dark:bg-green-900/40 rounded-3xl -z-10 opacity-60"></div>
                <div class="absolute -bottom-4 -right-4 w-72 h-72 bg-yellow-100 dark:bg-yellow-900/40 rounded-3xl -z-10 opacity-70"></div>
                <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?q=80&w=1000&auto=format&fit=crop" 
                     alt="Kantor Desa Olobaru" 
                     class="w-full aspect-[4/3] object-cover rounded-2xl shadow-xl border-4 border-white dark:border-[#334155]/50" />
            </div>

            <!-- Text Content -->
            <div data-aos="fade-left" class="lg:col-span-7 space-y-6">
                <span class="text-sm font-bold text-green-700 dark:text-green-400 uppercase tracking-widest block">Mengenal Desa Olobaru</span>
                <h2 class="text-3xl sm:text-4xl font-bold font-serif text-slate-900 dark:text-white tracking-tight leading-tight">
                    Membangun Desa Olobaru yang Maju, Sejahtera, dan Berbudaya
                </h2>
                <p class="text-slate-600 dark:text-white leading-relaxed text-base">
                    Desa Olobaru merupakan salah satu desa yang berada di Kecamatan Parigi Selatan, Kabupaten Parigi Moutong, Provinsi Sulawesi Tengah. Desa ini memiliki potensi di bidang pertanian, kekayaan alam, serta kehidupan masyarakat yang menjunjung tinggi nilai kebersamaan, gotong royong, dan adat istiadat yang diwariskan secara turun-temurun.
                </p>
                <p class="text-slate-600 dark:text-white leading-relaxed text-base">
                    Website ini hadir sebagai media informasi resmi Desa Olobaru untuk memperkenalkan profil desa, struktur organisasi pemerintahan, data desa, berita terbaru, galeri kegiatan, serta berbagai informasi yang dapat diakses dengan mudah oleh masyarakat maupun pengunjung.
                </p>
                <div class="pt-4 flex flex-wrap gap-4">
                    <a href="{{ route('profil') }}" class="px-6 py-3 bg-green-950 dark:bg-green-700 text-white rounded-xl font-semibold hover:bg-green-900 dark:hover:bg-green-600 transition-colors shadow-md text-sm">
                        Selengkapnya tentang Visi & Misi
                    </a>
                    <a href="{{ route('profil') }}" class="px-6 py-3 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-white bg-white dark:bg-[#1e293b] rounded-xl font-semibold hover:bg-slate-50 dark:bg-slate-900/50 dark:hover:bg-slate-700 transition-colors text-sm">
                        Hubungi Kami
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Latest News Preview -->
<section data-aos="fade-in" class="py-20 bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-[#334155]/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between mb-12 gap-4">
            <div>
                <span class="text-sm font-bold text-green-700 dark:text-green-400 uppercase tracking-widest block mb-2">Informasi Terkini</span>
                <h2 class="text-3xl font-bold font-serif text-slate-900 dark:text-white tracking-tight">Kabar Terbaru Desa Olobaru</h2>
            </div>
            <a href="{{ route('berita') }}" class="inline-flex items-center gap-1.5 text-green-750 dark:text-green-300 font-bold hover:text-green-600 transition-colors text-sm shrink-0">
                Lihat Semua Berita 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>

        <!-- News Grid -->
        <div data-aos="fade-up" class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            @forelse($beritas as $berita)
            <article data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 150 }}" class="group flex flex-col bg-white dark:bg-[#1e293b] border border-slate-100 dark:border-slate-700/50 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                <div class="aspect-[16/10] overflow-hidden bg-slate-100 dark:bg-slate-900 relative">
                    @php
                        $gambarArr = is_array($berita->gambar) ? $berita->gambar : (is_string($berita->gambar) ? [$berita->gambar] : []);
                        $firstGambar = !empty($gambarArr) ? $gambarArr[0] : null;
                    @endphp
                    @if($firstGambar)
                        <img src="{{ asset('storage/' . $firstGambar) }}" 
                             alt="{{ $berita->judul }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-slate-200 dark:bg-[#1e293b]">
                            <svg class="w-12 h-12 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                    @endif
                    <span class="absolute top-4 left-4 bg-green-700 text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full">
                        {{ $berita->kategori ?? 'Berita Desa' }}
                    </span>
                </div>
                <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <time class="text-xs text-slate-600 font-medium flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $berita->created_at->format('d F Y') }}
                        </time>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-green-700 dark:text-green-300 dark:group-hover:text-green-400 transition-colors leading-snug">
                            <a href="{{ route('berita') }}">{{ $berita->judul }}</a>
                        </h3>
                        <p class="text-sm text-slate-500 dark:text-white line-clamp-2 leading-relaxed">
                            {{ Str::limit(strip_tags($berita->konten), 100) }}
                        </p>
                    </div>
                    <a href="{{ route('berita') }}" class="text-xs font-semibold text-green-700 dark:text-green-300 flex items-center gap-1 group-hover:gap-2 transition-all">
                        Baca Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-3 py-12 flex flex-col items-center justify-center text-center bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                <svg class="w-12 h-12 text-slate-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                <h3 class="text-lg font-bold text-slate-700 dark:text-slate-100">Belum Ada Kabar Terbaru</h3>
                <p class="text-slate-500 dark:text-white text-sm mt-1">Saat ini belum ada publikasi berita atau kegiatan desa.</p>
            </div>
            @endforelse

        </div>
    </div>
</section>

<!-- Gallery Preview -->
<section data-aos="fade-in" class="py-20 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-[#334155]/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between mb-12 gap-4">
            <div>
                <span class="text-sm font-bold text-green-700 dark:text-green-400 uppercase tracking-widest block mb-2">Dokumentasi Desa</span>
                <h2 class="text-3xl font-bold font-serif text-slate-900 dark:text-white tracking-tight">Galeri Kegiatan</h2>
            </div>
            <a href="{{ route('galeri') }}" class="inline-flex items-center gap-1.5 text-green-750 dark:text-green-300 font-bold hover:text-green-600 transition-colors text-sm shrink-0">
                Lihat Semua Galeri 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>

        <!-- Gallery Grid -->
        <div data-aos="fade-up" class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 gap-4 sm:gap-6">
            @forelse($galeris as $galeri)
            @php
                $gambarArr = is_array($galeri->gambar) ? $galeri->gambar : (is_string($galeri->gambar) ? [$galeri->gambar] : []);
                $firstGambar = !empty($gambarArr) ? $gambarArr[0] : null;
            @endphp
            <a href="{{ route('galeri') }}" class="group block rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 dark:border-slate-700/50 bg-white dark:bg-[#1e293b]">
                <div class="aspect-square w-full relative overflow-hidden bg-slate-100 dark:bg-slate-900">
                    @if($firstGambar)
                        <img src="{{ asset('storage/' . $firstGambar) }}" 
                             alt="{{ $galeri->judul }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out" />
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300 dark:text-slate-200">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                        <div class="p-4 w-full">
                            <h3 class="text-white font-bold text-sm leading-snug line-clamp-2">{{ $galeri->judul }}</h3>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full py-12 flex flex-col items-center justify-center text-center bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                <svg class="w-12 h-12 text-slate-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                <h3 class="text-lg font-bold text-slate-700 dark:text-slate-100">Belum Ada Foto</h3>
                <p class="text-slate-500 dark:text-white text-sm mt-1">Galeri dokumentasi desa belum tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Call to Action Banner -->
<section data-aos="fade-in" class="py-16 bg-green-950 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 80 Q 25 50, 50 80 T 100 80" stroke="white" stroke-width="0.5" fill="none" />
            <path d="M0 60 Q 25 30, 50 60 T 100 60" stroke="white" stroke-width="0.5" fill="none" />
            <path d="M0 40 Q 25 10, 50 40 T 100 40" stroke="white" stroke-width="0.5" fill="none" />
        </svg>
    </div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <h2 class="text-3xl sm:text-4xl font-bold font-serif">Mari Kenali Desa Olobaru Lebih Dekat</h2>
        <p class="text-green-200 font-light max-w-2xl mx-auto text-base">
            Temukan informasi resmi mengenai profil desa, struktur organisasi, berita, galeri, serta data Desa Olobaru. Jika membutuhkan informasi lebih lanjut, jangan ragu untuk menghubungi kami.
        </p>
        <div class="pt-4">
            <a href="{{ route('kontak') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-white text-green-950 hover:bg-slate-100 rounded-full font-bold shadow-lg transition-transform hover:-translate-y-0.5">
                Hubungi Kami
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-900" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>

@endsection
