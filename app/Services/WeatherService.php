<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Client\RequestException;

class WeatherService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.openweathermap.org/data/2.5';

    public function __construct()
    {
        $this->apiKey = config('services.weather.api_key');
    }

    public function getCurrentWeather($city)
    {
        return Cache::remember("weather.{$city}", 3600, function () use ($city) {
            $response = Http::get("{$this->baseUrl}/weather", [
                'q' => $city,
                'appid' => $this->apiKey,
                'units' => 'metric'
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'temperature' => $data['main']['temp'],
                    'description' => $data['weather'][0]['description'],
                    'icon' => $data['weather'][0]['icon'],
                    'humidity' => $data['main']['humidity'],
                    'wind_speed' => $data['wind']['speed']
                ];
            }

            return null;
        });
    }

    public function getWeatherByCity(string $city): array
    {
        return Cache::remember("weather.{$city}", now()->addHour(), function() use ($city) {
            $response = Http::baseUrl($this->baseUrl)
                ->get('/current.json', [
                    'key' => $this->apiKey,
                    'q' => $city,
                    'aqi' => 'no'
                ]);

            $response->throw();

            return $this->formatWeatherData($response->json());
        });
    }

    protected function formatWeatherData(array $data): array
    {
        return [
            'city' => $data['location']['name'],
            'country' => $data['location']['country'],
            'temp_c' => $data['current']['temp_c'],
            'temp_f' => $data['current']['temp_f'],
            'condition' => $data['current']['condition']['text'],
            'icon' => $data['current']['condition']['icon'],
            'humidity' => $data['current']['humidity'],
            'wind_kph' => $data['current']['wind_kph'],
            'feelslike_c' => $data['current']['feelslike_c'],
            'last_updated' => $data['current']['last_updated'],
        ];
    }
}