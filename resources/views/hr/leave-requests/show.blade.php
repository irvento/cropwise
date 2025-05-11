<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Leave Request Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('hr.leave-requests.edit', $leaveRequest) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('hr.leave-requests.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
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
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Employee Information</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Employee Name</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $leaveRequest->employee->first_name }} {{ $leaveRequest->employee->last_name }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Leave Details</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Leave Type</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ ucfirst($leaveRequest->leave_type) }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $leaveRequest->start_date->format('Y-m-d') }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $leaveRequest->end_date->format('Y-m-d') }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                    <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $leaveRequest->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                           ($leaveRequest->status === 'rejected' ? 'bg-red-100 text-red-800' : 
                                            'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($leaveRequest->status) }}
                                    </span>
                                </div>

                                @if($leaveRequest->approved_at)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Approved At</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $leaveRequest->approved_at->format('Y-m-d H:i:s') }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Reason</h3>
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                            <p class="text-sm text-gray-900 dark:text-gray-100">{{ $leaveRequest->reason }}</p>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-2">
                        <form action="{{ route('hr.leave-requests.destroy', $leaveRequest) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this leave request?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 