<?php

namespace App\Filament\Vendor\Pages;

use Filament\Pages\Page;
use Filament\Navigation\NavigationItem;

class CustomChargesPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $title = 'Charges Page';

    protected static string $view = 'filament.vendor.pages.custom-charges-page';

    public static function shouldRegisterNavigation(): bool
    {
        $shop = auth()->user()->shop;
        return $shop && $shop->status == 1;
    }
    public static function getNavigationItems(): array
    {

        return [
            NavigationItem::make('Charges')
                ->url(fn() => route('filament.vendor.pages.custom-charges-page'))
                ->icon('heroicon-o-currency-dollar')
                // ->group('Marketing')
                ->sort(5),
        ];
    }
}
