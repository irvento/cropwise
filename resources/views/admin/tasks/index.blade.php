<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Task Management') }}
            </h2>
            <a href="{{ route('admin.tasks.create') }}"
                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition duration-150">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create New Task
            </a>
        </div>
    </x-slot>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))
            <div
                class="mb-4 bg-green-100 dark:bg-green-900 border-l-4 border-green-500 text-green-700 dark:text-green-300 p-4 rounded">
                <p class="font-bold">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100 sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                            <tr>
                                <th class="px-6 py-3 text-left uppercase font-medium">Task Details</th>
                                <th class="px-6 py-3 text-left uppercase font-medium">Assigned To</th>
                                <th class="px-6 py-3 text-left uppercase font-medium">Due Date</th>
                                <th class="px-6 py-3 text-left uppercase font-medium">Priority</th>
                                <th class="px-6 py-3 text-left uppercase font-medium">Status</th>
                                <th class="px-6 py-3 text-left uppercase font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($tasks as $task)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <!-- Task Info -->
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-900 dark:text-gray-100">{{ $task->title }}
                                        </div>
                                        <div class="text-gray-500 dark:text-gray-400 truncate max-w-xs">
                                            {{ $task->description }}</div>
                                    </td>
                                    <!-- Assigned To -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-10 h-10 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center text-gray-700 dark:text-gray-200">
                                                {{ substr($task->employee->first_name, 0, 1) }}{{ substr($task->employee->last_name, 0, 1) }}
                                            </div>
                                            <div class="text-gray-900 dark:text-gray-100">
                                                {{ $task->employee->first_name }} {{ $task->employee->last_name }}
                                            </div>
                                        </div>
                                    </td>
                                    <!-- Due Date -->
                                    <td class="px-6 py-4">
                                        <div class="text-gray-900 dark:text-gray-100">
                                            {{ $task->due_date->format('M d, Y') }}</div>
                                        <div class="text-gray-500 dark:text-gray-400">
                                            {{ $task->due_date->diffForHumans() }}</div>
                                    </td>
                                    <!-- Priority -->
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full text-white
        @if ($task->priority === 'high') bg-red-600 dark:bg-red-500
        @elseif($task->priority === 'medium') bg-yellow-600 dark:bg-yellow-500
        @else bg-green-600 dark:bg-green-500 @endif">
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                    </td>

                                    <!-- Status -->
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full text-white
                                                @if ($task->status === 'completed') bg-green-600 dark:bg-green-500
                                                @elseif($task->status === 'in_progress') bg-yellow-600 dark:bg-yellow-500 text-black
                                                @else bg-gray-600 dark:bg-gray-500 @endif">
                                            {{ str_replace('_', ' ', ucfirst($task->status)) }}
                                        </span>
                                    </td>
                                    <!-- Actions -->
                                    <td class="px-6 py-4 space-x-2 flex items-center">
    <a href="{{ route('admin.tasks.show', $task) }}" title="View"
       class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        </svg>
    </a>

    <a href="{{ route('admin.tasks.edit', $task) }}" title="Edit"
       class="text-yellow-600 dark:text-yellow-400 hover:text-yellow-800 dark:hover:text-yellow-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
        </svg>
    </a>

    <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Are you sure?')" title="Delete"
                class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </button>
    </form>
</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        No tasks found. Create your first task!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
