<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $query = Task::with('employee');

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhereHas('employee', function ($q) use ($search) {
                  $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%");
              });
        });

        // Optional: prioritize title matches higher in results (basic relevance)
        $query->orderByRaw("
            CASE 
                WHEN title LIKE ? THEN 1
                WHEN description LIKE ? THEN 2
                ELSE 3
            END", ["%{$search}%", "%{$search}%"]);
    } else {
        $query->latest(); // Default sort by latest when no search
    }

    // Paginate with search query appended
    $tasks = $query->paginate(10)->appends(['search' => $search]);

    return view('admin.tasks.index', compact('tasks'));
}


    /**
     * Show the form for creating a new task.
     */
    public function create()
    {
        $employees = Employee::select('id', 'first_name', 'last_name')->get();
        return view('admin.tasks.create', compact('employees'));
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'assigned_to' => 'required|exists:employees,id',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Task::create($request->all());

        return redirect()->route('admin.tasks.index')
            ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified task.
     */
    public function show(Task $task)
    {
        $task->load('employee');
        return view('admin.tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit(Task $task)
    {
        $employees = Employee::select('id', 'first_name', 'last_name')->get();
        return view('admin.tasks.edit', compact('task', 'employees'));
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'assigned_to' => 'required|exists:employees,id',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $task->update($request->all());

        return redirect()->route('admin.tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('admin.tasks.index')
            ->with('success', 'Task deleted successfully.');
    }

    /**
     * Display a listing of the user's tasks.
     */
    public function userTasks()
    {
        $employee = Employee::where('user_id', Auth::user()->id)->first();
        $tasks = Task::where('assigned_to', $employee->id)
                    ->orderBy('due_date', 'asc')
                    ->paginate(10);
        return view('user.tasks.index', compact('tasks'));
    }

    /**
     * Display the specified task for a user.
     */
    public function userShow(Task $task)
    {
        $employee = Employee::where('id', Auth::user()->id)->first();
        if ($task->assigned_to !== $employee->id) {
            abort(403, 'Unauthorized action.');
        }
        return view('user.tasks.show', compact('task'));
    }

    /**
     * Update the status of a task.
     */
    public function updateStatus(Request $request, Task $task)
    {
        $employee = Employee::where('id', Auth::user()->id)->first();
        if ($task->assigned_to !== $employee->id) {
            abort(403, 'Unauthorized action.');
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,in_progress,completed'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $task->update($request->only('status'));

        return redirect()->route('user.tasks.show', $task)
            ->with('success', 'Task status updated successfully.');
    }
}
