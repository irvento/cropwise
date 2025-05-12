<x-user-layout>
    <x-slot name="header">
        {{ __('Request Leave') }}
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <form action="{{ route('user.leave-requests.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <x-label for="leave_type" value="{{ __('Leave Type') }}" />
                <select id="leave_type" name="leave_type" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                    <option value="">Select Leave Type</option>
                    <option value="Vacation">Vacation</option>
                    <option value="Sick">Sick</option>
                    <option value="Personal">Personal</option>
                    <option value="Emergency">Emergency</option>
                </select>
                <x-input-error for="leave_type" class="mt-2" />
            </div>

            <div>
                <x-label for="start_date" value="{{ __('Start Date') }}" />
                <x-input id="start_date" type="date" name="start_date" class="mt-1 block w-full" required />
                <x-input-error for="start_date" class="mt-2" />
            </div>

            <div>
                <x-label for="end_date" value="{{ __('End Date') }}" />
                <x-input id="end_date" type="date" name="end_date" class="mt-1 block w-full" required />
                <x-input-error for="end_date" class="mt-2" />
            </div>

            <div>
                <x-label for="reason" value="{{ __('Reason') }}" />
                <textarea id="reason" name="reason" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" required></textarea>
                <x-input-error for="reason" class="mt-2" />
            </div>

            <div class="flex items-center justify-end">
                <x-button>
                    {{ __('Submit Request') }}
                </x-button>
            </div>
        </form>
    </div>
</x-user-layout> 