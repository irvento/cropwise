<?php

use App\Http\Controllers\farmController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//FARM
Route::get('/farm', [farmController::class, 'index'])->name('farm.index');

Route::get('/farm/crops', [farmController::class, 'cropsindex'])->name('crops.index');

Route::get('/farm/livestocks', [farmController::class, 'livestocksindex'])->name('livestocks.index');
