<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('livestock', function (Blueprint $table) {
            $table->string('growthduration')->nullable()->after('animalvariety');
            $table->integer('age')->nullable()->after('growthduration');
            $table->decimal('weight', 8, 2)->nullable()->after('age');
            $table->string('health_status')->nullable()->after('weight');
            $table->string('location')->nullable()->after('health_status');
            $table->foreignId('owner_id')->nullable()->constrained('users')->after('location');
        });
    }

    public function down(): void
    {
        Schema::table('livestock', function (Blueprint $table) {
            $table->dropColumn(['growthduration', 'age', 'weight', 'health_status', 'location']);
            $table->dropForeign(['owner_id']);
            $table->dropColumn('owner_id');
        });
    }
};
