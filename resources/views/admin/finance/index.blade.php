<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Finance Accounts') }}
            </h2>
            <a href="{{ route('admin.finance.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Account
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-green-100 dark:bg-green-800 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-green-800 dark:text-green-200">Total Income</h3>
                        <p class="text-2xl font-bold text-green-600 dark:text-green-300">
                            ${{ number_format($accounts->where('type', 'income')->sum('balance'), 2) }}
                        </p>
                    </div>
                    <div class="bg-red-100 dark:bg-red-800 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-red-800 dark:text-red-200">Total Expenses</h3>
                        <p class="text-2xl font-bold text-red-600 dark:text-red-300">
                            ${{ number_format($accounts->where('type', 'expense')->sum('balance'), 2) }}
                        </p>
                    </div>
                    <div class="bg-blue-100 dark:bg-blue-800 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-blue-800 dark:text-blue-200">Total Assets</h3>
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-300">
                            ${{ number_format($accounts->where('type', 'asset')->sum('balance'), 2) }}
                        </p>
                    </div>
                    <div class="bg-yellow-100 dark:bg-yellow-800 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-yellow-800 dark:text-yellow-200">Total Liabilities</h3>
                        <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-300">
                            ${{ number_format($accounts->where('type', 'liability')->sum('balance'), 2) }}
                        </p>
                    </div>
                </div>

                <!-- Accounts Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Balance</th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Last Updated</th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($accounts as $account)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $account->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $account->type === 'income' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $account->type === 'expense' ? 'bg-red-100 text-red-800' : '' }}
                                            {{ $account->type === 'asset' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $account->type === 'liability' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                            {{ ucfirst($account->type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">${{ number_format($account->balance, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $account->updated_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.finance.show', $account) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 mr-3">View</a>
                                        <a href="{{ route('admin.finance.edit', $account) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Edit</a>
                                        <form action="{{ route('admin.finance.destroy', $account) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" onclick="return confirm('Are you sure you want to delete this account?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        No finance accounts found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $accounts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>