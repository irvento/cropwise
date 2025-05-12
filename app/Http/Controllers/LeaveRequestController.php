<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $leaveRequests = LeaveRequest::with('employee')->latest()->paginate(10);
        return view('hr.leave-requests.index', compact('leaveRequests'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('hr.leave-requests.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string'
        ]);

        LeaveRequest::create($validated);

        return redirect()->route('hr.leave-requests.index')
            ->with('success', 'Leave request created successfully.');
    }

    public function show(LeaveRequest $leaveRequest)
    {
        return view('hr.leave-requests.show', compact('leaveRequest'));
    }

    public function edit(LeaveRequest $leaveRequest)
    {
        $employees = Employee::all();
        return view('hr.leave-requests.edit', compact('leaveRequest', 'employees'));
    }

    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        if ($request->status === 'approved') {
            $validated['approved_at'] = Carbon::now();
        }

        $leaveRequest->update($validated);

        return redirect()->route('hr.leave-requests.index')
            ->with('success', 'Leave request updated successfully.');
    }

    public function destroy(LeaveRequest $leaveRequest)
    {
        $leaveRequest->delete();

        return redirect()->route('hr.leave-requests.index')
            ->with('success', 'Leave request deleted successfully.');
    }

    /**
     * Display a listing of the user's leave requests.
     */
    public function userIndex()
    {
        $employee = Employee::where('id', Auth::user()->id)->first();
        $leaveRequests = LeaveRequest::where('employee_id', $employee->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.leave-requests.index', compact('leaveRequests'));
    }

    /**
     * Show the form for creating a new leave request.
     */
    public function userCreate()
    {
        return view('user.leave-requests.create');
    }

    /**
     * Store a newly created leave request.
     */
    public function userStore(Request $request)
    {
        $employee = Employee::where('id', Auth::user()->id)->first();
        
        $validated = $request->validate([
            'leave_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
        ]);

        $validated['employee_id'] = $employee->id;
        $validated['status'] = 'pending';

        LeaveRequest::create($validated);

        return redirect()->route('user.leave-requests.index')
            ->with('success', 'Leave request submitted successfully.');
    }

    /**
     * Display the specified leave request.
     */
    public function userShow(LeaveRequest $leaveRequest)
    {
        $employee = Employee::where('id', Auth::user()->id)->first();
        if ($leaveRequest->employee_id !== $employee->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('user.leave-requests.show', compact('leaveRequest'));
    }
} 