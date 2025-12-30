<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tight mb-1">
                    {{ __('Field Matrix') }}
                </h2>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-[0.2em]">Geospatial Asset Monitoring</p>
            </div>
            <a href="{{ route('admin.fields.create') }}" class="glass-button bg-primary-500 hover:bg-primary-600 px-6 py-3 rounded-xl text-white font-black uppercase tracking-widest text-[10px] shadow-xl shadow-primary-500/10 transition-all flex items-center justify-center">
                <i class="fas fa-plus-circle mr-2"></i> Register New Sector
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Search & Analytical Control -->
        <div class="glass-card p-6">
            <form action="{{ route('admin.fields.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-satellite text-slate-500 group-focus-within:text-primary-400 transition-colors"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="w-full bg-slate-900/50 border border-white/5 rounded-2xl pl-12 pr-4 py-4 text-white text-sm focus:border-primary-500/50 focus:ring-1 focus:ring-primary-500/50 transition-all outline-none placeholder-slate-600"
                        placeholder="Scan by sector name, location, soil profile, or status...">
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.fields.index') }}" class="px-6 py-4 bg-slate-800/50 text-slate-400 border border-white/5 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-white/5 hover:text-white transition-all">
                        Reset
                    </a>
                    <button type="submit" class="px-8 py-4 bg-primary-500 text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-primary-600 shadow-lg shadow-primary-500/20 transition-all">
                        Execute Scan
                    </button>
                </div>
            </form>
        </div>

        @if(session('success'))
            <div class="glass-card border-emerald-500/20 bg-emerald-500/5 p-4 flex items-center space-x-4">
                <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white">
                    <i class="fas fa-check text-xs"></i>
                </div>
                <p class="text-emerald-400 text-sm font-bold">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Monitoring Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($fields as $field)
                <div class="glass-card group p-8 relative overflow-hidden flex flex-col transition-all duration-500 hover:translate-y-[-4px]">
                    <div class="absolute top-0 right-0 p-6">
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $field->status === 'Active' ? 'bg-emerald-500/10 text-emerald-500 border border-emerald-500/20' : 'bg-slate-500/10 text-slate-500 border border-slate-500/20' }}">
                            {{ $field->status }}
                        </span>
                    </div>

                    <div class="mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-slate-800 border border-white/5 flex items-center justify-center mb-4 transition-colors group-hover:border-primary-500/30">
                            <i class="fas fa-layer-group text-xl text-slate-500 group-hover:text-primary-400"></i>
                        </div>
                        <h3 class="text-xl font-black text-white group-hover:text-primary-400 transition-colors uppercase tracking-tight">{{ $field->name }}</h3>
                        <p class="text-slate-500 text-xs font-bold flex items-center mt-1 uppercase tracking-widest">
                            <i class="fas fa-map-marker-alt mr-2 text-primary-500/50"></i> {{ $field->location }}
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 py-4 border-y border-white/5 mb-6">
                        <div>
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Scale</p>
                            <p class="text-white font-bold">{{ $field->size }} <span class="text-slate-500 text-[10px]">HA</span></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Soil Profile</p>
                            <p class="text-white font-bold text-sm">{{ $field->soil_type }}</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-auto">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.fields.show', $field) }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-800 text-slate-400 hover:text-white hover:bg-primary-500 transition-all border border-white/5">
                                <i class="fas fa-eye text-xs"></i>
                            </a>
                            <a href="{{ route('admin.fields.edit', $field) }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-800 text-slate-400 hover:text-white hover:bg-amber-500 transition-all border border-white/5">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                        </div>
                        <form action="{{ route('admin.fields.destroy', $field) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-800 text-slate-400 hover:text-white hover:bg-red-500 transition-all border border-white/5">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="lg:col-span-3 glass-card p-20 text-center">
                    <div class="w-20 h-20 rounded-3xl bg-slate-900 flex items-center justify-center mb-6 border border-white/5 mx-auto">
                        <i class="fas fa-satellite-dish text-3xl text-slate-700"></i>
                    </div>
                    <p class="text-slate-500 font-bold uppercase tracking-widest text-xs">No sectors detected in deployment grid</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $fields->links() }}
        </div>
    </div>
</x-app-layout>
 