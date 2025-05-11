<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 border border-black">
                <div class="grid gridw-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <!-- Farm -->
                    <a href="{{ route('farm.index') }}" class="block overflow-hidden rounded-xl shadow-md border border-black"> <!-- Changed to rounded-xl and added overflow-hidden -->
                        <div style="background-image: url('https://i.pinimg.com/736x/d7/6a/f9/d76af9ea799e6480d6497059d43b1c04.jpg');"
                             class="relative items-center bg-cover bg-center bg-no-repeat p-6 text-center shadow overflow-hidden rounded-lg"> <!-- Added rounded-lg here -->
                            
                            <!-- White overlay -->
                            <div class="absolute inset-0 bg-white/10 backdrop-blur-sm rounded-lg"></div> <!-- Added rounded-lg here -->
                            
                            <!-- Content on top of overlay -->
                            <div class="relative z-10">
                                <img src="https://cdn-icons-png.flaticon.com/128/18363/18363848.png" alt="logo" class="size-33 mx-auto mb-2">
                                <h2 class="text-lg font-semibold text-white dark:text-gray-200">THE FARM</h2>
                            </div>
                        </div>
                    </a>
                    
                    <!-- Task -->
                    <a href="{{ route('admin.schedule.index') }}" class="block sm:rounded-lg p-1 shadow-md border border-black">
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 text-center rounded shadow">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Task</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Task info</p>
                        </div>
                    </a>
                    <!-- Weather -->
                    <a href="{{ route('weather.show', $currentCity ?? 'Manolo Fortich') }}" class="block sm:rounded-lg p-1 shadow-md border border-black">
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 text-center rounded shadow">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Weather Today</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Content for weather</p>
                        </div>
                    </a>
                    <!-- schedules -->
                    <a href="{{ route('admin.schedule.index') }}" class="block sm:rounded-lg p-1 shadow-md border border-black">
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 text-center rounded shadow">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Schedules</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Tables</p>
                        </div>
                    </a>
                    <!-- Human Resource -->
                    <a href="{{ route('hr.index') }}" class="block sm:rounded-lg p-1 shadow-md border border-black">
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 text-center rounded shadow">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200"> Human Resource</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">HR</p>
                        </div>
                    </a>
                    <!-- Progress -->
                    <a href="{{ route('farm.index') }}" class="block sm:rounded-lg p-1 shadow-md border border-black">
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 text-center rounded shadow">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Progress</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Farm's progress bar</p>
                        </div>
                    </a>
                    <!-- Livestocks -->
                    <a href="{{ route('farm.index') }}" class="block sm:rounded-lg p-1 shadow-md border border-black">
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 text-center rounded shadow">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Livestock</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Livestock Analytics</p>
                        </div>
                    </a>
                    <!-- Crops -->
                    <a href="{{ route('farm.index') }}" class="block sm:rounded-lg p-1 shadow-md border border-black">
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 text-center rounded shadow">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Crops</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Crops Analytics</p>
                        </div>
                    </a>
                    <!--FInance -->
                    <a href="{{ route('admin.finance.index') }}" class="block sm:rounded-lg p-1 shadow-md border border-black">
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 text-center rounded shadow">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Farm's Finance </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Finances</p>
                        </div>

                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
