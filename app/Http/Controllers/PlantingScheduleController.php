<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PlantingSchedule;
use App\Models\Field;
use App\Models\Crop;
use Illuminate\Http\Request;

class PlantingScheduleController extends Controller
{
    public function index()
    {
        $schedules = PlantingSchedule::with(['field', 'crop'])
            ->latest()
            ->paginate(10);
        return view('admin.planting-schedules.index', compact('schedules'));
    }

    public function create()
    {
        $fields = Field::all();
        $crops = Crop::all();
        return view('admin.planting-schedules.create', compact('fields', 'crops'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'field_id' => 'required|exists:fields,id',
            'crop_id' => 'required|exists:crops,id',
            'planting_date' => 'required|date',
            'expected_harvest_date' => 'required|date|after:planting_date',
            'quantity_planted' => 'required|numeric|min:1',
            'status' => 'required|in:Planned,In Progress,Completed,Cancelled',
            'notes' => 'nullable|string'
        ]);

        PlantingSchedule::create($validated);

        return redirect()->route('admin.planting-schedules.index')
            ->with('success', 'Planting schedule created successfully.');
    }

    public function show(PlantingSchedule $plantingSchedule)
    {
        $plantingSchedule->load(['field', 'crop']);
        return view('admin.planting-schedules.show', compact('plantingSchedule'));
    }

    public function edit(PlantingSchedule $plantingSchedule)
    {
        $fields = Field::all();
        $crops = Crop::all();
        return view('admin.planting-schedules.edit', compact('plantingSchedule', 'fields', 'crops'));
    }

    public function update(Request $request, PlantingSchedule $plantingSchedule)
    {
        $validated = $request->validate([
            'field_id' => 'required|exists:fields,id',
            'crop_id' => 'required|exists:crops,id',
            'planting_date' => 'required|date',
            'expected_harvest_date' => 'required|date|after:planting_date',
            'quantity_planted' => 'required|numeric|min:1',
            'status' => 'required|in:Planned,In Progress,Completed,Cancelled',
            'notes' => 'nullable|string'
        ]);

        $plantingSchedule->update($validated);

        return redirect()
            ->route('admin.planting-schedules.show', $plantingSchedule)
            ->with('success', 'Planting schedule updated successfully.');
    }

    public function destroy(PlantingSchedule $plantingSchedule)
    {
        $plantingSchedule->delete();

        return redirect()
            ->route('admin.planting-schedules.index')
            ->with('success', 'Planting schedule deleted successfully.');
    }
} 