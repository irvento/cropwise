<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $table = 'attendance';
    protected $fillable = [
        'employee_id',
        'date',
        'time_in',
        'time_out',
        'status'
    ];

    protected $casts = [
        'date' => 'date',
        'time_in' => 'datetime',
        'time_out' => 'datetime'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
} 