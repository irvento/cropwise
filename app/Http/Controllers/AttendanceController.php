<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $attendances = Attendance::with('employee')
            ->orderBy('date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $employees = Employee::all();

        return view('hr.attendance.index', compact('attendances', 'employees'));
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
        $now = Carbon::now();

        // Check if already checked in today
        $existingAttendance = Attendance::where('employee_id', $request->employee_id)
            ->whereDate('date', $today)
            ->first();

        if ($existingAttendance) {
            return back()->with('error', 'Employee has already checked in today at ' . Carbon::parse($existingAttendance->time_in)->format('h:i A'));
        }

        // Create new attendance record
        $attendance = new Attendance();
        $attendance->employee_id = $request->employee_id;
        $attendance->date = $today;
        $attendance->time_in = $now;
        
        // Set status based on time
        if ($now->hour >= 9 && $now->minute > 0) {
            $attendance->status = 'late';
            $attendance->late_minutes = $now->diffInMinutes($today->copy()->setHour(9)->setMinute(0));
        } else {
            $attendance->status = 'present';
            $attendance->late_minutes = 0;
        }
        
        $attendance->save();

        return back()->with('success', 'Time in recorded successfully.');
    }

    public function timeOut(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
        ]);

        $today = Carbon::today();
        $now = Carbon::now();

        // Find today's attendance record
        $attendance = Attendance::where('employee_id', $request->employee_id)
            ->whereDate('date', $today)
            ->first();

        if (!$attendance) {
            return back()->with('error', 'No check-in record found for today.');
        }

        if ($attendance->time_out) {
            return back()->with('error', 'Employee has already checked out today.');
        }

        // Calculate work hours
        $timeIn = Carbon::parse($attendance->time_in);
        $workHours = $now->diffInMinutes($timeIn) / 60;
        
        // Calculate overtime (if work hours > 8)
        $overtimeHours = max(0, $workHours - 8);
        
        // Update attendance record
        $attendance->time_out = $now;
        $attendance->work_hours = round($workHours, 2);
        $attendance->overtime_hours = round($overtimeHours, 2);
        
        // Check for early departure (before 5 PM)
        if ($now->hour < 17) {
            $attendance->early_departure_minutes = $now->diffInMinutes($today->copy()->setHour(17)->setMinute(0));
        }
        
        $attendance->save();

        return back()->with('success', 'Time out recorded successfully.');
    }
} 