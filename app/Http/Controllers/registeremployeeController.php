<?php

namespace App\Http\Controllers;
use App\Models\Employee;

use Illuminate\Http\Request;

class registeremployeeController extends Controller
{
    public function index()
    {
        return view('admin.hr.employees.registeremployee');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'position' => 'required|string|max:100',
            'salary' => 'required|numeric|min:0',
        ]);

        // Create a new employee record
        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee registered successfully.');
    }
}
