<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\Employee;
use Carbon\Carbon;

class HRController extends Controller
{
    public function index()
    {
        // Get all employees
        $employees = Employee::latest()->paginate(10);

        // Get recent leave requests (last 5)
        $recentLeaveRequests = LeaveRequest::with('employee')
            ->latest()
            ->take(5)
            ->get();

        // Get today's attendance records
        $todayAttendance = Attendance::with('employee')
            ->whereDate('date', Carbon::today())
            ->get();

        // Get recent payroll records (last 5)
        $recentPayrolls = Payroll::with('employee')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.hr.index', compact(
            'employees',
            'recentLeaveRequests',
            'todayAttendance',
            'recentPayrolls'
        ));
    }

    public function employeesindex()
    {
        $employees = Employee::latest()->paginate(10);
        return view('admin.hr.employees.index', compact('employees'));
    }

    public function payrollindex()
    {
        $payrolls = Payroll::with('employee')->latest()->paginate(10);
        return view('hr.payroll.index', compact('payrolls'));
    }

    public function attendanceindex()
    {
        $attendances = Attendance::with('employee')->latest()->paginate(10);
        $employees = Employee::where('status', 'active')->get();
        return view('hr.attendance.index', compact('attendances', 'employees'));
    }

    public function leaveRequestsIndex()
    {
        $leaveRequests = LeaveRequest::with(['employee', 'approver'])->latest()->paginate(10);
        return view('hr.leave-requests.index', compact('leaveRequests'));
    }

    public function create()
    {
        return view('admin.hr.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'address' => 'required|string',
            'status' => 'required|in:active,inactive'
        ]);

        $employee = Employee::create($validated);

        return redirect()->route('hr.index')
            ->with('success', 'Employee created successfully.');
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);;
        return view('admin.hr.show', compact('employee'));
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.hr.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'address' => 'required|string',
            'status' => 'required|in:active,inactive'
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($validated);

        return redirect()->route('hr.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('hr.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
