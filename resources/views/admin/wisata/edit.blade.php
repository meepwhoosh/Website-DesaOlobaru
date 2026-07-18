@extends('layouts.admin')

@section('title', 'Edit Pariwisata Desa')

@section('content')
<div class="mb-8">
    <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
        <a href="{{ route('admin.wisata.index') }}" class="hover:text-green-700 transition-colors">Potensi & Wisata</a>
        <span>/</span>
        <span class="text-slate-900 font-medium">Edit Data</span>
    </div>
    <h1 class="text-2xl md:text-3xl font-bold text-slate-900">Ubah Data Destinasi</h1>
    <p class="text-slate-500 mt-1">Perbarui informasi tempat wisata atau potensi alam desa.</p>
</div>

<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden max-w-4xl">
    <form action="{{ route('admin.wisata.update', $wisata->id) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama_tempat" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Tempat <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_tempat" id="nama_tempat" required value="{{ old('nama_tempat', $wisata->nama_tempat) }}" 
                           class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-transparent outline-none transition-all">
                    @error('nama_tempat') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="kategori" class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori" id="kategori" required 
                            class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-transparent outline-none transition-all">
                        <option value="">Pilih Kategori</option>
                        <option value="Alam" {{ old('kategori', $wisata->kategori) == 'Alam' ? 'selected' : '' }}>Wisata Alam</option>
                        <option value="Budaya" {{ old('kategori', $wisata->kategori) == 'Budaya' ? 'selected' : '' }}>Situs Budaya / Sejarah</option>
                        <option value="Edukasi" {{ old('kategori', $wisata->kategori) == 'Edukasi' ? 'selected' : '' }}>Wisata Edukasi</option>
                        <option value="Kuliner" {{ old('kategori', $wisata->kategori) == 'Kuliner' ? 'selected' : '' }}>Pusat Kuliner</option>
                        <option value="Lainnya" {{ old('kategori', $wisata->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('kategori') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="lokasi" class="block text-sm font-semibold text-slate-700 mb-1.5">Lokasi / Alamat</label>
                <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $wisata->lokasi) }}" 
                       class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-transparent outline-none transition-all">
                @error('lokasi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi Singkat</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" 
                          class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-transparent outline-none transition-all">{{ old('deskripsi', $wisata->deskripsi) }}</textarea>
                @error('deskripsi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <x-admin.image-upload name="gambar" label="Foto Tempat Wisata (Opsional)" helper="Biarkan kosong jika tidak ingin mengubah foto" :currentImage="$wisata->gambar" />
        </div>

        <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.wisata.index') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">Batal</a>
            <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-700 hover:bg-blue-800 rounded-xl shadow-sm transition-all duration-200 hover:-translate-y-0.5">
                Perbarui Wisata
            </button>
        </div>
    </form>
</div>
@endsection
