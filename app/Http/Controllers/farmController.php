<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class farmController extends Controller
{
    public function __construct(
        protected WeatherService $weatherService
    ) {}

    public function index()
    {
        try {
            $weatherData = $this->weatherService->getWeatherByCity('Manolo Fortich');
        } catch (\Exception $e) {
            $weatherData = null;
        }

        return view('admin.farm.index', [
            'weatherData' => $weatherData
        ]);
    }

  

    public function livestocksindex()
    {
        $livestock = \App\Models\Livestock::latest()->paginate(10);
        return view('admin.farm.livestock.index', compact('livestock'));
    }

} 