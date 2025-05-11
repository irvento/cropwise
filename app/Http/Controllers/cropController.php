<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Crop;
use App\Models\Field;
use App\Models\PlantingSchedule;
use Illuminate\Http\Request;

class cropController extends Controller
{
    /**
     * Display a listing of the crops.
     */
    public function index()
    {
        $crops = Crop::with(['plantingSchedules', 'fields', 'mainField'])
            ->latest()
            ->paginate(10);
        return view('admin.farm.crops.index', compact('crops'));
    }

    /**
     * Show the form for creating a new crop.
     */
    public function create()
    {
        $fields = Field::all();
        // Set default values for the form
        $defaults = [
            'growth_duration' => 30, // Default growth duration in days
            'status' => 'Planned',   // Default status
            'quantity_planted' => 1,  // Default quantity
        ];
        return view('admin.farm.crops.create', compact('fields', 'defaults'));
    }

    /**
     * Store a newly created crop in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'variety' => 'required|string|max:255',
            'growth_duration' => 'required|integer|min:1',
            'conditions' => 'nullable|string',
            'field_id' => 'nullable|exists:fields,id'
        ]);

        // Set default values if not provided
        $validated['growth_duration'] = $validated['growth_duration'] ?? 30;
        $validated['conditions'] = $validated['conditions'] ?? 'Standard growing conditions';
        
        // Set default field if none selected
        if (empty($validated['field_id'])) {
            // Get the first available field or create a default one
            $defaultField = Field::first() ?? Field::create([
                'name' => 'Default Field',
                'location' => 'Main Farm',
                'size' => 100,
                'status' => 'Active'
            ]);
            $validated['field_id'] = $defaultField->id;
        }

        $crop = Crop::create($validated);

        // Create a planting schedule with the field (now we always have a field)
        PlantingSchedule::create([
            'field_id' => $validated['field_id'],
            'crop_id' => $crop->id,
            'planting_date' => now(),
            'expected_harvest_date' => now()->addDays((int) $crop->growth_duration),
            'quantity_planted' => 1,
            'status' => 'Planned',
        ]);

        return redirect()->route('admin.crops.index')
            ->with('success', 'Crop created successfully.');
    }

    /**
     * Display the specified crop.
     */
    public function show(Crop $crop)
    {
        $crop->load(['plantingSchedules.field', 'plantingSchedules.responsibleEmployee']);
        return view('admin.farm.crops.show', compact('crop'));
    }

    /**
     * Show the form for editing the specified crop.
     */
    public function edit(Crop $crop)
    {
        $fields = Field::all();
        // Set default values for the form
        $defaults = [
            'growth_duration' => 30,
            'status' => 'Planned',
            'quantity_planted' => 1,
        ];
        return view('admin.farm.crops.edit', compact('crop', 'fields', 'defaults'));
    }

    /**
     * Update the specified crop in storage.
     */
    public function update(Request $request, Crop $crop)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'variety' => 'required|string|max:255',
            'growth_duration' => 'required|integer|min:1',
            'conditions' => 'nullable|string',
            'field_id' => 'nullable|exists:fields,id'
        ]);

        // Set default values if not provided
        $validated['growth_duration'] = $validated['growth_duration'] ?? 30;
        $validated['conditions'] = $validated['conditions'] ?? 'Standard growing conditions';
        
        // Set default field if none selected
        if (empty($validated['field_id'])) {
            // Get the first available field or create a default one
            $defaultField = Field::first() ?? Field::create([
                'name' => 'Default Field',
                'location' => 'Main Farm',
                'size' => 100,
                'status' => 'Active'
            ]);
            $validated['field_id'] = $defaultField->id;
        }

        $crop->update($validated);

        // Update or create planting schedule with the field
        PlantingSchedule::updateOrCreate(
            ['crop_id' => $crop->id],
            [
                'field_id' => $validated['field_id'],
                'planting_date' => now(),
                'expected_harvest_date' => now()->addDays((int) $crop->growth_duration),
                'quantity_planted' => 1,
                'status' => 'Planned',
            ]
        );

        return redirect()->route('admin.crops.index')
            ->with('success', 'Crop updated successfully.');
    }

    /**
     * Remove the specified crop from storage.
     */
    public function destroy(Crop $crop)
    {
        // Check if crop has any planting schedules
        if ($crop->plantingSchedules()->exists()) {
            return redirect()->route('admin.crops.index')
                ->with('error', 'Cannot delete crop with existing planting schedules.');
        }

        $crop->delete();

        return redirect()->route('admin.crops.index')
            ->with('success', 'Crop deleted successfully.');
    }

    /**
     * Get planting schedules for a specific crop.
     */
    public function getPlantingSchedules(Crop $crop)
    {
        $schedules = $crop->plantingSchedules()
            ->with(['field', 'responsibleEmployee'])
            ->latest()
            ->paginate(10);

        return view('admin.planting-schedules.index', compact('crop', 'schedules'));
    }

    /**
     * Get fields where a crop is planted.
     */
    public function getFields(Crop $crop)
    {
        $fields = $crop->fields()
            ->with(['plantingSchedules' => function ($query) use ($crop) {
                $query->where('crop_id', $crop->id);
            }])
            ->paginate(10);

        return view('admin.farm.crops.fields', compact('crop', 'fields'));
    }
}
