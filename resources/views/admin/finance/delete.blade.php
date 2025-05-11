<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Delete Finance Account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <strong class="font-bold">Warning!</strong>
                    <p class="block sm:inline"> Are you sure you want to delete this finance account? This action cannot be undone.</p>
                </div>

                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg mb-4">
                    <h3 class="text-lg font-semibold mb-2">{{ $finance->name }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ $finance->description }}</p>
                    <div class="mt-2">
                        <p><strong>Type:</strong> {{ ucfirst($finance->type) }}</p>
                        <p><strong>Balance:</strong> ${{ number_format($finance->balance, 2) }}</p>
                        <p><strong>Last Updated:</strong> {{ $finance->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>

                <form action="{{ route('admin.finance.destroy', $finance) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.finance.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Cancel</a>
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
