<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->id();
            $table->string('name');                          // Display name e.g. "JazzCash"
            $table->string('slug')->unique();                // jazzcash, stripe, cod, etc.
            $table->string('logo')->nullable();              // stored path
            $table->text('description')->nullable();
            $table->string('merchant_id')->nullable();
            $table->string('api_key')->nullable();
            $table->string('api_secret')->nullable();
            $table->string('webhook_url')->nullable();
            $table->json('extra_fields')->nullable();        // any extra key-value pairs
            $table->enum('mode', ['test', 'live'])->default('test');
            $table->boolean('is_active')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Seed default gateways
        $gateways = [
            ['name' => 'JazzCash',      'slug' => 'jazzcash',      'sort_order' => 1],
            ['name' => 'Easypaisa',     'slug' => 'easypaisa',     'sort_order' => 2],
            ['name' => 'Stripe',        'slug' => 'stripe',        'sort_order' => 3],
            ['name' => 'PayPal',        'slug' => 'paypal',        'sort_order' => 4],
            ['name' => 'COD',           'slug' => 'cod',           'sort_order' => 5],
            ['name' => 'Bank Transfer', 'slug' => 'bank_transfer', 'sort_order' => 6],
        ];

        foreach ($gateways as $gw) {
            DB::table('payment_gateways')->insert(array_merge($gw, [
                'mode'       => 'test',
                'is_active'  => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_gateways');
    }
};