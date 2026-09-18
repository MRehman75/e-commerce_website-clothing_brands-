<?php
// app/Models/Address.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'label',
        'name',
        'phone',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'zip_code',
        'country',
        'is_default'
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    // ============ RELATIONSHIPS ============
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ============ ACCESSORS ============
    
    public function getFullAddressAttribute()
    {
        $address = $this->address_line1;
        if ($this->address_line2) {
            $address .= ', ' . $this->address_line2;
        }
        $address .= ', ' . $this->city . ', ' . $this->state . ' - ' . $this->zip_code;
        $address .= ', ' . $this->country;
        return $address;
    }

    public function getShortAddressAttribute()
    {
        $address = $this->address_line1;
        if (strlen($address) > 30) {
            $address = substr($address, 0, 30) . '...';
        }
        return $address . ', ' . $this->city;
    }

    // ============ HELPERS ============
    
    public function setAsDefault()
    {
        // Remove default from all other addresses
        $this->where('user_id', $this->user_id)
            ->where('id', '!=', $this->id)
            ->update(['is_default' => false]);
        
        // Set this as default
        $this->update(['is_default' => true]);
        
        return $this;
    }

    // ============ SCOPES ============
    
    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    public function scopeShipping($query)
    {
        return $query->where('type', 'shipping');
    }

    public function scopeBilling($query)
    {
        return $query->where('type', 'billing');
    }
}