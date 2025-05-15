<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $table = 'employees';
    protected $primaryKey = 'id';
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


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function plantingSchedules()
    {
        return $this->hasMany(PlantingSchedule::class, 'responsible_employee_id');
    }

    public function harvests()
    {
        return $this->hasMany(Harvest::class, 'responsible_employee_id');
    }
} 