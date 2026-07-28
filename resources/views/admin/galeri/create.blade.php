@extends('layouts.admin')

@section('title', 'Tambah Galeri')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Tambah Foto Galeri</h1>
        <p class="text-slate-500 dark:text-slate-300 dark:text-white mt-1">Unggah dokumentasi foto baru untuk ditampilkan di Galeri.</p>
    </div>
    <a href="{{ route('admin.galeri.index') }}" class="text-slate-500 dark:text-slate-300 dark:text-white hover:text-slate-700 dark:text-slate-200 font-medium text-sm flex items-center gap-1">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
</div>

<div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm max-w-3xl">
    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
        @csrf

        <!-- Judul -->
        <div>
            <label for="judul" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Judul Foto</label>
            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                   class="w-full rounded-xl border-slate-200 dark:border-slate-700 focus:border-green-500 focus:ring-green-500 shadow-sm dark:bg-slate-800 dark:text-white dark:border-slate-700"
                   placeholder="Contoh: Kegiatan Gotong Royong">
            @error('judul')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="deskripsi" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Deskripsi Singkat (Opsional)</label>
            <textarea name="deskripsi" id="deskripsi" rows="3"
                      class="w-full rounded-xl border-slate-200 dark:border-slate-700 focus:border-green-500 focus:ring-green-500 shadow-sm dark:bg-slate-800 dark:text-white dark:border-slate-700"
                      placeholder="Tuliskan keterangan singkat mengenai foto ini...">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Gambar -->
        <x-admin.image-upload-multiple name="gambar" label="Foto Galeri (Bisa Lebih Dari 1)" />

        <div class="pt-4 flex justify-end">
            <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-6 py-2.5 rounded-xl font-semibold shadow-sm transition-colors">
                Simpan Galeri
            </button>
        </div>
    </form>
</div>

@endsection
