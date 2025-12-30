<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tight mb-1">
                    {{ __('Crop Matrix') }}
                </h2>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-[0.2em]">Genetic Asset Catalog</p>
            </div>
            <a href="{{ route('admin.crops.create') }}" class="glass-button bg-primary-500 hover:bg-primary-600 px-6 py-3 rounded-xl text-white font-black uppercase tracking-widest text-[10px] shadow-2xl shadow-primary-500/20 transition-all text-center">
                <i class="fas fa-plus-circle mr-2"></i> Register New Crop
            </a>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Search & Filter Terminal -->
        <div class="glass-card p-6">
            <form action="{{ route('admin.crops.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="w-full bg-slate-900/50 border border-white/10 rounded-xl pl-12 pr-4 py-3 text-white placeholder-slate-500 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-all outline-none text-sm"
                        placeholder="Search by crop name, variety, or conditions...">
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.crops.index') }}" class="px-6 py-3 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded-xl text-xs font-bold uppercase tracking-widest transition-all flex items-center">
                        Reset
                    </a>
                    <button type="submit" class="px-8 py-3 bg-primary-500/10 hover:bg-primary-500/20 text-primary-400 border border-primary-500/20 rounded-xl text-xs font-bold uppercase tracking-widest transition-all">
                        Execute Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Data Grid -->
        <div class="glass-card overflow-hidden">
            <div class="overflow-x-auto scrollbar-hide">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-white/5 bg-white/[0.02]">
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500">Name / Variety</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500">Growth Cycle</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500">Optimum Conditions</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500">Strategic Field</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 text-right">Operations</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($crops as $crop)
                            <tr class="group hover:bg-white/[0.02] transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 rounded-xl bg-slate-800 border border-white/10 flex items-center justify-center group-hover:border-primary-500/50 transition-colors">
                                            <i class="fas fa-seedling text-primary-400"></i>
                                        </div>
                                        <div>
                                            <p class="text-white font-bold text-sm">{{ $crop->name }}</p>
                                            <p class="text-slate-500 text-[10px] uppercase font-black tracking-widest">{{ $crop->variety }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-white font-bold text-sm">{{ $crop->growth_duration }}</span>
                                        <span class="text-slate-500 text-[10px] uppercase font-black tracking-tighter">Days</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-slate-400 text-xs leading-relaxed max-w-xs truncate">{{ $crop->conditions }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="inline-flex items-center px-3 py-1 bg-indigo-500/10 rounded-full text-indigo-400 text-[10px] font-bold uppercase tracking-wider border border-indigo-500/20">
                                        <i class="fas fa-map-pin mr-2 text-[8px]"></i>
                                        {{ $crop->mainField->name ?? 'Unassigned' }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.crops.show', $crop) }}" class="w-9 h-9 rounded-lg bg-slate-800 flex items-center justify-center text-slate-400 hover:text-primary-400 hover:bg-primary-500/10 transition-all border border-white/5" title="View Dossier">
                                            <i class="fas fa-eye text-xs"></i>
                                        </a>
                                        <a href="{{ route('admin.crops.edit', $crop) }}" class="w-9 h-9 rounded-lg bg-slate-800 flex items-center justify-center text-slate-400 hover:text-amber-400 hover:bg-amber-500/10 transition-all border border-white/5" title="Modify Asset">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                        <a href="{{ route('admin.crops.schedules', $crop) }}" class="w-9 h-9 rounded-lg bg-slate-800 flex items-center justify-center text-slate-400 hover:text-emerald-400 hover:bg-emerald-500/10 transition-all border border-white/5" title="Planting Protocols">
                                            <i class="fas fa-calendar-alt text-xs"></i>
                                        </a>
                                        <form action="{{ route('admin.crops.destroy', $crop) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Initiate asset decommissioning protocol?')" class="w-9 h-9 rounded-lg bg-slate-800 flex items-center justify-center text-slate-400 hover:text-red-400 hover:bg-red-500/10 transition-all border border-white/5" title="Decommission">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 rounded-3xl bg-slate-900 border border-white/5 flex items-center justify-center mb-4">
                                            <i class="fas fa-folder-open text-slate-700 text-2xl"></i>
                                        </div>
                                        <p class="text-slate-500 text-sm font-medium">No records found in crop matrix.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($crops->hasPages())
                <div class="px-8 py-6 border-t border-white/5 bg-white/[0.01]">
                    {{ $crops->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>