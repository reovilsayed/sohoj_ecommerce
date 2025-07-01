<?php

namespace App\Filament\Vendor\Resources\ShopPoliciesResource\Pages;

use App\Filament\Vendor\Resources\ShopPoliciesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShopPolicies extends ListRecords
{
    protected static string $resource = ShopPoliciesResource::class;
    protected static ?string $title = "Shop Policy";

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
