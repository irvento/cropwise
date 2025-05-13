<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Payroll Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Payment Information -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Payment Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Payment Date</p>
                                <p class="font-medium">{{ $payroll->date ? $payroll->date->format('M d, Y') : 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Status</p>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $payroll->status === 'paid' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 
                                       ($payroll->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : 
                                       'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400') }}">
                                    {{ ucfirst($payroll->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Salary Details -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Salary Details</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 dark:text-gray-400">Basic Salary</span>
                                <span class="font-medium">₱{{ number_format($payroll->basic_salary, 2) }}</span>
                            </div>
                            @if($payroll->overtime_pay > 0)
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 dark:text-gray-400">Overtime Pay</span>
                                    <span class="font-medium">₱{{ number_format($payroll->overtime_pay, 2) }}</span>
                                </div>
                            @endif
                            @if($payroll->bonus > 0)
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 dark:text-gray-400">Bonus</span>
                                    <span class="font-medium">₱{{ number_format($payroll->bonus, 2) }}</span>
                                </div>
                            @endif
                            @if($payroll->deductions > 0)
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 dark:text-gray-400">Deductions</span>
                                    <span class="font-medium text-red-600 dark:text-red-400">-₱{{ number_format($payroll->deductions, 2) }}</span>
                                </div>
                            @endif
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold">Net Salary</span>
                                    <span class="font-bold text-lg">₱{{ number_format($payroll->net_salary, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($payroll->notes)
                        <!-- Notes -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-4">Notes</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ $payroll->notes }}</p>
                        </div>
                    @endif

                    <!-- Back Button -->
                    <div class="mt-6">
                        <a href="{{ route('user.payroll.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Back to Payroll Records
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 