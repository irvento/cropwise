<!-- resources/views/sidenav-menu.blade.php -->
<aside class="w-72 h-full glass-sidebar flex flex-col z-20 overflow-y-auto scrollbar-hide">
    <div class="px-8 py-10">
        <div class="flex items-center space-x-3 mb-10">
            <div class="w-10 h-10 bg-primary-500 rounded-xl flex items-center justify-center shadow-lg shadow-primary-500/20">
                <i class="fas fa-leaf text-white text-xl"></i>
            </div>
            <span class="text-2xl font-bold tracking-tight text-white">Cropwise<span class="text-primary-400">.</span></span>
        </div>

        <nav class="space-y-1">
            @if(auth()->user()->role_id === 1)
            <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500 mb-4 px-4">Management</p>
            
            <a href="{{ route('dashboard') }}" class="flex items-center group space-x-4 text-slate-400 hover:text-white transition-all duration-300 px-4 py-3 rounded-xl hover:bg-white/5 {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white shadow-xl shadow-black/20' : '' }}">
                <i class="fas fa-columns text-lg group-hover:text-primary-400 transition-colors {{ request()->routeIs('dashboard') ? 'text-primary-400' : '' }}"></i>
                <span class="font-medium">Dashboard</span>
            </a>

            <a href="{{ route('farm.index') }}" class="flex items-center group space-x-4 text-slate-400 hover:text-white transition-all duration-300 px-4 py-3 rounded-xl hover:bg-white/5 {{ request()->routeIs('farm.*') ? 'bg-white/10 text-white shadow-xl shadow-black/20' : '' }}">
                <i class="fas fa-tractor text-lg group-hover:text-primary-400 transition-colors {{ request()->routeIs('farm.*') ? 'text-primary-400' : '' }}"></i>
                <span class="font-medium">Farm Ops</span>
            </a>

            <a href="{{ route('admin.schedule.index') }}" class="flex items-center group space-x-4 text-slate-400 hover:text-white transition-all duration-300 px-4 py-3 rounded-xl hover:bg-white/5">
                <i class="fas fa-calendar-alt text-lg group-hover:text-primary-400 transition-colors"></i>
                <span class="font-medium">Scheduling</span>
            </a>

            <a href="{{ route('admin.inventory.index') }}" class="flex items-center group space-x-4 text-slate-400 hover:text-white transition-all duration-300 px-4 py-3 rounded-xl hover:bg-white/5">
                <i class="fas fa-box-open text-lg group-hover:text-primary-400 transition-colors"></i>
                <span class="font-medium">Inventory</span>
            </a>

            <a href="{{ route('admin.finance.index') }}" class="flex items-center group space-x-4 text-slate-400 hover:text-white transition-all duration-300 px-4 py-3 rounded-xl hover:bg-white/5">
                <i class="fas fa-receipt text-lg group-hover:text-primary-400 transition-colors"></i>
                <span class="font-medium">Finance</span>
            </a>

            <a href="{{ route('hr.index') }}" class="flex items-center group space-x-4 text-slate-400 hover:text-white transition-all duration-300 px-4 py-3 rounded-xl hover:bg-white/5">
                <i class="fas fa-user-friends text-lg group-hover:text-primary-400 transition-colors"></i>
                <span class="font-medium">Resources</span>
            </a>

            @elseif(auth()->user()->role_id === 2)
            <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500 mb-4 px-4">Employee Portal</p>
            <!-- Employee Menu Items -->
            <a href="{{ route('dashboard') }}" class="flex items-center group space-x-4 text-slate-400 hover:text-white transition-all duration-300 px-4 py-3 rounded-xl hover:bg-white/5">
                <i class="fas fa-columns text-lg group-hover:text-primary-400"></i>
                <span class="font-medium">Dashboard</span>
            </a>

            <a href="{{ route('user.tasks.index') }}" class="flex items-center group space-x-4 text-slate-400 hover:text-white transition-all duration-300 px-4 py-3 rounded-xl hover:bg-white/5">
                <i class="fas fa-tasks text-lg group-hover:text-primary-400"></i>
                <span class="font-medium">My Tasks</span>
            </a>

            <a href="{{ route('user.leave-requests.index') }}" class="flex items-center group space-x-4 text-slate-400 hover:text-white transition-all duration-300 px-4 py-3 rounded-xl hover:bg-white/5">
                <i class="fas fa-clock text-lg group-hover:text-primary-400"></i>
                <span class="font-medium">Leave Requests</span>
            </a>

            <a href="{{ route('user.payroll.index') }}" class="flex items-center group space-x-4 text-slate-400 hover:text-white transition-all duration-300 px-4 py-3 rounded-xl hover:bg-white/5">
                <i class="fas fa-wallet text-lg group-hover:text-primary-400"></i>
                <span class="font-medium">Payroll</span>
            </a>
            @endif

            <div class="pt-10 pb-4">
                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500 mb-4 px-4">System</p>
                <a href="{{ route('profile.show') }}" class="flex items-center group space-x-4 text-slate-400 hover:text-white transition-all duration-300 px-4 py-3 rounded-xl hover:bg-white/5">
                    <i class="fas fa-cog text-lg group-hover:text-primary-400"></i>
                    <span class="font-medium">Settings</span>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="flex items-center group space-x-4 w-full text-left text-red-500/80 hover:text-red-400 transition-all duration-300 px-4 py-3 rounded-xl hover:bg-red-500/5">
                        <i class="fas fa-power-off text-lg"></i>
                        <span class="font-medium">Sign Out</span>
                    </button>
                </form>
            </div>
        </nav>
    </div>

    <!-- User Section Bottom -->
    <div class="mt-auto p-8 border-t border-white/5">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-full bg-slate-800 border border-white/10 flex items-center justify-center overflow-hidden">
                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
            </div>
            <div class="flex flex-col overflow-hidden">
                <span class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</span>
                <span class="text-[10px] text-slate-500 font-medium truncate uppercase tracking-tighter">{{ auth()->user()->role_id === 1 ? 'Administrator' : 'Field Specialist' }}</span>
            </div>
        </div>
    </div>
</aside>