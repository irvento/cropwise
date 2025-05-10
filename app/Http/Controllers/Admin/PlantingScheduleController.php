<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Crop;
use App\Models\Employee;
use App\Models\PlantingSchedule;
use Illuminate\Http\Request;

class PlantingScheduleController extends Controller
{
    public function create()
    {
        $fields = Field::all();
        $crops = Crop::all();
        $employees = Employee::all();
        return view('admin.planting-schedules.create', compact('fields', 'crops', 'employees'));
    }

    public function edit(PlantingSchedule $plantingSchedule)
    {
        $fields = Field::all();
        $crops = Crop::all();
        $employees = Employee::all();
        return view('admin.planting-schedules.edit', compact('plantingSchedule', 'fields', 'crops', 'employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'field_id' => 'required|exists:fields,id',
            'crop_id' => 'required|exists:crops,id',
            'planting_date' => 'required|date',
            'expected_harvest_date' => 'required|date|after:planting_date',
            'quantity_planted' => 'required|numeric|min:0',
            'status' => 'required|in:Planned,In Progress,Completed,Cancelled',
            'responsible_employee_id' => 'nullable|exists:employees,id',
            'notes' => 'nullable|string'
        ]);

        PlantingSchedule::create($validated);

        return redirect()->route('admin.planting-schedules.index')
            ->with('success', 'Planting schedule created successfully.');
    }

    public function update(Request $request, PlantingSchedule $plantingSchedule)
    {
        $validated = $request->validate([
            'field_id' => 'required|exists:fields,id',
            'crop_id' => 'required|exists:crops,id',
            'planting_date' => 'required|date',
            'expected_harvest_date' => 'required|date|after:planting_date',
            'quantity_planted' => 'required|numeric|min:0',
            'status' => 'required|in:Planned,In Progress,Completed,Cancelled',
            'responsible_employee_id' => 'nullable|exists:employees,id',
            'notes' => 'nullable|string'
        ]);

        $plantingSchedule->update($validated);

        return redirect()
            ->route('admin.planting-schedules.show', $plantingSchedule)
            ->with('success', 'Planting schedule updated successfully.');
    }
} 