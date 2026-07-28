@extends('layouts.admin')

@section('title', 'Edit Produk UMKM')

@section('content')
<div class="mb-8">
    <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-300 dark:text-white mb-2">
        <a href="{{ route('admin.umkm.index') }}" class="hover:text-green-700 transition-colors">Produk UMKM</a>
        <span>/</span>
        <span class="text-slate-900 dark:text-white font-medium">Edit Produk</span>
    </div>
    <h1 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white">Ubah Data Produk</h1>
    <p class="text-slate-500 dark:text-slate-300 dark:text-white mt-1">Perbarui informasi detail mengenai produk UMKM desa.</p>
</div>

<div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm overflow-hidden max-w-4xl">
    <form action="{{ route('admin.umkm.update', $umkm->id) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
        @csrf
        @method('PUT')

        <!-- Informasi Produk -->
        <div class="space-y-4">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-700 pb-2">Informasi Produk</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama_produk" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Nama Produk <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_produk" id="nama_produk" required value="{{ old('nama_produk', $umkm->nama_produk) }}" 
                           class="w-full px-4 py-2 bg-slate-50 dark:bg-[#0f0f0f] dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-transparent outline-none transition-all">
                    @error('nama_produk') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="kategori" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Kategori Produk <span class="text-red-500">*</span></label>
                    <select name="kategori" id="kategori" required 
                            class="w-full px-4 py-2 bg-slate-50 dark:bg-[#0f0f0f] dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-transparent outline-none transition-all">
                        <option value="">Pilih Kategori</option>
                        <option value="Kuliner" {{ old('kategori', $umkm->kategori) == 'Kuliner' ? 'selected' : '' }}>Kuliner / Makanan</option>
                        <option value="Kesehatan" {{ old('kategori', $umkm->kategori) == 'Kesehatan' ? 'selected' : '' }}>Kesehatan / Herbal</option>
                        <option value="Kerajinan" {{ old('kategori', $umkm->kategori) == 'Kerajinan' ? 'selected' : '' }}>Kerajinan Tangan</option>
                        <option value="Pertanian" {{ old('kategori', $umkm->kategori) == 'Pertanian' ? 'selected' : '' }}>Hasil Pertanian</option>
                        <option value="Lainnya" {{ old('kategori', $umkm->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('kategori') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="harga" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Harga (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" name="harga" id="harga" required value="{{ old('harga', rtrim(rtrim($umkm->harga, '0'), '.')) }}" 
                           class="w-full px-4 py-2 bg-slate-50 dark:bg-[#0f0f0f] dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-transparent outline-none transition-all">
                    @error('harga') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="unit" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Satuan Harga <span class="text-red-500">*</span></label>
                    <input type="text" name="unit" id="unit" required value="{{ old('unit', $umkm->unit) }}" 
                           class="w-full px-4 py-2 bg-slate-50 dark:bg-[#0f0f0f] dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-transparent outline-none transition-all">
                    @error('unit') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Informasi Penjual -->
        <div class="space-y-4 pt-4">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-700 pb-2">Informasi Penjual</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama_penjual" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Nama Toko / Penjual <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_penjual" id="nama_penjual" required value="{{ old('nama_penjual', $umkm->nama_penjual) }}" 
                           class="w-full px-4 py-2 bg-slate-50 dark:bg-[#0f0f0f] dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-transparent outline-none transition-all">
                    @error('nama_penjual') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="no_whatsapp" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Nomor WhatsApp <span class="text-slate-600 dark:text-slate-300 font-normal">(Opsional)</span></label>
                    <input type="text" name="no_whatsapp" id="no_whatsapp" value="{{ old('no_whatsapp', $umkm->no_whatsapp) }}" 
                           class="w-full px-4 py-2 bg-slate-50 dark:bg-[#0f0f0f] dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-transparent outline-none transition-all">
                    <p class="text-xs text-slate-500 dark:text-slate-300 dark:text-white mt-1">Gunakan format awalan 62. Contoh: 62822...</p>
                    @error('no_whatsapp') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Detail Tambahan -->
        <div class="space-y-4 pt-4">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-700 pb-2">Detail Tambahan</h3>
            
            <div>
                <label for="deskripsi" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Deskripsi Produk</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" 
                          class="w-full px-4 py-2 bg-slate-50 dark:bg-[#0f0f0f] dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-transparent outline-none transition-all">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                @error('deskripsi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <x-admin.image-upload name="gambar" label="Foto Produk (Opsional)" helper="Biarkan kosong jika tidak ingin mengubah foto" :currentImage="$umkm->gambar" />
        </div>

        <div class="pt-6 border-t border-slate-100 dark:border-slate-700 flex items-center justify-end gap-3">
            <a href="{{ route('admin.umkm.index') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-300 dark:text-white hover:text-slate-900 dark:text-white bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">Batal</a>
            <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-700 hover:bg-blue-800 rounded-xl shadow-sm transition-all duration-200 hover:-translate-y-0.5">
                Perbarui Produk
            </button>
        </div>
    </form>
</div>
@endsection
