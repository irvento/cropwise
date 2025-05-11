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
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\FullCalenderController;

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

Route::get('/hr', [hrController::class, 'index'])->name('hr.index');

// Task management routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('inventory', inventoryController::class);
    Route::resource('finance', financeController::class);
    Route::resource('crops', cropController::class);
    Route::get('crops/{crop}/schedules', [CropController::class, 'getPlantingSchedules'])->name('crops.schedules');
    Route::get('crops/{crop}/fields', [CropController::class, 'getFields'])->name('crops.fields');
    Route::resource('tasks', TaskController::class)->names([
        'index' => 'tasks.index',
        'create' => 'tasks.create',
        'store' => 'tasks.store',
        'show' => 'tasks.show',
        'edit' => 'tasks.edit',
        'update' => 'tasks.update',
        'destroy' => 'tasks.destroy',
    ]);
    Route::resource('fields', fieldController::class);
    Route::resource('planting-schedules', PlantingScheduleController::class)->names([
        'index' => 'planting-schedules.index',
        'create' => 'planting-schedules.create',
        'store' => 'planting-schedules.store',
        'show' => 'planting-schedules.show',
        'edit' => 'planting-schedules.edit',
        'update' => 'planting-schedules.update',
        'destroy' => 'planting-schedules.destroy',
    ]);
    Route::resource('inventory-category', inventorycategoryController::class);
    Route::resource('inventory-transactions', inventorytransactionController::class);
    Route::resource('supplier', SupplierController::class);

    // Schedule Routes
    Route::prefix('schedule')->name('schedule.')->group(function () {
        Route::get('/', [ScheduleController::class, 'index'])->name('index');
        Route::get('/create', [ScheduleController::class, 'create'])->name('create');
        Route::post('/store', [ScheduleController::class, 'store'])->name('store');
        Route::get('/{id}/{type}/edit', [ScheduleController::class, 'edit'])->name('edit');
        Route::put('/{id}/{type}', [ScheduleController::class, 'update'])->name('update');
        Route::delete('/{id}/{type}', [ScheduleController::class, 'destroy'])->name('destroy');
    });
});

// Calendar Routes
Route::controller(FullCalenderController::class)->group(function(){
    Route::get('fullcalender', 'index')->name('fullcalender');
    Route::post('fullcalenderAjax', 'ajax')->name('fullcalenderAjax');
});