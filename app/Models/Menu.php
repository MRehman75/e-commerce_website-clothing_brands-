<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    protected $fillable = ['name', 'location', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public static function locations(): array
    {
        return [
            'header' => 'Header Menu',
            'footer' => 'Footer Menu',
            'mobile' => 'Mobile Menu',
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class)->orderBy('sort_order');
    }

    // Only top-level items with children eager loaded
    public function rootItems(): HasMany
    {
        return $this->hasMany(MenuItem::class)
                    ->whereNull('parent_id')
                    ->orderBy('sort_order')
                    ->with(['children' => fn($q) => $q->orderBy('sort_order')]);
    }
}