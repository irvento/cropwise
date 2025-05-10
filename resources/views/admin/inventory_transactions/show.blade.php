<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Transaction Details') }}
            </h2>
            <a href="{{ route('admin.inventory-transactions.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Transactions
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Item</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $transaction->inventory->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Type</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ ucfirst($transaction->type) }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Quantity</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $transaction->quantity }} {{ $transaction->inventory->unit }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Unit Price</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">${{ number_format($transaction->unit_price, 2) }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Amount</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">${{ number_format($transaction->quantity * $transaction->unit_price, 2) }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">User</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $transaction->user->name }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Notes</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $transaction->notes ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $transaction->created_at->format('Y-m-d H:i') }}</dd>
                        </div>
                    </dl>
                    <div class="mt-6">
                        <a href="{{ route('admin.finances.index') }}" 
                           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            View Related Finances
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
