<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Task Details') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('admin.tasks.edit', $task) }}"
                   class="inline-flex items-center bg-yellow-500 dark:bg-yellow-600 hover:bg-yellow-600 dark:hover:bg-yellow-500 text-white text-sm font-semibold px-4 py-2 rounded shadow transition-colors duration-150">
                    ✏️ Edit Task
                </a>
                <a href="{{ route('admin.tasks.index') }}"
                   class="inline-flex items-center bg-gray-500 dark:bg-gray-600 hover:bg-gray-600 dark:hover:bg-gray-500 text-white text-sm font-semibold px-4 py-2 rounded shadow transition-colors duration-150">
                    ← Back to Tasks
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg divide-y divide-gray-200 dark:divide-gray-700">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Left Column --}}
                        <div>
                            <h3 class="text-md font-semibold text-gray-700 dark:text-gray-300 border-b pb-2 mb-4 border-gray-200 dark:border-gray-700 uppercase">Task Information</h3>

                            <div class="mb-4">
                                <label class="text-sm text-gray-500 dark:text-gray-400">Title</label>
                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ $task->title }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="text-sm text-gray-500 dark:text-gray-400">Description</label>
                                <p class="text-gray-700 dark:text-gray-300">{{ $task->description }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="text-sm text-gray-500 dark:text-gray-400">Assigned To</label>
                                <p class="text-gray-700 dark:text-gray-300">{{ $task->assigned_to }}</p>
                            </div>
                        </div>

                        {{-- Right Column --}}
                        <div>
                            <h3 class="text-md font-semibold text-gray-700 dark:text-gray-300 border-b pb-2 mb-4 border-gray-200 dark:border-gray-700 uppercase">Status Information</h3>

                            <div class="mb-4">
                                <label class="text-sm text-gray-500 dark:text-gray-400">Due Date</label>
                                <p class="text-gray-700 dark:text-gray-300">{{ $task->due_date->format('Y-m-d') }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="text-sm text-gray-500 dark:text-gray-400">Priority</label>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                    @if($task->priority === 'high') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-100
                                    @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                    @else bg-green-100 text-green-800 dark:bg-green-900 dark:text-white
                                    @endif">
                                    {{ ucfirst($task->priority) }}
                                </span>
                            </div>

                            <div class="mb-4">
                                <label class="text-sm text-gray-500 dark:text-gray-400">Status</label>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                    @if($task->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-white
                                    @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                    @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200
                                    @endif">
                                     {{ str_replace('_', ' ', ucfirst($task->status)) }}
                                </span>
                            </div>

                            <div class="mb-4">
                                <label class="text-sm text-gray-500 dark:text-gray-400">Created At</label>
                                <p class="text-gray-700 dark:text-gray-300">{{ $task->created_at->format('Y-m-d H:i:s') }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="text-sm text-gray-500 dark:text-gray-400">Last Updated</label>
                                <p class="text-gray-700 dark:text-gray-300">{{ $task->updated_at->format('Y-m-d H:i:s') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-gray-50 dark:bg-gray-700 flex justify-end">
                    <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-600 dark:bg-red-700 hover:bg-red-700 dark:hover:bg-red-600 text-white text-sm font-semibold px-4 py-2 rounded shadow transition-colors duration-150"
                                onclick="return confirm('Are you sure you want to delete this task?')">
                            🗑️ Delete Task
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>