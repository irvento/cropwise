<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Generate Monthly Payroll') }}
            </h2>
            <a href="{{ route('hr.payroll.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <p class="text-lg font-semibold mb-2">Generate Payroll for {{ now()->format('F Y') }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            This will create payroll records for all active employees with their current salary.
                        </p>
                    </div>

                    <form action="{{ route('hr.payroll.generate-monthly') }}" method="POST">
                        @csrf
                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Generate Monthly Payroll
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 