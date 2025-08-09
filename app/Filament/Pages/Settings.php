<?php

namespace App\Filament\Pages\Settings;

use Closure;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Outerweb\FilamentSettings\Filament\Pages\Settings as BaseSettings;

class Settings extends BaseSettings
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Settings';
    protected static string $view = 'filament.pages.settings';
    protected function setUp(): void
    {
        parent::setUp();

        $this->dehydrateStateUsing(function ($state) {
            return is_string($state) ? $state : '';
        });
    }


    // public function schema(): array|Closure
    // {
    //     return [
    //         Tabs::make('Settings')
    //             ->schema([
    //                 Tabs\Tab::make('General')
    //                     ->schema([
    //                         TextInput::make('general.brand_name')
    //                             ->required(),
    //                     ]),
    //                 Tabs\Tab::make('Seo')
    //                     ->schema([
    //                         TextInput::make('seo.title')
    //                             ->required(),
    //                         TextInput::make('seo.description')
    //                             ->required(),
    //                     ]),
    //             ]),
    //     ];
    // }
}
