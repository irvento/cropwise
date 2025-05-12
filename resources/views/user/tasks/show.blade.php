<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="space-y-6">
                        <!-- Title -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Title</h3>
                            <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $task->title }}</p>
                        </div>

                        <!-- Due Date -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Due Date</h3>
                            <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                                {{ $task->due_date->format('M d, Y') }}
                            </p>
                        </div>

                        <!-- Priority -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Priority</h3>
                            <div class="mt-1">
                                <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full 
                                    {{ $task->priority === 'high' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : 
                                       ($task->priority === 'medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : 
                                       'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400') }}">
                                    {{ ucfirst($task->priority) }}
                                </span>
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</h3>
                            <div class="mt-1">
                                <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full 
                                    {{ $task->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 
                                       ($task->status === 'in_progress' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : 
                                       'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400') }}">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</h3>
                            <p class="mt-1 text-lg text-gray-900 dark:text-gray-100 whitespace-pre-wrap">
                                {{ $task->description }}
                            </p>
                        </div>

                        <!-- Update Status Form -->
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <form action="{{ route('user.tasks.update-status', $task) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')

                                <div>
                                    <x-label for="status" value="{{ __('Update Status') }}" />
                                    <select id="status" name="status" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                                        <option value="not_started" {{ $task->status === 'not_started' ? 'selected' : '' }}>Not Started</option>
                                        <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                    <x-input-error for="status" class="mt-2" />
                                </div>

                                <div class="flex justify-end">
                                    <x-button>
                                        {{ __('Update Status') }}
                                    </x-button>
                                </div>
                            </form>
                        </div>

                        <!-- Back Button -->
                        <div class="flex justify-end">
                            <a href="{{ route('user.tasks.index') }}" 
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 