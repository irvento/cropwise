<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('harvests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('planting_schedule_id')->constrained('planting_schedules');
            $table->date('harvest_date');
            $table->decimal('quantity', 10, 2);
            $table->string('quality_rating')->nullable();
            $table->foreignId('stored_location')->nullable()->constrained('inventory_items');
            $table->foreignId('responsible_employee_id')->constrained('employees');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('harvests');
    }
};