<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tight mb-1">
                    {{ __('Logistics Matrix') }}
                </h2>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-[0.2em]">Supply Chain & Inventory Intelligence</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.inventory-transactions.index') }}" class="glass-button px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest text-slate-400 border border-white/5 hover:bg-white/5 transition-all flex-1 sm:flex-none text-center">
                    <i class="fas fa-exchange-alt mr-2"></i> Ledger
                </a>
                <a href="{{ route('admin.inventory.create') }}" class="glass-button bg-primary-500 hover:bg-primary-600 px-6 py-2.5 rounded-xl text-white font-black uppercase tracking-widest text-xs shadow-xl shadow-primary-500/10 transition-all flex-1 sm:flex-none text-center">
                    <i class="fas fa-plus-circle mr-2"></i> New Resource
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Strategic Intelligence Metric Units -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $metrics = [
                    [
                        'label' => 'Total Assets',
                        'value' => $items->total(),
                        'icon' => 'fa-boxes',
                        'color' => 'primary',
                        'desc' => 'Unique resource identifiers'
                    ],
                    [
                        'label' => 'Critical Stock',
                        'value' => $lowStockItems,
                        'icon' => 'fa-exclamation-triangle',
                        'color' => 'red',
                        'desc' => 'Below threshold alerts'
                    ],
                    [
                        'label' => 'Classifications',
                        'value' => $categoriesCount,
                        'icon' => 'fa-tags',
                        'color' => 'emerald',
                        'desc' => 'Operational categories'
                    ],
                    [
                        'label' => 'Asset Valuation',
                        'value' => '₱' . number_format($totalValue, 0),
                        'icon' => 'fa-file-invoice-dollar',
                        'color' => 'amber',
                        'desc' => 'Aggregated market value'
                    ],
                ];
            @endphp

            @foreach($metrics as $metric)
                <div class="glass-card p-6 border-l-4 border-{{ $metric['color'] }}-500/50">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 rounded-xl bg-{{ $metric['color'] }}-500/10 flex items-center justify-center border border-{{ $metric['color'] }}-500/20">
                            <i class="fas {{ $metric['icon'] }} text-{{ $metric['color'] }}-400 text-xs"></i>
                        </div>
                        <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Active</span>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-1">{{ $metric['value'] }}</h3>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $metric['label'] }}</p>
                    <p class="text-[9px] text-slate-600 font-bold mt-2 italic">{{ $metric['desc'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Terminal: Recent Transactions -->
            <div class="lg:col-span-1 glass-card overflow-hidden">
                <div class="p-6 border-b border-white/5 flex items-center justify-between bg-white/[0.01]">
                    <h3 class="text-[10px] font-black text-white uppercase tracking-widest flex items-center">
                        <i class="fas fa-stream mr-2 text-primary-400"></i> Transaction Stream
                    </h3>
                    <a href="{{ route('admin.inventory-transactions.index') }}" class="text-[9px] font-black text-primary-400 uppercase tracking-widest hover:text-white transition-colors">History »</a>
                </div>
                <div class="p-6 space-y-4 max-h-[500px] overflow-y-auto">
                    @forelse($recentTransactions as $transaction)
                        <div class="p-4 rounded-2xl bg-slate-900/50 border border-white/5 group hover:border-primary-500/30 transition-all">
                            <div class="flex justify-between items-start mb-2">
                                <p class="text-white font-bold text-sm">{{ $transaction->inventory->name }}</p>
                                <span class="text-[9px] font-black uppercase text-{{ $transaction->type === 'IN' ? 'emerald' : 'red' }}-500 bg-{{ $transaction->type === 'IN' ? 'emerald' : 'red' }}-500/10 px-2 py-0.5 rounded-md border border-{{ $transaction->type === 'IN' ? 'emerald' : 'red' }}-500/20">
                                    {{ $transaction->type }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] text-slate-500 font-bold">{{ $transaction->quantity }} Units</p>
                                <p class="text-[10px] text-slate-700 font-bold uppercase">{{ $transaction->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="py-10 text-center">
                            <p class="text-slate-600 text-[10px] font-black uppercase tracking-widest">No activity detected</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Central Inventory Matrix -->
            <div class="lg:col-span-2 space-y-6">
                <div class="glass-card p-6">
                    <form action="{{ route('admin.inventory.index') }}" method="GET" class="flex gap-3">
                        <div class="flex-1 relative">
                            <i class="fas fa-barcode absolute left-4 top-1/2 -translate-y-1/2 text-slate-500"></i>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                class="w-full bg-slate-900/50 border border-white/5 rounded-xl pl-12 pr-4 py-3 text-white text-xs font-bold focus:border-primary-500/50 outline-none transition-all placeholder-slate-700"
                                placeholder="IDENTIFY RESOURCE BY NAME OR CLASSIFICATION...">
                        </div>
                        <button type="submit" class="px-6 py-3 bg-primary-500 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-primary-600 transition-all shadow-lg shadow-primary-500/20">
                            SCAN
                        </button>
                    </form>
                </div>

                <div class="glass-card overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-white/[0.01] border-b border-white/5">
                                    <th class="px-8 py-5 text-left text-[9px] font-black text-slate-500 uppercase tracking-widest">Resource Descriptor</th>
                                    <th class="px-8 py-5 text-left text-[9px] font-black text-slate-500 uppercase tracking-widest">Class</th>
                                    <th class="px-8 py-5 text-left text-[9px] font-black text-slate-500 uppercase tracking-widest">Level</th>
                                    <th class="px-8 py-5 text-right text-[9px] font-black text-slate-500 uppercase tracking-widest">Executables</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($items as $item)
                                    <tr class="group hover:bg-white/[0.01] transition-colors">
                                        <td class="px-8 py-5">
                                            <div class="flex flex-col">
                                                <span class="text-white font-bold text-sm">{{ $item->name }}</span>
                                                <span class="text-[10px] text-slate-600 font-bold uppercase mt-0.5 tracking-tighter">ID: {{ str_pad($item->id, 6, '0', STR_PAD_LEFT) }}</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-5 text-slate-400 text-xs font-bold uppercase tracking-tighter">
                                            {{ $item->category->name }}
                                        </td>
                                        <td class="px-8 py-5">
                                            <div class="flex flex-col">
                                                <span class="text-white font-black text-sm">{{ $item->current_stock_level }} <span class="text-[10px] text-slate-500 font-bold">{{ $item->unit_of_measurement }}</span></span>
                                                <div class="w-24 h-1 bg-slate-800 rounded-full mt-2 overflow-hidden">
                                                    @php $percent = min(100, ($item->current_stock_level / ($item->minimum_stock_level ?: 1)) * 50); @endphp
                                                    <div class="h-full bg-{{ $item->current_stock_level <= $item->minimum_stock_level ? 'red' : 'primary' }}-500" style="width: {{ $percent }}%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-5">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('admin.inventory.show', $item) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-800 text-slate-500 hover:text-white hover:bg-primary-500 transition-all">
                                                    <i class="fas fa-eye text-[10px]"></i>
                                                </a>
                                                <a href="{{ route('admin.inventory.edit', $item) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-800 text-slate-500 hover:text-white hover:bg-amber-500 transition-all">
                                                    <i class="fas fa-edit text-[10px]"></i>
                                                </a>
                                                <form action="{{ route('admin.inventory.destroy', $item) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Initiate asset deletion protocol?')" class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-800 text-slate-500 hover:text-white hover:bg-red-500 transition-all">
                                                        <i class="fas fa-trash-alt text-[10px]"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-8 py-20 text-center">
                                            <p class="text-slate-600 text-xs font-black uppercase tracking-widest">Inventory Matrix Is Depleted</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-8">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>