<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Planting Schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.planting-schedules.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Field Selection -->
                            <div>
                                <label for="field_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Field</label>
                                <select name="field_id" id="field_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    <option value="">Select Field</option>
                                    @foreach($fields as $field)
                                        <option value="{{ $field->id }}" {{ old('field_id') == $field->id ? 'selected' : '' }}>
                                            {{ $field->name }} ({{ $field->location }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('field_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Crop Selection -->
                            <div>
                                <label for="crop_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Crop</label>
                                <select name="crop_id" id="crop_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    <option value="">Select Crop</option>
                                    @foreach($crops as $crop)
                                        <option value="{{ $crop->id }}" {{ old('crop_id') == $crop->id ? 'selected' : '' }}>
                                            {{ $crop->name }} ({{ $crop->variety }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('crop_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Planting Date -->
                            <div>
                                <label for="planting_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Planting Date</label>
                                <input type="date" name="planting_date" id="planting_date" 
                                    value="{{ old('planting_date', date('Y-m-d')) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                @error('planting_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Expected Harvest Date -->
                            <div>
                                <label for="expected_harvest_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Expected Harvest Date</label>
                                <input type="date" name="expected_harvest_date" id="expected_harvest_date" 
                                    value="{{ old('expected_harvest_date') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                @error('expected_harvest_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Quantity Planted -->
                            <div>
                                <label for="quantity_planted" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity Planted</label>
                                <input type="number" name="quantity_planted" id="quantity_planted" 
                                    value="{{ old('quantity_planted', 1) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                @error('quantity_planted')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    <option value="Planned" {{ old('status') == 'Planned' ? 'selected' : '' }}>Planned</option>
                                    <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                           

                            <!-- Notes -->
                            <div class="md:col-span-2">
                                <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                                <textarea name="notes" id="notes" rows="3" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create Schedule
                            </button>
                            <a href="{{ route('admin.planting-schedules.index') }}" class="ml-4 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Auto-calculate expected harvest date based on crop's growth duration
        document.getElementById('crop_id').addEventListener('change', function() {
            const cropId = this.value;
            const plantingDate = document.getElementById('planting_date').value;
            
            if (cropId && plantingDate) {
                // You can add an AJAX call here to get the crop's growth duration
                // For now, we'll just add 30 days as an example
                const harvestDate = new Date(plantingDate);
                harvestDate.setDate(harvestDate.getDate() + 30);
                document.getElementById('expected_harvest_date').value = harvestDate.toISOString().split('T')[0];
            }
        });
    </script>
    @endpush
</x-app-layout> 