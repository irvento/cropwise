<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'start',
        'end',
        'type',
        'color',
        'description',
        'assigned_to',
        'field',
        'quantity',
        'status'
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime'
    ];
} 