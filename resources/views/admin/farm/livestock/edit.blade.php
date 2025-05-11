<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Livestock') }}
            </h2>
            <a href="{{ route('admin.farm.livestock.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.farm.livestock.update', $livestock) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $livestock->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="animalvariety" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Animal Variety</label>
                                <input type="text" name="animalvariety" id="animalvariety" value="{{ old('animalvariety', $livestock->animalvariety) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                @error('animalvariety')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="growth_duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Growth Duration (months)</label>
                                <input type="number" name="growth_duration" id="growth_duration" value="{{ old('growth_duration', $livestock->growth_duration) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                @error('growth_duration')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="age" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Age (months)</label>
                                <input type="number" name="age" id="age" value="{{ old('age', $livestock->age) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                @error('age')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="weight" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Weight (kg)</label>
                                <input type="number" step="0.01" name="weight" id="weight" value="{{ old('weight', $livestock->weight) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                @error('weight')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="health_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Health Status</label>
                                <select name="health_status" id="health_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    <option value="healthy" {{ old('health_status', $livestock->health_status) == 'healthy' ? 'selected' : '' }}>Healthy</option>
                                    <option value="sick" {{ old('health_status', $livestock->health_status) == 'sick' ? 'selected' : '' }}>Sick</option>
                                    <option value="under_observation" {{ old('health_status', $livestock->health_status) == 'under_observation' ? 'selected' : '' }}>Under Observation</option>
                                </select>
                                @error('health_status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="conditions" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Conditions/Notes</label>
                                <textarea name="conditions" id="conditions" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('conditions', $livestock->conditions) }}</textarea>
                                @error('conditions')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Livestock
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 