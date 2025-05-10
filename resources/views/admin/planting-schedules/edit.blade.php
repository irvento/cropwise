<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Planting Schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.planting-schedules.update', $plantingSchedule) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Field -->
                            <div>
                                <label for="field_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    {{ __('Field') }}
                                </label>
                                <select name="field_id" id="field_id" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                    <option value="">Select a field</option>
                                    @foreach($fields as $field)
                                        <option value="{{ $field->id }}" {{ old('field_id', $plantingSchedule->field_id) == $field->id ? 'selected' : '' }}>
                                            {{ $field->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('field_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Crop -->
                            <div>
                                <label for="crop_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    {{ __('Crop') }}
                                </label>
                                <select name="crop_id" id="crop_id" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                    <option value="">Select a crop</option>
                                    @foreach($crops as $crop)
                                        <option value="{{ $crop->id }}" {{ old('crop_id', $plantingSchedule->crop_id) == $crop->id ? 'selected' : '' }}>
                                            {{ $crop->name }} ({{ $crop->variety }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('crop_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Planting Date -->
                            <div>
                                <label for="planting_date" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    {{ __('Planting Date') }}
                                </label>
                                <input type="date" name="planting_date" id="planting_date" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    value="{{ old('planting_date', $plantingSchedule->planting_date->format('Y-m-d')) }}" 
                                    required>
                                @error('planting_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Expected Harvest Date -->
                            <div>
                                <label for="expected_harvest_date" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    {{ __('Expected Harvest Date') }}
                                </label>
                                <input type="date" name="expected_harvest_date" id="expected_harvest_date" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    value="{{ old('expected_harvest_date', $plantingSchedule->expected_harvest_date->format('Y-m-d')) }}" 
                                    required>
                                @error('expected_harvest_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Quantity Planted -->
                            <div>
                                <label for="quantity_planted" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    {{ __('Quantity Planted') }}
                                </label>
                                <input type="number" name="quantity_planted" id="quantity_planted" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    value="{{ old('quantity_planted', $plantingSchedule->quantity_planted) }}" 
                                    step="0.01" 
                                    required>
                                @error('quantity_planted')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    {{ __('Status') }}
                                </label>
                                <select name="status" id="status" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                    <option value="Planned" {{ old('status', $plantingSchedule->status) == 'Planned' ? 'selected' : '' }}>Planned</option>
                                    <option value="In Progress" {{ old('status', $plantingSchedule->status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Completed" {{ old('status', $plantingSchedule->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="Cancelled" {{ old('status', $plantingSchedule->status) == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        

                            <!-- Notes -->
                            <div class="md:col-span-2">
                                <label for="notes" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    {{ __('Notes') }}
                                </label>
                                <textarea name="notes" id="notes" rows="3" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes', $plantingSchedule->notes) }}</textarea>
                                @error('notes')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <button type="button" onclick="window.history.back()" 
                                class="mr-3 inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-600 focus:bg-gray-400 dark:focus:bg-gray-600 active:bg-gray-500 dark:active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{ __('Update Planting Schedule') }}
                            </button>
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
                // You can add AJAX call here to get the crop's growth duration
                // For now, we'll just add 30 days as an example
                const plantingDateObj = new Date(plantingDate);
                const harvestDate = new Date(plantingDateObj);
                harvestDate.setDate(harvestDate.getDate() + 30);
                
                document.getElementById('expected_harvest_date').value = harvestDate.toISOString().split('T')[0];
            }
        });
    </script>
    @endpush
</x-app-layout> 