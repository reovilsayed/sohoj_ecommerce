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
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('shop_id', auth()->user()->shop_id); // assuming vendor has `shop_id`
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('shop_id')
                    ->default(auth()->id()),
                Textarea::make('delivery')->required(),
                Textarea::make('payment_option')->required(),
                Textarea::make('return_exchange')->required(),
                Textarea::make('cancellation')->required(),
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
                Tables\Actions\DeleteAction::make(),
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
            'create' => Pages\CreateShopPolicies::route('/create'),
            'edit' => Pages\EditShopPolicies::route('/{record}/edit'),
        ];
    }
}
