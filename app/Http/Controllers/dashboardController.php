<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\WeatherService;
use Illuminate\Http\Request;
use App\Models\Field;
use App\Models\Crop;
use App\Models\Task;
use App\Models\Livestock;
use App\Models\PlantingSchedule;
use App\Models\Employee;
use App\Models\Inventory;
use App\Models\Finance;
use App\Models\FinanceTransaction;
use App\Models\LeaveRequest;
use App\Models\Attendance;
use App\Models\Payroll;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;


class DashboardController extends Controller
{
    public function index()
    {
        $employee = Employee::where('id', Auth::user()->id)->first();
        $today = Carbon::today();
        $user = Auth::user();

        // Get today's attendance status
        $todayAttendanceStatus = 'not_checked_in';
        if ($user->employee) {
            $todayAttendance = Attendance::where('employee_id', $employee->id)
                ->whereDate('date', $today)
                ->first();
            $todayAttendanceStatus = $todayAttendance ? $todayAttendance->status : 'not_checked_in';
        }

        // Get overview statistics
        $totalFields = Field::count();
        $activeCrops = Crop::count();
        $pendingTasks = Task::where('status', 'pending')->count();
        $totalLivestock = Livestock::count();
        $totalEmployees = Employee::count();
        $totalInventory = Inventory::count();
        $totalLeaveRequests = LeaveRequest::count();
        $totalAttendance = Attendance::count();
        $totalPayrolls = Payroll::count();

        // Get user's leave requests count
        $leaveRequestsCount = 0;
        if ($employee) {
            $leaveRequestsCount = LeaveRequest::where('employee_id', $employee->id)->count();
        }

        // Get recent schedules (tasks and planting schedules)
        $recentSchedules = $this->getRecentSchedules();

        // Get upcoming tasks
        $upcomingTasks = Task::with('employee')
            ->where('due_date', '>=', Carbon::today())
            ->orderBy('due_date')
            ->take(5)
            ->get();

        // Get recent tasks for the user
        $recentTasks = collect([]);
        if ($employee) {
            $recentTasks = Task::with('employee')
                ->where('assigned_to', $employee->id)
                ->latest()
                ->take(5)
                ->get();
        }

        // Get recent inventory changes
        $recentInventory = Inventory::with('category')
            ->latest()
            ->take(5)
            ->get();

        // Get financial summary
        $financialSummary = [
            'income' => FinanceTransaction::where('type', 'income')
                ->whereMonth('date', Carbon::now()->month)
                ->sum('amount'),
            'expenses' => FinanceTransaction::where('type', 'expense')
                ->whereMonth('date', Carbon::now()->month)
                ->sum('amount')
        ];

        // Get recent leave requests
        $recentLeaveRequests = LeaveRequest::with('employee')
            ->latest()
            ->take(5)
            ->get();

        // Get recent attendance records
        $recentAttendance = Attendance::with('employee')
            ->latest()
            ->take(5)
            ->get();

        // Get recent payroll records
        $recentPayrolls = Payroll::with('employee')
            ->latest()
            ->take(5)
            ->get();

        // Get weather data
        $weatherService = app(WeatherService::class);
        $weather = $weatherService->getCurrentWeather('Manolo Fortich');

        return view('dashboard', compact(
            'todayAttendanceStatus',
            'totalFields',
            'activeCrops',
            'pendingTasks',
            'totalLivestock',
            'totalEmployees',
            'totalInventory',
            'totalLeaveRequests',
            'totalAttendance',
            'totalPayrolls',
            'recentSchedules',
            'upcomingTasks',
            'recentTasks',
            'recentInventory',
            'financialSummary',
            'recentLeaveRequests',
            'recentAttendance',
            'recentPayrolls',
            'weather',
            'leaveRequestsCount'
        ));
    }

    private function getRecentSchedules(): Collection
    {
        try {
            // Get recent tasks
            $recentTasks = Task::with('employee')
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($task) {
                    return (object)[
                        'type' => 'task',
                        'icon' => 'fa-tasks',
                        'title' => $task->title,
                        'description' => "Task assigned to " . ($task->employee->first_name . ' ' . $task->employee->last_name ?? 'Unassigned'),
                        'date' => $task->created_at,
                        'priority' => $task->priority
                    ];
                });

            // Get recent planting schedules
            $recentPlantings = PlantingSchedule::with(['field', 'crop'])
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($schedule) {
                    return (object)[
                        'type' => 'planting',
                        'icon' => 'fa-seedling',
                        'title' => "Planting Schedule",
                        'description' => "Planting {$schedule->crop->name} in {$schedule->field->name}",
                        'date' => $schedule->created_at,
                        'planting_date' => $schedule->planting_date
                    ];
                });

            // Combine and sort by date
            return $recentTasks->concat($recentPlantings)
                ->sortByDesc('date')
                ->take(5);
        } catch (\Exception $e) {
            // Return empty collection if there's an error
            return collect([]);
        }
    }
} 