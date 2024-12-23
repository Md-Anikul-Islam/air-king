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
        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->integer('production_design_id');
            $table->integer('batch_id');
            $table->integer('brand_id');
            $table->decimal('unit_price', 10, 2);
            $table->integer('production_qty');
            $table->integer('sell_qty')->nullable();
            $table->integer('available_qty')->nullable();
            $table->string('production_status');
            $table->integer('warehouse_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productions');
    }
};
