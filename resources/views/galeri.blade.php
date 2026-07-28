@extends('layouts.app')

@section('title', 'Galeri - Website Resmi Desa Olobaru')

@section('content')
<!-- Small Header Banner -->
<section data-aos="fade-in" class="relative py-16 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/bg-galeri.jpg') }}" 
             alt="Galeri Desa Olobaru" 
             class="w-full h-full object-cover object-center opacity-40" />
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-slate-900/70"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <span class="text-xs font-bold text-green-400 uppercase tracking-widest block mb-2">Dokumentasi Visual</span>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold tracking-tight">Galeri Desa Olobaru</h1>
    </div>
</section>

<!-- Content Body -->
<section data-aos="fade-in" class="py-16 bg-slate-50/50 dark:bg-slate-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <!-- Intro -->
        <div class="max-w-3xl mx-auto text-center space-y-4">
            <h2 class="text-3xl font-bold font-serif text-slate-950 dark:text-white">Momen & Keindahan Desa</h2>
            <p class="text-sm text-slate-600 dark:text-white leading-relaxed">
                Kumpulan dokumentasi kegiatan masyarakat, keindahan alam, serta berbagai momen penting di Desa Olobaru.
            </p>
        </div>

        <!-- Gallery Grid -->
        <div data-aos="fade-up" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($galeris as $index => $galeri)
            @php
                $gambarArr = is_array($galeri->gambar) ? $galeri->gambar : (is_string($galeri->gambar) ? [$galeri->gambar] : []);
                $firstGambar = !empty($gambarArr) ? $gambarArr[0] : null;
            @endphp
            <div class="group flex flex-col rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 dark:border-slate-700/50 bg-white dark:bg-[#1e293b] cursor-pointer" 
                 onclick="openGaleriModal({{ $index }})">
                <!-- Foto -->
                <div class="aspect-square w-full relative overflow-hidden bg-slate-100 dark:bg-slate-900">
                    @if($firstGambar)
                        <img src="{{ asset('storage/' . $firstGambar) }}" 
                             alt="{{ $galeri->judul }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out" />
                        @if(count($gambarArr) > 1)
                            <div class="absolute top-2 right-2 bg-black/60 text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm backdrop-blur-sm flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                +{{ count($gambarArr) - 1 }}
                            </div>
                        @endif
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300 dark:text-slate-200 dark:text-white">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                </div>
                
                <!-- Keterangan / Deskripsi -->
                <div class="p-5 flex-1 flex flex-col">
                    <span class="text-[10px] font-semibold text-green-600 dark:text-green-400 uppercase tracking-widest mb-2 block">
                        {{ \Carbon\Carbon::parse($galeri->created_at)->translatedFormat('d F Y') }}
                    </span>
                    <h3 class="text-slate-900 dark:text-white font-bold text-lg leading-snug">{{ $galeri->judul }}</h3>
                    @if($galeri->deskripsi)
                        <p class="text-slate-600 dark:text-white text-sm mt-2 line-clamp-3 leading-relaxed">{{ $galeri->deskripsi }}</p>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-full py-16 flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 bg-slate-50 dark:bg-[#1e293b] rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-slate-300 dark:text-slate-200 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-700 dark:text-white">Belum Ada Foto</h3>
                <p class="text-slate-500 dark:text-white mt-2 max-w-sm">Galeri dokumentasi desa belum tersedia saat ini. Silakan kunjungi kembali nanti.</p>
            </div>
            @endforelse
        </div>

    </div>
</section>

<!-- Modal Detail Galeri -->
<div id="lightbox" class="fixed inset-0 z-[10000] hidden flex items-center justify-center p-4 sm:p-6 opacity-0 transition-opacity duration-300">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeLightbox()"></div>
    
    <!-- Modal Content -->
    <div id="lightbox-content" class="relative bg-white dark:bg-[#1e293b] rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] flex flex-col transform scale-95 transition-all duration-300 overflow-hidden">
        
        <!-- Close Button -->
        <button onclick="closeLightbox()" class="absolute top-4 right-4 z-20 p-2 bg-black/40 hover:bg-black/60 text-white rounded-full backdrop-blur-md transition-colors focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <div id="modalScrollArea" class="flex-1 overflow-y-auto custom-scrollbar">
            <!-- Modal Image Header (Carousel) -->
            <div id="modalImageContainer" class="w-full relative hidden bg-slate-100 dark:bg-slate-900">
                <!-- Slider -->
                <div id="modalGambarSlider" class="flex overflow-x-auto snap-x snap-mandatory" style="scrollbar-width: none; -ms-overflow-style: none;">
                    <style>#modalGambarSlider::-webkit-scrollbar { display: none; }</style>
                    <!-- Images injected via JS -->
                </div>
                
                <!-- Navigation Arrows -->
                <button id="btnPrevImage" onclick="scrollGaleriImage(-1)" class="absolute left-4 top-1/2 -translate-y-1/2 p-2 bg-black/40 hover:bg-black/60 text-white rounded-full backdrop-blur-md hidden focus:outline-none transition-all z-10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button id="btnNextImage" onclick="scrollGaleriImage(1)" class="absolute right-4 top-1/2 -translate-y-1/2 p-2 bg-black/40 hover:bg-black/60 text-white rounded-full backdrop-blur-md hidden focus:outline-none transition-all z-10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                </button>
                
                <!-- Image Indicators -->
                <div id="modalImageIndicators" class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-1.5 z-10">
                    <!-- Indicators injected via JS -->
                </div>
            </div>

            <div class="p-6 sm:p-8 lg:p-10 space-y-4">
                <!-- Header Section (Title inside content) -->
                <div class="space-y-2">
                    <p id="lightbox-date" class="text-sm font-semibold text-green-600 dark:text-green-400 uppercase tracking-widest"></p>
                    <h2 id="lightbox-title" class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white leading-snug"></h2>
                </div>
                
                <!-- Modal Body (Content) -->
                <div id="lightbox-desc" class="prose prose-slate dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-relaxed whitespace-pre-wrap break-words overflow-wrap-anywhere">
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    const STORAGE_URL = "{{ asset('storage/') }}/";
    const galleryItems = [
        @foreach($galeris as $g)
            {
                images: {!! json_encode(is_array($g->gambar) ? $g->gambar : (is_string($g->gambar) ? [$g->gambar] : [])) !!},
                title: @json($g->judul),
                desc: @json($g->deskripsi),
                date: "{{ \Carbon\Carbon::parse($g->created_at)->translatedFormat('d F Y') }}"
            },
        @endforeach
    ];

    let currentIndex = 0;
    let galeriCarouselInterval;
    
    function autoSlideGaleri() {
        const slider = document.getElementById('modalGambarSlider');
        if (!slider) return;
        const slideWidth = slider.clientWidth;
        
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
    }

    function openGaleriModal(index) {
        currentIndex = index;
        
        const item = galleryItems[currentIndex];
        const modal = document.getElementById('lightbox');
        const modalContent = document.getElementById('lightbox-content');
        
        // Populate Data
        document.getElementById('lightbox-title').textContent = item.title;
        document.getElementById('lightbox-date').textContent = item.date;
        
        const desc = document.getElementById('lightbox-desc');
        if(item.desc) {
            desc.textContent = item.desc;
            desc.classList.remove('hidden');
        } else {
            desc.classList.add('hidden');
        }
        
        const gambarArr = item.images;
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
            gambarArr.forEach((img, idx) => {
                const slide = document.createElement('div');
                slide.className = 'w-full flex-none snap-center h-64 sm:h-72 md:h-96 lg:h-[400px] relative';
                
                const imgEl = document.createElement('img');
                imgEl.src = STORAGE_URL + img;
                imgEl.className = 'w-full h-full object-cover';
                
                slide.appendChild(imgEl);
                slider.appendChild(slide);
                
                if(gambarArr.length > 1) {
                    const dot = document.createElement('div');
                    dot.className = `w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full transition-all ${idx === 0 ? 'bg-green-600 w-3 sm:w-4' : 'bg-green-600/30'}`;
                    indicators.appendChild(dot);
                }
            });
            
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
                            dot.className = 'w-3 sm:w-4 h-1.5 sm:h-2 rounded-full transition-all bg-green-600';
                        } else {
                            dot.className = 'w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full transition-all bg-green-600/30';
                        }
                    });
                };

                clearInterval(galeriCarouselInterval);
                galeriCarouselInterval = setInterval(autoSlideGaleri, 3000);
            } else {
                btnPrev.classList.add('hidden');
                btnNext.classList.add('hidden');
                slider.onscroll = null;
                clearInterval(galeriCarouselInterval);
            }
        } else {
            imgContainer.classList.add('hidden');
            clearInterval(galeriCarouselInterval);
        }
        
        // Show Modal
        modal.classList.remove('hidden');
        void modal.offsetWidth;
        modal.classList.remove('opacity-0');
        modalContent.classList.remove('scale-95');
        
        document.body.style.overflow = 'hidden';
    }

    function scrollGaleriImage(direction) {
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

        clearInterval(galeriCarouselInterval);
        galeriCarouselInterval = setInterval(autoSlideGaleri, 3000);
    }

    function navigateEntry(direction) {
        const nextIndex = currentIndex + direction;
        if (nextIndex >= 0 && nextIndex < galleryItems.length) {
            document.getElementById('modalScrollArea').scrollTop = 0;
            openGaleriModal(nextIndex);
        }
    }

    function closeLightbox() {
        const modal = document.getElementById('lightbox');
        const modalContent = document.getElementById('lightbox-content');
        
        modal.classList.add('opacity-0');
        modalContent.classList.add('scale-95');
        
        clearInterval(galeriCarouselInterval);

        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(event) {
        const modal = document.getElementById('lightbox');
        if (!modal.classList.contains('hidden') && !modal.classList.contains('opacity-0')) {
            if (event.key === 'Escape') closeLightbox();
            if (event.key === 'ArrowLeft') scrollGaleriImage(-1);
            if (event.key === 'ArrowRight') scrollGaleriImage(1);
        }
    });
</script>
@endsection
@endsection
