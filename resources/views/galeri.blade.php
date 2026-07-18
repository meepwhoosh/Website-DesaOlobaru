@extends('layouts.app')

@section('title', 'Galeri - Website Resmi Desa Olobaru')

@section('content')
<!-- Small Header Banner -->
<section class="relative py-16 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1500485035595-cbe6f645feb1?q=80&w=1200&auto=format&fit=crop" 
             alt="Galeri Desa Olobaru" 
             class="w-full h-full object-cover object-center opacity-30" />
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-slate-900/80"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <span class="text-xs font-bold text-green-400 uppercase tracking-widest block mb-2">Dokumentasi Visual</span>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold tracking-tight">Galeri Desa Olobaru</h1>
    </div>
</section>

<!-- Content Body -->
<section class="py-16 bg-slate-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <!-- Intro -->
        <div class="max-w-3xl mx-auto text-center space-y-4">
            <h2 class="text-3xl font-bold font-serif text-slate-950">Momen & Keindahan Desa</h2>
            <p class="text-sm text-slate-600 leading-relaxed">
                Kumpulan dokumentasi kegiatan masyarakat, keindahan alam, serta berbagai momen penting di Desa Olobaru.
            </p>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($galeris as $index => $galeri)
            <div class="group flex flex-col rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 bg-white cursor-pointer" 
                 onclick="openGaleriModal({{ $index }})">
                <!-- Foto -->
                <div class="aspect-square w-full relative overflow-hidden bg-slate-100">
                    @if($galeri->gambar)
                        <img src="{{ asset('storage/' . $galeri->gambar) }}" 
                             alt="{{ $galeri->judul }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out" />
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                </div>
                
                <!-- Keterangan / Deskripsi -->
                <div class="p-5 flex-1 flex flex-col">
                    <span class="text-[10px] font-semibold text-green-600 uppercase tracking-widest mb-2 block">
                        {{ \Carbon\Carbon::parse($galeri->created_at)->translatedFormat('d F Y') }}
                    </span>
                    <h3 class="text-slate-900 font-bold text-lg leading-snug">{{ $galeri->judul }}</h3>
                    @if($galeri->deskripsi)
                        <p class="text-slate-600 text-sm mt-2 line-clamp-3 leading-relaxed">{{ $galeri->deskripsi }}</p>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-full py-16 flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-700">Belum Ada Foto</h3>
                <p class="text-slate-500 mt-2 max-w-sm">Galeri dokumentasi desa belum tersedia saat ini. Silakan kunjungi kembali nanti.</p>
            </div>
            @endforelse
        </div>

    </div>
</section>

<!-- Fullscreen Lightbox -->
<div id="lightbox" class="fixed inset-0 z-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300" aria-modal="true">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/90 backdrop-blur-sm" onclick="closeLightbox()"></div>

    <!-- Top Bar -->
    <div class="absolute top-0 left-0 right-0 p-4 flex justify-between items-center z-10">
        <div id="lightbox-counter" class="text-white/80 font-medium text-sm tracking-wide"></div>
        <button onclick="closeLightbox()" class="text-white/70 hover:text-white transition-colors p-2">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <!-- Navigation Arrows -->
    <button onclick="prevImage()" class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 text-white/50 hover:text-white transition-colors z-10 p-2">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
    </button>
    
    <button onclick="nextImage()" class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 text-white/50 hover:text-white transition-colors z-10 p-2">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
    </button>

    <!-- Main Content (Image & Caption) -->
    <div class="relative z-0 flex flex-col items-center justify-center w-full h-full p-4 md:p-12 transform scale-50 transition-transform duration-300 ease-out" id="lightbox-content">
        
        <div class="flex-1 w-full flex items-center justify-center min-h-0 relative">
            <img id="lightbox-img" src="" alt="" class="max-w-full max-h-full object-contain shadow-2xl">
            <div id="lightbox-no-img" class="hidden flex-col items-center justify-center text-slate-500">
                <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span>Tidak ada foto</span>
            </div>
        </div>

        <!-- Caption -->
        <div class="w-full text-center mt-6 flex-shrink-0 max-h-[20vh] overflow-y-auto scrollbar-thin px-4">
            <h3 id="lightbox-title" class="font-bold text-lg md:text-xl text-white tracking-wide"></h3>
            <p id="lightbox-desc" class="text-white/70 text-sm md:text-base mt-1 whitespace-pre-line max-w-3xl mx-auto"></p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const galleryItems = [
        @foreach($galeris as $g)
            {
                src: "{{ $g->gambar ? asset('storage/' . $g->gambar) : '' }}",
                title: @json($g->judul),
                desc: @json($g->deskripsi)
            },
        @endforeach
    ];

    let currentIndex = 0;

    function openGaleriModal(index) {
        currentIndex = index;
        updateLightboxContent();
        
        const modal = document.getElementById('lightbox');
        const modalContent = document.getElementById('lightbox-content');
        
        // Show Lightbox
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modalContent.classList.remove('scale-50');
        modalContent.classList.add('scale-100');
        
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const modal = document.getElementById('lightbox');
        const modalContent = document.getElementById('lightbox-content');
        
        // Hide Lightbox
        modal.classList.add('opacity-0', 'pointer-events-none');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-50');
        
        document.body.style.overflow = '';
    }

    function updateLightboxContent() {
        if(galleryItems.length === 0) return;
        
        const item = galleryItems[currentIndex];
        
        const img = document.getElementById('lightbox-img');
        const noImg = document.getElementById('lightbox-no-img');
        const title = document.getElementById('lightbox-title');
        const desc = document.getElementById('lightbox-desc');
        const counter = document.getElementById('lightbox-counter');

        // Update counter
        counter.textContent = `${currentIndex + 1} / ${galleryItems.length}`;
        
        // Update text
        title.textContent = item.title;
        if(item.desc) {
            desc.textContent = item.desc;
            desc.classList.remove('hidden');
        } else {
            desc.classList.add('hidden');
        }

        // Update image
        if(item.src) {
            img.src = item.src;
            img.classList.remove('hidden');
            noImg.classList.add('hidden');
        } else {
            img.classList.add('hidden');
            noImg.classList.remove('hidden');
            noImg.classList.add('flex');
        }
    }

    function prevImage() {
        if(galleryItems.length === 0) return;
        currentIndex = (currentIndex === 0) ? galleryItems.length - 1 : currentIndex - 1;
        updateLightboxContent();
    }

    function nextImage() {
        if(galleryItems.length === 0) return;
        currentIndex = (currentIndex === galleryItems.length - 1) ? 0 : currentIndex + 1;
        updateLightboxContent();
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(event) {
        const modal = document.getElementById('lightbox');
        // Only trigger if modal is open
        if (!modal.classList.contains('opacity-0')) {
            if (event.key === 'Escape') closeLightbox();
            if (event.key === 'ArrowLeft') prevImage();
            if (event.key === 'ArrowRight') nextImage();
        }
    });
</script>
@endpush
@endsection
