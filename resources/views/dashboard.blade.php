<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Farm Management Dashboard') }}
        </h2>
    </x-slot>

    @if(auth()->user()->role_id === 1)
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Overview Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Total Fields -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 dark:bg-green-900/30">
                                <i class="fas fa-map-marked-alt text-2xl text-green-600 dark:text-green-400"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Fields</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $totalFields ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Crops -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900/30">
                                <i class="fas fa-seedling text-2xl text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Active Crops</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $activeCrops ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Tasks -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900/30">
                                <i class="fas fa-tasks text-2xl text-yellow-600 dark:text-yellow-400"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Pending Tasks</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $pendingTasks ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Livestock -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900/30">
                                <i class="fas fa-cow text-2xl text-purple-600 dark:text-purple-400"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Livestock</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $totalLivestock ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Employees -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-indigo-100 dark:bg-indigo-900/30">
                                <i class="fas fa-users text-2xl text-indigo-600 dark:text-indigo-400"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Employees</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $totalEmployees ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                    
                <!-- Total Inventory -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 dark:bg-red-900/30">
                                <i class="fas fa-warehouse text-2xl text-red-600 dark:text-red-400"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Inventory</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $totalInventory ?? 0 }}</p>
                            </div>
                        </div>
                        </div>
                </div>

                <!-- Total Leave Requests -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-pink-100 dark:bg-pink-900/30">
                                <i class="fas fa-calendar-times text-2xl text-pink-600 dark:text-pink-400"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Leave Requests</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $totalLeaveRequests ?? 0 }}</p>
                            </div>
                        </div>
                        </div>
                </div>

                <!-- Total Attendance -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-teal-100 dark:bg-teal-900/30">
                                <i class="fas fa-clipboard-check text-2xl text-teal-600 dark:text-teal-400"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Attendance</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $totalAttendance ?? 0 }}</p>
                            </div>
                        </div>
                        </div>
                </div>

                <!-- Total Payrolls -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-orange-100 dark:bg-orange-900/30">
                                <i class="fas fa-money-bill-wave text-2xl text-orange-600 dark:text-orange-400"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Payrolls</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $totalPayrolls ?? 0 }}</p>
                            </div>
                        </div>
                        </div>
                </div>
            </div>
<!-- Main Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @php
        $cards = [
            [
                'route' => route('farm.index'),
                'icon' => 'fas fa-tractor',
                'title' => 'Farm Overview',
                'desc' => 'Manage fields, crops, and livestock',
                'bg' => 'from-green-100 to-green-200 dark:from-green-700 dark:to-green-800'
            ],
            [
                'route' => route('admin.schedule.index'),
                'icon' => 'fas fa-calendar-alt',
                'title' => 'Schedule Management',
                'desc' => 'Tasks and planting schedules',
                'bg' => 'from-blue-100 to-blue-200 dark:from-blue-700 dark:to-blue-800'
            ],
            [
                'route' => route('weather.show', $currentCity ?? 'Manolo Fortich'),
                'icon' => 'fas fa-cloud-sun',
                'title' => 'Weather',
                'desc' => 'Current weather and forecasts',
                'bg' => 'from-yellow-100 to-yellow-200 dark:from-yellow-600 dark:to-yellow-700'
            ],
            [
                'route' => route('hr.index'),
                'icon' => 'fas fa-users',
                'title' => 'Human Resources',
                'desc' => 'Manage employees and tasks',
                'bg' => 'from-purple-100 to-purple-200 dark:from-purple-700 dark:to-purple-800'
            ],
            [
                'route' => route('admin.inventory.index'),
                'icon' => 'fas fa-warehouse',
                'title' => 'Inventory',
                'desc' => 'Manage supplies and equipment',
                'bg' => 'from-red-100 to-red-200 dark:from-red-700 dark:to-red-800'
            ],
            [
                'route' => route('admin.finance.index'),
                'icon' => 'fas fa-chart-line',
                'title' => 'Finance',
                'desc' => 'Track income and expenses',
                'bg' => 'from-indigo-100 to-indigo-200 dark:from-indigo-700 dark:to-indigo-800'
            ],
        ];
    @endphp

    @foreach ($cards as $card)
        <a href="{{ $card['route'] }}" class="block rounded-xl shadow-md border border-gray-300 dark:border-gray-700 hover:shadow-lg transition-shadow duration-200 overflow-hidden">
            <div class="relative bg-gradient-to-br {{ $card['bg'] }} p-6 text-center">
                <div class="absolute inset-0 bg-white/40 dark:bg-black/20 backdrop-blur-md rounded-xl"></div>
                        <div class="relative z-10">
                    <i class="{{ $card['icon'] }} text-4xl text-gray-800 dark:text-white mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $card['title'] }}</h3>
                    <p class="text-gray-700 dark:text-gray-300 mt-2">{{ $card['desc'] }}</p>
                        </div>
                        </div>
                    </a>
    @endforeach
            </div>

            <!-- Recent Schedules Section -->
            <div class="mt-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Schedules</h3>
                        <div class="space-y-4">
                            @forelse($recentSchedules as $schedule)
                                <div class="flex items-center space-x-4 p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                    <div class="flex-shrink-0">
                                        <i class="fas {{ $schedule->icon }} text-lg 
                                            @if($schedule->type === 'task')
                                                @if($schedule->priority === 'high') text-red-500 dark:text-red-400
                                                @elseif($schedule->priority === 'medium') text-yellow-500 dark:text-yellow-400
                                                @else text-green-500 dark:text-green-400
                                                @endif
                                            @else text-blue-500 dark:text-blue-400
                                            @endif">
                                        </i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $schedule->title }}
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">
                                            {{ $schedule->description }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            @if($schedule->type === 'planting')
                                                Planting Date: {{ \Carbon\Carbon::parse($schedule->planting_date)->format('M d, Y') }}
                                            @else
                                                Created: {{ $schedule->date->diffForHumans() }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400">No recent schedules</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Tasks Section -->
            <div class="mt-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Upcoming Tasks</h3>
                        <div class="space-y-4">
                            @forelse($upcomingTasks as $task)
                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-tasks text-lg text-blue-500 dark:text-blue-400"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $task->title }}
                                            </p>
                                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                                Due: {{ $task->due_date->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        @if($task->priority === 'high') bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400
                                        @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400
                                        @else bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                                        @endif">
                                        {{ ucfirst($task->priority) }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400">No upcoming tasks</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Financial Summary Section -->
            <div class="mt-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Financial Summary</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg border border-green-100 dark:border-green-800">
                                <p class="text-sm font-medium text-green-800 dark:text-green-200">Income</p>
                                <p class="text-2xl font-semibold text-green-600 dark:text-green-300">
                                    ₱{{ number_format($financialSummary['income'], 2) }}
                                </p>
                            </div>
                            <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-lg border border-red-100 dark:border-red-800">
                                <p class="text-sm font-medium text-red-800 dark:text-red-200">Expenses</p>
                                <p class="text-2xl font-semibold text-red-600 dark:text-red-300">
                                    ₱{{ number_format($financialSummary['expenses'], 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                        </div>

            <!-- Recent Leave Requests Section -->
            <div class="mt-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Leave Requests</h3>
                        <div class="space-y-4">
                            @forelse($recentLeaveRequests as $leaveRequest)
                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-calendar-times text-lg text-pink-500 dark:text-pink-400"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $leaveRequest->employee->first_name }} {{ $leaveRequest->employee->last_name }}
                                            </p>
                                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                                {{ $leaveRequest->start_date->format('M d, Y') }} - {{ $leaveRequest->end_date->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        @if($leaveRequest->status === 'approved') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                                        @elseif($leaveRequest->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400
                                        @else bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400
                                        @endif">
                                        {{ ucfirst($leaveRequest->status) }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400">No recent leave requests</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Attendance Section -->
            <div class="mt-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Attendance</h3>
                        <div class="space-y-4">
                            @forelse($recentAttendance as $attendance)
                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-clipboard-check text-lg text-teal-500 dark:text-teal-400"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $attendance->employee->first_name }} {{ $attendance->employee->last_name }}
                                            </p>
                                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                                {{ $attendance->date->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        @if($attendance->status === 'present') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                                        @elseif($attendance->status === 'late') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400
                                        @else bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400
                                        @endif">
                                        {{ ucfirst($attendance->status) }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400">No recent attendance records</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Payrolls Section -->
            <div class="mt-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Payrolls</h3>
                        <div class="space-y-4">
                            @forelse($recentPayrolls as $payroll)
                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-money-bill-wave text-lg text-orange-500 dark:text-orange-400"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}
                                            </p>
                                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                                {{ $payroll->date ? $payroll->date->format('M d, Y') : 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                        ₱{{ number_format($payroll->amount, 2) }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400">No recent payroll records</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Weather Section -->
            @if($weather)
            <div class="mt-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Current Weather</h3>
                        <div class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                            <div class="flex items-center space-x-4">
                                <img src="http://openweathermap.org/img/wn/{{ $weather['icon'] }}@2x.png" alt="Weather icon">
                                <div>
                                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                        {{ $weather['temperature'] }}°C
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 capitalize">
                                        {{ $weather['description'] }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-600 dark:text-gray-300">Humidity: {{ $weather['humidity'] }}%</p>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Wind: {{ $weather['wind_speed'] }} m/s</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif

    @if(auth()->user()->role_id === 2)
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <!-- Pending Tasks -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900/30">
                                <i class="fas fa-tasks text-2xl text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Pending Tasks</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $pendingTasks }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Today's Attendance -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 dark:bg-green-900/30">
                                <i class="fas fa-clipboard-check text-2xl text-green-600 dark:text-green-400"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Today's Attendance</p>
                                <div class="flex items-center mt-1">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                        {{ $todayAttendanceStatus === 'present' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 
                                           ($todayAttendanceStatus === 'late' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : 
                                           ($todayAttendanceStatus === 'absent' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400')) }}">
                                        {{ ucfirst(str_replace('_', ' ', $todayAttendanceStatus)) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            @if($todayAttendanceStatus === 'not_checked_in')
                                <form action="{{ route('user.attendance.time-in') }}" method="POST" class="time-in-form">
                                    @csrf
                                    <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                                        Check In
                                    </button>
                                </form>
                            @elseif($todayAttendanceStatus === 'present' || $todayAttendanceStatus === 'late')
                                <form action="{{ route('user.attendance.time-out') }}" method="POST" class="time-out-form">
                                    @csrf
                                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                                        Check Out
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Leave Requests -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900/30">
                                <i class="fas fa-calendar-times text-2xl text-purple-600 dark:text-purple-400"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Leave Requests</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $leaveRequestsCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Tasks -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900/30">
                                <i class="fas fa-calendar-alt text-2xl text-yellow-600 dark:text-yellow-400"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Upcoming Tasks</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $upcomingTasks->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Recent Tasks -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Recent Tasks</h3>
                            <a href="{{ route('user.tasks.index') }}" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">View All</a>
                        </div>
                        <div class="space-y-4">
                            @forelse($recentTasks as $task)
                                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ $task->title }}</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                Due: {{ $task->due_date->format('M d, Y') }}
                                            </p>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $task->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 
                                               ($task->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : 
                                               'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400') }}">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400 text-center py-4">No recent tasks</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Leave Requests -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Recent Leave Requests</h3>
                            <a href="{{ route('user.leave-requests.index') }}" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">View All</a>
                        </div>
                        <div class="space-y-4">
                            @forelse($recentLeaveRequests as $request)
                                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ $request->leave_type }}</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ $request->start_date->format('M d') }} - {{ $request->end_date->format('M d, Y') }}
                                            </p>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $request->status === 'approved' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 
                                               ($request->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : 
                                               'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400') }}">
                                            {{ ucfirst($request->status) }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400 text-center py-4">No recent leave requests</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Tasks Section -->
            <div class="mt-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Upcoming Tasks</h3>
                            <a href="{{ route('user.tasks.index') }}" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">View All</a>
                        </div>
                        <div class="space-y-4">
                            @forelse($upcomingTasks as $task)
                                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ $task->title }}</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                Due: {{ $task->due_date->format('M d, Y') }}
                                            </p>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $task->priority === 'high' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : 
                                               ($task->priority === 'medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : 
                                               'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400') }}">
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400 text-center py-4">No upcoming tasks</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>

<!-- Simple Employee Registration Modal -->
<div id="employeeModal" class="fixed inset-0 z-50 hidden">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black bg-opacity-50"></div>
    
    <!-- Modal -->
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Complete Your Profile</h3>
            </div>
            
            <!-- Form -->
            <form action="{{ route('employee.store') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Name</label>
                        <input type="text" name="first_name" id="first_name" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name</label>
                        <input type="text" name="last_name" id="last_name" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label for="contact_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                        <textarea name="address" id="address" required rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="mt-6 flex justify-end">
                    <button type="submit" 
                        class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check if user is registered as employee
    fetch('{{ route("employee.check") }}')
        .then(response => response.json())
        .then(data => {
            if (!data.isRegistered) {
                document.getElementById('employeeModal').classList.remove('hidden');
            }
        })
        .catch(error => console.error('Error:', error));

    // Handle time in form submission
    const timeInForm = document.querySelector('.time-in-form');
    if (timeInForm) {
        timeInForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            fetch('{{ route("user.attendance.time-in") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    }

    // Handle time out form submission
    const timeOutForm = document.querySelector('.time-out-form');
    if (timeOutForm) {
        timeOutForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            fetch('{{ route("user.attendance.time-out") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    }
});
</script>
