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
        // Get recent leave requests (last 5)
        $recentLeaveRequests = LeaveRequest::with(['employee', 'approver'])
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
            'recentLeaveRequests',
            'todayAttendance',
            'recentPayrolls'
        ));
    }

    public function employeesindex()
    {
        $employees = Employee::with('hr')->latest()->paginate(10);
        return view('admin.hr.employees.index', compact('employees'));
    }

    public function payrollindex()
    {
        $payrolls = Payroll::with(['employee', 'hr'])->latest()->paginate(10);
        return view('admin.hr.payroll.index', compact('payrolls'));
    }

    public function attendanceindex()
    {
        $attendances = Attendance::with(['employee', 'hr'])->latest()->paginate(10);
        return view('admin.hr.attendance.index', compact('attendances'));
    }

    public function leaveRequestsIndex()
    {
        $leaveRequests = LeaveRequest::with(['employee', 'approver', 'hr'])->latest()->paginate(10);
        return view('admin.hr.leave-requests.index', compact('leaveRequests'));
    }
}
