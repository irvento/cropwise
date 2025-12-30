<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Crop;
use App\Models\Field;
use App\Models\PlantingSchedule;
use App\Services\CropService;
use Illuminate\Http\Request;

class CropController extends Controller
{
    /**
     * @var CropService
     */
    protected $cropService;

    public function __construct(CropService $cropService)
    {
        $this->cropService = $cropService;
    }
    /**
     * Display a listing of the crops.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Crop::with(['plantingSchedules', 'fields', 'mainField']);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('variety', 'like', "%{$search}%")
                  ->orWhere('conditions', 'like', "%{$search}%")
                  ->orWhereHas('mainField', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });

            // Prioritize exact matches
            $query->orderByRaw("
                CASE 
                    WHEN name = ? THEN 1
                    WHEN variety = ? THEN 2
                    ELSE 3
                END", [$search, $search]);
        }

        $crops = $query->latest()->paginate(10)->appends(['search' => $search]);
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
            'field_id' => 'nullable|exists:fields,id',
            'quantity_planted' => 'nullable|integer|min:1',
            'status' => 'nullable|string'
        ]);

        $this->cropService->createCrop($validated);

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
            'field_id' => 'nullable|exists:fields,id',
            'quantity_planted' => 'nullable|integer|min:1',
            'status' => 'nullable|string'
        ]);

        $this->cropService->updateCrop($crop, $validated);

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
