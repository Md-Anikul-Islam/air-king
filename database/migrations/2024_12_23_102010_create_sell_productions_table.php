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
        Schema::create('sell_productions', function (Blueprint $table) {
            $table->id();
            $table->integer('production_id');
            $table->integer('customer_id');
            $table->integer('sell_qty');
            $table->date('sell_date');
            $table->decimal('unit_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sell_productions');
    }
};
