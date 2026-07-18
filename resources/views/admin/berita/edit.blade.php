@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900">Edit Berita</h1>
        <p class="text-slate-500 mt-1">Lakukan perubahan pada artikel berita ini.</p>
    </div>
    <a href="{{ route('admin.berita.index') }}" class="text-slate-500 hover:text-slate-700 font-medium text-sm flex items-center gap-1">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Batal
    </a>
</div>

<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden max-w-4xl">
    <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <!-- Judul -->
            <div>
                <label for="judul" class="block text-sm font-semibold text-slate-700 mb-1.5">Judul Berita <span class="text-red-500">*</span></label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $berita->judul) }}" required
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700">
                @error('judul') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Konten -->
            <div>
                <label for="konten" class="block text-sm font-semibold text-slate-700 mb-1.5">Isi Konten Berita <span class="text-red-500">*</span></label>
                <textarea name="konten" id="konten" rows="8" required
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700">{{ old('konten', $berita->konten) }}</textarea>
                @error('konten') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Gambar -->
                <x-admin.image-upload name="gambar" label="Ganti Gambar / Foto Utama" helper="Biarkan kosong jika tidak ingin mengubah gambar." :currentImage="$berita->gambar" />

                <!-- Tanggal Publikasi -->
                <div>
                    <label for="tanggal_publikasi" class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal Publikasi</label>
                    <input type="date" name="tanggal_publikasi" id="tanggal_publikasi" value="{{ old('tanggal_publikasi', $berita->tanggal_publikasi) }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700">
                    @error('tanggal_publikasi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Tombol Simpan -->
            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-semibold shadow-sm transition-all duration-200 hover:-translate-y-0.5">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
