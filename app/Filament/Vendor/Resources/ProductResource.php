<?php

namespace App\Filament\Vendor\Resources;

use App\Filament\Vendor\Resources\ProductResource\Pages;
use App\Filament\Vendor\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Tables\Filters\Filter;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('shop_id', auth()->id());
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('shop_id')
                    ->default(auth()->id()),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(Product::class, 'slug', ignoreRecord: true)
                    ->rules(['alpha_dash']),
                Select::make('prodcats')
                    ->label('Categories')
                    ->relationship('prodcats', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload(),

                TextInput::make('price')
                    ->label('Regular Price')
                    ->numeric()
                    ->prefix('$')
                    ->maxValue(999999.99),
                Toggle::make('manage_stock')
                    ->label('Manage Stock')
                    ->live(),
                TextInput::make('quantity')
                    ->label('Stock Quantity')
                    ->numeric()
                    ->minValue(0)
                    ->visible(fn(callable $get) => $get('manage_stock')),

                TextInput::make('weight')
                    ->label('Weight (kg)')
                    ->numeric(),

                TextInput::make('dimensions')
                    ->label('Dimensions (L x W x H)')
                    ->placeholder('e.g., 10 x 5 x 3'),

                Forms\Components\TextInput::make('shipping_cost')
                    ->label('Shipping Cost')
                    ->numeric()
                    ->required()
                    ->default(0),

                FileUpload::make('image')
                    ->label('Featured Image')
                    ->image()
                    ->directory('products')
                    ->visibility('public'),

                FileUpload::make('images')
                    ->label('Gallery Images')
                    ->image()
                    ->multiple()
                    ->directory('products')
                    ->visibility('public'),

                Textarea::make('short_description')
                    ->label('Short Description')
                    ->rows(6)
                    ->maxLength(500),

                Textarea::make('description')
                    ->label('Full Description')
                    ->rows(6),

                Forms\Components\Toggle::make('is_variable_product')
                    ->label('Variable Product')
                    ->helperText('Enable if this product has variations like size, color')
                    ->default(false),
                Forms\Components\Toggle::make('is_offer')
                    ->label('Offer')
                    ->default(false)
                    ->helperText('Enable this if the product has a special offer'),




            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->circular()
                    ->size(60),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Medium)
                    ->limit(30),

                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('type')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'simple' => 'success',
                        'variable' => 'warning',
                        'grouped' => 'info',
                        'external' => 'danger',
                        'digital' => 'primary',
                        default => 'gray',
                    })
                    ->toggleable(),

                TextColumn::make('prodcats.name')
                    ->label('Categories')
                    ->badge()
                    ->separator(',')
                    ->limit(20)
                    ->toggleable(),

                TextColumn::make('price')
                    ->label('Regular Price')
                    ->money('USD')
                    ->sortable(),

                // TextColumn::make('sale_price')
                //     ->label('Sale Price')
                //     ->money('USD')
                //     ->sortable()
                //     ->toggleable(),

                TextColumn::make('quantity')
                    ->label('Stock')
                    ->sortable()
                    ->toggleable()
                    ->color(fn($state) => $state > 10 ? 'success' : ($state > 0 ? 'warning' : 'danger')),

                BooleanColumn::make('status')
                    ->label('Active')
                    ->sortable(),

                BooleanColumn::make('featured')
                    ->label('Featured')
                    ->sortable(),

                TextColumn::make('total_sale')
                    ->label('Sales')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'simple' => 'Simple Product',
                        'variable' => 'Variable Product',
                        'grouped' => 'Grouped Product',
                        'external' => 'External Product',
                        'digital' => 'Digital Product',
                    ]),

                Filter::make('featured')
                    ->query(fn(Builder $query): Builder => $query->where('featured', true))
                    ->label('Featured Products'),

                Filter::make('active')
                    ->query(fn(Builder $query): Builder => $query->where('status', true))
                    ->label('Active Products'),

                Filter::make('out_of_stock')
                    ->query(fn(Builder $query): Builder => $query->where('quantity', '<=', 0))
                    ->label('Out of Stock'),

                Filter::make('low_stock')
                    ->query(fn(Builder $query): Builder => $query->whereBetween('quantity', [1, 10]))
                    ->label('Low Stock (1-10)'),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->iconButton()
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Activate Selected')
                        ->icon('heroicon-o-check-circle')
                        ->action(fn($records) => $records->each(fn($record) => $record->update(['status' => true])))
                        ->color('success'),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Deactivate Selected')
                        ->icon('heroicon-o-x-circle')
                        ->action(fn($records) => $records->each(fn($record) => $record->update(['status' => false])))
                        ->color('danger'),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getEloquentQuery()->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::where('quantity', '<=', 10)->count() > 0 ? 'warning' : 'primary';
    }
}
