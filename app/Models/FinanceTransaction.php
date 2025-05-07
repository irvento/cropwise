<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceTransaction extends Model
{
    protected $table = 'finance';
    protected $fillable = [
        'account_id',
        'type',
        'category',
        'amount',
        'date',
        'description',
        'reference_number',
        'recorded_by',
        'related_entity_type',
        'related_entity_id',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];        
}
