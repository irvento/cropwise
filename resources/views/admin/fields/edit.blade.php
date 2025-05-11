<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Field') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.fields.update', $field) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Field Name</label>
                                <input type="text" name="name" id="name" value="{{ $field->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>

                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                                <input type="text" name="location" id="location" value="{{ $field->location }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>

                            <div>
                                <label for="size" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Size (hectares)</label>
                                <input type="number" step="0.01" name="size" id="size" value="{{ $field->size }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>

                            <div>
                                <label for="soil_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Soil Type</label>
                                <select name="soil_type" id="soil_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    <option value="">Select Soil Type</option>
                                    <option value="Clay" {{ $field->soil_type == 'Clay' ? 'selected' : '' }}>Clay</option>
                                    <option value="Sandy" {{ $field->soil_type == 'Sandy' ? 'selected' : '' }}>Sandy</option>
                                    <option value="Loamy" {{ $field->soil_type == 'Loamy' ? 'selected' : '' }}>Loamy</option>
                                    <option value="Silt" {{ $field->soil_type == 'Silt' ? 'selected' : '' }}>Silt</option>
                                    <option value="Peaty" {{ $field->soil_type == 'Peaty' ? 'selected' : '' }}>Peaty</option>
                                </select>
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    <option value="">Select Status</option>
                                    <option value="Available" {{ $field->status == 'Available' ? 'selected' : '' }}>Available</option>
                                    <option value="In Use" {{ $field->status == 'In Use' ? 'selected' : '' }}>In Use</option>
                                    <option value="Under Maintenance" {{ $field->status == 'Under Maintenance' ? 'selected' : '' }}>Under Maintenance</option>
                                </select>
                            </div>

                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                                <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $field->notes }}</textarea>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Field
                            </button>
                            <a href="{{ route('admin.fields.index') }}" class="ml-4 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 