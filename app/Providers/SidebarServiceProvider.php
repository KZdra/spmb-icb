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
                    'route' => 'verifPembayaran.index',
                    'icon' => 'fas fa-file-invoice-dollar',
                    'label' => __('Verifikasi Pembayaran'),
                ],
                [
                    'route' => 'about',
                    'icon' => 'far fa-address-card',
                    'label' => __('Verifikasi Siswa'),
                ],
            ];
            $collapseNavItems = [
                [
                    'pIcon' => 'fas fa-th',
                    'label' => __('Data Master'),
                    'list' => [
                        [
                            'route' => 'jurusan.index',
                            'icon' => 'fas fa-medal',
                            'label' => __('Jurusan')
                        ],
                        [
                            'route' => 'users.index',
                            'icon' => 'fas fa-users-cog',
                            'label' => __('Manajemen User')
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
