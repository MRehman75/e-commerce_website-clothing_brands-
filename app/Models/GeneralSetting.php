<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable = [
        // Site Info
        'site_name', 'site_tagline', 'site_logo', 'site_favicon',
        'site_email', 'site_phone', 'site_address',
        // SEO
        'meta_title', 'meta_description', 'meta_keywords', 'og_image',
        'google_analytics_id', 'header_scripts', 'footer_scripts',
        // Currency & Language
        'currency_code', 'currency_symbol', 'currency_position',
        'timezone', 'date_format', 'language',
        // Mail
        'mail_driver', 'mail_host', 'mail_port', 'mail_username',
        'mail_password', 'mail_encryption', 'mail_from_address', 'mail_from_name',
        // Social
        'facebook', 'instagram', 'twitter', 'youtube',
        'tiktok', 'linkedin', 'whatsapp',
        // Maintenance
        'maintenance_mode', 'maintenance_message', 'maintenance_allowed_ips',
    ];

    protected $casts = [
        'maintenance_mode' => 'boolean',
    ];

    /**
     * Always return the single settings row (singleton pattern).
     */
    public static function instance(): static
    {
        return static::firstOrCreate([], [
            'site_name'         => config('app.name', 'My Store'),
            'currency_code'     => 'USD',
            'currency_symbol'   => '$',
            'currency_position' => 'before',
            'timezone'          => 'Asia/Karachi',
            'date_format'       => 'd M Y',
            'language'          => 'en',
            'mail_driver'       => 'smtp',
            'mail_encryption'   => 'tls',
            'maintenance_mode'  => false,
        ]);
    }
}