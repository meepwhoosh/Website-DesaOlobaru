@extends('layouts.app')

@section('title', 'Data Dashboard - Desa Olobaru')

@section('content')
<!-- Hero Section -->
<div class="relative bg-green-900 pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden">
    <!-- Background Decor -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-1/2 -right-1/4 w-[1000px] h-[1000px] rounded-full bg-green-800/50 blur-3xl opacity-50"></div>
        <div class="absolute -bottom-1/2 -left-1/4 w-[800px] h-[800px] rounded-full bg-green-950/50 blur-3xl opacity-50"></div>
    </div>
    
    <div class="relative container mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-800/50 border border-green-700/50 text-green-300 text-sm font-medium mb-6">
            <span class="w-2 h-2 rounded-full bg-orange-400 animate-pulse"></span>
            Pusat Data & Statistik
        </span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-serif text-white tracking-tight mb-6">
            Data Desa Olobaru
        </h1>
        <p class="text-lg text-green-100 max-w-2xl mx-auto leading-relaxed">
            Transparansi data demografi, pendidikan, dan potensi sumber daya manusia secara real-time untuk mendukung kemajuan desa.
        </p>
    </div>
</div>

<!-- Main Dashboard Content -->
<div class="py-16 bg-slate-50 relative z-10 -mt-8 rounded-t-3xl shadow-xl">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Summary Cards Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Card 1 -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Penduduk</p>
                        <h3 class="text-2xl font-bold text-slate-900">1.245 <span class="text-sm font-normal text-slate-500">Jiwa</span></h3>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-green-50 text-green-700 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Jumlah KK</p>
                        <h3 class="text-2xl font-bold text-slate-900">384 <span class="text-sm font-normal text-slate-500">Keluarga</span></h3>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Wilayah</p>
                        <h3 class="text-2xl font-bold text-slate-900">3 <span class="text-sm font-normal text-slate-500">Dusun</span></h3>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Luas Wilayah</p>
                        <h3 class="text-2xl font-bold text-slate-900">3.013 <span class="text-sm font-normal text-slate-500">Ha</span></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Demographics & Gender Ratio -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Gender Ratio -->
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                <h3 class="text-xl font-bold font-serif text-slate-900 mb-6">Demografi Gender</h3>
                
                <div class="flex items-center justify-between mb-4">
                    <div class="text-center">
                        <div class="w-16 h-16 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mx-auto mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <p class="text-sm text-slate-500 font-medium">Laki-laki</p>
                        <p class="text-2xl font-bold text-slate-900">630</p>
                    </div>
                    <div class="flex-1 px-8">
                        <div class="h-4 w-full bg-slate-100 rounded-full flex overflow-hidden">
                            <div class="h-full bg-blue-500" style="width: 50.6%"></div>
                            <div class="h-full bg-pink-500" style="width: 49.4%"></div>
                        </div>
                        <div class="flex justify-between mt-2 text-xs font-bold">
                            <span class="text-blue-600">50.6%</span>
                            <span class="text-pink-600">49.4%</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 rounded-full bg-pink-50 text-pink-600 flex items-center justify-center mx-auto mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <p class="text-sm text-slate-500 font-medium">Perempuan</p>
                        <p class="text-2xl font-bold text-slate-900">615</p>
                    </div>
                </div>
            </div>

            <!-- Age Distribution -->
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                <h3 class="text-xl font-bold font-serif text-slate-900 mb-6">Kelompok Usia</h3>
                
                <div class="space-y-5">
                    <!-- Bar 1 -->
                    <div>
                        <div class="flex justify-between text-sm mb-1.5">
                            <span class="font-medium text-slate-700">Anak-anak & Remaja (0 - 18 th)</span>
                            <span class="font-bold text-slate-900">32%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2.5">
                            <div class="bg-orange-400 h-2.5 rounded-full" style="width: 32%"></div>
                        </div>
                    </div>
                    <!-- Bar 2 -->
                    <div>
                        <div class="flex justify-between text-sm mb-1.5">
                            <span class="font-medium text-slate-700">Usia Produktif (19 - 55 th)</span>
                            <span class="font-bold text-slate-900">55%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2.5">
                            <div class="bg-green-600 h-2.5 rounded-full" style="width: 55%"></div>
                        </div>
                    </div>
                    <!-- Bar 3 -->
                    <div>
                        <div class="flex justify-between text-sm mb-1.5">
                            <span class="font-medium text-slate-700">Lansia (> 55 th)</span>
                            <span class="font-bold text-slate-900">13%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2.5">
                            <div class="bg-slate-400 h-2.5 rounded-full" style="width: 13%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Education & Occupation -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Education Level -->
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                <h3 class="text-xl font-bold font-serif text-slate-900 mb-6">Tingkat Pendidikan</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg bg-green-50 text-green-700 flex items-center justify-center font-bold">
                            SD
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between text-xs mb-1">
                                <span class="font-medium text-slate-500">Tamat SD / Sederajat</span>
                                <span class="font-bold text-slate-700">310 Jiwa</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 40%"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg bg-green-50 text-green-700 flex items-center justify-center font-bold">
                            SMP
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between text-xs mb-1">
                                <span class="font-medium text-slate-500">Tamat SMP / Sederajat</span>
                                <span class="font-bold text-slate-700">245 Jiwa</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 32%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg bg-green-50 text-green-700 flex items-center justify-center font-bold">
                            SMA
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between text-xs mb-1">
                                <span class="font-medium text-slate-500">Tamat SMA / Sederajat</span>
                                <span class="font-bold text-slate-700">180 Jiwa</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 25%"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg bg-green-50 text-green-700 flex items-center justify-center font-bold text-sm">
                            PT
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between text-xs mb-1">
                                <span class="font-medium text-slate-500">Perguruan Tinggi (D3/S1)</span>
                                <span class="font-bold text-slate-700">45 Jiwa</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 10%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Occupation -->
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                <h3 class="text-xl font-bold font-serif text-slate-900 mb-6">Mata Pencaharian Utama</h3>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/50 hover:bg-slate-50 transition-colors">
                        <div class="w-10 h-10 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-900">Petani / Pekebun</h4>
                        <p class="text-xs text-slate-500 mt-1">Mayoritas mata pencaharian warga desa.</p>
                    </div>

                    <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/50 hover:bg-slate-50 transition-colors">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-900">Wiraswasta</h4>
                        <p class="text-xs text-slate-500 mt-1">Pedagang, UMKM, dan penyedia jasa.</p>
                    </div>

                    <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/50 hover:bg-slate-50 transition-colors">
                        <div class="w-10 h-10 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-900">PNS / Pegawai</h4>
                        <p class="text-xs text-slate-500 mt-1">Guru, perangkat daerah, aparatur negara.</p>
                    </div>

                    <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/50 hover:bg-slate-50 transition-colors">
                        <div class="w-10 h-10 rounded-lg bg-green-100 text-green-600 flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-900">Buruh Lepas</h4>
                        <p class="text-xs text-slate-500 mt-1">Pekerja harian, buruh tani, pertukangan.</p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
