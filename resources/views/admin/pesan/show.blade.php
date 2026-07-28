@extends('layouts.admin')

@section('title', 'Detail Pesan')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Detail Pesan</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400">Membaca pesan dari pengunjung website.</p>
    </div>
    <a href="{{ route('admin.pesan.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
</div>

<div class="bg-white dark:bg-[#1e293b] rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700/50 overflow-hidden">
    <div class="p-6 md:p-8">
        
        <!-- Header Info -->
        <div class="flex flex-col md:flex-row md:items-start justify-between gap-6 pb-6 border-b border-slate-100 dark:border-slate-700/50">
            <div class="space-y-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">{{ $pesan->subjek }}</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Dikirim pada {{ $pesan->created_at->format('d F Y, H:i') }}
                    </p>
                </div>
                
                <div class="flex items-center gap-4 p-4 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-100 dark:border-slate-700">
                    <div class="w-12 h-12 bg-green-100 text-green-700 rounded-full flex items-center justify-center font-bold text-xl uppercase">
                        {{ substr($pesan->nama_pengirim, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $pesan->nama_pengirim }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">{{ $pesan->email_hp }}</p>
                    </div>
                </div>
            </div>
            
            <div class="shrink-0 flex flex-col gap-3">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Aksi Balasan</p>
                
                @php
                    // Helper to check if it's likely a phone number
                    $isPhone = preg_match('/^[0-9\-\+\s]+$/', $pesan->email_hp);
                    $waLink = $isPhone ? 'https://wa.me/'.preg_replace('/[^0-9]/', '', $pesan->email_hp) : '#';
                @endphp
                
                <a href="{{ $isPhone ? $waLink : '#' }}" target="{{ $isPhone ? '_blank' : '' }}" class="inline-flex items-center justify-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-xl text-sm font-semibold transition-colors shadow-sm {{ !$isPhone ? 'opacity-50 cursor-not-allowed' : '' }}" title="{{ !$isPhone ? 'Format bukan nomor telepon' : '' }}">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.031 2C6.486 2 2 6.486 2 12.031a9.99 9.99 0 001.328 4.962L2.102 22l5.148-1.203a9.973 9.973 0 004.781 1.203h.005c5.543 0 10.026-4.486 10.026-10.031C22 6.486 17.514 2 12.031 2zm0 18.337c-1.574 0-3.118-.423-4.468-1.222l-.321-.189-3.325.776.79-3.242-.208-.33a8.318 8.318 0 01-1.267-4.437C3.232 7.234 7.234 3.232 12.031 3.232c4.796 0 8.798 4.002 8.798 8.799 0 4.797-4.002 8.799-8.798 8.799zm4.819-6.576c-.264-.132-1.564-.772-1.806-.861-.241-.088-.418-.132-.594.132-.176.264-.683.861-.837 1.037-.154.176-.309.198-.573.066a7.228 7.228 0 01-2.122-1.309 8.01 8.01 0 01-1.474-1.834c-.154-.264-.017-.407.116-.538.118-.118.264-.309.396-.462.132-.154.176-.264.264-.441.088-.176.044-.33-.022-.462-.066-.132-.594-1.433-.815-1.962-.215-.515-.434-.445-.594-.453-.154-.007-.33-.008-.507-.008-.176 0-.462.066-.705.33-.242.264-.925.903-.925 2.202 0 1.299.947 2.555 1.079 2.731.132.176 1.863 2.846 4.515 3.99.631.272 1.123.435 1.508.556.634.199 1.211.171 1.666.104.509-.076 1.564-.639 1.785-1.256.221-.617.221-1.146.154-1.256-.066-.11-.242-.176-.507-.309z"/></svg>
                    Balas via WhatsApp
                </a>
                
                <a href="mailto:{{ $pesan->email_hp }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-semibold transition-colors shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Balas via Email
                </a>
            </div>
        </div>
        
        <!-- Message Body -->
        <div class="py-8">
            <div class="prose dark:prose-invert max-w-none text-slate-700 dark:text-slate-300 whitespace-pre-wrap leading-relaxed">{{ $pesan->isi_pesan }}</div>
        </div>
        
    </div>
</div>
@endsection
