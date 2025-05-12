<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryCategory;
use App\Models\Supplier;
use App\Models\InventoryTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class inventoryController extends Controller
{
    public function index()
    {
        $items = Inventory::with(['category', 'supplier'])
            ->latest()
            ->paginate(10);

        $lowStockItems = Inventory::whereColumn('current_stock_level', '<=', 'minimum_stock_level')->count();
        $categoriesCount = InventoryCategory::count();
        $totalValue = Inventory::sum(DB::raw('current_stock_level * purchase_price'));
        
        $recentTransactions = InventoryTransaction::with('item')
            ->latest()
            ->take(5)
            ->get();
        
        $lowStockItemsList = Inventory::whereColumn('current_stock_level', '<=', 'minimum_stock_level')
            ->with('category')
            ->take(5)
            ->get();

        return view('admin.inventory.index', compact(
            'items',
            'lowStockItems',
            'categoriesCount',
            'totalValue',
            'recentTransactions',
            'lowStockItemsList'
        ));
    }

    public function create()
    {
        $categories = InventoryCategory::all();
        $suppliers = Supplier::all();
        return view('admin.inventory.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:inventory_categories,id',
            'quantity' => 'required|numeric|min:0',
            'unit_of_measurement' => 'required|string|max:50',
            'minimum_stock_level' => 'required|numeric|min:0',
            'current_stock_level' => 'required|numeric|min:0',
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'expiry_date' => 'nullable|date',
            'storage_location' => 'required|string|max:255',
        ]);

        $inventory = Inventory::create($validated);

        // Calculate total amount for initial transaction
        $total_amount = $validated['quantity'] * $validated['purchase_price'];

        // Create initial transaction record
        $inventory->transactions()->create([
            'transaction_type' => 'initial',
            'quantity' => $validated['quantity'],
            'unit_price' => $validated['purchase_price'],
            'total_amount' => $total_amount,
            'notes' => 'Initial stock',
        ]);

        return redirect()
            ->route('admin.inventory.index')
            ->with('success', 'Inventory item created successfully.');
    }

    public function show(Inventory $inventory)
    {
        $inventory->load(['category', 'supplier', 'transactions']);
        return view('admin.inventory.show', compact('inventory'));
    }

    public function edit(Inventory $inventory)
    {
        $categories = InventoryCategory::all();
        $suppliers = Supplier::all();
        return view('admin.inventory.edit', compact('inventory', 'categories', 'suppliers'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:inventory_categories,id',
            'quantity' => 'required|numeric|min:0',
            'unit_of_measurement' => 'required|string|max:50',
            'minimum_stock_level' => 'required|numeric|min:0',
            'current_stock_level' => 'required|numeric|min:0',
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'expiry_date' => 'nullable|date',
            'storage_location' => 'required|string|max:255',
        ]);

        $inventory->update($validated);

        return redirect()
            ->route('admin.inventory.show', $inventory)
            ->with('success', 'Inventory item updated successfully.');
    }

    public function destroy(Inventory $inventory)
    {
        // Check if item is used in any planting schedules
        if ($inventory->plantingSchedules()->exists()) {
            return redirect()
                ->route('admin.inventory.index')
                ->with('error', 'Cannot delete inventory item that is used in planting schedules.');
        }

        $inventory->delete();

        return redirect()
            ->route('admin.inventory.index')
            ->with('success', 'Inventory item deleted successfully.');
    }
}
