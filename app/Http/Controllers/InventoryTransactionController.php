<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryTransaction;
use Illuminate\Http\Request;

class InventoryTransactionController extends Controller
{
    public function index()
    {
        $transactions = InventoryTransaction::with(['inventory', 'user'])
            ->latest()
            ->paginate(10);
        return view('admin.inventory_transactions.index', compact('transactions'));
    }

    public function create()
    {
        $inventoryItems = Inventory::all();
        $transactionTypes = [
            'purchase' => 'Purchase',
            'sale' => 'Sale',
            'adjustment' => 'Adjustment',
            'initial' => 'Initial Stock'
        ];
        return view('admin.inventory_transactions.create', compact('inventoryItems', 'transactionTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:inventory_items,id',
            'transaction_type' => 'required|in:purchase,sale,adjustment,initial',
            'quantity' => 'required|numeric|min:0.01',
            'unit_price' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        // Calculate total amount
        $total_amount = $validated['quantity'] * ($validated['unit_price'] ?? 0);

        $transaction = InventoryTransaction::create([
            'item_id' => $validated['item_id'],
            'transaction_type' => $validated['transaction_type'],
            'quantity' => $validated['quantity'],
            'unit_price' => $validated['unit_price'] ?? 0,
            'total_amount' => $total_amount,
            'notes' => $validated['notes'],
        ]);

        // Update inventory quantity based on transaction type
        $inventory = Inventory::findOrFail($validated['item_id']);
        switch ($validated['transaction_type']) {
            case 'purchase':
            case 'initial':
                $inventory->quantity += $validated['quantity'];
                break;
            case 'sale':
                $inventory->quantity -= $validated['quantity'];
                break;
            case 'adjustment':
                $inventory->quantity = $validated['quantity'];
                break;
        }
        $inventory->save();

        return redirect()
            ->route('admin.inventory-transactions.index')
            ->with('success', 'Transaction recorded successfully.');
    }

    public function show(InventoryTransaction $inventoryTransaction)
    {
        $inventoryTransaction->load(['inventory', 'user']);
        return view('admin.inventory_transactions.show', compact('inventoryTransaction'));
    }

    public function edit(InventoryTransaction $inventoryTransaction)
    {
        $inventoryItems = Inventory::all();
        return view('admin.inventory_transactions.edit', compact('inventoryTransaction', 'inventoryItems'));
    }

    public function update(Request $request, InventoryTransaction $inventoryTransaction)
    {
        $validated = $request->validate([
            'inventory_id' => 'required|exists:inventory,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|numeric|min:0.01',
            'notes' => 'nullable|string',
        ]);

        // Revert the old transaction's effect on inventory
        $oldInventory = Inventory::findOrFail($inventoryTransaction->inventory_id);
        if ($inventoryTransaction->type === 'in') {
            $oldInventory->quantity -= $inventoryTransaction->quantity;
        } else {
            $oldInventory->quantity += $inventoryTransaction->quantity;
        }
        $oldInventory->save();

        // Apply the new transaction
        $inventoryTransaction->update([
            'inventory_id' => $validated['inventory_id'],
            'type' => $validated['type'],
            'quantity' => $validated['quantity'],
            'notes' => $validated['notes'],
        ]);

        // Update the new inventory quantity
        $newInventory = Inventory::findOrFail($validated['inventory_id']);
        if ($validated['type'] === 'in') {
            $newInventory->quantity += $validated['quantity'];
        } else {
            $newInventory->quantity -= $validated['quantity'];
        }
        $newInventory->save();

        return redirect()
            ->route('admin.inventory-transactions.index')
            ->with('success', 'Transaction updated successfully.');
    }

    public function destroy(InventoryTransaction $inventoryTransaction)
    {
        // Revert the transaction's effect on inventory
        $inventory = Inventory::findOrFail($inventoryTransaction->inventory_id);
        if ($inventoryTransaction->type === 'in') {
            $inventory->quantity -= $inventoryTransaction->quantity;
        } else {
            $inventory->quantity += $inventoryTransaction->quantity;
        }
        $inventory->save();

        $inventoryTransaction->delete();

        return redirect()
            ->route('admin.inventory-transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }
} 