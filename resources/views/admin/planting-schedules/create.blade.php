<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create New Planting Schedule') }}
            </h2>
            <a href="{{ route('admin.schedule.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('admin.planting-schedules.store') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-4">
                        <div>
                            <label for="field_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Field</label>
                            <select name="field_id" id="field_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                <option value="">Select Field</option>
                                @foreach($fields as $field)
                                    <option value="{{ $field->id }}">{{ $field->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="crop_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Crop</label>
                            <select name="crop_id" id="crop_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                <option value="">Select Crop</option>
                                @foreach($crops as $crop)
                                    <option value="{{ $crop->id }}">{{ $crop->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="planting_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Planting Date</label>
                            <input type="date" name="planting_date" id="planting_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>

                        <div>
                            <label for="expected_harvest_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Expected Harvest Date</label>
                            <input type="date" name="expected_harvest_date" id="expected_harvest_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>

                        <div>
                            <label for="quantity_planted" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity to Plant</label>
                            <input type="number" name="quantity_planted" id="quantity_planted" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                            <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Create Planting Schedule
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> 