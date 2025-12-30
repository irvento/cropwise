<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryCategory;
use Illuminate\Http\Request;

class InventoryCategoryController extends Controller
{
    public function index()
    {
        $categories = InventoryCategory::with(['items'])
            ->latest()
            ->paginate(10);
        return view('admin.inventory_category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.inventory_category.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        InventoryCategory::create($validated);

        return redirect()
            ->route('admin.inventory-category.index')
            ->with('success', 'Category created successfully.');
    }

    public function show(InventoryCategory $inventoryCategory)
    {
        $inventoryCategory->load(['items']);
        return view('admin.inventory_category.show', compact('inventoryCategory'));
    }

    public function edit(InventoryCategory $inventoryCategory)
    {
        return view('admin.inventory_category.edit', compact('inventoryCategory'));
    }

    public function update(Request $request, InventoryCategory $inventoryCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $inventoryCategory->update($validated);

        return redirect()
            ->route('admin.inventory-category.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(InventoryCategory $inventoryCategory)
    {
        // Check if category has any items
        if ($inventoryCategory->items()->exists()) {
            return redirect()
                ->route('admin.inventory-category.index')
                ->with('error', 'Cannot delete category with existing items.');
        }

        $inventoryCategory->delete();

        return redirect()
            ->route('admin.inventory-category.index')
            ->with('success', 'Category deleted successfully.');
    }
}
