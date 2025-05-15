<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();

            // Seed Inventory Categories
            $categories = [
                ['name' => 'Seeds', 'description' => 'Various crop seeds'],
                ['name' => 'Fertilizers', 'description' => 'Chemical and organic fertilizers'],
                ['name' => 'Equipment', 'description' => 'Farming tools and machinery'],
                ['name' => 'Pesticides', 'description' => 'Crop protection chemicals'],
                ['name' => 'Animal Feed', 'description' => 'Livestock feed and supplements']
            ];

            foreach ($categories as $category) {
                DB::table('inventory_categories')->insert([
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Seed Suppliers
            $suppliers = [
                [
                    'name' => 'AgriTech Solutions',
                    'contact_person' => 'John Smith',
                    'email' => 'john@agritech.com',
                    'phone' => '09123456789',
                    'address' => '123 Farming Street, Manila',
                    'products_supplied' => 'Seeds, Fertilizers, Equipment'
                ],
                [
                    'name' => 'Farm Supply Co.',
                    'contact_person' => 'Maria Garcia',
                    'email' => 'maria@farmsupply.com',
                    'phone' => '09234567890',
                    'address' => '456 Agriculture Ave, Cebu',
                    'products_supplied' => 'Pesticides, Animal Feed'
                ],
                [
                    'name' => 'Green Growth Inc.',
                    'contact_person' => 'Robert Tan',
                    'email' => 'robert@greengrowth.com',
                    'phone' => '09345678901',
                    'address' => '789 Farm Road, Davao',
                    'products_supplied' => 'Organic Fertilizers, Seeds'
                ]
            ];

            foreach ($suppliers as $supplier) {
                DB::table('suppliers')->insert([
                    'name' => $supplier['name'],
                    'contact_person' => $supplier['contact_person'],
                    'email' => $supplier['email'],
                    'phone' => $supplier['phone'],
                    'address' => $supplier['address'],
                    'products_supplied' => $supplier['products_supplied'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Seed Fields
            $fields = [
                [
                    'name' => 'North Field',
                    'location' => 'North Section',
                    'size' => 5.5,
                    'soil_type' => 'Loam',
                    'status' => 'Active',
                    'notes' => 'Good drainage, suitable for rice'
                ],
                [
                    'name' => 'South Field',
                    'location' => 'South Section',
                    'size' => 4.2,
                    'soil_type' => 'Clay',
                    'status' => 'Active',
                    'notes' => 'Rich in minerals, good for vegetables'
                ],
                [
                    'name' => 'East Field',
                    'location' => 'East Section',
                    'size' => 3.8,
                    'soil_type' => 'Sandy Loam',
                    'status' => 'Resting',
                    'notes' => 'Under crop rotation'
                ]
            ];

            foreach ($fields as $field) {
                DB::table('fields')->insert([
                    'name' => $field['name'],
                    'location' => $field['location'],
                    'size' => $field['size'],
                    'soil_type' => $field['soil_type'],
                    'status' => $field['status'],
                    'notes' => $field['notes'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Seed Crops
            $crops = [
                [
                    'name' => 'Rice',
                    'variety' => 'IR64',
                    'growth_duration' => 120,
                    'conditions' => 'Requires consistent water supply, full sun'
                ],
                [
                    'name' => 'Corn',
                    'variety' => 'Yellow Sweet',
                    'growth_duration' => 90,
                    'conditions' => 'Well-drained soil, moderate water'
                ],
                [
                    'name' => 'Tomato',
                    'variety' => 'Hybrid F1',
                    'growth_duration' => 75,
                    'conditions' => 'Rich soil, regular watering'
                ]
            ];

            foreach ($crops as $crop) {
                DB::table('crops')->insert([
                    'name' => $crop['name'],
                    'variety' => $crop['variety'],
                    'growth_duration' => $crop['growth_duration'],
                    'conditions' => $crop['conditions'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Seed Livestock
            $livestock = [
                [
                    'name' => 'Carabao',
                    'animalvariety' => 'Native',
                    'growth_duration' => 730,
                    'conditions' => 'Requires grazing area, regular water supply'
                ],
                [
                    'name' => 'Chicken',
                    'animalvariety' => 'Broiler',
                    'growth_duration' => 45,
                    'conditions' => 'Clean coop, balanced feed'
                ],
                [
                    'name' => 'Pig',
                    'animalvariety' => 'Native',
                    'growth_duration' => 180,
                    'conditions' => 'Clean pen, regular feeding'
                ]
            ];

            foreach ($livestock as $animal) {
                DB::table('livestock')->insert([
                    'name' => $animal['name'],
                    'animalvariety' => $animal['animalvariety'],
                    'growth_duration' => $animal['growth_duration'],
                    'conditions' => $animal['conditions'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Seed Planting Schedules
            $plantingSchedules = [
                [
                    'field_id' => 1,
                    'crop_id' => 1,
                    'planting_date' => Carbon::now(),
                    'expected_harvest_date' => Carbon::now()->addDays(120),
                    'quantity_planted' => 1000,
                    'status' => 'Active',
                    'notes' => 'Regular monitoring needed'
                ],
                [
                    'field_id' => 2,
                    'crop_id' => 2,
                    'planting_date' => Carbon::now()->addDays(15),
                    'expected_harvest_date' => Carbon::now()->addDays(105),
                    'quantity_planted' => 800,
                    'status' => 'Planned',
                    'notes' => 'Prepare soil in advance'
                ]
            ];

            foreach ($plantingSchedules as $schedule) {
                DB::table('planting_schedules')->insert([
                    'field_id' => $schedule['field_id'],
                    'crop_id' => $schedule['crop_id'],
                    'planting_date' => $schedule['planting_date'],
                    'expected_harvest_date' => $schedule['expected_harvest_date'],
                    'quantity_planted' => $schedule['quantity_planted'],
                    'status' => $schedule['status'],
                    'notes' => $schedule['notes'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Seed Financial Accounts
            $accounts = [
                [
                    'name' => 'Main Operating Account',
                    'type' => 'Checking',
                    'balance' => 500000.00,
                    'description' => 'Primary business account'
                ],
                [
                    'name' => 'Equipment Fund',
                    'type' => 'Savings',
                    'balance' => 200000.00,
                    'description' => 'Reserved for equipment purchases'
                ],
                [
                    'name' => 'Emergency Fund',
                    'type' => 'Savings',
                    'balance' => 100000.00,
                    'description' => 'Reserved for emergencies'
                ]
            ];

            foreach ($accounts as $account) {
                DB::table('financial_accounts')->insert([
                    'name' => $account['name'],
                    'type' => $account['type'],
                    'balance' => $account['balance'],
                    'description' => $account['description'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Seed Inventory Items
            $inventoryItems = [
                [
                    'name' => 'Rice Seeds',
                    'description' => 'High-yield rice variety',
                    'category_id' => 1,
                    'quantity' => 1000,
                    'unit_of_measurement' => 'kg',
                    'minimum_stock_level' => 100,
                    'current_stock_level' => 1000,
                    'supplier_id' => 1,
                    'purchase_price' => 50.00,
                    'selling_price' => 60.00,
                    'expiry_date' => Carbon::now()->addMonths(12),
                    'storage_location' => 'Warehouse A'
                ],
                [
                    'name' => 'Organic Fertilizer',
                    'description' => 'Natural compost fertilizer',
                    'category_id' => 2,
                    'quantity' => 500,
                    'unit_of_measurement' => 'bags',
                    'minimum_stock_level' => 50,
                    'current_stock_level' => 500,
                    'supplier_id' => 3,
                    'purchase_price' => 200.00,
                    'selling_price' => 250.00,
                    'expiry_date' => Carbon::now()->addMonths(6),
                    'storage_location' => 'Warehouse B'
                ]
            ];

            $itemIds = [];
            foreach ($inventoryItems as $item) {
                $id = DB::table('inventory_items')->insertGetId([
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'category_id' => $item['category_id'],
                    'quantity' => $item['quantity'],
                    'unit_of_measurement' => $item['unit_of_measurement'],
                    'minimum_stock_level' => $item['minimum_stock_level'],
                    'current_stock_level' => $item['current_stock_level'],
                    'supplier_id' => $item['supplier_id'],
                    'purchase_price' => $item['purchase_price'],
                    'selling_price' => $item['selling_price'],
                    'expiry_date' => $item['expiry_date'],
                    'storage_location' => $item['storage_location'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                $itemIds[] = $id;
            }

            // Seed Inventory Transactions
            $transactions = [
                [
                    'item_id' => $itemIds[0],
                    'transaction_type' => 'Purchase',
                    'quantity' => 1000,
                    'unit_price' => 50.00,
                    'total_amount' => 50000.00,
                    'notes' => 'Initial stock purchase'
                ],
                [
                    'item_id' => $itemIds[1],
                    'transaction_type' => 'Purchase',
                    'quantity' => 500,
                    'unit_price' => 200.00,
                    'total_amount' => 100000.00,
                    'notes' => 'Bulk purchase for planting season'
                ]
            ];

            foreach ($transactions as $transaction) {
                DB::table('inventory_transactions')->insert([
                    'item_id' => $transaction['item_id'],
                    'transaction_type' => $transaction['transaction_type'],
                    'quantity' => $transaction['quantity'],
                    'unit_price' => $transaction['unit_price'],
                    'total_amount' => $transaction['total_amount'],
                    'notes' => $transaction['notes'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
