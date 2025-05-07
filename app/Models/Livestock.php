<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livestock extends Model
{
    protected $table = 'livestock';     
    protected $fillable = [
        'id',
        'name',
        'animalvariety',
        'growthduration',
        'age',
        'weight',
        'health_status',
        'conditions',
        'owner_id',
        'created_at',
        'updated_at'
    ];
}
