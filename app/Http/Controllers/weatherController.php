<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Client\RequestException;

class WeatherController extends Controller
{
    public function __construct(
        protected WeatherService $weatherService
    ) {}

    public function show(string $city)
    {
        try {
            $weatherData = $this->weatherService->getWeatherByCity($city);
            
            return view('weather.show', [
                'weatherData' => $weatherData,
                'city' => $city
            ]);
            
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'message' => 'Failed to fetch weather data: ' . $e->getMessage()
            ]);
        }
    }
}