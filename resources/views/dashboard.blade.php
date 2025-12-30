<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl sm:text-3xl text-white tracking-tight">
                {{ __('Executive Dashboard') }}
            </h2>
            <div class="flex items-center space-x-2 sm:space-x-4">
                <span class="sm:flex hidden items-center px-3 py-1 bg-primary-500/20 rounded-full text-primary-400 text-xs font-bold uppercase tracking-wider">
                    <span class="w-1.5 h-1.5 bg-primary-500 rounded-full mr-2 animate-pulse"></span>
                    Live Data
                </span>
                <span class="text-slate-400 text-[10px] sm:text-sm font-medium">{{ now()->format('l, F j, Y') }}</span>
            </div>
        </div>
    </x-slot>

    @if(auth()->user()->role_id === 1)
    <div class="space-y-8">
        <!-- Key Metrics -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $metrics = [
                    ['title' => 'Total Fields', 'value' => $totalFields ?? 0, 'icon' => 'fa-map-marked-alt', 'color' => 'primary'],
                    ['title' => 'Active Crops', 'value' => $activeCrops ?? 0, 'icon' => 'fa-seedling', 'color' => 'emerald'],
                    ['title' => 'Pending Tasks', 'value' => $pendingTasks ?? 0, 'icon' => 'fa-tasks', 'color' => 'amber'],
                    ['title' => 'Total Workforce', 'value' => $totalEmployees ?? 0, 'icon' => 'fa-users', 'color' => 'indigo'],
                ];
            @endphp

            @foreach($metrics as $metric)
            <div class="glass-card p-6 flex items-center justify-between hover:scale-[1.02] transition-transform duration-300 group cursor-pointer">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">{{ $metric['title'] }}</p>
                    <p class="text-3xl font-black text-white leading-none">{{ $metric['value'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-{{ $metric['color'] }}-500/10 flex items-center justify-center border border-{{ $metric['color'] }}-500/20 group-hover:bg-{{ $metric['color'] }}-500 group-hover:text-white transition-all duration-300 text-{{ $metric['color'] }}-400">
                    <i class="fas {{ $metric['icon'] }} text-xl"></i>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Quick Access Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $quickActions = [
                    [
                        'route' => route('farm.index'),
                        'icon' => 'fa-tractor',
                        'title' => 'Farm Operations',
                        'desc' => 'Manage fields, crops, and live livestock tracking.',
                        'accent' => 'primary'
                    ],
                    [
                        'route' => route('admin.schedule.index'),
                        'icon' => 'fa-calendar-alt',
                        'title' => 'Agronomic Calendar',
                        'desc' => 'Planting, harvesting, and daily operations management.',
                        'accent' => 'accent'
                    ],
                    [
                        'route' => route('hr.index'),
                        'icon' => 'fa-id-badge',
                        'title' => 'Resource Center',
                        'desc' => 'Workforce management, payroll, and attendance.',
                        'accent' => 'indigo'
                    ],
                    [
                        'route' => route('admin.inventory.index'),
                        'icon' => 'fa-warehouse',
                        'title' => 'Inventory Matrix',
                        'desc' => 'Real-time supply chain and equipment tracking.',
                        'accent' => 'emerald'
                    ],
                    [
                        'route' => route('admin.finance.index'),
                        'icon' => 'fa-chart-pie',
                        'title' => 'Financial Analytics',
                        'desc' => 'Cashflow, expenses, and strategic projections.',
                        'accent' => 'primary'
                    ],
                    [
                        'route' => route('weather.show', $currentCity ?? 'Manolo Fortich'),
                        'icon' => 'fa-cloud-sun-rain',
                        'title' => 'Climate Insights',
                        'desc' => 'Advanced weather forecasting and field conditions.',
                        'accent' => 'amber'
                    ],
                ];
            @endphp

            @foreach($quickActions as $action)
            <a href="{{ $action['route'] }}" class="glass-card overflow-hidden group">
                <div class="px-8 py-10 relative">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-slate-800/50 flex items-center justify-center border border-white/5 group-hover:border-primary-500/50 transition-colors duration-300">
                            <i class="fas {{ $action['icon'] }} text-2xl text-slate-400 group-hover:text-primary-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white group-hover:text-primary-400 transition-colors duration-300">{{ $action['title'] }}</h3>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed mb-6">{{ $action['desc'] }}</p>
                    <div class="flex items-center text-primary-400 text-xs font-bold uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-all duration-500 translate-x-[-10px] group-hover:translate-x-0">
                        Launch Module <i class="fas fa-arrow-right ml-2 text-[10px]"></i>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Insights Layer -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Schedules -->
            <div class="glass-card flex flex-col h-full">
                <div class="px-8 py-6 border-b border-white/5 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-white flex items-center">
                        <i class="fas fa-history text-primary-400 mr-3"></i> Strategic Feed
                    </h3>
                    <a href="{{ route('admin.schedule.index') }}" class="text-[10px] font-bold text-slate-500 uppercase tracking-widest hover:text-primary-400 transition-colors">View All</a>
                </div>
                <div class="p-8 space-y-6">
                    @forelse($recentSchedules as $schedule)
                        <div class="flex items-start space-x-4 group">
                            <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center border border-white/5 flex-shrink-0 group-hover:bg-primary-500/20 transition-colors">
                                <i class="fas {{ $schedule->icon ?? 'fa-circle' }} text-sm text-slate-500 group-hover:text-primary-400"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start mb-1">
                                    <h4 class="text-sm font-bold text-white truncate">{{ $schedule->title }}</h4>
                                    <span class="text-[10px] text-slate-500 uppercase font-black">{{ \Carbon\Carbon::parse($schedule->planting_date ?? $schedule->date)->diffForHumans() }}</span>
                                </div>
                                <p class="text-xs text-slate-400 line-clamp-1">{{ $schedule->description }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="py-10 text-center">
                            <p class="text-slate-500 text-sm font-medium">No strategic updates available</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Financial Pulse -->
            <div class="glass-card flex flex-col h-full">
                <div class="px-8 py-6 border-b border-white/5 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-white flex items-center">
                        <i class="fas fa-chart-line text-emerald-400 mr-3"></i> Financial Pulse
                    </h3>
                    <div class="px-3 py-1 bg-emerald-500/10 rounded-full text-[10px] font-bold text-emerald-400 uppercase tracking-widest">
                        MTD Analysis
                    </div>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-2 gap-6 mb-10">
                        <div class="relative">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2 px-1">Net Income</p>
                            <div class="bg-primary-500/5 border border-primary-500/10 rounded-2xl p-6">
                                <p class="text-2xl font-black text-primary-400">₱{{ number_format($financialSummary['income'], 2) }}</p>
                            </div>
                        </div>
                        <div class="relative">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2 px-1">Expenditure</p>
                            <div class="bg-red-500/5 border border-red-500/10 rounded-2xl p-6">
                                <p class="text-2xl font-black text-red-500/80">₱{{ number_format($financialSummary['expenses'], 2) }}</p>
                            </div>
                        </div>
                    </div>
                    
                    @if($weather)
                    <div class="bg-slate-900/40 rounded-3xl p-8 border border-white/5 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-primary-500/10 blur-[40px] rounded-full translate-x-8 translate-y--8"></div>
                        <div class="flex items-center justify-between relative z-10">
                            <div class="flex items-center space-x-6">
                                <div class="text-5xl font-black text-white">{{ $weather['temperature'] }}°C</div>
                                <div>
                                    <p class="text-sm font-bold text-white capitalize">{{ $weather['description'] }}</p>
                                    <p class="text-xs text-slate-500">Relative Humidity: {{ $weather['humidity'] }}%</p>
                                </div>
                            </div>
                            <img src="https://openweathermap.org/img/wn/{{ $weather['icon'] }}@2x.png" alt="Weather" class="w-20 drop-shadow-[0_0_15px_rgba(255,255,255,0.2)]">
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(auth()->user()->role_id === 2)
    <div class="space-y-8">
        <!-- Personnel Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Attendance Terminal -->
            <div class="glass-card p-10 flex flex-col justify-center items-center text-center relative overflow-hidden group">
                <div class="absolute inset-0 bg-primary-500/5 opacity-50 group-hover:opacity-100 transition-opacity"></div>
                <div class="w-20 h-20 rounded-3xl bg-primary-500 flex items-center justify-center shadow-2xl shadow-primary-500/40 mb-6 relative z-10">
                    <i class="fas fa-clock text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-black text-white mb-2 relative z-10">Shift Terminal</h3>
                <p class="text-slate-500 text-sm font-medium mb-8 uppercase tracking-[0.2em] relative z-10">{{ now()->format('H:i') }} - Status: {{ ucfirst(str_replace('_', ' ', $todayAttendanceStatus)) }}</p>
                
                <div class="w-full relative z-10">
                    @if($todayAttendanceStatus === 'not_checked_in')
                        <form action="{{ route('dashboard.time-in') }}" method="POST" class="time-in-form">
                            @csrf
                            <button type="submit" class="w-full bg-primary-500 hover:bg-primary-600 text-white font-bold py-4 px-8 rounded-2xl shadow-xl shadow-primary-500/20 transition-all duration-300 transform hover:scale-[1.02]">
                                Initialize Shift
                            </button>
                        </form>
                    @elseif($todayAttendanceStatus === 'present' || $todayAttendanceStatus === 'late')
                        <form action="{{ route('dashboard.time-out') }}" method="POST" class="time-out-form">
                            @csrf
                            <button type="submit" class="w-full bg-red-500/80 hover:bg-red-500 text-white font-bold py-4 px-8 rounded-2xl shadow-xl shadow-red-500/20 transition-all duration-300 transform hover:scale-[1.02]">
                                Terminate Shift
                            </button>
                        </form>
                    @elseif($todayAttendanceStatus === 'checked_out')
                        <div class="bg-emerald-500/10 border border-emerald-500/20 py-4 px-8 rounded-2xl">
                            <p class="text-emerald-400 font-bold uppercase tracking-widest text-sm">Shift Completed <i class="fas fa-check-circle ml-2"></i></p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Task Central -->
            <a href="{{ route('user.tasks.index') }}" class="glass-card p-10 flex items-center justify-between group overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary-500/5 blur-[40px] rounded-full translate-x-12 translate-y--12"></div>
                <div class="relative z-10">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2">Active Assignments</p>
                    <h3 class="text-4xl font-black text-white mb-4 group-hover:text-primary-400 transition-colors">{{ $upcomingTasks->count() }}</h3>
                    <p class="text-slate-400 text-sm font-medium group-hover:translate-x-1 transition-transform inline-flex items-center">Execute Tasks <i class="fas fa-arrow-right ml-2 text-[10px]"></i></p>
                </div>
                <div class="w-16 h-16 rounded-2xl bg-slate-800/50 flex items-center justify-center border border-white/5 relative z-10">
                    <i class="fas fa-clipboard-list text-2xl text-primary-400"></i>
                </div>
            </a>

            <!-- Payroll Summary -->
            <a href="{{ route('user.payroll.index') }}" class="glass-card p-10 flex items-center justify-between group overflow-hidden">
                <div class="absolute bottom-0 right-0 w-32 h-32 bg-emerald-500/5 blur-[40px] rounded-full translate-x-12 translate-y-12"></div>
                <div class="relative z-10">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2">Earnings Balance</p>
                    <h3 class="text-3xl font-black text-white mb-4">₱{{ number_format($latestPayroll->net_salary ?? 0, 2) }}</h3>
                    <p class="text-slate-400 text-sm font-medium group-hover:translate-x-1 transition-transform inline-flex items-center">Review Details <i class="fas fa-arrow-right ml-2 text-[10px]"></i></p>
                </div>
                <div class="w-16 h-16 rounded-2xl bg-slate-800/50 flex items-center justify-center border border-white/5 relative z-10">
                    <i class="fas fa-wallet text-2xl text-emerald-400"></i>
                </div>
            </a>
        </div>

        <!-- Task & Requests Feed -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="glass-card">
                <div class="px-8 py-6 border-b border-white/5 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-white">Pending Assignments</h3>
                    <i class="fas fa-tasks text-primary-400"></i>
                </div>
                <div class="p-8 space-y-4">
                    @forelse($recentTasks->take(3) as $task)
                        <div class="bg-white/5 rounded-2xl p-5 border border-white/5 hover:border-primary-500/30 transition-all duration-300">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="text-white font-bold text-sm">{{ $task->title }}</h4>
                                <span class="text-[10px] font-black uppercase tracking-wider text-primary-400">{{ $task->status }}</span>
                            </div>
                            <p class="text-xs text-slate-400">Deadline: {{ $task->due_date->format('M d, Y') }}</p>
                        </div>
                    @empty
                        <p class="text-slate-500 text-center py-6">No tasks assigned</p>
                    @endforelse
                </div>
            </div>

            <div class="glass-card">
                <div class="px-8 py-6 border-b border-white/5 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-white">Leave Protocol</h3>
                    <i class="fas fa-plane-departure text-indigo-400"></i>
                </div>
                <div class="p-8 space-y-4">
                    @forelse($recentLeaveRequests->take(3) as $leave)
                        <div class="bg-white/5 rounded-2xl p-5 border border-white/5 flex items-center justify-between">
                            <div>
                                <h4 class="text-white font-bold text-sm">{{ $leave->leave_type }}</h4>
                                <p class="text-xs text-slate-500">{{ $leave->start_date->format('M d') }} - {{ $leave->end_date->format('M d') }}</p>
                            </div>
                            <span class="px-3 py-1 bg-slate-800 rounded-lg text-[10px] font-black uppercase tracking-wider text-slate-400">
                                {{ $leave->status }}
                            </span>
                        </div>
                    @empty
                        <p class="text-slate-500 text-center py-6">No leave protocols initialized</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>

<!-- Personnel Registration Terminal -->
<div id="employeeModal" class="fixed inset-0 z-[100] hidden">
    <div class="fixed inset-0 bg-slate-950/90 backdrop-blur-xl"></div>
    <div class="fixed inset-0 flex items-center justify-center p-6">
        <div class="glass-card max-w-lg w-full p-10 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-primary-500"></div>
            <div class="mb-8">
                <h3 class="text-3xl font-black text-white mb-2">Identity Registration</h3>
                <p class="text-slate-400 text-sm">Please provide your professional credentials to initialize your personnel profile.</p>
            </div>
            
            <form action="{{ route('employee.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 block px-1">First Name</label>
                        <input type="text" name="first_name" required class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-all outline-none">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 block px-1">Last Name</label>
                        <input type="text" name="last_name" required class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-all outline-none">
                    </div>
                </div>
                <div>
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 block px-1">Contact Protocol</label>
                    <input type="text" name="contact_number" required placeholder="+63 XXX XXX XXXX" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-all outline-none">
                </div>
                <div>
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 block px-1">Primary Address</label>
                    <textarea name="address" required rows="2" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-all outline-none resize-none"></textarea>
                </div>
                
                <button type="submit" class="w-full bg-primary-500 hover:bg-primary-600 text-white font-bold py-4 rounded-xl shadow-xl shadow-primary-500/20 transition-all duration-300">
                    Confirm Identity
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check if user is registered as employee
    fetch('{{ route("employee.check") }}')
        .then(response => response.json())
        .then(data => {
            if (!data.isRegistered) {
                document.getElementById('employeeModal').classList.remove('hidden');
            }
        })
        .catch(error => console.error('Error:', error));

    // Handle time in form submission
    const timeInForm = document.querySelector('.time-in-form');
    if (timeInForm) {
        timeInForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Disable the button to prevent double submission
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            submitButton.disabled = true;
            submitButton.innerHTML = 'Checking in...';
            
            fetch(this.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
                }
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error.message || 'An error occurred while checking in');
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            });
        });
    }

    // Handle time out form submission
    const timeOutForm = document.querySelector('.time-out-form');
    if (timeOutForm) {
        timeOutForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = 'Checking out...';
            
            fetch(this.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
                }
                window.location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error.message || 'An error occurred while checking out');
                submitButton.disabled = false;
                submitButton.innerHTML = 'Terminate Shift';
            });
        });
    }
});
</script>
