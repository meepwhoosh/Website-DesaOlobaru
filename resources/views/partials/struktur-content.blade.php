@php
    // Fungsi pembantu untuk mengambil data perangkat berdasarkan jabatan
    $getPerson = function($jabatan, $isBpd = false) use ($pemdes, $bpd) {
        $data = $isBpd ? $bpd : $pemdes;
        return $data->first(function($item) use ($jabatan) {
            return stripos($item->jabatan, $jabatan) !== false;
        });
    };
    
    // Data Pemdes
    $kades = $getPerson('Kepala Desa');
    $sekdes = $getPerson('Sekretaris') ?? $getPerson('Sekretariat');
    $kasiPem = $getPerson('Pemerintahan');
    $kasiKes = $getPerson('Kesejahteraan');
    $kasiPel = $getPerson('Pelayanan');
    $kaurTu = $getPerson('Tata Usaha');
    $kaurPerencanaan = $getPerson('Perencanaan');
    $kaurKeu = $getPerson('Keuangan');
    $kadus1 = $getPerson('Dusun 1') ?? $getPerson('Dusun I');
    $kadus2 = $getPerson('Dusun 2') ?? $getPerson('Dusun II');
    $kadus3 = $getPerson('Dusun 3') ?? $getPerson('Dusun III');

    // Data BPD
    $ketuaBpd = $getPerson('Ketua', true);
    $wakilBpd = $getPerson('Wakil', true);
    $sekBpd = $getPerson('Sekretaris', true);
    $anggotaBpd = $bpd->filter(function($item) {
        return stripos($item->jabatan, 'Anggota') !== false;
    })->values();

@endphp

<!-- Small Header Banner -->
<section data-aos="fade-in" class="relative py-16 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=1200&auto=format&fit=crop" 
             alt="Struktur Organisasi Desa Olobaru" 
             class="w-full h-full object-cover object-center opacity-30" />
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-slate-900/80"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <span class="text-xs font-bold text-green-400 uppercase tracking-widest block mb-2">Pemerintah Desa</span>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold tracking-tight">Susunan Organisasi &amp; Tata Kerja (SOTK)</h1>
    </div>
</section>

<!-- Content Body -->
<section data-aos="fade-in" class="py-16 bg-slate-50/50 dark:bg-slate-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-20">
        
        <!-- Section 1: Pengantar -->
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <h2 class="text-3xl font-bold font-serif text-slate-950 dark:text-white">Aparatur Struktur Organisasi Desa Olobaru</h2>
            <p class="text-sm text-slate-600 dark:text-slate-200 leading-relaxed">
                Struktur organisasi dan tata kerja pemerintahan Desa Olobaru, Kecamatan Parigi Selatan, Kabupaten Parigi Moutong, dirancang untuk melayani warga secara adil, transparan, dan terintegrasi.
            </p>
        </div>

        <!-- Section 2: Struktur Organisasi (Hierarchical Flowchart Layout) -->
        <div data-aos="fade-up" class="bg-white dark:bg-[#1e293b] border border-slate-100 dark:border-slate-700/50 rounded-3xl p-6 sm:p-10 shadow-sm space-y-10">
            <div class="text-center space-y-2">
                <span class="text-xs font-bold text-green-700 dark:text-green-400 uppercase tracking-widest block">STRUKTUR ORGANISASI</span>
                <h3 class="text-2xl font-bold font-serif text-slate-950 dark:text-white">Struktur Organisasi Pemerintah Desa Olobaru</h3>
                <p class="text-xs text-slate-550 dark:text-slate-200 max-w-xl mx-auto">Menampilkan susunan organisasi pemerintahan Desa Olobaru beserta pembagian tugas, wewenang, dan hubungan koordinasi antar perangkat desa.</p>
            </div>

            <!-- Flowchart Tree Grid -->
            <div class="overflow-x-auto pt-6 pb-4">
                <div class="min-w-[960px] flex flex-col items-center p-6 bg-slate-50/70 dark:bg-[#1e293b]/50 rounded-3xl border border-slate-100 dark:border-slate-700/50">
                    
                    <!-- 1. KEPALA DESA -->
                    <div class="flex flex-col items-center w-full relative">
                        <div class="px-6 py-3 bg-green-950 text-white rounded-xl shadow-md border-2 border-green-800 text-center w-64 z-10 relative">
                            <div class="flex justify-center mb-2">
                                <div class="w-16 h-16 rounded-full bg-green-900 border-2 border-green-700 flex items-center justify-center overflow-hidden">
                                    @if($kades && $kades->gambar)
                                        <img src="{{ asset('storage/' . $kades->gambar) }}" class="w-full h-full object-cover" alt="Foto Kades">
                                    @else
                                        <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                    @endif
                                </div>
                            </div>
                            <span class="block text-[10px] text-green-300 font-bold uppercase tracking-wider">Kepala Desa</span>
                            <span class="text-base font-bold">{{ $kades->nama ?? 'Belum Diisi' }}</span>
                        </div>
                        <div class="w-0.5 h-8 bg-green-800"></div>
                    </div>

                    <!-- 2. SPLIT ROW: KASIS (Left) and SEKDES/KAURS (Right) -->
                    <div class="flex w-full items-stretch relative pt-6">
                        <!-- Main Central Line from Kades to Kadus -->
                        <!-- It starts from top-0 (where the Kades drop line ended) and goes down to bottom-0 -->
                        <div class="absolute left-0 right-0 mx-auto top-0 bottom-0 w-0.5 bg-green-800 z-0"></div>
                        
                        <!-- Main Horizontal Crossbar (to Sekdes only) -->
                        <div class="absolute top-0 h-0.5 bg-green-800 z-0" style="left: 50%; right: calc(25% - 12px);"></div>
                        
                        <!-- Drop line to Sekdes (Right) -->
                        <div class="absolute top-0 translate-x-1/2 w-0.5 h-6 bg-green-800 z-0" style="right: calc(25% - 12px);"></div>

                        <!-- LEFT COLUMN: KASI (3 Seksi) -->
                        <div class="w-1/2 pr-6 flex flex-col items-center relative z-10">
                            <!-- Horizontal line for 3 KASI -->
                            <div class="w-full relative pt-6 mt-auto">
                                <!-- Line connecting center of Kasi to main central line -->
                                <div class="absolute top-0 h-0.5 bg-green-800 z-0" style="left: 50%; right: -1.5rem;"></div>

                                <!-- Line spanning the 3 Kasi -->
                                <div class="absolute top-0 h-0.5 bg-green-800 z-0" style="left: 16.666%; right: 16.666%;"></div>
                                <div class="absolute top-0 -translate-x-1/2 w-0.5 h-6 bg-green-800 z-0" style="left: 16.666%;"></div>
                                <div class="absolute top-0 left-0 right-0 mx-auto w-0.5 h-6 bg-green-800 z-0"></div>
                                <div class="absolute top-0 translate-x-1/2 w-0.5 h-6 bg-green-800 z-0" style="right: 16.666%;"></div>
                                
                                <div data-aos="fade-up" class="grid grid-cols-3 w-full gap-0">
                                    <!-- Kasi Pemerintahan -->
                                    <div class="px-1.5 w-full">
                                        <div class="px-1.5 py-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700/50 rounded-xl text-xs text-center shadow-sm w-full z-10 h-full flex flex-col">
                                            <div class="flex justify-center mb-1.5">
                                                <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-[#1e293b] border border-slate-200 dark:border-slate-700/50 flex items-center justify-center overflow-hidden">
                                                    @if($kasiPem && $kasiPem->gambar)
                                                        <img src="{{ asset('storage/' . $kasiPem->gambar) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <svg class="w-6 h-6 text-slate-300 dark:text-slate-200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                    @endif
                                                </div>
                                            </div>
                                            <span class="text-[8px] text-green-700 dark:text-green-300 font-bold uppercase block mb-1">Kepala Seksi Pemerintahan</span>
                                            <span class="font-bold text-slate-900 dark:text-white block leading-tight mt-auto">{{ $kasiPem->nama ?? '-' }}</span>
                                        </div>
                                    </div>

                                    <!-- Kasi Kesejahteraan -->
                                    <div class="px-1.5 w-full">
                                        <div class="px-1.5 py-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700/50 rounded-xl text-xs text-center shadow-sm w-full z-10 h-full flex flex-col">
                                            <div class="flex justify-center mb-1.5">
                                                <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-[#1e293b] border border-slate-200 dark:border-slate-700/50 flex items-center justify-center overflow-hidden">
                                                    @if($kasiKes && $kasiKes->gambar)
                                                        <img src="{{ asset('storage/' . $kasiKes->gambar) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <svg class="w-6 h-6 text-slate-300 dark:text-slate-200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                    @endif
                                                </div>
                                            </div>
                                            <span class="text-[8px] text-green-700 dark:text-green-300 font-bold uppercase block mb-1">Kepala Seksi Kesejahteraan</span>
                                            <span class="font-bold text-slate-900 dark:text-white block leading-tight mt-auto">{{ $kasiKes->nama ?? '-' }}</span>
                                        </div>
                                    </div>

                                    <!-- Kasi Pelayanan -->
                                    <div class="px-1.5 w-full">
                                        <div class="px-1.5 py-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700/50 rounded-xl text-xs text-center shadow-sm w-full z-10 h-full flex flex-col">
                                            <div class="flex justify-center mb-1.5">
                                                <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-[#1e293b] border border-slate-200 dark:border-slate-700/50 flex items-center justify-center overflow-hidden">
                                                    @if($kasiPel && $kasiPel->gambar)
                                                        <img src="{{ asset('storage/' . $kasiPel->gambar) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <svg class="w-6 h-6 text-slate-300 dark:text-slate-200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                    @endif
                                                </div>
                                            </div>
                                            <span class="text-[8px] text-green-700 dark:text-green-300 font-bold uppercase block mb-1">Kepala Seksi Pelayanan</span>
                                            <span class="font-bold text-slate-900 dark:text-white block leading-tight mt-auto">{{ $kasiPel->nama ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT COLUMN: SEKDES & KAURS -->
                        <div class="w-1/2 pl-6 flex flex-col items-center relative z-10">
                            <!-- Sekretaris Desa Card -->
                            <div class="px-6 py-2.5 bg-green-800 text-white rounded-xl shadow border border-green-750 text-center w-60 z-10 relative">
                                <div class="flex justify-center mb-1.5">
                                    <div class="w-14 h-14 rounded-full bg-green-700 border-2 border-green-600 flex items-center justify-center overflow-hidden">
                                        @if($sekdes && $sekdes->gambar)
                                            <img src="{{ asset('storage/' . $sekdes->gambar) }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-7 h-7 text-green-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                        @endif
                                    </div>
                                </div>
                                <span class="block text-[9px] text-green-300 font-bold uppercase tracking-wider">Sekretariat Desa</span>
                                <span class="font-bold text-sm">{{ $sekdes->nama ?? '-' }}</span>
                            </div>
                            
                            <!-- Line from Sekdes down to KAUR group -->
                            <div class="w-0.5 h-6 bg-green-800"></div>

                            <!-- Kaurs (3 Jabatan under Sekretariat) -->
                            <div class="w-full relative pt-6">
                                <div class="absolute top-0 h-0.5 bg-green-800 z-0" style="left: 16.666%; right: 16.666%;"></div>
                                <div class="absolute top-0 -translate-x-1/2 w-0.5 h-6 bg-green-800 z-0" style="left: 16.666%;"></div>
                                <div class="absolute top-0 left-0 right-0 mx-auto w-0.5 h-6 bg-green-800 z-0"></div>
                                <div class="absolute top-0 translate-x-1/2 w-0.5 h-6 bg-green-800 z-0" style="right: 16.666%;"></div>
                                
                                <div data-aos="fade-up" class="grid grid-cols-3 w-full gap-0">
                                    <!-- Kaur Tata Usaha & Umum -->
                                    <div class="px-1.5 w-full">
                                        <div class="px-1.5 py-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700/50 rounded-xl text-xs text-center shadow-sm w-full z-10 h-full flex flex-col">
                                            <div class="flex justify-center mb-1.5">
                                                <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-[#1e293b] border border-slate-200 dark:border-slate-700/50 flex items-center justify-center overflow-hidden">
                                                    @if($kaurTu && $kaurTu->gambar)
                                                        <img src="{{ asset('storage/' . $kaurTu->gambar) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <svg class="w-6 h-6 text-slate-300 dark:text-slate-200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                    @endif
                                                </div>
                                            </div>
                                            <span class="text-[8px] text-green-700 dark:text-green-300 font-bold uppercase block mb-1">Kepala Urusan Tata Usaha &amp; Umum</span>
                                            <span class="font-bold text-slate-900 dark:text-white block leading-tight mt-auto">{{ $kaurTu->nama ?? '-' }}</span>
                                        </div>
                                    </div>

                                    <!-- Kaur Perencanaan -->
                                    <div class="px-1.5 w-full">
                                        <div class="px-1.5 py-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700/50 rounded-xl text-xs text-center shadow-sm w-full z-10 h-full flex flex-col">
                                            <div class="flex justify-center mb-1.5">
                                                <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-[#1e293b] border border-slate-200 dark:border-slate-700/50 flex items-center justify-center overflow-hidden">
                                                    @if($kaurPerencanaan && $kaurPerencanaan->gambar)
                                                        <img src="{{ asset('storage/' . $kaurPerencanaan->gambar) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <svg class="w-6 h-6 text-slate-300 dark:text-slate-200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                    @endif
                                                </div>
                                            </div>
                                            <span class="text-[8px] text-green-700 dark:text-green-300 font-bold uppercase block mb-1">Kepala Urusan Perencanaan</span>
                                            <span class="font-bold text-slate-900 dark:text-white block leading-tight mt-auto">{{ $kaurPerencanaan->nama ?? '-' }}</span>
                                        </div>
                                    </div>

                                    <!-- Kaur Keuangan -->
                                    <div class="px-1.5 w-full">
                                        <div class="px-1.5 py-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700/50 rounded-xl text-xs text-center shadow-sm w-full z-10 h-full flex flex-col">
                                            <div class="flex justify-center mb-1.5">
                                                <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-[#1e293b] border border-slate-200 dark:border-slate-700/50 flex items-center justify-center overflow-hidden">
                                                    @if($kaurKeu && $kaurKeu->gambar)
                                                        <img src="{{ asset('storage/' . $kaurKeu->gambar) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <svg class="w-6 h-6 text-slate-300 dark:text-slate-200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                    @endif
                                                </div>
                                            </div>
                                            <span class="text-[8px] text-green-700 dark:text-green-300 font-bold uppercase block mb-1">Kepala Urusan Keuangan</span>
                                            <span class="font-bold text-slate-900 dark:text-white block leading-tight mt-auto">{{ $kaurKeu->nama ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. BOTTOM VERTICAL CONNECTOR LINE (FROM CENTER TO KADUSES) -->
                    <div class="w-0.5 h-8 bg-green-800"></div>

                    <!-- 4. KEPALA DUSUN ROW (KADUS) -->
                    <div class="w-full flex flex-col items-center relative z-10">
                        <div class="w-full relative pt-6">
                            <!-- Kadus Horizontal Line (spans from center of Col 1 to center of Col 3) -->
                            <div class="absolute top-0 h-0.5 bg-green-800 z-0" style="left: 16.666%; right: 16.666%;"></div>
                            
                            <!-- Drop lines for Kaduses -->
                            <div class="absolute top-0 -translate-x-1/2 w-0.5 h-6 bg-green-800 z-0" style="left: 16.666%;"></div>
                            <div class="absolute top-0 left-0 right-0 mx-auto w-0.5 h-6 bg-green-800 z-0"></div>
                            <div class="absolute top-0 translate-x-1/2 w-0.5 h-6 bg-green-800 z-0" style="right: 16.666%;"></div>
                            
                            <div data-aos="fade-up" class="grid grid-cols-3 w-full gap-0">
                                <!-- Kadus 1 -->
                                <div class="px-2 w-full">
                                    <div class="px-3 py-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700/50 rounded-xl text-xs text-center shadow-sm w-full z-10 h-full flex flex-col">
                                        <div class="flex justify-center mb-1.5">
                                            <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-[#1e293b] border border-slate-200 dark:border-slate-700/50 flex items-center justify-center overflow-hidden">
                                                @if($kadus1 && $kadus1->gambar)
                                                    <img src="{{ asset('storage/' . $kadus1->gambar) }}" class="w-full h-full object-cover">
                                                @else
                                                    <svg class="w-6 h-6 text-slate-300 dark:text-slate-200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                @endif
                                            </div>
                                        </div>
                                        <span class="text-[9px] text-amber-700 dark:text-amber-400 font-bold uppercase block mb-1">Kepala Dusun I</span>
                                        <span class="font-bold text-slate-900 dark:text-white block leading-tight mt-auto">{{ $kadus1->nama ?? '-' }}</span>
                                    </div>
                                </div>

                                <!-- Kadus 2 -->
                                <div class="px-2 w-full">
                                    <div class="px-3 py-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700/50 rounded-xl text-xs text-center shadow-sm w-full z-10 h-full flex flex-col">
                                        <div class="flex justify-center mb-1.5">
                                            <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-[#1e293b] border border-slate-200 dark:border-slate-700/50 flex items-center justify-center overflow-hidden">
                                                @if($kadus2 && $kadus2->gambar)
                                                    <img src="{{ asset('storage/' . $kadus2->gambar) }}" class="w-full h-full object-cover">
                                                @else
                                                    <svg class="w-6 h-6 text-slate-300 dark:text-slate-200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                @endif
                                            </div>
                                        </div>
                                        <span class="text-[9px] text-amber-700 dark:text-amber-400 font-bold uppercase block mb-1">Kepala Dusun II</span>
                                        <span class="font-bold text-slate-900 dark:text-white block leading-tight mt-auto">{{ $kadus2->nama ?? '-' }}</span>
                                    </div>
                                </div>

                                <!-- Kadus 3 -->
                                <div class="px-2 w-full">
                                    <div class="px-3 py-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700/50 rounded-xl text-xs text-center shadow-sm w-full z-10 h-full flex flex-col">
                                        <div class="flex justify-center mb-1.5">
                                            <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-[#1e293b] border border-slate-200 dark:border-slate-700/50 flex items-center justify-center overflow-hidden">
                                                @if($kadus3 && $kadus3->gambar)
                                                    <img src="{{ asset('storage/' . $kadus3->gambar) }}" class="w-full h-full object-cover">
                                                @else
                                                    <svg class="w-6 h-6 text-slate-300 dark:text-slate-200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                @endif
                                            </div>
                                        </div>
                                        <span class="text-[9px] text-amber-700 dark:text-amber-400 font-bold uppercase block mb-1">Kepala Dusun III</span>
                                        <span class="font-bold text-slate-900 dark:text-white block leading-tight mt-auto">{{ $kadus3->nama ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Section 3: Profile Cards Grid (Dynamic Loop) -->
        <div class="space-y-8">
            <div class="text-center space-y-2">
                <h3 class="text-2xl font-bold font-serif text-slate-950 dark:text-white">Profil Aparatur Desa</h3>
                <p class="text-sm text-slate-650 dark:text-slate-200 max-w-lg mx-auto">Daftar kontak dan informasi singkat mengenai masing-masing perangkat desa Olobaru.</p>
            </div>

            <div data-aos="fade-up" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($pemdes as $p)
                <div data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}" class="bg-white dark:bg-[#1e293b] rounded-2xl border border-slate-100 dark:border-slate-700/50 p-5 shadow-sm text-center space-y-4 group hover:shadow-md transition-shadow">
                    <div class="w-24 h-24 mx-auto rounded-full bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-700/50 overflow-hidden">
                        @if($p->gambar)
                            <img src="{{ asset('storage/' . $p->gambar) }}" class="w-full h-full object-cover" alt="{{ $p->nama }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-400 dark:text-slate-200 dark:text-slate-200">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <span class="text-[10px] text-green-700 dark:text-green-300 font-bold uppercase tracking-wider block">{{ $p->jabatan }}</span>
                        <h4 class="font-bold text-slate-900 dark:text-white text-base mt-0.5">{{ $p->nama }}</h4>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-12 text-center text-slate-500 dark:text-white">
                    Belum ada data aparatur desa.
                </div>
                @endforelse
            </div>
        </div>

    </div>
</section>

<!-- BPD Section -->
<section data-aos="fade-in" class="py-16 bg-slate-50/50 dark:bg-slate-900/50 border-t border-slate-200 dark:border-slate-700/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-20">
        
        <!-- BPD Flowchart -->
        <div data-aos="fade-up" class="bg-white dark:bg-[#1e293b] border border-slate-100 dark:border-slate-700/50 rounded-3xl p-6 sm:p-10 shadow-sm space-y-10">
            <div class="text-center space-y-2">
                <span class="text-xs font-bold text-green-700 dark:text-green-400 uppercase tracking-widest block">STRUKTUR ORGANISASI</span>
                <h3 class="text-2xl font-bold font-serif text-slate-950 dark:text-white">Badan Permusyawaratan Desa (BPD)</h3>
                <p class="text-xs text-slate-550 dark:text-slate-200 max-w-xl mx-auto">Menampilkan susunan organisasi BPD Desa Olobaru beserta pembagian tugas, wewenang, dan hubungan koordinasi.</p>
            </div>

            <!-- Flowchart Tree Grid for BPD -->
            <div class="overflow-x-auto pt-6 pb-4">
                <div class="min-w-[960px] flex flex-col items-center p-6 bg-slate-50/70 dark:bg-[#1e293b]/50 rounded-3xl border border-slate-100 dark:border-slate-700/50">
                    
                    <!-- 1. KETUA BPD -->
                    <div class="flex flex-col items-center w-full relative z-10">
                        <div class="px-6 py-3 bg-green-950 text-white rounded-xl shadow-md border-2 border-green-800 text-center w-64 z-10 relative">
                            <div class="flex justify-center mb-2">
                                <div class="w-16 h-16 rounded-full bg-green-900 border-2 border-green-700 flex items-center justify-center overflow-hidden">
                                    @if($ketuaBpd && $ketuaBpd->gambar)
                                        <img src="{{ asset('storage/' . $ketuaBpd->gambar) }}" class="w-full h-full object-cover" alt="Foto Ketua BPD">
                                    @else
                                        <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                    @endif
                                </div>
                            </div>
                            <span class="block text-[10px] text-green-300 font-bold uppercase tracking-wider">Ketua BPD</span>
                            <span class="text-base font-bold">{{ $ketuaBpd->nama ?? '-' }}</span>
                        </div>
                        <div class="w-0.5 h-8 bg-green-800"></div>
                    </div>

                    <!-- 2. WAKIL & SEKRETARIS (Split 50/50) -->
                    <div class="w-full relative flex z-10">
                        <!-- Horizontal Crossbar -->
                        <div class="absolute top-0 h-0.5 bg-green-800 z-0" style="left: 25%; right: 25%;"></div>
                        
                        <!-- Drop line to WAKIL -->
                        <div class="absolute top-0 -translate-x-1/2 w-0.5 h-6 bg-green-800 z-0" style="left: 25%;"></div>
                        
                        <!-- Drop line to SEKRETARIS -->
                        <div class="absolute top-0 -translate-x-1/2 w-0.5 h-6 bg-green-800 z-0" style="left: 75%;"></div>

                        <!-- WAKIL KETUA BPD (Left) -->
                        <div class="w-1/2 flex flex-col items-center pt-6">
                            <div class="px-6 py-2.5 bg-green-800 text-white rounded-xl shadow border border-green-750 text-center w-60 z-10 relative">
                                <div class="flex justify-center mb-1.5">
                                    <div class="w-14 h-14 rounded-full bg-green-700 border-2 border-green-600 flex items-center justify-center overflow-hidden">
                                        @if($wakilBpd && $wakilBpd->gambar)
                                            <img src="{{ asset('storage/' . $wakilBpd->gambar) }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-7 h-7 text-green-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                        @endif
                                    </div>
                                </div>
                                <span class="block text-[9px] text-green-300 font-bold uppercase tracking-wider">Wakil Ketua BPD</span>
                                <span class="font-bold text-sm">{{ $wakilBpd->nama ?? '-' }}</span>
                            </div>
                        </div>

                        <!-- SEKRETARIS BPD (Right) -->
                        <div class="w-1/2 flex flex-col items-center pt-6">
                            <div class="px-6 py-2.5 bg-green-800 text-white rounded-xl shadow border border-green-750 text-center w-60 z-10 relative">
                                <div class="flex justify-center mb-1.5">
                                    <div class="w-14 h-14 rounded-full bg-green-700 border-2 border-green-600 flex items-center justify-center overflow-hidden">
                                        @if($sekBpd && $sekBpd->gambar)
                                            <img src="{{ asset('storage/' . $sekBpd->gambar) }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-7 h-7 text-green-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                        @endif
                                    </div>
                                </div>
                                <span class="block text-[9px] text-green-300 font-bold uppercase tracking-wider">Sekretaris</span>
                                <span class="font-bold text-sm">{{ $sekBpd->nama ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Vertical Line continuing down from Sekretaris -->
                    <div class="w-full h-8 relative z-10">
                        <div class="absolute top-0 bottom-0 -translate-x-1/2 w-0.5 bg-green-800 z-0" style="left: 75%;"></div>
                    </div>

                    <!-- 3. ANGGOTA ROW -->
                    <div class="w-full flex flex-col items-center relative z-10">
                        <div class="w-full relative pt-6">
                            <!-- Horizontal Line for Anggota -->
                            <div class="absolute top-0 h-0.5 bg-green-800 z-0" style="left: 12.5%; right: 12.5%;"></div>
                            
                            <!-- Drop lines for Anggota -->
                            <div class="absolute top-0 -translate-x-1/2 w-0.5 h-6 bg-green-800 z-0" style="left: 12.5%;"></div>
                            <div class="absolute top-0 -translate-x-1/2 w-0.5 h-6 bg-green-800 z-0" style="left: 37.5%;"></div>
                            <div class="absolute top-0 -translate-x-1/2 w-0.5 h-6 bg-green-800 z-0" style="left: 62.5%;"></div>
                            <div class="absolute top-0 -translate-x-1/2 w-0.5 h-6 bg-green-800 z-0" style="left: 87.5%;"></div>
                            
                            <div data-aos="fade-up" class="grid w-full gap-0" style="grid-template-columns: repeat(4, minmax(0, 1fr));">
                                @for($i = 0; $i < 4; $i++)
                                @php $anggota = $anggotaBpd[$i] ?? null; @endphp
                                <div class="px-2 w-full">
                                    <div class="px-3 py-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700/50 rounded-xl text-xs text-center shadow-sm w-full z-10 h-full flex flex-col">
                                        <div class="flex justify-center mb-1.5">
                                            <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-[#1e293b] border border-slate-200 dark:border-slate-700/50 flex items-center justify-center overflow-hidden">
                                                @if($anggota && $anggota->gambar)
                                                    <img src="{{ asset('storage/' . $anggota->gambar) }}" class="w-full h-full object-cover">
                                                @else
                                                    <svg class="w-6 h-6 text-slate-300 dark:text-slate-200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                @endif
                                            </div>
                                        </div>
                                        <span class="text-[9px] text-amber-700 dark:text-amber-400 font-bold uppercase block mb-1">Anggota</span>
                                        <span class="font-bold text-slate-900 dark:text-white block leading-tight mt-auto">{{ $anggota->nama ?? '-' }}</span>
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Profil Aparatur BPD -->
        <div class="space-y-8">
            <div class="text-center space-y-2">
                <h3 class="text-2xl font-bold font-serif text-slate-950 dark:text-white">Profil Aparatur BPD</h3>
                <p class="text-sm text-slate-650 dark:text-slate-200 max-w-lg mx-auto">Daftar kontak dan informasi singkat mengenai masing-masing anggota BPD Desa Olobaru.</p>
            </div>

            <div data-aos="fade-up" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($bpd as $p)
                <div data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}" class="bg-white dark:bg-[#1e293b] rounded-2xl border border-slate-100 dark:border-slate-700/50 p-5 shadow-sm text-center space-y-4 group hover:shadow-md transition-shadow">
                    <div class="w-24 h-24 mx-auto rounded-full bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-700/50 overflow-hidden">
                        @if($p->gambar)
                            <img src="{{ asset('storage/' . $p->gambar) }}" class="w-full h-full object-cover" alt="{{ $p->nama }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-400 dark:text-slate-200 dark:text-slate-200">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <span class="text-[10px] text-green-700 dark:text-green-300 font-bold uppercase tracking-wider block">{{ $p->jabatan }}</span>
                        <h4 class="font-bold text-slate-900 dark:text-white text-base mt-0.5">{{ $p->nama }}</h4>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-12 text-center text-slate-500 dark:text-white">
                    Belum ada data aparatur bpd.
                </div>
                @endforelse
            </div>
        </div>

    </div>
</section>
