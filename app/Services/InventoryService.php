<?php

namespace App\Services;

use App\Models\Inventory;
use App\Models\InventoryTransaction;
use App\Models\Finance;
use Illuminate\Support\Facades\DB;

class InventoryService
{
    /**
     * Create an inventory item and its initial transaction.
     */
    public function createItem(array $data): Inventory
    {
        return DB::transaction(function () use ($data) {
            $totalAmount = $data['quantity'] * $data['purchase_price'];

            // Financial check
            $financeAccount = Finance::findOrFail($data['finance_account_id']);
            if ($financeAccount->balance < $totalAmount) {
                throw new \Exception('Insufficient balance in the selected financial account.');
            }

            $inventory = Inventory::create([
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'category_id' => $data['category_id'],
                'supplier_id' => $data['supplier_id'],
                'unit_of_measurement' => $data['unit_of_measurement'],
                'minimum_stock_level' => $data['minimum_stock_level'],
                'current_stock_level' => $data['current_stock_level'],
                'purchase_price' => $data['purchase_price'],
                'selling_price' => $data['selling_price'] ?? null,
                'expiry_date' => $data['expiry_date'] ?? null,
                'storage_location' => $data['storage_location'],
                'quantity' => $data['quantity']
            ]);

            InventoryTransaction::create([
                'item_id' => $inventory->id,
                'finance_account_id' => $data['finance_account_id'],
                'transaction_type' => $data['transaction_type'] ?? 'initial',
                'quantity' => $data['quantity'],
                'unit_price' => $data['purchase_price'],
                'total_amount' => $totalAmount,
                'notes' => $data['notes'] ?? "Initial stock entry for {$data['name']}"
            ]);

            // Deduct from financial account
            $financeAccount->decrement('balance', $totalAmount);

            return $inventory;
        });
    }

    /**
     * Update an inventory item.
     */
    public function updateItem(Inventory $inventory, array $data): bool
    {
        return $inventory->update($data);
    }
}
