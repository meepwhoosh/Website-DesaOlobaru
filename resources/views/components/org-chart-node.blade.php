
@props(['node'])

<li>
    <div class="inline-flex flex-col items-center">
        <!-- Node Card -->
        <div class="px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-xs text-center shadow-sm w-44 z-10 mx-2 relative group hover:border-green-500 hover:shadow-md transition-all">
            <div class="flex justify-center mb-1.5">
                <div class="w-12 h-12 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden">
                    @if($node->gambar)
                        <img src="{{ asset('storage/' . $node->gambar) }}" class="w-full h-full object-cover">
                    @else
                        <svg class="w-6 h-6 text-slate-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    @endif
                </div>
            </div>
            <span class="text-[9px] text-green-700 font-bold uppercase block mb-1 break-words leading-tight">{{ $node->jabatan }}</span>
            <span class="font-bold text-slate-900 dark:text-white block leading-tight truncate px-1" title="{{ $node->nama }}">{{ $node->nama ?? '-' }}</span>
        </div>
    </div>
    
    @if($node->children && $node->children->count() > 0)
        <ul>
            @foreach($node->children as $child)
                <x-org-chart-node :node="$child" />
            @endforeach
        </ul>
    @endif
</li>

