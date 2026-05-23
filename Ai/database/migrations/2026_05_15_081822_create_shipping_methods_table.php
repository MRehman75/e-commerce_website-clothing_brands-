<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_zone_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->string('name');                      // "Standard", "Express", "Overnight"
            $table->string('carrier')->nullable();       // "TCS", "Leopards", "DHL"
            $table->enum('rate_type', ['flat', 'weight_based', 'price_based'])->default('flat');
            $table->decimal('rate', 10, 2)->default(0); // base rate
            $table->decimal('min_order_amount', 10, 2)->nullable();  // free shipping threshold
            $table->integer('estimated_days_min')->nullable();
            $table->integer('estimated_days_max')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipping_methods');
    }
};