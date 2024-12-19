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
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('raw_material_section_id')->constrained('raw_materials');
            $table->foreignId('raw_material_supplier_id')->constrained('suppliers');
            $table->string('raw_material_name');
            $table->string('raw_material_unit');
            $table->string('raw_material_code');
            $table->decimal('raw_material_price', 8, 2);
            $table->decimal('raw_material_qty', 8, 2);
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
        Schema::dropIfExists('raw_materials');
    }
};
