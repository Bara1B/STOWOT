<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOpnameHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_opname_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_opname_id')->constrained('stock_opnames')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('field_name'); // 'keterangan', 'stok_fisik', 'location_actual_status', etc
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->string('action'); // 'create', 'update', 'delete'
            $table->timestamps();
            
            $table->index(['stock_opname_id', 'field_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_opname_histories');
    }
}
