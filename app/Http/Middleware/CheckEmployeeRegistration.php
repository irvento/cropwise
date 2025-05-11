<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class CheckEmployeeRegistration
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $employee = Employee::where('user_id', $userId)->first();

            // Redirect to the employee registration form if not registered
            if (!$employee) {
                return redirect()->route('employee.register');
            }
        }

        return $next($request);
    }
}