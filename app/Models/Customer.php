<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'phone', 'city',
        'address', 'status', 'total_spent',
        'total_orders', 'last_order_at',
    ];

    protected $casts = [
        'total_spent'   => 'decimal:2',
        'last_order_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'active'   => 'success',
            'inactive' => 'warning',
            'blocked'  => 'danger',
            default    => 'secondary',
        };
    }
   
}