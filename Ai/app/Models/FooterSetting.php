<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $fillable = [
        'logo', 'company_name', 'about_text', 'copyright_text',
        'email', 'phone', 'address',
        'facebook', 'instagram', 'twitter', 'youtube', 'tiktok', 'whatsapp',
        'show_newsletter', 'newsletter_title', 'newsletter_subtitle',
        'playstore_link', 'appstore_link',
        'payment_methods', 'show_bottom_bar',
    ];

    protected $casts = [
        'payment_methods'  => 'array',
        'show_newsletter'  => 'boolean',
        'show_bottom_bar'  => 'boolean',
    ];

    // Always get or create single record
    public static function instance(): static
    {
        return static::firstOrCreate([], [
            'company_name'        => config('app.name'),
            'copyright_text'      => '© ' . date('Y') . ' ' . config('app.name') . '. All rights reserved.',
            'newsletter_title'    => 'Subscribe to our Newsletter',
            'newsletter_subtitle' => 'Get the latest deals and offers.',
            'payment_methods'     => ['visa', 'mastercard', 'easypaisa', 'jazzcash'],
            'show_newsletter'     => true,
            'show_bottom_bar'     => true,
        ]);
    }
}