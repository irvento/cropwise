<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Inventory Dashboard') }}
        </h2>
            <div class="flex space-x-4">
                <a href="{{ route('admin.inventory-category.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Manage Categories
                </a>
                <a href="{{ route('admin.supplier.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Manage Suppliers
                </a>
                <a href="{{ route('admin.inventory-transactions.index') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                    View Transactions
                </a>
                <a href="{{ route('admin.inventory.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add New Item
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6 ">
                <!-- Total Items Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg p-6  border border-black">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                            <svg class="h-8 w-8 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Items</h3>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $items->total() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Low Stock Items Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg p-6  border border-black">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 dark:bg-red-900">
                            <svg class="h-8 w-8 text-red-600 dark:text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Low Stock Items</h3>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $lowStockItems }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Categories Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg p-6  border border-black">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                            <svg class="h-8 w-8 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Categories</h3>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $categoriesCount }}</p>
                            <a href="{{ route('admin.inventory-category.index') }}" class="text-sm text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300">View all categories</a>
                        </div>
                    </div>
                </div>

                <!-- Total Value Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg p-6  border border-black">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900">
                            <svg class="h-8 w-8 text-yellow-600 dark:text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Value</h3>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">${{ number_format($totalValue, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions and Low Stock Items -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Recent Transactions -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg  border border-black">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Recent Transactions</h3>
                            <a href="{{ route('admin.inventory-transactions.index') }}" class="text-sm text-purple-600 hover:text-purple-800 dark:text-purple-400 dark:hover:text-purple-300">View all transactions</a>
                        </div>
                        <div class="space-y-4">
                            @forelse($recentTransactions as $transaction)
                                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $transaction->inventory->name }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $transaction->type }} - {{ $transaction->quantity }} units</p>
                                    </div>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $transaction->created_at->diffForHumans() }}</span>
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400">No recent transactions</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Low Stock Items -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg  border border-black">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Low Stock Items</h3>
                        <div class="space-y-4">
                            @forelse($lowStockItemsList as $item)
                                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $item->name }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Current: {{ $item->current_stock_level }} / Min: {{ $item->minimum_stock_level }}</p>
                                    </div>
                                    <a href="{{ route('admin.inventory.edit', $item) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">Restock</a>
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400">No low stock items</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inventory Items Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg  border border-black">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Recent Inventory Items</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Current Stock</th>
                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Unit</th>
                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($items as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->category->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->current_stock_level }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->unit_of_measurement }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.inventory.show', $item) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 mr-3">View</a>
                                            <a href="{{ route('admin.inventory.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Edit</a>
                                            <form action="{{ route('admin.inventory.destroy', $item) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                            No inventory items found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>