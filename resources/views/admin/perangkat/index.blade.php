@extends('layouts.admin')

@section('title', 'Kelola Perangkat Desa & BPD')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900">Struktur Organisasi</h1>
        <p class="text-slate-500 mt-1">Kelola data aparatur Pemerintah Desa dan anggota BPD.</p>
    </div>
    <a href="{{ route('admin.perangkat.create') }}" class="inline-flex items-center justify-center gap-2 bg-green-700 hover:bg-green-800 text-white px-5 py-2.5 rounded-xl font-semibold shadow-sm transition-all duration-200 hover:-translate-y-0.5">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Anggota
    </a>
</div>

@if(session('success'))
<div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-100 flex items-start gap-3">
    <div class="text-green-600 mt-0.5">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    </div>
    <div>
        <h4 class="text-sm font-semibold text-green-800">Berhasil!</h4>
        <p class="text-sm text-green-700">{{ session('success') }}</p>
    </div>
</div>
@endif

@php
    $pemdes = $perangkats->where('kategori', 'pemdes');
    $bpd = $perangkats->where('kategori', 'bpd');
@endphp

<div x-data="{ activeTab: 'pemdes' }">
    <!-- Tab Navigation -->
    <div class="flex items-center gap-2 mb-6 border-b border-slate-200 pb-px">
        <button @click="activeTab = 'pemdes'" 
                :class="activeTab === 'pemdes' ? 'border-green-600 text-green-700 bg-green-50' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'"
                class="px-5 py-2.5 font-semibold text-sm border-b-2 transition-colors rounded-t-xl">
            Pemerintah Desa (Pemdes)
        </button>
        <button @click="activeTab = 'bpd'" 
                :class="activeTab === 'bpd' ? 'border-blue-600 text-blue-700 bg-blue-50' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'"
                class="px-5 py-2.5 font-semibold text-sm border-b-2 transition-colors rounded-t-xl">
            Badan Permusyawaratan Desa (BPD)
        </button>
    </div>

    <!-- Bar/Seksi PEMDES -->
    <div x-show="activeTab === 'pemdes'" class="mb-8" style="display: none;" x-transition.opacity>
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-sm text-slate-600 uppercase tracking-wider">
                            <th class="px-6 py-4 font-semibold">Profil</th>
                            <th class="px-6 py-4 font-semibold">Nama & Jabatan</th>
                            <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse($pemdes as $perangkat)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                @if($perangkat->gambar)
                                    <img src="{{ asset('storage/' . $perangkat->gambar) }}" alt="{{ $perangkat->nama }}" class="w-12 h-12 rounded-full object-cover border border-slate-200">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900">{{ $perangkat->nama }}</p>
                                <p class="text-sm text-slate-500 mt-0.5">{{ $perangkat->jabatan }}</p>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.perangkat.edit', $perangkat->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors">Edit</a>
                                    
                                    <form action="{{ route('admin.perangkat.destroy', $perangkat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aparatur ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-slate-500">
                                Belum ada data struktur Pemerintah Desa.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bar/Seksi BPD -->
    <div x-show="activeTab === 'bpd'" class="mb-4" style="display: none;" x-transition.opacity>
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-sm text-slate-600 uppercase tracking-wider">
                            <th class="px-6 py-4 font-semibold">Profil</th>
                            <th class="px-6 py-4 font-semibold">Nama & Jabatan</th>
                            <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse($bpd as $perangkat)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                @if($perangkat->gambar)
                                    <img src="{{ asset('storage/' . $perangkat->gambar) }}" alt="{{ $perangkat->nama }}" class="w-12 h-12 rounded-full object-cover border border-slate-200">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900">{{ $perangkat->nama }}</p>
                                <p class="text-sm text-slate-500 mt-0.5">{{ $perangkat->jabatan }}</p>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.perangkat.edit', $perangkat->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors">Edit</a>
                                    
                                    <form action="{{ route('admin.perangkat.destroy', $perangkat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aparatur ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-slate-500">
                                Belum ada data anggota BPD.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
