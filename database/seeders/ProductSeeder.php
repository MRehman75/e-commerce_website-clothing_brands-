<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    $products = [
        ['name' => 'Product 1', 'slug' => 'product-1', 'sku' => 'SKU-001', 'price' => 500, 'stock' => 100, 'status' => 'active', 'stock_status' => 'instock'],
        ['name' => 'Product 2', 'slug' => 'product-2', 'sku' => 'SKU-002', 'price' => 1200, 'stock' => 50, 'status' => 'active', 'stock_status' => 'instock'],
        ['name' => 'Product 3', 'slug' => 'product-3', 'sku' => 'SKU-003', 'price' => 800, 'stock' => 75, 'status' => 'active', 'stock_status' => 'instock'],
    ];

    foreach ($products as $product) {
        \App\Models\Product::create($product);
    }
}
}
