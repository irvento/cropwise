<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tight mb-1">
                    {{ __('Human Capital Matrix') }}
                </h2>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-[0.2em]">Personnel Intelligence & Payroll Systems</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('hr.payroll.index') }}" class="glass-button px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest text-slate-400 border border-white/5 hover:bg-white/5 transition-all flex-1 sm:flex-none text-center">
                    <i class="fas fa-file-invoice-dollar mr-2"></i> Payroll
                </a>
                <a href="{{ route('hr.attendance.index') }}" class="glass-button px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest text-slate-400 border border-white/5 hover:bg-white/5 transition-all flex-1 sm:flex-none text-center">
                    <i class="fas fa-clock mr-2"></i> Attendance
                </a>
                <a href="{{ route('hr.create') }}" class="glass-button bg-primary-500 hover:bg-primary-600 px-6 py-2.5 rounded-xl text-white font-black uppercase tracking-widest text-xs shadow-xl shadow-primary-500/10 transition-all flex-1 sm:flex-none text-center">
                    <i class="fas fa-plus-circle mr-2"></i> Onboard Personnel
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        @if (session('success'))
            <div class="glass-card border-emerald-500/20 bg-emerald-500/5 p-4 flex items-center space-x-4">
                <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white">
                    <i class="fas fa-check text-xs"></i>
                </div>
                <p class="text-emerald-400 text-sm font-bold">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Personnel Dashboard Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($employees as $employee)
                <div class="glass-card group relative overflow-hidden flex flex-col transition-all duration-500 hover:translate-y-[-4px]">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary-500/5 blur-[50px] rounded-full translate-x-10 translate-y--10"></div>
                    
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-4">
                                <div class="w-14 h-14 rounded-2xl bg-slate-800 border-2 border-white/5 flex items-center justify-center font-black text-2xl text-primary-400 shadow-2xl">
                                    {{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="text-white font-black text-lg leading-tight">{{ $employee->first_name }} {{ $employee->last_name }}</h4>
                                    <p class="text-primary-400 text-[10px] font-black uppercase tracking-widest mt-1">{{ $employee->position }}</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 text-[9px] font-black uppercase tracking-widest rounded-full border 
                                {{ $employee->status === 'active' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : 'bg-red-500/10 text-red-500 border-red-500/20' }}">
                                {{ $employee->status }}
                            </span>
                        </div>

                        <div class="space-y-4 mb-8">
                            <div class="flex items-center text-[11px] font-bold text-slate-500">
                                <i class="fas fa-id-badge w-6 text-slate-700"></i>
                                <span class="uppercase tracking-tighter mr-2">Contact:</span>
                                <span class="text-slate-300">{{ $employee->contact_number }}</span>
                            </div>
                            <div class="flex items-center text-[11px] font-bold text-slate-500">
                                <i class="fas fa-calendar-check w-6 text-slate-700"></i>
                                <span class="uppercase tracking-tighter mr-2">Deployed:</span>
                                <span class="text-slate-300">{{ $employee->hire_date ? $employee->hire_date->format('M d, Y') : 'PENDING' }}</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-6 border-t border-white/5">
                            <div class="flex -space-x-2">
                                <div class="w-8 h-8 rounded-lg bg-slate-800 border border-white/5 flex items-center justify-center text-slate-500 hover:text-primary-400 transition-colors cursor-help" title="View Training Data">
                                    <i class="fas fa-graduation-cap text-[10px]"></i>
                                </div>
                                <div class="w-8 h-8 rounded-lg bg-slate-800 border border-white/5 flex items-center justify-center text-slate-500 hover:text-amber-400 transition-colors cursor-help" title="Performance Metrics">
                                    <i class="fas fa-chart-line text-[10px]"></i>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('hr.show', $employee->id) }}" class="w-8 h-8 rounded-lg bg-slate-800 border border-white/5 flex items-center justify-center text-slate-500 hover:text-white hover:bg-primary-500 transition-all">
                                    <i class="fas fa-eye text-[10px]"></i>
                                </a>
                                <a href="{{ route('hr.edit', $employee->id) }}" class="w-8 h-8 rounded-lg bg-slate-800 border border-white/5 flex items-center justify-center text-slate-500 hover:text-white hover:bg-amber-500 transition-all">
                                    <i class="fas fa-edit text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Activity & Intelligence Streams -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Terminal: Leave Protocol Approvals -->
            <div class="glass-card overflow-hidden">
                <div class="p-6 border-b border-white/5 flex items-center justify-between bg-white/[0.01]">
                    <h3 class="text-[10px] font-black text-white uppercase tracking-widest flex items-center">
                        <i class="fas fa-plane-departure mr-2 text-purple-400"></i> Leave Protocols
                    </h3>
                    <a href="{{ route('hr.leave-requests.index') }}" class="text-[10px] font-black text-primary-400 uppercase tracking-widest hover:text-white transition-colors">Audit »</a>
                </div>
                <div class="p-6 space-y-4">
                    @forelse($recentLeaveRequests as $request)
                        <div class="p-4 rounded-xl bg-slate-900/50 border border-white/5 hover:border-purple-500/30 transition-all">
                            <div class="flex justify-between items-start mb-2">
                                <p class="text-white font-bold text-xs">{{ $request->employee->first_name }} {{ $request->employee->last_name }}</p>
                                <span class="text-[8px] font-black uppercase px-2 py-0.5 rounded-md border 
                                    {{ $request->status === 'approved' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : 
                                       ($request->status === 'pending' ? 'bg-amber-500/10 text-amber-500 border-amber-500/20' : 'bg-red-500/10 text-red-500 border-red-500/20') }}">
                                    {{ $request->status }}
                                </span>
                            </div>
                            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-tighter">
                                {{ $request->start_date ? $request->start_date->format('M d') : '??' }} — {{ $request->end_date ? $request->end_date->format('M d') : '??' }}
                            </p>
                        </div>
                    @empty
                        <p class="text-slate-600 text-[10px] font-black uppercase text-center py-10 tracking-widest">No active requests</p>
                    @endforelse
                </div>
            </div>

            <!-- Terminal: Real-time Attendance Monitor -->
            <div class="glass-card overflow-hidden">
                <div class="p-6 border-b border-white/5 flex items-center justify-between bg-white/[0.01]">
                    <h3 class="text-[10px] font-black text-white uppercase tracking-widest flex items-center">
                        <i class="fas fa-fingerprint mr-2 text-amber-400"></i> Attendance Stream
                    </h3>
                    <a href="{{ route('hr.attendance.index') }}" class="text-[10px] font-black text-primary-400 uppercase tracking-widest hover:text-white transition-colors">Monitor »</a>
                </div>
                <div class="p-6 space-y-4">
                    @forelse($todayAttendance as $attendance)
                        <div class="p-4 rounded-xl bg-slate-900/50 border border-white/5 hover:border-amber-500/30 transition-all">
                            <div class="flex justify-between items-start mb-2">
                                <p class="text-white font-bold text-xs">{{ $attendance->employee->first_name }} {{ $attendance->employee->last_name }}</p>
                                <span class="text-[8px] font-black uppercase px-2 py-0.5 rounded-md border 
                                    {{ $attendance->status === 'present' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : 
                                       ($attendance->status === 'late' ? 'bg-amber-500/10 text-amber-500 border-amber-500/20' : 'bg-red-500/10 text-red-500 border-red-500/20') }}">
                                    {{ $attendance->status }}
                                </span>
                            </div>
                            <div class="flex items-center text-[10px] font-bold text-slate-500">
                                <i class="fas fa-sign-in-alt mr-2 text-slate-700"></i>
                                <span>{{ $attendance->check_in ? $attendance->check_in->format('h:i A') : 'OFFLINE' }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-600 text-[10px] font-black uppercase text-center py-10 tracking-widest">Sector Inactive</p>
                    @endforelse
                </div>
            </div>

            <!-- Terminal: Payroll Disbursements -->
            <div class="glass-card overflow-hidden">
                <div class="p-6 border-b border-white/5 flex items-center justify-between bg-white/[0.01]">
                    <h3 class="text-[10px] font-black text-white uppercase tracking-widest flex items-center">
                        <i class="fas fa-coins mr-2 text-primary-400"></i> Fiscal Registry
                    </h3>
                    <a href="{{ route('hr.payroll.index') }}" class="text-[10px] font-black text-primary-400 uppercase tracking-widest hover:text-white transition-colors">Ledger »</a>
                </div>
                <div class="p-6 space-y-4">
                    @forelse($recentPayrolls as $payroll)
                        <div class="p-4 rounded-xl bg-slate-900/50 border border-white/5 hover:border-primary-500/30 transition-all">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-white font-bold text-xs">{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</p>
                                    <p class="text-[10px] font-black text-slate-600 uppercase mt-1">{{ $payroll->payroll_date ? $payroll->payroll_date->format('M d, Y') : '??' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-white font-black text-sm">₱{{ number_format($payroll->net_salary, 0) }}</p>
                                    <p class="text-[8px] font-black text-primary-500 uppercase tracking-widest">Disbursed</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-600 text-[10px] font-black uppercase text-center py-10 tracking-widest">No recent entries</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>