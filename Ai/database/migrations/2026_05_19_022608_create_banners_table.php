<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('image');
            $table->string('link')->nullable();
            $table->boolean('open_in_new_tab')->default(false);
            $table->enum('position', [
                'homepage_top',
                'homepage_middle',
                'homepage_bottom',
                'category_top',
                'sidebar',
                'popup',
            ])->default('homepage_top');
            $table->date('starts_at')->nullable();
            $table->date('ends_at')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};