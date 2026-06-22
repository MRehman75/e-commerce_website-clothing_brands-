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
    // Schema::table('products', function (Blueprint $table) {
    //     $table->string('name');
    //     $table->string('slug')->unique();
    //     $table->string('sku')->nullable()->unique();
    //     $table->longText('description')->nullable();
    //     $table->decimal('price', 10, 2)->default(0);
    //     $table->decimal('compare_price', 10, 2)->nullable();
    //     $table->integer('stock')->default(0);
    //     $table->string('image')->nullable();
    //     $table->json('gallery')->nullable();
    //     $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
    //     $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
    //     $table->enum('status', ['active', 'inactive', 'draft'])->default('active');
    //     $table->boolean('featured')->default(false);
    //     $table->json('attributes')->nullable();
    //     $table->string('seo_title')->nullable();
    //     $table->text('seo_description')->nullable();
    // });
}


    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    // Schema::table('products', function (Blueprint $table) {
    //     $table->dropColumn([
    //         'name','slug','sku','description','price','compare_price',
    //         'stock','image','gallery','category_id','brand_id',
    //         'status','featured','attributes','seo_title','seo_description'
    //     ]);
    // });
}
};
