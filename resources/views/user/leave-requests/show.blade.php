<x-user-layout>
    <x-slot name="header">
        {{ __('Leave Request Details') }}
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="space-y-6">
                    <!-- Leave Type -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Leave Type</h3>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $leaveRequest->leave_type }}</p>
                    </div>

                    <!-- Dates -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Start Date</h3>
                            <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                                {{ $leaveRequest->start_date->format('M d, Y') }}
                            </p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">End Date</h3>
                            <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                                {{ $leaveRequest->end_date->format('M d, Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</h3>
                        <div class="mt-1">
                            <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full 
                                {{ $leaveRequest->status === 'approved' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 
                                   ($leaveRequest->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : 
                                   'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400') }}">
                                {{ ucfirst($leaveRequest->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Reason -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Reason</h3>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100 whitespace-pre-wrap">
                            {{ $leaveRequest->reason }}
                        </p>
                    </div>

                    <!-- Created At -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Submitted On</h3>
                        <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                            {{ $leaveRequest->created_at->format('M d, Y \a\t h:i A') }}
                        </p>
                    </div>

                    <!-- Back Button -->
                    <div class="flex justify-end">
                        <a href="{{ route('user.leave-requests.index') }}" 
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout> 