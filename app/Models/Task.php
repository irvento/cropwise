<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'assigned_to',
        'due_date',
        'priority',
        'status',
        'completion_date'
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'completion_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the employee that the task is assigned to.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(HR::class, 'assigned_to');
    }
}
