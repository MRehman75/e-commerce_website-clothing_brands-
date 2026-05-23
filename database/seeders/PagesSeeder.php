<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    public function run(): void
    {
        $fixed = [
            ['title' => 'About Us',        'slug' => 'about-us'],
            ['title' => 'Contact Us',       'slug' => 'contact-us'],
            ['title' => 'Privacy Policy',   'slug' => 'privacy-policy'],
            ['title' => 'Terms & Conditions','slug' => 'terms-conditions'],
            ['title' => 'Return Policy',    'slug' => 'return-policy'],
        ];

        foreach ($fixed as $page) {
            Page::firstOrCreate(
                ['slug' => $page['slug']],
                array_merge($page, [
                    'content'  => '<p>Content coming soon...</p>',
                    'is_fixed' => true,
                    'is_active'=> true,
                ])
            );
        }
    }
}