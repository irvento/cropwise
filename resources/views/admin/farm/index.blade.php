<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Farm') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Task Management Card -->
                        <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm rounded-lg  border border-black">
                            <div class="p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Task Management</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage farm tasks and assignments</p>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('admin.tasks.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-600 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        View Tasks
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Date Card -->
                        <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-lg rounded-lg  border border-black">
                            <div class="p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Today's Date</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ now()->format('F d, Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Weather Card -->
                        <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-lg rounded-lg border border-black">
                            <div class="p-6">
                                <div class="text-center">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Weather in Manolo Fortich</h3>
                                    @if(isset($weatherData))
                                        <div class="flex justify-center items-center my-1">
                                            <img src="{{ $weatherData['icon'] }}" alt="Weather icon" class="w-16 h-16">
                                            <span class="text-gray-800 dark:text-gray-200 text-3xl ml-4">{{ $weatherData['temp_c'] }}°C</span>
                                        </div>
                                    @else
                                        <div class="text-center text-red-500">
                                            <p>Weather data unavailable</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Farm Management Card -->
                        <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-lg rounded-lg  border border-black">
                            <div class="p-6">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4 text-center">Farm Management</h3>
                                <div class="flex justify-center space-x-8">
                                    <!-- Crops Circle -->
                                    <a href="{{ route('admin.crops.index') }}" class="group">
                                        <div class="w-24 h-24 rounded-full bg-green-500 border-2 border-black shadow-lg flex items-center justify-center transform transition-transform duration-200 group-hover:scale-105 overflow-hidden">
                                            <img src="https://cdn-icons-png.flaticon.com/128/9923/9923298.png" alt="Crops" class="w-14 h-14 object-contain">
                                        </div>
                                        <p class="text-center mt-2 text-gray-700 dark:text-gray-300">Crops</p>
                                    </a>

                                    <!-- Livestock Circle -->
                                    <a href="{{ route('admin.farm.livestock.index') }}" class="group">
                                        <div class="w-24 h-24 rounded-full bg-yellow-500 border-2 border-black shadow-lg flex items-center justify-center transform transition-transform duration-200 group-hover:scale-105 overflow-hidden">
                                            <img src="https://cdn-icons-png.flaticon.com/128/3397/3397478.png" alt="Livestock" class="w-14 h-14 object-contain">
                                        </div>
                                        <p class="text-center mt-2 text-gray-700 dark:text-gray-300">Livestock</p>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Fields Card (standalone) -->
                        <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-lg rounded-lg mt-6  border border-black">
                            <div class="p-6 flex flex-col items-center">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4 text-center">Fields</h3>
                                <a href="{{ route('admin.fields.index') }}" class="group">
                                    <div class="w-24 h-24 rounded-full bg-blue-500 border-2 border-black shadow-lg flex items-center justify-center transform transition-transform duration-200 group-hover:scale-105 overflow-hidden">
                                        <img src="https://cdn-icons-png.flaticon.com/128/9923/9923298.png" alt="Fields" class="w-14 h-14 object-contain">
                                    </div>
                                    <p class="text-center mt-2 text-gray-700 dark:text-gray-300">Fields</p>
                                </a>
                            </div>
                        </div>

                        <!-- Finances Card -->
                        <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-lg rounded-lg  border border-black">
                            <div class="p-6">
                                <a href="{{ route('admin.finance.index') }}" class="group block">
                                <h4 class="text-lg font-semibold text-white flex items-center"><img src="https://cdn-icons-png.flaticon.com/128/781/781760.png" alt="finance" style="width: 20px; height: 20px;"> Finances</h4>
                                    <div class="bg-blue-500 border-2 border-black shadow-lg rounded-lg p-4 transform transition-transform duration-200 group-hover:scale-105 my-4">
                                        <div class="flex items-center space-x-4">
                                            <img src="https://cdn-icons-png.flaticon.com/128/1077/1077976.png" alt="Finances" class="w-12 h-12 object-contain">
                                            <div>
                                                
                                                <p class="text-blue-100">View financial reports and transactions</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Inventory Card -->
                        <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-lg rounded-lg  border border-black">
                            <div class="p-6">
                                <a href="{{ route('admin.inventory.index') }}" class="group block">

                                <h4 class="text-lg font-semibold text-white flex items-center"><img src="https://cdn-icons-png.flaticon.com/128/2897/2897785.png" alt="inventory" style="width: 20px; height: 20px;"> Inventory</h4>
                                    <div class="bg-yellow-500 border-2 border-black shadow-lg rounded-lg p-4 transform transition-transform duration-200 group-hover:scale-105 my-4">
                                        <div class="flex items-center space-x-4">
                                            <img src="https://cdn-icons-png.flaticon.com/128/2897/2897616.png" alt="Inventory" class="w-12 h-12 object-contain">
                                            <div>
                                                
                                                <p class="text-purple-100">Manage farm supplies and equipment</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Add more dashboard cards here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>