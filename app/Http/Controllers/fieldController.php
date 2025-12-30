<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Field::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('soil_type', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
            });

            // Prioritize exact matches
            $query->orderByRaw("
                CASE 
                    WHEN name = ? THEN 1
                    WHEN location = ? THEN 2
                    ELSE 3
                END", [$search, $search]);
        }

        $fields = $query->latest()->paginate(10)->appends(['search' => $search]);
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