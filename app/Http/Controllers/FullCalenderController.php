<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Task;
use App\Models\PlantingSchedule;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
  
class FullCalenderController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $events = [];
            
            // Get tasks
            $tasks = Task::with('employee')->get();
            foreach ($tasks as $task) {
                $events[] = [
                    'id' => 'task_' . $task->id,
                    'title' => $task->title,
                    'start' => $task->due_date->format('Y-m-d'),
                    'end' => $task->due_date->format('Y-m-d'),
                    'type' => 'task',
                    'color' => $this->getPriorityColor($task->priority),
                    'description' => $task->description,
                    'assigned_to' => $task->employee ? $task->employee->name : 'Unassigned',
                    'status' => $task->status,
                    'className' => ['priority-' . $task->priority, $task->status]
                ];
            }
            
            // Get planting schedules
            $plantingSchedules = PlantingSchedule::with(['field', 'crop'])->get();
            foreach ($plantingSchedules as $schedule) {
                $events[] = [
                    'id' => 'planting_' . $schedule->id,
                    'title' => 'Planting: ' . $schedule->crop->name,
                    'start' => $schedule->planting_date->format('Y-m-d'),
                    'end' => $schedule->expected_harvest_date->format('Y-m-d'),
                    'type' => 'planting',
                    'color' => '#4CAF50',
                    'field' => $schedule->field->name,
                    'quantity' => $schedule->quantity_planted,
                    'status' => $schedule->status,
                    'className' => ['planting-schedule', $schedule->status]
                ];
            }
            
            return response()->json($events);
        }
  
        return view('admin.schedule.index');
    }
 
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request): JsonResponse
    {
        switch ($request->type) {
            case 'add':
                $event = Event::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);
 
                return response()->json($event);
                break;
  
            case 'update':
                $event = Event::find($request->id);
                if ($event) {
                    $event->update([
                        'title' => $request->title,
                        'start' => $request->start,
                        'end' => $request->end,
                    ]);
                }
 
                return response()->json($event);
                break;
  
            case 'delete':
                $event = Event::find($request->id);
                if ($event) {
                    $event->delete();
                }
  
                return response()->json(['success' => true]);
                break;
             
            default:
                return response()->json(['error' => 'Invalid request type'], 400);
                break;
        }
    }

    private function getPriorityColor($priority)
    {
        return match($priority) {
            'high' => '#EF4444',
            'medium' => '#F59E0B',
            'low' => '#10B981',
            default => '#6B7280'
        };
    }
}