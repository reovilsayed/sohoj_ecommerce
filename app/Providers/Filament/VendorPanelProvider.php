<?php

namespace App\Providers\Filament;

use App\Filament\Vendor\Resources\OrderResource\Widgets\VendorOrdersChart;
use App\Filament\Vendor\Resources\VendorResource\Widgets\VendorStats;
use App\Http\Middleware\RoleMiddleware;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use App\Filament\Vendor\Pages\ViewInvoice;
use App\Filament\Vendor\Pages\VendorProfilePage;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Filament\Navigation\NavigationGroup;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class VendorPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('vendor')
            ->path('vendor')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->login()
            ->brandName('Vendor Dashboard')
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

            ->discoverResources(in: app_path('Filament/Vendor/Resources'), for: 'App\\Filament\\Vendor\\Resources')
            ->discoverPages(in: app_path('Filament/Vendor/Pages'), for: 'App\\Filament\\Vendor\\Pages')

            ->sidebarCollapsibleOnDesktop(true)
            ->sidebarWidth('14rem')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Vendor/Widgets'), for: 'App\\Filament\\Vendor\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
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
                RoleMiddleware::class . ':vendor',
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->widgets([
                VendorStats::class, // Custom widget for vendor stats
                VendorOrdersChart::class,
            ])
            ->pages([
                ViewInvoice::class,
                VendorProfilePage::class,
            ])

            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Inventory')
                    ->icon('heroicon-o-cube')
                    ->collapsible(),
                NavigationGroup::make()
                    ->label('Orders')
                    ->icon('heroicon-o-shopping-bag'),
                NavigationGroup::make()
                    ->label('Profile')
                    ->icon('heroicon-o-user-circle'),
                NavigationGroup::make()
                    ->label('Support')
                    ->icon('heroicon-o-lifebuoy'),
                NavigationGroup::make()
                    ->label('Marketing')
                    ->icon('heroicon-o-megaphone'),
            ]);
        ;
    }
}
