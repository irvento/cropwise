<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HR extends Model
{
    protected $table = 'employees';
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'department',
        'salary',
        'created_at',
        'updated_at'
    ]; 
}
