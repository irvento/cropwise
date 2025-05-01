<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Disclaimer: This is an initial dashboard for reference; it will be further refined in development -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 space-y-6">

                <!-- First Row -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2">The Farm</h3>
                        <p class="text-gray-600 dark:text-gray-300">farm</p>
                    </div>

                    <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2">Finance</h3>
                        <p class="text-gray-600 dark:text-gray-300">Financi...</p>
                    </div>

                    <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2">Inventory</h3>
                        <p class="text-gray-600 dark:text-gray-300">Inventory</p>
                    </div>
                </div>

                <!-- Second Row -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2">Weather</h3>
                        <p class="text-gray-600 dark:text-gray-300">weather conditions...</p>
                    </div>

                    <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2">Stats</h3>
                        <p class="text-gray-600 dark:text-gray-300">Some additional information...</p>
                    </div>

                    <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2">Stats 2</h3>
                        <p class="text-gray-600 dark:text-gray-300">More additional information...</p>
                    </div>
                </div>

                <!-- Full Width Row -->
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2">Stats 3</h3>
                    <p class="text-gray-600 dark:text-gray-300">Details about one more info...</p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
