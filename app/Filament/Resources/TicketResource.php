<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\{TextInput, Textarea, FileUpload, Toggle, Select};
use Filament\Tables\Columns\{TextColumn, BooleanColumn, ImageColumn, BadgeColumn};

class TicketResource extends Resource
{

    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('parent_id', null)->latest(); // assuming vendor has `shop_id`
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('parent_id')
                    ->label('Parent Ticket')
                    ->relationship('parent', 'subject') // optional if parent is self-referencing
                    ->searchable()
                    ->nullable(),

                Select::make('shop_id')
                    ->relationship('shop', 'name')
                    ->required(),

                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),

                TextInput::make('subject')
                    ->maxLength(255),

                Textarea::make('massage'),

                FileUpload::make('image')
                    ->image()
                    ->directory('tickets')
                    ->nullable(),

                Toggle::make('status')
                    ->label('Resolved'),

                Select::make('action')
                    ->options([
                        0 => 'No Action',
                        1 => 'In Progress',
                        2 => 'Escalated',
                        3 => 'Closed',
                    ])
                    ->nullable(),
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
                Tables\Filters\SelectFilter::make('status')
                    ->label('Resolved')
                    ->options([
                        1 => 'Yes',
                        0 => 'No',
                    ]),

                Tables\Filters\SelectFilter::make('action')
                    ->label('Action')
                    ->options([
                        0 => 'No Action',
                        1 => 'In Progress',
                        2 => 'Escalated',
                        3 => 'Closed',
                    ]),

                Tables\Filters\Filter::make('created_at')
                    ->label('Created Date')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')->label('From'),
                        Forms\Components\DatePicker::make('created_until')->label('Until'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['created_from'], fn($query, $date) => $query->whereDate('created_at', '>=', $date))
                            ->when($data['created_until'], fn($query, $date) => $query->whereDate('created_at', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                    ->label('Massage Reply'),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->iconButton(),
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
            'view' => Pages\ViewTicket::route('/{record}'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }
}
