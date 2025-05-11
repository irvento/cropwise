<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Farm Management Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Overview Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Total Fields -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                                <i class="fas fa-map-marked-alt text-2xl text-green-600 dark:text-green-300"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Fields</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $totalFields ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Crops -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                                <i class="fas fa-seedling text-2xl text-blue-600 dark:text-blue-300"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Crops</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $activeCrops ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Tasks -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900">
                                <i class="fas fa-tasks text-2xl text-yellow-600 dark:text-yellow-300"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pending Tasks</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $pendingTasks ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Livestock -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900">
                                <i class="fas fa-cow text-2xl text-purple-600 dark:text-purple-300"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Livestock</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $totalLivestock ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Farm Overview -->
                <a href="{{ route('farm.index') }}" class="block overflow-hidden rounded-xl shadow-md border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow duration-200">
                    <div class="relative bg-gradient-to-br from-green-500 to-green-600 p-6 text-center">
                        <div class="absolute inset-0 bg-white/10 backdrop-blur-sm"></div>
                        <div class="relative z-10">
                            <i class="fas fa-tractor text-4xl text-white mb-4"></i>
                            <h3 class="text-xl font-semibold text-white">Farm Overview</h3>
                            <p class="text-white/80 mt-2">Manage fields, crops, and livestock</p>
                            </div>
                        </div>
                    </a>
                    
                <!-- Schedule Management -->
                <a href="{{ route('admin.schedule.index') }}" class="block overflow-hidden rounded-xl shadow-md border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow duration-200">
                    <div class="relative bg-gradient-to-br from-blue-500 to-blue-600 p-6 text-center">
                        <div class="absolute inset-0 bg-white/10 backdrop-blur-sm"></div>
                        <div class="relative z-10">
                            <i class="fas fa-calendar-alt text-4xl text-white mb-4"></i>
                            <h3 class="text-xl font-semibold text-white">Schedule Management</h3>
                            <p class="text-white/80 mt-2">Tasks and planting schedules</p>
                        </div>
                        </div>
                    </a>

                    <!-- Weather -->
                <a href="{{ route('weather.show', $currentCity ?? 'Manolo Fortich') }}" class="block overflow-hidden rounded-xl shadow-md border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow duration-200">
                    <div class="relative bg-gradient-to-br from-yellow-500 to-yellow-600 p-6 text-center">
                        <div class="absolute inset-0 bg-white/10 backdrop-blur-sm"></div>
                        <div class="relative z-10">
                            <i class="fas fa-cloud-sun text-4xl text-white mb-4"></i>
                            <h3 class="text-xl font-semibold text-white">Weather</h3>
                            <p class="text-white/80 mt-2">Current weather and forecasts</p>
                        </div>
                        </div>
                    </a>

                <!-- Human Resources -->
                <a href="{{ route('hr.index') }}" class="block overflow-hidden rounded-xl shadow-md border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow duration-200">
                    <div class="relative bg-gradient-to-br from-purple-500 to-purple-600 p-6 text-center">
                        <div class="absolute inset-0 bg-white/10 backdrop-blur-sm"></div>
                        <div class="relative z-10">
                            <i class="fas fa-users text-4xl text-white mb-4"></i>
                            <h3 class="text-xl font-semibold text-white">Human Resources</h3>
                            <p class="text-white/80 mt-2">Manage employees and tasks</p>
                        </div>
                        </div>
                    </a>

                <!-- Inventory -->
                <a href="{{ route('admin.inventory.index') }}" class="block overflow-hidden rounded-xl shadow-md border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow duration-200">
                    <div class="relative bg-gradient-to-br from-red-500 to-red-600 p-6 text-center">
                        <div class="absolute inset-0 bg-white/10 backdrop-blur-sm"></div>
                        <div class="relative z-10">
                            <i class="fas fa-warehouse text-4xl text-white mb-4"></i>
                            <h3 class="text-xl font-semibold text-white">Inventory</h3>
                            <p class="text-white/80 mt-2">Manage supplies and equipment</p>
                        </div>
                        </div>
                    </a>

                <!-- Finance -->
                <a href="{{ route('admin.finance.index') }}" class="block overflow-hidden rounded-xl shadow-md border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow duration-200">
                    <div class="relative bg-gradient-to-br from-indigo-500 to-indigo-600 p-6 text-center">
                        <div class="absolute inset-0 bg-white/10 backdrop-blur-sm"></div>
                        <div class="relative z-10">
                            <i class="fas fa-chart-line text-4xl text-white mb-4"></i>
                            <h3 class="text-xl font-semibold text-white">Finance</h3>
                            <p class="text-white/80 mt-2">Track income and expenses</p>
                        </div>
                        </div>
                    </a>
            </div>

            <!-- Recent Schedules Section -->
            <div class="mt-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Recent Schedules</h3>
                        <div class="space-y-4">
                            @forelse($recentSchedules as $schedule)
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <i class="fas {{ $schedule->icon }} text-lg 
                                            @if($schedule->type === 'task')
                                                @if($schedule->priority === 'high') text-red-500
                                                @elseif($schedule->priority === 'medium') text-yellow-500
                                                @else text-green-500
                                                @endif
                                            @else text-blue-500
                                            @endif">
                                        </i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $schedule->title }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            {{ $schedule->description }}
                                        </p>
                                        <p class="text-xs text-gray-400">
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
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Upcoming Tasks</h3>
                        <div class="space-y-4">
                            @forelse($upcomingTasks as $task)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-tasks text-lg text-blue-500"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $task->title }}
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                Due: {{ $task->due_date->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        @if($task->priority === 'high') bg-red-100 text-red-800
                                        @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-800
                                        @else bg-green-100 text-green-800
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
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Financial Summary</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                                <p class="text-sm font-medium text-green-800 dark:text-green-200">Income</p>
                                <p class="text-2xl font-semibold text-green-600 dark:text-green-300">
                                    ₱{{ number_format($financialSummary['income'], 2) }}
                                </p>
                            </div>
                            <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-lg">
                                <p class="text-sm font-medium text-red-800 dark:text-red-200">Expenses</p>
                                <p class="text-2xl font-semibold text-red-600 dark:text-red-300">
                                    ₱{{ number_format($financialSummary['expenses'], 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                        </div>

            <!-- Weather Section -->
            @if($weather)
            <div class="mt-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Current Weather</h3>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <img src="http://openweathermap.org/img/wn/{{ $weather['icon'] }}@2x.png" alt="Weather icon">
                                <div>
                                    <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                        {{ $weather['temperature'] }}°C
                                    </p>
                                    <p class="text-sm text-gray-500 capitalize">
                                        {{ $weather['description'] }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500">Humidity: {{ $weather['humidity'] }}%</p>
                                <p class="text-sm text-gray-500">Wind: {{ $weather['wind_speed'] }} m/s</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
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
});
</script>
