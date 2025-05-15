<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Harvest extends Model
{
    use HasFactory;

    protected $fillable = [
        'planting_schedule_id',
        'harvest_date',
        'quantity',
        'quality_rating',
        'stored_location',
        'responsible_employee_id',
        'notes'
    ];

    protected $casts = [
        'harvest_date' => 'date',
        'quantity' => 'integer'
    ];

    public function plantingSchedule(): BelongsTo
    {
        return $this->belongsTo(PlantingSchedule::class);
    }

    public function responsibleEmployee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'responsible_employee_id');
    }

    public function storedLocation(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class, 'stored_location');
    }
}
