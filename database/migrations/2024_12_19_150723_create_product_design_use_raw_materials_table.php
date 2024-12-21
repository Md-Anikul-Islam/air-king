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
        Schema::create('product_design_use_raw_materials', function (Blueprint $table) {
            $table->id();
            $table->integer('product_design_id');
            $table->integer('raw_material_id');
            $table->integer('quantity');
            $table->decimal('per_unit_price', 10, 2);
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_design_use_raw_materials');
    }
};
