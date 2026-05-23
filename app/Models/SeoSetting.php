<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    protected $fillable = [
        'page', 'meta_title', 'meta_description', 'meta_keywords',
        'og_title', 'og_description', 'og_image',
        'canonical_url', 'no_index', 'no_follow', 'custom_scripts',
    ];

    protected $casts = [
        'no_index'  => 'boolean',
        'no_follow' => 'boolean',
    ];

    public static function forPage(string $page): self
{
    return static::firstOrCreate(
        ['page' => $page],
        [
            'meta_title'       => '',
            'meta_description' => '',
            'meta_keywords'    => '',
            'og_title'         => '',
            'og_description'   => '',
            'canonical_url'    => '',
            'no_index'         => false,
            'no_follow'        => false,
            'custom_scripts'   => '',
        ]
    );
}

    // public static function forPage(string $page): self
    // {
    //     return static::firstOrCreate(['page' => $page]);
    // }

    public static function pages(): array
    {
        return [
            'home'            => 'Home Page',
            'about'           => 'About Us',
            'contact'         => 'Contact Us',
            'blog'            => 'Blog',
            'products'        => 'Products',
            'shipping-policy' => 'Shipping Policy',
            'return-policy'   => 'Return Policy',
            'privacy-policy'  => 'Privacy Policy',
            'terms'           => 'Terms & Conditions',
        ];
    }
}