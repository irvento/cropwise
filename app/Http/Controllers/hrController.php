<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class hrController extends Controller
{
    public function index()
    {
        return view('admin.hr.index');
    }

    public function employeesindex()
    {
        return view('admin.hr.employees.index');
    }

    public function payrollindex()
    {
        return view('admin.hr.payroll.index');
    }

    public function attendanceindex()
    {
        return view('admin.hr.attendance.index');
    }
    public function leaveindex()
    {
        return view('admin.hr.leave.index');
    }
}
