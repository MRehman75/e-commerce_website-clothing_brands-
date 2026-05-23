<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShippingZone extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'region',
        'countries',
        'is_active',
    ];

    protected $casts = [
        'countries'  => 'array',
        'is_active'  => 'boolean',
    ];

    // Relationships
    public function shippingMethods(): HasMany
    {
        return $this->hasMany(ShippingMethod::class);
    }

    public function activeMethods(): HasMany
    {
        return $this->hasMany(ShippingMethod::class)->where('is_active', true);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Helpers
    public function hasCountry(string $countryCode): bool
    {
        return in_array(strtoupper($countryCode), $this->countries ?? []);
    }
}