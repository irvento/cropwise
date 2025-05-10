<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantingSchedule extends Model
{
    use HasFactory;

    protected $table = 'planting_schedules';
    protected $fillable = [
        'field_id',
        'crop_id',
        'planting_date',
        'expected_harvest_date',
        'quantity_planted',
        'status',
        'responsible_employee_id',
        'notes'
    ];

    protected $casts = [
        'planting_date' => 'datetime',
        'expected_harvest_date' => 'datetime',
        'quantity_planted' => 'float'
    ];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }

    public function responsibleEmployee()
    {
        return $this->belongsTo(Employee::class, 'responsible_employee_id');
    }
} 