<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\FinanceTransaction;
use Illuminate\Http\Request;

class financeController extends Controller
{
    public function index()
    {
        $accounts = Finance::latest()->paginate(10);
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

        Finance::create($validated);

        return redirect()
            ->route('admin.finance.index')
            ->with('success', 'Finance account created successfully.');
    }

    public function show(Finance $finance)
    {
        $transactions = FinanceTransaction::where('account_id', $finance->id)
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
