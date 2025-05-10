<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;

class fieldController extends Controller
{
    public function index()
    {
        $fields = Field::latest()->paginate(10);
        return view('admin.fields.index', compact('fields'));
    }

    public function create()
    {
        return view('admin.fields.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'size' => 'required|numeric|min:0',
            'soil_type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'notes' => 'nullable|string'
        ]);

        Field::create($validated);

        return redirect()->route('admin.fields.index')
            ->with('success', 'Field created successfully.');
    }

    public function show(Field $field)
    {
        return view('admin.fields.show', compact('field'));
    }

    public function edit(Field $field)
    {
        return view('admin.fields.edit', compact('field'));
    }

    public function update(Request $request, Field $field)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'size' => 'required|numeric|min:0',
            'soil_type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'notes' => 'nullable|string'
        ]);

        $field->update($validated);

        return redirect()->route('admin.fields.index')
            ->with('success', 'Field updated successfully.');
    }

    public function destroy(Field $field)
    {
        $field->delete();

        return redirect()->route('admin.fields.index')
            ->with('success', 'Field deleted successfully.');
    }
} 