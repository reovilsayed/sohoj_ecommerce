<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShopResource\Pages;
use App\Filament\Resources\ShopResource\RelationManagers;
use App\Models\Shop;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ShopResource extends Resource
{
    protected static ?string $model = Shop::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Shops';

    protected static ?string $navigationGroup = 'Business';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Card::make()
                ->schema([
                    Forms\Components\Section::make('Shop Details')
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->reactive()
                                ->afterStateUpdated(fn(string $state, callable $set) => $set('slug', Str::slug($state))),
                            Select::make('user_id')
                                ->relationship('user', 'name')
                                ->searchable()
                                ->required(),

                            TextInput::make('slug')->nullable()->unique(Shop::class, 'slug', ignoreRecord: true)->maxLength(255),
                            TextInput::make('email')->email()->required()->maxLength(255),
                            TextInput::make('phone')->required()->maxLength(20),
                        ]),
                    Forms\Components\Section::make('Media')
                        ->schema([
                            FileUpload::make('logo')->image()->directory('shops/logos')->nullable(),
                            FileUpload::make('banner')->image()->directory('shops/banners')->nullable(),
                        ]),
                    Forms\Components\Section::make('Descriptions')
                        ->schema([
                            Textarea::make('description')->required(),
                            Textarea::make('short_description')->required(),
                            TagsInput::make('tags')->required(),
                            RichEditor::make('terms')->nullable(),
                        ]),
                    Forms\Components\Section::make('Company Information')
                        ->schema([
                            TextInput::make('company_name')->required()->maxLength(255),
                            TextInput::make('company_registration')->required()->maxLength(255),
                        ]),
                    Forms\Components\Section::make('Location')
                        ->schema([
                            TextInput::make('city')->required()->maxLength(100),
                            TextInput::make('state')->required()->maxLength(100),
                            TextInput::make('post_code')->nullable()->maxLength(20),
                            TextInput::make('country')->required()->maxLength(100),
                        ]),
                    Forms\Components\Section::make('Status')
                        ->schema([
                            Toggle::make('status')->label('Active')->default(false),
                        ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')->label('Logo')->circular()->toggleable(),
                ImageColumn::make('banner')->label('Banner')->toggleable(),
                TextColumn::make('name')->searchable()->sortable()->toggleable(),
                TextColumn::make('user.name')->label('Owner')->toggleable(),
                TextColumn::make('slug')->toggleable(),
                TextColumn::make('email')->toggleable(),
                TextColumn::make('phone')->toggleable(),
                TextColumn::make('company_name')->toggleable(),
                TextColumn::make('company_registration')->toggleable(),
                TextColumn::make('city')->toggleable(),
                TextColumn::make('state')->toggleable(),
                TextColumn::make('post_code')->toggleable(),
                TextColumn::make('country')->toggleable(),
                TagsColumn::make('tags')->toggleable(),
                BooleanColumn::make('status')->label('Active')->toggleable(),
                TextColumn::make('created_at')->date('F j, Y')->toggleable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('active')
                    ->label('Active Shops')
                    ->query(fn(Builder $query): Builder => $query->where('status', true)),
                Tables\Filters\Filter::make('inactive')
                    ->label('Inactive Shops')
                    ->query(fn(Builder $query): Builder => $query->where('status', false)),
                Tables\Filters\Filter::make('created_at')
                    ->label('Created Date')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')->label('From'),
                        Forms\Components\DatePicker::make('created_until')->label('Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['created_from'], fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date))
                            ->when($data['created_until'], fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('toggleStatus')
                    ->label(fn ($record) => $record->status ? 'Deactivate' : 'Activate')
                    ->icon(fn ($record) => $record->status ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn ($record) => $record->status ? 'danger' : 'success')
                    ->action(function ($record) {
                        $record->status = $record->status ? 0 : 1;
                        $record->save();
                    })
                    ->requiresConfirmation()
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
            'index' => Pages\ListShops::route('/'),
            'create' => Pages\CreateShop::route('/create'),
            'edit' => Pages\EditShop::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }
}
