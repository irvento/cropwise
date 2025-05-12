<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payroll;
use Illuminate\Support\Facades\Auth;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::where('employee_id', Auth::user()->employee->id)
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('user.payroll.index', compact('payrolls'));
    }

    public function show(Payroll $payroll)
    {
        // Ensure the user can only view their own payroll
        if ($payroll->employee_id !== Auth::user()->employee->id) {
            abort(403);
        }

        return view('user.payroll.show', compact('payroll'));
    }
} 