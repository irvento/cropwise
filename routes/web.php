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
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PayrollController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\dashboardController::class, 'index'])->name('dashboard');
});

//WEATHER
Route::get('/weather/{city}', [WeatherController::class, 'show'])->name('weather.show');

//FARM
Route::get('/farm', [farmController::class, 'index'])->name('farm.index');

Route::get('/farm/livestocks', [farmController::class, 'livestocksindex'])->name('admin.farm.livestocks.index');

Route::get('/hr', [hrController::class, 'index'])->name('hr.index');

// HR Routes
Route::prefix('hr')->name('hr.')->group(function () {
    // Dashboard
    Route::get('/', [hrController::class, 'index'])->name('index');
    
    // Leave Management
    Route::get('/leave', [hrController::class, 'leaveindex'])->name('leave.index');
    Route::get('/leave/create', [LeaveRequestController::class, 'create'])->name('leave.create');
    Route::post('/leave', [LeaveRequestController::class, 'store'])->name('leave.store');
    Route::get('/leave/{leaveRequest}', [LeaveRequestController::class, 'show'])->name('leave.show');
    Route::get('/leave/{leaveRequest}/edit', [LeaveRequestController::class, 'edit'])->name('leave.edit');
    Route::put('/leave/{leaveRequest}', [LeaveRequestController::class, 'update'])->name('leave.update');
    Route::delete('/leave/{leaveRequest}', [LeaveRequestController::class, 'destroy'])->name('leave.destroy');

    // Attendance
    Route::get('/attendance', [hrController::class, 'attendanceindex'])->name('attendance.index');
    Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('/attendance/{attendance}', [AttendanceController::class, 'show'])->name('attendance.show');
    Route::get('/attendance/{attendance}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
    Route::put('/attendance/{attendance}', [AttendanceController::class, 'update'])->name('attendance.update');
    Route::delete('/attendance/{attendance}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');

    // Payroll
    Route::get('/payroll', [hrController::class, 'payrollindex'])->name('payroll.index');
    Route::get('/payroll/create', [PayrollController::class, 'create'])->name('payroll.create');
    Route::post('/payroll', [PayrollController::class, 'store'])->name('payroll.store');
    Route::get('/payroll/{payroll}', [PayrollController::class, 'show'])->name('payroll.show');
    Route::get('/payroll/{payroll}/edit', [PayrollController::class, 'edit'])->name('payroll.edit');
    Route::put('/payroll/{payroll}', [PayrollController::class, 'update'])->name('payroll.update');
    Route::delete('/payroll/{payroll}', [PayrollController::class, 'destroy'])->name('payroll.destroy');
    Route::post('/payroll/generate-monthly', [PayrollController::class, 'generateMonthly'])->name('payroll.generate-monthly');

    // Employees
    Route::get('/employees', [hrController::class, 'employeesindex'])->name('employees.index');
});

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