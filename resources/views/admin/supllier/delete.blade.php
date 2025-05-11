<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Delete Inventory Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <strong class="font-bold">Warning!</strong>
                    <p class="block sm:inline"> Are you sure you want to delete this inventory item? This action cannot be undone.</p>
                </div>

                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg mb-4">
                    <h3 class="text-lg font-semibold mb-2">{{ $inventory->name }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ $inventory->description }}</p>
                    <div class="mt-2">
                        <p><strong>Category:</strong> {{ $inventory->category->name }}</p>
                        <p><strong>Current Stock:</strong> {{ $inventory->current_stock_level }} {{ $inventory->unit_of_measurement }}</p>
                        <p><strong>Storage Location:</strong> {{ $inventory->storage_location }}</p>
                    </div>
                </div>

                <form action="{{ route('admin.inventory.destroy', $inventory) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.inventory.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Cancel</a>
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
