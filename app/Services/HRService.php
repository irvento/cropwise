<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\LeaveRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HRService
{
    /**
     * Create a new employee.
     */
    public function createEmployee(array $data): Employee
    {
        return Employee::create($data);
    }

    /**
     * Mark attendance for an employee.
     */
    public function markAttendance(Employee $employee, array $data): Attendance
    {
        return Attendance::updateOrCreate(
            [
                'employee_id' => $employee->id,
                'date' => $data['date'] ?? Carbon::today(),
            ],
            [
                'time_in' => $data['time_in'] ?? null,
                'time_out' => $data['time_out'] ?? null,
                'status' => $data['status'] ?? 'present',
            ]
        );
    }

    /**
     * Process payroll for an employee.
     */
    public function processPayroll(Employee $employee, array $data): Payroll
    {
        return DB::transaction(function () use ($employee, $data) {
            $payroll = Payroll::create([
                'employee_id' => $employee->id,
                'basic_salary' => $data['basic_salary'] ?? $employee->salary,
                'status' => $data['status'] ?? 'pending',
                'payment_date' => $data['payment_date'] ?? now(),
            ]);

            return $payroll;
        });
    }
}
