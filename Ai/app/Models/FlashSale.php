<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FlashSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'discount_percentage',
        'start_time',
        'end_time',
        'is_active',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_active' => 'boolean',
        'discount_percentage' => 'decimal:2',
    ];

    public function getStatusAttribute(): string
    {
        if (!$this->is_active) return 'inactive';
        if ($this->end_time->isPast()) return 'expired';
        if ($this->start_time->isFuture()) return 'upcoming';
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