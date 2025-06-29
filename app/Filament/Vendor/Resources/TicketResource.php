<?php

namespace App\Filament\Vendor\Resources;

use App\Filament\Vendor\Resources\TicketResource\Pages;
use App\Filament\Vendor\Resources\TicketResource\RelationManagers;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('shop_id', auth()->user()->shop_id); // assuming vendor has `shop_id`
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
                TextColumn::make('id')->sortable()->toggleable(),
                ImageColumn::make('image')->disk('public')->label('Image')->circular()->toggleable(),
                TextColumn::make('user.name')->label('User')->searchable()->toggleable(),
                TextColumn::make('shop.name')->label('Shop')->searchable()->toggleable(),
                TextColumn::make('subject')->limit(30)->searchable()->toggleable(),
                BooleanColumn::make('status')->label('Resolved')->toggleable(),
                BadgeColumn::make('action')
                    ->colors([
                        'gray' => fn($state) => is_null($state) || $state === 0,
                        'warning' => 1,
                        'danger' => 2,
                        'success' => 3,
                    ])
                    ->formatStateUsing(fn($state) => match ($state) {
                        0 => 'No Action',
                        1 => 'In Progress',
                        2 => 'Escalated',
                        3 => 'Closed',
                        default => 'Unknown',
                    })
                    ->toggleable(),
                ImageColumn::make('image')->disk('public')->label('Attachment')->circular()->toggleable(),
                TextColumn::make('created_at')->label('Created')->dateTime()->toggleable(),
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
