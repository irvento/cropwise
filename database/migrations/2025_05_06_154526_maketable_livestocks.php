<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('livestock', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('animal_variety');
            $table->integer('growth_duration'); // in days
            $table->text('conditions')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('livestock');
    }
};