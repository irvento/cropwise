<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryCategory;
use App\Models\Supplier;
use App\Models\InventoryTransaction;
use App\Models\Finance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class inventoryController extends Controller
{
    public function index()
    {
        $query = Inventory::with(['category', 'supplier']);

        // Handle search
        if (request()->has('search') && !empty(request('search'))) {
            $searchTerm = request('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('storage_location', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('category', function($q) use ($searchTerm) {
                      $q->where('name', 'LIKE', "%{$searchTerm}%");
                  })
                  ->orWhereHas('supplier', function($q) use ($searchTerm) {
                      $q->where('name', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }

        $items = $query->latest()->paginate(10)->withQueryString();

        $lowStockItems = Inventory::whereColumn('current_stock_level', '<=', 'minimum_stock_level')->count();
        $categoriesCount = InventoryCategory::count();
        $totalValue = Inventory::sum(DB::raw('current_stock_level * purchase_price'));
        
        $recentTransactions = InventoryTransaction::with('inventory')
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
        $financeAccounts = Finance::all();
        return view('admin.inventory.create', compact('categories', 'suppliers', 'financeAccounts'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'category_id' => 'required|exists:inventory_categories,id',
                'supplier_id' => 'required|exists:suppliers,id',
                'quantity' => 'required|numeric|min:0',
                'unit_of_measurement' => 'required|string|max:50',
                'minimum_stock_level' => 'required|numeric|min:0',
                'current_stock_level' => 'required|numeric|min:0',
                'purchase_price' => 'required|numeric|min:0',
                'selling_price' => 'required|numeric|min:0',
                'expiry_date' => 'nullable|date',
                'storage_location' => 'required|string|max:255',
                'transaction_type' => 'required|in:purchase,sale,adjustment,initial',
                'finance_account_id' => 'required|exists:financial_accounts,id'
            ]);

            DB::beginTransaction();

            // Get the financial account
            $financeAccount = Finance::findOrFail($validated['finance_account_id']);
            
            // Calculate total amount
            $totalAmount = $validated['quantity'] * $validated['purchase_price'];

            // Check if account has sufficient balance
            if ($financeAccount->balance < $totalAmount) {
                throw new \Exception('Insufficient balance in the selected financial account.');
            }

            // Create the inventory item
            $inventory = Inventory::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'category_id' => $validated['category_id'],
                'supplier_id' => $validated['supplier_id'],
                'unit_of_measurement' => $validated['unit_of_measurement'],
                'minimum_stock_level' => $validated['minimum_stock_level'],
                'current_stock_level' => $validated['current_stock_level'],
                'purchase_price' => $validated['purchase_price'],
                'selling_price' => $validated['selling_price'],
                'expiry_date' => $validated['expiry_date'],
                'storage_location' => $validated['storage_location'],
                'quantity' => $validated['quantity']
            ]);

            // Create initial transaction record
            InventoryTransaction::create([
                'item_id' => $inventory->id,
                'finance_account_id' => $validated['finance_account_id'],
                'transaction_type' => $validated['transaction_type'],
                'quantity' => $validated['quantity'],
                'unit_price' => $validated['purchase_price'],
                'total_amount' => $totalAmount,
                'notes' => "Initial stock entry for {$validated['name']}"
            ]);

            // Deduct from financial account balance
            $financeAccount->update([
                'balance' => $financeAccount->balance - $totalAmount
            ]);

            DB::commit();

            return redirect()
                ->route('admin.inventory.index')
                ->with('success', 'Inventory item created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create inventory item: ' . $e->getMessage()]);
        }
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
