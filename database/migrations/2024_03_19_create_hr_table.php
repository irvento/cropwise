<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hr', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->string('department');
            $table->string('position');
            $table->date('hire_date');
            $table->enum('employment_status', ['active', 'inactive', 'on_leave'])->default('active');
            $table->enum('employment_type', ['full_time', 'part_time', 'contract'])->default('full_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hr');
    }
}; 