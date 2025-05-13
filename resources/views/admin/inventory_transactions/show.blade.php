<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Transaction Details') }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('admin.inventory-transactions.edit', $inventory_transaction) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Edit Transaction
                </a>
                <a href="{{ route('admin.inventory-transactions.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-semibold mb-2">Transaction Information</h3>
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <dl class="grid grid-cols-1 gap-4">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Transaction ID</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $inventory_transaction->id }}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $inventory_transaction->created_at->format('F d, Y H:i') }}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Type</dt>
                                            <dd class="mt-1">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $inventory_transaction->type === 'in' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                                    {{ ucfirst($inventory_transaction->type) }}
                                                </span>
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold mb-2">Item Details</h3>
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <dl class="grid grid-cols-1 gap-4">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Item Name</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $inventory_transaction->inventory->name ?? 'N/A' }}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Category</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $inventory_transaction->inventory->category->name ?? 'N/A' }}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Quantity</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $inventory_transaction->quantity }} {{ $inventory_transaction->inventory->unit ?? '' }}</dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-semibold mb-2">Additional Information</h3>
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <dl class="grid grid-cols-1 gap-4">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Notes</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $inventory_transaction->notes ?? 'No notes available' }}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created By</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $inventory_transaction->user->name ?? 'System' }}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $inventory_transaction->updated_at->format('F d, Y H:i') }}</dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>