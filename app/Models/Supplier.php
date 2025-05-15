<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = [
        'id',
        'name',
        'contact_person',
        'email',
        'phone',
        'address',
        'products_supplied',
        'created_at',
        'updated_at'
    ];

    public function inventoryItems()
    {
        return $this->hasMany(InventoryItem::class, 'supplier_id');
    }
} 