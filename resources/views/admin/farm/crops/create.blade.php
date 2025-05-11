<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Crop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.crops.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    {{ __('Crop Name') }}
                                </label>
                                <input type="text" name="name" id="name" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Variety -->
                            <div>
                                <label for="variety" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    {{ __('Variety') }}
                                </label>
                                <input type="text" name="variety" id="variety" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    value="{{ old('variety') }}" required>
                                @error('variety')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Growth Duration -->
                            <div>
                                <label for="growth_duration" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    {{ __('Growth Duration (days)') }}
                                </label>
                                <input type="number" 
                                       name="growth_duration" 
                                       id="growth_duration" 
                                       min="1"
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       value="{{ old('growth_duration') }}" 
                                       required>
                                @error('growth_duration')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Field -->
                            <div>
                                <label for="field_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    {{ __('Field') }}
                                    <span class="text-xs text-gray-500">(Optional - will use default field if not selected)</span>
                                </label>
                                <select name="field_id" id="field_id" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Select a field</option>
                                    @foreach($fields as $field)
                                        <option value="{{ $field->id }}" {{ old('field_id') == $field->id ? 'selected' : '' }}>
                                            {{ $field->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('field_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Conditions -->
                            <div class="md:col-span-2">
                                <label for="conditions" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    {{ __('Growing Conditions') }}
                                </label>
                                <textarea name="conditions" id="conditions" rows="3" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('conditions') }}</textarea>
                                @error('conditions')
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
                                {{ __('Create Crop') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 