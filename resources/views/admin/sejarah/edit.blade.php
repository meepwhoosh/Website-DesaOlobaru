@extends('layouts.admin')

@section('title', 'Edit Riwayat Sejarah')

@section('content')
<div class="mb-8">
    <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
        <a href="{{ route('admin.sejarah.index') }}" class="hover:text-green-700 transition-colors">Sejarah Desa</a>
        <span>/</span>
        <span class="text-slate-900 font-medium">Edit Riwayat</span>
    </div>
    <h1 class="text-2xl md:text-3xl font-bold text-slate-900">Ubah Data Sejarah</h1>
    <p class="text-slate-500 mt-1">Perbarui jejak rekam sejarah pembentukan atau peristiwa penting desa.</p>
</div>

<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden max-w-3xl">
    <form action="{{ route('admin.sejarah.update', $sejarah->id) }}" method="POST" class="p-6 sm:p-8 space-y-6">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            
            <div>
                <label for="tahun" class="block text-sm font-semibold text-slate-700 mb-1.5">Tahun Kejadian <span class="text-red-500">*</span></label>
                <input type="text" name="tahun" id="tahun" required value="{{ old('tahun', $sejarah->tahun) }}" 
                       class="w-full max-w-xs px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-transparent outline-none transition-all">
                @error('tahun') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="judul" class="block text-sm font-semibold text-slate-700 mb-1.5">Judul Peristiwa <span class="text-red-500">*</span></label>
                <input type="text" name="judul" id="judul" required value="{{ old('judul', $sejarah->judul) }}" 
                       class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-transparent outline-none transition-all">
                @error('judul') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="konten" class="block text-sm font-semibold text-slate-700 mb-1.5">Uraian Sejarah <span class="text-red-500">*</span></label>
                <textarea name="konten" id="konten" rows="6" required
                          class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-transparent outline-none transition-all">{{ old('konten', $sejarah->konten) }}</textarea>
                @error('konten') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            
        </div>

        <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.sejarah.index') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">Batal</a>
            <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-700 hover:bg-blue-800 rounded-xl shadow-sm transition-all duration-200 hover:-translate-y-0.5">
                Perbarui Sejarah
            </button>
        </div>
    </form>
</div>
@endsection
