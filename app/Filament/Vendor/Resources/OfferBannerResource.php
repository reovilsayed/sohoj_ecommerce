<?php

namespace App\Filament\Vendor\Resources;

use App\Filament\Vendor\Resources\OfferBannerResource\Pages;
use App\Filament\Vendor\Resources\OfferBannerResource\RelationManagers;
use App\Models\Offer;
use App\Models\OfferBanner;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfferBannerResource extends Resource
{
    protected static ?string $model = OfferBanner::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('shop_id', auth()->user()->shop_id); // assuming vendor has `shop_id`
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Banner Title'),
                TextInput::make('description')
                    ->required()
                    ->maxLength(500)
                    ->label('Banner Description'),
                Forms\Components\TextInput::make('image')
                    ->required()
                    ->maxLength(255)
                    ->label('Banner Image URL'),
                Forms\Components\TextInput::make('link')
                    ->required()
                    ->maxLength(255)
                    ->label('Banner Link'),
                Forms\Components\TextInput::make('shop_id')
                    ->default(auth()->id())
                    ->hidden(),
                Forms\Components\TextInput::make('status')
                    ->default('active')
                    ->label('Status')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('image')
                    ->label('Image URL')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('link')
                    ->label('Link')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('F j, Y')
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
            'index' => Pages\ListOfferBanners::route('/'),
            'create' => Pages\CreateOfferBanner::route('/create'),
            'edit' => Pages\EditOfferBanner::route('/{record}/edit'),
        ];
    }
}
