<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialTransaction extends Model
{
    protected $table = 'financial_transactions';

    protected $fillable = [
        'id',
        'account_id',
        'type',
        'category',
        'amount',
        'date',
        'description',
        'reference_number',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];        
    public function account()
    {
        return $this->belongsTo(FinancialAccount::class, 'account_id');
    }
}
