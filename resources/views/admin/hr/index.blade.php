<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('HR Management') }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('hr.payroll.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Payrolls
                </a>
                <a href="{{ route('hr.attendance.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Attendance
                </a>
                <a href="{{ route('hr.leave-requests.index') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                    Leave Requests
                </a>
                <a href="{{ route('hr.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add New Employee
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Employee Cards Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Employees</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($employees as $employee)
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden">
                                <div class="p-4">
                                    <div class="flex items-center justify-between mb-4">
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                            {{ $employee->first_name }} {{ $employee->last_name }}
                                        </h4>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $employee->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($employee->status) }}
                                        </span>
                                    </div>
                                    
                                    <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                                        <p><span class="font-medium">Position:</span> {{ $employee->position }}</p>
                                        <p><span class="font-medium">Contact:</span> {{ $employee->contact_number }}</p>
                                        <p><span class="font-medium">Address:</span> {{ $employee->address }}</p>
                                    </div>

                                    <div class="mt-4 flex justify-end space-x-2">
                                        <a href="{{ route('hr.show', $employee->id) }}" 
                                           class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                            View Details
                                        </a>
                                        <a href="{{ route('hr.edit', $employee->id) }}" 
                                           class="text-yellow-600 hover:text-yellow-800 dark:text-yellow-400 dark:hover:text-yellow-300">
                                            Edit
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Recent Activity Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Recent Leave Requests -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Recent Leave Requests</h3>
                            <a href="{{ route('hr.leave-requests.index') }}" class="text-sm text-blue-600 hover:text-blue-800">View All</a>
                        </div>
                        <div class="space-y-4">
                            @forelse($recentLeaveRequests as $request)
                                <div class="border-b border-gray-200 dark:border-gray-700 pb-3">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-gray-100">
                                                {{ $request->employee->first_name }} {{ $request->employee->last_name }}
                                            </p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ $request->start_date->format('M d') }} - {{ $request->end_date->format('M d, Y') }}
                                            </p>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $request->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                               ($request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($request->status) }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400">No recent leave requests</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Today's Attendance -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Today's Attendance</h3>
                            <a href="{{ route('hr.attendance.index') }}" class="text-sm text-blue-600 hover:text-blue-800">View All</a>
                        </div>
                        <div class="space-y-4">
                            @forelse($todayAttendance as $attendance)
                                <div class="border-b border-gray-200 dark:border-gray-700 pb-3">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-gray-100">
                                                {{ $attendance->employee->first_name }} {{ $attendance->employee->last_name }}
                                            </p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ $attendance->check_in ? $attendance->check_in->format('h:i A') : 'Not checked in' }}
                                            </p>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $attendance->status === 'present' ? 'bg-green-100 text-green-800' : 
                                               ($attendance->status === 'late' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($attendance->status) }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400">No attendance records for today</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Payrolls -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Recent Payrolls</h3>
                            <a href="{{ route('hr.payroll.index') }}" class="text-sm text-blue-600 hover:text-blue-800">View All</a>
                        </div>
                        <div class="space-y-4">
                            @forelse($recentPayrolls as $payroll)
                                <div class="border-b border-gray-200 dark:border-gray-700 pb-3">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-gray-100">
                                                {{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}
                                            </p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ $payroll->payroll_date->format('M d, Y') }}
                                            </p>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            ${{ number_format($payroll->net_salary, 2) }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400">No recent payroll records</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>