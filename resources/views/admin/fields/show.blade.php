<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                🌾 {{ __('Field Details') }}
            </h2>
            <div>
                <a href="{{ route('admin.fields.edit', $field) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mr-2 shadow">
                    ✏️ Edit
                </a>
                <a href="{{ route('admin.fields.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded shadow">
                    🔙 Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Field Info -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4 border-b border-gray-300 dark:border-gray-600 pb-2">🗂 Field Information</h3>
                            <dl class="space-y-4">
                                @foreach ([
                                    'Name' => $field->name,
                                    'Location' => $field->location,
                                    'Size' => $field->size . ' hectares',
                                    'Soil Type' => $field->soil_type,
                                    'Status' => $field->status,
                                    'Notes' => $field->notes ?? 'No notes available'
                                ] as $label => $value)
                                    <div>
                                        <dt class="text-sm font-semibold text-gray-600 dark:text-gray-400">{{ $label }}</dt>
                                        <dd class="mt-1 text-base">{{ $value }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        </div>

                        <!-- Planting History -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4 border-b border-gray-300 dark:border-gray-600 pb-2">🌱 Planting History</h3>
                            @if($field->plantingSchedules && $field->plantingSchedules->count() > 0)
                                <div class="space-y-4">
                                    @foreach($field->plantingSchedules as $schedule)
                                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600">
                                            <p class="text-lg font-bold text-green-700 dark:text-green-400">
                                                {{ $schedule->crop->name }}
                                            </p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                Planted: <span class="font-medium">{{ $schedule->planting_date->format('M d, Y') }}</span>
                                            </p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                 Expected Harvest: <span class="font-medium">{{ $schedule->expected_harvest_date->format('M d, Y') }}</span>
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 dark:text-gray-400 italic">No planting history available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
