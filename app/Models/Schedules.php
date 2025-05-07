<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    protected $table = 'task';
    protected $fillable = [
        'id',
        'title',
        'description',
        'assigned_to',
        'due_date',
        'priority',
        'status',
        'completion_date',
        'created_at',
        'updated_at'
    ];
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
