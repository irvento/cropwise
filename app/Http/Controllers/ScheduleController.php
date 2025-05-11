<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use App\Models\PlantingSchedule;
use App\Models\Field;
use App\Models\Crop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the schedules.
     */
    public function index()
    {
        $tasks = Task::with('employee')->get();
        $plantingSchedules = PlantingSchedule::with(['field', 'crop'])->get();
        
        // Format data for calendar
        $events = [];
        
        // Add tasks to events
        foreach ($tasks as $task) {
            $events[] = [
                'id' => 'task_' . $task->id,
                'title' => $task->title,
                'start' => $task->due_date->format('Y-m-d'),
                'end' => $task->due_date->format('Y-m-d'),
                'type' => 'task',
                'color' => $this->getPriorityColor($task->priority),
                'description' => $task->description,
                'assigned_to' => $task->employee ? $task->employee->first_name . ' ' . $task->employee->last_name : 'Unassigned',
                'status' => $task->status
            ];
        }
        
        // Add planting schedules to events
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
                'status' => $schedule->status
            ];
        }
        
        return view('admin.schedule.index', compact('events', 'tasks', 'plantingSchedules'));
    }

    /**
     * Show the form for creating a new schedule.
     */
    public function create()
    {
        $employees = Employee::all();
        $fields = Field::all();
        $crops = Crop::all();
        return view('admin.schedule.create', compact('employees', 'fields', 'crops'));
    }

    /**
     * Store a newly created schedule in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:task,planting',
            'title' => 'required_if:type,task|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required_if:type,task|exists:employees,id',
            'due_date' => 'required_if:type,task|date',
            'priority' => 'required_if:type,task|in:low,medium,high',
            'field_id' => 'required_if:type,planting|exists:fields,id',
            'crop_id' => 'required_if:type,planting|exists:crops,id',
            'planting_date' => 'required_if:type,planting|date',
            'expected_harvest_date' => 'required_if:type,planting|date|after:planting_date',
            'quantity_planted' => 'required_if:type,planting|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->type === 'task') {
            Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'assigned_to' => $request->assigned_to,
                'due_date' => $request->due_date,
                'priority' => $request->priority,
                'status' => 'pending'
            ]);
        } else {
            PlantingSchedule::create([
                'field_id' => $request->field_id,
                'crop_id' => $request->crop_id,
                'planting_date' => $request->planting_date,
                'expected_harvest_date' => $request->expected_harvest_date,
                'quantity_planted' => $request->quantity_planted,
                'status' => 'scheduled',
                'notes' => $request->notes
            ]);
        }

        return redirect()->route('admin.schedule.index')->with('success', 'Schedule created successfully.');
    }

    /**
     * Show the form for editing the specified schedule.
     */
    public function edit($id, $type)
    {
        if ($type === 'task') {
            $item = Task::findOrFail($id);
            $employees = Employee::all();
            return view('admin.schedule.edit', compact('item', 'employees', 'type'));
        } else {
            $item = PlantingSchedule::findOrFail($id);
            $fields = Field::all();
            $crops = Crop::all();
            return view('admin.schedule.edit', compact('item', 'fields', 'crops', 'type'));
        }
    }

    /**
     * Update the specified schedule in storage.
     */
    public function update(Request $request, $id, $type)
    {
        if ($type === 'task') {
            $task = Task::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'assigned_to' => 'required|exists:employees,id',
                'due_date' => 'required|date',
                'priority' => 'required|in:low,medium,high',
                'status' => 'required|in:pending,in_progress,completed'
            ]);
        } else {
            $schedule = PlantingSchedule::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'field_id' => 'required|exists:fields,id',
                'crop_id' => 'required|exists:crops,id',
                'planting_date' => 'required|date',
                'expected_harvest_date' => 'required|date|after:planting_date',
                'quantity_planted' => 'required|numeric|min:0',
                'status' => 'required|in:scheduled,in_progress,completed'
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($type === 'task') {
            $task->update($request->all());
        } else {
            $schedule->update($request->all());
        }

        return redirect()->route('admin.schedule.index')->with('success', 'Schedule updated successfully.');
    }

    /**
     * Remove the specified schedule from storage.
     */
    public function destroy($id, $type)
    {
        if ($type === 'task') {
            Task::findOrFail($id)->delete();
        } else {
            PlantingSchedule::findOrFail($id)->delete();
        }

        return redirect()->route('admin.schedule.index')->with('success', 'Schedule deleted successfully.');
    }

    /**
     * Get the color code for task priority.
     */
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