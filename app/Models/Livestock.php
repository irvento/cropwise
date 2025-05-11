<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livestock extends Model
{
    protected $table = 'livestock';     
    protected $fillable = [
        'name',
        'animalvariety',
        'growth_duration',
        'age',
        'weight',
        'health_status',
        'conditions'
    ];
}
