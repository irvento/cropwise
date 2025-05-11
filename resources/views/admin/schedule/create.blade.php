<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create New Schedule') }}
            </h2>
            <a href="{{ route('admin.schedule.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Create Task Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="text-center">
                        <i class="fas fa-tasks text-4xl text-blue-500 mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Create New Task</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Add a new task with priority, due date, and assignee</p>
                        <a href="{{ route('admin.tasks.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg transition-colors duration-200">
                            <i class="fas fa-plus mr-2"></i>
                            Create Task
                        </a>
                    </div>
                </div>

                <!-- Create Planting Schedule Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="text-center">
                        <i class="fas fa-seedling text-4xl text-green-500 mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Create Planting Schedule</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Schedule a new planting with field, crop, and dates</p>
                        <a href="{{ route('admin.planting-schedules.create') }}" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg transition-colors duration-200">
                            <i class="fas fa-plus mr-2"></i>
                            Create Planting Schedule
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
