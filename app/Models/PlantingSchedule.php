<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'notes'
    ];

    protected $casts = [
        'planting_date' => 'datetime',
        'expected_harvest_date' => 'datetime',
        'quantity_planted' => 'decimal:2'
    ];

    /**
     * Get the field where the crop is planted.
     */
    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }

    /**
     * Get the crop being planted.
     */
    public function crop(): BelongsTo
    {
        return $this->belongsTo(Crop::class);
    }

    public function responsibleEmployee()
    {
        return $this->belongsTo(Employee::class, 'responsible_employee_id');
    }
} 