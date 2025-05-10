<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('inventory_transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('inventory_transactions', 'transaction_type')) {
                $table->enum('transaction_type', ['purchase', 'sale', 'adjustment', 'initial'])->after('item_id');
            }
        });
    }

    public function down()
    {
        Schema::table('inventory_transactions', function (Blueprint $table) {
            if (Schema::hasColumn('inventory_transactions', 'transaction_type')) {
                $table->dropColumn('transaction_type');
            }
        });
    }
}; 