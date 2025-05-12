<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Payroll;
use Illuminate\Support\Facades\Auth;

class PayrollController extends Controller
{
    public function index()
    {
        $employee = Employee::where('user_id', Auth::user()->id)->first();
        $payrolls = Payroll::where('employee_id', $employee->id)
            ->orderBy('payment_date', 'desc')
            ->paginate(10);

        return view('user.payroll.index', compact('payrolls'));
    }

    public function show(Payroll $payroll)
    {
        // Ensure the user can only view their own payrollwhere('user_id', Auth::user()->id)->first()->id

        if ($payroll->employee_id !== Employee::where('user_id', Auth::user()->id)->first()->id
        ) {
            abort(403);
        }

        return view('user.payroll.show', compact('payroll'));
    }
} 