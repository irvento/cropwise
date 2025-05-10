<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Crop Details') }}
            </h2>
            <div>
                <a href="{{ route('admin.farm.crops.edit', $crop) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Edit Crop
                </a>
                <a href="{{ route('admin.farm.crops.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium mb-4">Crop Information</h3>
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $crop->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Variety</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $crop->variety }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Growth Duration</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $crop->growth_duration }} days</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Conditions</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $crop->conditions ?? 'No conditions specified' }}</dd>
                                </div>
                            </dl>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium mb-4">Planting Schedules</h3>
                            @if($crop->plantingSchedules && $crop->plantingSchedules->count() > 0)
                                <div class="space-y-4">
                                    @foreach($crop->plantingSchedules as $schedule)
                                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                            <p class="font-medium">Field: {{ $schedule->field->name ?? 'N/A' }}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                Planted: {{ $schedule->planting_date->format('M d, Y') }}
                                            </p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                Expected Harvest: {{ $schedule->expected_harvest_date->format('M d, Y') }}
                                            </p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                Status: {{ $schedule->status }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 dark:text-gray-400">No planting schedules available</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 