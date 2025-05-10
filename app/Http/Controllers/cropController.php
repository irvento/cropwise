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
        return view('admin.farm.crops.create', compact('fields'));
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

        $crop = Crop::create($validated);

        // Optionally create a planting schedule if field is selected
        if ($request->filled('field_id')) {
            PlantingSchedule::create([
                'field_id' => $request->field_id,
                'crop_id' => $crop->id,
                'planting_date' => now(),
                'expected_harvest_date' => now()->addDays($crop->growth_duration),
                'quantity_planted' => 1,
                'status' => 'Planned',
            ]);
        }

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
        return view('admin.farm.crops.edit', compact('crop', 'fields'));
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

        $crop->update($validated);

        // Optionally update or create a planting schedule if field is changed
        if ($request->filled('field_id') && $request->field_id != $crop->field_id) {
            PlantingSchedule::updateOrCreate(
                ['crop_id' => $crop->id],
                [
                    'field_id' => $request->field_id,
                    'planting_date' => now(),
                    'expected_harvest_date' => now()->addDays($crop->growth_duration),
                    'quantity_planted' => 1,
                    'status' => 'Planned',
                ]
            );
        }

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
