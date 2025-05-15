<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    protected $table = 'inventory_transactions';

    protected $fillable = [
        'item_id',
        'finance_account_id',
        'transaction_type',
        'quantity',
        'notes',
        'unit_price',
        'total_amount'
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_amount' => 'decimal:2'
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'item_id');
    }

    public function financeAccount()
    {
        return $this->belongsTo(Finance::class, 'finance_account_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 