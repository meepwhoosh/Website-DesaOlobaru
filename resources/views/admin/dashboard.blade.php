@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white">Selamat datang, {{ auth()->user()->name }}!</h1>
    <p class="text-slate-500 dark:text-slate-300 dark:text-white mt-1">Ini adalah pusat kendali (CMS) website Desa Olobaru.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <!-- Card Statistik -->
    <div class="bg-white dark:bg-[#1a1a1a] rounded-2xl p-6 border border-slate-200 dark:border-white/10 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-slate-700 dark:text-slate-200 dark:text-white">Total Berita</h3>
            <div class="w-10 h-10 rounded-full bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ \App\Models\Berita::count() }}</p>
        <p class="text-sm text-slate-500 dark:text-slate-300 mt-1">Artikel dipublikasikan</p>
    </div>

    <!-- Card Galeri -->
    <div class="bg-white dark:bg-[#1a1a1a] rounded-2xl p-6 border border-slate-200 dark:border-white/10 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-slate-700 dark:text-slate-200 dark:text-white">Total Galeri</h3>
            <div class="w-10 h-10 rounded-full bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 dark:text-emerald-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ \App\Models\Galeri::count() }}</p>
        <p class="text-sm text-slate-500 dark:text-slate-300 mt-1">Foto diunggah</p>
    </div>
</div>

<div class="bg-blue-50 dark:bg-blue-900/10 border border-blue-100 dark:border-blue-900/30 rounded-2xl p-6">
    <div class="flex items-start gap-4">
        <div class="text-blue-600 dark:text-blue-300 mt-1">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <h3 class="font-bold text-blue-900 dark:text-blue-300 mb-1">Informasi Pengembangan (Fase 1)</h3>
            <p class="text-sm text-blue-800 dark:text-blue-200/80 leading-relaxed">
                Sistem Manajemen Konten (CMS) ini sedang dalam proses pengembangan bertahap. Saat ini Anda sudah dapat mengelola <strong>Berita Desa</strong> melalui menu di samping. Fitur kelola Struktur Organisasi, UMKM, dan Profil akan segera menyusul pada fase selanjutnya!
            </p>
        </div>
    </div>
</div>
@endsection
