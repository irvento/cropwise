<?php

namespace App\Http\Controllers;

use App\Models\Livestock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class livestockController extends Controller
{
    /**
     * Display a listing of the livestock.
     */
    public function index()
    {
        $livestock = Livestock::latest()->paginate(10);
        return view('admin.farm.livestock.index', compact('livestock'));
    }

    /**
     * Show the form for creating a new livestock.
     */
    public function create()
    {
        return view('admin.farm.livestock.create');
    }

    /**
     * Store a newly created livestock in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'animalvariety' => 'required|string|max:255',
            'growth_duration' => 'required|integer|min:0',
            'age' => 'required|integer|min:0',
            'weight' => 'required|numeric|min:0',
            'health_status' => 'required|in:healthy,sick,under_observation',
            'conditions' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Livestock::create($request->all());

        return redirect()->route('admin.farm.livestock.index')
            ->with('success', 'Livestock record created successfully.');
    }

    /**
     * Display the specified livestock.
     */
    public function show(Livestock $livestock)
    {
        return view('admin.farm.livestock.show', compact('livestock'));
    }

    /**
     * Show the form for editing the specified livestock.
     */
    public function edit(Livestock $livestock)
    {
        return view('admin.farm.livestock.edit', compact('livestock'));
    }

    /**
     * Update the specified livestock in storage.
     */
    public function update(Request $request, Livestock $livestock)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'animalvariety' => 'required|string|max:255',
            'growth_duration' => 'required|integer|min:0',
            'age' => 'required|integer|min:0',
            'weight' => 'required|numeric|min:0',
            'health_status' => 'required|in:healthy,sick,under_observation',
            'conditions' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $livestock->update($request->all());

        return redirect()->route('admin.farm.livestock.index')
            ->with('success', 'Livestock record updated successfully.');
    }

    /**
     * Remove the specified livestock from storage.
     */
    public function destroy(Livestock $livestock)
    {
        $livestock->delete();

        return redirect()->route('admin.farm.livestock.index')
            ->with('success', 'Livestock record deleted successfully.');
    }
}
