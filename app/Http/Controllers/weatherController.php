<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function __construct(
        protected WeatherService $weatherService
    ) {}

    public function show(string $city = null)
    {
        try {
            // If city is not provided, detect it using IP
            if (!$city) {
                $city = $this->getCityFromIp();
            }

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

    protected function getCityFromIp(): string
    {
        $ip = request()->ip();

        // Use a fallback IP for local development
        if ($ip === '127.0.0.1' || $ip === '::1') {
            $ip = '8.8.8.8'; // Google DNS (example)
        }

        $response = Http::get("http://ip-api.com/json/{$ip}");

        if ($response->successful()) {
            return $response->json()['city'] ?? 'Unknown';
        }

        return 'Manolo Fortich';
    }
}
