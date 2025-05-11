<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Inventory Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('admin.inventory.update', $inventory) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Basic Information -->
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Item Name</label>
                                <input type="text" name="name" id="name" value="{{ $inventory->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $inventory->description }}</textarea>
                            </div>

                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                                <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $inventory->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="supplier_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Supplier</label>
                                <select name="supplier_id" id="supplier_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ $inventory->supplier_id == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Stock Information -->
                        <div class="space-y-4">
                            <div>
                                <label for="current_stock_level" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Stock Level</label>
                                <input type="number" name="current_stock_level" id="current_stock_level" value="{{ $inventory->current_stock_level }}" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>

                            <div>
                                <label for="minimum_stock_level" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Minimum Stock Level</label>
                                <input type="number" name="minimum_stock_level" id="minimum_stock_level" value="{{ $inventory->minimum_stock_level }}" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>

                            <div>
                                <label for="unit_of_measurement" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Unit of Measurement</label>
                                <input type="text" name="unit_of_measurement" id="unit_of_measurement" value="{{ $inventory->unit_of_measurement }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                        </div>

                        <!-- Pricing Information -->
                        <div class="space-y-4">
                            <div>
                                <label for="purchase_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Purchase Price</label>
                                <input type="number" name="purchase_price" id="purchase_price" value="{{ $inventory->purchase_price }}" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>

                            <div>
                                <label for="selling_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Selling Price</label>
                                <input type="number" name="selling_price" id="selling_price" value="{{ $inventory->selling_price }}" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="space-y-4">
                            <div>
                                <label for="expiry_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Expiry Date</label>
                                <input type="date" name="expiry_date" id="expiry_date" value="{{ $inventory->expiry_date ? $inventory->expiry_date->format('Y-m-d') : '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>

                            <div>
                                <label for="storage_location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Storage Location</label>
                                <input type="text" name="storage_location" id="storage_location" value="{{ $inventory->storage_location }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.inventory.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Cancel</a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
