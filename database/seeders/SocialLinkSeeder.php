<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/SocialLinkSeeder.php
    // database/seeders/SocialLinkSeeder.php
    public function run()
    {
        $links = [
            ['platform' => 'instagram', 'url' => 'https://instagram.com/yourpage', 'icon_class' => 'bi bi-instagram', 'label' => 'Instagram', 'display_order' => 1],
            ['platform' => 'facebook',  'url' => 'https://facebook.com/yourpage',  'icon_class' => 'bi bi-facebook',  'label' => 'Facebook',  'display_order' => 2],
            ['platform' => 'pinterest', 'url' => 'https://pinterest.com/yourpage', 'icon_class' => 'bi bi-pinterest', 'label' => 'Pinterest', 'display_order' => 3],
        ];

        foreach ($links as $link) {
            \App\Models\SocialLink::create($link);
        }
    }
}
