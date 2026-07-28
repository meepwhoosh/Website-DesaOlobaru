@extends('layouts.admin')

@section('title', 'Riwayat Pengunjung')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white">Riwayat Pengunjung</h1>
        <p class="text-slate-500 dark:text-slate-300 dark:text-white mt-1">Pantau statistik dan riwayat kunjungan website Anda.</p>
    </div>
    <form action="{{ route('admin.pengunjung.reset') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset/menghapus semua data pengunjung? Tindakan ini tidak dapat dibatalkan.')">
        @csrf
        @method('DELETE')
        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            Reset Semua Data
        </button>
    </form>
</div>

<!-- Overview Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white dark:bg-[#1a1a1a] p-6 rounded-2xl border border-slate-200 dark:border-white/10 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300 flex items-center justify-center shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-500 dark:text-slate-300 dark:text-white uppercase tracking-widest mb-1">Total Pengunjung</p>
            <h3 class="text-2xl font-black text-slate-800 dark:text-white">{{ number_format($totalVisitors, 0, ',', '.') }}</h3>
        </div>
    </div>
    
    <div class="bg-white dark:bg-[#1a1a1a] p-6 rounded-2xl border border-slate-200 dark:border-white/10 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-300 flex items-center justify-center shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-500 dark:text-slate-300 dark:text-white uppercase tracking-widest mb-1">Hari Ini</p>
            <h3 class="text-2xl font-black text-slate-800 dark:text-white">{{ number_format($visitorsToday, 0, ',', '.') }}</h3>
        </div>
    </div>

    <div class="bg-white dark:bg-[#1a1a1a] p-6 rounded-2xl border border-slate-200 dark:border-white/10 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-orange-50 dark:bg-orange-900/30 text-orange-600 dark:text-orange-300 flex items-center justify-center shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-500 dark:text-slate-300 dark:text-white uppercase tracking-widest mb-1">Minggu Ini</p>
            <h3 class="text-2xl font-black text-slate-800 dark:text-white">{{ number_format($visitorsThisWeek, 0, ',', '.') }}</h3>
        </div>
    </div>

    <div class="bg-white dark:bg-[#1a1a1a] p-6 rounded-2xl border border-slate-200 dark:border-white/10 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 flex items-center justify-center shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-500 dark:text-slate-300 dark:text-white uppercase tracking-widest mb-1">Bulan Ini</p>
            <h3 class="text-2xl font-black text-slate-800 dark:text-white">{{ number_format($visitorsThisMonth, 0, ',', '.') }}</h3>
        </div>
    </div>
</div>

<div class="bg-white dark:bg-[#1a1a1a] border border-slate-200 dark:border-white/10 rounded-2xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-slate-200 dark:border-white/10 bg-slate-50 dark:bg-[#0f0f0f] dark:bg-[#141414]">
        <h3 class="font-bold text-lg text-slate-800 dark:text-white">Daftar Log Pengunjung Terbaru</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-[#0f0f0f] dark:bg-[#141414] border-b border-slate-200 dark:border-white/10 text-sm text-slate-600 dark:text-slate-300 dark:text-white uppercase tracking-wider">
                    <th class="px-6 py-4 font-semibold">Waktu Akses</th>
                    <th class="px-6 py-4 font-semibold">Alamat IP</th>
                    <th class="px-6 py-4 font-semibold">URL yang Dikunjungi</th>
                    <th class="px-6 py-4 font-semibold">Browser / Perangkat</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-white/10">
                @forelse($visitorLogs as $log)
                <tr class="hover:bg-slate-50 dark:bg-[#0f0f0f] dark:bg-slate-800 dark:hover:bg-[#202020] transition-colors">
                    <td class="px-6 py-4 text-sm text-slate-900 dark:text-white font-medium whitespace-nowrap">
                        {{ \Carbon\Carbon::parse($log->created_at)->translatedFormat('d M Y, H:i') }}
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300 dark:text-white whitespace-nowrap">
                        <span class="bg-slate-100 dark:bg-white/10 text-slate-600 dark:text-slate-300 dark:text-white px-2.5 py-1 rounded-md font-mono text-xs">{{ $log->ip_address }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-blue-600 dark:text-blue-300">
                        <a href="{{ $log->visited_url }}" target="_blank" class="hover:underline line-clamp-1 max-w-xs" title="{{ $log->visited_url }}">{{ $log->visited_url }}</a>
                    </td>
                    <td class="px-6 py-4 text-xs text-slate-500 dark:text-slate-300 dark:text-white">
                        <span class="line-clamp-2" title="{{ $log->user_agent }}">{{ $log->user_agent ?: 'Tidak Diketahui' }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-slate-500 dark:text-slate-300 dark:text-white">
                        Belum ada data pengunjung.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($visitorLogs->hasPages())
    <div class="p-6 border-t border-slate-200 dark:border-white/10 bg-white dark:bg-[#1a1a1a]">
        {{ $visitorLogs->links() }}
    </div>
    @endif
</div>
@endsection
