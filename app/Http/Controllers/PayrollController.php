<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        if ($payroll->status === 'paid') {
            return redirect()->route('hr.payroll.index')
                ->with('error', 'This payroll has already been marked as paid.');
        }

        DB::beginTransaction();
        try {
            $payroll->update([
                'status' => 'paid',
                'payment_date' => now()
            ]);

            DB::commit();
            return redirect()->route('hr.payroll.index')
                ->with('success', 'Payroll marked as paid successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('hr.payroll.index')
                ->with('error', 'Failed to mark payroll as paid: ' . $e->getMessage());
        }
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

    public function generateMonthly(Request $request)
    {
        // If it's a GET request, show the form
        if ($request->isMethod('get')) {
            return view('hr.payroll.generate-monthly');
        }

        // If it's a POST request, process the generation
        // Get all active employees
        $employees = Employee::where('status', 'active')->get();
        
        // Get current month and year
        $currentMonth = now()->format('m');
        $currentYear = now()->format('Y');
        
        // Check if payroll for this month already exists
        $existingPayroll = Payroll::whereMonth('payment_date', $currentMonth)
            ->whereYear('payment_date', $currentYear)
            ->exists();
            
        if ($existingPayroll) {
            return redirect()->route('hr.payroll.index')
                ->with('error', 'Payroll for this month has already been generated.');
        }
        
        DB::beginTransaction();
        try {
            foreach ($employees as $employee) {
                // Create payroll record for each employee
                Payroll::create([
                    'employee_id' => $employee->id,
                    'basic_salary' => $employee->salary,
                    'payment_date' => now(),
                    'status' => 'pending',
                    'month' => $currentMonth,
                    'year' => $currentYear
                ]);
            }
            
            DB::commit();
            return redirect()->route('hr.payroll.index')
                ->with('success', 'Monthly payroll has been generated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('hr.payroll.index')
                ->with('error', 'Failed to generate monthly payroll: ' . $e->getMessage());
        }
    }
} 