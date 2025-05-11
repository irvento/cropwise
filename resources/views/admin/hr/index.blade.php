<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('HR Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Quick Actions -->
            <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Leave Requests</h3>
                    <div class="space-y-2">
                        <a href="{{ route('hr.leave.create') }}" class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                            Create Leave Request
                        </a>
                        <a href="{{ route('hr.leave.index') }}" class="block w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-center">
                            View All Requests
                        </a>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Attendance</h3>
                    <div class="space-y-2">
                        <a href="{{ route('hr.attendance.create') }}" class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                            Add Attendance
                        </a>
                        <a href="{{ route('hr.attendance.index') }}" class="block w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-center">
                            View Attendance
                        </a>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Payroll</h3>
                    <div class="space-y-2">
                        <a href="{{ route('hr.payroll.create') }}" class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                            Add Payroll
                        </a>
                        <a href="{{ route('hr.payroll.index') }}" class="block w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-center">
                            View Payroll
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Leave Requests -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Recent Leave Requests</h3>
                        <a href="{{ route('hr.leave.index') }}" class="text-blue-500 hover:text-blue-700">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Employee</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Dates</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($recentLeaveRequests as $request)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $request->employee->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($request->leave_type) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $request->start_date->format('M d') }} - {{ $request->end_date->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $request->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                                   ($request->status === 'rejected' ? 'bg-red-100 text-red-800' : 
                                                    'bg-yellow-100 text-yellow-800') }}">
                                                {{ ucfirst($request->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Recent Attendance -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Today's Attendance</h3>
                        <a href="{{ route('hr.attendance.index') }}" class="text-blue-500 hover:text-blue-700">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Employee</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Time In</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Time Out</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($todayAttendance as $attendance)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $attendance->employee->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $attendance->time_in ? $attendance->time_in->format('H:i:s') : '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $attendance->time_out ? $attendance->time_out->format('H:i:s') : '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $attendance->status === 'present' ? 'bg-green-100 text-green-800' : 
                                                   ($attendance->status === 'absent' ? 'bg-red-100 text-red-800' : 
                                                    ($attendance->status === 'late' ? 'bg-yellow-100 text-yellow-800' : 
                                                     'bg-blue-100 text-blue-800')) }}">
                                                {{ ucfirst($attendance->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Recent Payroll -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Recent Payroll Records</h3>
                        <a href="{{ route('hr.payroll.index') }}" class="text-blue-500 hover:text-blue-700">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Employee</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Payment Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($recentPayrolls as $payroll)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $payroll->employee->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">${{ number_format($payroll->basic_salary, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $payroll->payment_date->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $payroll->status === 'paid' ? 'bg-green-100 text-green-800' : 
                                                   ($payroll->status === 'cancelled' ? 'bg-red-100 text-red-800' : 
                                                    'bg-yellow-100 text-yellow-800') }}">
                                                {{ ucfirst($payroll->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>