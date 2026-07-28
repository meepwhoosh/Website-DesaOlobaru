@extends('layouts.admin')

@section('title', 'Edit Misi Desa')

@section('content')
<div class="mb-8">
    <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-300 dark:text-white mb-2">
        <a href="{{ route('admin.misi.index') }}" class="hover:text-green-700 transition-colors">Misi Desa</a>
        <span>/</span>
        <span class="text-slate-900 dark:text-white font-medium">Edit Misi</span>
    </div>
    <h1 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white">Ubah Data Misi</h1>
    <p class="text-slate-500 dark:text-slate-300 dark:text-white mt-1">Perbarui urutan dan penjelasan dari poin misi.</p>
</div>

<div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm overflow-hidden max-w-3xl">
    <form action="{{ route('admin.misi.update', $misi->id) }}" method="POST" class="p-6 sm:p-8 space-y-6">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            
            <div>
                <label for="urutan" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Nomor Urut <span class="text-red-500">*</span></label>
                <input type="number" name="urutan" id="urutan" required value="{{ old('urutan', $misi->urutan) }}" min="1"
                       class="w-full max-w-xs px-4 py-2 bg-slate-50 dark:bg-[#0f0f0f] dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-transparent outline-none transition-all">
                @error('urutan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="konten" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Isi Misi <span class="text-red-500">*</span></label>
                <textarea name="konten" id="konten" rows="5" required
                          class="w-full px-4 py-2 bg-slate-50 dark:bg-[#0f0f0f] dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-transparent outline-none transition-all">{{ old('konten', $misi->konten) }}</textarea>
                @error('konten') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            
        </div>

        <div class="pt-6 border-t border-slate-100 dark:border-slate-700 flex items-center justify-end gap-3">
            <a href="{{ route('admin.misi.index') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-300 dark:text-white hover:text-slate-900 dark:text-white bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">Batal</a>
            <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-700 hover:bg-blue-800 rounded-xl shadow-sm transition-all duration-200 hover:-translate-y-0.5">
                Perbarui Misi
            </button>
        </div>
    </form>
</div>
@endsection
