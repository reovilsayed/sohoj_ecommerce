<?php

namespace App\Filament\Vendor\Resources;

use App\Filament\Vendor\Resources\ShopPoliciesResource\Pages;
use App\Filament\Vendor\Resources\ShopPoliciesResource\RelationManagers;
use App\Models\ShopPolicies;
use App\Models\ShopPolicy;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShopPoliciesResource extends Resource
{
    protected static ?string $model = ShopPolicy::class;
    public static ?string $label = "Shop Policy";
    public static ?string $title = "Shop Policy";
    public static ?string $description = "Manage your shop policies here.";


   
    public static function getEloquentQuery(): Builder
    {
        $shop = auth()->user()->shop;
        return parent::getEloquentQuery()
            ->where('shop_id', $shop->id); // assuming vendor has `shop_id`
    }

     public static function canCreate(): bool
    {
        return false;
    }
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('shop_id')
                    ->default(auth()->user()->shop->id),
                Textarea::make('delivery')->required()->rows(6),
                Textarea::make('payment_option')->required()->rows(6),
                Textarea::make('return_exchange')->required()->rows(6),
                Textarea::make('cancellation')->required()->rows(6),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('shop.name')->label('Shop'),
                TextColumn::make('delivery')->limit(30),
                TextColumn::make('payment_option')->limit(30),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShopPolicies::route('/'),
            // 'create' => Pages\CreateShopPolicies::route('/create'),
            'edit' => Pages\EditShopPolicies::route('/{record}/edit'),
        ];
    }
}
