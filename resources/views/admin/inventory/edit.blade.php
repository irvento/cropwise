<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Inventory Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.inventory.update', $inventory) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Basic Information -->
                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Item Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $inventory->name) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                    <textarea name="description" id="description" rows="3" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description', $inventory->description) }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                                    <select name="category_id" id="category_id" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                        <option value="">Select a category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $inventory->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="supplier_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Supplier</label>
                                    <select name="supplier_id" id="supplier_id" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                        <option value="">Select a supplier</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}" {{ old('supplier_id', $inventory->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                                {{ $supplier->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Stock Information -->
                            <div class="space-y-4">
                                <div>
                                    <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Quantity</label>
                                    <input type="number" name="quantity" id="quantity" step="0.01" value="{{ old('quantity', $inventory->quantity) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    @error('quantity')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="unit_of_measurement" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Unit of Measurement</label>
                                    <input type="text" name="unit_of_measurement" id="unit_of_measurement" value="{{ old('unit_of_measurement', $inventory->unit_of_measurement) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    @error('unit_of_measurement')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="minimum_stock_level" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Minimum Stock Level</label>
                                    <input type="number" name="minimum_stock_level" id="minimum_stock_level" step="0.01" value="{{ old('minimum_stock_level', $inventory->minimum_stock_level) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    @error('minimum_stock_level')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="current_stock_level" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Stock Level</label>
                                    <input type="number" name="current_stock_level" id="current_stock_level" step="0.01" value="{{ old('current_stock_level', $inventory->current_stock_level) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    @error('current_stock_level')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Pricing Information -->
                            <div class="space-y-4">
                                <div>
                                    <label for="purchase_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Purchase Price</label>
                                    <input type="number" name="purchase_price" id="purchase_price" step="0.01" value="{{ old('purchase_price', $inventory->purchase_price) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    @error('purchase_price')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="selling_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Selling Price</label>
                                    <input type="number" name="selling_price" id="selling_price" step="0.01" value="{{ old('selling_price', $inventory->selling_price) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    @error('selling_price')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Additional Information -->
                            <div class="space-y-4">
                                <div>
                                    <label for="expiry_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Expiry Date</label>
                                    <input type="date" name="expiry_date" id="expiry_date" value="{{ old('expiry_date', $inventory->expiry_date?->format('Y-m-d')) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    @error('expiry_date')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="storage_location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Storage Location</label>
                                    <input type="text" name="storage_location" id="storage_location" value="{{ old('storage_location', $inventory->storage_location) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    @error('storage_location')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.inventory.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 