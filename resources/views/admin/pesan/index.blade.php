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
                        <div class="text-xs text-slate-500 dark:text-slate-400">{{ $pesan->email_hp }}</div>
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
                    <td class="px-6 py-4 space-x-2">
                        <a href="{{ route('admin.pesan.show', $pesan->id) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-lg text-sm font-medium transition-colors">
                            Buka
                        </a>
                        <form action="{{ route('admin.pesan.destroy', $pesan->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus pesan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 hover:bg-red-200 rounded-lg text-sm font-medium transition-colors">
                                Hapus
                            </button>
                        </form>
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
