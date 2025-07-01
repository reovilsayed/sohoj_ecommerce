<?php

namespace App\Filament\Vendor\Pages;

use Filament\Pages\Page;
use Filament\Navigation\NavigationItem;

class CustomSubscriptionPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.vendor.pages.custom-subscription-page';

    protected static ?string $title = 'Subscriptions Management';

    public ?string $status = null;
    public $intent = null;

    public function mount(): void
    {
        $this->status = $this->subscriptionStatus();
        $intent = auth()->user()->createSetupIntent();
        $this->intent = $intent->client_secret;
    }

    public static function getNavigationItems(): array
    {
        return [
            NavigationItem::make('Subscriptions')
                ->url(fn() => route('filament.vendor.pages.custom-subscription-page'))
                ->icon('heroicon-o-photo')
                ->group('Marketing')
                ->sort(5),
        ];
    }

    protected function subscriptionStatus(): string
    {
        // Example logic — change it as you wish
        return auth()->user()->onTrial() ? 'Trial' : (auth()->user()->subscribed() ? 'true' : 'false');
    }
}
