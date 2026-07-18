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
    $kaurKeu = $getPerson('Keuangan');
    $kadus1 = $getPerson('Dusun 1') ?? $getPerson('Dusun I');
    $kadus2 = $getPerson('Dusun 2') ?? $getPerson('Dusun II');
    $kadus3 = $getPerson('Dusun 3') ?? $getPerson('Dusun III');

    // Data BPD
    $ketuaBpd = $getPerson('Ketua', true);
    $wakilBpd = $getPerson('Wakil', true);
    $sekBpd = $getPerson('Sekretaris', true);
    
    // Anggota BPD bisa lebih dari 1, kita ambil semua yang jabatannya ada kata "Anggota"
    $anggotaBpd = $bpd->filter(function($item) {
        return stripos($item->jabatan, 'Anggota') !== false;
    })->values();
@endphp

<!-- Small Header Banner -->
<section class="relative py-16 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=1200&auto=format&fit=crop" 
             alt="Struktur Organisasi Desa Olobaru" 
             class="w-full h-full object-cover object-center opacity-30" />
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-slate-900/80"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <span class="text-xs font-bold text-green-400 uppercase tracking-widest block mb-2">Pemerintah Desa</span>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold tracking-tight">Susunan Organisasi & Tata Kerja (SOTK)</h1>
    </div>
</section>

<!-- Content Body -->
<section class="py-16 bg-slate-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-20">
        
        <!-- Section 1: Pengantar -->
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <h2 class="text-3xl font-bold font-serif text-slate-950">Aparatur Struktur Organisasi Desa Olobaru</h2>
            <p class="text-sm text-slate-600 leading-relaxed">
                Struktur organisasi dan tata kerja pemerintahan Desa Olobaru, Kecamatan Parigi Selatan, Kabupaten Parigi Moutong, dirancang untuk melayani warga secara adil, transparan, dan terintegrasi.
            </p>
        </div>

        <!-- Section 2: Struktur Organisasi (Hierarchical Flowchart Layout) -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 sm:p-10 shadow-sm space-y-10">
            <div class="text-center space-y-2">
                <span class="text-xs font-bold text-green-700 uppercase tracking-widest block">Bagan Tata Kerja</span>
                <h3 class="text-2xl font-bold font-serif text-slate-950">Bagan Struktur Organisasi SOTK</h3>
                <p class="text-xs text-slate-550 max-w-xl mx-auto">Hubungan pembagian tugas dan hierarki koordinasi antar perangkat desa.</p>
            </div>

            <!-- Flowchart Tree Grid -->
            <div class="overflow-x-auto pt-6 pb-4">
                <div class="min-w-[960px] flex flex-col items-center p-6 bg-slate-50/70 rounded-3xl border border-slate-100">
                    
                    <!-- 1. KEPALA DESA -->
                    <div class="flex flex-col items-center w-full relative">
                        <div class="px-6 py-3 bg-green-950 text-white rounded-xl shadow-md border-2 border-green-800 text-center w-64 z-10">
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
                    <div class="flex w-full items-stretch relative">
                        <div class="absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-0.5 bg-green-800"></div>
                        
                        <!-- LEFT COLUMN: KASI -->
                        <div class="w-1/2 flex flex-col items-center">
                            <div class="w-full flex h-6">
                                <div class="w-1/2"></div>
                                <div class="w-1/2 border-t-2 border-l-2 border-green-800"></div>
                            </div>
                            
                            <div class="grid grid-cols-3 w-full gap-0 pt-0">
                                <!-- Kasi Pemerintahan -->
                                <div class="flex flex-col items-center">
                                    <div class="w-full flex h-4">
                                        <div class="w-1/2"></div>
                                        <div class="w-1/2 border-t-2 border-l-2 border-green-800"></div>
                                    </div>
                                    <div class="px-3 w-full">
                                        <div class="px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-xs text-center shadow-sm w-full z-10 h-full">
                                            <div class="flex justify-center mb-1.5">
                                                <div class="w-12 h-12 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden">
                                                    @if($kasiPem && $kasiPem->gambar)
                                                        <img src="{{ asset('storage/' . $kasiPem->gambar) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <svg class="w-6 h-6 text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                    @endif
                                                </div>
                                            </div>
                                            <span class="text-[9px] text-green-700 font-bold uppercase block mb-1">Kepala Seksi Pemerintahan</span>
                                            <span class="font-bold text-slate-900 block leading-tight">{{ $kasiPem->nama ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kasi Kesejahteraan -->
                                <div class="flex flex-col items-center">
                                    <div class="w-full flex h-4">
                                        <div class="w-1/2 border-t-2 border-green-800"></div>
                                        <div class="w-1/2 border-t-2 border-l-2 border-green-800"></div>
                                    </div>
                                    <div class="px-3 w-full">
                                        <div class="px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-xs text-center shadow-sm w-full z-10 h-full">
                                            <div class="flex justify-center mb-1.5">
                                                <div class="w-12 h-12 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden">
                                                    @if($kasiKes && $kasiKes->gambar)
                                                        <img src="{{ asset('storage/' . $kasiKes->gambar) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <svg class="w-6 h-6 text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                    @endif
                                                </div>
                                            </div>
                                            <span class="text-[9px] text-green-700 font-bold uppercase block mb-1">Kepala Seksi Kesejahteraan</span>
                                            <span class="font-bold text-slate-900 block leading-tight">{{ $kasiKes->nama ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kasi Pelayanan -->
                                <div class="flex flex-col items-center">
                                    <div class="w-full flex h-4">
                                        <div class="w-1/2 border-t-2 border-r-2 border-green-800"></div>
                                        <div class="w-1/2"></div>
                                    </div>
                                    <div class="px-3 w-full">
                                        <div class="px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-xs text-center shadow-sm w-full z-10 h-full">
                                            <div class="flex justify-center mb-1.5">
                                                <div class="w-12 h-12 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden">
                                                    @if($kasiPel && $kasiPel->gambar)
                                                        <img src="{{ asset('storage/' . $kasiPel->gambar) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <svg class="w-6 h-6 text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                    @endif
                                                </div>
                                            </div>
                                            <span class="text-[9px] text-green-700 font-bold uppercase block mb-1">Kepala Seksi Pelayanan</span>
                                            <span class="font-bold text-slate-900 block leading-tight">{{ $kasiPel->nama ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT COLUMN: SEKDES & KAURS -->
                        <div class="w-1/2 flex flex-col items-center">
                            <div class="w-full flex h-6">
                                <div class="w-1/2 border-t-2 border-r-2 border-green-800"></div>
                                <div class="w-1/2"></div>
                            </div>
                            
                            <!-- Sekretaris Desa -->
                            <div class="px-6 py-2.5 bg-green-800 text-white rounded-xl shadow border border-green-750 text-center w-60 z-10">
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
                            
                            <div class="w-0.5 h-6 bg-green-800"></div>
                            <div class="w-1/2 h-0.5 bg-green-800"></div>

                            <!-- Kaurs -->
                            <div class="grid grid-cols-2 w-full gap-0 pt-0">
                                <!-- Kaur TU -->
                                <div class="flex flex-col items-center">
                                    <div class="w-full flex h-4">
                                        <div class="w-1/2"></div>
                                        <div class="w-1/2 border-t-2 border-l-2 border-green-800"></div>
                                    </div>
                                    <div class="px-6 w-full">
                                        <div class="px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-xs text-center shadow-sm w-full z-10 h-full">
                                            <div class="flex justify-center mb-1.5">
                                                <div class="w-12 h-12 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden">
                                                    @if($kaurTu && $kaurTu->gambar)
                                                        <img src="{{ asset('storage/' . $kaurTu->gambar) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <svg class="w-6 h-6 text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                    @endif
                                                </div>
                                            </div>
                                            <span class="text-[8px] text-green-700 font-bold uppercase block mb-1">Kepala Urusan Tata Usaha & Umum</span>
                                            <span class="font-bold text-slate-900 block leading-tight">{{ $kaurTu->nama ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kaur Keuangan -->
                                <div class="flex flex-col items-center">
                                    <div class="w-full flex h-4">
                                        <div class="w-1/2 border-t-2 border-r-2 border-green-800"></div>
                                        <div class="w-1/2"></div>
                                    </div>
                                    <div class="px-6 w-full">
                                        <div class="px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-xs text-center shadow-sm w-full z-10 h-full">
                                            <div class="flex justify-center mb-1.5">
                                                <div class="w-12 h-12 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden">
                                                    @if($kaurKeu && $kaurKeu->gambar)
                                                        <img src="{{ asset('storage/' . $kaurKeu->gambar) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <svg class="w-6 h-6 text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                    @endif
                                                </div>
                                            </div>
                                            <span class="text-[8px] text-green-700 font-bold uppercase block mb-1">Kepala Urusan Keuangan</span>
                                            <span class="font-bold text-slate-900 block leading-tight">{{ $kaurKeu->nama ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. BOTTOM VERTICAL CONNECTOR LINE (FROM CENTER TO KADUSES) -->
                    <div class="w-0.5 h-8 bg-green-800"></div>

                    <!-- 4. KEPALA DUSUN ROW (KADUS) -->
                    <div class="w-full flex flex-col items-center relative">
                        <div class="grid grid-cols-3 w-full gap-0 pt-0">
                            <!-- Kadus 1 -->
                            <div class="flex flex-col items-center">
                                <div class="w-full flex h-4">
                                    <div class="w-1/2"></div>
                                    <div class="w-1/2 border-t-2 border-l-2 border-green-800"></div>
                                </div>
                                <div class="px-4 w-full">
                                    <div class="px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-xs text-center shadow-sm w-full z-10 h-full">
                                        <div class="flex justify-center mb-1.5">
                                            <div class="w-12 h-12 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden">
                                                @if($kadus1 && $kadus1->gambar)
                                                    <img src="{{ asset('storage/' . $kadus1->gambar) }}" class="w-full h-full object-cover">
                                                @else
                                                    <svg class="w-6 h-6 text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                @endif
                                            </div>
                                        </div>
                                        <span class="text-[9px] text-amber-700 font-bold uppercase block mb-1">Kepala Dusun I</span>
                                        <span class="font-bold text-slate-900 block leading-tight">{{ $kadus1->nama ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Kadus 2 -->
                            <div class="flex flex-col items-center">
                                <div class="w-full flex h-4">
                                    <div class="w-1/2 border-t-2 border-green-800"></div>
                                    <div class="w-1/2 border-t-2 border-l-2 border-green-800"></div>
                                </div>
                                <div class="px-4 w-full">
                                    <div class="px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-xs text-center shadow-sm w-full z-10 h-full">
                                        <div class="flex justify-center mb-1.5">
                                            <div class="w-12 h-12 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden">
                                                @if($kadus2 && $kadus2->gambar)
                                                    <img src="{{ asset('storage/' . $kadus2->gambar) }}" class="w-full h-full object-cover">
                                                @else
                                                    <svg class="w-6 h-6 text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                @endif
                                            </div>
                                        </div>
                                        <span class="text-[9px] text-amber-700 font-bold uppercase block mb-1">Kepala Dusun II</span>
                                        <span class="font-bold text-slate-900 block leading-tight">{{ $kadus2->nama ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Kadus 3 -->
                            <div class="flex flex-col items-center">
                                <div class="w-full flex h-4">
                                    <div class="w-1/2 border-t-2 border-r-2 border-green-800"></div>
                                    <div class="w-1/2"></div>
                                </div>
                                <div class="px-4 w-full">
                                    <div class="px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-xs text-center shadow-sm w-full z-10 h-full">
                                        <div class="flex justify-center mb-1.5">
                                            <div class="w-12 h-12 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden">
                                                @if($kadus3 && $kadus3->gambar)
                                                    <img src="{{ asset('storage/' . $kadus3->gambar) }}" class="w-full h-full object-cover">
                                                @else
                                                    <svg class="w-6 h-6 text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                @endif
                                            </div>
                                        </div>
                                        <span class="text-[9px] text-amber-700 font-bold uppercase block mb-1">Kepala Dusun III</span>
                                        <span class="font-bold text-slate-900 block leading-tight">{{ $kadus3->nama ?? '-' }}</span>
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
                <h3 class="text-2xl font-bold font-serif text-slate-950">Profil Aparatur Desa</h3>
                <p class="text-sm text-slate-650 max-w-lg mx-auto">Daftar kontak dan informasi singkat mengenai masing-masing perangkat desa Olobaru.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($pemdes as $p)
                <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm text-center space-y-4 group hover:shadow-md transition-shadow">
                    <div class="w-24 h-24 mx-auto rounded-full bg-slate-100 border border-slate-200 overflow-hidden">
                        @if($p->gambar)
                            <img src="{{ asset('storage/' . $p->gambar) }}" class="w-full h-full object-cover" alt="{{ $p->nama }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-400">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <span class="text-[10px] text-green-700 font-bold uppercase tracking-wider block">{{ $p->jabatan }}</span>
                        <h4 class="font-bold text-slate-900 text-base mt-0.5">{{ $p->nama }}</h4>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-12 text-center text-slate-500">
                    Belum ada data aparatur desa.
                </div>
                @endforelse
            </div>
        </div>

    </div>
</section>

<!-- BPD Structure Section -->
<section id="struktur-bpd" class="py-16 bg-slate-50 border-t border-slate-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-50 text-green-700 text-sm font-semibold mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                Struktur BPD
            </span>
            <h2 class="text-3xl md:text-4xl font-bold font-serif text-slate-900 mb-4">Badan Permusyawaratan Desa (BPD)</h2>
            <p class="text-slate-600">Susunan pengurus BPD Olobaru yang berperan sebagai mitra penyelenggaraan pemerintahan desa dalam menetapkan peraturan desa dan menampung aspirasi masyarakat.</p>
        </div>

        <!-- Desktop Chart (Hidden on Mobile) -->
        <div class="hidden lg:block">
            <div class="max-w-6xl mx-auto overflow-x-auto pb-8">
                <div class="min-w-[960px] flex flex-col items-center select-none py-8">
                    
                    <!-- KETUA BPD -->
                    <div class="flex flex-col items-center w-full relative">
                        <div class="px-6 py-3 bg-green-950 text-white rounded-xl shadow-lg border-2 border-green-900 text-center w-64 z-10 relative">
                            <div class="flex justify-center mb-2">
                                <div class="w-16 h-16 rounded-full bg-green-800/50 border-2 border-green-500/30 flex items-center justify-center overflow-hidden">
                                    @if($ketuaBpd && $ketuaBpd->gambar)
                                        <img src="{{ asset('storage/' . $ketuaBpd->gambar) }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-8 h-8 text-green-200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                    @endif
                                </div>
                            </div>
                            <span class="block text-[10px] text-green-300 font-bold uppercase tracking-wider">Ketua BPD</span>
                            <span class="text-base font-bold">{{ $ketuaBpd->nama ?? '-' }}</span>
                        </div>
                        <div class="w-0.5 h-8 bg-green-800"></div>
                    </div>

                    <!-- Split point for Wakil and Sekretaris -->
                    <div class="w-full flex justify-center relative h-8">
                        <div class="absolute right-1/2 top-0 w-64 h-0.5 bg-green-800"></div>
                        <div class="absolute right-[calc(50%+16rem)] top-0 w-0.5 h-8 bg-green-800"></div>
                        <div class="w-0.5 h-8 bg-green-800"></div>
                    </div>

                    <!-- Row with Wakil and Sekretaris -->
                    <div class="w-full flex justify-center relative">
                        <!-- Wakil Card -->
                        <div class="absolute right-[calc(50%+16rem)] top-0 translate-x-1/2">
                            <div class="px-4 py-2.5 bg-white border border-slate-200 rounded-xl shadow-sm text-center w-52 z-10 relative">
                                <div class="flex justify-center mb-1.5">
                                    <div class="w-12 h-12 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden">
                                        @if($wakilBpd && $wakilBpd->gambar)
                                            <img src="{{ asset('storage/' . $wakilBpd->gambar) }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-6 h-6 text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                        @endif
                                    </div>
                                </div>
                                <span class="text-[9px] text-green-700 font-bold uppercase block mb-1">Wakil Ketua BPD</span>
                                <span class="font-bold text-slate-900 block leading-tight">{{ $wakilBpd->nama ?? '-' }}</span>
                            </div>
                        </div>
                        
                        <!-- Sekretaris Card -->
                        <div class="px-6 py-2.5 bg-green-800 text-white rounded-xl shadow-md border-2 border-green-700 text-center w-64 z-10 relative">
                            <div class="flex justify-center mb-1.5">
                                <div class="w-14 h-14 rounded-full bg-green-700/50 border border-green-500/30 flex items-center justify-center overflow-hidden">
                                    @if($sekBpd && $sekBpd->gambar)
                                        <img src="{{ asset('storage/' . $sekBpd->gambar) }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-7 h-7 text-green-200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                    @endif
                                </div>
                            </div>
                            <span class="text-[9px] text-green-300 font-bold uppercase block mb-1">Sekretaris BPD</span>
                            <span class="font-bold text-white block leading-tight">{{ $sekBpd->nama ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="w-0.5 h-8 bg-green-800"></div>

                    <!-- Anggota BPD (Dynamic Loop) -->
                    <div class="w-full max-w-4xl grid grid-cols-4 gap-0 relative">
                        <div class="absolute top-0 left-[12.5%] right-[12.5%] h-0.5 bg-green-800"></div>
                        
                        @for($i = 0; $i < 4; $i++)
                        @php $anggota = $anggotaBpd[$i] ?? null; @endphp
                        <div class="flex flex-col items-center">
                            <div class="w-0.5 h-6 bg-green-800"></div>
                            <div class="px-2 w-full">
                                <div class="px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-xs text-center shadow-sm w-full z-10 h-full">
                                    <div class="flex justify-center mb-1.5">
                                        <div class="w-12 h-12 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden">
                                            @if($anggota && $anggota->gambar)
                                                <img src="{{ asset('storage/' . $anggota->gambar) }}" class="w-full h-full object-cover">
                                            @else
                                                <svg class="w-6 h-6 text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                            @endif
                                        </div>
                                    </div>
                                    <span class="text-[9px] text-green-700 font-bold uppercase block mb-1">Anggota BPD</span>
                                    <span class="font-bold text-slate-900 block leading-tight">{{ $anggota->nama ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Layout for BPD (Grid Profile Cards) -->
        <div class="lg:hidden mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
            @forelse($bpd as $p)
            <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm text-center flex flex-col items-center">
                <div class="w-16 h-16 rounded-full bg-slate-100 border border-slate-200 overflow-hidden mb-3">
                    @if($p->gambar)
                        <img src="{{ asset('storage/' . $p->gambar) }}" class="w-full h-full object-cover">
                    @else
                        <svg class="w-8 h-8 text-slate-300 m-auto mt-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    @endif
                </div>
                <span class="text-[10px] text-green-700 font-bold uppercase tracking-wider block">{{ $p->jabatan }}</span>
                <h4 class="font-bold text-slate-900 text-sm mt-0.5">{{ $p->nama }}</h4>
            </div>
            @empty
            <div class="col-span-full py-8 text-center text-slate-500">
                Belum ada data BPD.
            </div>
            @endforelse
        </div>

    </div>
</section>
