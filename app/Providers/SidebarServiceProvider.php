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
                    'route' => 'verifSiswa.index',
                    'icon' => 'fas fa-user-check',
                    'label' => __('Verifikasi Pendaftaran'),
                ],
                [
                    'route' => 'articles.index',
                    'icon' => 'fas fa-newspaper',
                    'label' => __('CMS Berita & Artikel'),
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
                        ],
                        [
                            'route' => 'appconfig.index',
                            'icon' => 'fas fa-cogs',
                            'label' => __('Pengaturan Aplikasi')
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
