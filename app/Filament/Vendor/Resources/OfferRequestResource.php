<?php

namespace App\Filament\Vendor\Resources;

use App\Filament\Vendor\Resources\OfferRequestResource\Pages;
use App\Filament\Vendor\Resources\OfferRequestResource\RelationManagers;
use App\Models\Offer;
use App\Models\OfferRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfferRequestResource extends Resource
{
    protected static ?string $model = Offer::class;

     public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('shop_id', auth()->user()->shop_id); // assuming vendor has `shop_id`
    }

    public static function canCreate(): bool
    {
        return false;
    }
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListOfferRequests::route('/'),
            'create' => Pages\CreateOfferRequest::route('/create'),
            'edit' => Pages\EditOfferRequest::route('/{record}/edit'),
        ];
    }
}
