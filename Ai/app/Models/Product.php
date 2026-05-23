<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $table = 'products';
    
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'description',
        'price',
        'compare_price',
        'stock',
        'image',
        'gallery',
        'category_id',
        'brand_id',
        'status',
        'featured',
        'attributes',
        'seo_title',
        'seo_description'
    ];
    
    protected $casts = [
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'gallery' => 'array',
        'attributes' => 'array',
        'featured' => 'boolean',
    ];
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}