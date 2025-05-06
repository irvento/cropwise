<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('planting_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('field_id')->constrained('fields');
            $table->foreignId('crop_id')->constrained('crops');
            $table->date('planting_date');
            $table->date('expected_harvest_date');
            $table->decimal('quantity_planted', 10, 2);
            $table->string('status')->default('planned'); // planned, in progress, completed
            $table->foreignId('responsible_employee_id')->constrained('employees');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('planting_schedules');
    }
};