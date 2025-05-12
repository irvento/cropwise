<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    protected $table = 'inventory_transactions';

    protected $fillable = [
        'item_id',
        'type',
        'quantity',
        'notes'
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 