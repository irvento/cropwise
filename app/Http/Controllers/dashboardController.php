<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Share city with all views
        View::share('currentCity', $this->getCityFromIp());
    }

    public function index()
    {
        return view('dashboard'); // Your main dashboard view
    }
    
    protected function getCityFromIp(): string
    {
        $ip = request()->ip();

        if (app()->environment('local')) {
            return 'Manolo Fortich'; // Default for local development
        }

        try {
            $response = Http::retry(3, 100)
                ->get("http://ip-api.com/json/{$ip}?fields=status,city");

            if ($response->successful() && $response->json()['status'] === 'success') {
                return $response->json()['city'] ?? 'Manolo Fortich';
            }
        } catch (\Exception $e) {
            report($e); // Log the error
        }

        return 'Manolo Fortich';
    }
}