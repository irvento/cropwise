<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    protected $table = 'crops'; // Specify the table name if different from the model name  
    protected $fillable = [
        'id',
        'name',
        'variety',
        'growth_duration',
        'conditions',
        'created_at',
        'updated_at'
    ];
}
