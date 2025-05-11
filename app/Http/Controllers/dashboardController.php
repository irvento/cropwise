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
use Carbon\Carbon;
use Illuminate\Support\Collection;

class dashboardController extends Controller
{
    public function index()
    {
        try {
            // Get overview statistics
            $totalFields = Field::count();
            $activeCrops = Crop::where('status', 'active')->count();
            $pendingTasks = Task::where('status', 'pending')->count();
            $totalLivestock = Livestock::count();

            // Get recent schedules (tasks and planting schedules)
            $recentSchedules = $this->getRecentSchedules();

            // Get upcoming tasks
            $upcomingTasks = Task::with('assignedTo')
                ->where('due_date', '>=', Carbon::today())
                ->orderBy('due_date')
                ->take(5)
                ->get();

            // Get recent inventory changes
            $recentInventory = Inventory::with('category')
                ->latest()
                ->take(5)
                ->get();

            // Get financial summary
            $financialSummary = [
                'income' => Finance::where('type', 'income')
                    ->whereMonth('date', Carbon::now()->month)
                    ->sum('amount'),
                'expenses' => Finance::where('type', 'expense')
                    ->whereMonth('date', Carbon::now()->month)
                    ->sum('amount')
            ];

            // Get weather data
            $weatherService = app(WeatherService::class);
            $weather = $weatherService->getCurrentWeather('Manolo Fortich');

            return view('dashboard', compact(
                'totalFields',
                'activeCrops',
                'pendingTasks',
                'totalLivestock',
                'recentSchedules',
                'upcomingTasks',
                'recentInventory',
                'financialSummary',
                'weather'
            ));
        } catch (\Exception $e) {
            // If there's an error, return the view with empty collections
            return view('dashboard', [
                'totalFields' => 0,
                'activeCrops' => 0,
                'pendingTasks' => 0,
                'totalLivestock' => 0,
                'recentSchedules' => collect([]),
                'upcomingTasks' => collect([]),
                'recentInventory' => collect([]),
                'financialSummary' => [
                    'income' => 0,
                    'expenses' => 0
                ],
                'weather' => null
            ]);
        }
    }

    private function getRecentSchedules(): Collection
    {
        try {
            // Get recent tasks
            $recentTasks = Task::with('assignedTo')
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($task) {
                    return (object)[
                        'type' => 'task',
                        'icon' => 'fa-tasks',
                        'title' => $task->title,
                        'description' => "Task assigned to " . ($task->assignedTo->name ?? 'Unassigned'),
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