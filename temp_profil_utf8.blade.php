@extends('layouts.app')

@section('title', 'Profil Desa - Website Resmi Desa Olobaru')

@section('content')
<!-- Small Header Banner -->
<section class="relative py-16 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1500485035595-cbe6f645feb1?q=80&w=1200&auto=format&fit=crop" 
             alt="Persawahan Desa Olobaru" 
             class="w-full h-full object-cover object-center opacity-30" />
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-slate-900/80"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <span class="text-xs font-bold text-green-400 uppercase tracking-widest block mb-2">Tentang Kami</span>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold tracking-tight">Profil Desa Olobaru</h1>
    </div>
</section>

<!-- Content Body -->
<section class="py-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-20">
        
        <!-- Section 1: Sejarah Desa -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-4 space-y-4">
                <span class="text-xs font-bold text-green-700 uppercase tracking-widest block">Asal Usul</span>
                <h2 class="text-3xl font-bold font-serif text-slate-900 leading-tight">Sejarah Singkat Desa Olobaru</h2>
                <p class="text-sm text-slate-500 leading-relaxed">
                    Catatan sejarah pertumbuhan dan perkembangan pemukiman masyarakat Desa Olobaru dari masa ke masa.
                </p>
            </div>
            
            <div class="lg:col-span-8 bg-white border border-slate-100 p-8 sm:p-10 rounded-2xl shadow-sm space-y-6">
                <!-- Timeline Sejarah Desa Olobaru -->
                <div class="relative border-l-2 border-green-200 ml-3 space-y-8 pb-4">
                    @forelse($sejarahs as $index => $sejarah)
                    <!-- Milestone -->
                    <div class="relative pl-8">
                        <div class="absolute -left-1.5 top-1.5 w-3.5 h-3.5 rounded-full {{ $index % 2 == 0 ? 'bg-green-700' : 'bg-green-950' }} border-4 border-white shadow-sm"></div>
                        <span class="text-xs font-bold {{ $index % 2 == 0 ? 'text-green-700' : 'text-green-900' }} uppercase tracking-wider">Tahun {{ $sejarah->tahun }}</span>
                        <h3 class="text-lg font-bold text-slate-900 mt-1 mb-2">{{ $sejarah->judul }}</h3>
                        <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">{{ $sejarah->konten }}</p>
                    </div>
                    @empty
                    <div class="relative pl-8">
                        <p class="text-sm text-slate-500 italic">Data sejarah belum ditambahkan.</p>
                    </div>
                    @endforelse

                </div>
            </div>
        </div>

        <!-- Section 2: Visi & Misi -->
        <div class="bg-gradient-to-br from-green-950 to-green-900 text-white rounded-3xl p-8 sm:p-12 shadow-xl relative overflow-hidden">
            <div class="absolute -right-20 -bottom-20 w-80 h-80 rounded-full bg-white/5"></div>
            
            <div class="max-w-4xl mx-auto space-y-12">
                <!-- Visi -->
                <div class="text-center space-y-5">
                    <span class="text-xs font-bold text-green-300 uppercase tracking-widest block">Cita-Cita Kami</span>
                    <h2 class="text-2xl font-bold uppercase tracking-wider">VISI DESA</h2>
                    
                    <p class="text-xs sm:text-sm text-green-200/90 max-w-2xl mx-auto leading-relaxed">
                        Visi merupakan suatu gambaran yang dirancang tentang keadaan masa depan yang diinginkan dengan melihat potensi dan kebutuhan desa. Penyusunan Visi Desa Olobaru ini dilakukan dengan pendekatan partisipatif, melibatkan pihak-pihak yang berkepentingan di Desa Olobaru seperti pemerintah desa, BPD, tokoh masyarakat, tokoh agama, lembaga masyarakat desa dan masyarakat desa pada umumnya. Maka berdasarkan pertimbangan di atas Visi Desa Olobaru adalah:
                    </p>

                    <blockquote class="font-serif text-lg sm:text-xl md:text-2xl italic font-semibold leading-relaxed text-yellow-100 bg-white/5 border-l-4 border-yellow-250 p-6 rounded-2xl max-w-3xl mx-auto shadow-inner mt-4">
                        "Melangkah bersama menuju perubahan demi mewujudkan masyarakat yang bertaqwa, cerdas, kuat, sejahtera, berdaya saing dan berkepribadian luhur dengan mengedepankan prinsip keadilan"
                    </blockquote>
                </div>

                <!-- Divider -->
                <div class="border-t border-white/10 my-8"></div>

                <!-- Misi -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-bold uppercase tracking-wider text-center mb-6">MISI DESA</h2>
                    
                    <p class="text-xs sm:text-sm text-green-200/90 text-center max-w-2xl mx-auto leading-relaxed mb-8">
                        Misi memuat sesuatu yang harus dilaksanakan oleh desa agar tercapaianya visi desa. Dalam penyusunan misi mempertimbangkan potensi serta kebutuhan masyarakat Desa Olobaru, sebagaimana proses yang dilakukan maka misi Desa Olobaru 2018-2025 adalah:
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @forelse($misis as $misi)
                        <div class="flex gap-4 items-start bg-white/5 p-4 rounded-2xl hover:bg-white/10 transition-colors duration-250">
                            <div class="w-8 h-8 rounded-xl bg-green-800 text-green-300 flex items-center justify-center shrink-0 font-bold text-sm">{{ $misi->urutan }}</div>
                            <p class="text-xs sm:text-sm text-green-100 leading-relaxed">
                                {{ $misi->konten }}
                            </p>
                        </div>
                        @empty
                        <div class="col-span-full text-center">
                            <p class="text-sm text-green-200/80 italic">Data misi belum ditambahkan.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3: Geografis & Batas Wilayah -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Left Info Panel -->
            <div class="lg:col-span-5 space-y-6">
                <div class="space-y-4">
                    <span class="text-xs font-bold text-green-700 uppercase tracking-widest block">Tata Wilayah</span>
                    <h2 class="text-3xl font-bold font-serif text-slate-900 leading-tight">Geografis & Batas Wilayah</h2>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Desa Olobaru merupakan salah satu desa yang terletak di Kecamatan Parigi Selatan, Kabupaten Parigi Moutong, Provinsi Sulawesi Tengah. Memiliki luas wilayah sebesar <strong>┬▒3.013 Ha</strong> yang terbagi menjadi <strong>3 Dusun</strong>.
                    </p>
                </div>

                <!-- Quick Stats Cards Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 shadow-sm">
                        <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Luas Wilayah</span>
                        <span class="text-base font-bold text-green-900">┬▒3.013 Ha</span>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 shadow-sm">
                        <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Ketinggian Lahan</span>
                        <span class="text-base font-bold text-green-900">14 - 18 mdpl</span>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 shadow-sm">
                        <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Jarak ke Kota</span>
                        <span class="text-base font-bold text-green-900">6 Km</span>
                        <span class="text-[9px] text-slate-500 block">dari Ibu Kota Parigi</span>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 shadow-sm col-span-2">
                        <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Titik Koordinat</span>
                        <span class="text-sm font-semibold text-slate-800 block mt-0.5 font-mono">120.128789 BT | -0.927364 LS</span>
                    </div>
                </div>

                <!-- Climate Description Card -->
                <div class="bg-green-950 text-green-100 p-6 rounded-2xl border border-green-900 space-y-3">
                    <span class="text-[10px] text-green-400 font-bold block uppercase tracking-wider">Klimatologi & Lahan</span>
                    <p class="text-xs leading-relaxed text-green-200">
                        Lahan di Desa Olobaru merupakan hamparan dataran yang sebagian besar dimanfaatkan sebagai pemukiman, perladangan, dan persawahan. Curah hujan rata-rata tahunan mencapai 1.560 mm dengan jumlah hari hujan rata-rata 120 hari.
                    </p>
                </div>
            </div>
            
            <!-- Right Boundary & Details Panel -->
            <div class="lg:col-span-7 space-y-8">
                <!-- Batas Wilayah -->
                <div>
                    <h3 class="text-lg font-bold text-slate-900 font-serif mb-4 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-green-700 rounded-full"></span>
                        Batas Administratif Wilayah
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Batas Utara -->
                        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:border-green-150 transition-all">
                            <div class="w-10 h-10 rounded-xl bg-green-50 text-green-800 flex items-center justify-center font-bold text-sm shrink-0">U</div>
                            <div>
                                <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Utara</span>
                                <span class="text-xs font-semibold text-slate-800 leading-snug block">Desa Olaya (Kecamatan Parigi), Kab. Parigi Moutong</span>
                            </div>
                        </div>
                        <!-- Batas Selatan -->
                        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:border-green-150 transition-all">
                            <div class="w-10 h-10 rounded-xl bg-green-50 text-green-800 flex items-center justify-center font-bold text-sm shrink-0">S</div>
                            <div>
                                <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Selatan</span>
                                <span class="text-xs font-semibold text-slate-800 leading-snug block">Desa Olaya (Kecamatan Parigi) & Desa Lemusa, Kab. Parigi Moutong</span>
                            </div>
                        </div>
                        <!-- Batas Timur -->
                        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:border-green-150 transition-all">
                            <div class="w-10 h-10 rounded-xl bg-green-50 text-green-800 flex items-center justify-center font-bold text-sm shrink-0">T</div>
                            <div>
                                <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Timur</span>
                                <span class="text-xs font-semibold text-slate-800 leading-snug block">Teluk Tomini / Laut</span>
                            </div>
                        </div>
                        <!-- Batas Barat -->
                        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:border-green-150 transition-all">
                            <div class="w-10 h-10 rounded-xl bg-green-50 text-green-800 flex items-center justify-center font-bold text-sm shrink-0">B</div>
                            <div>
                                <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Barat</span>
                                <span class="text-xs font-semibold text-slate-800 leading-snug block">Desa Air Panas (Kec. Parigi Barat), Kab. Parigi Moutong</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Climate Details -->
                <div class="bg-slate-50/50 p-6 sm:p-8 rounded-2xl border border-slate-100 space-y-6">
                    <h3 class="text-base font-bold text-slate-900 uppercase tracking-wide">Kondisi Suhu & Pola Musim</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <!-- Suhu -->
                        <div class="space-y-1">
                            <span class="text-xs font-semibold text-slate-505 block">Suhu Udara</span>
                            <span class="text-2xl font-black text-slate-800 block">31,7┬░C</span>
                            <span class="text-[10px] text-slate-500 block">Min: 24,2┬░C | Max: 38,4┬░C</span>
                        </div>
                        
                        <!-- Musim Hujan -->
                        <div class="space-y-1 border-l border-slate-200 pl-4 sm:pl-6">
                            <span class="text-xs font-semibold text-slate-505 block">Musim Hujan</span>
                            <span class="text-sm font-bold text-slate-800 block">Oktober - Maret</span>
                            <span class="text-[10px] text-slate-500 block">Puncak: Des - Feb (Curah Rata 1.560 mm)</span>
                        </div>

                        <!-- Musim Kemarau -->
                        <div class="space-y-1 border-l border-slate-200 pl-4 sm:pl-6">
                            <span class="text-xs font-semibold text-slate-505 block">Musim Kemarau</span>
                            <span class="text-sm font-bold text-slate-800 block">April - September</span>
                            <span class="text-[10px] text-slate-500 block">Kering: 4 - 6 bulan (Bulan Basah: 5 - 8)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 4: Sejarah Kepemimpinan Desa -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start pt-8 border-t border-slate-200/60">
            <div class="lg:col-span-4 space-y-4">
                <span class="text-xs font-bold text-green-700 uppercase tracking-widest block">Kepemimpinan</span>
                <h2 class="text-3xl font-bold font-serif text-slate-900 leading-tight">Mantan Kepala Desa Olobaru</h2>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Daftar nama Kepala Desa yang pernah menjabat dan memimpin pembangunan di Desa Olobaru sejak tahun 1966 sampai dengan sekarang.
                </p>
            </div>
            
            <div class="lg:col-span-8 bg-white border border-slate-100 p-8 sm:p-10 rounded-2xl shadow-sm">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-h-[480px] overflow-y-auto pr-2 scrollbar-thin">
                    
                    <!-- Kades 1 -->
                    <div class="flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-green-150 bg-slate-50/50 hover:bg-white transition-all shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-green-700 text-white flex items-center justify-center font-bold text-sm shrink-0">1</div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Geno Salindesa</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Tahun 1966 s/d 1971</p>
                        </div>
                    </div>

                    <!-- Kades 2 -->
                    <div class="flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-green-150 bg-slate-50/50 hover:bg-white transition-all shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-650 flex items-center justify-center font-bold text-sm shrink-0">2</div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Ferni Mokodaser</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Tahun 1971 s/d 1980</p>
                        </div>
                    </div>

                    <!-- Kades 3 -->
                    <div class="flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-green-150 bg-slate-50/50 hover:bg-white transition-all shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-650 flex items-center justify-center font-bold text-sm shrink-0">3</div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Yorry Matindas</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Tahun 1980 s/d 1981</p>
                        </div>
                    </div>

                    <!-- Kades 4 -->
                    <div class="flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-green-150 bg-slate-50/50 hover:bg-white transition-all shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-650 flex items-center justify-center font-bold text-sm shrink-0">4</div>
                        <div class="space-y-0.5">
                            <h4 class="font-bold text-slate-900 text-sm">Sam Korompis</h4>
                            <span class="text-[9px] text-orange-700 font-bold bg-orange-50 px-2 py-0.5 rounded-full inline-block">Pejabat Sementara</span>
                            <p class="text-xs text-slate-500 mt-0.5">Tahun 1981 s/d 1982</p>
                        </div>
                    </div>

                    <!-- Kades 5 -->
                    <div class="flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-green-150 bg-slate-50/50 hover:bg-white transition-all shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-650 flex items-center justify-center font-bold text-sm shrink-0">5</div>
                        <div class="space-y-0.5">
                            <h4 class="font-bold text-slate-900 text-sm">AV Palari</h4>
                            <span class="text-[9px] text-green-700 font-bold bg-green-50 px-2 py-0.5 rounded-full inline-block">Pejabat Sementara (1982-1984)</span>
                            <span class="text-[9px] text-blue-700 font-bold bg-blue-50 px-2 py-0.5 rounded-full inline-block">Kades Terpilih (1984-1992)</span>
                            <p class="text-xs text-slate-500 mt-0.5">Tahun 1982 s/d 1992</p>
                        </div>
                    </div>

                    <!-- Kades 6 -->
                    <div class="flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-green-150 bg-slate-50/50 hover:bg-white transition-all shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-650 flex items-center justify-center font-bold text-sm shrink-0">6</div>
                        <div class="space-y-0.5">
                            <h4 class="font-bold text-slate-900 text-sm">Daniel Kawulur</h4>
                            <span class="text-[9px] text-orange-700 font-bold bg-orange-50 px-2 py-0.5 rounded-full inline-block">Pejabat Sementara</span>
                            <p class="text-xs text-slate-500 mt-0.5">Tahun 1992 s/d 1993</p>
                        </div>
                    </div>

                    <!-- Kades 7 -->
                    <div class="flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-green-150 bg-slate-50/50 hover:bg-white transition-all shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-650 flex items-center justify-center font-bold text-sm shrink-0">7</div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Yulius Ganzet</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Tahun 1993 s/d 2001</p>
                        </div>
                    </div>

                    <!-- Kades 8 -->
                    <div class="flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-green-150 bg-slate-50/50 hover:bg-white transition-all shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-650 flex items-center justify-center font-bold text-sm shrink-0">8</div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Yorry Matindas</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Tahun 2001 s/d 2006</p>
                        </div>
                    </div>

                    <!-- Kades 9 -->
                    <div class="flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-green-150 bg-slate-50/50 hover:bg-white transition-all shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-655 flex items-center justify-center font-bold text-sm shrink-0">9</div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Berlin Saragih</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Tahun 2006 s/d 2012</p>
                        </div>
                    </div>

                    <!-- Kades 10 -->
                    <div class="flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-green-150 bg-slate-50/50 hover:bg-white transition-all shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-655 flex items-center justify-center font-bold text-sm shrink-0">10</div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Salmon Hamise</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Tahun 2012 s/d 2018</p>
                        </div>
                    </div>

                    <!-- Kades 11 -->
                    <div class="flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-green-150 bg-slate-50/50 hover:bg-white transition-all shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-655 flex items-center justify-center font-bold text-sm shrink-0">11</div>
                        <div class="space-y-0.5">
                            <h4 class="font-bold text-slate-900 text-sm">Mohsen SE</h4>
                            <span class="text-[9px] text-orange-700 font-bold bg-orange-50 px-2 py-0.5 rounded-full inline-block">Pejabat Sementara</span>
                            <p class="text-xs text-slate-500 mt-0.5">Tahun 2018 s/d April 2019</p>
                        </div>
                    </div>

                    <!-- Kades 12 -->
                    <div class="flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-green-150 bg-slate-50/50 hover:bg-white transition-all shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-655 flex items-center justify-center font-bold text-sm shrink-0">12</div>
                        <div class="space-y-0.5">
                            <h4 class="font-bold text-slate-900 text-sm">Enang Pandake</h4>
                            <span class="text-[9px] text-orange-700 font-bold bg-orange-50 px-2 py-0.5 rounded-full inline-block">Pejabat Sementara</span>
                            <p class="text-xs text-slate-500 mt-0.5">Mei 2019 s/d Oktober 2019</p>
                        </div>
                    </div>

                    <!-- Kades 13 -->
                    <div class="flex items-center gap-4 p-4 rounded-xl border-2 border-green-700 bg-green-50/40 transition-all shadow-md">
                        <div class="w-10 h-10 rounded-full bg-green-900 text-white flex items-center justify-center font-bold text-sm shrink-0 shadow-sm">13</div>
                        <div class="space-y-0.5">
                            <h4 class="font-bold text-slate-900 text-sm">Arnold</h4>
                            <span class="text-[9px] text-green-800 font-bold bg-green-100 px-2 py-0.5 rounded-full inline-block">Kades Aktif</span>
                            <p class="text-xs text-slate-500 mt-0.5">Oktober 2019 s/d Sekarang</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

<!-- Include Struktur SOTK & BPD -->
@include('partials.struktur-content')

@endsection
