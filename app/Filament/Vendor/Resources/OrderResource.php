<?php

namespace App\Filament\Vendor\Resources;

use App\Filament\Vendor\Resources\OrderResource\Pages;
use App\Filament\Vendor\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('shop_id', auth()->user()->shop->id);
    }

    public static function canCreate(): bool
    {
        return false;
    }

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
                TextColumn::make('id')->sortable()->searchable()->toggleable(),
                TextColumn::make('user.name')->label('Customer')->sortable()->searchable()->toggleable(),
                TextColumn::make('shop.name')->label('Shop')->sortable()->searchable()->toggleable(),
                BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn($state) => match ($state) {
                        0 => 'Pending',
                        1 => 'Paid',
                        2 => 'On Its Way',
                        3 => 'Cancelled',
                        4 => 'Delivered',
                        default => 'Unknown',
                    })
                    ->color(fn($state) => match ($state) {
                        0 => 'secondary',
                        1 => 'success',
                        2 => 'warning',
                        3 => 'danger',
                        4 => 'primary',
                        default => 'gray',
                    })
                    ->toggleable(),
                TextColumn::make('total')->money('USD')->sortable()->toggleable(),
                BooleanColumn::make('seen')->toggleable(),
                BooleanColumn::make('order_accept')->label('Accepted')->toggleable(),
                TextColumn::make('created_at')->dateTime('F j, Y')->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Order Status')
                    ->options([
                        0 => 'Pending',
                        1 => 'Paid',
                        2 => 'On Its Way',
                        3 => 'Cancelled',
                        4 => 'Delivered',
                    ]),
                Tables\Filters\Filter::make('seen')
                    ->label('Seen')
                    ->query(fn(Builder $query) => $query->where('seen', true)),
                Tables\Filters\Filter::make('order_accept')
                    ->label('Accepted')
                    ->query(fn(Builder $query) => $query->where('order_accept', true)),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->iconButton()
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getEloquentQuery()->count();
    }
}
