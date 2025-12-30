<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tight mb-1">
                    {{ __('Fiscal Ledger') }}
                </h2>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-[0.2em]">Financial Intelligence & Oversight</p>
            </div>
            <a href="{{ route('admin.finance.create') }}" class="glass-button bg-primary-500 hover:bg-primary-600 px-6 py-3 rounded-xl text-white font-black uppercase tracking-widest text-[10px] shadow-xl shadow-primary-500/10 transition-all flex items-center justify-center">
                <i class="fas fa-plus-circle mr-2"></i> Register Account
            </a>
        </div>
    </x-slot>

    <div class="space-y-8">
        @if(session('success'))
            <div class="glass-card border-emerald-500/20 bg-emerald-500/5 p-4 flex items-center space-x-4">
                <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white">
                    <i class="fas fa-check text-xs"></i>
                </div>
                <p class="text-emerald-400 text-sm font-bold">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Global Liquidity Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $financeMetrics = [
                    [
                        'label' => 'Total Liquidity',
                        'value' => $accounts->where('type', 'income')->sum('balance'),
                        'icon' => 'fa-wallet',
                        'color' => 'emerald',
                        'desc' => 'Aggregated incoming assets'
                    ],
                    [
                        'label' => 'Operational Expenditure',
                        'value' => $accounts->where('type', 'expense')->sum('balance'),
                        'icon' => 'fa-file-invoice-dollar',
                        'color' => 'red',
                        'desc' => 'Resource consumption costs'
                    ],
                    [
                        'label' => 'Fixed Capital',
                        'value' => $accounts->where('type', 'asset')->sum('balance'),
                        'icon' => 'fa-landmark',
                        'color' => 'blue',
                        'desc' => 'Infrastructure & hardware'
                    ],
                    [
                        'label' => 'Pending Liabilities',
                        'value' => $accounts->where('type', 'liability')->sum('balance'),
                        'icon' => 'fa-hand-holding-usd',
                        'color' => 'amber',
                        'desc' => 'Debt & recurring obligations'
                    ],
                ];
            @endphp

            @foreach($financeMetrics as $metric)
                <div class="glass-card group p-6 relative overflow-hidden flex flex-col transition-all duration-500 hover:translate-y-[-2px]">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <i class="fas {{ $metric['icon'] }} text-4xl text-{{ $metric['color'] }}-400"></i>
                    </div>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">{{ $metric['label'] }}</p>
                    <div class="flex items-baseline space-x-1 mb-2">
                        <span class="text-slate-400 font-bold">₱</span>
                        <h3 class="text-2xl font-black text-white leading-none tracking-tight">{{ number_format($metric['value'], 0) }}</h3>
                    </div>
                    <p class="text-[9px] text-{{ $metric['color'] }}-500/70 font-black uppercase tracking-widest mt-auto">{{ $metric['desc'] }}</p>
                </div>
            @endforeach
        </div>

        <!-- Ledger Matrix -->
        <div class="glass-card overflow-hidden">
            <div class="p-8 border-b border-white/5 flex flex-col md:flex-row md:items-center justify-between bg-white/[0.01] gap-4">
                <h3 class="text-[10px] font-black text-white uppercase tracking-widest flex items-center">
                    <i class="fas fa-microchip mr-2 text-primary-400"></i> Account Synchronization Grid
                </h3>
                <form action="{{ route('admin.finance.index') }}" method="GET" class="flex gap-3">
                    <div class="relative group">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-600 group-focus-within:text-primary-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}" 
                            class="bg-slate-900/50 border border-white/5 rounded-xl pl-10 pr-4 py-2 text-white text-xs font-bold focus:border-primary-500/50 outline-none w-64"
                            placeholder="QUERY ACCOUNT NAME OR TYPE...">
                    </div>
                    @if(request('search'))
                        <a href="{{ route('admin.finance.index') }}" class="px-4 py-2 bg-slate-800 text-slate-400 rounded-xl text-[9px] font-black uppercase tracking-widest hover:text-white border border-white/5 transition-all">Clear</a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-slate-900/20">
                            <th class="px-8 py-5 text-left text-[9px] font-black text-slate-500 uppercase tracking-widest border-b border-white/5">Account Name</th>
                            <th class="px-8 py-5 text-left text-[9px] font-black text-slate-500 uppercase tracking-widest border-b border-white/5">Classification</th>
                            <th class="px-8 py-5 text-left text-[9px] font-black text-slate-500 uppercase tracking-widest border-b border-white/5">Net Balance</th>
                            <th class="px-8 py-5 text-left text-[9px] font-black text-slate-500 uppercase tracking-widest border-b border-white/5">Last Sync</th>
                            <th class="px-8 py-5 text-right text-[9px] font-black text-slate-500 uppercase tracking-widest border-b border-white/5">Protocols</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($accounts as $account)
                            <tr class="group hover:bg-white/[0.01] transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-9 h-9 rounded-lg bg-slate-800 border border-white/5 flex items-center justify-center font-black text-primary-400">
                                            {{ substr($account->name, 0, 1) }}
                                        </div>
                                        <span class="text-white font-bold text-sm">{{ $account->name }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    @php
                                        $typeColors = [
                                            'income' => 'emerald',
                                            'expense' => 'red',
                                            'asset' => 'blue',
                                            'liability' => 'amber'
                                        ];
                                        $color = $typeColors[$account->type] ?? 'slate';
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest bg-{{ $color }}-500/10 text-{{ $color }}-500 border border-{{ $color }}-500/20">
                                        {{ $account->type }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center justify-start">
                                        <span class="text-slate-500 text-[10px] mr-1">₱</span>
                                        <span class="text-white font-black text-sm">{{ number_format($account->balance, 2) }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-[10px] text-slate-500 font-bold uppercase">{{ $account->updated_at->format('M d, Y') }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.finance.show', $account) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-900 border border-white/5 text-slate-500 hover:text-white hover:bg-primary-500 transition-all">
                                            <i class="fas fa-eye text-[10px]"></i>
                                        </a>
                                        <a href="{{ route('admin.finance.edit', $account) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-900 border border-white/5 text-slate-500 hover:text-white hover:bg-amber-500 transition-all">
                                            <i class="fas fa-edit text-[10px]"></i>
                                        </a>
                                        <form action="{{ route('admin.finance.destroy', $account) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Initiate account deletion protocol?')" class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-900 border border-white/5 text-slate-500 hover:text-white hover:bg-red-500 transition-all">
                                                <i class="fas fa-trash-alt text-[10px]"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 rounded-2xl bg-slate-900 flex items-center justify-center mb-6 border border-white/5">
                                            <i class="fas fa-calculator text-2xl text-slate-700"></i>
                                        </div>
                                        <p class="text-slate-500 font-bold uppercase tracking-widest text-[10px]">No liquidity accounts found in database</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8">
            {{ $accounts->links() }}
        </div>
    </div>
</x-app-layout>