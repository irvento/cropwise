<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function getWeatherByCity($city)
    {
        $apiKey = config('services.openweather.key');
        $url = config('services.openweather.url') . "weather?q={$city}&appid={$apiKey}&units=metric";

        $response = Http::get($url);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}

?>