<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('planting_schedules', function (Blueprint $table) {
            $table->foreignId('responsible_employee_id')
                  ->nullable()
                  ->constrained('employees')
                  ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('planting_schedules', function (Blueprint $table) {
            $table->dropForeign(['responsible_employee_id']);
            $table->dropColumn('responsible_employee_id');
        });
    }
}; 