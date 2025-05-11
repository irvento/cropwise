<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Payroll Records') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('hr.payroll.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add Payroll
                </a>
                <button onclick="document.getElementById('generatePayrollModal').classList.remove('hidden')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Generate Monthly Payroll
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Employee</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Basic Salary</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Payment Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($payrolls as $payroll)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $payroll->employee->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">${{ number_format($payroll->basic_salary, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $payroll->payment_date->format('Y-m-d') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $payroll->status === 'paid' ? 'bg-green-100 text-green-800' : 
                                                   ($payroll->status === 'cancelled' ? 'bg-red-100 text-red-800' : 
                                                    'bg-yellow-100 text-yellow-800') }}">
                                                {{ ucfirst($payroll->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('hr.payroll.show', $payroll) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 mr-3">View</a>
                                            <a href="{{ route('hr.payroll.edit', $payroll) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Edit</a>
                                            @if($payroll->status === 'pending')
                                                <form action="{{ route('hr.payroll.mark-as-paid', $payroll) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 mr-3">Mark as Paid</button>
                                                </form>
                                            @endif
                                            <form action="{{ route('hr.payroll.destroy', $payroll) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" onclick="return confirm('Are you sure you want to delete this payroll record?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $payrolls->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Generate Payroll Modal -->
    <div id="generatePayrollModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Generate Monthly Payroll</h3>
                <form action="{{ route('hr.payroll.generate-monthly') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="month" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select Month</label>
                        <input type="month" name="month" id="month" value="{{ now()->format('Y-m') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="document.getElementById('generatePayrollModal').classList.add('hidden')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Cancel
                        </button>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Generate
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> 