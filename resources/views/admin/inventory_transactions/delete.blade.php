<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Delete Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Are you sure you want to delete this transaction?</p>
                    <dl class="mt-4">
                        <dt class="font-medium">Item:</dt>
                        <dd>{{ $transaction->inventory->name }}</dd>
                        <dt class="font-medium">Type:</dt>
                        <dd>{{ ucfirst($transaction->type) }}</dd>
                        <dt class="font-medium">Quantity:</dt>
                        <dd>{{ $transaction->quantity }} {{ $transaction->inventory->unit }}</dd>
                    </dl>
                    <form action="{{ route('admin.inventory-transactions.destroy', $transaction) }}" method="POST" class="mt-6">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Yes, Delete
                        </button>
                        <a href="{{ route('admin.inventory-transactions.index') }}" class="ml-4 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                            Cancel
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
