<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    use HasFactory;

    protected $table = 'crops'; // Specify the table name if different from the model name  
    protected $fillable = [
        'name',
        'variety',
        'growth_duration',
        'conditions',
        'field_id',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'growth_duration' => 'integer',
        // ... other casts if any
    ];

    public function plantingSchedules()
    {
        return $this->hasMany(PlantingSchedule::class);
    }

    public function fields()
    {
        return $this->belongsToMany(Field::class, 'planting_schedules')
            ->withPivot(['planting_date', 'expected_harvest_date', 'quantity_planted', 'status'])
            ->withTimestamps();
    }

    public function mainField()
    {
        return $this->belongsTo(Field::class, 'field_id');
    }
}
