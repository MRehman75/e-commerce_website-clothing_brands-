<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();

            // ── Site Info ──
            $table->string('site_name')->nullable();
            $table->string('site_tagline')->nullable();
            $table->string('site_logo')->nullable();
            $table->string('site_favicon')->nullable();
            $table->string('site_email')->nullable();
            $table->string('site_phone')->nullable();
            $table->text('site_address')->nullable();

            // ── SEO ──
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('og_image')->nullable();
            $table->string('google_analytics_id')->nullable();
            $table->text('header_scripts')->nullable();
            $table->text('footer_scripts')->nullable();

            // ── Currency & Language ──
            $table->string('currency_code', 10)->default('USD');
            $table->string('currency_symbol', 10)->default('$');
            $table->enum('currency_position', ['before', 'after'])->default('before');
            $table->string('timezone')->default('UTC');
            $table->string('date_format')->default('d M Y');
            $table->string('language', 10)->default('en');

            // ── Email / SMTP ──
            $table->string('mail_driver')->default('smtp');
            $table->string('mail_host')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->enum('mail_encryption', ['tls', 'ssl', 'none'])->default('tls');
            $table->string('mail_from_address')->nullable();
            $table->string('mail_from_name')->nullable();

            // ── Social Links ──
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('whatsapp')->nullable();

            // ── Maintenance ──
            $table->boolean('maintenance_mode')->default(false);
            $table->text('maintenance_message')->nullable();
            $table->string('maintenance_allowed_ips')->nullable();

            $table->timestamps();
        });

        // Seed one default row
        DB::table('general_settings')->insert([
            'site_name'            => config('app.name', 'My Store'),
            'currency_code'        => 'USD',
            'currency_symbol'      => '$',
            'currency_position'    => 'before',
            'timezone'             => 'Asia/Karachi',
            'date_format'          => 'd M Y',
            'language'             => 'en',
            'mail_driver'          => 'smtp',
            'mail_encryption'      => 'tls',
            'maintenance_mode'     => false,
            'maintenance_message'  => 'We are under maintenance. Please check back soon.',
            'created_at'           => now(),
            'updated_at'           => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};