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
use Illuminate\Support\Facades\Log;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $employee = Employee::where('user_id', $user->id)->first();
        $today = Carbon::today();

        $todayAttendanceStatus = 'not_checked_in';

        if ($employee) {
            $todayAttendance = Attendance::where('employee_id', $employee->id)
                ->whereDate('date', $today)
                ->first();

            if ($todayAttendance) {
                if ($todayAttendance->time_out) {
                    $todayAttendanceStatus = 'checked_out';
                } elseif ($todayAttendance->time_in) {
                    $timeIn = Carbon::parse($todayAttendance->time_in);
                    $todayAttendanceStatus = 'present';

                    if ($timeIn->hour >= 9 && $timeIn->minute > 0) {
                        $todayAttendanceStatus = 'late';
                    }
                }
            }
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
        $upcomingTasks = collect([]);
        if ($employee) {
            $upcomingTasks = Task::with('employee')
                ->where('assigned_to', $employee->id)
                ->where('due_date', '>=', Carbon::today())
                ->where('status', '!=', 'completed')
                ->orderBy('due_date')
                ->take(5)
                ->get();
        }

        // Get upcoming tasks count
        $upcomingTasksCount = $upcomingTasks->count();

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
            'upcomingTasksCount',
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


    public function timeIn()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Please log in to check in'], 401);
        }

        $employee = Employee::where('user_id', Auth::id())->first();

        if (!$employee) {
            return response()->json(['error' => 'Employee record not found. Please contact HR to link your account.'], 404);
        }

        $today = Carbon::today();
        $now = Carbon::now();

        // Check if already checked in today
        $existingAttendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', $today)
            ->first();

        if ($existingAttendance) {
            return response()->json(['error' => 'You have already checked in today at ' . Carbon::parse($existingAttendance->time_in)->format('h:i A')], 400);
        }

        // Create new attendance record
        $attendance = new Attendance();
        $attendance->employee_id = $employee->id;
        $attendance->date = $today;
        $attendance->time_in = $now;


        // Set status based on time
        if ($now->hour >= 9 && $now->minute > 0) {
            $attendance->status = 'late';
        } else {
            $attendance->status = 'present';
        }
        $attendance->save();

        return response()->json([
            'message' => 'Successfully checked in',
            'status' => $attendance->status,
            'time' => $now->format('h:i A')
        ]);
    }



    public function timeOut()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Please log in to check out'], 401);
        }

        $employee = Employee::where('user_id', Auth::id())->first();
        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        $today = Carbon::today();
        $now = Carbon::now();


        // Find today's attendance record
        $attendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', $today)
            ->first();

        if (!$attendance) {
            return response()->json(['error' => 'No check-in record found for today'], 400);
        }

        if ($attendance->time_out) {
            return response()->json(['error' => 'Already checked out today'], 400);
        }

        // Calculate work hours
        $timeIn = Carbon::parse($attendance->time_in);
        $workHours = $now->diffInMinutes($timeIn) / 60;

        // Calculate overtime (if work hours > 8)
        $overtimeHours = max(0, $workHours - 8);

        // Update attendance record
        $attendance->time_out = $now;




        $attendance->save();

        return response()->json([
            'message' => 'Successfully checked out',
            'work_hours' => round($workHours, 2),
            'overtime_hours' => round($overtimeHours, 2)
        ]);
    }
}
