@extends('layouts.admin')

@section('title', 'Pesan Masuk')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Pesan Masuk</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400">Kelola pesan dari form Hubungi Kami.</p>
    </div>
</div>

@if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white dark:bg-[#1e293b] rounded-xl shadow-sm border border-slate-200 dark:border-slate-700/50 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 text-sm">
                    <th class="px-6 py-4 font-medium text-slate-600 dark:text-slate-300">No</th>
                    <th class="px-6 py-4 font-medium text-slate-600 dark:text-slate-300">Pengirim</th>
                    <th class="px-6 py-4 font-medium text-slate-600 dark:text-slate-300">Subjek</th>
                    <th class="px-6 py-4 font-medium text-slate-600 dark:text-slate-300">Status</th>
                    <th class="px-6 py-4 font-medium text-slate-600 dark:text-slate-300">Tanggal</th>
                    <th class="px-6 py-4 font-medium text-slate-600 dark:text-slate-300">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                @forelse($pesans as $pesan)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors {{ $pesan->status === 'Belum Dibaca' ? 'bg-blue-50/30 dark:bg-blue-900/10' : '' }}">
                    <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-slate-900 dark:text-white">{{ $pesan->nama_pengirim }}</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">{{ $pesan->email }}</div>
                        @if($pesan->no_hp)
                            <div class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">HP: {{ $pesan->no_hp }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm font-medium">{{ $pesan->subjek }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-lg {{ $pesan->status === 'Belum Dibaca' ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300' }}">
                            {{ $pesan->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400">
                        {{ $pesan->created_at->format('d M Y, H:i') }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.pesan.show', $pesan->id) }}" title="Buka Pesan" class="p-2 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-900/50 rounded-xl transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            </a>
                            <form action="{{ route('admin.pesan.destroy', $pesan->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus pesan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Hapus Pesan" class="p-2 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/50 rounded-xl transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                        Belum ada pesan masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
