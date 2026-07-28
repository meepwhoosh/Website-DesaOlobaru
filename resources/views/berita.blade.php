@extends('layouts.app')

@section('title', 'Kabar Desa & Berita - Website Resmi Desa Olobaru')

@section('content')
<!-- Small Header Banner -->
<section data-aos="fade-in" class="relative py-16 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/bg-struktur.jpg') }}" 
             alt="Kegiatan Desa Olobaru" 
             class="w-full h-full object-cover object-[50%_30%] opacity-40" />
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-slate-900/70"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <span class="text-xs font-bold text-green-400 uppercase tracking-widest block mb-2">Pusat Kabar</span>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold tracking-tight">Berita & Kegiatan Desa</h1>
    </div>
</section>

<!-- Content Body -->
<section data-aos="fade-in" class="py-16 bg-slate-50/50 dark:bg-slate-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        <!-- Search and Category Filters -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white dark:bg-[#1e293b] border border-slate-100 dark:border-slate-700/50 p-6 rounded-2xl shadow-sm">
            <!-- Text Description replacing Categories -->
            <div class="flex-grow">
                <h2 class="text-2xl font-bold font-serif text-slate-700 dark:text-white">Berita Desa</h2>
                <p class="text-sm text-slate-900 dark:text-white mt-1">
                    Menyajikan informasi terbaru tentang peristiwa, berita terkini, dan artikel-artikel jurnalistik dari Desa Olobaru
                </p>
            </div>
            
            <!-- Search bar form -->
            <form action="{{ route('berita') }}" method="GET" class="w-full md:w-80 shrink-0">
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita..." class="w-full pl-9 pr-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700/50 dark:text-white rounded-xl text-sm focus:outline-none focus:bg-white dark:bg-[#1e293b] dark:focus:bg-slate-800 focus:ring-2 focus:ring-green-600 focus:border-transparent transition-all">
                </div>
            </form>
        </div>

        <!-- News Grid -->
        <div data-aos="fade-up" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($beritas as $berita)
            @php
                $gambarArr = is_array($berita->gambar) ? $berita->gambar : (is_string($berita->gambar) ? [$berita->gambar] : []);
                $firstGambar = !empty($gambarArr) ? $gambarArr[0] : null;
            @endphp
            <article onclick="openBeritaModal(this)" 
                     data-id="{{ $berita->id }}"
                     data-judul="{{ $berita->judul }}"
                     data-tanggal="{{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->translatedFormat('d F Y') }}"
                     data-views="{{ $berita->views ?? 0 }}"
                     data-gambar="{{ json_encode($gambarArr) }}"
                     data-konten="{{ $berita->konten }}"
                     data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 150 }}" 
                     class="group cursor-pointer flex flex-col bg-white dark:bg-[#1e293b] border border-slate-100 dark:border-slate-700/50 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg hover:ring-2 hover:ring-green-500/50 transition-all duration-300">
                <div class="aspect-[16/10] overflow-hidden bg-slate-100 dark:bg-slate-900 relative">
                    @if($firstGambar)
                        <img src="{{ asset('storage/' . $firstGambar) }}" 
                             alt="{{ $berita->judul }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300 dark:text-slate-200 dark:text-white">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    <span class="absolute top-4 left-4 bg-green-700 text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full">
                        Berita Desa
                    </span>
                </div>
                <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <time class="text-xs text-slate-600 dark:text-slate-300 font-medium flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->translatedFormat('d F Y') }}
                        </time>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-green-700 dark:text-green-300 dark:group-hover:text-green-400 transition-colors leading-snug">
                            {{ $berita->judul }}
                        </h3>
                        <p class="text-sm text-slate-500 dark:text-white line-clamp-3 leading-relaxed">
                            {{ $berita->konten }}
                        </p>
                    </div>
                    <span class="text-xs font-semibold text-green-700 dark:text-green-400 flex items-center gap-1 group-hover:gap-2 transition-all">
                        Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </div>
            </article>
            @empty
            <div class="col-span-full py-12 text-center text-slate-500 dark:text-white">
                <svg class="w-12 h-12 mx-auto text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                Belum ada berita yang dipublikasikan.
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="pt-8 flex justify-center">
            {{ $beritas->links() }}
        </div>

    </div>
</section>

<!-- Modal Detail Berita -->
<div id="beritaModal" class="fixed inset-0 z-[10000] hidden flex items-center justify-center p-4 sm:p-6 opacity-0 transition-opacity duration-300">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeBeritaModal()"></div>
    
    <!-- Modal Content -->
    <div id="beritaModalPanel" class="relative bg-white dark:bg-[#1e293b] rounded-2xl sm:rounded-3xl shadow-2xl w-full max-w-4xl max-h-[90vh] flex flex-col transform scale-95 transition-all duration-300 overflow-hidden">
        
        <!-- Close Button -->
        <button onclick="closeBeritaModal()" class="absolute top-4 right-4 z-10 p-2 bg-black/50 hover:bg-black/70 text-white rounded-full backdrop-blur-md transition-colors focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <div id="modalScrollArea" class="flex-1 overflow-y-auto custom-scrollbar">
            <div class="p-6 sm:p-10 lg:p-12 space-y-8 max-w-3xl mx-auto">
                <!-- Header Section -->
                <div class="space-y-4">
                    <span class="inline-block px-3 py-1 bg-yellow-400 text-yellow-900 text-xs font-bold uppercase tracking-widest rounded-sm">Berita</span>
                    <h2 id="modalJudul" class="text-3xl sm:text-4xl md:text-5xl font-bold font-serif text-slate-900 dark:text-white leading-tight"></h2>
                    
                    <!-- Meta Info -->
                    <div class="flex items-center justify-between mt-4 border-b border-slate-100 dark:border-slate-700/50 pb-6">
                        <div class="flex items-center gap-3 text-sm text-slate-500 dark:text-slate-400">
                            <div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center overflow-hidden">
                                <svg class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            </div>
                            <div>
                                <span class="font-medium text-slate-700 dark:text-slate-300">By Admin</span>
                                <span class="mx-1.5">—</span>
                                <time id="modalTanggal"></time>
                            </div>
                        </div>
                        <div class="text-sm font-medium text-slate-500 dark:text-slate-400 flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            <span id="modalViews">0</span> dilihat
                        </div>
                    </div>
                </div>

                <!-- Modal Image Header (Carousel) -->
                <div id="modalImageContainer" class="w-full relative hidden rounded-2xl overflow-hidden bg-slate-100 dark:bg-slate-900 shadow-sm">
                    <!-- Slider -->
                    <div id="modalGambarSlider" class="flex overflow-x-auto snap-x snap-mandatory" style="scrollbar-width: none; -ms-overflow-style: none;">
                        <style>#modalGambarSlider::-webkit-scrollbar { display: none; }</style>
                        <!-- Images injected via JS -->
                    </div>
                    
                    <!-- Navigation Arrows -->
                    <button id="btnPrevImage" onclick="scrollBeritaImage(-1)" class="absolute left-4 top-1/2 -translate-y-1/2 p-2 bg-black/50 hover:bg-black/70 text-white rounded-full backdrop-blur-md hidden focus:outline-none transition-all z-10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button id="btnNextImage" onclick="scrollBeritaImage(1)" class="absolute right-4 top-1/2 -translate-y-1/2 p-2 bg-black/50 hover:bg-black/70 text-white rounded-full backdrop-blur-md hidden focus:outline-none transition-all z-10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                    
                    <!-- Image Indicators -->
                    <div id="modalImageIndicators" class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-1.5 z-10">
                        <!-- Indicators injected via JS -->
                    </div>
                </div>
                
                <!-- Modal Body (Content) -->
                <div id="modalKonten" class="prose prose-slate dark:prose-invert prose-lg max-w-none text-slate-700 dark:text-slate-300 leading-relaxed whitespace-pre-wrap break-words overflow-wrap-anywhere font-sans">
                </div>

                <!-- Author Footer -->
                <div class="mt-12 pt-8 border-t border-slate-100 dark:border-slate-700 flex items-center gap-6">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center overflow-hidden flex-shrink-0">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-slate-400 mt-2" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-slate-900 dark:text-white">Admin</h4>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Pusat informasi dan dokumentasi kegiatan resmi Desa Olobaru.</p>
                    </div>
                </div>
                
                <!-- Share Section -->
                <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-700/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <h5 class="text-sm font-bold text-slate-700 dark:text-slate-300">Bagikan Berita:</h5>
                    <div class="flex items-center gap-2" id="shareButtonsContainer">
                        <!-- FB -->
                        <button onclick="shareNews('facebook')" style="background-color: #1877F2;" class="w-10 h-10 rounded-full text-white flex items-center justify-center transition-opacity hover:opacity-90 shadow-sm border border-transparent">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </button>
                        <!-- X (Twitter) -->
                        <button onclick="shareNews('twitter')" style="background-color: #000000;" class="w-10 h-10 rounded-full text-white flex items-center justify-center transition-opacity hover:opacity-90 shadow-sm border border-transparent">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </button>
                        <!-- Telegram -->
                        <button onclick="shareNews('telegram')" style="background-color: #229ED9;" class="w-10 h-10 rounded-full text-white flex items-center justify-center transition-opacity hover:opacity-90 shadow-sm border border-transparent">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.96-.64-.34-1 .22-1.58.15-.15 2.71-2.48 2.76-2.69a.2.2 0 00-.05-.18c-.06-.05-.14-.03-.21-.02-.09.02-1.49.95-4.22 2.79-.4.27-.76.41-1.08.4-.36-.01-1.04-.2-1.55-.37-.63-.2-1.12-.31-1.08-.66.02-.18.27-.36.74-.55 2.92-1.27 4.86-2.11 5.83-2.51 2.78-1.16 3.35-1.36 3.73-1.36.08 0 .27.02.39.12.1.08.13.19.14.27-.01.06.01.24 0 .24z"/></svg>
                        </button>
                        <!-- Instagram (Copy Link) -->
                        <button onclick="shareNews('instagram')" style="background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);" class="w-10 h-10 rounded-full text-white flex items-center justify-center transition-opacity hover:opacity-90 shadow-sm border border-transparent" title="Salin Link">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </button>
                    </div>
                </div>
                
                <!-- Navigation Berita -->
                <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
                    <button id="btnPrevBerita" onclick="navigateBerita(-1)" class="flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-green-600 dark:text-slate-400 dark:hover:text-green-400 transition-colors focus:outline-none hidden">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                        Berita Sebelumnya
                    </button>
                    <button id="btnNextBerita" onclick="navigateBerita(1)" class="flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-green-600 dark:text-slate-400 dark:hover:text-green-400 transition-colors ml-auto focus:outline-none hidden">
                        Berita Selanjutnya
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    const STORAGE_URL = "{{ asset('storage/') }}/";
    let beritaCarouselInterval;
    
    function autoSlideBerita() {
        const slider = document.getElementById('modalGambarSlider');
        if (!slider) return;
        const slideWidth = slider.clientWidth;
        
        slider.scrollBy({ left: slideWidth, behavior: 'smooth' });
        
        setTimeout(() => {
            if (slider.scrollLeft >= slider.scrollWidth - slideWidth - 5) {
                // Disable snapping to avoid visual jerks during the instant jump
                slider.style.scrollSnapType = 'none';
                slider.scrollTo({ left: 0, behavior: 'auto' });
                
                // Re-enable snapping smoothly
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => {
                        slider.style.scrollSnapType = 'x mandatory';
                    });
                });
            }
        }, 800); // Increased timeout to ensure smooth scroll finishes before jumping
    }

    let currentBeritaElement = null;

    function openBeritaModal(element) {
        currentBeritaElement = element;
        const modal = document.getElementById('beritaModal');
        const modalPanel = document.getElementById('beritaModalPanel');
        
        // Populate Data
        document.getElementById('modalJudul').textContent = element.getAttribute('data-judul');
        document.getElementById('modalTanggal').textContent = element.getAttribute('data-tanggal');
        document.getElementById('modalKonten').textContent = element.getAttribute('data-konten');
        document.getElementById('modalViews').textContent = element.getAttribute('data-views') || '0';
        
        const beritaId = element.getAttribute('data-id');
        
        // Fetch to increment views
        if (beritaId) {
            fetch(`{{ url('/berita') }}/${beritaId}/view`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    document.getElementById('modalViews').textContent = data.views;
                    element.setAttribute('data-views', data.views);
                }
            }).catch(e => console.error(e));
        }
        
        const gambarStr = element.getAttribute('data-gambar');
        const gambarArr = gambarStr ? JSON.parse(gambarStr) : [];
        const imgContainer = document.getElementById('modalImageContainer');
        const slider = document.getElementById('modalGambarSlider');
        const indicators = document.getElementById('modalImageIndicators');
        const btnPrev = document.getElementById('btnPrevImage');
        const btnNext = document.getElementById('btnNextImage');
        
        // Reset slider
        slider.innerHTML = '<style>#modalGambarSlider::-webkit-scrollbar { display: none; }</style>';
        indicators.innerHTML = '';
        slider.scrollLeft = 0;
        
        if (gambarArr && gambarArr.length > 0) {
            gambarArr.forEach((img, index) => {
                // Create slide
                const slide = document.createElement('div');
                slide.className = 'w-full flex-none snap-center h-48 sm:h-64 md:h-72 relative';
                
                const imgEl = document.createElement('img');
                imgEl.src = STORAGE_URL + img;
                imgEl.className = 'w-full h-full object-cover';
                
                const gradient = document.createElement('div');
                gradient.className = 'absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent pointer-events-none';
                
                slide.appendChild(imgEl);
                slide.appendChild(gradient);
                slider.appendChild(slide);
                
                // Create indicator
                if(gambarArr.length > 1) {
                    const dot = document.createElement('div');
                    dot.className = `w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full transition-all ${index === 0 ? 'bg-white w-3 sm:w-4' : 'bg-white/50'}`;
                    indicators.appendChild(dot);
                }
            });
            
            // Clone first slide for seamless infinite scroll
            if (gambarArr.length > 1) {
                const clone = slider.children[0].cloneNode(true);
                slider.appendChild(clone);
            }
            
            imgContainer.classList.remove('hidden');
            
            if (gambarArr.length > 1) {
                btnPrev.classList.remove('hidden');
                btnNext.classList.remove('hidden');
                
                slider.onscroll = () => {
                    const slideWidth = slider.clientWidth;
                    const scrollPosition = slider.scrollLeft;
                    let activeIndex = Math.round(scrollPosition / slideWidth);
                    
                    if (activeIndex >= gambarArr.length) {
                        activeIndex = 0;
                    }
                    
                    Array.from(indicators.children).forEach((dot, idx) => {
                        if(idx === activeIndex) {
                            dot.className = 'w-3 sm:w-4 h-1.5 sm:h-2 rounded-full transition-all bg-white';
                        } else {
                            dot.className = 'w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full transition-all bg-white/50';
                        }
                    });
                };

                // Start auto-scroll
                clearInterval(beritaCarouselInterval);
                beritaCarouselInterval = setInterval(autoSlideBerita, 3000);

            } else {
                btnPrev.classList.add('hidden');
                btnNext.classList.add('hidden');
                slider.onscroll = null;
                clearInterval(beritaCarouselInterval);
            }
        } else {
            imgContainer.classList.add('hidden');
        }
        
        // Setup Berita Navigation
        const allArticles = Array.from(document.querySelectorAll('article[data-judul]'));
        const currentIndex = allArticles.indexOf(element);
        
        const btnPrevBerita = document.getElementById('btnPrevBerita');
        const btnNextBerita = document.getElementById('btnNextBerita');
        
        if (currentIndex > 0) {
            btnPrevBerita.classList.remove('hidden');
        } else {
            btnPrevBerita.classList.add('hidden');
        }
        
        if (currentIndex !== -1 && currentIndex < allArticles.length - 1) {
            btnNextBerita.classList.remove('hidden');
        } else {
            btnNextBerita.classList.add('hidden');
        }
        
        // Show Modal
        modal.classList.remove('hidden');
        // Trigger reflow for animation
        void modal.offsetWidth;
        modal.classList.remove('opacity-0');
        modalPanel.classList.remove('scale-95');
        
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    function scrollBeritaImage(direction) {
        const slider = document.getElementById('modalGambarSlider');
        const slideWidth = slider.clientWidth;
        
        if (direction === 1) {
            slider.scrollBy({ left: slideWidth, behavior: 'smooth' });
            setTimeout(() => {
                if (slider.scrollLeft >= slider.scrollWidth - slideWidth - 5) {
                    slider.style.scrollSnapType = 'none';
                    slider.scrollTo({ left: 0, behavior: 'auto' });
                    requestAnimationFrame(() => {
                        requestAnimationFrame(() => {
                            slider.style.scrollSnapType = 'x mandatory';
                        });
                    });
                }
            }, 800);
        } else if (direction === -1) {
            if (slider.scrollLeft <= 5) {
                slider.style.scrollSnapType = 'none';
                slider.scrollTo({ left: slider.scrollWidth - slideWidth, behavior: 'auto' });
                
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => {
                        slider.style.scrollSnapType = 'x mandatory';
                        slider.scrollBy({ left: -slideWidth, behavior: 'smooth' });
                    });
                });
            } else {
                slider.scrollBy({ left: -slideWidth, behavior: 'smooth' });
            }
        }

        // Reset interval on manual click
        clearInterval(beritaCarouselInterval);
        beritaCarouselInterval = setInterval(autoSlideBerita, 3000);
    }

    function navigateBerita(direction) {
        if (!currentBeritaElement) return;
        const allArticles = Array.from(document.querySelectorAll('article[data-judul]'));
        const currentIndex = allArticles.indexOf(currentBeritaElement);
        const nextIndex = currentIndex + direction;
        
        if (nextIndex >= 0 && nextIndex < allArticles.length) {
            const modalPanel = document.getElementById('beritaModalPanel');
            const scrollArea = document.getElementById('modalScrollArea');
            
            // Animasi keluar (seluruh modal panel)
            modalPanel.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            modalPanel.style.opacity = '0';
            modalPanel.style.transform = direction > 0 ? 'translateX(-50px) scale(0.95)' : 'translateX(50px) scale(0.95)';
            
            setTimeout(() => {
                scrollArea.scrollTop = 0;
                openBeritaModal(allArticles[nextIndex]);
                
                // Siapkan posisi awal animasi masuk
                modalPanel.style.transition = 'none';
                modalPanel.style.transform = direction > 0 ? 'translateX(50px) scale(0.95)' : 'translateX(-50px) scale(0.95)';
                
                // Trigger reflow
                void modalPanel.offsetWidth;
                
                // Animasi masuk
                modalPanel.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                modalPanel.style.opacity = '1';
                modalPanel.style.transform = 'translateX(0) scale(1)';
                
                // Bersihkan style inline setelah animasi selesai
                setTimeout(() => {
                    modalPanel.style.transition = '';
                    modalPanel.style.transform = '';
                    modalPanel.style.opacity = '';
                }, 300);
            }, 300);
        }
    }

    function closeBeritaModal() {
        const modal = document.getElementById('beritaModal');
        const modalPanel = document.getElementById('beritaModalPanel');
        
        modal.classList.add('opacity-0');
        modalPanel.classList.add('scale-95');
        
        clearInterval(beritaCarouselInterval);

        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
            
            // Kembalikan gaya seandainya terhenti di tengah animasi
            const scrollArea = document.getElementById('modalScrollArea');
            if (scrollArea && scrollArea.firstElementChild) {
                const contentDiv = scrollArea.firstElementChild;
                contentDiv.style.transition = 'none';
                contentDiv.style.opacity = '1';
                contentDiv.style.transform = 'translateX(0)';
            }
        }, 300);
    }

    function shareNews(platform) {
        if (!currentBeritaElement) return;
        const judul = currentBeritaElement.getAttribute('data-judul');
        // We use the current window location (which is /berita)
        // Since there is no individual page, we share the main berita page.
        const url = window.location.href; 
        
        let shareUrl = '';
        if (platform === 'facebook') {
            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
        } else if (platform === 'twitter') {
            shareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(judul)}`;
        } else if (platform === 'telegram') {
            shareUrl = `https://t.me/share/url?url=${encodeURIComponent(url)}&text=${encodeURIComponent(judul)}`;
        } else if (platform === 'instagram') {
            // Instagram doesn't have a direct share link to post. Fallback to copy link.
            navigator.clipboard.writeText(url).then(() => {
                alert('Tautan disalin ke clipboard! Anda bisa membagikannya di Instagram.');
            }).catch(() => {
                alert('Gagal menyalin tautan.');
            });
            return;
        }
        
        if (shareUrl) {
            window.open(shareUrl, '_blank', 'width=600,height=400,scrollbars=yes');
        }
    }
</script>
@endsection
@endsection
