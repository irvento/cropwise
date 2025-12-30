<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tight mb-1">
                    {{ __('Operations Hub') }}
                </h2>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-[0.2em]">Agricultural Asset Command</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.tasks.index') }}" class="glass-button px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-widest text-primary-400 border border-primary-500/20 hover:bg-primary-500/10 transition-all">
                    <i class="fas fa-list-check mr-2"></i> Task Matrix
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Live Intelligence -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Environmental Sensors -->
            <div class="lg:col-span-2 glass-card p-8 flex items-center justify-between relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-primary-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="flex items-center space-x-10 relative z-10">
                    <div class="text-center px-4">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">Location Chronos</p>
                        <p class="text-4xl font-black text-white leading-none">{{ now()->format('H:i') }}</p>
                        <p class="text-[10px] font-bold text-primary-400 mt-2">{{ now()->format('M d, Y') }}</p>
                    </div>
                    <div class="h-16 w-px bg-white/5"></div>
                    <div class="flex items-center space-x-6">
                        @if(isset($weatherData))
                            <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center border border-white/5 shadow-inner">
                                <img src="{{ $weatherData['icon'] }}" alt="Weather" class="w-12 h-12 drop-shadow-lg">
                            </div>
                            <div>
                                <p class="text-3xl font-black text-white">{{ $weatherData['temp_c'] }}<span class="text-primary-400">°C</span></p>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Atmospheric Condition</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="hidden md:block relative z-10">
                    <div class="flex space-x-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="w-2 h-2 rounded-full bg-emerald-500/40"></span>
                        <span class="w-2 h-2 rounded-full bg-emerald-500/20"></span>
                    </div>
                </div>
            </div>

            <!-- Task Quick-Link -->
            <a href="{{ route('admin.tasks.index') }}" class="glass-card p-8 flex items-center group">
                <div class="w-14 h-14 rounded-2xl bg-primary-500/20 flex items-center justify-center border border-primary-500/20 group-hover:bg-primary-500 group-hover:text-white transition-all duration-500 mr-6">
                    <i class="fas fa-tasks text-xl text-primary-400 group-hover:text-white"></i>
                </div>
                <div>
                    <h4 class="text-white font-black text-lg group-hover:text-primary-400 transition-colors">Task Protocols</h4>
                    <p class="text-slate-500 text-xs font-medium">Manage operational workflows</p>
                </div>
                <i class="fas fa-chevron-right ml-auto text-slate-700 group-hover:text-primary-400 group-hover:translate-x-1 transition-all"></i>
            </a>
        </div>

        <!-- Primary Management Grids -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
                $modules = [
                    [
                        'title' => 'Crops',
                        'icon' => 'fa-seedling',
                        'route' => route('admin.crops.index'),
                        'color' => 'emerald',
                        'desc' => 'Genetic and cultivation tracking',
                        'img' => 'https://cdn-icons-png.flaticon.com/128/9923/9923298.png'
                    ],
                    [
                        'title' => 'Livestock',
                        'icon' => 'fa-cow',
                        'route' => route('admin.farm.livestock.index'),
                        'color' => 'amber',
                        'desc' => 'Biological asset management',
                        'img' => 'https://cdn-icons-png.flaticon.com/128/3397/3397478.png'
                    ],
                    [
                        'title' => 'Fields',
                        'icon' => 'fa-map-marked-alt',
                        'route' => route('admin.fields.index'),
                        'color' => 'indigo',
                        'desc' => 'Geospatial plot monitoring',
                        'img' => 'https://cdn-icons-png.flaticon.com/128/9923/9923298.png'
                    ],
                    [
                        'title' => 'Logistics',
                        'icon' => 'fa-truck-loading',
                        'route' => route('admin.inventory.index'),
                        'color' => 'primary',
                        'desc' => 'Supply chain & equipment matrix',
                        'img' => 'https://cdn-icons-png.flaticon.com/128/2897/2897616.png'
                    ],
                ];
            @endphp

            @foreach($modules as $mod)
            <a href="{{ $mod['route'] }}" class="glass-card group p-8 relative overflow-hidden flex flex-col items-center text-center">
                <div class="absolute top-0 right-0 w-24 h-24 bg-{{ $mod['color'] }}-500/5 blur-[30px] rounded-full translate-x-10 translate-y--10"></div>
                
                <div class="w-20 h-20 rounded-full bg-slate-800 border-2 border-white/5 p-4 mb-6 group-hover:scale-110 group-hover:border-{{ $mod['color'] }}-500/50 transition-all duration-500 shadow-2xl">
                    <img src="{{ $mod['img'] }}" alt="{{ $mod['title'] }}" class="w-full h-full object-contain grayscale group-hover:grayscale-0 transition-all duration-500">
                </div>
                
                <h3 class="text-xl font-black text-white group-hover:text-{{ $mod['color'] }}-400 transition-colors mb-2">{{ $mod['title'] }}</h3>
                <p class="text-slate-500 text-xs font-medium leading-tight">{{ $mod['desc'] }}</p>
                
                <div class="mt-8 flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-{{ $mod['color'] }}-500/60 group-hover:text-{{ $mod['color'] }}-400 transition-colors">
                    <span>Initialize</span>
                    <i class="fas fa-plus-circle"></i>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Integrated Analytics Preview -->
        <div class="glass-card p-10 flex flex-col md:flex-row items-center justify-between border-primary-500/10 bg-primary-500/[0.02]">
            <div class="flex items-center space-x-8 mb-6 md:mb-0">
                <div class="w-16 h-16 rounded-2xl bg-primary-500 flex items-center justify-center shadow-xl shadow-primary-500/20">
                    <i class="fas fa-chart-pie text-2xl text-white"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-white mb-1">Financial Intelligence</h3>
                    <p class="text-slate-500 text-sm font-medium">Real-time fiscal monitoring and yield projections.</p>
                </div>
            </div>
            <a href="{{ route('admin.finance.index') }}" class="glass-button bg-primary-500 hover:bg-primary-600 px-10 py-4 rounded-2xl text-white font-black uppercase tracking-widest text-xs shadow-2xl shadow-primary-500/20 transition-all hover:scale-[1.05]">
                Launch Ledger
            </a>
        </div>
    </div>
</x-app-layout>