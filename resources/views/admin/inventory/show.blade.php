<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl flex items-center gap-2 text-gray-800 dark:text-gray-200 leading-tight">
            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M16 3v4M8 3v4m-5 4h18"></path>
            </svg>
            {{ __('Inventory Item Details') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-4 lg:px-8">
            <div class="flex flex-col md:flex-row gap-6 mb-8">
                <div class="flex-1 rounded-lg shadow p-6 bg-white dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-900 transition-colors">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Basic Information</h3>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.inventory.edit', $inventory) }}"
                               class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 text-white text-xs font-semibold rounded shadow transition">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h6"></path>
                                </svg>
                                Edit
                            </a>
                            <a href="{{ route('admin.inventory.index') }}"
                               class="inline-flex items-center px-3 py-1.5 bg-gray-500 hover:bg-gray-700 focus:ring-2 focus:ring-gray-400 text-white text-xs font-semibold rounded shadow transition">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Back
                            </a>
                        </div>
                    </div>
                    <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                        <div class="py-2 flex justify-between">
                            <dt class="font-medium text-gray-600 dark:text-gray-300">Name</dt>
                            <dd class="text-gray-900 dark:text-gray-100">{{ $inventory->name }}</dd>
                        </div>
                        <div class="py-2 flex justify-between">
                            <dt class="font-medium text-gray-600 dark:text-gray-300">Description</dt>
                            <dd class="text-gray-900 dark:text-gray-100">{{ $inventory->description }}</dd>
                        </div>
                        <div class="py-2 flex justify-between">
                            <dt class="font-medium text-gray-600 dark:text-gray-300">Category</dt>
                            <dd class="text-gray-900 dark:text-gray-100">{{ $inventory->category?->name ?? '-' }}</dd>
                        </div>
                        <div class="py-2 flex justify-between">
                            <dt class="font-medium text-gray-600 dark:text-gray-300">Supplier</dt>
                            <dd class="text-gray-900 dark:text-gray-100">{{ $inventory->supplier?->name ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
                <div class="flex-1 rounded-lg shadow p-6 bg-white dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-900 transition-colors">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">Stock & Pricing</h3>
                    <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                        <div class="py-2 flex justify-between">
                            <dt class="font-medium text-gray-600 dark:text-gray-300">Current Quantity</dt>
                            <dd class="text-gray-900 dark:text-gray-100">{{ $inventory->quantity }}</dd>
                        </div>
                        <div class="py-2 flex justify-between">
                            <dt class="font-medium text-gray-600 dark:text-gray-300">Unit of Measurement</dt>
                            <dd class="text-gray-900 dark:text-gray-100">{{ $inventory->unit_of_measurement }}</dd>
                        </div>
                        <div class="py-2 flex justify-between">
                            <dt class="font-medium text-gray-600 dark:text-gray-300">Minimum Stock Level</dt>
                            <dd class="text-gray-900 dark:text-gray-100">{{ $inventory->minimum_stock_level }}</dd>
                        </div>
                        <div class="py-2 flex justify-between">
                            <dt class="font-medium text-gray-600 dark:text-gray-300">Current Stock Level</dt>
                            <dd class="text-gray-900 dark:text-gray-100">{{ $inventory->current_stock_level }}</dd>
                        </div>
                        <div class="py-2 flex justify-between">
                            <dt class="font-medium text-gray-600 dark:text-gray-300">Purchase Price</dt>
                            <dd class="text-gray-900 dark:text-gray-100">₱{{ number_format($inventory->purchase_price, 2) }}</dd>
                        </div>
                        <div class="py-2 flex justify-between">
                            <dt class="font-medium text-gray-600 dark:text-gray-300">Selling Price</dt>
                            <dd class="text-gray-900 dark:text-gray-100">₱{{ number_format($inventory->selling_price, 2) }}</dd>
                        </div>
                    </dl>
                </div>
                <div class="flex-1 rounded-lg shadow p-6 bg-white dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-900 transition-colors">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">Additional Information</h3>
                    <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                        <div class="py-2 flex justify-between">
                            <dt class="font-medium text-gray-600 dark:text-gray-300">Expiry Date</dt>
                            <dd class="text-gray-900 dark:text-gray-100">{{ $inventory->expiry_date ? $inventory->expiry_date->format('Y-m-d') : '-' }}</dd>
                        </div>
                        <div class="py-2 flex justify-between">
                            <dt class="font-medium text-gray-600 dark:text-gray-300">Storage Location</dt>
                            <dd class="text-gray-900 dark:text-gray-100">{{ $inventory->storage_location }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
            <div class="bg-white dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-900 rounded-lg shadow p-6 mt-8">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">Recent Transactions</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700 dark:text-gray-200">Date</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700 dark:text-gray-200">Type</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700 dark:text-gray-200">Quantity</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700 dark:text-gray-200">Unit Price</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700 dark:text-gray-200">Total Amount</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700 dark:text-gray-200">Notes</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800">
                            @forelse($inventory->transactions as $transaction)
                                <tr>
                                    <td class="px-4 py-2">{{ $transaction->created_at->format('Y-m-d') }}</td>
                                    <td class="px-4 py-2 capitalize">{{ $transaction->transaction_type }}</td>
                                    <td class="px-4 py-2">{{ $transaction->quantity }}</td>
                                    <td class="px-4 py-2">₱{{ number_format($transaction->unit_price, 2) }}</td>
                                    <td class="px-4 py-2">₱{{ number_format($transaction->total_amount, 2) }}</td>
                                    <td class="px-4 py-2">{{ $transaction->notes }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">No transactions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 