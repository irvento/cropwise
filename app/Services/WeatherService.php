<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Client\RequestException;

class WeatherService
{
    protected string $apiKey;
    protected string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.weatherapi.key');
        $this->baseUrl = config('services.weatherapi.url');
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