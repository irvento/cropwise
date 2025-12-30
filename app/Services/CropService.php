<?php

namespace App\Services;

use App\Models\Crop;
use App\Models\Field;
use App\Models\PlantingSchedule;
use Illuminate\Support\Facades\DB;

class CropService
{
    /**
     * Create a new crop and its initial planting schedule.
     */
    public function createCrop(array $data): Crop
    {
        return DB::transaction(function () use ($data) {
            $fieldId = $this->ensureFieldId($data['field_id'] ?? null);

            $crop = Crop::create([
                'name' => $data['name'],
                'variety' => $data['variety'],
                'growth_duration' => $data['growth_duration'] ?? 30,
                'conditions' => $data['conditions'] ?? 'Standard growing conditions',
                'field_id' => $fieldId,
            ]);

            PlantingSchedule::create([
                'field_id' => $fieldId,
                'crop_id' => $crop->id,
                'planting_date' => now(),
                'expected_harvest_date' => now()->addDays((int) $crop->growth_duration),
                'quantity_planted' => $data['quantity_planted'] ?? 1,
                'status' => $data['status'] ?? 'Planned',
            ]);

            return $crop;
        });
    }

    /**
     * Update an existing crop and its planting schedule.
     */
    public function updateCrop(Crop $crop, array $data): Crop
    {
        return DB::transaction(function () use ($crop, $data) {
            $fieldId = $this->ensureFieldId($data['field_id'] ?? null);

            $crop->update([
                'name' => $data['name'],
                'variety' => $data['variety'],
                'growth_duration' => $data['growth_duration'] ?? 30,
                'conditions' => $data['conditions'] ?? 'Standard growing conditions',
                'field_id' => $fieldId,
            ]);

            PlantingSchedule::updateOrCreate(
                ['crop_id' => $crop->id],
                [
                    'field_id' => $fieldId,
                    'planting_date' => now(),
                    'expected_harvest_date' => now()->addDays((int) $crop->growth_duration),
                    'quantity_planted' => $data['quantity_planted'] ?? 1,
                    'status' => $data['status'] ?? 'Planned',
                ]
            );

            return $crop;
        });
    }

    /**
     * Ensure we have a valid field ID.
     */
    private function ensureFieldId(?int $fieldId): int
    {
        if ($fieldId && Field::where('id', $fieldId)->exists()) {
            return $fieldId;
        }

        $defaultField = Field::first() ?? Field::create([
            'name' => 'Default Field',
            'location' => 'Main Farm',
            'size' => 100,
            'status' => 'Active',
            'soil_type' => 'Loam', // Added based on migration requirements
        ]);

        return $defaultField->id;
    }
}
