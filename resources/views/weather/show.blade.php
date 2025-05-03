<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Weather Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if($weatherData)
                    <div class="text-center">
                        <h1 class="text-2xl font-bold mb-4">
                            Weather in {{ $weatherData['city'] }}, {{ $weatherData['country'] }}
                        </h1>
                        <p class="text-gray-500 mb-2">Last updated: {{ $weatherData['last_updated'] }}</p>
                        
                        <div class="flex justify-center items-center my-6">
                            <img src="{{ $weatherData['icon'] }}" alt="Weather icon" class="w-24 h-24">
                            <span class="text-4xl ml-4">{{ $weatherData['temp_c'] }}°C</span>
                        </div>
                        
                        <p class="text-xl mb-2">{{ $weatherData['condition'] }}</p>
                        <p class="text-gray-600">Feels like: {{ $weatherData['feelslike_c'] }}°C</p>
                        
                        <div class="grid grid-cols-2 gap-4 mt-8 max-w-md mx-auto">
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                <p class="text-gray-500">Humidity</p>
                                <p class="text-xl">{{ $weatherData['humidity'] }}%</p>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                <p class="text-gray-500">Wind Speed</p>
                                <p class="text-xl">{{ $weatherData['wind_kph'] }} km/h</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center text-red-500">
                        <p>Unable to retrieve weather data. Please try again later.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>