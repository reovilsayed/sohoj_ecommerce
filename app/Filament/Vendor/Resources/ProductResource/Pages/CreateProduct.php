<?php

namespace App\Filament\Vendor\Resources\ProductResource\Pages;

use App\Filament\Vendor\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Product created')
            ->body('The product has been created successfully.');
    }

    protected function afterCreate(): void
    {
        // Clear cache to prevent query recursion after product creation
        \Illuminate\Support\Facades\Cache::flush();
        
        // Clear Artisan caches as well
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ensure shop_id is set
        $user = Auth::user();
        if ($user && $user->shop) {
            $data['shop_id'] = $user->shop->id;
        }

        return $data;
    }
}
