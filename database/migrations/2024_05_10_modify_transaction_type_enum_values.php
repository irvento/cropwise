<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // First, modify the column to allow NULL temporarily
        DB::statement("ALTER TABLE inventory_transactions MODIFY transaction_type VARCHAR(255) NULL");
        
        // Then update the column to the new enum
        DB::statement("ALTER TABLE inventory_transactions MODIFY transaction_type ENUM('purchase', 'sale', 'adjustment', 'initial') NOT NULL");
    }

    public function down()
    {
        // Revert to original enum values if needed
        DB::statement("ALTER TABLE inventory_transactions MODIFY transaction_type ENUM('purchase', 'sale', 'adjustment', 'initial') NOT NULL");
    }
}; 