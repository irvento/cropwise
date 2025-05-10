<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    protected $table = 'inventory_transactions';

    protected $fillable = [
        'item_id',
        'transaction_type',
        'quantity',
        'unit_price',
        'total_amount',
        'notes',
        'user_id'
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    public function item()
    {
        return $this->belongsTo(Inventory::class, 'item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 