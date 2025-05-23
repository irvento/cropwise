<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $table = 'fields';

    protected $fillable = [
        'id',
        'name',
        'location',
        'size',
        'soil_type',
        'status',
        'notes',
        'created_at',
        'updated_at'
    ];

 
} 