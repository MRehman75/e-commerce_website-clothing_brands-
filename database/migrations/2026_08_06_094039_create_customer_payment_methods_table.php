<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('customer_payment_methods', function (Blueprint $table) {

        $table->id();

        $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->string('card_type');

        $table->string('card_last4', 4);

        $table->integer('expiry_month');

        $table->integer('expiry_year');

        $table->boolean('is_default')
            ->default(false);

        $table->timestamps();

    });
}


public function down(): void
{
    Schema::dropIfExists('customer_payment_methods');
}
};
