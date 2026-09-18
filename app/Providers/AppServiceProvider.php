<?php

namespace App\Providers;

use App\Models\SocialLink;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Menu;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('layouts.frontend', function ($view) {
            $headerMenu = Menu::with(['items' => function ($q) {
                $q->where('is_active', 1)
                    ->orderBy('sort_order')
                    ->with(['children' => function ($q) {
                        $q->where('is_active', 1)->orderBy('sort_order');
                    }]);
            }])
                ->where('location', 'header')
                ->where('is_active', 1)
                ->first();

            $view->with('headerMenu', $headerMenu);
        });

        View::composer('components.layouts.app', function ($view) {
            $view->with('socialLinks', \App\Models\SocialLink::active()->get());
        });
    }
}
