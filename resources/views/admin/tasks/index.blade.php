<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tight mb-1">
                    {{ __('Task Matrix') }}
                </h2>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-[0.2em]">Operational Workflow & Protocol Dispatch</p>
            </div>
            <a href="{{ route('admin.tasks.create') }}" class="glass-button bg-primary-500 hover:bg-primary-600 px-6 py-3 rounded-xl text-white font-black uppercase tracking-widest text-[10px] shadow-xl shadow-primary-500/10 transition-all flex items-center justify-center">
                <i class="fas fa-plus-circle mr-2"></i> Dispatch New Protocol
            </a>
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

        <!-- Priority Intelligence Filter -->
        <div class="glass-card p-6">
            <form action="{{ route('admin.tasks.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative group">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-600 group-focus-within:text-primary-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="w-full bg-slate-900/50 border border-white/5 rounded-xl pl-12 pr-4 py-3 text-white text-xs font-bold focus:border-primary-500/50 outline-none transition-all placeholder-slate-700"
                        placeholder="QUERY PROTOCOL BY TITLE, DESCRIPTION, OR PERSONNEL...">
                </div>
                <div class="flex gap-2">
                    @if(request('search'))
                        <a href="{{ route('admin.tasks.index') }}" class="px-6 py-3 bg-slate-800 text-slate-400 rounded-xl text-[10px] font-black uppercase tracking-widest hover:text-white border border-white/5 transition-all">TERMINATE QUERY</a>
                    @endif
                    <button type="submit" class="px-8 py-3 bg-primary-500 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-primary-600 transition-all shadow-lg shadow-primary-500/20">
                        SCAN MATRIX
                    </button>
                </div>
            </form>
        </div>

        <!-- Matrix Grid -->
        <div class="glass-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-white/[0.01]">
                            <th class="px-8 py-5 text-left text-[9px] font-black text-slate-500 uppercase tracking-widest border-b border-white/5">Protocol Identifier</th>
                            <th class="px-8 py-5 text-left text-[9px] font-black text-slate-500 uppercase tracking-widest border-b border-white/5">Assigned Unit</th>
                            <th class="px-8 py-5 text-left text-[9px] font-black text-slate-500 uppercase tracking-widest border-b border-white/5">Chronos Output</th>
                            <th class="px-8 py-5 text-left text-[9px] font-black text-slate-500 uppercase tracking-widest border-b border-white/5">Priority Level</th>
                            <th class="px-8 py-5 text-left text-[9px] font-black text-slate-500 uppercase tracking-widest border-b border-white/5">Operational Status</th>
                            <th class="px-8 py-5 text-right text-[9px] font-black text-slate-500 uppercase tracking-widest border-b border-white/5">Executables</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($tasks as $task)
                            <tr class="group hover:bg-white/[0.01] transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-white font-bold text-sm">{{ $task->title }}</span>
                                        <span class="text-[10px] text-slate-600 font-bold uppercase mt-1 truncate max-w-[200px]">{{ $task->description }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-lg bg-slate-800 border border-white/5 flex items-center justify-center font-black text-[10px] text-primary-400">
                                            {{ substr($task->employee->first_name, 0, 1) }}{{ substr($task->employee->last_name, 0, 1) }}
                                        </div>
                                        <span class="text-xs text-slate-300 font-bold">{{ $task->employee->first_name }} {{ $task->employee->last_name }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-white font-black text-[10px] uppercase">{{ $task->due_date->format('M d, Y') }}</span>
                                        <span class="text-[9px] text-slate-600 font-black uppercase mt-1">{{ $task->due_date->diffForHumans() }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    @php
                                        $priorityColors = [
                                            'high' => 'red',
                                            'medium' => 'amber',
                                            'low' => 'emerald',
                                        ];
                                        $pColor = $priorityColors[$task->priority] ?? 'slate';
                                    @endphp
                                    <span class="px-3 py-1 text-[8px] font-black uppercase tracking-widest rounded-md border bg-{{ $pColor }}-500/10 text-{{ $pColor }}-500 border-{{ $pColor }}-500/20">
                                        {{ $task->priority }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    @php
                                        $statusColors = [
                                            'completed' => 'emerald',
                                            'in_progress' => 'primary',
                                            'pending' => 'slate',
                                        ];
                                        $sColor = $statusColors[$task->status] ?? 'slate';
                                    @endphp
                                    <div class="flex items-center space-x-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-{{ $sColor }}-500 {{ $task->status === 'in_progress' ? 'animate-pulse' : '' }}"></span>
                                        <span class="text-[9px] font-black text-{{ $sColor }}-400 uppercase tracking-widest">{{ str_replace('_', ' ', $task->status) }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.tasks.show', $task) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-900 border border-white/5 text-slate-500 hover:text-white hover:bg-primary-500 transition-all">
                                            <i class="fas fa-eye text-[10px]"></i>
                                        </a>
                                        <a href="{{ route('admin.tasks.edit', $task) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-900 border border-white/5 text-slate-500 hover:text-white hover:bg-amber-500 transition-all">
                                            <i class="fas fa-edit text-[10px]"></i>
                                        </a>
                                        <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Initiate protocol termination?')" class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-900 border border-white/5 text-slate-500 hover:text-white hover:bg-red-500 transition-all">
                                                <i class="fas fa-trash-alt text-[10px]"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 rounded-2xl bg-slate-900 flex items-center justify-center mb-6 border border-white/5">
                                            <i class="fas fa-list-check text-2xl text-slate-700"></i>
                                        </div>
                                        <p class="text-slate-500 font-bold uppercase tracking-widest text-[10px]">Matrix empty: All protocols synchronized</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8">
            {{ $tasks->links() }}
        </div>
    </div>
</x-app-layout>
