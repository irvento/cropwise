<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HR extends Model
{
    protected $table = 'employees';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'position',
        'salary',
        'contact_number',
        'address',
        'status'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function leaveRequests(): HasMany
    {
        return $this->hasMany(LeaveRequest::class, 'employee_id');
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'employee_id');
    }

    public function payrolls(): HasMany
    {
        return $this->hasMany(Payroll::class, 'employee_id');
    }
}
