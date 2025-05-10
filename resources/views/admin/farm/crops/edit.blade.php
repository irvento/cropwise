<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Crop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.crops.update', $crop) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Crop Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $crop->name)" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <!-- Variety -->
                            <div>
                                <x-input-label for="variety" :value="__('Variety')" />
                                <x-text-input id="variety" name="variety" type="text" class="mt-1 block w-full" :value="old('variety', $crop->variety)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('variety')" />
                            </div>

                            <!-- Growth Duration -->
                            <div>
                                <x-input-label for="growth_duration" :value="__('Growth Duration (days)')" />
                                <x-text-input id="growth_duration" name="growth_duration" type="number" class="mt-1 block w-full" :value="old('growth_duration', $crop->growth_duration)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('growth_duration')" />
                            </div>

                            <!-- Field -->
                            <div>
                                <x-input-label for="field_id" :value="__('Field')" />
                                <select id="field_id" name="field_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">Select a field</option>
                                    @foreach($fields as $field)
                                        <option value="{{ $field->id }}" {{ old('field_id', $crop->field_id) == $field->id ? 'selected' : '' }}>
                                            {{ $field->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('field_id')" />
                            </div>

                            <!-- Conditions -->
                            <div class="md:col-span-2">
                                <x-input-label for="conditions" :value="__('Growing Conditions')" />
                                <textarea id="conditions" name="conditions" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3">{{ old('conditions', $crop->conditions) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('conditions')" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-secondary-button onclick="window.history.back()" type="button" class="mr-3">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-primary-button>
                                {{ __('Update Crop') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 