<!-- resources/views/sidenav-menu.blade.php -->
<div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 min-h-screen bg-lime-100 dark:bg-gray-900 shadow-lg p-6 border-r border-black dark:border-gray-700 transition-all duration-300">
        <nav class="space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="flex items-center group space-x-4 text-gray-800 dark:text-gray-200 hover:text-blue-500 dark:hover:text-blue-400 transition-all duration-200 px-4 py-3 rounded-md hover:bg-blue-50 dark:hover:bg-gray-800 hover:shadow-sm">
                <i class="fas fa-tachometer-alt text-blue-500 text-xl transform group-hover:scale-110 transition-transform"></i>
                <span class="font-medium ml-3 group-hover:font-semibold">Dashboard</span>
                <i class="fas fa-chevron-right ml-auto text-xs text-blue-400 opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>

            <!-- Farm Management -->
            <a href="{{ route('farm.index') }}" class="flex items-center group space-x-4 text-gray-800 dark:text-gray-200 hover:text-green-500 dark:hover:text-green-400 transition-all duration-200 px-4 py-3 rounded-md hover:bg-green-50 dark:hover:bg-gray-800 hover:shadow-sm">
                <i class="fas fa-tractor text-green-500 text-xl transform group-hover:scale-110 transition-transform"></i>
                <span class="font-medium ml-3 group-hover:font-semibold">Farm Management</span>
                <i class="fas fa-chevron-right ml-auto text-xs text-green-400 opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>

            <!-- Schedules -->
            <a href="{{ route('admin.schedule.index') }}" class="flex items-center group space-x-4 text-gray-800 dark:text-gray-200 hover:text-purple-500 dark:hover:text-purple-400 transition-all duration-200 px-4 py-3 rounded-md hover:bg-purple-50 dark:hover:bg-gray-800 hover:shadow-sm">
                <i class="fas fa-calendar-alt text-purple-500 text-xl transform group-hover:scale-110 transition-transform"></i>
                <span class="font-medium ml-3 group-hover:font-semibold">Schedules</span>
                <i class="fas fa-chevron-right ml-auto text-xs text-purple-400 opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>

            <!-- Inventory -->
            <a href="{{ route('admin.inventory.index') }}" class="flex items-center group space-x-4 text-gray-800 dark:text-gray-200 hover:text-amber-500 dark:hover:text-amber-400 transition-all duration-200 px-4 py-3 rounded-md hover:bg-amber-50 dark:hover:bg-gray-800 hover:shadow-sm">
                <i class="fas fa-warehouse text-amber-500 text-xl transform group-hover:scale-110 transition-transform"></i>
                <span class="font-medium ml-3 group-hover:font-semibold">Inventory</span>
                <i class="fas fa-chevron-right ml-auto text-xs text-amber-400 opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>

            <!-- Financial Reports -->
            <a href="{{ route('admin.finance.index') }}" class="flex items-center group space-x-4 text-gray-800 dark:text-gray-200 hover:text-emerald-500 dark:hover:text-emerald-400 transition-all duration-200 px-4 py-3 rounded-md hover:bg-emerald-50 dark:hover:bg-gray-800 hover:shadow-sm">
                <i class="fas fa-chart-line text-emerald-500 text-xl transform group-hover:scale-110 transition-transform"></i>
                <span class="font-medium ml-3 group-hover:font-semibold">Finance Management</span>
                <i class="fas fa-chevron-right ml-auto text-xs text-emerald-400 opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>

            <!-- Human Resources -->
            <a href="{{ route('hr.index') }}" class="flex items-center group space-x-4 text-gray-800 dark:text-gray-200 hover:text-indigo-500 dark:hover:text-indigo-400 transition-all duration-200 px-4 py-3 rounded-md hover:bg-indigo-50 dark:hover:bg-gray-800 hover:shadow-sm">
                <i class="fas fa-users text-indigo-500 text-xl transform group-hover:scale-110 transition-transform"></i>
                <span class="font-medium ml-3 group-hover:font-semibold">Human Resources</span>
                <i class="fas fa-chevron-right ml-auto text-xs text-indigo-400 opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>

            <div class="border-t border-gray-300 dark:border-gray-600 my-4"></div>

            <!-- My Profile -->
            <a href="{{ route('profile.show') }}" class="flex items-center group space-x-4 text-gray-800 dark:text-gray-200 hover:text-pink-500 dark:hover:text-pink-400 transition-all duration-200 px-4 py-3 rounded-md hover:bg-pink-50 dark:hover:bg-gray-800 hover:shadow-sm">
                <i class="fas fa-user text-pink-500 text-xl transform group-hover:scale-110 transition-transform"></i>
                <span class="font-medium ml-3 group-hover:font-semibold">My Profile</span>
                <i class="fas fa-chevron-right ml-auto text-xs text-pink-400 opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center group space-x-4 w-full text-left text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition-all duration-200 px-4 py-3 rounded-md hover:bg-red-50 dark:hover:bg-gray-800 hover:shadow-sm">
                    <i class="fas fa-sign-out-alt text-red-500 text-xl transform group-hover:scale-110 transition-transform group-hover:animate-pulse"></i>
                    <span class="font-medium ml-3 group-hover:font-semibold">Logout</span>
                    <i class="fas fa-chevron-right ml-auto text-xs text-red-400 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                </button>
            </form>
        </nav>
    </aside>
    
</div>