<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HR extends Model
{
    protected $table = 'hr';
    protected $fillable = [
        'employee_id',
        'department',
        'position',
        'hire_date',
        'employment_status',
        'employment_type',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'hire_date' => 'date'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function leaveRequests(): HasMany
    {
        return $this->hasMany(LeaveRequest::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function payrolls(): HasMany
    {
        return $this->hasMany(Payroll::class);
    }
}
