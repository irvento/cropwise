<?php

use App\Http\Controllers\farmController;
use App\Http\Controllers\financeController;
use App\Http\Controllers\fieldController;
use App\Http\Controllers\hrController;
use App\Http\Controllers\inventoryController;
use App\Http\Controllers\schedulesController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cropController;
use App\Http\Controllers\PlantingScheduleController;    
use App\Http\Controllers\inventorycategoryController;
use App\Http\Controllers\inventorytransactionController;
use App\Http\Controllers\SupplierController;

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

//WEATHER
Route::get('/weather/{city}', [WeatherController::class, 'show'])->name('weather.show');

//FARM
Route::get('/farm', [farmController::class, 'index'])->name('farm.index');


Route::get('/farm/livestocks', [farmController::class, 'livestocksindex'])->name('admin.farm.livestocks.index');

Route::get('/schedule', [schedulesController::class, 'index'])->name('schedule.index');




Route::get('/hr', [hrController::class, 'index'])->name('hr.index');


// Task management routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('inventory', inventoryController::class);
    Route::resource('finance', financeController::class);
    Route::resource('crops', cropController::class);
    Route::get('crops/{crop}/schedules', action: [CropController::class, 'getPlantingSchedules'])->name('crops.schedules');
    Route::get('crops/{crop}/fields', [CropController::class, 'getFields'])->name('crops.fields');
    Route::resource('tasks', TaskController::class);
    Route::resource('fields', fieldController::class);
    Route::resource('planting-schedules', PlantingScheduleController::class);
    Route::resource('inventory-category', inventorycategoryController::class);
    Route::resource('inventory-transactions', inventorytransactionController::class);
    Route::resource('supplier', SupplierController::class);
});

