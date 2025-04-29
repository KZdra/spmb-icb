<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('layouts.navigation', function ($view) {
            $navItems = [
                [
                    'route' => 'home',
                    'icon' => 'fas fa-th',
                    'label' => __('Dashboard'),
                ],
                [
                    'route' => 'users.index',
                    'icon' => 'fas fa-user',
                    'label' => __('Users'),
                ],
                [
                    'route' => 'about',
                    'icon' => 'far fa-address-card',
                    'label' => __('About Us'),
                ],
            ];
            $collapseNavItems = [
                [
                    'pIcon' => 'fas fa-th',
                    'label' => __('Dashboard'),
                    'list' => [
                        [
                            'route' => 'home',
                            'icon' => 'fas fa-th',
                            'label' => __('Ree')
                        ]
                    ]
                ],
            ];

            $view->with([
                'navItems' => $navItems,
                'collapseNavItems' => $collapseNavItems
            ]);
        });
    }
}
