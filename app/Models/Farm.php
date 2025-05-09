<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
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
