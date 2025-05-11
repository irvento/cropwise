<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/events', function () {
    return response()->json([
        [
            'title' => 'Planting Day',
            'start' => '2025-05-15',
            'end' => '2025-05-16'
        ],
        [
            'title' => 'Harvesting',
            'start' => '2025-05-20',
            'end' => '2025-05-21'
        ],
    ]);
});