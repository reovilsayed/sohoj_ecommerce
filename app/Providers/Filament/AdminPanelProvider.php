<?php

namespace App\Providers\Filament;

use App\Filament\Resources\DashboardResource\Widgets\DashboardChart;
use App\Filament\Resources\PolarChartDashboardResource\Widgets\DashboardChart as WidgetsDashboardChart;
use App\Filament\Resources\StatsOverViewResource\Widgets\StatsOverview as WidgetsStatsOverview;
use App\Filament\Widgets\ListLatestShops;
use App\Filament\Widgets\RecentOrders;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use App\View\Components\Layouts\FilamentApp;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use App\Filament\Widgets\StatsOverview;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Pages\DynamicSettingsPage;
use Filament\Navigation\NavigationGroup;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Outerweb\FilamentSettings\Filament\Plugins\FilamentSettingsPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        // dd($panel);
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Admin Panel')
            // ->databaseNotifications()
            ->renderHook(
                'panels::head.start',
                fn() => <<<HTML
        <style>
            /* Hide scrollbar visually but keep scrolling functional */
            .fi-sidebar-nav {
                overflow-y: auto !important;
                scrollbar-width: none !important; /* Firefox */
                -ms-overflow-style: none !important; /* IE/Edge */
            }

            .fi-sidebar-nav::-webkit-scrollbar {
                display: none !important; /* Chrome/Safari */
            }
        </style>
    HTML
            )

            ->brandLogo(asset('assets/logo/Logo.png'))
            ->favicon(asset('assets/images/favicon.ico'))
            ->colors([
                'danger' => Color::Red,
                'gray' => Color::Slate,
                'info' => Color::Blue,
                'primary' => Color::Indigo,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])

            ->sidebarCollapsibleOnDesktop(true)
            ->sidebarWidth('14rem')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            // ->widgets([
            //     Widgets\AccountWidget::class,
            //     Widgets\FilamentInfoWidget::class,
            // ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                \App\Http\Middleware\RoleMiddleware::class . ':admin',
            ])
            ->plugins([
                FilamentSettingsPlugin::make()
                    ->pages([
                        // Add your own setting pages here
                    ])
            ])
            ->widgets([
                WidgetsStatsOverview::class,
                DashboardChart::class,
                WidgetsDashboardChart::class,
                ListLatestShops::class,
                // RecentOrders::class,
            ])
            ->navigationGroups([
                'Inventory',
                'Orders',
                'Business',
                'User Management',
                'Blog',
            ]);
            
    }
}
