<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryTransaction;
use Illuminate\Http\Request;

class InventoryTransactionController extends Controller
{
    public function index()
    {
        $transactions = InventoryTransaction::with(['inventory', 'inventory.category'])
            ->latest()
            ->paginate(10);
        return view('admin.inventory_transactions.index', compact('transactions'));
    }

    public function create()
    {
        $inventories = Inventory::with('category')->get();
        return view('admin.inventory_transactions.create', compact('inventories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:inventory_items,id',
            'quantity' => 'required|numeric|min:0.01',
            'notes' => 'nullable|string',
        ]);

        $transaction = InventoryTransaction::create([
            'item_id' => $validated['item_id'],
            'quantity' => $validated['quantity'],
            'notes' => $validated['notes'],
        ]);

        // Update inventory quantity
        $inventory = Inventory::findOrFail($validated['item_id']);
        if ($validated['type'] === 'in') {
            $inventory->current_stock_level += $validated['quantity'];
        } else {
            $inventory->current_stock_level -= $validated['quantity'];
        }
        $inventory->save();

        return redirect()
            ->route('admin.inventory-transactions.index')
            ->with('success', 'Transaction recorded successfully.');
    }

    public function show(InventoryTransaction $inventory_transaction)
    {
        $inventory_transaction->load(['inventory', 'inventory.category', 'user']);
        return view('admin.inventory_transactions.show', compact('inventory_transaction'));
    }

    public function edit(InventoryTransaction $inventory_transaction)
    {
        $inventories = Inventory::with('category')->get();
        return view('admin.inventory_transactions.edit', compact('inventory_transaction', 'inventories'));
    }

    public function update(Request $request, InventoryTransaction $inventory_transaction)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:inventory_items,id',
            'quantity' => 'required|numeric|min:0.01',
            'notes' => 'nullable|string',
        ]);

        // Revert the old transaction's effect on inventory
        $oldInventory = Inventory::findOrFail($inventory_transaction->item_id);
        if ($inventory_transaction->type === 'in') {
            $oldInventory->current_stock_level -= $inventory_transaction->quantity;
        } else {
            $oldInventory->current_stock_level += $inventory_transaction->quantity;
        }
        $oldInventory->save();

        // Apply the new transaction
        $inventory_transaction->update([
            'item_id' => $validated['item_id'],
            'quantity' => $validated['quantity'],
            'notes' => $validated['notes'],
        ]);

        // Update the new inventory quantity
        $newInventory = Inventory::findOrFail($validated['item_id']);
            $newInventory->current_stock_level -= $validated['quantity'];

        $newInventory->save();

        return redirect()
            ->route('admin.inventory-transactions.index')
            ->with('success', 'Transaction updated successfully.');
    }

    public function destroy(InventoryTransaction $inventory_transaction)
    {
        // Revert the transaction's effect on inventory
        $inventory = Inventory::findOrFail($inventory_transaction->item_id);
        if ($inventory_transaction->type === 'in') {
            $inventory->current_stock_level -= $inventory_transaction->quantity;
        } else {
            $inventory->current_stock_level += $inventory_transaction->quantity;
        }
        $inventory->save();

        $inventory_transaction->delete();

        return redirect()
            ->route('admin.inventory-transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }
} 