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


    public function plantingSchedules()
    {
        return $this->hasMany(PlantingSchedule::class, 'responsible_employee_id');
    }
} 