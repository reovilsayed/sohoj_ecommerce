<?php

namespace App\Filament\Vendor\Resources\OfferBannerResource\Pages;

use App\Filament\Vendor\Resources\OfferBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOfferBanners extends ListRecords
{
    protected static string $resource = OfferBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
