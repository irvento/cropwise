<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    🌱 {{ __('Planting Schedule Details') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    ID: {{ $plantingSchedule->id }} • Last updated: {{ $plantingSchedule->updated_at->format('M d, Y') }}
                </p>
            </div>
            <a href="{{ route('admin.planting-schedules.index') }}"
               class="inline-flex items-center text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors">
                ← Back to All Schedules
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 transition-colors duration-200">
                <!-- Status Header -->
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/30">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                            @if($plantingSchedule->status == 'Planned') bg-blue-100 text-blue-800 dark:bg-blue-800/50 dark:text-blue-100
                            @elseif($plantingSchedule->status == 'In Progress') bg-yellow-100 text-yellow-800 dark:bg-yellow-800/50 dark:text-yellow-100
                            @elseif($plantingSchedule->status == 'Completed') bg-green-100 text-green-800 dark:bg-green-800/50 dark:text-green-100
                            @elseif($plantingSchedule->status == 'Cancelled') bg-red-100 text-red-800 dark:bg-red-800/50 dark:text-red-100
                            @endif">
                            {{ $plantingSchedule->status }}
                        </span>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            Created: {{ $plantingSchedule->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                        <!-- Field Information -->
                        <div class="space-y-1">
                            <h3 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Field</h3>
                            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ $plantingSchedule->field->name ?? 'N/A' }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $plantingSchedule->field->location ?? 'Location not specified' }}
                            </p>
                        </div>

                        <!-- Crop Information -->
                        <div class="space-y-1">
                            <h3 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Crop</h3>
                            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ $plantingSchedule->crop->name ?? 'N/A' }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $plantingSchedule->crop->variety ?? 'No variety specified' }}
                            </p>
                        </div>

                        <!-- Timeline Information -->
                        <div class="space-y-1">
                            <h3 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Planting Date</h3>
                            <p class="text-base font-medium text-gray-900 dark:text-gray-100">
                                {{ $plantingSchedule->planting_date?->format('F d, Y') ?? 'Not scheduled' }}
                            </p>
                            @if($plantingSchedule->planting_date)
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $plantingSchedule->planting_date->diffForHumans() }}
                                </p>
                            @endif
                        </div>

                        <div class="space-y-1">
                            <h3 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Expected Harvest</h3>
                            <p class="text-base font-medium text-gray-900 dark:text-gray-100">
                                {{ $plantingSchedule->expected_harvest_date?->format('F d, Y') ?? 'Not estimated' }}
                            </p>
                            @if($plantingSchedule->expected_harvest_date)
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $plantingSchedule->expected_harvest_date->diffForHumans() }}
                                </p>
                            @endif
                        </div>

                        <!-- Quantity Planted -->
                        <div class="space-y-1">
                            <h3 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Quantity Planted</h3>
                            <p class="text-base font-medium text-gray-900 dark:text-gray-100">
                                {{ $plantingSchedule->quantity_planted }} units
                            </p>
                        </div>

                        <!-- Responsible Employee -->
                        <div class="space-y-1">
                            <h3 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Responsible</h3>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center text-gray-700 dark:text-gray-300">
                                    {{ substr($plantingSchedule->responsibleEmployee->name ?? 'N/A', 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-base font-medium text-gray-900 dark:text-gray-100">
                                        {{ $plantingSchedule->responsibleEmployee->name ?? 'Not assigned' }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $plantingSchedule->responsibleEmployee->position ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notes Section -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Notes</h3>
                        <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-lg">
                            <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">
                                {{ $plantingSchedule->notes ?: 'No additional notes provided' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/30 flex flex-wrap justify-end gap-3">
                    <a href="{{ route('admin.planting-schedules.edit', $plantingSchedule) }}"
                       class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow-sm transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Schedule
                    </a>
                    <form action="{{ route('admin.planting-schedules.destroy', $plantingSchedule) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors"
                                onclick="return confirm('Are you sure you want to delete this schedule?')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete Schedule
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>