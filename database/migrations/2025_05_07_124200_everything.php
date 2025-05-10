<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Roles Table
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->json('permissions')->nullable();
            $table->timestamps();
        });

        // Alter Users Table
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->after('id')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('address')->nullable();
            $table->foreign('role_id')->references('id')->on('roles');
        });

        // Inventory Categories
        Schema::create('inventory_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Suppliers
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('products_supplied')->nullable();
            $table->timestamps();
        });

        // Inventory Items
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained('inventory_categories');
            $table->integer('quantity');
            $table->string('unit_of_measurement');
            $table->integer('minimum_stock_level');
            $table->integer('current_stock_level');
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->decimal('purchase_price', 10, 2);
            $table->decimal('selling_price', 10, 2)->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('storage_location')->nullable();
            $table->timestamps();
        });

        // Inventory Transactions
        Schema::create('inventory_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('inventory_items');
            $table->string('transaction_type');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Financial Accounts
        Schema::create('financial_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->decimal('balance', 15, 2);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Financial Transactions
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('financial_accounts');
            $table->string('type');
            $table->string('category');
            $table->decimal('amount', 15, 2);
            $table->date('date');
            $table->text('description')->nullable();
            $table->string('reference_number')->nullable();
            $table->foreignId('recorded_by')->constrained('users');
            $table->string('related_entity_type')->nullable();
            $table->unsignedBigInteger('related_entity_id')->nullable();
            $table->timestamps();
        });

        // Budgets
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->decimal('amount', 15, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->text('description')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });

        // Employees
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('position');
            $table->decimal('salary', 10, 2);
            $table->string('contact_number');
            $table->string('address')->nullable();
            $table->string('status');
            $table->timestamps();
        });

        // Attendance
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees');
            $table->date('date');
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->string('status');
            $table->timestamps();
        });

        // Payroll
        Schema::create('payroll', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees');
            $table->decimal('basic_salary', 10, 2);
            $table->string('status');
            $table->date('payment_date');
            $table->timestamps();
        });

        // Leave Requests
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees');
            $table->string('leave_type');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('reason');
            $table->string('status');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });

        // Fields / Plots
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->decimal('size', 10, 2);
            $table->string('soil_type');
            $table->string('status');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Crops
        Schema::create('crops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('variety');
            $table->integer('growth_duration');
            $table->text('conditions')->nullable();
            $table->timestamps();
        });

        // Livestock
        Schema::create('livestock', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('animalvariety');
            $table->integer('growth_duration');
            $table->text('conditions')->nullable();
            $table->timestamps();
        });

        // Planting Schedules
        Schema::create('planting_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('field_id')->constrained('fields');
            $table->foreignId('crop_id')->constrained('crops');
            $table->date('planting_date');
            $table->date('expected_harvest_date');
            $table->integer('quantity_planted');
            $table->string('status');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Harvests
        Schema::create('harvests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('planting_schedule_id')->constrained('planting_schedules');
            $table->date('harvest_date');
            $table->integer('quantity');
            $table->string('quality_rating');
            $table->foreignId('stored_location')->nullable()->constrained('inventory_items');
            $table->foreignId('responsible_employee_id')->constrained('employees');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Tasks
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignId('assigned_to')->constrained('employees');
            $table->date('due_date');
            $table->string('priority');
            $table->string('status');
            $table->date('completion_date')->nullable();
            $table->timestamps();
        });

        // Weather Data
        Schema::create('weather_data', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('temperature', 5, 2);
            $table->decimal('humidity', 5, 2);
            $table->decimal('rainfall', 5, 2);
            $table->decimal('wind_speed', 5, 2);
            $table->string('conditions')->nullable();
            $table->string('source')->nullable();
            $table->timestamp('recorded_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('weather_data');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('harvests');
        Schema::dropIfExists('planting_schedules');
        Schema::dropIfExists('livestock');
        Schema::dropIfExists('crops');
        Schema::dropIfExists('fields');
        Schema::dropIfExists('leave_requests');
        Schema::dropIfExists('payroll');
        Schema::dropIfExists('attendance');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('budgets');
        Schema::dropIfExists('financial_transactions');
        Schema::dropIfExists('financial_accounts');
        Schema::dropIfExists('inventory_transactions');
        Schema::dropIfExists('inventory_items');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('inventory_categories');
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn(['role_id', 'contact_number', 'address']);
        });
        Schema::dropIfExists('roles');

        Schema::enableForeignKeyConstraints();
    }
};
