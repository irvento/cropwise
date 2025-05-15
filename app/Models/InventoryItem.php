<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $table = 'inventory_items';

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'quantity',
        'unit_of_measurement',
        'minimum_stock_level',
        'current_stock_level',
        'supplier_id',
        'purchase_price',
        'selling_price',
        'expiry_date',
        'storage_location',
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'purchase_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(InventoryCategory::class, 'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function transactions()
    {
        return $this->hasMany(InventoryTransaction::class, 'item_id');
    }

    public function plantingSchedules()
    {
        return $this->hasMany(PlantingSchedule::class, 'seed_id');
    }
}
