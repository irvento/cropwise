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
use App\Http\Controllers\InventoryTransactionController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\EmployeeRegistrationController;
use App\Http\Controllers\livestockController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');
});


//WEATHER
Route::get('/weather/{city}', [WeatherController::class, 'show'])->name('weather.show');

//FARM
Route::get('/farm', [farmController::class, 'index'])->name('farm.index');

Route::get('/hr', [hrController::class, 'index'])->name('hr.index');

// HR Routes
Route::prefix('hr')->name('hr.')->group(function () {
    // Dashboard
    Route::get('/', [hrController::class, 'index'])->name('index');
    
    // Leave Management
    Route::get('/leave-requests', [LeaveRequestController::class, 'index'])->name('leave-requests.index');
    Route::get('/leave-requests/create', [LeaveRequestController::class, 'create'])->name('leave-requests.create');
    Route::post('/leave-requests', [LeaveRequestController::class, 'store'])->name('leave-requests.store');
    Route::get('/leave-requests/{leaveRequest}', [LeaveRequestController::class, 'show'])->name('leave-requests.show');
    Route::get('/leave-requests/{leaveRequest}/edit', [LeaveRequestController::class, 'edit'])->name('leave-requests.edit');
    Route::put('/leave-requests/{leaveRequest}', [LeaveRequestController::class, 'update'])->name('leave-requests.update');
    Route::delete('/leave-requests/{leaveRequest}', [LeaveRequestController::class, 'destroy'])->name('leave-requests.destroy');

    // Attendance
    Route::get('/attendance', [hrController::class, 'attendanceindex'])->name('attendance.index');
    Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('/attendance/{attendance}', [AttendanceController::class, 'show'])->name('attendance.show');
    Route::get('/attendance/{attendance}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
    Route::put('/attendance/{attendance}', [AttendanceController::class, 'update'])->name('attendance.update');
    Route::delete('/attendance/{attendance}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
    Route::post('/attendance/time-in', [AttendanceController::class, 'timeIn'])->name('attendance.time-in');
    Route::post('/attendance/time-out', [AttendanceController::class, 'timeOut'])->name('attendance.time-out');

    // Payroll
    Route::get('/payroll', [hrController::class, 'payrollindex'])->name('payroll.index');
    Route::get('/payroll/create', [PayrollController::class, 'create'])->name('payroll.create');
    Route::post('/payroll', [PayrollController::class, 'store'])->name('payroll.store');
    Route::get('/payroll/{payroll}', [PayrollController::class, 'show'])->name('payroll.show');
    Route::get('/payroll/{payroll}/edit', [PayrollController::class, 'edit'])->name('payroll.edit');
    Route::put('/payroll/{payroll}', [PayrollController::class, 'update'])->name('payroll.update');
    Route::delete('/payroll/{payroll}', [PayrollController::class, 'destroy'])->name('payroll.destroy');
    Route::match(['get', 'post'], '/payroll/generate-monthly', [PayrollController::class, 'generateMonthly'])
        ->name('payroll.generate-monthly');
    Route::post('/payroll/{payroll}/mark-as-paid', [PayrollController::class, 'markAsPaid'])
        ->name('payroll.mark-as-paid');

    // Employees
    Route::get('/employees', [hrController::class, 'employeesindex'])->name('employees.index');
    Route::get('/employees/create', [hrController::class, 'create'])->name('create');
    Route::post('/employees', [hrController::class, 'store'])->name('store');
    Route::get('/employees/{id}', [hrController::class, 'show'])->name('show');
    Route::get('/employees/{id}/edit', [hrController::class, 'edit'])->name('edit');
    Route::put('/employees/{id}', [hrController::class, 'update'])->name('update');
    Route::delete('/employees/{id}', [hrController::class, 'destroy'])->name('destroy');
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
    Route::resource('inventory-transactions', InventoryTransactionController::class);
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

    // Farm Management Routes
    Route::prefix('farm')->name('farm.')->group(function () {
        // Livestock Management
        Route::resource('livestock', livestockController::class);
    });
});

// Calendar Routes
Route::controller(FullCalenderController::class)->group(function(){
    Route::get('fullcalender', 'index')->name('fullcalender');
    Route::post('fullcalenderAjax', 'ajax')->name('fullcalenderAjax');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/employee/register', [EmployeeController::class, 'create'])->name('employee.register');
    Route::post('/employee/register', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employee/check', [EmployeeController::class, 'check'])->name('employee.check');

    // User Payroll Routes
    Route::get('/user/payroll', [App\Http\Controllers\User\PayrollController::class, 'index'])->name('user.payroll.index');
    Route::get('/user/payroll/{payroll}', [App\Http\Controllers\User\PayrollController::class, 'show'])->name('user.payroll.show');

    // Dashboard routes
    Route::post('/dashboard/time-in', [DashboardController::class, 'timeIn'])->name('dashboard.time-in');
    Route::post('/dashboard/time-out', [DashboardController::class, 'timeOut'])->name('dashboard.time-out');
});

// User Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Attendance Routes
    Route::post('/attendance/time-in', [App\Http\Controllers\AttendanceController::class, 'timeIn'])
        ->name('user.attendance.time-in');
    Route::post('/attendance/time-out', [App\Http\Controllers\AttendanceController::class, 'timeOut'])
        ->name('user.attendance.time-out');
    Route::get('/attendance', [App\Http\Controllers\AttendanceController::class, 'index'])
        ->name('user.attendance.index');

    // User Tasks Routes
    Route::get('/tasks', [App\Http\Controllers\taskController::class, 'userTasks'])
        ->name('user.tasks.index');
    Route::get('/tasks/{task}', [App\Http\Controllers\taskController::class, 'userShow'])
        ->name('user.tasks.show');
    Route::put('/tasks/{task}/status', [App\Http\Controllers\taskController::class, 'updateStatus'])
        ->name('user.tasks.update-status');

    // User Leave Requests Routes
    Route::get('/leave-requests', [App\Http\Controllers\LeaveRequestController::class, 'userIndex'])
        ->name('user.leave-requests.index');
    Route::get('/leave-requests/user/create', [App\Http\Controllers\LeaveRequestController::class, 'userCreate'])
        ->name('user.leave-requests.create');
    Route::post('/leave-requests', [App\Http\Controllers\LeaveRequestController::class, 'userStore'])
        ->name('user.leave-requests.store');
    Route::get('/leave-requests/{leaveRequest}', [App\Http\Controllers\LeaveRequestController::class, 'userShow'])
        ->name('user.leave-requests.show');
});