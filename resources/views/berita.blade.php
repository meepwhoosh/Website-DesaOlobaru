@extends('layouts.app')

@section('title', 'Kabar Desa & Berita - Website Resmi Desa Olobaru')

@section('content')
<!-- Small Header Banner -->
<section class="relative py-16 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=1200&auto=format&fit=crop" 
             alt="Pers Desa Olobaru" 
             class="w-full h-full object-cover object-center opacity-30" />
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-slate-900/80"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <span class="text-xs font-bold text-green-400 uppercase tracking-widest block mb-2">Pusat Kabar</span>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold tracking-tight">Berita & Kegiatan Desa</h1>
    </div>
</section>

<!-- Content Body -->
<section class="py-16 bg-slate-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        <!-- Search and Category Filters -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white border border-slate-100 p-6 rounded-2xl shadow-sm">
            <!-- Text Description replacing Categories -->
            <div class="flex-grow">
                <h2 class="text-2xl font-bold font-serif text-slate-700">Berita Desa</h2>
                <p class="text-sm text-slate-900 mt-1">
                    Menyajikan informasi terbaru tentang peristiwa, berita terkini, dan artikel-artikel jurnalistik dari Desa Olobaru
                </p>
            </div>
            
            <!-- Search bar form -->
            <form action="{{ route('berita') }}" method="GET" class="w-full md:w-80 shrink-0">
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita..." class="w-full pl-9 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-green-600 focus:border-transparent transition-all">
                </div>
            </form>
        </div>

        <!-- News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($beritas as $berita)
            <article class="group flex flex-col bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                <div class="aspect-[16/10] overflow-hidden bg-slate-100 relative">
                    @if($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" 
                             alt="{{ $berita->judul }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    <span class="absolute top-4 left-4 bg-green-700 text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full">
                        Berita Desa
                    </span>
                </div>
                <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <time class="text-xs text-slate-400 font-medium flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->translatedFormat('d F Y') }}
                        </time>
                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-green-700 transition-colors leading-snug">
                            {{ $berita->judul }}
                        </h3>
                        <p class="text-sm text-slate-500 line-clamp-3 leading-relaxed">
                            {{ $berita->konten }}
                        </p>
                    </div>
                    <span class="text-xs font-semibold text-green-700 flex items-center gap-1 group-hover:gap-2 transition-all">
                        Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </div>
            </article>
            @empty
            <div class="col-span-full py-12 text-center text-slate-500">
                <svg class="w-12 h-12 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
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
@endsection
