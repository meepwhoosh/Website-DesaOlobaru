@extends('layouts.app')

@section('title', 'Potensi Desa - Website Resmi Desa Olobaru')

@section('content')
<!-- Small Header Banner -->
<section class="relative py-16 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1500485035595-cbe6f645feb1?q=80&w=1200&auto=format&fit=crop" 
             alt="Potensi Desa Olobaru" 
             class="w-full h-full object-cover object-center opacity-30" />
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-slate-900/80"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <span class="text-xs font-bold text-green-400 uppercase tracking-widest block mb-2">Potensi Desa</span>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold tracking-tight">Wisata & Produk UMKM Desa Olobaru</h1>
    </div>
</section>

<!-- Content Body -->
<section class="py-16 bg-slate-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        
        <!-- Wisata Section -->
        <div>
            <div class="max-w-3xl text-left space-y-4 mb-8">
                <span class="text-xs font-bold text-green-700 uppercase tracking-widest block">Jelajahi Keindahan</span>
                <h2 class="text-3xl font-bold font-serif text-slate-950">Destinasi & Daya Tarik Wisata</h2>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Desa Olobaru menyimpan kekayaan alam yang asri, kebudayaan lokal yang lestari, serta potensi komoditas unggulan yang menarik dikunjungi. Mari temukan kearifan lokal kami.
                </p>
            </div>

            <!-- Places Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($wisatas as $wisata)
                <div class="group bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="aspect-square bg-slate-100 relative overflow-hidden">
                        @if($wisata->gambar)
                            <img src="{{ asset('storage/' . $wisata->gambar) }}" 
                                 alt="{{ $wisata->nama_tempat }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-300">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        <span class="absolute bottom-3 left-3 bg-green-900/90 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider backdrop-blur-sm">
                            {{ $wisata->kategori }}
                        </span>
                    </div>
                    <div class="p-5 space-y-3">
                        <h3 class="font-bold text-slate-900 text-lg group-hover:text-green-700 transition-colors">{{ $wisata->nama_tempat }}</h3>
                        <p class="text-xs text-slate-500 leading-relaxed line-clamp-3">
                            {{ $wisata->deskripsi ?? 'Belum ada deskripsi yang ditambahkan untuk tempat wisata ini.' }}
                        </p>
                        <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400 mt-4">
                            <span class="font-semibold text-green-700">{{ $wisata->lokasi ?? '-' }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-10 flex flex-col items-center justify-center text-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-700">Belum Ada Pariwisata</h3>
                    <p class="text-slate-500 mt-2 max-w-sm">Daftar potensi wisata desa belum tersedia saat ini. Silakan kunjungi kembali nanti.</p>
                </div>
                @endforelse
            </div>
        </div>
        
        <!-- UMKM Section -->
        <div class="pt-10 border-t border-slate-200">
            <div class="max-w-3xl text-left space-y-4 mb-8">
                <span class="text-xs font-bold text-orange-600 uppercase tracking-widest block">Pasar Lokal</span>
                <h2 class="text-3xl font-bold font-serif text-slate-950">Dukung Produk UMKM Warga</h2>
                <p class="text-sm text-slate-650 leading-relaxed">
                    Temukan aneka olahan kuliner khas, kerajinan tangan kreatif, serta hasil bumi segar langsung dari para pelaku usaha mikro desa kami. Transaksi aman via kontak WhatsApp pedagang.
                </p>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($umkms as $umkm)
                <div class="group bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="aspect-square bg-slate-100 overflow-hidden relative">
                            @if($umkm->gambar)
                                <img src="{{ asset('storage/' . $umkm->gambar) }}" 
                                     alt="{{ $umkm->nama_produk }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-300">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <span class="absolute top-3 left-3 bg-amber-600 text-white text-[9px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">
                                {{ $umkm->kategori }}
                            </span>
                        </div>
                        <div class="p-5 space-y-2">
                            <span class="text-[10px] text-slate-400 font-bold uppercase block">{{ $umkm->nama_penjual }}</span>
                            <h3 class="font-bold text-slate-900 text-base group-hover:text-green-700 transition-colors">{{ $umkm->nama_produk }}</h3>
                            <p class="text-xs text-slate-500 leading-relaxed line-clamp-2">
                                {{ $umkm->deskripsi ?? 'Belum ada deskripsi produk.' }}
                            </p>
                        </div>
                    </div>
                    <div class="p-5 pt-0 space-y-3">
                        <div class="flex items-end justify-between border-t border-slate-100 pt-3">
                            <span class="text-xs text-slate-400">Harga</span>
                            <span class="text-base font-extrabold text-green-950 font-serif">Rp {{ number_format($umkm->harga, 0, ',', '.') }} <span class="text-[10px] font-sans font-normal text-slate-450">{{ $umkm->unit }}</span></span>
                        </div>
                        @if($umkm->no_whatsapp)
                            @php
                                $wa = preg_replace('/^0/', '62', $umkm->no_whatsapp);
                                $wa = preg_replace('/\D/', '', $wa);
                                $text = urlencode("Halo {$umkm->nama_penjual}, saya tertarik membeli {$umkm->nama_produk} dari website Desa.");
                            @endphp
                            <a href="https://wa.me/{{ $wa }}?text={{ $text }}" 
                               target="_blank" 
                               class="w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center justify-center gap-1.5 shadow-sm transition-colors">
                                <svg class="h-4.5 w-4.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm5.835-3.266c1.625.966 3.202 1.48 4.887 1.48 5.489 0 9.957-4.477 9.96-9.97 0-2.66-1.034-5.161-2.91-7.04C15.955 3.325 13.46 2.29 10.8 2.29c-5.492 0-9.962 4.478-9.966 9.971-.001 1.813.488 3.584 1.419 5.17l-.992 3.626 3.731-.979z"/></svg>
                                Hubungi Penjual
                            </a>
                        @else
                            <button disabled class="w-full py-2.5 rounded-xl bg-slate-100 text-slate-400 font-bold text-xs flex items-center justify-center gap-1.5 cursor-not-allowed">
                                Belum Ada Kontak
                            </button>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-full py-10 flex flex-col items-center justify-center text-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-700">Belum Ada Produk</h3>
                    <p class="text-slate-500 mt-2 max-w-sm">Daftar UMKM dan produk warga desa belum tersedia saat ini. Silakan kunjungi kembali nanti.</p>
                </div>
                @endforelse
            </div>
        </div>

    </div>
</section>
@endsection
