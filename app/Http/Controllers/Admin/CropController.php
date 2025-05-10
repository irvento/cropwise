<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Crop;
use App\Models\Field;
use App\Models\PlantingSchedule;
use Illuminate\Http\Request;

class CropController extends Controller
{
    public function create()
    {
        $fields = Field::all();
        return view('admin.farm.crops.create', compact('fields'));
    }

    public function edit(Crop $crop)
    {
        $fields = Field::all();
        return view('admin.farm.crops.edit', compact('crop', 'fields'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'variety' => 'required|string|max:255',
            'growth_duration' => 'required|integer|min:1',
            'conditions' => 'nullable|string',
            'field_id' => 'nullable|exists:fields,id'
        ]);

        // Ensure growth_duration is an integer
        $validated['growth_duration'] = (int) $validated['growth_duration'];

        $crop = Crop::create($validated);

        // If you're creating a planting schedule, make sure to cast the growth_duration
        if ($request->filled('field_id')) {
            PlantingSchedule::create([
                'field_id' => $request->field_id,
                'crop_id' => $crop->id,
                'planting_date' => now(),
                'expected_harvest_date' => now()->addDays((int) $crop->growth_duration),
                'quantity_planted' => 1,
                'status' => 'Planned',
            ]);
        }

        return redirect()->route('admin.crops.index')
            ->with('success', 'Crop created successfully.');
    }

    public function update(Request $request, Crop $crop)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'variety' => 'required|string|max:255',
            'growth_duration' => 'required|integer|min:1',
            'conditions' => 'nullable|string',
            'field_id' => 'nullable|exists:fields,id'
        ]);

        // Ensure growth_duration is an integer
        $validated['growth_duration'] = (int) $validated['growth_duration'];

        $crop->update($validated);

        // If you're updating a planting schedule, make sure to cast the growth_duration
        if ($request->filled('field_id')) {
            PlantingSchedule::updateOrCreate(
                ['crop_id' => $crop->id],
                [
                    'field_id' => $request->field_id,
                    'planting_date' => now(),
                    'expected_harvest_date' => now()->addDays((int) $crop->growth_duration),
                    'quantity_planted' => 1,
                    'status' => 'Planned',
                ]
            );
        }

        return redirect()->route('admin.crops.index')
            ->with('success', 'Crop updated successfully.');
    }
} 