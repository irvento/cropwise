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
        $employee = Employee::findOrFail($request->employee_id);
        
        $attendance = Attendance::create([
            'employee_id' => $employee->id,
            'date' => Carbon::today(),
            'time_in' => Carbon::now(),
            'status' => 'present'
        ]);

        return response()->json([
            'message' => 'Time in recorded successfully',
            'attendance' => $attendance
        ]);
    }

    public function timeOut(Request $request)
    {
        $attendance = Attendance::where('employee_id', $request->employee_id)
            ->whereDate('date', Carbon::today())
            ->first();

        if ($attendance) {
            $attendance->update([
                'time_out' => Carbon::now()
            ]);

            return response()->json([
                'message' => 'Time out recorded successfully',
                'attendance' => $attendance
            ]);
        }

        return response()->json([
            'message' => 'No time in record found for today'
        ], 404);
    }
} 