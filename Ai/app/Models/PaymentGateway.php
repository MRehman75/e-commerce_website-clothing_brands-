<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'description',
        'merchant_id',
        'api_key',
        'api_secret',
        'webhook_url',
        'extra_fields',
        'mode',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active'    => 'boolean',
        'extra_fields' => 'array',
    ];

    // ── Helpers ──────────────────────────────────────
    public function getLogoUrlAttribute(): string
    {
        if ($this->logo) {
            return asset('storage/' . $this->logo);
        }

        // Return a default icon URL based on slug
        return match ($this->slug) {
            'jazzcash'     => 'https://upload.wikimedia.org/wikipedia/en/9/98/JazzCash_logo.png',
            'easypaisa'    => 'https://upload.wikimedia.org/wikipedia/en/4/4b/Easypaisa_logo.png',
            'stripe'       => 'https://upload.wikimedia.org/wikipedia/commons/b/ba/Stripe_Logo%2C_revised_2016.svg',
            'paypal'       => 'https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg',
            'cod'          => '',
            'bank_transfer'=> '',
            default        => '',
        };
    }
}