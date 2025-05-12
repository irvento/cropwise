<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $header ?? __('User Dashboard') }}
            </h2>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600 dark:text-gray-400">
                    {{ Auth::user()->name }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Navigation Menu -->
            <div class="mb-6">
                <nav class="flex space-x-4" aria-label="Tabs">
                    <a href="{{ route('dashboard') }}" 
                        class="px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('user.tasks.index') }}" 
                        class="px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('user.tasks.*') ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300' }}">
                        My Tasks
                    </a>
                    <a href="{{ route('user.attendance.index') }}" 
                        class="px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('user.attendance.*') ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300' }}">
                        My Attendance
                    </a>
                    <a href="{{ route('user.leave-requests.index') }}" 
                        class="px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('user.leave-requests.*') ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300' }}">
                        My Leave Requests
                    </a>
                    <a href="{{ route('user.payroll.index') }}" 
                        class="px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('user.payroll.*') ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300' }}">
                        My Payroll
                    </a>
                </nav>
            </div>

            <!-- Page Content -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 