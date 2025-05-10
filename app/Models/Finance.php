<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    protected $table = 'financial_accounts'; // Specify the table name if different from the model name      
    protected $fillable = [
        'id',
        'name',
        'type',
        'balance',
        'description',
        'created_at',
        'updated_at'

    ];      
}
