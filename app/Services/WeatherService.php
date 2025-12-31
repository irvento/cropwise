<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Client\RequestException;

class WeatherService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.weatherapi.com/v1';

    public function __construct()
    {
        $this->apiKey = config('services.weatherapi.key');
    }

    public function getCurrentWeather($city)
    {
        return Cache::remember("weather.{$city}", 3600, function () use ($city) {
            $response = Http::get("{$this->baseUrl}/current.json", [
                'key' => $this->apiKey,
                'q' => $city,
                'aqi' => 'no'
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'temperature' => $data['current']['temp_c'],
                    'description' => $data['current']['condition']['text'],
                    'icon' => $data['current']['condition']['icon'],
                    'humidity' => $data['current']['humidity'],
                    'wind_speed' => $data['current']['wind_kph']
                ];
            }

            return null;
        });
    }

    public function getWeatherByCity(string $city): array
    {
        return Cache::remember("weather.{$city}", now()->addHour(), function() use ($city) {
            $response = Http::get("{$this->baseUrl}/current.json", [
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
        'city' => $data['location']['name'] ?? '',
        'country' => $data['location']['country'] ?? '',
        'temp_c' => $data['current']['temp_c'] ?? null,
        'temp_f' => $data['current']['temp_f'] ?? null,
        'condition' => $data['current']['condition']['text'] ?? '',
        'icon' => $data['current']['condition']['icon'] ?? '',
        'humidity' => $data['current']['humidity'] ?? null,
        'wind_kph' => $data['current']['wind_kph'] ?? null,
        'feelslike_c' => $data['current']['feelslike_c'] ?? null,
        'last_updated' => $data['current']['last_updated'] ?? '',
        'uv' => $data['current']['uv'] ?? null,
        'precip_mm' => $data['current']['precip_mm'] ?? 0
    ];
    }

    public function getTwoMonthForecast(string $city): array
    {
        return Cache::remember("weather.forecast.{$city}", now()->addHours(12), function() use ($city) {
            $response = Http::baseUrl($this->baseUrl)
                ->get('/forecast.json', [
                    'key' => $this->apiKey,
                    'q' => $city,
                    'days' => 60, // Get forecast for 60 days
                    'aqi' => 'no',
                    'alerts' => 'no'
                ]);

            $response->throw();
            $data = $response->json();

            // Group forecast by month
            $monthlyForecast = [];
            $currentMonth = null;
            $monthlyStats = [
                'avg_temp' => 0,
                'total_rain' => 0,
                'conditions' => [],
                'days' => 0
            ];

            // Get current date and calculate end date (2 months from now)
            $currentDate = now();
            $endDate = $currentDate->copy()->addMonths(2)->endOfMonth();

            // Initialize the two months we want to show
            $firstMonth = $currentDate->format('F Y');
            $secondMonth = $currentDate->copy()->addMonth()->format('F Y');
            $thirdMonth = $currentDate->copy()->addMonths(2)->format('F Y');

            // Initialize the months in the forecast array
            $monthlyForecast[$firstMonth] = [
                'month' => $firstMonth,
                'days' => [],
                'avg_temp' => 0,
                'avg_rain' => 0,'total_rain' => 0,
                'most_common_condition' => '',
                'season' => $this->determineSeason($currentDate)
            ];

            $monthlyForecast[$secondMonth] = [
                'month' => $secondMonth,
                'days' => [],
                'avg_temp' => 0,
                'avg_rain' => 0,'total_rain' => 0,
                'most_common_condition' => '',
                'season' => $this->determineSeason($currentDate->copy()->addMonth())
            ];

            $monthlyForecast[$thirdMonth] = [
                'month' => $thirdMonth,
                'days' => [],
                'avg_temp' => 0,
                'avg_rain' => 0,'total_rain' => 0,
                'most_common_condition' => '',
                'season' => $this->determineSeason($currentDate->copy()->addMonths(2))
            ];

            foreach ($data['forecast']['forecastday'] as $day) {
                $date = \Carbon\Carbon::parse($day['date']);
                $month = $date->format('F Y');

                // Skip if the date is not within our target months
                if (!isset($monthlyForecast[$month])) {
                    continue;
                }

                // Add day's data
                $monthlyForecast[$month]['days'][] = [
                    'date' => $day['date'],
                    'temp' => $day['day']['avgtemp_c'],
                    'condition' => $day['day']['condition']['text'],
                    'rain' => $day['day']['totalprecip_mm'],
                    'icon' => $day['day']['condition']['icon']
                ];

                // Update monthly stats
                $monthlyForecast[$month]['avg_temp'] += $day['day']['avgtemp_c'];
                $monthlyForecast[$month]['total_rain'] += $day['day']['totalprecip_mm'];
                $monthlyForecast[$month]['conditions'][] = $day['day']['condition']['text'];
            }

            // Calculate averages and most common conditions for each month
            foreach ($monthlyForecast as $month => &$forecast) {
                if (count($forecast['days']) > 0) {
                    $forecast['avg_temp'] = round($forecast['avg_temp'] / count($forecast['days']), 1);
                    $forecast['avg_rain'] = round($forecast['total_rain'] / count($forecast['days']), 1);
                    $forecast['most_common_condition'] = $this->getMostCommonCondition($forecast['conditions']);
                }
            }

            // Sort months chronologically
            ksort($monthlyForecast);

            return $monthlyForecast;
        });
    }

    protected function getMostCommonCondition(array $conditions): string
    {
        $counts = array_count_values($conditions);
        arsort($counts);
        return key($counts);
    }

    protected function determineSeason(\Carbon\Carbon $date): string
    {
        $month = $date->month;
        
        // For Philippines (tropical climate)
        if ($month >= 3 && $month <= 5) {
            return 'Summer';
        } elseif ($month >= 6 && $month <= 11) {
            return 'Rainy';
        } else {
            return 'Dry';
        }
    }
}