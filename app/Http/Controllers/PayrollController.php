<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::with('employee')->latest()->paginate(10);
        return view('hr.payroll.index', compact('payrolls'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('hr.payroll.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'basic_salary' => 'required|numeric|min:0',
            'status' => 'required|in:pending,paid,cancelled',
            'payment_date' => 'required|date'
        ]);

        Payroll::create($validated);

        return redirect()->route('hr.payroll.index')
            ->with('success', 'Payroll record created successfully.');
    }

    public function show(Payroll $payroll)
    {
        return view('hr.payroll.show', compact('payroll'));
    }

    public function edit(Payroll $payroll)
    {
        $employees = Employee::all();
        return view('hr.payroll.edit', compact('payroll', 'employees'));
    }

    public function update(Request $request, Payroll $payroll)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'basic_salary' => 'required|numeric|min:0',
            'status' => 'required|in:pending,paid,cancelled',
            'payment_date' => 'required|date'
        ]);

        $payroll->update($validated);

        return redirect()->route('hr.payroll.index')
            ->with('success', 'Payroll record updated successfully.');
    }

    public function destroy(Payroll $payroll)
    {
        $payroll->delete();

        return redirect()->route('hr.payroll.index')
            ->with('success', 'Payroll record deleted successfully.');
    }

    public function markAsPaid(Payroll $payroll)
    {
        $payroll->update([
            'status' => 'paid',
            'payment_date' => Carbon::now()
        ]);

        return redirect()->route('hr.payroll.index')
            ->with('success', 'Payroll marked as paid successfully.');
    }

    public function generateMonthlyPayroll(Request $request)
    {
        $request->validate([
            'month' => 'required|date_format:Y-m'
        ]);

        $employees = Employee::all();
        $date = Carbon::parse($request->month);

        foreach ($employees as $employee) {
            Payroll::create([
                'employee_id' => $employee->id,
                'basic_salary' => $employee->salary,
                'status' => 'pending',
                'payment_date' => $date->endOfMonth()
            ]);
        }

        return redirect()->route('hr.payroll.index')
            ->with('success', 'Monthly payroll generated successfully.');
    }
} 