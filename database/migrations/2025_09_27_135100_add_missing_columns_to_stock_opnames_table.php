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
        Schema::table('stock_opnames', function (Blueprint $table) {
            // Add missing columns only if they don't exist
            if (!Schema::hasColumn('stock_opnames', 'file_id')) {
                $table->unsignedBigInteger('file_id')->nullable()->after('id');
            }
            
            if (!Schema::hasColumn('stock_opnames', 'location_actual')) {
                $table->string('location_actual')->nullable()->after('location_system');
            }
            
            if (!Schema::hasColumn('stock_opnames', 'stok_fisik')) {
                $table->decimal('stok_fisik', 10, 5)->nullable()->after('quantity_on_hand');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_opnames', function (Blueprint $table) {
            $table->dropColumn(['file_id', 'location_actual', 'stok_fisik']);
        });
    }
};
