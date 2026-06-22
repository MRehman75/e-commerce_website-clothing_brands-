<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'min_order_amount',
        'max_discount',
        'usage_limit',
        'used_count',
        'start_date',
        'end_date',
        'is_active',
        'description',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'value' => 'decimal:2',
        'min_order_amount' => 'decimal:2',
        'max_discount' => 'decimal:2',
    ];
// Coupon.php model mein add karo

protected static function booted(): void
{
    static::saving(function ($coupon) {
        $coupon->code = strtoupper(trim($coupon->code));
    });
}
    public function getStatusAttribute(): string
    {
        if (!$this->is_active) return 'inactive';
        if ($this->end_date && $this->end_date->isPast()) return 'expired';
        if ($this->start_date && $this->start_date->isFuture()) return 'upcoming';
        return 'active';
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'active' => 'success',
            'inactive' => 'secondary',
            'expired' => 'danger',
            'upcoming' => 'warning',
            default => 'secondary',
        };
    }
}