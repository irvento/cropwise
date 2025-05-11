<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('employee')->latest()->paginate(10);
        return view('hr.attendance.index', compact('attendances'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('hr.attendance.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'time_in' => 'nullable|date_format:H:i',
            'time_out' => 'nullable|date_format:H:i|after:time_in',
            'status' => 'required|in:present,absent,late,half-day'
        ]);

        Attendance::create($validated);

        return redirect()->route('hr.attendance.index')
            ->with('success', 'Attendance record created successfully.');
    }

    public function show(Attendance $attendance)
    {
        return view('hr.attendance.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $employees = Employee::all();
        return view('hr.attendance.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'time_in' => 'nullable|date_format:H:i',
            'time_out' => 'nullable|date_format:H:i|after:time_in',
            'status' => 'required|in:present,absent,late,half-day'
        ]);

        $attendance->update($validated);

        return redirect()->route('hr.attendance.index')
            ->with('success', 'Attendance record updated successfully.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('hr.attendance.index')
            ->with('success', 'Attendance record deleted successfully.');
    }

    public function timeIn(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
        ]);

        $today = Carbon::today();
        $existingAttendance = Attendance::where('employee_id', $request->employee_id)
            ->whereDate('date', $today)
            ->first();

        if ($existingAttendance) {
            return back()->with('error', 'Employee has already checked in today.');
        }

        $attendance = Attendance::create([
            'employee_id' => $request->employee_id,
            'date' => $today,
            'check_in' => Carbon::now(),
            'status' => Carbon::now()->hour > 9 ? 'late' : 'present'
        ]);

        return back()->with('success', 'Time in recorded successfully.');
    }

    public function timeOut(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
        ]);

        $today = Carbon::today();
        $attendance = Attendance::where('employee_id', $request->employee_id)
            ->whereDate('date', $today)
            ->first();

        if (!$attendance) {
            return back()->with('error', 'No check-in record found for today.');
        }

        if ($attendance->check_out) {
            return back()->with('error', 'Employee has already checked out today.');
        }

        $attendance->update([
            'check_out' => Carbon::now()
        ]);

        return back()->with('success', 'Time out recorded successfully.');
    }
} 