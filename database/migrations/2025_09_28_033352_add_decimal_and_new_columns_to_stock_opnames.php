<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddDecimalAndNewColumnsToStockOpnames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_opnames', function (Blueprint $table) {
            // Add new columns
            $table->text('keterangan')->nullable()->after('stok_fisik');
            $table->string('location_actual_status')->nullable()->after('location_actual'); // 'centang' or 'x'
            $table->text('location_actual_keterangan')->nullable()->after('location_actual_status');
        });

        // Change existing columns to decimal using raw SQL to avoid doctrine issues
        DB::statement('ALTER TABLE stock_opnames MODIFY COLUMN quantity_on_hand DECIMAL(15,5) DEFAULT 0');
        DB::statement('ALTER TABLE stock_opnames MODIFY COLUMN stok_fisik DECIMAL(15,5) DEFAULT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_opnames', function (Blueprint $table) {
            $table->dropColumn(['keterangan', 'location_actual_status', 'location_actual_keterangan']);
        });

        // Revert columns back to original types
        DB::statement('ALTER TABLE stock_opnames MODIFY COLUMN quantity_on_hand INT DEFAULT 0');
        DB::statement('ALTER TABLE stock_opnames MODIFY COLUMN stok_fisik INT DEFAULT NULL');
    }
}
