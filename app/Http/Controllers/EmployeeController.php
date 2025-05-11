<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function create()
    {
        return view('employee.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        \App\Models\Employee::create([
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'position' => 'employee', // Default value
            'salary' => 15000, // Default value
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'status' => 'active', // Default value
        ]);

        return redirect()->route('dashboard')->with('success', 'Employee profile created successfully.');
    }

    public function check()
    {
        $isRegistered = \App\Models\Employee::where('user_id', Auth::id())->exists();
        return response()->json(['isRegistered' => $isRegistered]);
    }
}
