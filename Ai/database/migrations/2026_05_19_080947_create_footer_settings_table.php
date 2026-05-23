<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();

            // Branding
            $table->string('logo')->nullable();
            $table->string('company_name')->nullable();
            $table->text('about_text')->nullable();
            $table->string('copyright_text')->nullable();

            // Contact Info
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();

            // Social Links
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('whatsapp')->nullable();

            // Newsletter
            $table->boolean('show_newsletter')->default(true);
            $table->string('newsletter_title')->nullable();
            $table->string('newsletter_subtitle')->nullable();

            // App Store Links
            $table->string('playstore_link')->nullable();
            $table->string('appstore_link')->nullable();

            // Payment Icons
            $table->json('payment_methods')->nullable(); // ['visa','mastercard','easypaisa','jazzcash']

            // Bottom Bar
            $table->boolean('show_bottom_bar')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};