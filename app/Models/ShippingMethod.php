<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShippingMethod extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'shipping_zone_id',
        'name',
        'carrier',
        'rate_type',
        'rate',
        'min_order_amount',
        'estimated_days_min',
        'estimated_days_max',
        'is_active',
    ];

    protected $casts = [
        'rate'              => 'decimal:2',
        'min_order_amount'  => 'decimal:2',
        'is_active'         => 'boolean',
    ];

    // Relationships
    public function shippingZone(): BelongsTo
    {
        return $this->belongsTo(ShippingZone::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Helpers
    public function isFreeShipping(float $orderAmount): bool
    {
        return $this->min_order_amount !== null
            && $orderAmount >= $this->min_order_amount;
    }

    public function getEstimatedDelivery(): string
    {
        if ($this->estimated_days_min && $this->estimated_days_max) {
            return "{$this->estimated_days_min}–{$this->estimated_days_max} business days";
        }

        return 'Delivery time not specified';
    }

    public function getRateForOrder(float $orderAmount): float
    {
        return $this->isFreeShipping($orderAmount) ? 0.0 : (float) $this->rate;
    }
}