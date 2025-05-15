<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Weather Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Current Weather Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                @if($weatherData)
                    <div class="text-center">
                        <h1 class="text-gray-800 dark:text-gray-200 text-2xl font-bold mb-4">
                            Weather in {{ $weatherData['city'] }}, {{ $weatherData['country'] }}
                        </h1>
                        <p class="text-gray-500 mb-2">Last updated: {{ $weatherData['last_updated'] }}</p>
                        
                        <div class="flex justify-center items-center my-6">
                            <img src="{{ $weatherData['icon'] }}" alt="Weather icon" class="w-24 h-24">
                            <span class="text-gray-800 dark:text-gray-200 text-4xl ml-4">{{ $weatherData['temp_c'] }}°C</span>
                        </div>
                        
                        <p class="text-gray-800 dark:text-gray-200 text-xl mb-2">{{ $weatherData['condition'] }}</p>
                        <p class="text-gray-600">Feels like: {{ $weatherData['feelslike_c'] }}°C</p>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8 max-w-2xl mx-auto">
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                <p class="text-gray-500">Humidity</p>
                                <p class="text-xl">{{ $weatherData['humidity'] }}%</p>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                <p class="text-gray-500">Wind Speed</p>
                                <p class="text-xl">{{ $weatherData['wind_kph'] }} km/h</p>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                <p class="text-gray-500">UV Index</p>
                                <p class="text-xl">{{ $weatherData['uv'] ?? 'N/A' }}</p>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                <p class="text-gray-500">Precipitation</p>
                                <p class="text-xl">{{ $weatherData['precip_mm'] ?? '0' }} mm</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center text-red-500">
                        <p>Unable to retrieve weather data. Please try again later.</p>
                    </div>
                @endif
            </div>


            <!-- Monthly Forecast -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 border border-gray-200 dark:border-gray-700">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Monthly Weather Forecast</h2>
                <div class="grid grid-cols-1">
                    @foreach($weatherForecast as $month => $forecast)
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200 dark:border-gray-600">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">{{ $month }}</h3>
                            <span class="px-4 py-2 text-sm font-semibold rounded-full border border-gray-200 dark:border-gray-600
                                {{ $forecast['season'] === 'Summer' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : 
                                   ($forecast['season'] === 'Rainy' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : 
                                   'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400') }}">
                                {{ $forecast['season'] }}
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-6 mb-6">
                            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-gray-600">
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Average Temperature</p>
                                <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ $forecast['avg_temp'] }}°C</p>
                            </div>
                            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-gray-600">
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Average Rainfall</p>
                                <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ $forecast['avg_rain'] }} mm</p>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm mb-6 border border-gray-200 dark:border-gray-600">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Most Common Condition</p>
                            <p class="text-lg font-semibold text-gray-800 dark:text-gray-200 capitalize">{{ $forecast['most_common_condition'] }}</p>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Daily Forecast</p>
                            <div class="space-y-2 max-h-60 overflow-y-auto pr-2 custom-scrollbar border border-gray-200 dark:border-gray-600 rounded-lg p-2">
                                @foreach($forecast['days'] as $day)
                                <div class="flex items-center justify-between bg-white dark:bg-gray-800 rounded-lg p-3 shadow-sm hover:shadow-md transition-shadow duration-200 border border-gray-200 dark:border-gray-600">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($day['date'])->format('M d') }}
                                    </span>
                                    <div class="flex items-center space-x-3">
                                        <img src="{{ $day['icon'] }}" alt="Weather icon" class="w-8 h-8">
                                        <span class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $day['temp'] }}°C</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <style>
                .custom-scrollbar::-webkit-scrollbar {
                    width: 6px;
                }
                .custom-scrollbar::-webkit-scrollbar-track {
                    background: transparent;
                }
                .custom-scrollbar::-webkit-scrollbar-thumb {
                    background-color: rgba(156, 163, 175, 0.5);
                    border-radius: 3px;
                }
                .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                    background-color: rgba(156, 163, 175, 0.7);
                }
            </style>
        </div>
    </div>
</x-app-layout>