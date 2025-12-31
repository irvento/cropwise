<?php

namespace App\Http\Controllers;

use App\Models\FinancialAccount;
use App\Models\FinancialTransaction;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        $query = FinancialAccount::query();

        // Handle search
        if (request()->has('search') && !empty(request('search'))) {
            $searchTerm = request('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('type', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        $accounts = $query->latest()->paginate(10)->withQueryString();
        return view('admin.finance.index', compact('accounts'));
    }

    public function create()
    {
        return view('admin.finance.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense,asset,liability',
            'balance' => 'required|numeric',
            'description' => 'nullable|string'
        ]);

        FinancialAccount::create($validated);

        return redirect()
            ->route('admin.finance.index')
            ->with('success', 'Finance account created successfully.');
    }

    public function show(Finance $finance)
    {
        $transactions = FinancialTransaction::where('account_id', $finance->id)
            ->latest()
            ->take(10)
            ->get();
            
        return view('admin.finance.show', compact('finance', 'transactions'));
    }

    public function edit(Finance $finance)
    {
        return view('admin.finance.edit', compact('finance'));
    }

    public function update(Request $request, Finance $finance)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense,asset,liability',
            'balance' => 'required|numeric',
            'description' => 'nullable|string'
        ]);

        $finance->update($validated);

        return redirect()
            ->route('admin.finance.index')
            ->with('success', 'Finance account updated successfully.');
    }

    public function destroy(Finance $finance)
    {
        $finance->delete();
        return redirect()
            ->route('admin.finance.index')
            ->with('success', 'Finance account deleted successfully.');
    }
}
